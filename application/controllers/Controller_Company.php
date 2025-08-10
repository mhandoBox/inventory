<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Company extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Company';

		$this->load->model('model_company');
	}

    /* 
    * It redirects to the company page and displays all the company information
    * It also updates the company information into the database if the 
    * validation for each input field is successfully valid
    */
	public function index()
	{  
        $this->data['can_edit_company'] = in_array('updateCompany', $this->permission);

        if(!in_array('updateCompany', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$this->form_validation->set_rules('company_name', 'Company name', 'trim|required');
		$this->form_validation->set_rules('registration', 'Registration Number', 'trim|required|integer');
		$this->form_validation->set_rules('tin', 'TIN Number', 'trim|required');
		$this->form_validation->set_rules('service_charge_value', 'Charge Amount', 'trim|integer');
		$this->form_validation->set_rules('vat_charge_value', 'Vat Charge', 'trim|integer');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
	
	
        if ($this->form_validation->run() == TRUE) {
            // Prepare base data
            $data = array(
                'company_name' => $this->input->post('company_name'),
                'registration' => $this->input->post('registration'),
                'tin' => $this->input->post('tin'),
                'service_charge_value' => $this->input->post('service_charge_value'),
                'vat_charge_value' => $this->input->post('vat_charge_value'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'country' => $this->input->post('country'),
                'message' => $this->input->post('message'),
                'currency' => $this->input->post('currency')
            );

            // Handle logo upload
            if(!empty($_FILES['logo']['name'])) {
                $config['upload_path'] = './assets/images/company/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 2048; // 2MB
                $config['file_name'] = 'logo_'.time();

                $this->load->library('upload', $config);
                
                if($this->upload->do_upload('logo')) {
                    $upload_data = $this->upload->data();
                    $data['logo'] = 'company/'.$upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('Controller_Company/index', 'refresh');
                }
            }

            // Handle company image upload
            if(!empty($_FILES['image']['name'])) {
                $config['upload_path'] = './assets/images/company/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 5120; // 5MB
                $config['file_name'] = 'company_'.time();

                $this->upload->initialize($config);

                if($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $data['image'] = 'company/'.$upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('Controller_Company/index', 'refresh');
                }
            }

            // Update company data
            $update = $this->model_company->update($data, 1);
            if($update == true) {
                $this->session->set_flashdata('success', 'Company information updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Error occurred while updating company information');
            }
            redirect('Controller_Company/index', 'refresh');
        }
        
        $this->data['currency_symbols'] = $this->currency();
    	$this->data['company_data'] = $this->model_company->getCompanyData(1);
		$this->render_template('company/index', $this->data);			
    }	

}