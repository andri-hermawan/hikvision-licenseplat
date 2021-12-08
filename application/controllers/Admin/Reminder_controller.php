<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reminder_controller extends CI_Controller {

	function __construct() { 
		parent::__construct(); 
		$this->load->model('Admin/Reminder_model');
		$this->load->model('Admin/Master_model');
		$this->load->helper('form');
		$this->load->library('Pdf');
		date_default_timezone_set('Asia/Jakarta');
	} 

	public function datatables_test()
	{
		
		$bau_cookies 			= $this->input->cookie('bau_cookies',true);
		$r_cookies = json_decode($bau_cookies, true);
		if($r_cookies[0]["department"] == 'LEGAL' OR $r_cookies[0]["department"] == 'IT')
		{
			$this->load->model('Admin/Master_model');
			$data['show_all_company'] = $this->Master_model->show_all_company();
			$data['show_all_departement'] = $this->Master_model->show_all_departement();
			$this->load->view('admin/page_datatables_test', $data);
		}
		else
		{
			$this->session->set_flashdata('login_msg', 'failed');
			redirect("login");
		}
	}

	public function index()
	{
		
		$bau_cookies 			= $this->input->cookie('bau_cookies',true);
		$r_cookies = json_decode($bau_cookies, true);
		if($r_cookies[0]["department"] == 'LEGAL' OR $r_cookies[0]["department"] == 'IT')
		{
			$this->load->model('Admin/Master_model');
			$data['show_all_company'] = $this->Master_model->show_all_company();
			$data['show_all_departement'] = $this->Master_model->show_all_departement();
			$data['show_all_email'] = $this->Master_model->show_all_email();
			$this->load->view('admin/page_reminder', $data);
		}
		else
		{
			$this->session->set_flashdata('login_msg', 'failed');
			redirect("login");
		}
	}

	function get_reminder_all()
	{

		$list = $this->Reminder_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array(); 
			$row[] = $no;
			$row[] = $field->ID;
			$row[] = $field->VAGREEMENT;
			$row[] = $field->VADDENDUM;
			$row[] = date('d-F-Y', strtotime($field->DSTART));
			$row[] = date('d-F-Y', strtotime($field->DEND));
			$row[] = $field->VPARTIES;
			$row[] = $field->VSUBJECT;
			$row[] = $field->VCOMPANY_NAME;
			$row[] = $field->VDEPARTEMENT_NAME;
			$row[] = $field->VHEADER;
			$row[] = $field->VTIME_PERIODE_STATUS;
			$row[] = $field->VUSER_DISCUSSION;
			$row[] = $field->VREMARK;
			$row[] = $field->VUSER_AD;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Reminder_model->count_all(),
			"recordsFiltered" => $this->Reminder_model->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	function get_reminder_by_id($id)
	{
		$data=$this->Reminder_model->get_reminder_by_id($id);
        echo json_encode($data);	
	}

	function get_reminder_by_agreement($temp)
	{
		$tempt = str_replace("u1","/",$temp);
		$list=$this->Reminder_model->get_reminder_by_agreement($tempt);
		
		$data = array();
		foreach($list as $field) {
			$no++;
			$row = array();
			
			$row[] = $no;
			$row[] = rtrim($field->ID);
			$row[] = rtrim($field->VAGREEMENT);
			$row[] = rtrim($field->VADDENDUM);
			$row[] = date('d-F-Y', strtotime($field->DSTART));
			$row[] = date('d-F-Y', strtotime($field->DEND));
			$row[] = rtrim($field->VPARTIES);
			$row[] = rtrim($field->VSUBJECT);
			$row[] = rtrim($field->VUSER);
			$row[] = rtrim($field->VTIME_PERIODE_STATUS);
			$row[] = rtrim($field->VUSER_DISCUSSION);
			$row[] = rtrim($field->VREMARK);
			$row[] = rtrim($field->VUSER_AD);

			$data[]	= $row;
		}
		$output = array("data"=>$data);
		echo json_encode($output);
	}

	function insert_agreement()
	{
		$add_email = $this->input->post('add_email');
		$add_created = $this->input->post('add_created');
		$add_ad = $this->input->post('add_ad');
		$add_agreement = $this->input->post('add_agreement');
		$add_addendum = $this->input->post('add_addendum');
		$add_start = $this->input->post('add_start');
		$add_end = $this->input->post('add_end');
		$add_parties = $this->input->post('add_parties');
		$add_subject = $this->input->post('add_subject');
		$add_company = $this->input->post('add_company');
		$add_user = $this->input->post('add_user');
		$add_time_periode = 'VALID'; //$this->input->post('add_time_periode');
		$add_user_discussion = 'NONE';// $this->input->post('add_user_discussion');
		$add_remark = $this->input->post('add_remark');
		$data=$this->Reminder_model->insert_agreement($add_email,$add_created,$add_ad,$add_agreement,$add_addendum,$add_start,$add_end,$add_parties,$add_subject,$add_company,$add_user,$add_time_periode,$add_user_discussion,$add_remark);

	}

	function insert_addendum()
	{
		$add_addendum_email = $this->input->post('add_addendum_email');
		$add_addendum_created = $this->input->post('add_addendum_created');
		$add_addendum_ad = $this->input->post('add_addendum_ad');
		$add_addendum_agreement = $this->input->post('add_addendum_agreement');
		$add_addendum_addendum = $this->input->post('add_addendum_addendum');
		$add_addendum_start = $this->input->post('add_addendum_start');
		$add_addendum_end = $this->input->post('add_addendum_end');
		$add_addendum_parties = $this->input->post('add_addendum_parties');
		$add_addendum_subject = $this->input->post('add_addendum_subject');
		$add_addendum_company = $this->input->post('add_addendum_company');
		$add_addendum_user = $this->input->post('add_addendum_user');
		// $add_addendum_time_periode =  $this->input->post('add_addendum_time_periode');
		// $add_addendum_user_discussion = $this->input->post('add_addendum_user_discussion');
		$add_addendum_remark = $this->input->post('add_addendum_remark');
		$data=$this->Reminder_model->insert_addendum($add_addendum_email,$add_addendum_created,$add_addendum_ad,$add_addendum_agreement,$add_addendum_addendum,$add_addendum_start,$add_addendum_end,$add_addendum_parties,$add_addendum_subject,$add_addendum_company,$add_addendum_user,$add_addendum_remark); //$add_addendum_time_periode,$add_addendum_user_discussion,
	}

	function edit_user_discussion_status()
	{
    
		$change_email = $this->input->post('change_email');
		$change_id = $this->input->post('change_id');
		$change_agreement = $this->input->post('change_agreement');
		$change_addendum = $this->input->post('change_addendum');
		$change_start = $this->input->post('change_start');
		$change_end = $this->input->post('change_end');
		$change_parties = $this->input->post('change_parties');
		$change_subject = $this->input->post('change_subject');
		$change_company = $this->input->post('change_company');
		$change_user = $this->input->post('change_user');
		$change_time_periode = $this->input->post('change_time_periode');
		$change_user_discussion = $this->input->post('change_user_discussion');
		$change_remark = $this->input->post('change_remark');
		$change_ad = $this->input->post('change_ad');
    // var_dump(array($change_id,$change_agreement,$change_addendum,$change_start,$change_end,$change_parties,$change_subject,$change_user,$change_time_periode,$change_user_discussion,$change_remark,$change_ad));
		$data=$this->Reminder_model->edit_user_discussion_status($change_email, $change_id,$change_agreement,$change_addendum,$change_start,$change_end,$change_parties,$change_subject,$change_company,$change_user,$change_time_periode,$change_user_discussion,$change_remark,$change_ad);
	}

	function delete_agreement()
	{
		$delete_id = $this->input->post('delete_id');
		$delete_agreement = $this->input->post('delete_agreement');
		$data=$this->Reminder_model->delete_agreement($delete_id,$delete_agreement);
	}

	public function print_excel1 ()
	{
		header("Content-type=application/vnd.ms.excel");
		header("Content-disposition: attachment; filename= RECAP PERJANJIAN BAU OPERASIONAL.xls");
		$data['show_reminder']=$this->Reminder_model->show_reminder(0,1000000);
		$this->load->view('admin/print_excel', $data); 
	}

	public function print_excel () 
	{
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Create a first sheet, representing sales data
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "NO"); 
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "AGREEMENT"); 
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "ADDENDUM"); 
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "START"); 
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "END"); 
		$objPHPExcel->getActiveSheet()->setCellValue('F1', "DEALING WITH / PARTIES"); 
		$objPHPExcel->getActiveSheet()->setCellValue('G1', "SUBJECT"); 
		$objPHPExcel->getActiveSheet()->setCellValue('H1', "USER"); 
		$objPHPExcel->getActiveSheet()->setCellValue('I1', "TIME PERIODE STATUS"); 
		$objPHPExcel->getActiveSheet()->setCellValue('J1', "USER DISCUSSION"); 

		$all_akta = $this->Reminder_model->show_reminder();

		$no = 0; 
		$numrow = 2; 
		foreach($all_akta as $data){ 
			if($data->RIN==1)
			{
				$no++;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numrow, $no);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numrow, $data->AGREEMENT);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numrow, $data->VADDENDUM);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numrow, $data->DSTART);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numrow, $data->DEND);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numrow, $data->VPARTIES);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numrow, $data->VSUBJECT);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numrow, $data->VDEPARTMENT_NAME);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$numrow, $data->VTIME_PERIODE_STATUS);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$numrow, $data->VUSER_DISCUSSION);
			}else 
			{
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numrow, ' ');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numrow, $data->AGREEMENT);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numrow, $data->VADDENDUM);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numrow, $data->DSTART);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numrow, $data->DEND);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numrow, $data->VPARTIES);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numrow, $data->VSUBJECT);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numrow, $data->VDEPARTMENT_NAME);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$numrow, $data->VTIME_PERIODE_STATUS);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$numrow, $data->VUSER_DISCUSSION);
			}
			// var_dump($data->VCOMPANY);
			
			
			// $no++; 
			$numrow++;
		}
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(45); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12); 
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);




		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('ALL');

	// 	// Create a new worksheet, after the default sheet
		$objPHPExcel->createSheet();

	// 	// Add some data to the second sheet, resembling some different data types
		$objPHPExcel->setActiveSheetIndex(1);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "NO"); 
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "AGREEMENT"); 
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "ADDENDUM"); 
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "START"); 
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "END"); 
		$objPHPExcel->getActiveSheet()->setCellValue('F1', "DEALING WITH / PARTIES"); 
		$objPHPExcel->getActiveSheet()->setCellValue('G1', "SUBJECT"); 
		$objPHPExcel->getActiveSheet()->setCellValue('H1', "USER"); 
		$objPHPExcel->getActiveSheet()->setCellValue('I1', "TIME PERIODE STATUS"); 
		$objPHPExcel->getActiveSheet()->setCellValue('J1', "USER DISCUSSION"); 

	
		$all_akta1 = $this->Reminder_model->show_reminder_active();

		$no1 = 0; 
		$numrow1 = 2; 
		foreach($all_akta1 as $data1){ 
			if($data1->RIN==1)
			{
				$no1++;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numrow1, $no1);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numrow1, $data1->AGREEMENT);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numrow1, $data1->VADDENDUM);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numrow1, $data1->DSTART);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numrow1, $data1->DEND);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numrow1, $data1->VPARTIES);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numrow1, $data1->VSUBJECT);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numrow1, $data1->VDEPARTMENT_NAME);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$numrow1, $data1->VTIME_PERIODE_STATUS);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$numrow1, $data1->VUSER_DISCUSSION);
			}else 
			{
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numrow1, ' ');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numrow1, $data1->AGREEMENT);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numrow1, $data1->VADDENDUM);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numrow1, $data1->DSTART);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numrow1, $data1->DEND);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numrow1, $data1->VPARTIES);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numrow1, $data1->VSUBJECT);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numrow1, $data1->VDEPARTMENT_NAME);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$numrow1, $data1->VTIME_PERIODE_STATUS);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$numrow1, $data1->VUSER_DISCUSSION);
			}
			// var_dump($data->VCOMPANY);
			
			
			// $no++; 
			$numrow1++;
		}

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(45); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);  
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Rename 2nd sheet
		$objPHPExcel->getActiveSheet()->setTitle('ACTIVE');

	// 	// Create a new worksheet, after the default sheet
		$objPHPExcel->createSheet();

	// 	// Add some data to the second sheet, resembling some different data types
		$objPHPExcel->setActiveSheetIndex(2);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "NO"); 
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "AGREEMENT"); 
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "ADDENDUM"); 
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "START"); 
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "END"); 
		$objPHPExcel->getActiveSheet()->setCellValue('F1', "DEALING WITH / PARTIES"); 
		$objPHPExcel->getActiveSheet()->setCellValue('G1', "SUBJECT"); 
		$objPHPExcel->getActiveSheet()->setCellValue('H1', "USER"); 
		$objPHPExcel->getActiveSheet()->setCellValue('I1', "TIME PERIODE STATUS"); 
		$objPHPExcel->getActiveSheet()->setCellValue('J1', "USER DISCUSSION");

		$all_akta2 = $this->Reminder_model->show_reminder_close();

		$no2 = 0; 
		$numrow2 = 2; 
		foreach($all_akta2 as $data2){ 
			if($data2->RIN==1)
			{
				$no2++;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numrow2, $no2);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numrow2, $data2->AGREEMENT);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numrow2, $data2->VADDENDUM);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numrow2, $data2->DSTART);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numrow2, $data2->DEND);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numrow2, $data2->VPARTIES);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numrow2, $data2->VSUBJECT);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numrow2, $data2->VDEPARTMENT_NAME);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$numrow2, $data2->VTIME_PERIODE_STATUS);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$numrow2, $data2->VUSER_DISCUSSION);
			}else 
			{
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numrow2, ' ');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numrow2, $data2->AGREEMENT);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numrow2, $data2->VADDENDUM);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numrow2, $data2->DSTART);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numrow2, $data2->DEND);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numrow2, $data2->VPARTIES);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numrow2, $data2->VSUBJECT);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numrow2, $data2->VDEPARTMENT_NAME);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$numrow2, $data2->VTIME_PERIODE_STATUS);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$numrow2, $data2->VUSER_DISCUSSION);
			}
			// var_dump($data->VCOMPANY);
			
			
			// $no++; 
			$numrow2++;
		}

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(45); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12); 
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Rename 2nd sheet
		$objPHPExcel->getActiveSheet()->setTitle('CLOSE');


		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="RECAP PERJANJIAN BAU OPERASIONAL.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		redirect('Admin/Reminder_controller/index', 'refresh');
	}

	public function print_excel_by_agreement($temp)
	{
		$tempt = str_replace("u1","/",$temp);
		header("Content-type=application/vnd.ms.excel");
		header("Content-disposition: attachment; filename= RECAP PERJANJIAN BAU OPERASIONAL.xls");
		$data['show_reminder_by_agreement']=$this->Reminder_model->show_reminder_by_agreement($tempt);
		$this->load->view('admin/print_excel_by_agreement', $data);
		// var_dump($temp);
	}

	public function print_pdf()
	{
		$data['show_reminder']=$this->Reminder_model->show_reminder(0,1000000);
		$this->load->view('admin/print_pdf', $data); 
	}

	public function print_pdf_by_agreement($temp)
	{
		$tempt = str_replace("u1","/",$temp);
		$data['show_reminder_by_agreement']=$this->Reminder_model->show_reminder_by_agreement($tempt);
		$this->load->view('admin/print_pdf_by_agreement', $data); 
	}

	public function check_email ()
	{
		$data['check_status_close']=$this->Reminder_model->check_status_close();
		$data['check_reminder']=$this->Reminder_model->check_reminder();
    	
	}

	public function send_mail() 
	{

		$data['get_reminder']=$this->Reminder_model->get_reminder();
		foreach($data['get_reminder'] as $list)
		{
			$from_email = $list['VFROM'];   //noreply@baragroup.id
			$to_email = $list['VTO']; //andri.hermawan.skom@gmail.com
			$to_cc = $list['VCC']; //andri.hermawan.skom@gmail.com
			$to_subject= $list['VSUBJECT']; // OPERATIONAL
			$to_departement = $list['VUSER']; //2

			$to_agreement = $list['VAGREEMENT'];
			$to_addendum = $list['VADDENDUM'];
			$to_parties = $list['VPARTIES']; 
			$to_end = $list['DEND']; 
			$to_template = $list['VTEMPLATE'];
			$to_subject_email= $list['VSUBJECT_EMAIL']; 
			
			
			// var_dump(array($from_email,$to_email,$to_cc,$to_subject,$to_departement));

			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.hostinger.co.id',
				'smtp_port' => 465,
				'smtp_user' => $from_email,
				'smtp_pass' => 'Bara654321!@#$%^',
				'mailtype'  => 'html', 
				'charset'   => 'iso-8859-1'
			);

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");  
			$this->email->set_mailtype("html"); 

			$cobaja = "
				<table width=\"100%\" border=\"1px solid black\">
				<tr>
				<td width=\"15%\">Kontrak / Perjanjian</td>
				<td width=\"85%\">$to_subject</td>
				</tr>
				<tr>
				<td>Nomor Agreement</td>
				<td>$to_agreement</td>
				</tr>
				<tr>
				<td>Nomor Addendum</td>
				<td>$to_addendum</td>
				</tr>
				<tr>
				<td>Antara BAU Dengan</td>
				<td>$to_parties</td>
				</tr>
				<tr>
				<td>Berlaku Hingga</td>
				<td> ".date('d-F-Y', strtotime($to_end))." </td>
				</tr>
				</table>
			";

			$msg = str_replace("JANGAN_DIHAPUS_INI_ADALAH_ISI_TABLE",$cobaja,$to_template);
			$this->email->from($from_email, 'Legal Dept'); 
			$this->email->to($to_email);
			$this->email->cc($to_cc);
			$this->email->subject($to_subject_email); 
			$this->email->message($msg);
			
			if($this->email->send()){
				var_dump("Email berhasil dikirim."); 
			}else {
				var_dump("Email gagal dikirim."); 
			} 







			// $to_template = $list['VTEMPLATE'];= 
			// foreach($data[get_reminder_by_departement] as $listt)
			// {
				
			// 	$test_aja = $list['VFROM'];
			// 	// var_dump("aja", $test_aja);
			// 	$set_template = str_replace("KONTENNYAINITEMPLATE",$test_aja,$to_template);
			// 	var_dump($set_template);
			// }
			

			// $set_template = str_replace("KONTENNYAINITEMPLATE",$from_email,$to_template);
			// var_dump(array($set_template));
		
		}
		// $from_email = "noreply@baragroup.id"; 
		// Tinggal buka komen nya setelah naik prod
		// $to_email = "putu.sastrawan@baracoal.com,sastrawanputu18@yahoo.com,paulinalumbangaol@gmail.com"; 
		// $to_cc = "soelaeman.widjaja@baracoal.com,soelaemanwidjaja@yahoo.com,jimmy.ku@baracoal.com,jimmyku2017@gmail.com,andry.hartanto@baracoal.com,andryhartanto@gmail.com, hendra.wijaya@baracoal.com,yola.prastika@baracoal.com,tri.marilando@baracoal.com,it@baracoal.com ";

				
    			
		// $to_email = "andri.hermawan.skom@gmail.com"; 
		// $to_cc = "it@baracoal.com";
		// $to_cc = "it@baracoal.com ,hendra.wijaya@baracoal.com,yola.prastika@baracoal.com";
    
		// $config = Array(
		// 	'protocol' => 'smtp',
		// 	'smtp_host' => 'ssl://smtp.hostinger.co.id',
		// 	'smtp_port' => 465,
		// 	'smtp_user' => $from_email,
		// 	'smtp_pass' => 'Bara654321!@#$%^',
		// 	'mailtype'  => 'html', 
		// 	'charset'   => 'iso-8859-1'
		// );
		
		// $this->load->library('email', $config);
		// $this->email->set_newline("\r\n");  
		// $this->email->set_mailtype("html"); 

		// $data['get_reminder']=$this->Reminder_model->get_reminder();
		// $msg = $this->load->view( 'admin/template_email', $data, true );

		// $this->email->from($from_email, 'Legal Dept'); 
		// $this->email->to($to_email);
		// $this->email->cc($to_cc);
		// $this->email->subject('Pemberitahuan Berakhirnya Kontrak / Perjanjian (Contract Reminder)'); 
		// $this->email->message($msg); 

		// if($this->email->send()){
		// 	$this->session->set_flashdata("notif","Email berhasil terkirim."); 
		// }else {
		// 	$this->session->set_flashdata("notif","Email gagal dikirim."); 
		// 	$this->load->view('admin/main_page'); 
		// } 
	}


	public function template_email() 
	{
		$data['get_reminder']=$this->Reminder_model->get_reminder();

		$msg = $this->load->view( 'admin/template_email', $data );
	}

	public function send_notif() 
	{
		$from_email = "noreply@baragroup.id"; 	
		// $to_email = "hendra.wijaya@baracoal.com,marianne.paliling@baracoal.com"; 
		// $to_cc = "it@baracoal.com";
		$to_email = "andri.hermawan.skom@gmail.com"; 
		$to_cc = "andri.hermawan@baragroup.id";
    
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.hostinger.co.id',
			'smtp_port' => 465,
			'smtp_user' => $from_email,
			'smtp_pass' => 'Bara654321!@#$%^',
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
		);
		
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");  
		$this->email->set_mailtype("html"); 

		$data['get_notif']=$this->Reminder_model->get_notif();
		$msg = $this->load->view( 'admin/template_notif', $data, true);

		$this->email->from($from_email, 'Legal Administration System'); 
		$this->email->to($to_email);
		$this->email->cc($to_cc);
		$this->email->subject('Pemberitahuan Kontrak / Perjanjian (Contract Reminder) Yang Akan Berakhir 30+1'); 
		$this->email->message($msg); 

		if($this->email->send()){
			$this->session->set_flashdata("notif","Email berhasil terkirim."); 
		}else {
			$this->session->set_flashdata("notif","Email gagal dikirim."); 
			$this->load->view('admin/main_page'); 
		} 
	}

	function fetch_email($add_company)
	{
		// $this->load->model('Admin/Master_model');
	 if($this->input->post('add_user'))
	 {
	  echo $this->Master_model->fetch_email($this->input->post('add_user'), $add_company);
	 }
	}

	public function template_nn() 
	{
		$data['get_reminder']=$this->Reminder_model->get_reminder();
		$data['get_notif']=$this->Reminder_model->get_notif();
		$msg = $this->load->view( 'admin/template_notif', $data );
	}

	

	

}
