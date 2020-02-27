<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('Model_vendor');
		
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
			'user_name_full' => $this->session->userdata('user_name_full')
		);
		
		$this->load->view('header', $datasesion);
		$this->load->view('vendor');
		$this->load->view('footer');
	}

	function get_data_user()
	{
		$list = $this->Model_vendor->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = '<a href="'.base_url('vendor_edit/index/' .$field->vendor_id).'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-exclamation-triangle"></i></a> '.$no;
			$row[] = $field->vendor_id;
			$row[] = $field->vendor_name;
			$row[] = $field->smartfill_id;
			
			$datatbl[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Model_vendor->count_all(),
			"recordsFiltered" => $this->Model_vendor->count_filtered(),
			"data" => $datatbl,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

}
