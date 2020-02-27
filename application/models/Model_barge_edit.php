<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_barge_edit extends CI_Model {
	function __construct()
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
        
	function get_data($id) {
		$this->db->select('*');
		$this->db->from('mst_barge');
		$this->db->where('barge_id', $id);
		$query = $this->db->get();
		
		$result = array();
		if($query->num_rows() > 0) {
			$result = $query->result();
		}
		return $result;
	}
	
	function update_data($data, $id){
		$this->db->where('barge_id', $id);
		return $this->db->update('mst_barge', $data);
	}
	
}?>