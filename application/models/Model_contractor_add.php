<?php

class Model_contractor_add extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_list_department() {
		$this->db->select('*');
		$this->db->from('mst_department');
		$this->db->order_by('department_name');
		
		$query = $this->db->get();
		$result = $query->result();

		$list_id = array('');
        $list_name = array('');
        
        for ($i = 0; $i < count($result); $i++) {
            array_push($list_id, $result[$i]->department_id);
            array_push($list_name, $result[$i]->department_name);
        }
        return array_combine($list_id, $list_name);
	}
	
	function get_contractor($id){
		$this->db->where('contractor_name', $id);
        $query = $this->db->get('mst_contractor');
		return $query->result();
	}
	
	function insert_contractor($data){
		return $this->db->insert('mst_contractor', $data);
	}

}
