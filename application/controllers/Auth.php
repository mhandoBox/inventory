<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_auth');
	}

	/* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function login()
	{
		$this->logged_in();

		$this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            // Debug: Log form submission
            log_message('debug', 'Login form submitted - Email: ' . $this->input->post('email'));

            $email_exists = $this->model_auth->check_email($this->input->post('email'));

            if ($email_exists == TRUE) {
                $login = $this->model_auth->login($this->input->post('email'), $this->input->post('password'));

                // Debug: Log login attempt result
                log_message('debug', 'Login attempt result: ' . ($login ? 'success' : 'failed'));

                if ($login) {
                    // Fetch the user's role and permissions dynamically
                    $this->db->select('g.group_name AS role, g.permission');
                    $this->db->from('users u');
                    $this->db->join('user_group ug', 'u.id = ug.user_id');
                    $this->db->join('groups g', 'ug.group_id = g.id');
                    $this->db->where('u.id', $login['id']);
                    $query = $this->db->get();
                    
                    // Debug: Log role query
                    log_message('debug', 'Role query: ' . $this->db->last_query());
                    
                    $role = $query->row() ? $query->row()->role : '';

                    // Store user data in session
                    // Get user's store information
                    $this->db->select('s.id as store_id, s.name as store_name');
                    $this->db->from('users u');
                    $this->db->join('stores s', 'u.store_id = s.id');
                    $this->db->where('u.id', $login['id']);
                    $store_query = $this->db->get();
                    $store_data = $store_query->row_array();

                    if (!$store_data) {
                        log_message('error', 'No store assigned to user ID: ' . $login['id']);
                        $this->data['errors'] = 'No store assigned to user. Please contact administrator.';
                        $this->load->view('login', $this->data);
                        return;
                    }

                    $logged_in_sess = array(
                        'id' => $login['id'],
                        'username' => $login['username'],
                        'email' => $login['email'],
                        'role' => $role,
                        'store_id' => $store_data['store_id'],
                        'store_name' => $store_data['store_name'],
                        'user_permission' => is_array($login['permission']) ? $login['permission'] : array(),
                        'logged_in' => TRUE
                    );

                    // Debug: Log session data before setting
                    log_message('debug', 'Setting session data: ' . print_r($logged_in_sess, true));

                    $this->session->set_userdata($logged_in_sess);

                    // Verify session was set
                    if ($this->session->userdata('logged_in')) {
                        log_message('debug', 'Session set successfully, redirecting to dashboard');
                        redirect('dashboard', 'refresh');
                    } else {
                        log_message('error', 'Failed to set session data');
                        $this->data['errors'] = 'Session creation failed';
                        $this->load->view('login', $this->data);
                    }
                } else {
                    log_message('debug', 'Incorrect password for user: ' . $this->input->post('email'));
                    $this->data['errors'] = 'Incorrect username/password combination';
                    $this->load->view('login', $this->data);
                }
            } else {
                log_message('debug', 'Email does not exist: ' . $this->input->post('email'));
                $this->data['errors'] = 'Email does not exist';
                $this->load->view('login', $this->data);
            }
        } else {
            // Debug: Log validation errors if any
            log_message('debug', 'Form validation errors: ' . validation_errors());
            $this->load->view('login');
        }	
	}

	/*
		clears the session and redirects to login page
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login', 'refresh');
	}

	public function forgot_password()
	{
	    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

	    if ($this->form_validation->run() == TRUE) {
	        $email = $this->input->post('email');
	        $user_exists = $this->model_auth->check_email($email);

	        if ($user_exists) {
	            // Here you would generate a reset token and send an email.
	            // For demo, just show a success message.
	            $this->data['success'] = 'A password reset link has been sent to your email address.';
	        } else {
	            $this->data['errors'] = 'Email address not found.';
	        }
	    }

	    $this->load->view('forgot_password', $this->data ?? []);
	}

}
