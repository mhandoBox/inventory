<?php 

class Controller_Members extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Members';
		

		$this->load->model('model_users');
		$this->load->model('model_groups');
	}

	
	public function index()
	{
		if(!in_array('viewUser', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$user_data = $this->model_users->getUserData();

		$result = array();
		foreach ($user_data as $k => $v) {

			$result[$k]['user_info'] = $v;

			$group = $this->model_users->getUserGroup($v['id']);
			$result[$k]['user_group'] = $group;
		}

		$this->data['user_data'] = $result;

		$this->render_template('members/index', $this->data);
	}

	public function create()
	{
		if(!in_array('createUser', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->form_validation->set_rules('groups', 'Group', 'required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('fname', 'First name', 'trim|required');
		$this->form_validation->set_rules('store_id', 'Store', 'required'); // <-- Add this line

		if ($this->form_validation->run() == TRUE) {
			// true case
			$password = $this->password_hash($this->input->post('password'));
			$data = array(
				'username' => $this->input->post('username'),
				'password' => $password,
				'email' => $this->input->post('email'),
				'firstname' => $this->input->post('fname'),
				'lastname' => $this->input->post('lname'),
				'phone' => $this->input->post('phone'),
				'gender' => $this->input->post('gender'),
				'store_id' => $this->input->post('store_id'),
			);

			$create = $this->model_users->create($data, $this->input->post('groups'));
			if($create == true) {
				$this->session->set_flashdata('success', 'Successfully created');
				redirect('Controller_Members/', 'refresh');
			}
			else {
				$this->session->set_flashdata('errors', 'Error occurred!!');
				redirect('Controller_Members/create', 'refresh');
			}
		}
		else {
			// false case
			$group_data = $this->model_groups->getGroupData();
			$this->data['group_data'] = $group_data;

			$this->load->model('model_stores'); // <-- Add this line
			$this->data['stores'] = $this->model_stores->getActiveStore(); // <-- Add this line

			$this->render_template('members/create', $this->data);
		}	

		
	}

	public function password_hash($pass = '')
	{
		if($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}

	public function edit($id = null)
	{
		if(!in_array('updateUser', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if(!$id) {
			redirect('Controller_Members', 'refresh');
		}

		$this->form_validation->set_rules('groups', 'Group', 'required');
		$this->form_validation->set_rules('fname', 'First name', 'trim|required');
		$this->form_validation->set_rules('store_id', 'Store', 'required'); // <-- Add this line

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'firstname' => $this->input->post('fname'),
				'lastname' => $this->input->post('lname'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'gender' => $this->input->post('gender'),
				'store_id' => $this->input->post('store_id'), // <-- Add this line
			);

			if($this->input->post('password')) {
				$data['password'] = $this->password_hash($this->input->post('password'));
			}

			$update = $this->model_users->edit($data, $id, $this->input->post('groups'));
			if($update == true) {
				$this->session->set_flashdata('success', 'Successfully updated');
				redirect('Controller_Members/', 'refresh');
			}
			else {
				$this->session->set_flashdata('errors', 'Error occurred!!');
				redirect('Controller_Members/edit/'.$id, 'refresh');
			}
		}
		else {
			$group_data = $this->model_groups->getGroupData();
			$user_data = $this->model_users->getUserData($id);
			$user_group = $this->model_users->getUserGroup($id); // <-- Add this line

			$this->load->model('model_stores');
			$this->data['stores'] = $this->model_stores->getActiveStore();

			$this->data['group_data'] = $group_data;
			$this->data['user_data'] = $user_data;
			$this->data['user_group'] = $user_group; // <-- Add this line
			$this->render_template('members/edit', $this->data);
		}
	}

	public function delete($id)
	{
		if(!in_array('deleteUser', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if($id) {
			if($this->input->post('confirm')) {
					$delete = $this->model_users->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed');
		        		redirect('Controller_Members/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('Controller_Members/delete/'.$id, 'refresh');
		        	}

			}	
			else {
				$this->data['id'] = $id;
				$this->render_template('members/delete', $this->data);
			}	
		}
	}

	public function profile()
	{
		if(!in_array('viewProfile', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$user_id = $this->session->userdata('id');

		$user_data = $this->model_users->getUserData($user_id);
		$this->data['user_data'] = $user_data;

		$user_group = $this->model_users->getUserGroup($user_id);
		$this->data['user_group'] = $user_group;

        $this->render_template('members/profile', $this->data);
	}

	public function setting()
	{	
		if(!in_array('updateSetting', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$id = $this->session->userdata('id');

		if($id) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('fname', 'First name', 'trim|required');


			if ($this->form_validation->run() == TRUE) {
	            // true case
		        if(empty($this->input->post('password')) && empty($this->input->post('cpassword'))) {
		        	$data = array(
		        		'username' => $this->input->post('username'),
		        		'email' => $this->input->post('email'),
		        		'firstname' => $this->input->post('fname'),
		        		'lastname' => $this->input->post('lname'),
		        		'phone' => $this->input->post('phone'),
		        		'gender' => $this->input->post('gender'),
		        	);

		        	$update = $this->model_users->edit($data, $id);
		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'Successfully updated');
		        		redirect('Controller_Members/setting/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('errors', 'Error occurred!!');
		        		redirect('Controller_Members/setting/', 'refresh');
		        	}
		        }
		        else {
		        	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
					$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');

					if($this->form_validation->run() == TRUE) {

						$password = $this->password_hash($this->input->post('password'));

						$data = array(
			        		'username' => $this->input->post('username'),
			        		'password' => $password,
			        		'email' => $this->input->post('email'),
			        		'firstname' => $this->input->post('fname'),
			        		'lastname' => $this->input->post('lname'),
			        		'phone' => $this->input->post('phone'),
			        		'gender' => $this->input->post('gender'),
			        	);

			        	$update = $this->model_users->edit($data, $id, $this->input->post('groups'));
			        	if($update == true) {
			        		$this->session->set_flashdata('success', 'Successfully updated');
			        		redirect('Controller_Members/setting/', 'refresh');
			        	}
			        	else {
			        		$this->session->set_flashdata('errors', 'Error occurred!!');
			        		redirect('Controller_Members/setting/', 'refresh');
			        	}
					}
			        else {
			            // false case
			        	$user_data = $this->model_users->getUserData($id);
			        	$groups = $this->model_users->getUserGroup($id);

			        	$this->data['user_data'] = $user_data;
			        	$this->data['user_group'] = $groups;

			            $group_data = $this->model_groups->getGroupData();
			        	$this->data['group_data'] = $group_data;

						$this->render_template('members/setting', $this->data);	
			        }	

		        }
	        }
	        else {
	            // false case
	        	$user_data = $this->model_users->getUserData($id);
	        	$groups = $this->model_users->getUserGroup($id);

	        	$this->data['user_data'] = $user_data;
	        	$this->data['user_group'] = $groups;

	            $group_data = $this->model_groups->getGroupData();
	        	$this->data['group_data'] = $group_data;

				$this->render_template('members/setting', $this->data);	
	        }	
		}
	}

	public function fetchMembersData()
	{
	    $user_data = $this->model_users->getUserData();
	    $result = array('data' => array());

	    foreach ($user_data as $k => $v) {
	        $group = $this->model_users->getUserGroup($v['id']);
	        $store = '-';
	        if (isset($v['store_id']) && $v['store_id']) {
	            $this->load->model('model_stores');
	            $store_data = $this->model_stores->getStoresData($v['store_id']);
	            if ($store_data) {
	                $store = $store_data['name'];
	            }
	        }

	        // Add Activate/Deactivate button based on active status
	        if (isset($v['active']) && $v['active'] == 1) {
	            $statusBtn = '<a href="'.base_url('Controller_Members/deactivate/'.$v['id']).'" class="btn btn-default btn-sm">Deactivate</a>';
	        } else {
	            $statusBtn = '<a href="'.base_url('Controller_Members/activate/'.$v['id']).'" class="btn btn-success btn-sm">Activate</a>';
	        }

	        $buttons = '
	            <a href="'.base_url('Controller_Members/edit/'.$v['id']).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
	            <a href="'.base_url('Controller_Members/delete/'.$v['id']).'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
	            '.$statusBtn;

	        $result['data'][] = array(
	            $v['username'],
	            $v['email'],
	            $v['firstname'] . ' ' . $v['lastname'],
	            $v['phone'],
	            $store,
	            $group ? $group['group_name'] : '-',
	            $buttons
	        );
	    }

	    echo json_encode($result);
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
	            $this->session->set_flashdata('success', 'Member deactivated successfully');
	        } else {
	            $this->session->set_flashdata('errors', 'Error occurred while deactivating member');
	        }
	        redirect('Controller_Members/', 'refresh');
	    }
	}


}