<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user_edit extends CI_Model {
	function __construct()
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
	
	function get_data($id) {
		$this->db->select('*');
		$this->db->from('mst_user');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		
		$result = array();
		if($query->num_rows() > 0) {
			$result = $query->result();
		}
		return $result;
	}
	
	function update_data($data, $id){
		$this->db->where('user_id', $id);
		return $this->db->update('mst_user', $data);
	}
	
}?>