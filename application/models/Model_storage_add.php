<?php

class Model_storage_add extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_storage($id){
		$this->db->where('storage_name', $id);
        $query = $this->db->get('mst_storage');
		return $query->result();
	}
	
	function insert_storage($data){
		return $this->db->insert('mst_storage', $data);
	}

}
