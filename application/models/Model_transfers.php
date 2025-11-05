<?php
class Model_transfers extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function createTransfer($data) {
        $this->db->trans_start();
        
        try {
            // Insert transfer record
            $transfer_data = array(
                'transfer_code' => 'TRF-' . date('Ymd-His'),
                'from_store_id' => $data['from_store_id'],
                'to_store_id' => $data['to_store_id'],
                'product_id' => $data['product_id'],
                'qty' => $data['qty'],
                'transfer_date' => date('Y-m-d H:i:s'),
                'notes' => $data['notes'],
                'created_by' => $this->session->userdata('id')
            );
            
            $this->db->insert('stock_transfers', $transfer_data);
            
            $this->db->trans_complete();
            return $this->db->trans_status();
            
        } catch (Exception $e) {
            $this->db->trans_rollback();
            log_message('error', 'Error creating transfer: ' . $e->getMessage());
            return false;
        }
    }

    public function getTransfers($store_id = null) {
        $this->db->select('stock_transfers.*, 
                          from_store.name as from_store_name,
                          to_store.name as to_store_name,
                          products.name as product_name,
                          users.username as created_by_name');
        $this->db->from('stock_transfers');
        $this->db->join('stores as from_store', 'from_store.id = stock_transfers.from_store_id');
        $this->db->join('stores as to_store', 'to_store.id = stock_transfers.to_store_id');
        $this->db->join('products', 'products.id = stock_transfers.product_id');
        $this->db->join('users', 'users.id = stock_transfers.created_by');
        
        if ($store_id) {
            $this->db->where('stock_transfers.from_store_id', $store_id);
            $this->db->or_where('stock_transfers.to_store_id', $store_id);
        }
        
        $this->db->order_by('stock_transfers.created_at', 'DESC');
        return $this->db->get()->result_array();
    }

    public function updateTransferStatus($transfer_id, $status) {
        return $this->db->update('stock_transfers', 
            ['status' => $status], 
            ['id' => $transfer_id]
        );
    }
}