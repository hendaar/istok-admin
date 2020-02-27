<?php

class Model_parameter_add extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_list_storage() {
		$this->db->select('*');
		$this->db->from('mst_storage');
		$this->db->order_by('storage_name');
		
		$query = $this->db->get();
		$result = $query->result();

		$list_id = array('');
        $list_name = array('');
        
        for ($i = 0; $i < count($result); $i++) {
            array_push($list_id, $result[$i]->storage_id);
            array_push($list_name, $result[$i]->storage_name);
        }
        return array_combine($list_id, $list_name);
	}
	
	function get_parameter($id){
		$this->db->where('parameter_name', $id);
        $query = $this->db->get('mst_parameter');
		return $query->result();
	}
	
	function insert_parameter($data){
		return $this->db->insert('mst_parameter', $data);
	}

}
