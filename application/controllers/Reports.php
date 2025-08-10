<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Admin_Controller 
{	
	public function __construct()
	{
		parent::__construct();
		$this->data['page_title'] = 'Stores';
		$this->load->model('Model_reporting');
	}

	/* 
    * It redirects to the report page
    * and based on the year, all the orders data are fetch from the database.
    */
	public function index()
	{
		if(!in_array('viewReports', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		
		$today_year = date('Y');

		if($this->input->post('select_year')) {
			$today_year = $this->input->post('select_year');
		}

		$order_data = $this->Model_reporting->getOrderData($today_year);
		$this->data['report_years'] = $this->Model_reporting->getOrderYear();
		
		// Initialize monthly data array
		$monthly_data = array();
		for($i = 1; $i <= 12; $i++) {
			$monthly_data[$i] = 0;
		}

		// Process order data and group by month
		foreach ($order_data as $order) {
			if($order && isset($order['date_time']) && isset($order['gross_amount'])) {
				$month = date('n', strtotime($order['date_time'])); // Get month number (1-12)
				$monthly_data[$month] += floatval($order['gross_amount']);
			}
		}
		
		$this->data['selected_year'] = $today_year;
		$this->data['company_currency'] = $this->company_currency();
		$this->data['results'] = $monthly_data;

		$this->render_template('reports/index', $this->data);
	}
}
