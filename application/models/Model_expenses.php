<?php 
class Model_expenses extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($data)
    {
        return $this->db->insert('company_expenses', $data);
    }

    public function getExpenses($limit = 100)
    {
        $this->db->select('company_expenses.*, users.username as user_name');
        $this->db->from('company_expenses');
        $this->db->join('users', 'users.id = company_expenses.user_id', 'left');
        $this->db->order_by('company_expenses.expense_date', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    public function getExpense($id)
    {
        $this->db->select('company_expenses.*, users.username as user_name');
        $this->db->from('company_expenses');
        $this->db->join('users', 'users.id = company_expenses.user_id', 'left');
        $this->db->where('company_expenses.id', $id);
        return $this->db->get()->row_array();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('company_expenses');
    }
}