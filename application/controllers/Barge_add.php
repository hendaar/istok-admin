<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barge_add extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('Model_barge_add');
		
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
		
		$dd_storage = $this->Model_barge_add->get_list_storage();
		$data['dd_storage'] = $dd_storage;
                
                $dd_transporter = $this->Model_barge_add->get_list_transporter();
                $data['dd_transporter'] = $dd_transporter;
		
		$max_id = $this->Model_barge_add->max_mst_barge();
		if ($max_id != null) {
			$max_id = $max_id;			
		} else {
			$max_id = 0;
		}
		$data['max_id'] = $max_id+1;
		
		$this->load->view('header', $datasesion);
		$this->load->view('barge_add', $data);
		$this->load->view('footer');
	}
	
	public function simpan() {
		// set form validation rules
		$this->form_validation->set_rules('barge_name', 'name', 'trim|required');
		$this->form_validation->set_rules('volume', 'volume', 'trim|required');
		$this->form_validation->set_rules('prioritas', 'priority', 'trim|required');
		$this->form_validation->set_rules('durasi_bongkar', 'durasi bongkar', 'trim|required');
		$this->form_validation->set_rules('storage_id', 'storage', 'trim|required');

		// submit
		if ($this->form_validation->run() == FALSE){
			$this->index();
		} else {
			//Cek User ada/tidak di sascloud
			$cek = $this->Model_barge_add->get_barge($this->input->post('barge_name'));
			if (count($cek) > 0){
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Data already exist</div>');
				redirect('barge_add/index');
			}
			
			date_default_timezone_set('Asia/Jakarta');			
			$data = array(
				'barge_name' => $this->input->post('barge_name'),
				'volume' => $this->input->post('volume'),
				'prioritas' => $this->input->post('prioritas'),
				'durasi_bongkar' => $this->input->post('durasi_bongkar'),
                                'transporter_id' => $this->input->post('transporter_id'),
				'storage_id' => $this->input->post('storage_id')
			);
			if ($this->Model_barge_add->insert_barge($data)) {				
				$this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are successfully Added!</div>');
				$this->index();
			} else {
				// error
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again!!!</div>');
				$this->index();
			}
			
		}

	}

}
