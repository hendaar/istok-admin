<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_storage_edit extends CI_Model {
	function __construct()
    {
        parent::__construct();
		$this->load->database();
    }
	
	function get_data($id) {
		$this->db->select('*');
		$this->db->from('mst_storage');
		$this->db->where('storage_id', $id);
		$query = $this->db->get();
		
		$result = array();
		if($query->num_rows() > 0) {
			$result = $query->result();
		}
		return $result;
	}
	
	function update_data($data, $id){
		$this->db->where('storage_id', $id);
		return $this->db->update('mst_storage', $data);
	}
	
}?>