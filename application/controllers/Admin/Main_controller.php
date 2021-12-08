<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller {

	function __construct() { 
		parent::__construct(); 
		// $this->load->model('Admin/Main_model');
	} 

	public function index () 
	{
		// $this->load->view('admin/page_main');

		$cek = $this->db->get('TbTransCustomer');
		var_dump($cek);
	}

	


	// public function index()
	// {
	// 	$bau_cookies 			= $this->input->cookie('bau_cookies',true);
	// 	$r_cookies = json_decode($bau_cookies, true);
	// 	if($r_cookies[0]["department"] == 'LEGAL' OR $r_cookies[0]["department"] == 'IT')
	// 	{
	// 		$this->load->model('Admin/Reminder_model');
	// 		$this->load->model('Admin/Akta_model');
	// 		$dt2 = new DateTime("+1 month");
	// 		$date_1 = $dt2->format("F");
	// 		$today = $dt2->format("Y-m-d");
	// 		$awal =  date('01-F-Y', strtotime($today));
	// 		$akhir = date('t-F-Y', strtotime($today));

	// 		$data = array(
	// 			'month_1' => $date_1,
	// 			'awal' => $awal,
	// 			'akhir' => $akhir
	// 		);

	// 		$data['get_agreement_count']=$this->Reminder_model->get_agreement_count();
    //     	$data['get_reminder_today']=$this->Reminder_model->get_reminder_today();
    //     	$data['get_reminder_today_count']=$this->Reminder_model->get_reminder_today_count();
			
	// 		$data['get_akta_count']=$this->Akta_model->get_akta_count();
    //     	$data['get_akta_today']=$this->Akta_model->get_reminder_today();
    //     	$data['get_akta_today_count']=$this->Akta_model->get_reminder_today_count();
	// 		$this->load->view('admin/page_home',$data);
	// 	}
	// 	else
	// 	{
        
	// 		$this->session->set_flashdata('login_msg', 'failed');
	// 		redirect("Login");
	// 	}
	// }

	// public function send_notif() 
	// {
	// 	$from_email = "noreply@baragroup.id"; 	
	// 	// $to_email = "tri.marilando@baracoal.com, marianne.paliling@baracoal.com"; 
	// 	// $to_cc = "hendra.wijaya@baracoal.com,it@baracoal.com";

	// 	$to_email = "andri.hermawan.skom@gmail.com"; 
	// 	$to_cc = "andri.hermawan.skom@gmail.com";
    
	// 	$config = Array(
	// 		'protocol' => 'smtp',
	// 		'smtp_host' => 'ssl://smtp.hostinger.co.id',
	// 		'smtp_port' => 465,
	// 		'smtp_user' => $from_email,
	// 		'smtp_pass' => 'Bara654321!@#$%^',
	// 		'mailtype'  => 'html', 
	// 		'charset'   => 'iso-8859-1'
	// 	);
		
	// 	$this->load->library('email', $config);
	// 	$this->email->set_newline("\r\n");  
	// 	$this->email->set_mailtype("html"); 

	// 	$this->load->model('Admin/Reminder_model');
	// 	$this->load->model('Admin/Akta_model');
	// 	$data['get_notif']=$this->Reminder_model->get_notif();
	// 	$data['get_notif_akta']=$this->Akta_model->get_reminder_today();
	// 	$msg = $this->load->view( 'admin/template_notif', $data, true);

	// 	$this->email->from($from_email, 'Legal Administration System'); 
	// 	$this->email->to($to_email);
	// 	$this->email->cc($to_cc);
	// 	$this->email->subject('Pemberitahuan Kontrak / Perjanjian dan Perubahan Akta Perusahaan'); 
	// 	$this->email->message($msg); 

	// 	if($this->email->send()){
	// 		var_dump("Email berhasil dikirim."); 
	// 	}else {
	// 		var_dump("Email gagal dikirim."); 
	// 	} 
	// }

	

	

	
}
