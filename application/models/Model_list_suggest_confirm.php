<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_list_suggest_confirm extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function getData($id){
        return $this->db->query("select tf.*,mb.*,mt.transporter_name from trans_forecast tf
                                join mst_barge mb on mb.barge_id = tf.barge_id
                                join mst_transporter mt on mb.transporter_id = mt.transporter_id
                                where tf.trans_id=$id")->result();
    }
    
    public function getListStorage(){
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
    
    public function getVendor(){
        $this->db->select('mst_vendor.*');
        $this->db->from('mst_vendor');
        
        $query = $this->db->get();
        $result = $query->result();
        
        $id = array('');
        $name = array('');
        
        for ($i=0;$i<count($result);$i++){
            array_push($id, $result[$i]->vendor_id);
            array_push($name, $result[$i]->vendor_name);
        }
        return array_combine($id, $name);
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
       
    function get_trans_atg($id) {
        date_default_timezone_set('Asia/Jakarta');
        $time = date('H');
        $date = date('Y-m-d');
        
		$this->db->select('trans_atg.volume, trans_atg.ullage, trans_atg.atg_id');
		$this->db->from('trans_atg');
		$this->db->join('mst_atg', 'trans_atg.atg_id = mst_atg.atg_id');
		$this->db->join('mst_storage', 'mst_atg.storage_id = mst_storage.storage_id');
		$this->db->group_by('trans_atg.atg_id');
		$this->db->where('mst_storage.storage_id=', $id);
                $this->db->where('trans_atg.trans_date', $date);
                $this->db->where('trans_atg.trans_time LIKE', $time.':%:%');
		$this->db->order_by('trans_atg.trans_date', 'DESC');
		$this->db->order_by('trans_atg.trans_time', 'DESC');
		// $this->db->limit(1);
		$query = $this->db->get();
		
		$result = array();
		if($query->num_rows() > 0) {
			$result = $query->result();
		}
		return $result;
    }
    
    function update_mst_parameter($data, $id){
	$this->db->where('storage_id', $id);
	return $this->db->update('mst_parameter', $data);
    }
    
    function get_mst_parameter($id) {
		$this->db->select('mst_parameter.*');
		$this->db->from('mst_parameter');
		$this->db->join('mst_storage', 'mst_parameter.storage_id = mst_storage.storage_id');
		$this->db->where('mst_parameter.storage_id=', $id);
		$this->db->order_by('mst_parameter.parameter_id', 'ASC');
		$this->db->limit(1);
		$query = $this->db->get();
		
		$result = array();
		if($query->num_rows() > 0) {
			$result = $query->result();
		}
		return $result;
    }
    
    function max_trans_forecast(){
		$this->db->select('MAX(trans_id) as max_id');
		$this->db->from('trans_forecast');
		$query = $this->db->get();
		
		$result = $query->row()->max_id;
		return $result;
    }
    
    function get_idtrans_before($id){
        $id_b = $id-1;
        return $this->db->query("SELECT * FROM trans_forecast WHERE trans_id=$id_b")->result();
    }
    
    function max_forecast_byId($id){
        $this->db->select('MAX(trans_id) as max_id');
		$this->db->from('trans_forecast');
                $this->db->where('storage_id', $id);
		$query = $this->db->get();
		
		$result = $query->row()->max_id;
		return $result;
    }
    
    function get_forecast_ById($id){
        return $this->db->query("SELECT * FROM trans_forecast WHERE trans_id=$id")->result();
    }
    
    function get_current_po($tanggal){
        return $this->db->query("SELECT * FROM trans_po WHERE posting_date='$tanggal'")->result();
    }
    
   
            
    function update_curr_forecast($id,$data){
        $this->db->where('trans_id', $id);
        return $this->db->update('trans_forecast', $data);
    }
    
    function get_idforecast_ByDate($storage_id,$date){
        return $this->db->query("SELECT * FROM trans_forecast WHERE trans_date='$date' AND storage_id=$storage_id")->result();
    }
    
    function insert_trans_po($data){
		return $this->db->insert('trans_po', $data);
    }
    
    function update_duration_barge($id,$data){
        $this->db->where('barge_id', $id);
        return $this->db->update('mst_barge', $data);
    }
    
    function get_trans_forecast_last($id) {
		$this->db->select('trans_forecast.*, barge_name, prioritas');
		$this->db->from('trans_forecast');
		$this->db->join('mst_storage', 'trans_forecast.storage_id = mst_storage.storage_id');
		$this->db->join('mst_barge', 'trans_forecast.barge_id = mst_barge.barge_id');
		$this->db->where('mst_storage.storage_id=', $id);
		$this->db->order_by('trans_forecast.trans_date', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		
		$result = array();
		if($query->num_rows() > 0) {
			$result = $query->result();
		}
		return $result;
	}
    
    function max_mst_barge_prioritas($id){
		$this->db->select('MAX(prioritas) as max_id');
		$this->db->from('mst_barge');
		$this->db->where('mst_barge.storage_id = ', $id);
		$query = $this->db->get();
		
		$result = $query->row()->max_id;
		return $result;
	}
    
    function get_mst_barge($id,$id2) {
		$this->db->select('mst_barge.*');
		$this->db->from('mst_barge');
		$this->db->where('mst_barge.storage_id = ', $id);
		$this->db->where('mst_barge.prioritas > ', $id2);
		$this->db->order_by('mst_barge.prioritas', 'ASC');
		$this->db->limit(1);
		$query = $this->db->get();
		
		$result = array();
		if($query->num_rows() > 0) {
			$result = $query->result();
		}
		return $result;
	}
    
        function get_barge_def($id){
            return $this->db->query("SELECT * FROM mst_barge WHERE storage_id=$id ORDER by barge_id limit 1")->result();
        }
}
?>

