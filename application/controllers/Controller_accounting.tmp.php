<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_accounting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_accounting');
        
        // Check if user is logged in
        if(!$this->session->userdata('logged_in')) {
            redirect('auth/login', 'refresh');
        }

        // Check if user has accounting access
        $user_permission = $this->session->userdata('user_permission');
        if(!in_array('viewAccounting', $user_permission) && !in_array('reportAccounting', $user_permission)) {
            redirect('dashboard', 'refresh');
        }
    }

    public function index()
    {
        $data['title'] = 'Accounting Dashboard';
        $data['page_title'] = 'Accounting';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menubar');
        $this->load->view('accounting/index');
        $this->load->view('templates/footer');
    }

    public function journal_entry()
    {
        $this->load->model('Model_accounts');
        
        $data['title'] = 'Journal Entry';
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
        $this->load->view('templates/side_menubar');
        $this->load->view('accounting/journal_entry', $data);
        $this->load->view('templates/footer');
    }

    public function trial_balance()
    {
        $data['title'] = 'Trial Balance';
        $data['page_title'] = 'Trial Balance';
        
        // Get trial balance data from model
        $this->load->model('Model_accounts');
        $data['trial_balance'] = $this->Model_accounting->get_trial_balance();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menubar');
        $this->load->view('accounting/trial_balance', $data);
        $this->load->view('templates/footer');
    }

    public function income_statement()
    {
        $data['title'] = 'Income Statement';
        $data['page_title'] = 'Income Statement';
        
        // Get income statement data from model
        $data['income_statement'] = $this->Model_accounting->get_income_statement();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menubar');
        $this->load->view('accounting/income_statement', $data);
        $this->load->view('templates/footer');
    }

    public function balance_sheet()
    {
        $data['title'] = 'Balance Sheet';
        $data['page_title'] = 'Balance Sheet';
        
        // Get balance sheet data from model
        $data['balance_sheet'] = $this->Model_accounting->get_balance_sheet();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menubar');
        $this->load->view('accounting/balance_sheet', $data);
        $this->load->view('templates/footer');
    }
}
