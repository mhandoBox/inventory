<?php
class Model_activity_log extends CI_Model
{
    public function log($user_id, $activity, $details = null)
    {
        $this->db->insert('activity_log', [
            'user_id' => $user_id,
            'activity' => $activity,
            'details' => $details
        ]);
    }

    public function getLogs($limit = 100)
    {
        $this->db->select('activity_log.*, users.username');
        $this->db->from('activity_log');
        $this->db->join('users', 'users.id = activity_log.user_id', 'left');
        $this->db->order_by('activity_log.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }
}