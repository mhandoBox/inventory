<?php 

class Model_auth extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Ensure database is loaded
        if (!isset($this->db)) {
            $this->load->database();
        }
    }

    /* 
        This function checks if the email exists in the database
    */
    public function check_email($email) 
    {
        if($email) {
            try {
                $sql = 'SELECT * FROM users WHERE email = ?';
                $query = $this->db->query($sql, array($email));
                $result = $query->num_rows();
                
                // Debug: Log email check result
                log_message('debug', 'Email check for: ' . $email . ' - Result: ' . ($result == 1 ? 'found' : 'not found'));
                
                return ($result == 1) ? true : false;
            } catch (Exception $e) {
                log_message('error', 'Database error in check_email: ' . $e->getMessage());
                return false;
            }
        }
        return false;
    }

    /* 
        This function checks if the email and password matches with the database
    */
    public function login($email, $password) 
    {
        try {
            // Debug: Log login attempt
            log_message('debug', 'Login attempt for email: ' . $email);

            // Use query builder with proper escaping
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('email', $email);
            $query = $this->db->get();

            // Debug: Log the executed query
            log_message('debug', 'Login query: ' . $this->db->last_query());

            if($query->num_rows() == 1) {
                $result = $query->row_array();
                
                // Debug: Log user found
                log_message('debug', 'User found: ' . json_encode($result));
                
                // Verify password
                if(password_verify($password, $result['password'])) {
                    // Debug: Log successful login
                    log_message('debug', 'Password verified successfully for user: ' . $result['username']);
                    
                    // Get user permissions
                    $this->db->select('g.group_name, g.permission');
                    $this->db->from('users u');
                    $this->db->join('user_group ug', 'u.id = ug.user_id');
                    $this->db->join('groups g', 'ug.group_id = g.id');
                    $this->db->where('u.id', $result['id']);
                    $group_query = $this->db->get();
                    
                    if ($group_query->num_rows() > 0) {
                        $group_data = $group_query->row_array();
                        $result['role'] = $group_data['group_name'];
                        $result['permission'] = $group_data['permission'];
                        
                        // Debug: Log user permissions
                        log_message('debug', 'User permissions: ' . json_encode($group_data));
                    }
                    
                    return $result;
                }
                
                // Debug: Log failed password verification
                log_message('debug', 'Password verification failed for user: ' . $result['username']);
                return false;
            }
            
            // Debug: Log no user found
            log_message('debug', 'No user found with email: ' . $email);
            return false;
            
        } catch (Exception $e) {
            log_message('error', 'Database error in login: ' . $e->getMessage());
            return false;
        }
    }
}