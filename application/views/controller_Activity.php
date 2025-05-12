<?php
class Controller_Activity extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_activity_log');
    }

    public function index()
    {
        if (!in_array('viewActivityLog', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $this->data['logs'] = $this->model_activity_log->getLogs(200);
        $this->render_template('activity_log/index', $this->data);
    }

    public function activate($id)
    {
        if (!in_array('updateUser', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if ($id) {
            $data = array('active' => 1);
            $update = $this->model_users->edit($data, $id);
            if ($update) {
                $this->model_activity_log->log($this->session->userdata('id'), 'Activated Member', 'User ID: ' . $id);
                $this->session->set_flashdata('success', 'Member activated successfully');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred while activating member');
            }
            redirect('Controller_Members/', 'refresh');
        }
    }

    public function deactivate($id)
    {
        if (!in_array('updateUser', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if ($id) {
            $data = array('active' => 0);
            $update = $this->model_users->edit($data, $id);
            if ($update) {
                $this->model_activity_log->log($this->session->userdata('id'), 'Deactivated Member', 'User ID: ' . $id);
                $this->session->set_flashdata('success', 'Member deactivated successfully');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred while deactivating member');
            }
            redirect('Controller_Members/', 'refresh');
        }
    }
}