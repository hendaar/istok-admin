<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_po_add extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('Model_trans_po_add');
		
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');

        if ($this->session->userdata('login') == TRUE) {
			if ($this->session->userdata('login_app') <> 'istok-admin') {
				$this->session->sess_destroy();
				redirect('login');
			}
		} else {
			$this->session->sess_destroy();
			redirect('login');
		}
	}

	function index(){
		$datasesion = array(
			'user_id' => $this->session->userdata('user_id'),
			'user_level' => $this->session->userdata('user_level'),
			'user_name' => $this->session->userdata('user_name'),
			'user_name_full' => $this->session->userdata('user_name_full')
		);
	
		$data = array(
			'user_id' => $this->session->userdata('user_id'),
			'user_level' => $this->session->userdata('user_level'),
			'user_name' => $this->session->userdata('user_name'),
			'user_name_full' => $this->session->userdata('user_name_full'),
			'status_active' => 1
		);
		
		$data['get_list_enum'] = $this->Model_trans_po_add->get_list_enum('trans_po', 'type');
		
		$dd_material = $this->Model_trans_po_add->get_list_material();
		$data['dd_material'] = $dd_material;
		
		$dd_storage = $this->Model_trans_po_add->get_list_storage();
		$data['dd_storage'] = $dd_storage;
		
		$dd_movement_reason = $this->Model_trans_po_add->get_list_movement_reason();
		$data['dd_movement_reason'] = $dd_movement_reason;
		
		$dd_vendor = $this->Model_trans_po_add->get_list_vendor();
		$data['dd_vendor'] = $dd_vendor;
                
                $dd_barge = $this->Model_trans_po_add->get_list_barge();
                $data['dd_barge'] = $dd_barge;
                
                $dd_transporter = $this->Model_trans_po_add->get_list_transporter();
                $data['dd_transporter'] = $dd_transporter;
		
		$this->load->view('header', $datasesion);
		$this->load->view('trans_po_add', $data);
		$this->load->view('footer');
	}
	
	public function simpan() {
		// set form validation rules
		// $this->form_validation->set_rules('trans_id', 'ID', 'trim|required');
		$this->form_validation->set_rules('type', 'type', 'trim|required');
		$this->form_validation->set_rules('posting_date', 'posting date', 'trim|required');
		$this->form_validation->set_rules('material_id', 'material_id', 'trim|required');
		$this->form_validation->set_rules('storage_id', 'storage_id', 'trim|required');
		$this->form_validation->set_rules('quantity', 'quantity', 'trim|required');
		// $this->form_validation->set_rules('price', 'price', 'trim|required');
		// $this->form_validation->set_rules('po_res_number', 'po_res_number', 'trim|required');
		// $this->form_validation->set_rules('po_res_item', 'po_res_item', 'trim|required');
		// $this->form_validation->set_rules('movement_reason_id', 'movement_reason_id', 'trim|required');
		// $this->form_validation->set_rules('vendor_id', 'vendor_id', 'trim|required');

		// submit
		if ($this->form_validation->run() == FALSE){
			$this->index();
		} else {
			date_default_timezone_set('Asia/Jakarta');			
			$data = array(
				'trans_id' => $this->input->post('trans_id'),
				'type' => $this->input->post('type'),
				'posting_date' => $this->input->post('posting_date'),
				'material_id' => $this->input->post('material_id'),
				'storage_id' => $this->input->post('storage_id'),
				'quantity' => $this->input->post('quantity'),
				'price' => $this->input->post('price'),
				'po_res_number' => $this->input->post('po_res_number'),
				'po_res_item' => $this->input->post('po_res_item'),
				'movement_reason_id' => $this->input->post('movement_reason_id'),
				'vendor_id' => $this->input->post('vendor_id'),
                                'barge_id' => $this->input->post('barge_id'),
                                'transporter_id ' => $this->input->post('transporter_id'),
				'user_id_update' => $this->session->userdata('user_id'),
				'user_id_update_date' => date('Y-m-d H:i:s')
			);
			if ($this->Model_trans_po_add->insert_trans_po($data)) {
                            $eta_date = new DateTime($this->input->post('posting_date'));
                            $est_bunker = intval($this->input->post('est_bunker_time'));
                            $est_trans = intval($this->input->post('est_transportation_time'));
                            $add_day = $est_bunker + $est_trans;
                            $eta_date->add(new DateInterval('P'.$add_day.'D'));
                            $data_schedule = array(
                                'barge_id' => $this->input->post('barge_id'),
                                'po_ref' => $this->input->post('po_res_number'),
                                'est_bunker_time' => $this->input->post('est_bunker_time'),
                                'est_transportation_time' => $this->input->post('est_transportation_time'),
                                'est_available_date' => $eta_date->format('Y/m/d')
                            );
                            if ($this->Model_trans_po_add->insert_schedule_barge($data_schedule)){
                                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are successfully Added!</div>');
				$this->index();
                            }
				
			} else {
				// error
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again!!!</div>');
				$this->index();
			}
			
		}

	}

}
