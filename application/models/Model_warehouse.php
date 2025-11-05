<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_warehouse extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get active warehouses
     * @return array
     */
    public function getActiveWarehouse()
    {
        $this->db->select('*');
        $this->db->from('stores');
        $this->db->where('active', 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    /**
     * Get warehouse by ID
     * @param int $id
     * @return array
     */
    public function getWarehouse($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('stores');
        return $query->row_array();
    }

    /**
     * Get all warehouses
     * @return array
     */
    public function getAllWarehouses()
    {
        $query = $this->db->get('stores');
        return $query->result_array();
    }
}