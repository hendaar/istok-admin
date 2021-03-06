<?php

class Model_trans_po_add extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_list_enum($table, $field){
		$query = "SHOW COLUMNS FROM ".$table." LIKE '$field'";
		$row = $this->db->query("SHOW COLUMNS FROM ".$table." LIKE '$field'")->row()->Type;  
		$regex = "/'(.*?)'/";
		
		preg_match_all( $regex , $row, $enum_array );
		$enum_fields = $enum_array[1];
		foreach ($enum_fields as $key=>$value)
		{
			$enums[$value] = $value; 
		}
		return $enums;
	}
	
	public function get_list_material() {
		$this->db->select('mst_material.*');
		$this->db->from('mst_material');
		
		$query = $this->db->get();
		$result = $query->result();

		$list_id = array('');
        $list_name = array('');
        
        for ($i = 0; $i < count($result); $i++) {
            array_push($list_id, $result[$i]->material_id);
            array_push($list_name, $result[$i]->material_code);
        }
        return array_combine($list_id, $list_name);
	}
	
	public function get_list_storage() {
		$this->db->select('mst_storage.*');
		$this->db->from('mst_storage');
		
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
	
	public function get_list_movement_reason() {
		$this->db->select('mst_movement_reason.*');
		$this->db->from('mst_movement_reason');
		
		$query = $this->db->get();
		$result = $query->result();

		$list_id = array('');
        $list_name = array('');
        
        for ($i = 0; $i < count($result); $i++) {
            array_push($list_id, $result[$i]->movement_reason_id);
            array_push($list_name, $result[$i]->movement_reason_id .' - '. $result[$i]->movement_reason_name);
        }
        return array_combine($list_id, $list_name);
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
            array_push($list_name, $result[$i]->vendor_name);
        }
        return array_combine($list_id, $list_name);
	}
        
        public function get_list_barge(){
            $this->db->select('mst_barge.*');
            $this->db->from('mst_barge');
            $this->db->order_by('barge_id');
            
            $query = $this->db->get();
            $result = $query->result();
            
            $list_id = array('');
            $list_name = array('');
            
            for ($i = 0; $i < count($result); $i++){
                array_push($list_id, $result[$i]->barge_id);
                array_push($list_name, $result[$i]->barge_name);
            }
            
            return array_combine($list_id, $list_name);
        }
        
        public function get_list_transporter(){
            $this->db->select('mst_transporter.*');
            $this->db->from('mst_transporter');
            $this->db->order_by('transporter_id');
            
            $query = $this->db->get();
            $result = $query->result();
            
            $list_id = array('');
            $list_name = array('');
            
            for ($i = 0; $i < count($result); $i++){
                array_push($list_id, $result[$i]->transporter_id);
                array_push($list_name, $result[$i]->transporter_name);
            }
            return array_combine($list_id, $list_name);
        }
                
	function get_trans_po($id){
		$this->db->where('trans_id', $id);
        $query = $this->db->get('trans_po');
		return $query->result();
	}
	
	function insert_trans_po($data){
		return $this->db->insert('trans_po', $data);
	}
        
        function insert_schedule_barge($data){
            return $this->db->insert('trans_barge_schedule', $data);
        }

}
