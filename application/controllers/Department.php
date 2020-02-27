<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('Model_department');
		
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
		$this->load->view('department');
		$this->load->view('footer');
	}

	function get_data_user()
	{
		$list = $this->Model_department->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = '<a href="'.base_url('department_edit/index/' .$field->department_id).'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-exclamation-triangle"></i></a> '.$no;
			$row[] = $field->department_id;
			$row[] = $field->department_name;

			$datatbl[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Model_department->count_all(),
			"recordsFiltered" => $this->Model_department->count_filtered(),
			"data" => $datatbl,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

}
