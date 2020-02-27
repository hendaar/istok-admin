<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_contractor_edit extends CI_Model {
	function __construct()
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
	
	function get_data($id) {
		$this->db->select('*');
		$this->db->from('mst_contractor');
		$this->db->where('contractor_id', $id);
		$query = $this->db->get();
		
		$result = array();
		if($query->num_rows() > 0) {
			$result = $query->result();
		}
		return $result;
	}
	
	function update_data($data, $id){
		$this->db->where('contractor_id', $id);
		return $this->db->update('mst_contractor', $data);
	}
	
}?>