<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_reporting extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    /**
     * Get the earliest order date for default filtering
     * @return string
     */
    private function getEarliestOrderDate() {
        $this->db->select('MIN(date_time) as earliest_date');
        $this->db->from('orders');
        $query = $this->db->get();
        if ($query === FALSE) {
            log_message('error', 'Failed to fetch earliest order date: ' . json_encode($this->db->error()));
            return date('Y-m-d', strtotime('-30 days')); // Fallback to 30 days ago
        }
        $result = $query->row_array();
        $earliest_date = $result['earliest_date'] ? date('Y-m-d', strtotime($result['earliest_date'])) : date('Y-m-d', strtotime('-30 days'));
        log_message('debug', 'Earliest order date: ' . $earliest_date);
        return $earliest_date;
    }

    /**
     * Get Sales Report - Returns sales data for the given filters
     * @param array $filters
     * @return array
     */
    public function getSalesReport($filters = array()) {
        $this->db->reset_query();
        log_message('debug', 'getSalesReport called with filters: ' . json_encode($filters));
        
        // Set default period to last_30_days if none specified
        if (empty($filters['period']) && empty($filters['date_from']) && empty($filters['date_to'])) {
            $filters['date_from'] = date('Y-m-d', strtotime('-30 days'));
            $filters['date_to'] = date('Y-m-d');
            $filters['period'] = 'last_30_days';
            log_message('debug', 'No period specified, using default: date_from=' . $filters['date_from'] . ', date_to=' . $filters['date_to']);
        }

        // Apply period-based date ranges
        if (!empty($filters['period'])) {
            switch($filters['period']) {
                case 'today':
                    $filters['date_from'] = date('Y-m-d');
                    $filters['date_to'] = date('Y-m-d');
                    break;
                case 'this_week':
                    $filters['date_from'] = date('Y-m-d', strtotime('monday this week'));
                    $filters['date_to'] = date('Y-m-d', strtotime('sunday this week'));
                    break;
                case 'this_month':
                    $filters['date_from'] = date('Y-m-01');
                    $filters['date_to'] = date('Y-m-t');
                    break;
                case 'last_30_days':
                    $filters['date_from'] = date('Y-m-d', strtotime('-30 days'));
                    $filters['date_to'] = date('Y-m-d');
                    break;
            }
            log_message('debug', 'Period filter applied: ' . $filters['period'] . ', date_from=' . $filters['date_from'] . ', date_to=' . $filters['date_to']);
        }

        $this->db->select('
            p.id as product_id,
            p.name as product_name,
            p.unit,
            o.id as order_id,
            o.date_time,
            o.paid_status,
            o.customer_name,
            o.customer_phone,
            oi.qty as quantity,
            oi.rate as price,
            oi.amount as amount,
            COUNT(DISTINCT o.id) as orders_count,
            SUM(CASE WHEN o.paid_status IN (1, 2) THEN oi.amount ELSE 0 END) as paid_amount,
            SUM(CASE WHEN o.paid_status = 0 THEN oi.amount ELSE 0 END) as unpaid_amount,
            AVG(oi.rate) as avg_price,
            SUM(CASE WHEN DATE(o.date_time) = CURDATE() THEN oi.amount ELSE 0 END) as today_sales,
            SUM(CASE WHEN DATE(o.date_time) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN oi.amount ELSE 0 END) as week_sales,
            SUM(CASE WHEN DATE_FORMAT(o.date_time, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") THEN oi.amount ELSE 0 END) as month_sales,
            COUNT(DISTINCT CASE WHEN DATE(o.date_time) = CURDATE() THEN o.id END) as today_orders,
            COUNT(DISTINCT CASE WHEN DATE(o.date_time) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN o.id END) as week_orders,
            COUNT(DISTINCT CASE WHEN DATE_FORMAT(o.date_time, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") THEN o.id END) as month_orders
        ');
        $this->db->from('orders o');
        $this->db->join('orders_item oi', 'o.id = oi.order_id', 'left');
        $this->db->join('products p', 'p.id = oi.product_id', 'left');

        $this->applyFilters($filters);

        $this->db->group_by('p.id, p.name, o.id, o.date_time, o.paid_status, o.customer_name, o.customer_phone, oi.qty, oi.rate, oi.amount');

        $query_str = $this->db->get_compiled_select();
        log_message('debug', 'Sales Report Query: ' . $query_str);

        $query = $this->db->get();
        if ($query === FALSE) {
            $error = $this->db->error();
            log_message('error', 'Sales Report Query Error: ' . json_encode($error));
            $individual_sales = array();
        } else {
            $individual_sales = $query->result_array();
            log_message('debug', 'Sales Report Results: ' . json_encode($individual_sales));
        }

        // Fallback: If no results, try without restrictive filters
        if (empty($individual_sales)) {
            log_message('debug', 'No sales data found with filters, trying without warehouse/status filters');
            $this->db->reset_query();
            $this->db->select('
                p.id as product_id,
                p.name as product_name,
                p.unit,
                o.id as order_id,
                o.date_time,
                o.paid_status,
                o.customer_name,
                o.customer_phone,
                oi.qty as quantity,
                oi.rate as price,
                oi.amount as amount
            ');
            $this->db->from('orders o');
            $this->db->join('orders_item oi', 'o.id = oi.order_id', 'left');
            $this->db->join('products p', 'p.id = oi.product_id', 'left');
            $this->db->where('DATE(o.date_time) >=', $filters['date_from']);
            $this->db->where('DATE(o.date_time) <=', $filters['date_to']);
            $query = $this->db->get();
            if ($query !== FALSE) {
                $individual_sales = $query->result_array();
                log_message('debug', 'Fallback Sales Report Results: ' . json_encode($individual_sales));
            }
        }

        $product_summary = $this->getProductSummary($filters);
        $order_details = $this->getOrderDetails($individual_sales);
        $aggregated_results = $this->getAggregatedSales($filters);

        return array(
            'individual_sales' => $individual_sales,
            'aggregated_sales' => $aggregated_results,
            'product_summary' => $product_summary,
            'order_details' => $order_details,
            'period' => $filters['period'] ?? 'last_30_days',
            'date_from' => $filters['date_from'],
            'date_to' => $filters['date_to']
        );
    }

    private function getProductSummary($filters) {
        $this->db->reset_query();
        $this->db->select('p.id as product_id, 
                          p.name as product_name,
                          SUM(oi.qty) as total_quantity,
                          AVG(oi.rate) as avg_price,
                          SUM(oi.amount) as total_amount,
                          MAX(o.date_time) as latest_date');
        $this->db->from('orders o');
        $this->db->join('orders_item oi', 'o.id = oi.order_id', 'left');
        $this->db->join('products p', 'p.id = oi.product_id', 'left');

        $this->applyFilters($filters);

        $this->db->group_by('p.id, p.name');
        $this->db->order_by('total_amount', 'DESC');

        $query_str = $this->db->get_compiled_select();
        log_message('debug', 'Product Summary Query: ' . $query_str);

        $query = $this->db->get();
        if ($query === FALSE) {
            $error = $this->db->error();
            log_message('error', 'Product Summary Query Error: ' . json_encode($error));
            return array();
        }

        $results = $query->result_array();
        log_message('debug', 'Product Summary Results: ' . json_encode($results));
        return $results;
    }

    private function getOrderDetails($individual_sales) {
        $order_details = array();
        foreach ($individual_sales as $sale) {
            if (!isset($order_details[$sale['product_id']])) {
                $order_details[$sale['product_id']] = array();
            }
            $order_details[$sale['product_id']][] = array(
                'order_id' => $sale['order_id'],
                'qty' => $sale['quantity'],
                'customer_name' => $sale['customer_name'],
                'phone' => $sale['customer_phone'] ?? ''
            );
        }
        return $order_details;
    }

    private function getAggregatedSales($filters) {
        $this->db->reset_query();
        $this->db->select('p.id as product_id, 
                          p.name as product_name,
                          p.unit,
                          SUM(oi.qty) as total_quantity,
                          SUM(oi.amount) as total_amount,
                          COUNT(DISTINCT o.id) as total_orders');
        $this->db->from('orders o');
        $this->db->join('orders_item oi', 'o.id = oi.order_id', 'left');
        $this->db->join('products p', 'p.id = oi.product_id', 'left');

        $this->applyFilters($filters);

        $this->db->group_by('p.id, p.name, p.unit');
        $this->db->order_by('total_amount', 'DESC');

        $query = $this->db->get();
        if ($query === FALSE) {
            $error = $this->db->error();
            return array();
        }

        $results = $query->result_array();
        foreach ($results as &$result) {
            $total_revenue = array_sum(array_column($results, 'total_amount'));
            $result['revenue_share'] = $total_revenue > 0 ? ($result['total_amount'] / $total_revenue) * 100 : 0;
            $result['performance_trend'] = $this->getProductPerformanceTrend($result['product_id'], $filters);
        }

        return $results;
    }

    private function applyFilters($filters) {
        log_message('debug', 'Applying filters: ' . json_encode($filters));
        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(o.date_time) >=', $filters['date_from']);
            log_message('debug', 'Applied date_from filter: ' . $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(o.date_time) <=', $filters['date_to']);
            log_message('debug', 'Applied date_to filter: ' . $filters['date_to']);
        }
        if (!empty($filters['warehouse']) && $filters['warehouse'] !== 'all') {
            $this->db->where('o.store_id', $filters['warehouse']);
            log_message('debug', 'Applied warehouse filter: ' . $filters['warehouse']);
        }
        if (isset($filters['status']) && $filters['status'] !== '' && $filters['status'] !== 'all') {
            $this->db->where('o.paid_status', $filters['status']);
            log_message('debug', 'Applied status filter: ' . $filters['status']);
        }
    }

    private function getProductPerformanceTrend($product_id, $filters) {
        $this->db->reset_query();
        $current_from = !empty($filters['date_from']) ? $filters['date_from'] : date('Y-m-d');
        $current_to = !empty($filters['date_to']) ? $filters['date_to'] : date('Y-m-d');
        
        $date_diff = strtotime($current_to) - strtotime($current_from);
        $prev_from = date('Y-m-d', strtotime($current_from) - $date_diff);
        $prev_to = date('Y-m-d', strtotime($current_from) - 1);

        $this->db->select('SUM(oi.amount) as prev_amount');
        $this->db->from('orders_item oi');
        $this->db->join('orders o', 'o.id = oi.order_id');
        $this->db->where('oi.product_id', $product_id);
        $this->db->where('DATE(o.date_time) >=', $prev_from);
        $this->db->where('DATE(o.date_time) <=', $prev_to);
        $query = $this->db->get();
        if ($query === FALSE) {
            $error = $this->db->error();
            return 0;
        }
        
        $prev_result = $query->row();
        
        $prev_amount = $prev_result ? floatval($prev_result->prev_amount) : 0;
        $current_amount = $prev_amount > 0 ? $prev_amount : 0;
        return $prev_amount > 0 ? (($current_amount - $prev_amount) / $prev_amount) * 100 : 0;
    }

    /**
     * Get Sales Aggregates - Returns summary statistics for sales report
     * @param array $filters
     * @return array
     */
    public function getSalesAggregates($filters = array()) {
        $this->db->reset_query();
        $this->db->select('SUM(o.net_amount) as total_revenue, 
                          COUNT(DISTINCT o.id) as total_orders,
                          COUNT(DISTINCT oi.product_id) as total_products,
                          AVG(o.net_amount) as avg_order_value,
                          SUM(CASE WHEN o.paid_status IN (1, 2) THEN o.net_amount ELSE 0 END) as total_paid,
                          SUM(CASE WHEN o.paid_status = 0 THEN o.net_amount ELSE 0 END) as total_unpaid,
                          SUM(oi.qty) as total_quantity');
        $this->db->from('orders o');
        $this->db->join('orders_item oi', 'o.id = oi.order_id', 'left');
        
        $this->applyFilters($filters);
        
        $query_str = $this->db->get_compiled_select();
        log_message('debug', 'Sales Aggregates Query: ' . $query_str);

        $query = $this->db->get();
        if ($query === FALSE) {
            $error = $this->db->error();
            log_message('error', 'Sales Aggregates Query Error: ' . json_encode($error));
            return array(
                'total_revenue' => 0,
                'total_orders' => 0,
                'avg_order_value' => 0,
                'total_paid' => 0,
                'total_unpaid' => 0,
                'total_quantity' => 0,
                'payment_ratio' => 0
            );
        }
        
        $result = $query->row_array();
        
        $results = array(
            'total_revenue' => $result['total_revenue'] ?? 0,
            'total_orders' => $result['total_orders'] ?? 0,
            'avg_order_value' => $result['avg_order_value'] ?? 0,
            'total_paid' => $result['total_paid'] ?? 0,
            'total_unpaid' => $result['total_unpaid'] ?? 0,
            'total_quantity' => $result['total_quantity'] ?? 0,
            'payment_ratio' => isset($result['total_revenue']) && $result['total_revenue'] > 0 ? 
                ($result['total_paid'] / $result['total_revenue'] * 100) : 0
        );

        log_message('debug', 'Sales Aggregates Results: ' . json_encode($results));
        return $results;
    }

    public function getStockReport($limit = 10, $offset = 0, $filters = array()) {
        try {
            $this->db->reset_query();
            $sql = "
                SELECT 
                    p.id,
                    p.name,
                    p.price,
                    p.unit,
                    p.category_id,
                    p.store_id,
                    COALESCE(c.name, 'Uncategorized') as category_name,
                    COALESCE(s.name, 'Unassigned') as warehouse_name,
                    COALESCE(purchased.total_purchased, 0) as total_purchased,
                    COALESCE(sales.total_sold, 0) as total_sold,
                    (COALESCE(purchased.total_purchased, 0) - COALESCE(sales.total_sold, 0)) as quantity,
                    COALESCE(purchased.total_purchase_value, 0) as total_purchase_value,
                    purchased.last_purchase_date,
                    sales.last_sale_date
                FROM products p
                LEFT JOIN categories c ON c.id = p.category_id
                LEFT JOIN stores s ON s.id = p.store_id
                LEFT JOIN (
                    SELECT 
                        product_id,
                        SUM(qty) as total_purchased,
                        SUM(total_amount) as total_purchase_value,
                        MAX(purchase_date) as last_purchase_date
                    FROM purchases
                    WHERE status IN ('Paid', 'Partial', 'Unpaid')
                    GROUP BY product_id
                ) purchased ON purchased.product_id = p.id
                LEFT JOIN (
                    SELECT 
                        oi.product_id,
                        SUM(oi.qty) as total_sold,
                        MAX(o.date_time) as last_sale_date
                    FROM orders_item oi
                    JOIN orders o ON o.id = oi.order_id 
                    WHERE o.paid_status IN (1, 2, 3)  /* Include partial payments */
                    GROUP BY oi.product_id
                ) sales ON sales.product_id = p.id
                WHERE 1=1
            ";

            // Add filters
            $where_conditions = array();
            $having_conditions = array();

            if (!empty($filters)) {
                if (isset($filters['warehouse']) && $filters['warehouse']) {
                    $where_conditions[] = "p.store_id = " . $this->db->escape($filters['warehouse']);
                }
                if (isset($filters['category']) && $filters['category']) {
                    $where_conditions[] = "p.category_id = " . $this->db->escape($filters['category']);
                }
                if (isset($filters['stock_status']) && $filters['stock_status']) {
                    switch($filters['stock_status']) {
                        case 'in_stock':
                            $having_conditions[] = "(COALESCE(purchased.total_purchased, 0) - COALESCE(sales.total_sold, 0)) > 10";
                            break;
                        case 'low_stock':
                            $having_conditions[] = "(COALESCE(purchased.total_purchased, 0) - COALESCE(sales.total_sold, 0)) > 0 AND (COALESCE(purchased.total_purchased, 0) - COALESCE(sales.total_sold, 0)) <= 10";
                            break;
                        case 'out_of_stock':
                            $having_conditions[] = "(COALESCE(purchased.total_purchased, 0) - COALESCE(sales.total_sold, 0)) <= 0";
                            break;
                    }
                }
            }

            if (!empty($where_conditions)) {
                $sql .= " AND " . implode(" AND ", $where_conditions);
            }

            // Add GROUP BY
            $sql .= " GROUP BY p.id";

            if (!empty($having_conditions)) {
                $sql .= " HAVING " . implode(" AND ", $having_conditions);
            }

            // Get total count for pagination
            $count_sql = "SELECT COUNT(*) as total FROM (" . $sql . ") as counted";
            $count_query = $this->db->query($count_sql);
            $total_count = $count_query->row()->total;

            // Add ordering and limits
            $sql .= " ORDER BY p.name ASC";
            if ($limit) {
                $sql .= " LIMIT " . intval($offset) . ", " . intval($limit);
            }

            // Debug logging
            log_message('debug', 'Stock Report SQL: ' . $sql);

            $query = $this->db->query($sql);
            
            return array(
                'data' => $query->result_array(),
                'total_items' => $total_count,
                'limit' => $limit,
                'offset' => $offset
            );

        } catch (Exception $e) {
            log_message('error', 'Stock Report Error: ' . $e->getMessage());
            return array(
                'data' => array(),
                'total_items' => 0,
                'limit' => $limit,
                'offset' => $offset
            );
        }
    }

    // Other methods remain unchanged but included for completeness
    public function getStockDetails($filters = array(), $limit = null, $offset = null) {
        $this->db->reset_query();
        $this->db->select('
            p.id,
            p.name,
            p.price,
            p.unit,
            COALESCE(c.name, "Uncategorized") as category_name,
            COALESCE(s.name, "Unassigned") as warehouse_name,
            COALESCE(SUM(COALESCE(pu.qty, 0)), 0) as total_purchased,
            COALESCE(SUM(COALESCE(oi.qty, 0)), 0) as total_sold,
            COALESCE((SUM(COALESCE(pu.qty, 0)) - SUM(COALESCE(oi.qty, 0))), 0) as quantity,
            COALESCE(SUM(COALESCE(pu.total_amount, 0)), 0) as total_purchase_value
        ');
        
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.category_id', 'left');
        $this->db->join('stores s', 's.id = p.store_id', 'left');
        $this->db->join('purchases pu', 'pu.product_id = p.id', 'left');
        $this->db->join('orders_item oi', 'oi.product_id = p.id', 'left');
        $this->db->join('orders o', 'o.id = oi.order_id AND o.paid_status IN (1, 2)', 'left');
        
        if (!empty($filters['category'])) {
            $this->db->where('p.category_id', $filters['category']);
        }
        if (!empty($filters['warehouse'])) {
            $this->db->where('p.store_id', $filters['warehouse']);
        }
        if (!empty($filters['stock_status'])) {
            $quantity_calc = '(SUM(COALESCE(pu.qty, 0)) - SUM(COALESCE(oi.qty, 0)))';
            switch($filters['stock_status']) {
                case 'out_of_stock':
                    $this->db->having("$quantity_calc <= 0");
                    break;
                case 'low_stock':
                    $this->db->having("$quantity_calc > 0 AND $quantity_calc <= 10");
                    break;
                case 'in_stock':
                    $this->db->having("$quantity_calc > 10");
                    break;
            }
        }
        
        $this->db->group_by('p.id, p.name, p.price, p.unit, c.name, s.name');
        $this->db->order_by('p.name', 'ASC');
        
        if ($limit !== null && $offset !== null) {
            $this->db->limit($limit, $offset);
        }
        
        try {
            $query = $this->db->get();
            if ($query === FALSE) {
                $error = $this->db->error();
                return array();
            }
            return $query->result_array();
        } catch (Exception $e) {
            return array();
        }
    }

    public function getPurchasesSummary($limit = 10) {
        try {
            $sql = "
                SELECT 
                    p.product_id,
                    pr.name as product_name,
                    SUM(p.qty) as total_quantity,
                    SUM(p.total_amount) as total_amount,
                    COUNT(*) as purchase_count,
                    MAX(p.purchase_date) as latest_purchase,
                    MIN(p.purchase_date) as first_purchase,
                    SUM(CASE WHEN p.status = 'Paid' THEN 1 ELSE 0 END) as paid_purchases,
                    SUM(CASE WHEN p.status = 'Partial' THEN 1 ELSE 0 END) as partial_purchases,
                    SUM(CASE WHEN p.status = 'Unpaid' THEN 1 ELSE 0 END) as unpaid_purchases
                FROM purchases p
                JOIN products pr ON pr.id = p.product_id
                GROUP BY p.product_id, pr.name
                ORDER BY total_quantity DESC
                LIMIT ?
            ";
            
            $query = $this->db->query($sql, array($limit));
            if ($query === FALSE) {
                $error = $this->db->error();
                return array();
            }
            
            $purchases_summary = $query->result_array();

            $orders_sql = "
                SELECT 
                    oi.product_id,
                    p.name as product_name,
                    SUM(oi.qty) as total_quantity_sold,
                    SUM(oi.amount) as total_sales_amount,
                    COUNT(DISTINCT o.id) as order_count,
                    MAX(o.date_time) as latest_sale,
                    MIN(o.date_time) as first_sale,
                    SUM(CASE WHEN o.paid_status IN (1, 2) THEN oi.qty ELSE 0 END) as paid_quantity,
                    SUM(CASE WHEN o.paid_status = 0 THEN oi.qty ELSE 0 END) as unpaid_quantity,
                    AVG(oi.rate) as average_sale_price
                FROM orders_item oi
                JOIN orders o ON o.id = oi.order_id
                JOIN products p ON p.id = oi.product_id
                ORDER BY total_quantity_sold DESC
                LIMIT ?
            ";
            
            $orders_query = $this->db->query($orders_sql, array($limit));
            if ($orders_query === FALSE) {
                $error = $this->db->error();
                $orders_summary = array();
            } else {
                $orders_summary = $orders_query->result_array();
            }

            return array(
                'purchases' => $purchases_summary,
                'orders' => $orders_summary
            );
        } catch (Exception $e) {
            return array(
                'purchases' => array(),
                'orders' => array()
            );
        }
    }

    public function getStockAggregates($filters = array()) {
        try {
            $this->db->reset_query();
            $this->db->select('
                COUNT(DISTINCT p.id) as total_items,
                COALESCE(SUM(
                    CASE 
                        WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                        THEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) * COALESCE(MAX(pu.price), p.price)
                        ELSE 0 
                    END
                ), 0) as total_value,
                COALESCE(SUM(COALESCE(pu.total_amount, 0)), 0) as total_purchase_value,
                COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                    AND (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 10 
                    THEN p.id 
                END) as low_stock_items,
                COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 0 
                    THEN p.id 
                END) as out_of_stock_items
            ');
            $this->db->from('products p');
            $this->db->join('purchases pu', 'pu.product_id = p.id', 'left');
            $this->db->join('orders_item oi', 'oi.product_id = p.id', 'left');
            $this->db->join('orders o', 'o.id = oi.order_id AND o.paid_status IN (1, 2)', 'left');

            if (!empty($filters['category'])) {
                $this->db->where('p.category_id', $filters['category']);
            }
            if (!empty($filters['warehouse'])) {
                $this->db->where('p.store_id', $filters['warehouse']);
            }

            $this->db->group_by('p.id, p.price');

            $query = $this->db->get();
            if ($query === FALSE) {
                $error = $this->db->error();
                return array(
                    'total_items' => 0,
                    'total_value' => 0,
                    'total_purchase_value' => 0,
                    'low_stock_items' => 0,
                    'out_of_stock_items' => 0
                );
            }

            $result = $query->row_array();

            return array(
                'total_items' => $result['total_items'] ?? 0,
                'total_value' => $result['total_value'] ?? 0,
                'total_purchase_value' => $result['total_purchase_value'] ?? 0,
                'low_stock_items' => $result['low_stock_items'] ?? 0,
                'out_of_stock_items' => $result['out_of_stock_items'] ?? 0
            );

        } catch (Exception $e) {
            return array(
                'total_items' => 0,
                'total_value' => 0,
                'total_purchase_value' => 0,
                'low_stock_items' => 0,
                'out_of_stock_items' => 0
            );
        }
    }

    public function getOrderData($year = null) {
        if($year) {
            $sql = "SELECT * FROM orders WHERE YEAR(date_time) = ?";
            $query = $this->db->query($sql, array($year));
            if ($query === FALSE) {
                $error = $this->db->error();
                return array();
            }
            return $query->result_array();
        } else {
            $sql = "SELECT * FROM orders";
            $query = $this->db->query($sql);
            if ($query === FALSE) {
                $error = $this->db->error();
                return array();
            }
            return $query->result_array();
        }
    }

    public function getOrderYear() {
        $sql = "SELECT DISTINCT YEAR(date_time) as order_year FROM orders ORDER BY order_year DESC";
        $query = $this->db->query($sql);
        if ($query === FALSE) {
            $error = $this->db->error();
            return array();
        }
        return $query->result_array();
    }

    public function getSaleItems($order_id) {
        $this->db->reset_query();
        $this->db->select('p.name as name, orders_item.qty as quantity, orders_item.rate as unit_price, orders_item.amount as total');
        $this->db->from('orders_item');
        $this->db->join('products p', 'p.id = orders_item.product_id', 'left');
        $this->db->where('orders_item.order_id', $order_id);
        $query = $this->db->get();
        
        if ($query === FALSE) {
            $error = $this->db->error();
            return array();
        }
        
        return $query->num_rows() > 0 ? $query->result_array() : array();
    }

    public function getPurchaseReport($filters = array()) 
    {
        $this->db->reset_query();

        try {
            // Base query with all required fields
            $this->db->select('
                p.*,
                COALESCE(pr.name, "Unknown Product") as product_name,
                COALESCE(pr.unit, p.unit) as unit,
                COALESCE(st.name, "Unassigned") as warehouse_name
            ');
            $this->db->from('purchases p');
            $this->db->join('products pr', 'pr.id = p.product_id', 'left');
            $this->db->join('stores st', 'st.id = p.store_id', 'left');

            // Apply filters with proper date formatting
            if (!empty($filters['date_from'])) {
                $date_from = date('Y-m-d', strtotime($filters['date_from']));
                $this->db->where('DATE(p.purchase_date) >=', $date_from);
                log_message('debug', 'Applied date_from filter: ' . $date_from);
            }

            if (!empty($filters['date_to'])) {
                $date_to = date('Y-m-d', strtotime($filters['date_to']));
                $this->db->where('DATE(p.purchase_date) <=', $date_to);
                log_message('debug', 'Applied date_to filter: ' . $date_to);
            }

            if (!empty($filters['product'])) {
                $this->db->where('p.product_id', $filters['product']);
            }

            if (!empty($filters['warehouse'])) {
                $this->db->where('p.store_id', $filters['warehouse']);
            }

            if (isset($filters['status']) && $filters['status'] !== '') {
                $this->db->where('p.status', $filters['status']);
            }

            // Add ordering
            $this->db->order_by('p.purchase_date DESC, p.id DESC');

            // Debug log the query before execution
            $query_str = $this->db->get_compiled_select();
            log_message('debug', 'Purchase Report Query: ' . $query_str);

            // Execute query
            $query = $this->db->get();
            
            if ($query === FALSE) {
                throw new Exception('Query failed: ' . json_encode($this->db->error()));
            }

            $purchases = $query->result_array();

            // Debug log the results count
            log_message('debug', sprintf(
                'Purchase Report Results: Found %d records',
                count($purchases)
            ));

            if (empty($purchases)) {
                // Check if any records exist in the date range
                $this->db->select('COUNT(*) as count, MIN(purchase_date) as min_date, MAX(purchase_date) as max_date');
                $this->db->from('purchases');
                $date_range = $this->db->get()->row();

                if ($date_range->count == 0) {
                    throw new Exception('No purchase records exist in the database.');
                }

                // Show available date range in the error message
                throw new Exception(sprintf(
                    'No purchases found in selected date range. Available data is from %s to %s',
                    date('Y-m-d', strtotime($date_range->min_date)),
                    date('Y-m-d', strtotime($date_range->max_date))
                ));
            }

            // Calculate summary
            $summary = [
                'total_purchases' => count($purchases),
                'total_amount' => array_sum(array_column($purchases, 'total_amount')),
                'total_paid' => array_sum(array_column($purchases, 'amount_paid')),
                'pending_amount' => 0
            ];
            $summary['pending_amount'] = $summary['total_amount'] - $summary['total_paid'];

            return [
                'report' => $purchases,
                'summary' => $summary
            ];

        } catch (Exception $e) {
            log_message('error', 'Error in getPurchaseReport: ' . $e->getMessage());
            return [
                'error' => $e->getMessage(),
                'report' => [],
                'summary' => [
                    'total_purchases' => 0,
                    'total_amount' => 0,
                    'total_paid' => 0,
                    'pending_amount' => 0
                ]
            ];
        }
    }

    private function getPurchaseAggregates($filters) {
        $this->db->reset_query();
        $this->db->select('
            COUNT(DISTINCT p.id) as total_purchases,
            SUM(p.total_amount) as total_amount,
            AVG(p.total_amount) as avg_purchase_value,
            COUNT(DISTINCT p.product_id) as unique_products,
            COUNT(DISTINCT p.supplier) as unique_suppliers
        ');
        $this->db->from('purchases p');

        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(p.purchase_date) >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(p.purchase_date) <=', $filters['date_to']);
        }
        if (!empty($filters['warehouse'])) {
            $this->db->where('p.store_id', $filters['warehouse']);
        }
        if (isset($filters['status']) && $filters['status'] !== '') {
            $this->db->where('p.status', $filters['status']);
        }
        if (!empty($filters['supplier'])) {
            $this->db->where('p.supplier', $filters['supplier']);
        }
        if (!empty($filters['product'])) {
            $this->db->where('p.product_id', $filters['product']);
        }

        $query = $this->db->get();
        if ($query === FALSE) {
            $error = $this->db->error();
            return array(
                'total_purchases' => 0,
                'total_amount' => 0,
                'avg_purchase_value' => 0,
                'unique_products' => 0,
                'unique_suppliers' => 0
            );
        }

        return $query->row_array();
    }

    public function getProductList($filters = array()) {
        $this->db->reset_query();
        $this->db->select('
            p.id,
            p.name,
            p.unit,
            p.price,
            p.description,
            p.category_id,
            p.store_id,
            p.availability as active,
            COALESCE(c.name, "Uncategorized") as category_name,
            COALESCE(s.name, "Unassigned") as warehouse_name,
            COALESCE(stock.total_purchased, 0) as total_purchased,
            COALESCE(stock.total_sold, 0) as total_sold,
            (COALESCE(stock.total_purchased, 0) - COALESCE(stock.total_sold, 0)) as quantity,
            COALESCE(stock.purchase_value, 0) as total_purchase_value,
            COALESCE(latest_purchase.price, p.price) as latest_purchase_price
        ');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.category_id', 'left');
        $this->db->join('stores s', 's.id = p.store_id', 'left');
        
        $this->db->join('(
            SELECT 
                p1.product_id,
                p1.price
            FROM purchases p1
            INNER JOIN (
                SELECT product_id, MAX(purchase_date) as latest_date
                FROM purchases
                WHERE status = "Paid"
                GROUP BY product_id
            ) p2 ON p1.product_id = p2.product_id AND p1.purchase_date = p2.latest_date
            WHERE p1.status = "Paid"
        ) latest_purchase', 'latest_purchase.product_id = p.id', 'left');
        
        $this->db->join('(
            SELECT 
                product_id,
                SUM(CASE WHEN transaction_type = "purchase" THEN quantity ELSE 0 END) as total_purchased,
                SUM(CASE WHEN transaction_type = "sale" THEN quantity ELSE 0 END) as total_sold,
                SUM(CASE WHEN transaction_type = "purchase" THEN total_amount ELSE 0 END) as purchase_value
            FROM (
                SELECT 
                    product_id, 
                    qty as quantity, 
                    price,
                    "purchase" as transaction_type, 
                    CASE WHEN status = "Paid" THEN 1 ELSE 0 END as status
                FROM purchases
                UNION ALL
                SELECT 
                    oi.product_id, 
                    oi.qty,
                    oi.rate,
                    "sale", 
                    o.paid_status
                FROM orders_item oi
                JOIN orders o ON o.id = oi.order_id
                UNION ALL
                SELECT 
                    product_id, 
                    qty,
                    0,
                    "return", 
                    status
                FROM returns
            ) transactions
            GROUP BY product_id
        ) stock', 'stock.product_id = p.id', 'left');

        if (!empty($filters['category'])) {
            $this->db->where('p.category_id', $filters['category']);
        }
        if (!empty($filters['warehouse'])) {
            $this->db->where('p.store_id', $filters['warehouse']);
        }
        if (isset($filters['active'])) {
            $this->db->where('p.availability', $filters['active']);
        }
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('p.name', $filters['search']);
            $this->db->or_like('p.description', $filters['search']);
            $this->db->group_end();
        }
        if (!empty($filters['stock_status'])) {
            switch ($filters['stock_status']) {
                case 'out_of_stock':
                    $this->db->where('COALESCE(stock.quantity, 0) <= 0');
                    break;
                case 'low_stock':
                    $this->db->where('COALESCE(stock.quantity, 0) > 0');
                    $this->db->where('COALESCE(stock.quantity, 0) <= 10');
                    break;
                case 'in_stock':
                    $this->db->where('COALESCE(stock.quantity, 0) > 10');
                    break;
            }
        }

        try {
            $query = $this->db->get();
            if ($query === FALSE) {
                $error = $this->db->error();
                throw new Exception('Failed to retrieve product list');
            }

            $products = $query->result_array();

            return $products;

        } catch (Exception $e) {
            return array();
        }
    }
}