<?php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Accounting_model');
    }

    public function trial_balance()
    {
        $date_to = $this->input->get('date_to'); // Optional filter
        $data['trial_balance'] = $this->Accounting_model->get_trial_balance($date_to);
        $this->load->view('accounting/trial_balance', $data);
    }

    public function income_statement()
    {
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');
        $data['income_statement'] = $this->Accounting_model->get_income_statement($date_from, $date_to);
        $this->load->view('accounting/income_statement', $data);
    }
}