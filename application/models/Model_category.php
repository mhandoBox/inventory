<?php 

class Model_category extends CI_Model
{
    public function getActiveCategories()
    {
        $this->db->select('id, name');
        $this->db->from('categories');
        $this->db->where('active', 1);
        $this->db->order_by('name', 'ASC');
        
        $query = $this->db->get();
        
        if ($query !== FALSE) {
            return $query->result_array();
        } else {
            log_message('error', 'getActiveCategories failed: ' . json_encode($this->db->error()));
            return array();
        }
    }
	public function __construct()
	{
		parent::__construct();
	}

	/* get active brand infromation */
	public function getActiveCategory()
	{
		$sql = "SELECT * FROM categories WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getCategoryData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM categories WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM categories";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('categories', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('categories', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('categories');
			return ($delete == true) ? true : false;
		}
	}

}