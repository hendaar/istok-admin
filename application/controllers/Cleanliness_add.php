<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cleanliness_add extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('Model_cleanliness_add');
		
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
		
		$dd_storage = $this->Model_cleanliness_add->get_list_storage();
		$data['dd_storage'] = $dd_storage;
		
		$data['get_list_enum'] = $this->Model_cleanliness_add->get_list_enum('mst_cleanliness', 'cleanliness_type');

		$this->load->view('header', $datasesion);
		$this->load->view('cleanliness_add', $data);
		$this->load->view('footer');
	}
	
	public function simpan() {
		// set form validation rules
		$this->form_validation->set_rules('mdt_code', 'code', 'trim|required');
                $this->form_validation->set_rules('cleanliness_name', 'name', 'trim|required');
		$this->form_validation->set_rules('cleanliness_type', 'type', 'trim|required');
		$this->form_validation->set_rules('storage_id', 'storage', 'trim|required');

		// submit
		if ($this->form_validation->run() == FALSE){
			$this->index();
		} else {
			//Cek User ada/tidak di sascloud
			$cek = $this->Model_cleanliness_add->get_cleanliness($this->input->post('cleanliness_name'));
			if (count($cek) > 0){
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Data already exist</div>');
				redirect('cleanliness_add/index');
			}
			
			date_default_timezone_set('Asia/Jakarta');			
			$data = array(
                                'mdt_code' => $this->input->post('mdt_code'),
				'cleanliness_name' => $this->input->post('cleanliness_name'),
				'cleanliness_type' => $this->input->post('cleanliness_type'),
				'storage_id' => $this->input->post('storage_id')
			);
			if ($this->Model_cleanliness_add->insert_cleanliness($data)) {				
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
