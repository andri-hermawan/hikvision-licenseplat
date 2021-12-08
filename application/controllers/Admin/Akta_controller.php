<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akta_controller extends CI_Controller {

	function __construct() { 
		parent::__construct(); 
		$this->load->model('Admin/Akta_model');
		$this->load->helper('form');
		$this->load->library('Pdf');
	} 

	public function index()
	{
		
		$bau_cookies 			= $this->input->cookie('bau_cookies',true);
		$r_cookies = json_decode($bau_cookies, true);
		if($r_cookies[0]["department"] == 'LEGAL' OR $r_cookies[0]["department"] == 'IT')
		{
			// $this->load->model('Admin/Master_model');
			// $data['show_all_company'] = $this->Master_model->show_all_company();
			// $data['show_all_departement'] = $this->Master_model->show_all_departement();
			$this->load->view('admin/page_akta');
		}
		else
		{
			$this->session->set_flashdata('login_msg', 'failed');
			redirect("login");
		}
	}
	
	function get_akta_all()
	{

		$list = $this->Akta_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {

			$text_tsaham = "<textarea style=\"border: none; border-color: Transparent; overflow: auto;\" cols=\"45\" rows=\"6\" readonly>$field->TSAHAM</textarea>";
			$text_tdireksi = "<textarea style=\"border: none; border-color: Transparent; overflow: auto;\" cols=\"30\" rows=\"6\" readonly>$field->TDIREKSI</textarea>";
			$text_tkomisaris = "<textarea style=\"border: none; border-color: Transparent; overflow: auto;\" cols=\"30\" rows=\"6\" readonly>$field->TKOMISARIS</textarea>";
			$no++;
			$row = array(); 
			$row[] = $no;
			$row[] = $field->ID;
			$row[] = $field->VCOMPANY;
			$row[] = $field->VAKTANO;
			$row[] = date('d-F-Y', strtotime($field->DAKTA));
			$row[] = $field->VNOTARIS;
			$row[] = $text_tsaham;
			$row[] = $text_tdireksi;
			$row[] = $text_tkomisaris;
			$row[] = $field->VJABATAN;
			$row[] = date('d-F-Y', strtotime($field->DJABATAN_AKHIR));
			$row[] = $field->VUSER_AD;
			$row[] = $field->DCREATED;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Akta_model->count_all(),
			"recordsFiltered" => $this->Akta_model->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	function insert_akta()
	{
		$add_created = $this->input->post('add_created');
		$add_ad = $this->input->post('add_ad');
		$add_company = $this->input->post('add_company');
		$add_deed_no = $this->input->post('add_deed_no');
		$add_deed_date = $this->input->post('add_deed_date');
		$add_notaris = $this->input->post('add_notaris');
		$add_shareholders = $this->input->post('add_shareholders');
		$add_directors = $this->input->post('add_directors');
		$add_commissioner = $this->input->post('add_commissioner');
		$add_tenure = $this->input->post('add_tenure');
		$add_commissioner = $this->input->post('add_commissioner');
		$add_end_date = $this->input->post('add_end_date');
		$add_status = 'VALID'; 
		// $add_user_discussion = 'NONE';
		$data=$this->Akta_model->insert_akta($add_created,$add_ad,$add_company,$add_deed_no,$add_deed_date,$add_notaris,$add_shareholders,$add_directors,$add_commissioner,$add_tenure,$add_end_date,$add_status);

	}

	function get_akta_by_id($id)
	{
		$data=$this->Akta_model->get_akta_by_id($id);
        echo json_encode($data);	
	}

	function insert_addendum()
	{
		$add_addendum_created = $this->input->post('add_addendum_created');
		$add_addendum_ad = $this->input->post('add_addendum_ad');
		$add_addendum_company = $this->input->post('add_addendum_company');
		$add_addendum_deed_no = $this->input->post('add_addendum_deed_no');
		$add_addendum_deed_date = $this->input->post('add_addendum_deed_date');
		$add_addendum_notaris = $this->input->post('add_addendum_notaris');
		$add_addendum_shareholders = $this->input->post('add_addendum_shareholders');
		$add_addendum_directors = $this->input->post('add_addendum_directors');
		$add_addendum_commissioner = $this->input->post('add_addendum_commissioner');
		$add_addendum_tenure = $this->input->post('add_addendum_tenure');
		$add_addendum_end_date = $this->input->post('add_addendum_end_date');

		$data=$this->Akta_model->insert_addendum($add_addendum_created,$add_addendum_ad,$add_addendum_company,$add_addendum_deed_no,$add_addendum_deed_date,$add_addendum_notaris,$add_addendum_shareholders,$add_addendum_directors,$add_addendum_commissioner,$add_addendum_tenure,$add_addendum_end_date); //$add_addendum_time_periode,$add_addendum_user_discussion,
	}

	function edit_akta_status()
	{
    
		$change_id = $this->input->post('change_id');
		$change_created = $this->input->post('change_created');
		$change_ad = $this->input->post('change_ad');
		$change_company = $this->input->post('change_company');
		$change_deed_no = $this->input->post('change_deed_no');
		$change_deed_date = $this->input->post('change_deed_date');
		$change_notaris = $this->input->post('change_notaris');
		$change_shareholders = $this->input->post('change_shareholders');
		$change_directors = $this->input->post('change_directors');
		$change_commissioner = $this->input->post('change_commissioner');
		$change_tenure = $this->input->post('change_tenure');
		$change_end_date = $this->input->post('change_end_date');
		$change_status = $this->input->post('change_status');
    
		$data=$this->Akta_model->edit_akta_status($change_id,$change_created,$change_ad,$change_company,$change_deed_no,$change_deed_date,$change_notaris,$change_shareholders,$change_directors,$change_commissioner,$change_tenure,$change_end_date,$change_status);
	}

	function get_akta_by_company($temp)
	{
		$tempt = str_replace("%20"," ",$temp);
		// var_dump($tempt);
		$list=$this->Akta_model->get_akta_by_company($tempt);
		
		$data = array();
		foreach($list as $field) {
			$no++;
			$row = array();

			$text_tsaham = "<textarea style=\"border: none; border-color: Transparent; overflow: auto;\" cols=\"45\" rows=\"6\" readonly>$field->TSAHAM</textarea>";
			$text_tdireksi = "<textarea style=\"border: none; border-color: Transparent; overflow: auto;\" cols=\"30\" rows=\"6\" readonly>$field->TDIREKSI</textarea>";
			$text_tkomisaris = "<textarea style=\"border: none; border-color: Transparent; overflow: auto;\" cols=\"30\" rows=\"6\" readonly>$field->TKOMISARIS</textarea>";
			
			$row[] = $no;
			$row[] = rtrim($field->ID);
			$row[] = rtrim($field->VCOMPANY);
			$row[] = rtrim($field->VAKTANO);
			$row[] = date('d-F-Y', strtotime($field->DAKTA));
			$row[] = $field->VNOTARIS;
			$row[] = $text_tsaham;
			$row[] = $text_tdireksi;
			$row[] = $text_tkomisaris;
			$row[] = rtrim($field->VJABATAN);
			$row[] = date('d-F-Y', strtotime($field->DJABATAN_AKHIR));
			$row[] = rtrim($field->VUSER_AD);
			$row[] = rtrim($field->DCREATED);

			$data[]	= $row;
		}
		$output = array("data"=>$data);
		echo json_encode($output);
	}

	public function check_email ()
	{
		$data['check_status_close']=$this->Akta_model->check_status_close();
		$data['check_reminder']=$this->Akta_model->check_reminder();
    	
	}

	public function send_mail() 
	{
		$data['get_reminder']=$this->Akta_model->get_reminder();
		foreach($data['get_reminder'] as $list)
		{
			$from_email = "noreply@baragroup.id"; 
			// $to_email = "tri.marilando@baracoal.com,marianne.paliling@baracoal.com"; 
			// $to_cc = "hendra.wijaya@baracoal.com,it@baracoal.com ";
			$company = $list['VCOMPANY'];
			$akta_no = $list['VAKTANO'];
			$end_date = $list['DJABATAN_AKHIR'];

			$to_email = "andri.hermawan.skom@gmail.com"; 
			$to_cc = "andri.hermawan.skom@gmail.com";

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
				Yang terhormat,
				<br/>
				Bapak / Ibu Legal Dept
				<br/>
				Bersama ini perkenalkanlah kami menginformasikan mengenai jangka waktu berakhirnya Akta Perusahaan, sebagai berikut :
				<br/><br/>
				
				<table width=\"100%\" border=\"1px solid black\">
				<tr>
				<td width=\"15%\">Perusahaan</td>
				<td width=\"85%\">$company</td>
				</tr>
				<tr>
				<td>Nomor Akta</td>
				<td>$akta_no</td>
				</tr>
				<tr>
				<td>Berlaku Hingga</td>
				<td> ".date('d-F-Y', strtotime($end_date))." </td>
				</tr>
				</table>

				<br/>
				Demikian  kami sampaikan, pemberitahuan (reminder) ini dilakukan 60 (enam puluh) hari kalender sebelum berakhirnya Akta Perusahaan, Terima kasih atas perhatian dan kerjasamanya.
				<br/><br/>
				Salam,
				<br/><br/>
				Legal Dept
			";

		// 	$msg = str_replace("JANGAN_DIHAPUS_INI_ADALAH_ISI_TABLE",$cobaja,$to_template);
			$this->email->from($from_email, 'Legal Administration System'); 
			$this->email->to($to_email);
			$this->email->cc($to_cc);
			$this->email->subject('Pemberitahuan Berakhirnya Akta Perusahaan'); 
			$this->email->message($cobaja);
			
			if($this->email->send()){
				var_dump("Email berhasil dikirim."); 
			}else {
				var_dump("Email gagal dikirim."); 
			} 
		
		}
		
	}

	


	public function print_excel () 
	{
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Create a first sheet, representing sales data
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "NO"); 
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "PERUSAHAAN"); 
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "NO AKTA"); 
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "TANGGAL AKTA"); 
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "NOTARIS"); 
		$objPHPExcel->getActiveSheet()->setCellValue('F1', "PEMEGANG SAHAM"); 
		$objPHPExcel->getActiveSheet()->setCellValue('G1', "DIREKSI"); 
		$objPHPExcel->getActiveSheet()->setCellValue('H1', "KOMISARIS"); 
		$objPHPExcel->getActiveSheet()->setCellValue('I1', "MASA JABATAN"); 
		$objPHPExcel->getActiveSheet()->setCellValue('J1', "TANGGAL AKHIR JABATAN"); 

		$all_akta = $this->Akta_model->get_vw_all_akta();

		$no = 0; 
		$numrow = 2; 
		foreach($all_akta as $data){ 
			if($data->RIN==1)
			{
				$no++;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numrow, $no);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numrow, $data->VCOMPANY);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numrow, $data->VAKTANO);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numrow, $data->DAKTA);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numrow, $data->VNOTARIS);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numrow, $data->TSAHAM);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numrow, $data->TDIREKSI);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numrow, $data->TKOMISARIS);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$numrow, $data->VJABATAN);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$numrow, $data->DJABATAN_AKHIR);
			}else 
			{
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numrow, ' ');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numrow, $data->VCOMPANY);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numrow, $data->VAKTANO);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numrow, $data->DAKTA);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numrow, $data->VNOTARIS);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numrow, $data->TSAHAM);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numrow, $data->TDIREKSI);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numrow, $data->TKOMISARIS);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$numrow, $data->VJABATAN);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$numrow, $data->DJABATAN_AKHIR);
			}
			// var_dump($data->VCOMPANY);
			
			
			// $no++; 
			$numrow++;
		}
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(45);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(45); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(45); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(45); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12); 
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);




		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('ALL');

		// Create a new worksheet, after the default sheet
		$objPHPExcel->createSheet();

		// Add some data to the second sheet, resembling some different data types
		$objPHPExcel->setActiveSheetIndex(1);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "NO"); 
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "PERUSAHAAN"); 
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "NO AKTA"); 
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "TANGGAL AKTA"); 
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "NOTARIS"); 
		$objPHPExcel->getActiveSheet()->setCellValue('F1', "PEMEGANG SAHAM"); 
		$objPHPExcel->getActiveSheet()->setCellValue('G1', "DIREKSI"); 
		$objPHPExcel->getActiveSheet()->setCellValue('H1', "KOMISARIS"); 
		$objPHPExcel->getActiveSheet()->setCellValue('I1', "MASA JABATAN"); 
		$objPHPExcel->getActiveSheet()->setCellValue('J1', "TANGGAL AKHIR JABATAN"); 

		$all_akta1 = $this->Akta_model->get_vw_active_akta();

		$no1 = 0; 
		$numrow1 = 2; 
		foreach($all_akta1 as $data1){ 
			if($data1->RIN==1)
			{
				$no1++;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numrow1, $no1);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numrow1, $data1->VCOMPANY);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numrow1, $data1->VAKTANO);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numrow1, $data1->DAKTA);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numrow1, $data1->VNOTARIS);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numrow1, $data1->TSAHAM);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numrow1, $data1->TDIREKSI);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numrow1, $data1->TKOMISARIS);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$numrow1, $data1->VJABATAN);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$numrow1, $data1->DJABATAN_AKHIR);
			}else 
			{
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numrow1, ' ');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numrow1, $data1->VCOMPANY);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numrow1, $data1->VAKTANO);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numrow1, $data1->DAKTA);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numrow1, $data1->VNOTARIS);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numrow1, $data1->TSAHAM);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numrow1, $data1->TDIREKSI);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numrow1, $data1->TKOMISARIS);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$numrow1, $data1->VJABATAN);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$numrow1, $data1->DJABATAN_AKHIR);
			}
			// var_dump($data->VCOMPANY);
			
			
			// $no++; 
			$numrow1++;
		}

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(45);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(45); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(45); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(45); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12); 
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Rename 2nd sheet
		$objPHPExcel->getActiveSheet()->setTitle('ACTIVE');

		// Create a new worksheet, after the default sheet
		$objPHPExcel->createSheet();

		// Add some data to the second sheet, resembling some different data types
		$objPHPExcel->setActiveSheetIndex(2);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "NO"); 
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "PERUSAHAAN"); 
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "NO AKTA"); 
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "TANGGAL AKTA"); 
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "NOTARIS"); 
		$objPHPExcel->getActiveSheet()->setCellValue('F1', "PEMEGANG SAHAM"); 
		$objPHPExcel->getActiveSheet()->setCellValue('G1', "DIREKSI"); 
		$objPHPExcel->getActiveSheet()->setCellValue('H1', "KOMISARIS"); 
		$objPHPExcel->getActiveSheet()->setCellValue('I1', "MASA JABATAN"); 
		$objPHPExcel->getActiveSheet()->setCellValue('J1', "TANGGAL AKHIR JABATAN"); 

		$all_akta2 = $this->Akta_model->get_vw_close_akta();

		$no2 = 0; 
		$numrow2 = 2; 
		foreach($all_akta2 as $data2){ 
			if($data2->RIN==1)
			{
				$no2++;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numrow2, $no2);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numrow2, $data2->VCOMPANY);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numrow2, $data2->VAKTANO);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numrow2, $data2->DAKTA);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numrow2, $data2->VNOTARIS);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numrow2, $data2->TSAHAM);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numrow2, $data2->TDIREKSI);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numrow2, $data2->TKOMISARIS);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$numrow2, $data2->VJABATAN);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$numrow2, $data2->DJABATAN_AKHIR);
			}else 
			{
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numrow2, ' ');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numrow2, $data2->VCOMPANY);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$numrow2, $data2->VAKTANO);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$numrow2, $data2->DAKTA);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$numrow2, $data2->VNOTARIS);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$numrow2, $data2->TSAHAM);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$numrow2, $data2->TDIREKSI);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$numrow2, $data2->TKOMISARIS);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$numrow2, $data2->VJABATAN);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$numrow2, $data2->DJABATAN_AKHIR);
			}
			// var_dump($data->VCOMPANY);
			
			
			// $no++; 
			$numrow2++;
		}

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(45);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(45); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(45); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(45); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12); 
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Rename 2nd sheet
		$objPHPExcel->getActiveSheet()->setTitle('CLOSE');


		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="DATA AKTA PERUSAHAAN.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		redirect('Admin/Akta_controller/index', 'refresh');
	}

	// public function print_excel_by_agreement($temp)
	// {
	// 	$tempt = str_replace("u1","/",$temp);
	// 	header("Content-type=application/vnd.ms.excel");
	// 	header("Content-disposition: attachment; filename= RECAP PERJANJIAN BAU OPERASIONAL.xls");
	// 	$data['show_reminder_by_agreement']=$this->Akta_model->show_reminder_by_agreement($tempt);
	// 	$this->load->view('admin/print_excel_by_agreement', $data);
	// 	// var_dump($temp);
	// }

	// public function print_pdf()
	// {
	// 	$data['show_reminder']=$this->Akta_model->show_reminder(0,1000000);
	// 	$this->load->view('admin/print_pdf', $data); 
	// }

	// public function print_pdf_by_agreement($temp)
	// {
	// 	$tempt = str_replace("u1","/",$temp);
	// 	$data['show_reminder_by_agreement']=$this->Akta_model->show_reminder_by_agreement($tempt);
	// 	$this->load->view('admin/print_pdf_by_agreement', $data); 
	// }

































































































	

	

	

	

	

	// function delete_agreement()
	// {
	// 	$delete_id = $this->input->post('delete_id');
	// 	$delete_agreement = $this->input->post('delete_agreement');
	// 	$data=$this->Akta_model->delete_agreement($delete_id,$delete_agreement);
	// }






	// public function template_email() 
	// {
	// 	$data['get_reminder']=$this->Akta_model->get_reminder();

	// 	$msg = $this->load->view( 'admin/template_email', $data );
	// }

	

}
