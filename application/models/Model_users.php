<?php 

class Model_users extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getUserData($userId = null) 
	{
		if($userId) {
			$sql = "SELECT * FROM users WHERE id = ?";
			$query = $this->db->query($sql, array($userId));
			return $query->row_array();
		}

		$sql = "SELECT * FROM users WHERE id != ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getUserGroup($user_id)
	{
	    if(!$user_id) return null;

	    $sql = "SELECT * FROM user_group WHERE user_id = ?";
	    $query = $this->db->query($sql, array($user_id));
	    $result = $query->row_array();

	    if ($result) {
	        // Optionally, fetch group details if needed
	        $group_sql = "SELECT * FROM groups WHERE id = ?";
	        $group_query = $this->db->query($group_sql, array($result['group_id']));
	        $group = $group_query->row_array();
	        if ($group) {
	            $result['group_name'] = $group['group_name'];
	        }
	        return $result;
	    } else {
	        // Return an empty array instead of null
	        return array();
	    }
	}

	public function create($data = '', $group_id = null)
	{

		if($data && $group_id) {
			$create = $this->db->insert('users', $data);

			$user_id = $this->db->insert_id();

			$group_data = array(
				'user_id' => $user_id,
				'group_id' => $group_id
			);

			$group_data = $this->db->insert('user_group', $group_data);

			return ($create == true && $group_data) ? true : false;
		}
	}

	public function edit($data = array(), $id = null, $group_id = null)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('users', $data);

		if($group_id) {
			// user group
			$update_user_group = array('group_id' => $group_id);
			$this->db->where('user_id', $id);
			$user_group = $this->db->update('user_group', $update_user_group);
			return ($update == true && $user_group == true) ? true : false;	
		}
			
		return ($update == true) ? true : false;	
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('users');
		return ($delete == true) ? true : false;
	}

	public function countTotalUsers()
	{
		$sql = "SELECT COUNT(*) as total FROM users";
		$query = $this->db->query($sql);
		
		if($query === FALSE) {
			// Query failed to execute
			log_message('error', 'Database query failed in countTotalUsers: ' . $this->db->error()['message']);
			return 0;
		}
		
		$result = $query->row();
		return $result ? $result->total : 0;
	}
	
}