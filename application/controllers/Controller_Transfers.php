<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Transfers extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        
        $this->data['page_title'] = 'Stock Transfers';
        $this->load->model('model_transfers');
        $this->load->model('model_stores');
        $this->load->model('model_products');
    }

    public function index()
    {
        if(!in_array('viewTransfer', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->data['page'] = 'transfers'; // Add this line to mark active menu
        $store_id = $this->session->userdata('store_id');
        $is_admin = ($this->session->userdata('group_id') == 1);
        
        $this->data['transfers'] = $this->model_transfers->getTransfers(
            $is_admin ? null : $store_id
        );
        
        $this->render_template('transfers/index', $this->data);
    }

    public function create()
    {
        if(!in_array('createTransfer', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->data['page'] = 'transfers';
        $store_id = $this->session->userdata('store_id');
        $is_admin = ($this->session->userdata('group_id') == 1);
        
        $this->data['stores'] = $is_admin ? 
            $this->model_stores->getStoresData() : 
            $this->model_stores->getStoresData($store_id);
            
        $this->data['products'] = $this->model_products->getActiveProductData();
        
        $this->render_template('transfers/create', $this->data);
    }

    public function createTransfer() {
        if (!in_array('createTransfer', $this->permission)) {
            $this->session->set_flashdata('error', 'You do not have permission');
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('from_store_id', 'From Store', 'required');
        $this->form_validation->set_rules('to_store_id', 'To Store', 'required|differs[from_store_id]');
        $this->form_validation->set_rules('product_id', 'Product', 'required');
        $this->form_validation->set_rules('qty', 'Quantity', 'required|numeric|greater_than[0]');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'from_store_id' => $this->input->post('from_store_id'),
                'to_store_id' => $this->input->post('to_store_id'),
                'product_id' => $this->input->post('product_id'),
                'qty' => $this->input->post('qty'),
                'notes' => $this->input->post('notes')
            );

            $create = $this->model_transfers->createTransfer($data);
            if ($create) {
                $this->session->set_flashdata('success', 'Transfer created successfully');
                redirect('Controller_Transfers', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect('Controller_Transfers/create', 'refresh');
            }
        } else {
            $this->create();
        }
    }

    public function update_status($id) {
        if (!in_array('updateTransfer', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $status = $this->input->post('status');
        $update = $this->model_transfers->updateTransferStatus($id, $status);

        if ($update) {
            $this->session->set_flashdata('success', 'Transfer status updated successfully');
        } else {
            $this->session->set_flashdata('error', 'Error occurred!!');
        }

        redirect('transfers', 'refresh');
    }
}