<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smartfill_edit extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('Model_smartfill_edit');
		
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
		
		$data_all = $this->Model_smartfill_edit->get_data($id);
		$data['data_all'] = $data_all;

		$dd_storage = $this->Model_smartfill_edit->get_list_storage();
		$data['dd_storage'] = $dd_storage;
		
		$data['get_list_enum'] = $this->Model_smartfill_edit->get_list_enum('mst_smartfill', 'smartfill_type');

		$this->load->view('header', $datasesion);
		$this->load->view('smartfill_edit', $data);
		$this->load->view('footer');
	}
	
	public function simpan($id)	{
		// set form validation rules
		$this->form_validation->set_rules('smartfill_name', 'name', 'trim|required');
		$this->form_validation->set_rules('smartfill_type', 'type', 'trim|required');
		$this->form_validation->set_rules('smartfill_serialno', 'serialno', 'trim|required');
		$this->form_validation->set_rules('client_reference', 'client reference', 'trim|required');
		$this->form_validation->set_rules('client_secret', 'client secret', 'trim|required');
		$this->form_validation->set_rules('storage_id', 'storage', 'trim|required');

		// submit
		if ($this->form_validation->run() == FALSE){
			$this->index($id);
		} else {
			date_default_timezone_set('Asia/Jakarta');
			$data = array(
				'smartfill_name' => $this->input->post('smartfill_name'),
				'smartfill_type' => $this->input->post('smartfill_type'),
				'smartfill_serialno' => $this->input->post('smartfill_serialno'),
				'client_reference' => $this->input->post('client_reference'),
				'client_secret' => $this->input->post('client_secret'),
				'storage_id' => $this->input->post('storage_id')
			);
			
			$smartfill_id = $this->input->post('smartfill_id');
			if ($this->Model_smartfill_edit->update_data($data, $smartfill_id)){
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
