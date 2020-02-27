<?php

class Model_vendor_add extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_list_smartfill() {
		$this->db->select('*');
		$this->db->from('mst_smartfill');
		$this->db->order_by('smartfill_name');
		
		$query = $this->db->get();
		$result = $query->result();

		$list_id = array('');
        $list_name = array('');
        
        for ($i = 0; $i < count($result); $i++) {
            array_push($list_id, $result[$i]->smartfill_id);
            array_push($list_name, $result[$i]->smartfill_name);
        }
        return array_combine($list_id, $list_name);
	}
	
	function get_vendor($id){
		$this->db->where('vendor_name', $id);
        $query = $this->db->get('mst_vendor');
		return $query->result();
	}
	
	function insert_vendor($data){
		return $this->db->insert('mst_vendor', $data);
	}

}
