<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class List_suggest extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session','form_validation'));
        $this->load->database();
        $this->load->model('Model_list_suggest');
        
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
                
               
                
                //$data['list_suggest'] = $this->Model_list_suggest->getListSuggest(0);
                $ddStorage = $this->Model_list_suggest->get_list_storage();
                $data['ddStorage'] = $ddStorage;
                $data['ddYear'] = array(
                    0 => date("Y"),
                    //'2' => date("Y", strtotime("+1 year"))
                ) ;
                $data['ddPeriode'] = array(
                    '1' => 'Yearly',
                    '2' => 'Quarterly',
                    '3' => 'Monthly'
                );
                $curr_month = date("m");
                $next_month = date("m", strtotime("+1 month"));
                $n_next_month = date("m", strtotime("+2 month"));
                $data['ddMonth'] = array(
                    
                    1 => date("F", mktime(0, 0, 0, $curr_month, 10)),
                    2 => date("F", mktime(0, 0, 0, $next_month, 10)),
                    3 => date("F", mktime(0, 0, 0, $n_next_month, 10)),
                );
                
                $data['barge'] = $this->Model_list_suggest->getBargeAvailable();
                
                
                $this->load->view('header', $datasesion);
                $this->load->view('list_suggest', $data);
                $this->load->view('footer');
    }
    
    function get_list_data(){
        $id = $this->input->post('storage_id');
        $month_id = $this->input->post('month');
        $month=0;
        if($month_id == 1){
            $month = date("m");
        } else if($month_id == 2){
            $month = date("m", strtotime("+1 month"));
        } else if ($month_id == 3){
            $month = date("m", strtotime("+2 month"));
        } else {
            $month = date("m");
        }
        $list = $this->Model_list_suggest->getListSuggest($id, $month);
        $data = array();
        $no = 0;
        $img='';
        foreach ($list as $field){
            ($field->po_res_number == NULL)?$img = 'initialized_icon.png':$img = 'confirm_icon.png';
            $t_date = $field->trans_date;
            $loading_time = date('Y-m-d', strtotime($t_date . "+ ". $field->durasi_bongkar. "days"));
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->trans_date;
            $row[] = $field->eta_schedule;
            $row[] = $field->vendor_name;
            $row[] = $field->barge_name;
            $row[] = $field->transporter_name;
            $row[] = $field->po_res_number;
            $row[] = '<a href="'. base_url('list_suggest_confirm/index/'.$field->trans_id).'"><img class="rounded-circle" src="'.base_url().'assets/images/'.$img.'"></a>';
            $row[] = $field->durasi_bongkar;
            $row[] = ($field->po_res_number == NULL)?'': $loading_time;
            
            $datatbl[] = $row;
        }
        
        $ouput = array(
            "draw" => $_POST['draw'],
            "data" => $datatbl
        );
        echo json_encode($ouput);
    }


    public function search(){
        $storage_id = $this->input->post('storage_id');
        $year = $this->input->post('year_id');
        $periode_id = $this->input->post('periode_id');
        $periode = $this->input->post('period');
    }


    public function getForecastById($id){
        //$id = $this->input->post();
        $result = $this->Model_list_suggest->getSuggestById($id);
        echo json_encode($result);
    }
    
    public function sub_period(){
        $period = $this->input->post('id');
        $result='';
        if($period == '2'){
            
            $result = array(
                    
                    
                        '1' => 'Q1',
                        '2' => 'Q2',
                        '3' => 'Q3',
                        '4' => 'Q4'
                    
                    
                );
            //echo json_encode($result);
        } else if($period == '3'){
            
            $result = array(
               
               
                
                    '1' => 'January',
                    '2' => 'February',
                    '3' => 'March',
                    '4' => 'April',
                    '5' => 'May',
                    '6' => 'June',
                    '7' => 'July',
                    '8' => 'August',
                    '9' => 'September',
                    '10'=> 'October',
                    '11'=> 'November',
                    '12'=> 'December'
                
                    
                );
            //echo json_encode($result);
        }
       echo json_encode($result);
                
    }
            
    function confirm(){
        $id = $this->input->post('trans_id');
        $data = array(
            'trans_id' => $this->input->post('trans_id'),
            'storage_id' => $this->input->post('storage_id'),
            'quantity' => $this->input->post('volume'),
            'barge_id' => $this->input->post('po_res_number'),
        );
        $id_barge = $this->input->post('');
        $data_barge = array(
            'durasi_bongkar' => $this->input->post('durasi_bongkar')
        );
        $this->Model_list_suggest->confirm_po($data,$id);
        $this->Model_list_suggest->loading_barge($data_barge,$id_barge);
    }
    
}
?>
