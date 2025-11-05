<?php 

class Model_stores extends CI_Model
{
    public function getActiveStores()
    {
        $this->db->select('id, name');
        $this->db->from('stores');
        $this->db->where('active', 1);
        $this->db->order_by('name', 'ASC');
        
        $query = $this->db->get();
        
        if ($query !== FALSE) {
            return $query->result_array();
        } else {
            log_message('error', 'getActiveStores failed: ' . json_encode($this->db->error()));
            return array();
        }
    }
	public function __construct()
	{
		parent::__construct();
	}

	/* get the active store data */
	public function getActiveStore()
	{
		$sql = "SELECT * FROM stores WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getStoresData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM stores where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM stores";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('stores', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('stores', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('stores');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalStores()
	{
		$sql = "SELECT * FROM stores WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

	public function getStoreById($store_id)
	{
		if (!$store_id) {
			return null;
		}

		$this->db->where('id', $store_id);
		$query = $this->db->get('stores');

		if ($query === FALSE) {
			log_message('error', 'Failed to fetch store: ' . $this->db->error()['message']);
			return null;
		}

		return $query->row_array();
	}

	public function getStoreData($store_id)
	{
		if (!$store_id) {
			return null;
		}

		$this->db->select('
			stores.*,
			COALESCE(users.username, "Unassigned") as manager_name,
			COALESCE(SUM(orders.net_amount), 0) as total_revenue,
			COALESCE(SUM(orders.paid_amount), 0) as total_paid_amount,
			COALESCE(SUM(purchases.total_amount), 0) as total_purchases,
			COUNT(DISTINCT orders.id) as total_orders,
			COUNT(DISTINCT purchases.id) as total_purchase_orders
		');
		$this->db->from('stores');
		$this->db->join('users', 'users.id = stores.manager_id', 'left');
		$this->db->join('orders', 'orders.store_id = stores.id', 'left');
		$this->db->join('purchases', 'purchases.store_id = stores.id', 'left');
		$this->db->where('stores.id', $store_id);
		$this->db->where('stores.active', 1);
		$this->db->group_by('stores.id, stores.name, users.username');
		
		$query = $this->db->get();

		if ($query === FALSE) {
			log_message('error', 'Failed to fetch store data: ' . $this->db->error()['message']);
			return null;
		}

		$store_data = $query->row_array();

		// Add calculated fields
		if ($store_data) {
			$store_data['total_revenue'] = floatval($store_data['total_revenue']);
			$store_data['total_paid_amount'] = floatval($store_data['total_paid_amount']);
			$store_data['total_purchases'] = floatval($store_data['total_purchases']);
			$store_data['gross_profit'] = $store_data['total_revenue'] - $store_data['total_purchases'];
			$store_data['payment_ratio'] = $store_data['total_revenue'] > 0 ? 
				($store_data['total_paid_amount'] / $store_data['total_revenue']) * 100 : 0;
		}

		return $store_data;
	}
}