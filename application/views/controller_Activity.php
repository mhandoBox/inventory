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
}