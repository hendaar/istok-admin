<?php

class Model_department_add extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_department($id){
		$this->db->where('department_name', $id);
        $query = $this->db->get('mst_department');
		return $query->result();
	}
	
	function insert_department($data){
		return $this->db->insert('mst_department', $data);
	}

}
