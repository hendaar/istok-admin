<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_edit extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('Model_vendor_edit');
		
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
	
	public function index($id)	{
		$datasesion = array(
			'user_id' => $this->session->userdata('user_id'),
			'user_level' => $this->session->userdata('user_level'),
			'user_name' => $this->session->userdata('user_name'),
			'user_name_full' => $this->session->userdata('user_name_full')
		);
		
		$data['id'] = $id;
		
		$data_all = $this->Model_vendor_edit->get_data($id);
		$data['data_all'] = $data_all;

		$dd_smartfill = $this->Model_vendor_edit->get_list_smartfill();
		$data['dd_smartfill'] = $dd_smartfill;
		
		$this->load->view('header', $datasesion);
		$this->load->view('vendor_edit', $data);
		$this->load->view('footer');
	}
	
	public function simpan($id)	{
		// set form validation rules
		$this->form_validation->set_rules('vendor_name', 'name', 'trim|required');
		$this->form_validation->set_rules('smartfill_id', 'smartfill', 'trim|required');

		// submit
		if ($this->form_validation->run() == FALSE){
			$this->index($id);
		} else {
			date_default_timezone_set('Asia/Jakarta');
			$data = array(
				'vendor_name' => $this->input->post('vendor_name'),
				'smartfill_id' => $this->input->post('smartfill_id')
			);
			
			$vendor_id = $this->input->post('vendor_id');
			if ($this->Model_vendor_edit->update_data($data, $vendor_id)){
				$this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are successfully Updated!</div>');
				$this->index($id);
			} else {
				// error
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again!!!</div>');
				$this->index($id);
			}
		}

	}
	
	
}
