<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parameter_edit extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('Model_parameter_edit');
		
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
		
		$data_all = $this->Model_parameter_edit->get_data($id);
		$data['data_all'] = $data_all;

		$dd_storage = $this->Model_parameter_edit->get_list_storage();
		$data['dd_storage'] = $dd_storage;
		
		$this->load->view('header', $datasesion);
		$this->load->view('parameter_edit', $data);
		$this->load->view('footer');
	}
	
	public function simpan($id)	{
		// set form validation rules
		$this->form_validation->set_rules('parameter_name', 'name', 'trim|required');
		$this->form_validation->set_rules('storage_id', 'storage', 'trim|required');

		// submit
		if ($this->form_validation->run() == FALSE){
			$this->index($id);
		} else {
			date_default_timezone_set('Asia/Jakarta');
			$data = array(
				'parameter_name' => $this->input->post('parameter_name'),
				'lead_time' => $this->input->post('lead_time'),
				'dead_stock' => $this->input->post('dead_stock'),
				'average_distribution' => $this->input->post('average_distribution'),
				'average_distribution_max' => $this->input->post('average_distribution_max'),
				'safety_stock' => $this->input->post('safety_stock'),
				'reorder_point' => $this->input->post('reorder_point'),
				'stock_max' => $this->input->post('stock_max'),
				'stock_min' => $this->input->post('stock_min'),
				'inlet_iso4' => $this->input->post('inlet_iso4'),
				'inlet_iso6' => $this->input->post('inlet_iso6'),
				'inlet_iso14' => $this->input->post('inlet_iso14'),
				'outlet_iso4' => $this->input->post('outlet_iso4'),
				'outlet_iso6' => $this->input->post('outlet_iso6'),
				'outlet_iso14' => $this->input->post('outlet_iso14'),				
				'user_id_update' => $this->session->userdata('user_id'),
				'user_id_update_date' => date('Y-m-d H:i:s'),
				'storage_id' => $this->input->post('storage_id'),
				'barge_volume' => $this->input->post('barge_volume')
			);
			
			$parameter_id = $this->input->post('parameter_id');
			if ($this->Model_parameter_edit->update_data($data, $parameter_id)){
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
