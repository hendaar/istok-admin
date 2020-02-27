<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_home extends CI_Model {
	function __construct()
    {
        parent::__construct();
		$this->load->database();
    }
	
	public function get_list_user_all()
	{
		$this->db->select('mst_user.*, branch.branch_name');
		$this->db->from('mst_user');
		$this->db->join('branch', 'mst_user.branch_id = branch.branch_id', 'left');
		$this->db->order_by('branch.branch_name');
		$this->db->order_by('mst_user.user_id');
		
		$query = $this->db->get();
		$result = $query->result();

		$stage_id = array();
        $stage_name = array();
        
        for ($i = 0; $i < count($result); $i++)
        {
            array_push($stage_id, $result[$i]->user_id);
            array_push($stage_name, $result[$i]->branch_name. ' : ' .$result[$i]->user_id. ' - ' .$result[$i]->user_name);
        }
        return array_combine($stage_id, $stage_name);
	}
	
	public function get_list_user($id)
	{
		$this->db->select('*');
		$this->db->from('mst_user');
		$this->db->where('branch_id', $id);
		$this->db->order_by('mst_user.branch_id');
		$this->db->order_by('mst_user.user_id');
		
		$query = $this->db->get();
		$result = $query->result();

		$stage_id = array();
        $stage_name = array();
        
        for ($i = 0; $i < count($result); $i++)
        {
            array_push($stage_id, $result[$i]->user_id);
            array_push($stage_name, $result[$i]->user_id. ' - ' .$result[$i]->user_name);
        }
        return array_combine($stage_id, $stage_name);
	}
	
	// get user SASCloud Report
	function get_user_branch($id){
		$this->db->where('user_id', $id);
        $query = $this->db->get('mst_user');
		
		$result = '';
		if($query->num_rows() > 0) {
			$result = $query->row()->branch_id;
		}
		return $result;
	}
	
	function get_document_name($id){
		$this->db->select('*');
		$this->db->from('activity_file');
        $this->db->where('id', $id);
		$query = $this->db->get();
		
		$result = '';
		if($query->num_rows() > 0) {
			$result = $query->row()->file_name;
		}
		return $result;
	}
	
}?>