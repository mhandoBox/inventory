<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_reporting extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Stock Report method
    public function getStockReport($filters = array()) {
        $this->db->select('p.id, p.name, p.price, p.unit, p.minimum_quantity,
                          (COALESCE(SUM(CASE WHEN ph.type = "purchase" THEN ph.qty ELSE 0 END), 0)) as total_purchased,
                          (COALESCE(SUM(CASE WHEN oi.id IS NOT NULL THEN oi.qty ELSE 0 END), 0)) as total_sold,
                          (COALESCE(SUM(CASE WHEN ph.type = "purchase" THEN ph.qty ELSE 0 END), 0) - 
                           COALESCE(SUM(CASE WHEN oi.id IS NOT NULL THEN oi.qty ELSE 0 END), 0)) as quantity,
                          c.name as category_name, s.name as warehouse_name,
                          MAX(GREATEST(COALESCE(ph.date, "1900-01-01"), COALESCE(o.date_time, "1900-01-01"))) as last_stock_update,
                          COUNT(DISTINCT o.id) as number_of_orders,
                          MAX(o.date_time) as last_order_date,
                          MIN(o.date_time) as first_order_date,
                          GROUP_CONCAT(DISTINCT o.bill_no ORDER BY o.date_time DESC LIMIT 5) as recent_order_numbers');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.category_id', 'left');
        $this->db->join('stores s', 's.id = p.store_id', 'left');
        $this->db->join('purchase_items ph', 'p.id = ph.product_id', 'left');
        $this->db->join('order_items oi', 'p.id = oi.product_id', 'left');
        $this->db->join('orders o', 'o.id = oi.order_id', 'left');

        // Apply filters
        if (!empty($filters['category'])) {
            $this->db->where('p.category_id', $filters['category']);
        }
        
        if (!empty($filters['warehouse'])) {
            $this->db->where('p.store_id', $filters['warehouse']);
        }
        
        if (!empty($filters['stock_status'])) {
            // We need to use a subquery for stock status filtering since we can't filter on computed columns
            $stock_query = "(SELECT p2.id, 
                                  (COALESCE(SUM(CASE WHEN ph2.type = 'purchase' THEN ph2.qty ELSE 0 END), 0) - 
                                   COALESCE(SUM(CASE WHEN oi2.id IS NOT NULL THEN oi2.qty ELSE 0 END), 0)) as current_stock
                           FROM products p2
                           LEFT JOIN purchase_items ph2 ON p2.id = ph2.product_id
                           LEFT JOIN order_items oi2 ON p2.id = oi2.product_id
                           GROUP BY p2.id) stock_calc";
            
            $this->db->join($stock_query, 'stock_calc.id = p.id', 'left');
            
            switch ($filters['stock_status']) {
                case 'out_of_stock':
                    $this->db->where('stock_calc.current_stock', 0);
                    break;
                case 'low_stock':
                    $this->db->where('stock_calc.current_stock <=', 'p.minimum_quantity', false);
                    $this->db->where('stock_calc.current_stock >', 0);
                    break;
                case 'in_stock':
                    $this->db->where('stock_calc.current_stock >', 'p.minimum_quantity', false);
                    break;
            }
        }

        $this->db->group_by('p.id, p.name, p.price, p.unit, p.minimum_quantity, c.name, s.name');
        $this->db->order_by('p.name', 'ASC');
        
        $query = $this->db->get();
        
        if ($query === FALSE) {
            log_message('error', 'getStockReport failed: ' . json_encode($this->db->error()));
            return array();
        }
        
        return $query->result_array();
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
        
        $this->db->order_by('orders.date_time', 'ASC');
        $query = $this->db->get();
        
        if ($query === FALSE) {
            log_message('error', 'getSalesReport failed: ' . json_encode($this->db->error()));
            $this->session->set_flashdata('error', 'Error fetching sales data.');
            return array();
        }
        
        $results = $query->result_array();
        
        foreach ($results as &$result) {
            $result['items'] = $this->getSaleItems($result['order_id']);
            if (empty($result['items']) && $result['total_items'] > 0) {
                log_message('error', 'Mismatch: total_items ' . $result['total_items'] . ' but no items for order_id ' . $result['order_id']);
            }
        }
        
        return $results;
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
        if (!empty($filters['warehouse'])) {
            $this->db->where('orders.store_id', $filters['warehouse']);
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

    // Purchase Report method
    public function getPurchaseReport($filters = array()) {
        $response = [
            'report' => [],
            'products' => [],
            'filters' => $filters,
            'summary' => ['opening' => 0, 'additions' => 0, 'reductions' => 0, 'closing' => 0]
        ];

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

        $response['summary'] = $this->getStockMovementSummary($filters);

        return $response;
    }

    // Stock Movement Summary
    public function getStockMovementSummary($filters = array()) {
        $this->db->select('SUM(qty) as total_additions');
        $this->db->from('product_stock_history');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(date) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(date) <=', $filters['date_to']);
        }
        $query = $this->db->get();
        return $query->row_array();
    }

    // General Business Report
    public function getGeneralReport($filters = array()) {
        $data = array();
        
        // Sales/Revenue Data
        $this->db->select('SUM(net_amount) as total_revenue, COUNT(*) as total_orders');
        $this->db->from('orders');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(date_time) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(date_time) <=', $filters['date_to']);
        }
        $sales_query = $this->db->get();
        if ($sales_query !== FALSE) {
            $sales_data = $sales_query->row_array();
            $data['total_revenue'] = $sales_data['total_revenue'] ?? 0;
            $data['total_orders'] = $sales_data['total_orders'] ?? 0;
        } else {
            log_message('error', 'getGeneralReport: sales query failed: ' . json_encode($this->db->error()));
            $data['total_revenue'] = 0;
            $data['total_orders'] = 0;
        }

        // Purchase Data from purchases table
        $this->db->select('SUM(total_amount) as total_purchases, COUNT(*) as total_items');
        $this->db->from('purchases');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(purchase_date) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(purchase_date) <=', $filters['date_to']);
        }
        $purchase_query = $this->db->get();
        if ($purchase_query !== FALSE) {
            $purchase_data = $purchase_query->row_array();
            $data['total_purchases'] = $purchase_data['total_purchases'] ?? 0;
            $data['total_items_purchased'] = $purchase_data['total_items'] ?? 0;
        } else {
            log_message('error', 'getGeneralReport: purchases query failed: ' . json_encode($this->db->error()));
            $data['total_purchases'] = 0;
            $data['total_items_purchased'] = 0;
        }

        // Calculate purchase growth
        $previous_period_start = date('Y-m-d', strtotime('-1 month', strtotime($filters['date_from'] ?? date('Y-m-d'))));
        $previous_period_end = date('Y-m-d', strtotime('-1 month', strtotime($filters['date_to'] ?? date('Y-m-d'))));
        
        $this->db->select('SUM(total_amount) as prev_purchases');
        $this->db->from('purchases');
        $this->db->where('DATE(purchase_date) >=', $previous_period_start);
        $this->db->where('DATE(purchase_date) <=', $previous_period_end);
        $prev_purchase_query = $this->db->get();
        if ($prev_purchase_query !== FALSE) {
            $prev_purchase_data = $prev_purchase_query->row_array();
            $prev_purchases = $prev_purchase_data['prev_purchases'] ?? 0;
        } else {
            log_message('error', 'getGeneralReport: prev purchases query failed: ' . json_encode($this->db->error()));
            $prev_purchases = 0;
        }
        $data['purchases_growth'] = $prev_purchases > 0 ? 
            (($data['total_purchases'] - $prev_purchases) / $prev_purchases) * 100 : 0;

        // Expense Data
        $this->db->select('SUM(amount) as total_expenses');
        $this->db->from('company_expenses');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(expense_date) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(expense_date) <=', $filters['date_to']);
        }
        $expense_query = $this->db->get();
        if ($expense_query !== FALSE) {
            $expense_data = $expense_query->row_array();
            $data['total_expenses'] = $expense_data['total_expenses'] ?? 0;
        } else {
            log_message('error', 'getGeneralReport: expenses query failed: ' . json_encode($this->db->error()));
            $data['total_expenses'] = 0;
        }
        
        // Calculate operating expenses (excluding purchases)
        $data['operating_expenses'] = $data['total_expenses'];
        $data['expense_ratio'] = $data['total_revenue'] > 0 ? 
            ($data['total_expenses'] / $data['total_revenue']) * 100 : 0;

        // Calculate profits
        $data['gross_profit'] = $data['total_revenue'] - $data['total_purchases'];
        $data['net_profit'] = $data['gross_profit'] - $data['operating_expenses'];
        $data['profit_margin'] = $data['total_revenue'] > 0 ? 
            ($data['net_profit'] / $data['total_revenue']) * 100 : 0;

        // Get monthly data for trends
        $data['months'] = array();
        $data['monthly_sales'] = array();
        $data['monthly_purchases'] = array();
        $data['monthly_expenses'] = array();
        $data['monthly_profit'] = array();

        // Get last 6 months of data
        for ($i = 5; $i >= 0; $i--) {
            $month = date('M', strtotime("-$i months"));
            $year_month = date('Y-m', strtotime("-$i months"));
            
            $data['months'][] = $month;
            
            // Monthly sales
            $this->db->select('COALESCE(SUM(net_amount), 0) as monthly_sale');
            $this->db->from('orders');
            $this->db->where("DATE_FORMAT(date_time, '%Y-%m') =", $year_month);
            $monthly_sales_query = $this->db->get();
            if ($monthly_sales_query !== FALSE) {
                $monthly_sales = floatval($monthly_sales_query->row()->monthly_sale);
            } else {
                log_message('error', 'Monthly sales query failed for ' . $year_month . ': ' . json_encode($this->db->error()));
                $monthly_sales = 0;
            }
            $data['monthly_sales'][] = $monthly_sales;
            // Monthly purchases
            $this->db->select('COALESCE(SUM(total_amount), 0) as monthly_purchase');
            $this->db->from('purchases');
            $this->db->where("DATE_FORMAT(purchase_date, '%Y-%m') =", $year_month);
            $monthly_purchases_query = $this->db->get();
            if ($monthly_purchases_query !== FALSE) {
                $monthly_purchases = floatval($monthly_purchases_query->row()->monthly_purchase);
            } else {
                log_message('error', 'Monthly purchases query failed for ' . $year_month . ': ' . json_encode($this->db->error()));
                $monthly_purchases = 0;
            }
            $data['monthly_purchases'][] = $monthly_purchases;
            // Monthly expenses
            $this->db->select('COALESCE(SUM(amount), 0) as monthly_expense');
            $this->db->from('company_expenses');
            $this->db->where("DATE_FORMAT(expense_date, '%Y-%m') =", $year_month);
            $monthly_expenses_query = $this->db->get();
            if ($monthly_expenses_query !== FALSE) {
                $monthly_expenses = floatval($monthly_expenses_query->row()->monthly_expense);
            } else {
                log_message('error', 'Monthly expenses query failed for ' . $year_month . ': ' . json_encode($this->db->error()));
                $monthly_expenses = 0;
            }
            $data['monthly_expenses'][] = $monthly_expenses;
            $data['monthly_profit'][] = $monthly_sales - $monthly_purchases - $monthly_expenses;
        }

        // Get expense categories breakdown
        $this->db->select('category, SUM(amount) as amount');
        $this->db->from('company_expenses');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(expense_date) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(expense_date) <=', $filters['date_to']);
        }
        $this->db->group_by('category');
        $expense_categories_query = $this->db->get();
        if ($expense_categories_query !== FALSE) {
            $expense_categories = $expense_categories_query->result_array();
        } else {
            log_message('error', 'getGeneralReport: expense categories query failed: ' . json_encode($this->db->error()));
            $expense_categories = array();
        }
        $data['expense_categories'] = array();
        $data['expense_amounts'] = array();
        foreach ($expense_categories as $category) {
            $data['expense_categories'][] = $category['category'];
            $data['expense_amounts'][] = $category['amount'];
        }

        // Add purchases as a category in expense breakdown
        $data['expense_categories'][] = 'Purchases';
        $data['expense_amounts'][] = $data['total_purchases'];

        // Calculate inventory metrics
        $this->db->select('SUM(stock * price) as inventory_value');
        $this->db->from('products');
        $inventory_query = $this->db->get();
        if ($inventory_query !== FALSE) {
            $inventory_data = $inventory_query->row_array();
            $data['inventory_value'] = $inventory_data['inventory_value'] ?? 0;
        } else {
            log_message('error', 'getGeneralReport: inventory query failed: ' . json_encode($this->db->error()));
            $data['inventory_value'] = 0;
        }

        // Calculate inventory turnover rate
        $average_inventory = $data['inventory_value'];
        $data['turnover_rate'] = $average_inventory > 0 ? 
            ($data['total_purchases'] / $average_inventory) : 0;

        // Add debug arrays for frontend/browser debugging
        $data['debug_months'] = $data['months'];
        $data['debug_monthly_sales'] = $data['monthly_sales'];
        $data['debug_monthly_purchases'] = $data['monthly_purchases'];
        $data['debug_monthly_expenses'] = $data['monthly_expenses'];
        $data['debug_monthly_profit'] = $data['monthly_profit'];

        return $data;
    }

    // Get Stock Movements
    private function getStockMovements($filters = array()) {
        // Get stock additions
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

        // Get stock reductions from sales
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

        // Get opening stock
        $this->db->select('SUM(qty) as total_opening');
        $this->db->from('product_stock_history');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(date) <', $filters['date_from']);
        }
        $opening_query = $this->db->get();
        $opening = $opening_query->row_array();

        // Calculate totals
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

    // Expense Report method
    public function getExpenseReport($filters = array()) {
        $this->db->select('company_expenses.id, company_expenses.expense_date, company_expenses.amount, 
                          company_expenses.description, company_expenses.category, users.username as user_name');
        $this->db->from('company_expenses');
        $this->db->join('users', 'users.id = company_expenses.user_id', 'left');
        
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(company_expenses.expense_date) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(company_expenses.expense_date) <=', $filters['date_to']);
        }
        if (!empty($filters['category'])) {
            $this->db->where('company_expenses.category', $filters['category']);
        }
        
        $this->db->order_by('company_expenses.expense_date', 'DESC');
        $query = $this->db->get();
        
        if ($query === FALSE) {
            log_message('error', 'getExpenseReport failed: ' . json_encode($this->db->error()));
            $this->session->set_flashdata('error', 'Error fetching expense data.');
            return array();
        }
        
        return $query->result_array();
    }

    // Expense Aggregates
    public function getExpenseAggregates($filters = array()) {
        $this->db->select('SUM(amount) as total_expenses, COUNT(*) as total_transactions, AVG(amount) as avg_expense_value');
        $this->db->from('company_expenses');
        
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(expense_date) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(expense_date) <=', $filters['date_to']);
        }
        if (!empty($filters['category'])) {
            $this->db->where('category', $filters['category']);
        }
        
        $query = $this->db->get();
        $result = $query->row_array();
        
        return array(
            'total_expenses' => $result['total_expenses'] ? $result['total_expenses'] : 0,
            'total_transactions' => $result['total_transactions'] ? $result['total_transactions'] : 0,
            'avg_expense_value' => $result['avg_expense_value'] ? $result['avg_expense_value'] : 0
        );
    }

    // Helper method to calculate general metrics
    private function calculateGeneralMetrics($filters) {
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

        $this->db->select('SUM(amount) as total_expenses');
        $this->db->from('company_expenses');
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(expense_date) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(expense_date) <=', $filters['date_to']);
        }
        $expense_query = $this->db->get();
        $expenses = $expense_query->row_array();

        $total_revenue = $revenue['total_revenue'] ? $revenue['total_revenue'] : 0;
        $total_cost = $cost['total_cost'] ? $cost['total_cost'] : 0;
        $total_expenses = $expenses['total_expenses'] ? $expenses['total_expenses'] : 0;
        $gross_profit = $total_revenue - $total_cost - $total_expenses;

        return array(
            'total_revenue' => $total_revenue,
            'total_cost' => $total_cost,
            'total_expenses' => $total_expenses,
            'gross_profit' => $gross_profit,
            'turnover_rate' => $total_cost > 0 ? round($total_revenue / $total_cost, 2) : 0,
            'total_orders' => $revenue['total_orders'] ? $revenue['total_orders'] : 0
        );
    }

    // Helper method to calculate percentage change
    private function calculatePercentageChange($oldValue, $newValue) {
        if ($oldValue == 0) return 0;
        return round((($newValue - $oldValue) / $oldValue) * 100, 2);
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
        $data = array();
        
        // Get last 6 months of data for consistency with monthly report
        for ($i = 5; $i >= 0; $i--) {
            $year_month = date('Y-m', strtotime("-$i months"));
            $month_start = date('Y-m-01', strtotime("-$i months")); // First day of month
            
            $this->db->select('COALESCE(SUM(net_amount), 0) as total');
            $this->db->from('orders');
            $this->db->where("DATE_FORMAT(date_time, '%Y-%m') =", $year_month);
            $query = $this->db->get();
            
            if ($query !== FALSE) {
                $total = floatval($query->row()->total);
                $data[] = array(
                    'date' => $month_start, // Use first day of month for consistent date points
                    'total' => $total,
                    'month' => date('M Y', strtotime("-$i months")) // Add month name for labels
                );
            } else {
                log_message('error', 'Failed to fetch sales chart data for ' . $year_month . ': ' . json_encode($this->db->error()));
                $data[] = array(
                    'date' => $month_start,
                    'total' => 0,
                    'month' => date('M Y', strtotime("-$i months"))
                );
            }
        }
        log_message('debug', 'Sales Chart Data: ' . json_encode($data)); // Debug log
        return $data;
    }

    // Purchase Chart Data
    public function getPurchaseChartData($filters = array()) {
        $data = array();
        
        // Get last 6 months of data for consistency with monthly report
        for ($i = 5; $i >= 0; $i--) {
            $year_month = date('Y-m', strtotime("-$i months"));
            $month_start = date('Y-m-01', strtotime("-$i months")); // First day of month
            
            $this->db->select('COALESCE(SUM(total_amount), 0) as total');
            $this->db->from('purchases');
            $this->db->where("DATE_FORMAT(purchase_date, '%Y-%m') =", $year_month);
            $query = $this->db->get();
            
            if ($query !== FALSE) {
                $total = floatval($query->row()->total);
                $data[] = array(
                    'date' => $month_start, // Use first day of month for consistent date points
                    'total' => $total,
                    'month' => date('M Y', strtotime("-$i months")) // Add month name for labels
                );
            } else {
                log_message('error', 'Failed to fetch purchase chart data for ' . $year_month . ': ' . json_encode($this->db->error()));
                $data[] = array(
                    'date' => $month_start,
                    'total' => 0,
                    'month' => date('M Y', strtotime("-$i months"))
                );
            }
        }
        log_message('debug', 'Purchase Chart Data: ' . json_encode($data)); // Debug log
        return $data;
    }

    // Expense Chart Data
    public function getExpenseChartData($filters = array()) {
        $data = array();
        
        // Get last 6 months of data for consistency with monthly report
        for ($i = 5; $i >= 0; $i--) {
            $year_month = date('Y-m', strtotime("-$i months"));
            $month_start = date('Y-m-01', strtotime("-$i months")); // First day of month
            
            $this->db->select('COALESCE(SUM(amount), 0) as total');
            $this->db->from('company_expenses');
            $this->db->where("DATE_FORMAT(expense_date, '%Y-%m') =", $year_month);
            $query = $this->db->get();
            
            if ($query !== FALSE) {
                $total = floatval($query->row()->total);
                $data[] = array(
                    'date' => $month_start, // Use first day of month for consistent date points
                    'total' => $total,
                    'month' => date('M Y', strtotime("-$i months")) // Add month name for labels
                );
            } else {
                log_message('error', 'Failed to fetch expense chart data for ' . $year_month . ': ' . json_encode($this->db->error()));
                $data[] = array(
                    'date' => $month_start,
                    'total' => 0,
                    'month' => date('M Y', strtotime("-$i months"))
                );
            }
        }
        log_message('debug', 'Expense Chart Data: ' . json_encode($data)); // Debug log
        return $data;
    }
}
?>