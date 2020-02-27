<?php

class Model_material_add extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_material($id){
		$this->db->where('material_name', $id);
        $query = $this->db->get('mst_material');
		return $query->result();
	}
	
	function insert_material($data){
		return $this->db->insert('mst_material', $data);
	}

}
