<?php

class Model_barge_add extends CI_Model {

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
        
        public function get_list_transporter(){
            $this->db->select('*');
            $this->db->from('mst_transporter');
            
            $query = $this->db->get();
            $result = $query->result();
            
            $list_id = array('');
            $list_name = array('');
            
            for ($i = 0; $i < count($result); $i++){
                array_push($list_id, $result[$i]->transporter_id);
                array_push($list_name, $result[$i]->transporter_name);
            }
            return array_combine($list_id,$list_name);
        }
                
	function max_mst_barge(){
		$this->db->select('MAX(prioritas) as max_id');
		$this->db->from('mst_barge');
		$query = $this->db->get();
		
		$result = $query->row()->max_id;
		return $result;
	}

	function get_barge($id){
		$this->db->where('barge_name', $id);
        $query = $this->db->get('mst_barge');
		return $query->result();
	}
	
	function insert_barge($data){
		return $this->db->insert('mst_barge', $data);
	}

}
