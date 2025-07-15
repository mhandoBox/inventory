<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_reports extends CI_Model
{	
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
