<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transporter_edit extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('Model_transporter_edit');
		
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
		
		$data_all = $this->Model_transporter_edit->get_data($id);
		$data['data_all'] = $data_all;

		$dd_vendor = $this->Model_transporter_edit->get_list_vendor();
		$data['dd_vendor'] = $dd_vendor;
		
		$this->load->view('header', $datasesion);
		$this->load->view('transporter_edit', $data);
		$this->load->view('footer');
	}
	
	public function simpan($id)	{
		// set form validation rules
		$this->form_validation->set_rules('transporter_name', 'name', 'trim|required');
		$this->form_validation->set_rules('vendor_id', 'vendor', 'trim|required');

		// submit
		if ($this->form_validation->run() == FALSE){
			$this->index($id);
		} else {
			date_default_timezone_set('Asia/Jakarta');
			$data = array(
				'transporter_name' => $this->input->post('transporter_name'),
				'vendor_id' => $this->input->post('vendor_id')
			);
			
			$transporter_id = $this->input->post('transporter_id');
			if ($this->Model_transporter_edit->update_data($data, $transporter_id)){
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
