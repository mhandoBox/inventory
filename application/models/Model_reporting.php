<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_reporting extends CI_Model {
    // Get items for a specific sale/order
    public function getSaleItems($order_id) {
        $this->db->select('orders_item.product_name as name, orders_item.qty as quantity, orders_item.rate as unit_price, (orders_item.qty * orders_item.rate) as total');
        $this->db->from('orders_item');
        $this->db->where('orders_item.order_id', $order_id);
        $query = $this->db->get();
        if ($query && $query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    public function __construct() {
        parent::__construct();
    }

    // Sales Report
    public function getSalesReport($filters = array()) {
        $this->db->select('orders.id as order_id, orders.date_time as date, orders.customer_name as customer, orders.gross_amount as total, orders.paid_status as status');
        $this->db->from('orders');
        
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(orders.date_time) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(orders.date_time) <=', $filters['date_to']);
        }
        if (!empty($filters['customer'])) {
            $this->db->where('orders.customer_name LIKE', '%' . $filters['customer'] . '%');
        }
        
        $this->db->order_by('orders.date_time', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSalesAggregates($filters = array()) {
        $this->db->select('SUM(gross_amount) as total_revenue, COUNT(*) as total_orders, AVG(gross_amount) as avg_order_value');
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
            'total_items' => $result['total_orders'] ? $result['total_orders'] : 0,
            'avg_order_value' => $result['avg_order_value'] ? $result['avg_order_value'] : 0
        );
    }

    public function getCustomerList() {
        $query = $this->db->get('customers'); // replace 'customers' with your actual table name
        if ($query && $query instanceof CI_DB_result) {
            return $query->result_array();
        }
        return array();
    }

    // Purchases/Stock Additions Report
    public function getPurchaseReport($filters = array()) {
        $this->db->select('products.name as product, products.qty as quantity, products.date_time as date, "Purchase" as source');
        $this->db->from('products');
        
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(products.date_time) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(products.date_time) <=', $filters['date_to']);
        }
        if (!empty($filters['product'])) {
            $this->db->where('products.id', $filters['product']);
        }
        
        $this->db->order_by('products.date_time', 'DESC');
        $query = $this->db->get();

        if ($query && $query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array(); // Return empty array if query failed or no results
        }
    }

    public function getStockMovementSummary($filters = array()) {
        // Get total stock additions
        $this->db->select('SUM(qty) as total_additions');
        $this->db->from('products');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(date_time) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(date_time) <=', $filters['date_to']);
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
        
        return array(
            'opening' => 0, // Would need historical data
            'additions' => $additions['total_additions'] ? $additions['total_additions'] : 0,
            'reductions' => $reductions['total_reductions'] ? $reductions['total_reductions'] : 0,
            'closing' => ($additions['total_additions'] ? $additions['total_additions'] : 0) - ($reductions['total_reductions'] ? $reductions['total_reductions'] : 0)
        );
    }

    public function getProductList() {
        $this->db->select('id, name');
        $this->db->from('products');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // General Report
    public function getGeneralReport($filters = array()) {
        // Get total revenue
        $this->db->select('SUM(gross_amount) as total_revenue');
        $this->db->from('orders');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(date_time) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(date_time) <=', $filters['date_to']);
        }
        $revenue_query = $this->db->get();
        $revenue = $revenue_query->row_array();
        
        // Get total cost (sum of product costs)
        $this->db->select('SUM(products.price * products.qty) as total_cost');
        $this->db->from('products');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(date_time) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(date_time) <=', $filters['date_to']);
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
            'turnover_rate' => $total_cost > 0 ? round($total_revenue / $total_cost, 2) : 0
        );
    }

    // Chart Data
    public function getSalesChartData($filters = array()) {
        $this->db->select('DATE(date_time) as date, SUM(gross_amount) as total');
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
        return $query->result_array();
    }

    public function getPurchaseChartData($filters = array()) {
        $this->db->select('DATE(date_time) as date, SUM(qty) as total');
        $this->db->from('products');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(date_time) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(date_time) <=', $filters['date_to']);
        }
        $this->db->group_by('DATE(date_time)');
        $this->db->order_by('date_time', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
