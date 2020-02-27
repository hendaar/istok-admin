<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contractor_add extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('Model_contractor_add');
		
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
		
		$dd_department = $this->Model_contractor_add->get_list_department();
		$data['dd_department'] = $dd_department;
		
		$this->load->view('header', $datasesion);
		$this->load->view('contractor_add', $data);
		$this->load->view('footer');
	}
	
	public function simpan() {
		// set form validation rules
		$this->form_validation->set_rules('contractor_name', 'name', 'trim|required');
		$this->form_validation->set_rules('department_id', 'department', 'trim|required');

		// submit
		if ($this->form_validation->run() == FALSE){
			$this->index();
		} else {
			//Cek User ada/tidak di sascloud
			$cek = $this->Model_contractor_add->get_contractor($this->input->post('contractor_name'));
			if (count($cek) > 0){
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Data already exist</div>');
				redirect('contractor_add/index');
			}
			
			date_default_timezone_set('Asia/Jakarta');			
			$data = array(
				'contractor_name' => $this->input->post('contractor_name'),
				'department_id' => $this->input->post('department_id')
			);
			if ($this->Model_contractor_add->insert_contractor($data)) {				
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
