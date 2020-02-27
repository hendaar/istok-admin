<?php

class Model_transporter_add extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_list_vendor() {
		$this->db->select('mst_vendor.*, smartfill_name, smartfill_type');
		$this->db->from('mst_vendor');
		$this->db->join('mst_smartfill', 'mst_vendor.smartfill_id = mst_smartfill.smartfill_id');
		$this->db->order_by('vendor_name');
		
		$query = $this->db->get();
		$result = $query->result();

		$list_id = array('');
        $list_name = array('');
        
        for ($i = 0; $i < count($result); $i++) {
            array_push($list_id, $result[$i]->vendor_id);
            array_push($list_name, $result[$i]->vendor_name.' - '.$result[$i]->smartfill_name.' - '.$result[$i]->smartfill_type);
        }
        return array_combine($list_id, $list_name);
	}
	
	function get_transporter($id){
		$this->db->where('transporter_name', $id);
        $query = $this->db->get('mst_transporter');
		return $query->result();
	}
	
	function insert_transporter($data){
		return $this->db->insert('mst_transporter', $data);
	}

}
