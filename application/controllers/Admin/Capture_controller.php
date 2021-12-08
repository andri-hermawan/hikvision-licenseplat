<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capture_controller extends CI_Controller {

	function __construct() { 
		parent::__construct(); 
		$this->load->model('Admin/Capture_model');
	} 

	public function index () 
	{
		$this->load->view('admin/page_capture'); 
	} 

	function get_capture_all()
	{

		$list = $this->Capture_model->get_datatables_capture();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array(); 
			if ($field->VLICENSEPLAT == 'unknown') {
				$VLICENSEPLAT = 'UNKNOWN';
			}else {
				$VLICENSEPLAT = $field->VLICENSEPLAT;
			}

			$DCREATED_DATE = date('d F Y', strtotime( $field->DCREATED));
			$DCREATED_TIME = date('h:i:s A', strtotime( $field->DCREATED));

			// $row[] = $no;
			$row[] = $field->ID;
			$row[] = $field->VIPCAM;
			$row[] = $field->VLOCATION_NAME;
			$row[] = $VLICENSEPLAT;
			$row[] = $DCREATED_DATE;
			$row[] = $DCREATED_TIME;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Capture_model->count_all_capture(),
			"recordsFiltered" => $this->Capture_model->count_filtered_capture(),
			"data" => $data,
		);
		echo json_encode($output);
	}


	public function test_template () 
	{
		$this->load->view('admin/page_test'); 
	} 

	public function dashboard_page () 
	{
		$data['count_lahat_in']=$this->Capture_model->count_lahat_in();
		$data['count_lahat_out']=$this->Capture_model->count_lahat_out();
		$data['count_sucin_in']=$this->Capture_model->count_sucin_in();
		$data['count_sucin_out']=$this->Capture_model->count_sucin_out();
		$data['count_hauling_inout']=$this->Capture_model->count_hauling_inout();
		$data['get_total_truck']=$this->Capture_model->get_total_truck();
		$data['get_total_location']=$this->Capture_model->get_total_location();

		$data['get_total_all_ritase_today']=$this->Capture_model->get_total_all_ritase_today();
		$data['get_total_hauler_ritase_today']=$this->Capture_model->get_total_hauler_ritase_today();

		$data['get_total_all_tonase_today']=$this->Capture_model->get_total_all_tonase_today();
		$data['get_total_hauler_tonase_today']=$this->Capture_model->get_total_hauler_tonase_today();
		$this->load->view('admin/page_dashboard',$data); 
	} 

	public function report_page () 
	{
		$this->load->view('admin/page_report'); 
	} 

	public function configuration_page () 
	{
		$this->load->view('admin/page_configuration'); 
	} 

	public function detail_page () 
	{
		$data['get_total_truck']=$this->Capture_model->get_total_truck();
		$data['get_total_location']=$this->Capture_model->get_total_location();
		$this->load->view('admin/page_detail',$data); 
	} 

	public function get_data_ritase_today()
	{
		$data = $this->Capture_model->get_data_ritase_today();

		$datax = json_decode(json_encode($data), true);
		$out = [];

		foreach($datax as $element) {
			// $mysqltime = date ('Y-m-d H:i:s', $element['time']);    
			$out[$element['VLOCATION_NAME']][] = ['fvalue' => $element['fvalue'], 'time' => $element['time']];
		}
		echo(json_encode($out));
		
	}

	public function get_data_tonase_today()
	{
		$data = $this->Capture_model->get_data_tonase_today();

		$datax = json_decode(json_encode($data), true);
		$out = [];

		foreach($datax as $element) {
			// $mysqltime = date ('Y-m-d H:i:s', $element['time']);    
			$out[$element['VLOCATION_NAME']][] = ['fvalue' => $element['fvalue'], 'time' => $element['time']];
		}
		echo(json_encode($out));
		
	}


	function get_all_detail_today_by_location($temp)
	{
		$list=$this->Capture_model->get_all_detail_today_by_location($temp);
		$no = 0;
		$data = array();
		foreach($list as $field) {
			$no++;
			$row = array();
			$DCREATED_DATE = date('d F Y', strtotime( $field->DCREATED));
			$DCREATED_TIME = date('h:i:s A', strtotime( $field->DCREATED));

			$row[] = $no;
			$row[] = $field->VLICENSEPLAT;
			$row[] = $field->FVALUE;
			$row[] = $DCREATED_DATE;
			$row[] = $DCREATED_TIME;

			$data[]	= $row;
		}
		$output = array("data"=>$data);
		echo json_encode($output);
	}





















	

	// // AWAL MTDEPARTEMENT
	// public function mtdepartement_index()
	// {
	// 	$bau_cookies 			= $this->input->cookie('bau_cookies',true);
	// 	$r_cookies = json_decode($bau_cookies, true);
	// 	if($r_cookies[0]["department"] == 'LEGAL' OR $r_cookies[0]["department"] == 'IT')
	// 	{
	// 		$this->load->view('admin/page_master_departement',$data);
	// 	}
	// 	else
	// 	{
        
	// 		$this->session->set_flashdata('login_msg', 'failed');
	// 		redirect("Login");
	// 	}
	// }

	

	// function insert_mtdepartement()
	// {
	// 	$add_created = $this->input->post('add_created');
	// 	$add_ad = $this->input->post('add_ad');
	// 	$add_name = $this->input->post('add_name');
		
	
	// 	$data=$this->Master_model->insert_mtdepartement($add_created,$add_ad,$add_name);

	// }

	// function get_mtdepartement_by_id($id)
	// {
	// 	$data=$this->Master_model->get_mtdepartement_by_id($id);
    //     echo json_encode($data);	
	// }

	// function edit_mtdepartement()
	// {
	// 	// $change_ad = $this->input->post('change_ad');
	// 	$change_id = $this->input->post('change_id');
	// 	$change_departement = $this->input->post('change_departement');
	// 	$change_status = $this->input->post('change_status');
	// 	// var_dump(array($change_id,$change_ad,$change_departement,$change_status));
		   
	// 	$data=$this->Master_model->edit_mtdepartement($change_id,$change_departement,$change_status);
	// }

	// function delete_mtdepartement()
	// {
	// 	$delete_id = $this->input->post('delete_id');
	// 	$delete_departement = $this->input->post('delete_departement');
	// 	$data=$this->Master_model->delete_mtdepartement($delete_id,$delete_departement);
	// }

	// // AKHIR MTDEPARTEMENT

	// // AWAL MTCOMPANY
	// public function mtcompany_index()
	// {
	// 	$bau_cookies 			= $this->input->cookie('bau_cookies',true);
	// 	$r_cookies = json_decode($bau_cookies, true);
	// 	if($r_cookies[0]["department"] == 'LEGAL' OR $r_cookies[0]["department"] == 'IT')
	// 	{
	// 		$this->load->view('admin/page_master_company',$data);
	// 	}
	// 	else
	// 	{
        
	// 		$this->session->set_flashdata('login_msg', 'failed');
	// 		redirect("Login");
	// 	}
	// }

	// function get_mtcompany_all()
	// {

	// 	$list = $this->Master_model->get_datatables_mtcompany();
	// 	$data = array();
	// 	$no = $_POST['start'];
	// 	foreach ($list as $field) {
	// 		$no++;
	// 		$row = array(); 
	// 		if($field->VSTATUS == 1){
	// 			$STATUS = 'ACTIVE';
	// 		}else {
	// 			$STATUS = 'NOT ACTIVE';
	// 		}
	// 		$row[] = $no;
	// 		$row[] = $field->ID;
	// 		$row[] = $field->VNAME;
	// 		$row[] = $STATUS;
	// 		$row[] = $field->VUSER;
	// 		$row[] = $field->DCREATED;

	// 		$data[] = $row;
	// 	}

	// 	$output = array(
	// 		"draw" => $_POST['draw'],
	// 		"recordsTotal" => $this->Master_model->count_all_mtcompany(),
	// 		"recordsFiltered" => $this->Master_model->count_filtered_mtcompany(),
	// 		"data" => $data,
	// 	);
	// 	echo json_encode($output);
	// }

	// function insert_mtcompany()
	// {
	// 	$add_created = $this->input->post('add_created');
	// 	$add_ad = $this->input->post('add_ad');
	// 	$add_name = $this->input->post('add_name');
		
	
	// 	$data=$this->Master_model->insert_mtcompany($add_created,$add_ad,$add_name);

	// }

	// function get_mtcompany_by_id($id)
	// {
	// 	$data=$this->Master_model->get_mtcompany_by_id($id);
    //     echo json_encode($data);	
	// }

	// function edit_mtcompany()
	// {
	// 	// $change_ad = $this->input->post('change_ad');
	// 	$change_id = $this->input->post('change_id');
	// 	$change_company = $this->input->post('change_company');
	// 	$change_status = $this->input->post('change_status');
	// 	// var_dump(array($change_id,$change_ad,$change_company,$change_status));
		   
	// 	$data=$this->Master_model->edit_mtcompany($change_id,$change_company,$change_status);
	// }

	// function delete_mtcompany()
	// {
	// 	$delete_id = $this->input->post('delete_id');
	// 	$delete_company = $this->input->post('delete_company');
	// 	$data=$this->Master_model->delete_mtcompany($delete_id,$delete_company);
	// }
	// AKHIR MTCOMPANY

	

	

	
}
