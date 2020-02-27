<?php
class Profile extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('Model_profile');
		
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
	
	function index() {
		// set form validation rules
		// $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|alpha|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[user_password]');
		$this->form_validation->set_rules('user_name', 'User Full Name', 'trim|required|min_length[2]|max_length[100]');
		$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
		
		// submit
		if ($this->form_validation->run() == FALSE)
        {
			$datasesion = array(
				'user_id' => $this->session->userdata('user_id'),
				'user_level' => $this->session->userdata('user_level'),
				'user_name' => $this->session->userdata('user_name'),
				'user_name_full' => $this->session->userdata('user_name_full')
			);
			
			//Cek User ada/tidak
			$cek = $this->Model_profile->get_user($this->session->userdata('user_id'));
			if (count($cek)>0){
				$data = array(
					'user_id' => $cek[0]->user_id,
					'user_name' => $cek[0]->user_name,
					'user_name_full' => $cek[0]->user_name_full,
					'user_password' => $cek[0]->user_password,
					'user_email' => $cek[0]->user_email,
					'user_level' => $cek[0]->user_level
				);
			}
			
			$this->load->view('header',$datasesion);
			$this->load->view('profile',$data);
			$this->load->view('footer');
		} else {
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'user_password' => $this->input->post('user_password'),
				'user_name' => $this->input->post('user_name'),
				'user_name_full' => $this->input->post('user_name_full'),
				'user_email' => $this->input->post('user_email')
			);
			
			if ($this->Model_profile->update_user($this->session->userdata('user_id'), $data))
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are successfully updated! Please relogin</div>');
				redirect('profile/index');
			} else {
				// error
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
				redirect('profile/index');
			}
		}
	}
}