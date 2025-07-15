<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_reporting extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Get items for a specific sale/order
    public function getSaleItems($order_id) {
        $this->db->select('orders_item.product_name as name, orders_item.qty as quantity, orders_item.rate as unit_price, orders_item.amount as total');
        $this->db->from('orders_item');
        $this->db->where('orders_item.order_id', $order_id);
        $query = $this->db->get();
        
        if ($query === FALSE) {
            log_message('error', 'getSaleItems failed for order_id ' . $order_id . ': ' . json_encode($this->db->error()));
            return array();
        }
        
        $result = $query->num_rows() > 0 ? $query->result_array() : array();
        if (empty($result)) {
            log_message('debug', 'No items found for order_id ' . $order_id);
        }
        return $result;
    }

    // Sales Report method
    public function getSalesReport($filters = array()) {
        $this->db->select('orders.id as order_id, orders.date_time as date, orders.customer_name as customer, 
                          orders.net_amount as total, orders.paid_status as status, COUNT(orders_item.id) as total_items');
        $this->db->from('orders');
        $this->db->join('orders_item', 'orders_item.order_id = orders.id', 'left');
        $this->db->group_by('orders.id');
        
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(orders.date_time) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(orders.date_time) <=', $filters['date_to']);
        }
        if (!empty($filters['customer'])) {
            $this->db->where('orders.customer_name LIKE', '%' . $filters['customer'] . '%');
        }
        if (isset($filters['status']) && $filters['status'] !== '') {
            $this->db->where('orders.paid_status', $filters['status']);
        }
        
        $this->db->order_by('orders.date_time', 'ASC'); // Sort from oldest to latest
        $query = $this->db->get();
        
        if ($query === FALSE) {
            log_message('error', 'getSalesReport failed: ' . json_encode($this->db->error()));
            $this->session->set_flashdata('error', 'Error fetching sales data.');
            return array();
        }
        
        $results = $query->result_array();
        
        // Fetch items for each order
        foreach ($results as &$result) {
            $result['items'] = $this->getSaleItems($result['order_id']);
            if (empty($result['items']) && $result['total_items'] > 0) {
                log_message('error', 'Mismatch: total_items ' . $result['total_items'] . ' but no items for order_id ' . $result['order_id']);
            }
        }
        
        return $results;
    }

    // Updated Purchases Report method
    public function getPurchaseReport($filters = array()) {
        // Initialize default response
        $response = [
            'report' => [],
            'products' => [],
            'filters' => $filters,
            'summary' => ['opening' => 0, 'additions' => 0, 'reductions' => 0, 'closing' => 0]
        ];

        // Fetch products for dropdown
        $this->db->select('id, name');
        $this->db->from('products');
        $this->db->order_by('name', 'ASC');
        $products_query = $this->db->get();
        if ($products_query !== FALSE) {
            $response['products'] = $products_query->result_array();
        } else {
            log_message('error', 'Failed to fetch products: ' . json_encode($this->db->error()));
            $this->session->set_flashdata('error', 'Error fetching products.');
        }

        // Fetch purchase report from product_stock_history
        $this->db->select('psh.date, p.name as product, psh.qty as quantity, psh.price as unit_cost, 
                          (psh.qty * psh.price) as total_cost, psh.supplier as source');
        $this->db->from('product_stock_history psh');
        $this->db->join('products p', 'p.id = psh.product_id', 'left');
        
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(psh.date) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(psh.date) <=', $filters['date_to']);
        }
        if (!empty($filters['product'])) {
            $this->db->where('psh.product_id', $filters['product']);
        }
        
        $this->db->order_by('psh.date', 'DESC');
        $query = $this->db->get();

        if ($query !== FALSE) {
            $response['report'] = $query->result_array();
        } else {
            log_message('error', 'Purchase query failed: ' . json_encode($this->db->error()));
            $this->session->set_flashdata('error', 'Error fetching purchase data.');
        }

        // Fetch summary
        $response['summary'] = $this->getStockMovementSummary($filters);

        return $response;
    }

    // General Report method
    public function getGeneralReport($filters = array()) {
        // Current period data
        $current = $this->calculateGeneralMetrics($filters);
        
        // Previous period data for comparison
        $prevFilters = [
            'date_from' => date('Y-m-d', strtotime($filters['date_from'] . ' -1 month')),
            'date_to' => date('Y-m-d', strtotime($filters['date_to'] . ' -1 month'))
        ];
        $previous = $this->calculateGeneralMetrics($prevFilters);
        
        // Calculate percentage changes
        $current['revenue_change'] = $this->calculatePercentageChange($previous['total_revenue'], $current['total_revenue']);
        $current['cost_change'] = $this->calculatePercentageChange($previous['total_cost'], $current['total_cost']);
        $current['profit_change'] = $this->calculatePercentageChange($previous['gross_profit'], $current['gross_profit']);
        $current['turnover_change'] = $this->calculatePercentageChange($previous['turnover_rate'], $current['turnover_rate']);
        
        return $current;
    }

    // Helper method to calculate general metrics
    private function calculateGeneralMetrics($filters) {
        // Get total revenue
        $this->db->select('SUM(net_amount) as total_revenue, COUNT(*) as total_orders');
        $this->db->from('orders');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(date_time) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(date_time) <=', $filters['date_to']);
        }
        $revenue_query = $this->db->get();
        $revenue = $revenue_query->row_array();
        
        // Get total cost from product_stock_history
        $this->db->select('SUM(psh.price * psh.qty) as total_cost');
        $this->db->from('product_stock_history psh');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(psh.date) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(psh.date) <=', $filters['date_to']);
        }
        $cost_query = $this->db->get();
        $cost = $cost_query->row_array();
        
        $total_revenue = $revenue['total_revenue'] ? $revenue['total_revenue'] : 0;
        $total_cost = $cost['total_cost'] ? $cost['total_cost'] : 0;
        $gross_profit = $total_revenue - $total_cost;
        
        return array(
            'total_revenue' => $total_revenue,
            'total_cost' => $total_cost,
            'gross_profit' => $gross_profit,
            'turnover_rate' => $total_cost > 0 ? round($total_revenue / $total_cost, 2) : 0,
            'total_orders' => $revenue['total_orders'] ? $revenue['total_orders'] : 0
        );
    }

    // Helper method to calculate percentage change
    private function calculatePercentageChange($oldValue, $newValue) {
        if ($oldValue == 0) return 0;
        return (($newValue - $oldValue) / $oldValue) * 100;
    }

    // Sales Aggregates
    public function getSalesAggregates($filters = array()) {
        $this->db->select('SUM(net_amount) as total_revenue, COUNT(*) as total_orders, AVG(net_amount) as avg_order_value');
        $this->db->from('orders');
        
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(date_time) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(date_time) <=', $filters['date_to']);
        }
        if (!empty($filters['customer'])) {
            $this->db->where('customer_name LIKE', '%' . $filters['customer'] . '%');
        }
        
        $query = $this->db->get();
        $result = $query->row_array();
        
        return array(
            'total_revenue' => $result['total_revenue'] ? $result['total_revenue'] : 0,
            'total_orders' => $result['total_orders'] ? $result['total_orders'] : 0,
            'avg_order_value' => $result['avg_order_value'] ? $result['avg_order_value'] : 0,
            'conversion_rate' => 0 // Placeholder, as not calculated in model
        );
    }

    // Customer List
    public function getCustomerList() {
        $this->db->select('id, customer_name as name');
        $this->db->from('orders');
        $this->db->where('customer_name IS NOT NULL');
        $this->db->group_by('customer_name');
        $query = $this->db->get();
        if ($query && $query instanceof CI_DB_result) {
            return $query->result_array();
        }
        return array();
    }

    // Stock Movement Summary
    public function getStockMovementSummary($filters = array()) {
        // Get total stock additions
        $this->db->select('SUM(qty) as total_additions');
        $this->db->from('product_stock_history');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(date) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(date) <=', $filters['date_to']);
        }
        $additions_query = $this->db->get();
        $additions = $additions_query->row_array();
        
        // Get total stock reductions (from orders)
        $this->db->select('SUM(orders_item.qty) as total_reductions');
        $this->db->from('orders_item');
        $this->db->join('orders', 'orders.id = orders_item.order_id');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(orders.date_time) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(orders.date_time) <=', $filters['date_to']);
        }
        $reductions_query = $this->db->get();
        $reductions = $reductions_query->row_array();
        
        // Calculate opening stock (before date_from)
        $this->db->select('SUM(qty) as total_opening');
        $this->db->from('product_stock_history');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(date) <', $filters['date_from']);
        }
        $opening_query = $this->db->get();
        $opening = $opening_query->row_array();
        
        $total_additions = $additions['total_additions'] ? $additions['total_additions'] : 0;
        $total_reductions = $reductions['total_reductions'] ? $reductions['total_reductions'] : 0;
        $opening_stock = $opening['total_opening'] ? $opening['total_opening'] : 0;
        $closing_stock = $opening_stock + $total_additions - $total_reductions;

        return array(
            'opening' => $opening_stock,
            'additions' => $total_additions,
            'reductions' => $total_reductions,
            'closing' => $closing_stock
        );
    }

    // Product List
    public function getProductList() {
        $this->db->select('id, name');
        $this->db->from('products');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        if ($query !== FALSE) {
            return $query->result_array();
        } else {
            log_message('error', 'Failed to fetch product list: ' . json_encode($this->db->error()));
            return array();
        }
    }

    // Sales Chart Data
    public function getSalesChartData($filters = array()) {
        $this->db->select('DATE(date_time) as date, SUM(net_amount) as total');
        $this->db->from('orders');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(date_time) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(date_time) <=', $filters['date_to']);
        }
        $this->db->group_by('DATE(date_time)');
        $this->db->order_by('date_time', 'ASC');
        $query = $this->db->get();
        if ($query !== FALSE) {
            return $query->result_array();
        } else {
            log_message('error', 'Failed to fetch sales chart data: ' . json_encode($this->db->error()));
            return array();
        }
    }

    // Purchase Chart Data
    public function getPurchaseChartData($filters = array()) {
        $this->db->select('DATE(date) as date, SUM(qty) as total');
        $this->db->from('product_stock_history');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(date) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(date) <=', $filters['date_to']);
        }
        $this->db->group_by('DATE(date)');
        $this->db->order_by('date', 'ASC');
        $query = $this->db->get();
        if ($query !== FALSE) {
            return $query->result_array();
        } else {
            log_message('error', 'Failed to fetch purchase chart data: ' . json_encode($this->db->error()));
            return array();
        }
    }
}
?>