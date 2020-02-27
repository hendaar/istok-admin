<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_suggest_confirm extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form','url','html'));
        $this->load->library(array('session','form_validation'));
        $this->load->database();
        $this->load->model('Model_list_suggest_confirm');
        
        if($this->session->userdata('login') == TRUE) {
            if($this->session->userdata('login_app') <> 'istok-admin') {
                $this->session->sess_destroy();
                redirect('login');
            }
        } else {
            $this->session->sess_destroy();
            redirect('login');
        }
    }
    
    public function index($id){
        $datasesion = array(
			'user_id' => $this->session->userdata('user_id'),
			'user_level' => $this->session->userdata('user_level'),
			'user_name' => $this->session->userdata('user_name'),
			'user_name_full' => $this->session->userdata('user_name_full')
		);
        
        $data['id'] = $id;
        
        $data_all = $this->Model_list_suggest_confirm->getData($id);
        $data['data_all'] = $data_all;
        
        $data['dd_vendor'] = $this->Model_list_suggest_confirm->getVendor();
        $data['dd_barge'] = $this->Model_list_suggest_confirm->get_list_barge();
        $data['dd_transporter'] = $this->Model_list_suggest_confirm->get_list_transporter();
        
        $this->load->view('header', $datasesion);
        $this->load->view('list_suggest_confirm', $data);
        $this->load->view('footer');
    }
    
    public function simpan($id){
        $this->form_validation->set_rules('quantity', 'quantity', 'trim|required');
        $this->form_validation->set_rules('po_number', 'po_number', 'trim|required');
        $this->form_validation->set_rules('loading_time', 'loading_time', 'trim|required');
        
        if ($this->form_validation->run() == FALSE){
            $this->index($id);
        } else {
            date_default_timezone_set('Asia/Jakarta');
            
            $trans_id = $this->input->post('trans_id');
            $eta_date = $this->input->post('posting_date');
            $quantity = $this->input->post('quantity');
            $vendor_id = $this->input->post('vendor_id');
            $barge_id = $this->input->post('barge_id');
            $transporter_id = $this->input->post('transporter_id');
            $po_number = $this->input->post('po_number');
            $loading_time = $this->input->post('loading_time');
            $storage_id = $this->input->post('storage_id');
            $po_item = $this->input->post('po_res_item');
            
            $data = array(
                'posting_date' => $eta_date,
                'storage_id' => $storage_id,
                'quantity' => $quantity,
                'po_res_number' => $po_number,
                'po_res_item' => $po_item,
                'vendor_id' => $vendor_id,
                'barge_id' => $barge_id,
                'transporter_id' => $transporter_id
            );
            if($this->Model_list_suggest_confirm->insert_trans_po($data)){
                $available_date = new DateTime($eta_date);
                $durasi = $loading_time + 8;
                $available_date->add(new DateInterval('P'.$durasi.'D'));
                
                $data_barge = array(
                    'durasi_bongkar' => $durasi,
                    'tanggal_bongkar' => $available_date->format('Y-m-d')
                );
                
                if($this->Model_list_suggest_confirm->update_duration_barge($barge_id,$data_barge)){
                    $this->forecast_recalculate($storage_id, $eta_date);
                    $this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are successfully Added!</div>');
                    $this->index($trans_id);
                }
            } else {
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again!!!</div>');
		$this->index();
            }
            
        }
    }
    
    function forecast_recalculate($id_storage,$eta_date){
        
        $data_trans_atg = $this->Model_list_suggest_confirm->get_trans_atg($id_storage);
        $atg_vol =0;
        foreach ($data_trans_atg as $row) {
            $atg_vol += $row->volume; 
        }
        
        $data = array(
            'stock_realtime' => $atg_vol
	);		
	//$this->Model_list_suggest_confirm->update_mst_parameter($data, $id_storage);
        
        $data_mst_parameter = $this->Model_list_suggest_confirm->get_mst_parameter($id_storage);
        $stock_realtime=0; $stock_min=0; $stock_distribution_parameter=0; $stock_distribution_max_parameter=0;
        $reorder_point=0;
        foreach ($data_mst_parameter as $row){
            $stock_realtime = $row->stock_realtime;
            $stock_min = $row->stock_min;
            $stock_distribution_parameter = $row->average_distribution;
            $stock_distribution_max_parameter = $row->average_distribution_max;
            $reorder_point = $row->reorder_point;
        }
        
        /*if ($max_id != null) {
            $trans_id = $max_id;			
	} else {
            $trans_id = 0;
	}*/
        
        $get_idByDate = $this->Model_list_suggest_confirm->get_idforecast_ByDate($id_storage,$eta_date);
        $trans_id=0;
        foreach ($get_idByDate as $value) {
            $trans_id = $value->trans_id;
        }
        
        date_default_timezone_set('Asia/Jakarta');
	$tanggal = date('Y-m-d');
	$tanggal_sekarang = date('Y-m-d');
        
        $max_forecast_byId = $this->Model_list_suggest_confirm->max_forecast_byId($id_storage);
        $next=0;
        //$next_inventory=0;
        //$next_trans_forecast=0;
        $def_barge_id =0;
        for ($i = $trans_id; $i<=$max_forecast_byId;$i++){
            
            
            //$eta_schedule = 0;
            
            $trans_date = date('Y-m-d');
            
            
            $id_before = $this->Model_list_suggest_confirm->get_idtrans_before($i);
            $b_inventory=0; $b_distribution=0;
            foreach ($id_before as $list){
                $b_inventory = $list->inventory;
                $b_distribution = $list->distribution;
            }
            //$stock_distribution = rand($stock_distribution_parameter, $stock_distribution_max_parameter);
            
            if($i == $trans_id){
                $curr_forecast=0;
                $curr_next_forecast=0;
                
                $get_curr_quantity = $this->Model_list_suggest_confirm->get_current_po($eta_date);
                $curr_quantity=0; $curr_barge=0; $curr_po='';  $curr_date = date('Y-m-d');
                foreach ($get_curr_quantity as $row){
                    $curr_date = $row->posting_date;
                    $curr_quantity = $row->quantity;
                    $curr_barge = $row->barge_id;
                    $curr_po = $row->po_res_number;
                    
                }
                
                
                if ($eta_date == $tanggal){
                    $get_curr_forecast = $this->Model_list_suggest_confirm->get_idforecast_ByDate($id_storage,$eta_date);
                    $curr_eta=0; $curr_distribution=0; $curr_inventory=0;
                    foreach ($get_curr_forecast as $values){
                        $curr_inventory = $values->inventory;
                        $curr_distribution = $values->distribution;
                        $curr_eta = $values->eta_schedule;
                    }
                    
                    $curr_data2 = array(
                            
                            'eta_schedule' => $curr_quantity,
                            'barge_id' => $curr_barge,
                            'po_res_number' => $curr_po
                        );
                    if($this->Model_list_suggest_confirm->update_curr_forecast($i, $curr_data2)){
                        $curr_next_forecast = $curr_inventory-$curr_distribution+$curr_quantity;
                        $next_id = $trans_id+1;
                        $curr_data = array(
                            'inventory' => $curr_next_forecast,
                            'barge_id' => 0,
                            'eta_schedule' => 0
                        );
                        $this->Model_list_suggest_confirm->update_curr_forecast($next_id, $curr_data);
                        //$i += 1;
                       $next = 1;
                       $def_barge_id = $curr_barge;
                    }
                    
                } else {
                    $curr_forecast = $b_inventory-$b_distribution+$curr_quantity;
                    $curr_data = array(
                        'inventory' => $curr_forecast,
                        'eta_schedule' => $curr_quantity,
                        'barge_id' => $curr_barge,
                        'po_res_number' => $curr_po  
                      );
                    $this->Model_list_suggest_confirm->update_curr_forecast($i,$curr_data);
                    $def_barge_id=$curr_barge;
                }
            } else if ($next == 1) {
                $next = 0;
            }else {
                    $dec_barge=0;
                    $next_trans_forecast = $this->Model_list_suggest_confirm->get_forecast_ById($i);
                    $eta_schedule=0; $barge_id_next=0;
                    foreach ($next_trans_forecast as $value){
                        $trans_date = $value->trans_date;
                        $eta_schedule = $value->eta_schedule;
                        $barge_id_next = $value->barge_id;
                    }
                    if($eta_schedule != 0){
                        $eta_update = array(
                            'eta_schedule' => 0
                        );
                        //$this->Model_list_suggest_confirm->update_curr_forecast($i,$eta_update);
                        $eta_schedule =0;
                        $dec_barge=1;
                        $barge_id_next;
                    }
                    $next_inventory = $b_inventory-$b_distribution+$eta_schedule;

                   if($next_inventory < $reorder_point){
                        $data_last = $this->Model_list_suggest_confirm->get_trans_forecast_last($id_storage);
                        $prioritas = 0;

                        foreach ($data_last as $row) {
                            $prioritas = $row->prioritas;
                        }

                        $prioritas_max = $this->Model_list_suggest_confirm->max_mst_barge_prioritas($id_storage);
                        if ($prioritas==$prioritas_max) {
                            $prioritas = 0;
                        }
                        
                        $get_barge=0;
                        ($dec_barge==0)?$get_barge=$def_barge_id:$get_barge=$barge_id_next;
                        
                        $data_barge = $this->Model_list_suggest_confirm->get_mst_barge($id_storage, $get_barge);
                        $barge_id_new=0;
                        foreach ($data_barge as $row) {
                            $barge_id_new = $row->barge_id;
                            $eta_schedule = $row->volume;
                        }
                        if(empty($barge_id_new)){
                            $get_def_barge = $this->Model_list_suggest_confirm->get_barge_def($id_storage);
                            foreach ($get_def_barge as $barge){
                                $barge_id_new= $barge->barge_id;
                            }
                        }    
                        $next_inventory = $b_inventory-$b_distribution+$eta_schedule;

                        $data = array(
                            'inventory' => $next_inventory,
                            'eta_schedule' => $eta_schedule,
                            'barge_id' => $barge_id_new
                        );
                        $def_barge_id=$barge_id_new;
                        $this->Model_list_suggest_confirm->update_curr_forecast($i,$data);
                    } else { 
                    //$next_inventory = $b_inventory-$b_distribution+$eta_schedule;

                        $data = array(
                            'inventory' => $next_inventory,
                            'eta_schedule' => $eta_schedule,
                            'barge_id' => 0
                        );

                        $this->Model_list_suggest_confirm->update_curr_forecast($i,$data);
                    }
                }
            }
            
        }
        
    }

?>