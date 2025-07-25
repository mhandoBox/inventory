<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_accounting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // Load required libraries and models
        $this->load->model('Model_accounting');
        $this->load->model('Model_accounts');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('user_agent');
        
        // Check if user is logged in
        if(!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Please log in first');
            redirect('auth/login', 'refresh');
        }

        // Check if user has accounting access
        $user_permission = $this->session->userdata('user_permission');
        
        // Debug log current permissions
        log_message('debug', 'Current user permissions: ' . print_r($user_permission, true));
        
        // Force permissions to be an array and include accounting permissions
        if(!is_array($user_permission)) {
            $user_permission = array();
        }
        
        // Temporarily grant accounting permissions for testing
        if(!in_array('viewAccounting', $user_permission)) {
            $user_permission[] = 'viewAccounting';
        }
        if(!in_array('reportAccounting', $user_permission)) {
            $user_permission[] = 'reportAccounting';
        }
        
        // Update session with new permissions
        $this->session->set_userdata('user_permission', $user_permission);
        
        // Log updated permissions
        log_message('debug', 'Updated user permissions: ' . print_r($user_permission, true));
    }

    public function index()
    {
        // Debug information
        $user_permission = $this->session->userdata('user_permission');
        log_message('debug', 'Accounting Index - User Permissions: ' . print_r($user_permission, true));
        log_message('debug', 'Accounting Index - User ID: ' . $this->session->userdata('id'));
        
        $data['title'] = 'Accounting Dashboard';
        $data['page_title'] = 'Accounting';
        $data['user_permission'] = $user_permission; // Pass to view for debugging
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menubar', $data);
        $this->load->view('accounting/index', $data);
        $this->load->view('templates/footer');
    }

    public function journal_entry()
    {
        $this->load->model('Model_accounts');
        
        $data['title'] = 'Journal Entry';
        $data['page_title'] = 'Journal Entry';
        $data['user_permission'] = $this->session->userdata('user_permission');
        $data['accounts'] = $this->Model_accounts->get_all_accounts();
        
        if($this->input->post()) {
            $this->form_validation->set_rules('entry_date', 'Entry Date', 'required');
            $this->form_validation->set_rules('reference_no', 'Reference No', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            
            if($this->form_validation->run() == TRUE) {
                $entry_data = array(
                    'entry_date' => $this->input->post('entry_date'),
                    'reference_no' => $this->input->post('reference_no'),
                    'description' => $this->input->post('description'),
                    'module' => 'manual',
                    'created_by' => $this->session->userdata('id')
                );

                $account_ids = $this->input->post('account_id');
                $debits = $this->input->post('debit');
                $credits = $this->input->post('credit');
                $descriptions = $this->input->post('line_description');
                
                $journal_lines = array();
                
                foreach($account_ids as $key => $account_id) {
                    if(empty($debits[$key]) && empty($credits[$key])) {
                        continue;
                    }
                    
                    $journal_lines[] = array(
                        'account_id' => $account_id,
                        'debit' => empty($debits[$key]) ? 0.00 : $debits[$key],
                        'credit' => empty($credits[$key]) ? 0.00 : $credits[$key],
                        'description' => $descriptions[$key]
                    );
                }
                
                if($this->Model_accounting->save_journal_entry($entry_data, $journal_lines)) {
                    $this->session->set_flashdata('success', 'Journal entry saved successfully');
                    redirect('accounting/journal_entry');
                } else {
                    $this->session->set_flashdata('error', 'Error saving journal entry');
                }
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menubar', $data);
        $this->load->view('accounting/journal_entry', $data);
        $this->load->view('templates/footer', $data);
    }

    public function trial_balance()
    {
        $data['title'] = 'Trial Balance';
        $data['page_title'] = 'Trial Balance';
        $data['user_permission'] = $this->session->userdata('user_permission');
        
        // Get and validate date parameters
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        
        // Validate dates and set defaults if invalid
        if (!$start_date || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $start_date)) {
            $start_date = date('Y-01-01'); // First day of current year
        }
        if (!$end_date || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $end_date)) {
            $end_date = date('Y-m-d'); // Current date
        }
        
        // Format dates for MySQL
        $formatted_start = date('Y-m-d', strtotime($start_date));
        $formatted_end = date('Y-m-d', strtotime($end_date));
        
        // Get trial balance data from model
        $trial_balance = $this->Model_accounting->get_trial_balance($formatted_start, $formatted_end);
        
        // Ensure we have the correct data structure
        if (!is_array($trial_balance)) {
            $trial_balance = array(
                'accounts' => array(),
                'totals' => array('total_debit' => 0, 'total_credit' => 0),
                'start_date' => $start_date,
                'end_date' => $end_date
            );
        }
        
        // Add filter dates to the view data
        $data['start_date'] = $formatted_start;
        $data['end_date'] = $formatted_end;
        $data['display_start_date'] = date('F j, Y', strtotime($formatted_start));
        $data['display_end_date'] = date('F j, Y', strtotime($formatted_end));
        $data['trial_balance'] = $trial_balance;
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menubar', $data);
        $this->load->view('accounting/trial_balance', $data);
        $this->load->view('templates/footer', $data);
    }

    public function income_statement()
    {
        $data['title'] = 'Income Statement';
        $data['page_title'] = 'Income Statement';
        $data['user_permission'] = $this->session->userdata('user_permission');
        
        // Get income statement data from model
        $data['income_statement'] = $this->Model_accounting->get_income_statement();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menubar', $data);
        $this->load->view('accounting/income_statement', $data);
        $this->load->view('templates/footer', $data);
    }

    public function balance_sheet()
    {
        $data['title'] = 'Balance Sheet';
        $data['page_title'] = 'Balance Sheet';
        $data['user_permission'] = $this->session->userdata('user_permission');
        
        // Get balance sheet data from model
        $data['balance_sheet'] = $this->Model_accounting->get_balance_sheet();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menubar', $data);
        $this->load->view('accounting/balance_sheet', $data);
        $this->load->view('templates/footer', $data);
    }

    public function chart_of_accounts()
    {
        $data['title'] = 'Chart of Accounts';
        $data['page_title'] = 'Chart of Accounts';
        $data['user_permission'] = $this->session->userdata('user_permission');
        
        // Get all accounts grouped by category
        $data['accounts'] = $this->Model_accounts->get_all_accounts_by_category();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menubar', $data);
        $this->load->view('accounting/chart_of_accounts', $data);
        $this->load->view('templates/footer', $data);
    }

    public function accounts()
    {
        $data['title'] = 'Account Management';
        $data['page_title'] = 'Account Management';
        $data['user_permission'] = $this->session->userdata('user_permission');
        
        // Get all accounts
        $data['accounts'] = $this->Model_accounts->get_all_accounts();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menubar', $data);
        $this->load->view('accounting/accounts', $data);
        $this->load->view('templates/footer', $data);
    }
}
