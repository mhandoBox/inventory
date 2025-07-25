<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_accounting extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Create Journal Entry
    public function create_journal_entry($data, $lines) {
        $this->db->trans_start();
        
        // Insert journal entry header
        $entry_data = array(
            'entry_date' => $data['entry_date'],
            'reference_no' => $data['reference_no'],
            'module' => $data['module'],
            'description' => $data['description'],
            'created_by' => $this->session->userdata('id'),
            'created_at' => date('Y-m-d H:i:s')
        );
        
        $this->db->insert('journal_entries', $entry_data);
        $entry_id = $this->db->insert_id();
        
        // Insert journal lines
        foreach ($lines as $line) {
            $line_data = array(
                'journal_entry_id' => $entry_id,
                'account_id' => $line['account_id'],
                'debit' => $line['debit'] ?? 0,
                'credit' => $line['credit'] ?? 0,
                'description' => $line['description'] ?? ''
            );
            $this->db->insert('journal_lines', $line_data);
        }
        
        // Log activity
        $this->log_activity('Created journal entry #' . $entry_id);
        
        $this->db->trans_complete();
        return ($this->db->trans_status() === TRUE) ? $entry_id : FALSE;
    }

    // Get Trial Balance
    public function get_trial_balance($start_date = null, $end_date = null) {
        // Set default dates if not provided
        if ($start_date === null) {
            $start_date = date('Y-01-01'); // First day of current year
        }
        if ($end_date === null) {
            $end_date = date('Y-m-d'); // Current date
        }
        
        $sql = "SELECT 
                    a.account_code,
                    a.account_name,
                    a.category,
                    a.normal_balance,
                    SUM(CASE WHEN je.entry_date BETWEEN ? AND ? THEN COALESCE(jl.debit, 0) ELSE 0 END) as total_debit,
                    SUM(CASE WHEN je.entry_date BETWEEN ? AND ? THEN COALESCE(jl.credit, 0) ELSE 0 END) as total_credit,
                    (CASE 
                        WHEN a.normal_balance = 'Debit' 
                        THEN SUM(CASE WHEN je.entry_date BETWEEN ? AND ? THEN COALESCE(jl.debit, 0) - COALESCE(jl.credit, 0) ELSE 0 END)
                        ELSE SUM(CASE WHEN je.entry_date BETWEEN ? AND ? THEN COALESCE(jl.credit, 0) - COALESCE(jl.debit, 0) ELSE 0 END)
                    END) as balance
                FROM accounts a
                LEFT JOIN journal_lines jl ON a.id = jl.account_id
                LEFT JOIN journal_entries je ON jl.journal_entry_id = je.id
                GROUP BY a.id, a.account_code, a.account_name, a.category, a.normal_balance
                ORDER BY a.category, a.account_code";
                
        // Execute query with parameters repeated for each BETWEEN clause
        $params = array($start_date, $end_date, $start_date, $end_date, $start_date, $end_date, $start_date, $end_date);
        $query = $this->db->query($sql, $params);
        
        if ($query === FALSE) {
            log_message('error', 'Trial Balance query failed: ' . $this->db->error()['message']);
            return array();
        }
        
        $results = $query->result_array();
        
        // Calculate totals
        $totals = array(
            'total_debit' => 0,
            'total_credit' => 0
        );
        
        foreach ($results as $row) {
            $totals['total_debit'] += $row['total_debit'];
            $totals['total_credit'] += $row['total_credit'];
        }
        
        return array(
            'accounts' => $results,
            'totals' => $totals,
            'start_date' => $start_date,
            'end_date' => $end_date
        );
    }

    // Get General Ledger
    public function get_general_ledger($start_date, $end_date, $account_id = null) {
        $this->db->select('je.entry_date, je.reference_no, je.description, jl.debit, jl.credit, a.account_name');
        $this->db->from('journal_entries je');
        $this->db->join('journal_lines jl', 'je.id = jl.journal_entry_id');
        $this->db->join('accounts a', 'jl.account_id = a.id');
        $this->db->where('je.entry_date >=', $start_date);
        $this->db->where('je.entry_date <=', $end_date);
        
        if ($account_id) {
            $this->db->where('jl.account_id', $account_id);
        }
        
        $this->db->order_by('je.entry_date, je.id');
        return $this->db->get()->result();
    }

    // Get Income Statement with comparative data
    public function get_income_statement($start_date, $end_date, $comparative_start = null, $comparative_end = null) {
        // Get current period details
        $result = array();
        
        // Revenue details
        $result['revenue_detail'] = $this->get_account_details('Revenue', $start_date, $end_date);
        $result['total_revenue'] = array_sum(array_column($result['revenue_detail'], 'current_amount'));
        
        // Cost of Sales details
        $result['cos_detail'] = $this->get_account_details('Cost of Goods Sold', $start_date, $end_date);
        $result['total_cos'] = array_sum(array_column($result['cos_detail'], 'current_amount'));
        
        // Expense details
        $result['expense_detail'] = $this->get_account_details('Expense', $start_date, $end_date);
        $result['total_expenses'] = array_sum(array_column($result['expense_detail'], 'current_amount'));
        
        // Calculate profits
        $result['gross_profit'] = $result['total_revenue'] - $result['total_cos'];
        $result['net_profit'] = $result['gross_profit'] - $result['total_expenses'];
        
        // Calculate financial ratios
        $result['gross_profit_margin'] = ($result['total_revenue'] > 0) ? 
            ($result['gross_profit'] / $result['total_revenue'] * 100) : 0;
        $result['operating_expense_ratio'] = ($result['total_revenue'] > 0) ? 
            ($result['total_expenses'] / $result['total_revenue'] * 100) : 0;
        $result['net_profit_margin'] = ($result['total_revenue'] > 0) ? 
            ($result['net_profit'] / $result['total_revenue'] * 100) : 0;

        // Get comparative period data if requested
        if ($comparative_start && $comparative_end) {
            // Revenue comparative
            $comp_revenue = $this->get_account_details('Revenue', $comparative_start, $comparative_end);
            $result['comparative_revenue'] = array_sum(array_column($comp_revenue, 'current_amount'));
            $this->add_comparative_data($result['revenue_detail'], $comp_revenue);
            
            // COS comparative
            $comp_cos = $this->get_account_details('Cost of Goods Sold', $comparative_start, $comparative_end);
            $result['comparative_cos'] = array_sum(array_column($comp_cos, 'current_amount'));
            $this->add_comparative_data($result['cos_detail'], $comp_cos);
            
            // Expenses comparative
            $comp_expenses = $this->get_account_details('Expense', $comparative_start, $comparative_end);
            $result['comparative_expenses'] = array_sum(array_column($comp_expenses, 'current_amount'));
            $this->add_comparative_data($result['expense_detail'], $comp_expenses);
            
            // Comparative profits
            $result['comparative_gross_profit'] = $result['comparative_revenue'] - $result['comparative_cos'];
            $result['comparative_net_profit'] = $result['comparative_gross_profit'] - $result['comparative_expenses'];
            
            // Calculate variances
            $result['revenue_variance'] = $result['total_revenue'] - $result['comparative_revenue'];
            $result['revenue_percent_change'] = ($result['comparative_revenue'] != 0) ? 
                (($result['revenue_variance'] / $result['comparative_revenue']) * 100) : 0;
                
            $result['gross_profit_variance'] = $result['gross_profit'] - $result['comparative_gross_profit'];
            $result['gross_profit_percent_change'] = ($result['comparative_gross_profit'] != 0) ? 
                (($result['gross_profit_variance'] / $result['comparative_gross_profit']) * 100) : 0;
                
            $result['net_profit_variance'] = $result['net_profit'] - $result['comparative_net_profit'];
            $result['net_profit_percent_change'] = ($result['comparative_net_profit'] != 0) ? 
                (($result['net_profit_variance'] / $result['comparative_net_profit']) * 100) : 0;
        }
        
        return $result;
    }

    // Get monthly performance data for charts
    public function get_monthly_performance($start_date, $end_date) {
        $sql = "SELECT 
                    DATE_FORMAT(je.entry_date, '%Y-%m-01') as month,
                    SUM(CASE WHEN a.category = 'Revenue' THEN jl.credit - jl.debit ELSE 0 END) as revenue,
                    SUM(CASE WHEN a.category IN ('Expense', 'Cost of Goods Sold') THEN jl.debit - jl.credit ELSE 0 END) as expenses,
                    SUM(CASE 
                        WHEN a.category = 'Revenue' THEN jl.credit - jl.debit 
                        WHEN a.category IN ('Expense', 'Cost of Goods Sold') THEN jl.credit - jl.debit
                        ELSE 0 
                    END) as profit
                FROM journal_entries je
                JOIN journal_lines jl ON je.id = jl.journal_entry_id
                JOIN accounts a ON jl.account_id = a.id
                WHERE je.entry_date BETWEEN ? AND ?
                GROUP BY month
                ORDER BY month";
        
        return $this->db->query($sql, array($start_date, $end_date))->result();
    }

    // Get detailed account balances for a category
    private function get_account_details($category, $start_date, $end_date) {
        $sql = "SELECT 
                    a.id,
                    a.account_code,
                    a.account_name,
                    SUM(CASE 
                        WHEN a.normal_balance = 'Debit' THEN jl.debit - jl.credit
                        ELSE jl.credit - jl.debit 
                    END) as current_amount
                FROM accounts a
                LEFT JOIN journal_lines jl ON a.id = jl.account_id
                LEFT JOIN journal_entries je ON jl.journal_entry_id = je.id
                WHERE a.category = ?
                AND je.entry_date BETWEEN ? AND ?
                GROUP BY a.id, a.account_code, a.account_name
                HAVING current_amount != 0
                ORDER BY a.account_code";
        
        return $this->db->query($sql, array($category, $start_date, $end_date))->result();
    }

    // Add comparative data to account details
    private function add_comparative_data(&$current_data, $comparative_data) {
        $comp_by_id = array();
        foreach ($comparative_data as $comp) {
            $comp_by_id[$comp->id] = $comp->current_amount;
        }
        
        foreach ($current_data as $account) {
            $account->comparative_amount = isset($comp_by_id[$account->id]) ? $comp_by_id[$account->id] : 0;
            $account->variance = $account->current_amount - $account->comparative_amount;
            $account->percent_change = ($account->comparative_amount != 0) ? 
                (($account->variance / $account->comparative_amount) * 100) : 0;
        }
    }

    // Get Balance Sheet
    public function get_balance_sheet($as_of_date) {
        // Assets
        $assets = $this->get_account_category_balances('Asset', $as_of_date);
        
        // Liabilities
        $liabilities = $this->get_account_category_balances('Liability', $as_of_date);
        
        // Equity
        $equity = $this->get_account_category_balances('Equity', $as_of_date);
        
        return array(
            'assets' => $assets,
            'liabilities' => $liabilities,
            'equity' => $equity,
            'total_assets' => array_sum(array_column($assets, 'balance')),
            'total_liabilities' => array_sum(array_column($liabilities, 'balance')),
            'total_equity' => array_sum(array_column($equity, 'balance'))
        );
    }

    // Helper function to get account category balances
    private function get_account_category_balances($category, $as_of_date) {
        $sql = "SELECT 
                    a.account_code,
                    a.account_name,
                    (SUM(COALESCE(jl.debit, 0)) - SUM(COALESCE(jl.credit, 0))) as balance
                FROM accounts a
                LEFT JOIN journal_lines jl ON a.id = jl.account_id
                LEFT JOIN journal_entries je ON jl.journal_entry_id = je.id
                WHERE a.category = ?
                AND je.entry_date <= ?
                GROUP BY a.id, a.account_code, a.account_name
                ORDER BY a.account_code";
        
        return $this->db->query($sql, array($category, $as_of_date))->result();
    }

    // Helper function to get account category total balance
    private function get_account_category_balance($category, $start_date, $end_date) {
        $sql = "SELECT 
                    SUM(COALESCE(jl.debit, 0)) - SUM(COALESCE(jl.credit, 0)) as balance
                FROM accounts a
                LEFT JOIN journal_lines jl ON a.id = jl.account_id
                LEFT JOIN journal_entries je ON jl.journal_entry_id = je.id
                WHERE a.category = ?
                AND je.entry_date BETWEEN ? AND ?";
        
        $result = $this->db->query($sql, array($category, $start_date, $end_date))->row();
        return $result ? $result->balance : 0;
    }

    // Log activity
    private function log_activity($description) {
        $data = array(
            'user_id' => $this->session->userdata('id'),
            'activity' => $description,
            'created_at' => date('Y-m-d H:i:s'),
            'ip_address' => $this->input->ip_address()
        );
        $this->db->insert('activity_log', $data);
    }
}
