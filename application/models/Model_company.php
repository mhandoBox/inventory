<?php 

class Model_company extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getCompanyData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM company WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			// Get old image data
			$old_data = $this->getCompanyData($id);
			
			$this->db->where('id', $id);
			$update = $this->db->update('company', $data);
			
			if($update) {
				// Delete old images if new ones were uploaded
				if(!empty($data['logo']) && !empty($old_data['logo'])) {
					$old_logo = FCPATH.'assets/images/'.$old_data['logo'];
					if(file_exists($old_logo)) unlink($old_logo);
				}
				if(!empty($data['image']) && !empty($old_data['image'])) {
					$old_image = FCPATH.'assets/images/'.$old_data['image'];
					if(file_exists($old_image)) unlink($old_image);
				}
				return true;
			}
		}
		return false;
	}


}