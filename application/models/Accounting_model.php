<?php
class Accounting_model extends CI_Model
{
    // Create a journal entry with lines
    public function create_journal_entry($date, $description, $reference_id, $module, $lines)
    {
        $this->db->trans_start();

        $entry = [
            'date' => $date,
            'description' => $description,
            'reference_id' => $reference_id,
            'module' => $module,
            'created_by' => $this->session->userdata('id')
        ];
        $this->db->insert('journal_entries', $entry);
        $entry_id = $this->db->insert_id();

        $total_debit = 0;
        $total_credit = 0;

        foreach ($lines as $line) {
            $this->db->insert('journal_lines', [
                'entry_id' => $entry_id,
                'account_id' => $line['account_id'],
                'debit' => $line['debit'],
                'credit' => $line['credit']
            ]);
            $total_debit += $line['debit'];
            $total_credit += $line['credit'];
        }

        if (round($total_debit,2) !== round($total_credit,2)) {
            $this->db->trans_rollback();
            throw new Exception('Journal entry not balanced');
        }

        $this->db->trans_complete();
        return $entry_id;
    }

    // Automatically generate journal for purchase
    public function record_purchase($purchase_id)
    {
        $purchase = $this->db->get_where('purchases', ['id' => $purchase_id])->row_array();
        // Example account IDs: Inventory=1, Cash=2, Accounts Payable=3
        $lines = [
            ['account_id' => 1, 'debit' => $purchase['total_amount'], 'credit' => 0], // Inventory
            ['account_id' => 3, 'debit' => 0, 'credit' => $purchase['total_amount']] // Accounts Payable
        ];
        return $this->create_journal_entry($purchase['purchase_date'], 'Purchase', $purchase_id, 'purchase', $lines);
    }

    // Automatically generate journal for sale
    public function record_sale($order_id)
    {
        $order = $this->db->get_where('orders', ['id' => $order_id])->row_array();
        // Example account IDs: Cash=2, Sales Income=4, COGS=5, Inventory=1
        $lines = [
            ['account_id' => 2, 'debit' => $order['net_amount'], 'credit' => 0], // Cash
            ['account_id' => 4, 'debit' => 0, 'credit' => $order['net_amount']], // Sales Income
            // COGS and Inventory logic can be added here
        ];
        return $this->create_journal_entry($order['date_time'], 'Sale', $order_id, 'sale', $lines);
    }

    // Automatically generate journal for expense
    public function record_expense($expense_id)
    {
        $expense = $this->db->get_where('company_expenses', ['id' => $expense_id])->row_array();
        // Example account IDs: Expense=6, Cash=2
        $lines = [
            ['account_id' => 6, 'debit' => $expense['amount'], 'credit' => 0], // Expense
            ['account_id' => 2, 'debit' => 0, 'credit' => $expense['amount']] // Cash
        ];
        return $this->create_journal_entry($expense['expense_date'], 'Expense', $expense_id, 'expense', $lines);
    }

    // Get trial balance
    public function get_trial_balance($date_to = null)
    {
        $this->db->select('c.id, c.name, c.type, 
            SUM(jl.debit) as total_debit, SUM(jl.credit) as total_credit');
        $this->db->from('chart_of_accounts c');
        $this->db->join('journal_lines jl', 'jl.account_id = c.id', 'left');
        if ($date_to) {
            $this->db->join('journal_entries je', 'je.id = jl.entry_id');
            $this->db->where('je.date <=', $date_to);
        }
        $this->db->group_by('c.id');
        return $this->db->get()->result_array();
    }

    // Get income statement (for a period)
    public function get_income_statement($date_from, $date_to)
    {
        $this->db->select('c.name, SUM(jl.debit) as debit, SUM(jl.credit) as credit');
        $this->db->from('chart_of_accounts c');
        $this->db->join('journal_lines jl', 'jl.account_id = c.id', 'left');
        $this->db->join('journal_entries je', 'je.id = jl.entry_id');
        $this->db->where('je.date >=', $date_from);
        $this->db->where('je.date <=', $date_to);
        $this->db->where_in('c.type', ['Income', 'Expense']);
        $this->db->group_by('c.id');
        return $this->db->get()->result_array();
    }
}