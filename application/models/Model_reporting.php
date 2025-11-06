<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_reporting extends CI_Model {
    protected $last_db_error = null;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the earliest order date for default filtering
     * @return string
     */
    public function getEarliestOrderDate()
    {
        $this->db->select_min('date_time', 'earliest_date');
        $this->db->from('orders');
        $query = $this->db->get();
        
        if ($query && $query->num_rows() > 0) {
            return $query->row()->earliest_date;
        }
        
        // Fallback to 1 year ago if no orders found
        return date('Y-m-d', strtotime('-1 year'));
    }

    /**
     * Get Sales Report data with filters 
     * @param array $filters
     * @return array
     */ 
public function getSalesReport($filters = array())
{
    $this->db->reset_query();
    log_message('debug', '=== SALES REPORT DEBUG START ===');
    log_message('debug', 'Filters received: ' . json_encode($filters));

    // Modify the query to include store_id
    $this->db->select('
        o.store_id,
        o.id AS order_id,
        o.date_time,
        o.amount_paid,
        o.paid_status,
        oi.qty AS quantity,
        oi.rate AS price,
        oi.amount AS amount,
        p.name AS product_name,
        p.id AS product_id,
        COALESCE(o.customer_name, "Walk-in") AS customer_name
    ');
    $this->db->from('orders o');
    $this->db->join('orders_item oi', 'o.id = oi.order_id', 'inner');
    $this->db->join('products p', 'oi.product_id = p.id', 'left');

    // Debug filter values
    log_message('debug', 'date_from: ' . ($filters['date_from'] ?? 'not set'));
    log_message('debug', 'date_to: ' . ($filters['date_to'] ?? 'not set'));
    log_message('debug', 'warehouse: ' . ($filters['warehouse'] ?? 'not set'));
    log_message('debug', 'status: ' . ($filters['status'] ?? 'not set'));

    // Apply filters with extra validation
    if (!empty($filters['date_from'])) {
        $this->db->where('DATE(o.date_time) >=', $filters['date_from']);
        log_message('debug', 'Applied date_from: ' . $filters['date_from']);
    }
    if (!empty($filters['date_to'])) {
        $this->db->where('DATE(o.date_time) <=', $filters['date_to']);
        log_message('debug', 'Applied date_to: ' . $filters['date_to']);
    }
    if (!empty($filters['warehouse'])) {
        // Fix warehouse filter to handle store_id properly
        $warehouse = trim((string)$filters['warehouse']);
        // store_id is TEXT in DB, use exact string match
        $this->db->where('o.store_id', $warehouse);
        log_message('debug', 'Applied warehouse filter: ' . $warehouse);
    }
    if (!empty($filters['status'])) {
        $status_parts = is_string($filters['status']) ? explode(',', $filters['status']) : (array)$filters['status'];
        $this->db->where_in('o.paid_status', $status_parts);
        log_message('debug', 'Applied status: ' . implode(',', $status_parts));
    }

    // Get and log the SQL
    $sql = $this->db->get_compiled_select();
    log_message('debug', 'Generated SQL: ' . $sql);

    // Execute the compiled SQL directly to avoid CI query-builder state issues
    $query = $this->db->query($sql);
    if ($query === FALSE) {
        $error = $this->db->error();
        log_message('error', 'Query failed: ' . json_encode($error));
        return array();
    }

    // Debug row count
    $results = $query->result_array();
    $count = count($results);
    log_message('debug', 'Query returned ' . $count . ' rows');

    // If no results, check if tables have data
    if ($count === 0) {
        // Reset builder before running new queries
        $this->db->reset_query();
        // Check orders table
        $this->db->select('COUNT(*) as count')->from('orders');
        $orders_count = (int)$this->db->get()->row()->count;
        log_message('debug', 'Total orders in DB: ' . $orders_count);

        $this->db->reset_query();
        // Check orders_item table
        $this->db->select('COUNT(*) as count')->from('orders_item');
        $items_count = (int)$this->db->get()->row()->count;
        log_message('debug', 'Total order items in DB: ' . $items_count);
    }

    log_message('debug', '=== SALES REPORT DEBUG END ===');
    return $results;
}

    // Safe stub / defensive implementation for sales report.
    // Returns DataTables-friendly structure and avoids PHP warnings/notices.
    public function getSalesReportOld($limit = 0, $offset = 0, $filters = array())
    {
        // Defensive: ensure $filters is an array (prevents "Cannot use a scalar value as an array")
        if (!is_array($filters)) {
            $filters = array();
        }

        // Normalize filter values (safe defaults)
        $date_from = !empty($filters['date_from']) ? $filters['date_from'] : null;
        $date_to   = !empty($filters['date_to'])   ? $filters['date_to']   : null;
        $warehouse = !empty($filters['warehouse']) ? $filters['warehouse'] : null;
        $status    = !empty($filters['status'])    ? $filters['status']    : null;

        try {
            // If you have a real query implementation, replace the fallback below.
            // This fallback returns an empty dataset (no PHP notices) so the client receives valid JSON.
            $data = [];

            // Example: (uncomment and adapt if your schema matches)
            /*
            $this->db->select('o.date_time as date, o.invoice_no, c.name as customer, SUM(oi.qty) as items, SUM(oi.total) as amount, o.paid as paid, o.status');
            $this->db->from('orders o');
            $this->db->join('orders_item oi', 'oi.order_id = o.id', 'left');
            $this->db->join('customers c', 'c.id = o.customer_id', 'left');
            if ($date_from) $this->db->where('o.date_time >=', $date_from . ' 00:00:00');
            if ($date_to)   $this->db->where('o.date_time <=', $date_to   . ' 23:59:59');
            if ($warehouse) $this->db->where('o.store_id', $warehouse);
            if ($status)    $this->db->where('o.status', $status);
            $this->db->group_by('o.id');
            if ($limit) $this->db->limit($limit, $offset);
            $query = $this->db->get();
            $data = $query->result_array();
            */

            return [
                'data' => $data,
                'total_items' => count($data),
                'limit' => (int)$limit,
                'offset' => (int)$offset
            ];
        } catch (Throwable $e) {
            log_message('error', 'Model_reporting::getSalesReport error: ' . $e->getMessage());
            return [
                'data' => [],
                'total_items' => 0,
                'limit' => (int)$limit,
                'offset' => (int)$offset,
                'error' => 'Server error'
            ];
        }
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

    /**
     * Get stock report with date-range support.
     *
     * $filters may contain:
     *  - date_from (Y-m-d)
     *  - date_to   (Y-m-d)
     *  - category
     *  - warehouse
     *  - stock_status (in_stock/low_stock/out_of_stock)
     */
    public function getStockReport($limit = 0, $offset = 0, $filters = array()) {
        try {
            // Normalize dates. If no dates provided, use full history.
            if (!empty($filters['date_from']) && !empty($filters['date_to'])) {
                $date_from = $filters['date_from'];
                $date_to   = $filters['date_to'];
            } elseif (!empty($filters['date_from']) && empty($filters['date_to'])) {
                $date_from = $filters['date_from'];
                $date_to   = date('Y-m-d');
            } elseif (empty($filters['date_from']) && !empty($filters['date_to'])) {
                $date_from = '1970-01-01';
                $date_to   = $filters['date_to'];
            } else {
                // full history by default
                $date_from = '1970-01-01';
                $date_to   = date('Y-m-d');
            }
            $start_dt = date('Y-m-d 00:00:00', strtotime($date_from));
            $end_dt   = date('Y-m-d 23:59:59', strtotime($date_to));

            // Raw SQL that aggregates:
            $sql = "
                SELECT
                    p.id,
                    p.name,
                    p.price,
                    p.unit,
                    p.category_id,
                    p.store_id,
                    COALESCE(c.name, 'Uncategorized') AS category_name,
                    COALESCE(s.name, 'Unassigned') AS warehouse_name,

                    -- opening = purchases before start - sales before start
                    COALESCE(pb.purchased_before,0) AS opening_purchased,
                    COALESCE(sb.sold_before,0) AS opening_sold,
                    (COALESCE(pb.purchased_before,0) - COALESCE(sb.sold_before,0)) AS opening_qty,

                    -- movements inside range
                    COALESCE(pr.purchased_in_range,0) AS purchased_in_range,
                    COALESCE(sr.sold_in_range,0) AS sold_in_range,

                    -- closing = opening + purchased_in_range - sold_in_range
                    ((COALESCE(pb.purchased_before,0) - COALESCE(sb.sold_before,0)) + COALESCE(pr.purchased_in_range,0) - COALESCE(sr.sold_in_range,0)) AS closing_qty,

                    COALESCE(pr.purchased_value_in_range,0) AS purchased_value_in_range,
                    COALESCE(sr.sold_value_in_range,0) AS sold_value_in_range,

                    (((COALESCE(pb.purchased_before,0) - COALESCE(sb.sold_before,0)) + COALESCE(pr.purchased_in_range,0) - COALESCE(sr.sold_in_range,0)) * COALESCE(p.price,0)) AS current_value,

                    -- optional last activity date for client-side date filtering
                    GREATEST(
                        COALESCE((SELECT MAX(p2.purchase_date) FROM purchases p2 WHERE p2.product_id = p.id), '1970-01-01'),
                        COALESCE((SELECT MAX(o.date_time) FROM orders o JOIN orders_item oi ON oi.order_id = o.id WHERE oi.product_id = p.id), '1970-01-01')
                    ) AS last_activity_date

                FROM products p
                LEFT JOIN categories c ON c.id = p.category_id
                LEFT JOIN stores s ON s.id = p.store_id

                LEFT JOIN (
                    SELECT product_id, SUM(qty) AS purchased_before
                    FROM purchases
                    WHERE purchase_date < ?
                    GROUP BY product_id
                ) pb ON pb.product_id = p.id

                LEFT JOIN (
                    SELECT oi.product_id, SUM(oi.qty) AS sold_before
                    FROM orders_item oi
                    JOIN orders o ON o.id = oi.order_id
                    WHERE o.date_time < ? AND o.paid_status IN (1,2,3)
                    GROUP BY oi.product_id
                ) sb ON sb.product_id = p.id

                LEFT JOIN (
                    SELECT product_id, SUM(qty) AS purchased_in_range, SUM(total_amount) AS purchased_value_in_range
                    FROM purchases
                    WHERE purchase_date BETWEEN ? AND ?
                    GROUP BY product_id
                ) pr ON pr.product_id = p.id

                LEFT JOIN (
                    SELECT oi.product_id, SUM(oi.qty) AS sold_in_range, SUM(oi.amount) AS sold_value_in_range
                    FROM orders_item oi
                    JOIN orders o ON o.id = oi.order_id
                    WHERE o.date_time BETWEEN ? AND ? AND o.paid_status IN (1,2,3)
                    GROUP BY oi.product_id
                ) sr ON sr.product_id = p.id

                WHERE 1=1
            ";

            // binds order: pb < ? , sb < ? , pr BETWEEN ? AND ? , sr BETWEEN ? AND ?
            $binds = array($start_dt, $start_dt, $start_dt, $end_dt, $start_dt, $end_dt);

            // apply simple filters
            if (!empty($filters['warehouse'])) {
                $sql .= " AND p.store_id = " . $this->db->escape($filters['warehouse']);
            }
            if (!empty($filters['category'])) {
                $sql .= " AND p.category_id = " . $this->db->escape($filters['category']);
            }

            $query = $this->db->query($sql, $binds);
            $rows = $query->result_array();

            // apply stock_status filter in PHP after aggregation (closing_qty computed)
            if (!empty($filters['stock_status'])) {
                $status = $filters['stock_status'];
                $rows = array_values(array_filter($rows, function($r) use ($status) {
                    $q = isset($r['closing_qty']) ? floatval($r['closing_qty']) : 0;
                    if ($status === 'in_stock') return $q > 10;
                    if ($status === 'low_stock') return $q > 0 && $q <= 10;
                    if ($status === 'out_of_stock') return $q <= 0;
                    return true;
                }));
            }

            // sort by product name
            usort($rows, function($a,$b){
                return strcasecmp($a['name'] ?? '', $b['name'] ?? '');
            });

            $total_items = count($rows);

            // pagination slice
            if ($limit && $limit > 0) {
                $paged = array_slice($rows, $offset, $limit);
            } else {
                $paged = $rows;
            }

            // normalize numeric types and include unit & last_activity_date
            foreach ($paged as $k => $r) {
                $paged[$k]['opening_qty'] = floatval($r['opening_qty'] ?? 0);
                $paged[$k]['purchased_in_range'] = floatval($r['purchased_in_range'] ?? 0);
                $paged[$k]['sold_in_range'] = floatval($r['sold_in_range'] ?? 0);
                $paged[$k]['closing_qty'] = floatval($r['closing_qty'] ?? 0);
                $paged[$k]['purchased_value_in_range'] = floatval($r['purchased_value_in_range'] ?? 0);
                $paged[$k]['sold_value_in_range'] = floatval($r['sold_value_in_range'] ?? 0);
                $paged[$k]['current_value'] = floatval($r['current_value'] ?? 0);
                $paged[$k]['unit'] = $r['unit'] ?? '';
                // format last_activity_date as YYYY-MM-DD if present and not epoch
                $lad = $r['last_activity_date'] ?? null;
                if ($lad && $lad !== '1970-01-01') {
                    $paged[$k]['last_activity_date'] = date('Y-m-d', strtotime($lad));
                } else {
                    $paged[$k]['last_activity_date'] = '';
                }
            }

            return [
                'data' => array_values($paged),
                'total_items' => $total_items,
                'limit' => $limit,
                'offset' => $offset
            ];

        } catch (Exception $e) {
            log_message('error', 'Stock report error: ' . $e->getMessage());
            return ['data'=>[], 'total_items'=>0, 'limit'=>$limit, 'offset'=>$offset];
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
        try {
            log_message('debug', 'getPurchaseReport called. Filters: ' . json_encode($filters));

            // detect correct date column in purchases table
            $candidate_cols = ['purchase_date','date','created_at','date_time'];
            $date_col = null;
            foreach ($candidate_cols as $col) {
                if ($this->db->field_exists($col, 'purchases')) {
                    $date_col = $col;
                    break;
                }
            }
            if (!$date_col) {
                log_message('error', 'getPurchaseReport: no date column found in purchases table. Tried: ' . implode(',', $candidate_cols));
                return ['data'=>[], 'total_amount'=>0, 'total_paid'=>0, 'total_items'=>0, 'recordsTotal'=>0, 'recordsFiltered'=>0];
            }

            $this->db->reset_query();
            $this->db->select('p.*, pr.name as product_name');
            $this->db->from('purchases p');
            $this->db->join('products pr', 'pr.id = p.product_id', 'left');

            // Apply date filters using detected column
            if (!empty($filters['date_from'])) {
                $this->db->where('DATE(p.'.$date_col.') >=', $filters['date_from']);
            }
            if (!empty($filters['date_to'])) {
                $this->db->where('DATE(p.'.$date_col.') <=', $filters['date_to']);
            }

            // Apply warehouse/store filter
            if (!empty($filters['warehouse'])) {
                $this->db->where('p.store_id', $filters['warehouse']);
            }

            // Debug compiled SQL
            $sql = $this->db->get_compiled_select();
            log_message('debug', 'getPurchaseReport SQL: ' . $sql);

            // Execute
            $query = $this->db->query($sql);
            if ($query === FALSE) {
                $err = $this->db->error();
                log_message('error', 'getPurchaseReport DB error: ' . json_encode($err));
                return ['data'=>[], 'total_amount'=>0, 'total_paid'=>0, 'total_items'=>0, 'recordsTotal'=>0, 'recordsFiltered'=>0];
            }

            $results = $query->result_array();

            // If no rows, log counts for debugging
            if (empty($results)) {
                // count all purchases
                $cntAll = (int)$this->db->select('COUNT(*) AS c')->from('purchases')->get()->row()->c;
                // count matching date range only (no store filter)
                $this->db->reset_query();
                if (!empty($filters['date_from']) || !empty($filters['date_to'])) {
                    $this->db->select('COUNT(*) AS c')->from('purchases p');
                    if (!empty($filters['date_from'])) $this->db->where('DATE(p.'.$date_col.') >=', $filters['date_from']);
                    if (!empty($filters['date_to']))   $this->db->where('DATE(p.'.$date_col.') <=', $filters['date_to']);
                    $cntRange = (int)$this->db->get()->row()->c;
                } else {
                    $cntRange = $cntAll;
                }
                log_message('warning', "getPurchaseReport: query returned 0 rows. total purchases={$cntAll}, in-range={$cntRange}");
            }

            // totals
            $total_amount = 0;
            $total_paid = 0;
            $total_items = 0;
            foreach ($results as $row) {
                $total_amount += floatval($row['total_amount'] ?? 0);
                $total_paid   += floatval($row['amount_paid'] ?? 0);
                $total_items  += floatval($row['qty'] ?? 0);
            }

            return [
                'data' => $results,
                'total_amount' => $total_amount,
                'total_paid' => $total_paid,
                'total_items' => $total_items,
                'recordsTotal' => count($results),
                'recordsFiltered' => count($results)
            ];

        } catch (Exception $e) {
            log_message('error', 'Purchase report error: ' . $e->getMessage());
            return [
                'data' => [],
                'total_amount' => 0,
                'total_paid' => 0,
                'total_items' => 0,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'error' => $e->getMessage()
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

        $result = $query->row_array();
        return array(
            'total_purchases' => $result['total_purchases'] ?? 0,
            'total_amount' => $result['total_amount'] ?? 0,
            'avg_purchase_value' => $result['avg_purchase_value'] ?? 0,
            'unique_products' => $result['unique_products'] ?? 0,
            'unique_suppliers' => $result['unique_suppliers'] ?? 0
        );
    }

    public function getProductList($filters = array()) 
    {
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
        if (!empty($filters['active'])) {
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
            log_message('error', 'getProductList error: ' . $e->getMessage());
            return array();
        }
    } // Add missing closing brace for getProductList method

    public function getGeneralReport($filters = array())
    {
        try {
            // Initialize return structure
            $report = [
                'sales' => [
                    'total' => 0,
                    'count' => 0,
                    'average' => 0
                ],
                'purchases' => [
                    'total' => 0,
                    'count' => 0,
                    'average' => 0
                ],
                'stock' => [
                    'value' => 0,
                    'items' => 0,
                    'low_stock' => 0
                ],
                'payments' => [
                    'paid' => 0,
                    'unpaid' => 0,
                    'partial' => 0
                ]
            ];

            // Apply date filters if provided
            $date_condition = '';
            $purchase_date_condition = '';
            $params = [];

            if (!empty($filters['date_from'])) {
                $date_condition .= ' AND DATE(o.date_time) >= ?';
                $purchase_date_condition .= ' AND DATE(p.purchase_date) >= ?';
                $params[] = $filters['date_from'];
            }
            if (!empty($filters['date_to'])) {
                $date_condition .= ' AND DATE(o.date_time) <= ?';
                $purchase_date_condition .= ' AND DATE(p.purchase_date) <= ?';
                $params[] = $filters['date_to'];
            }

            // Sales Query
            $sales_sql = "
                SELECT 
                    COUNT(DISTINCT o.id) as order_count,
                    SUM(o.net_amount) as total_sales,
                    SUM(CASE 
                        WHEN o.paid_status = 2 THEN o.net_amount 
                        WHEN o.paid_status = 3 THEN o.amount_paid
                        ELSE 0 
                    END) as paid_amount,
                    SUM(CASE WHEN o.paid_status = 1 THEN o.net_amount ELSE 0 END) as unpaid_amount,
                    SUM(CASE WHEN o.paid_status = 3 THEN o.net_amount ELSE 0 END) as partial_amount
                FROM orders o 
                WHERE 1=1 " . $date_condition;

            $sales_query = $this->db->query($sales_sql, $params);
            if ($sales_query && $sales_result = $sales_query->row_array()) {
                $report['sales']['total'] = floatval($sales_result['total_sales'] ?? 0);
                $report['sales']['count'] = intval($sales_result['order_count'] ?? 0);
                $report['sales']['average'] = $report['sales']['count'] > 0 ? 
                                            $report['sales']['total'] / $report['sales']['count'] : 0;
                $report['payments']['paid'] = floatval($sales_result['paid_amount'] ?? 0);
                $report['payments']['unpaid'] = floatval($sales_result['unpaid_amount'] ?? 0);
                $report['payments']['partial'] = floatval($sales_result['partial_amount'] ?? 0);
            }

            // Purchases Query
            $purchases_sql = "
                SELECT 
                    COUNT(DISTINCT p.id) as purchase_count,
                    SUM(p.total_amount) as total_purchases
                FROM purchases p 
                WHERE 1=1 " . $purchase_date_condition;

            $purchases_query = $this->db->query($purchases_sql, $params);
            if ($purchases_query && $purchases_result = $purchases_query->row_array()) {
                $report['purchases']['total'] = floatval($purchases_result['total_purchases'] ?? 0);
                $report['purchases']['count'] = intval($purchases_result['purchase_count'] ?? 0);
                $report['purchases']['average'] = $report['purchases']['count'] > 0 ? 
                                                $report['purchases']['total'] / $report['purchases']['count'] : 0;
            }

            // Stock Query
            $stock_sql = "
                SELECT 
                    COUNT(DISTINCT p.id) as total_items,
                    SUM(p.quantity * p.price) as stock_value,
                    COUNT(CASE WHEN p.quantity <= 10 THEN 1 END) as low_stock_items
                FROM products p";

            $stock_query = $this->db->query($stock_sql);
            if ($stock_query && $stock_result = $stock_query->row_array()) {
                $report['stock']['value'] = floatval($stock_result['stock_value'] ?? 0);
                $report['stock']['items'] = intval($stock_result['total_items'] ?? 0);
                $report['stock']['low_stock'] = intval($stock_result['low_stock_items'] ?? 0);
            }

            return $report;

        } catch (Exception $e) {
            log_message('error', 'General report error: ' . $e->getMessage());
            return [
                'error' => true,
                'message' => 'Failed to generate general report',
                'details' => $e->getMessage()
            ];
        }
    }

}
