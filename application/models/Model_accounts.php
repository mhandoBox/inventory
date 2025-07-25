<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_accounts extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_all_accounts() 
    {
        $this->db->order_by('account_code', 'ASC');
        return $this->db->get('accounts')->result();
    }
    
    public function get_account($id) 
    {
        return $this->db->get_where('accounts', array('id' => $id))->row();
    }
    
    public function create_account($data) 
    {
        return $this->db->insert('accounts', $data);
    }
    
    public function update_account($id, $data) 
    {
        $this->db->where('id', $id);
        return $this->db->update('accounts', $data);
    }
    
    public function delete_account($id) 
    {
        // First check if the account has any transactions
        $this->db->where('account_id', $id);
        if($this->db->count_all_results('journal_lines') > 0) {
            return FALSE; // Cannot delete account with transactions
        }
        
        $this->db->where('id', $id);
        return $this->db->delete('accounts');
    }
    
    public function get_account_types() 
    {
        return array(
            'Asset' => 'Asset',
            'Liability' => 'Liability',
            'Equity' => 'Equity',
            'Revenue' => 'Revenue',
            'Expense' => 'Expense',
            'Cost of Goods Sold' => 'Cost of Goods Sold'
        );
    }
    
    public function get_normal_balances() 
    {
        return array(
            'Debit' => 'Debit',
            'Credit' => 'Credit'
        );
    }
}
