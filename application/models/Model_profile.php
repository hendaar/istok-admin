<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_profile extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }

	// get user 
	function get_user($id) {
		$this->db->where('user_id', $id);
        $query = $this->db->get('mst_user');
		return $query->result();
	}
	
	// update
	function update_user($id, $data) {
		$this->db->where('user_id', $id);
		return $this->db->update('mst_user', $data);
	}
		
}?>