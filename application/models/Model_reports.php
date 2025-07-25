<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_reports extends CI_Model
{
    public function getStockReport($filters = array())
    {
        $this->db->select('p.id, p.name, p.price, p.unit, 
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
        $this->db->group_by('p.id, p.name, p.price, p.unit, c.name, s.name');

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
                    $this->db->where('stock_calc.current_stock <=', 100); // You can adjust this threshold
                    $this->db->where('stock_calc.current_stock >', 0);
                    break;
                case 'in_stock':
                    $this->db->where('stock_calc.current_stock >', 100); // You can adjust this threshold
                    break;
            }
        }

        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getOrderData($year = null)
	{
		if($year) {
			$sql = "SELECT * FROM orders WHERE YEAR(date_time) = ?";
			$query = $this->db->query($sql, array($year));
			return $query->result_array();
		} else {
			$sql = "SELECT * FROM orders";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
	}

	public function getOrderYear()
	{
		$sql = "SELECT DISTINCT YEAR(date_time) as order_year FROM orders ORDER BY order_year DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
