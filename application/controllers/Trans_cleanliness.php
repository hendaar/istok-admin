<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_cleanliness extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('Model_trans_cleanliness');
		
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
		$this->load->view('trans_cleanliness');
		$this->load->view('footer');
	}

	function get_data_user()
	{
		$list = $this->Model_trans_cleanliness->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->trans_id;
			$row[] = $field->tgl;
			$row[] = $field->iso4a;
			$row[] = $field->iso6a;
			$row[] = $field->iso14a;
			$row[] = $field->iso4b;
			$row[] = $field->iso6b;
			$row[] = $field->iso14b;
			$row[] = $field->partikel4a;
			$row[] = $field->partikel6a;
			$row[] = $field->partikel14a;
			$row[] = $field->partikel4b;
			$row[] = $field->partikel6b;
			$row[] = $field->partikel14b;
			$row[] = $field->dp1;
			$row[] = $field->dp2;
			$row[] = $field->dp3;
			$row[] = $field->cleanliness_id;

			$datatbl[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Model_trans_cleanliness->count_all(),
			"recordsFiltered" => $this->Model_trans_cleanliness->count_filtered(),
			"data" => $datatbl,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

}
