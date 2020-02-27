<?php
class Model_list_suggest extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    //public function getListSuggest($id,$year,$period_id,$periode){
    public function getListSuggest($id,$month){
       
        $year = date("Y");
        return $this->db->query("SELECT tf.trans_id, tf.trans_date, tf.eta_schedule,mv.vendor_name, 
                mb.barge_name,mt.transporter_name,tf.po_res_number,mb.durasi_bongkar from trans_forecast tf 
                LEFT JOIN trans_po tp on tf.po_res_number = tp.po_res_number 
                left JOIN mst_vendor mv on tp.vendor_id = mv.vendor_id 
                join mst_barge mb on tf.barge_id = mb.barge_id 
                join mst_transporter mt on mb.transporter_id = mt.transporter_id 
                where tf.barge_id != 0 and tf.storage_id=$id and tf.trans_date LIKE '$year-$month-%' ORDER BY tf.trans_id ASC ")->result();
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
    

    public function getSuggestById($id){
        return $this->db->query("select tf.*,mb.*,mt.transporter_name from trans_forecast tf
                                join mst_barge mb on mb.barge_id = tf.barge_id
                                join mst_transporter mt on mb.transporter_id = mt.transporter_id
                                where tf.trans_id=$id")->result_array();
    }

    public function getBargeAvailable(){
        return $this->db->query("select * from mst_barge limit 5")->result();
    }
    
    public function confirm_po($data){
        
        return $this->db->update('trans_po', $data);
    }
    
    public function loading_barge($data, $id){
        $this->db->where('barge_id', $id);
        return $this->db->update('mst_barge', $data);
    }
}
?>
