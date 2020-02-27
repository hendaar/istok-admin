<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_edit extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('Model_user_edit');
		
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
		
		$data_all = $this->Model_user_edit->get_data($id);
		$data['data_all'] = $data_all;

		$data['get_list_enum'] = $this->Model_user_edit->get_list_enum('mst_user', 'user_level');

		$this->load->view('header', $datasesion);
		$this->load->view('user_edit', $data);
		$this->load->view('footer');
	}
	
	public function simpan($id)	{
		// set form validation rules
		$this->form_validation->set_rules('user_name', 'name', 'trim|required');
		$this->form_validation->set_rules('user_name_full', 'name full', 'trim|required');
		$this->form_validation->set_rules('user_email', 'email', 'trim|required');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[user_password]');

		// submit
		if ($this->form_validation->run() == FALSE){
			$this->index($id);
		} else {
			date_default_timezone_set('Asia/Jakarta');
			$data = array(
				'user_name' => $this->input->post('user_name'),
				'user_name_full' => $this->input->post('user_name_full'),
				'user_password' => $this->input->post('user_password'),
				'user_email' => $this->input->post('user_email'),
				'user_level' => $this->input->post('user_level'),
				'status_active' => $this->input->post('status_active')
			);
			
			$user_id = $this->input->post('user_id');
			if ($this->Model_user_edit->update_data($data, $user_id)){
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
