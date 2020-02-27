<?php

class Model_user_add extends CI_Model {

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
	
	function get_user($id){
		$this->db->where('user_name', $id);
        $query = $this->db->get('mst_user');
		return $query->result();
	}
	
	function insert_user($data){
		return $this->db->insert('mst_user', $data);
	}

}
