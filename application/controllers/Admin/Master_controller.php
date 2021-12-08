<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_controller extends CI_Controller {

	function __construct() { 
		parent::__construct(); 
		$this->load->model('Admin/Master_model');
	} 

	// AWAL MTEMAIL
	public function mtemail_index()
	{
		$bau_cookies 			= $this->input->cookie('bau_cookies',true);
		$r_cookies = json_decode($bau_cookies, true);
		if($r_cookies[0]["department"] == 'LEGAL' OR $r_cookies[0]["department"] == 'IT')
		{
			$data['show_all_company'] = $this->Master_model->show_all_company();
			$data['show_all_departement'] = $this->Master_model->show_all_departement();
			$this->load->view('admin/page_master_email',$data);
		}
		else
		{
        
			$this->session->set_flashdata('login_msg', 'failed');
			redirect("Login");
		}
	}

	function get_mtemail_all()
	{

		$list = $this->Master_model->get_datatables_mtemail();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array(); 
			if($field->VSTATUS == 1){
				$STATUS = 'ACTIVE';
			}else {
				$STATUS = 'NOT ACTIVE';
			}
			$row[] = $no;
			$row[] = $field->ID;
			$row[] = $field->VHEADER;
			$row[] = $field->VFROM;
			$row[] = $field->VTO;
			$row[] = $field->VCC;
			$row[] = $field->VSUBJECT;
			$row[] = $field->VTEMPLATE;
			$row[] = $field->VCOMPANY_NAME;
			$row[] = $field->VDEPARTEMENT_NAME;
			$row[] = $STATUS;
			$row[] = $field->VUSER;
			$row[] = date('d-F-Y', strtotime($field->DCREATED));

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Master_model->count_all_mtemail(),
			"recordsFiltered" => $this->Master_model->count_filtered_mtemail(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	function get_mtemail_by_id($id)
	{
		$data=$this->Master_model->get_mtemail_by_id($id);
        echo json_encode($data);	
	}

	function insert_mtemail()
	{
		
		$add_title = $this->input->post('add_title');
		$add_from = $this->input->post('add_from');
		$add_to = $this->input->post('add_to');
		$add_cc = $this->input->post('add_cc');
		$add_subject = $this->input->post('add_subject');
		$add_template = $this->input->post('add_template');
		$add_company = $this->input->post('add_company');
		$add_departement = $this->input->post('add_departement');
		$add_ad = $this->input->post('add_ad');
		$add_created = $this->input->post('add_created');
	
		$data=$this->Master_model->insert_mtemail($add_created,$add_ad,$add_title,$add_from,$add_to,$add_cc,$add_subject,$add_template,$add_company,$add_departement);

	}

	function edit_mtemail()
	{
		// $change_ad = $this->input->post('change_ad');
		$change_id = $this->input->post('change_id');
		$change_title = $this->input->post('change_title');
		$change_from = $this->input->post('change_from');
		$change_subject = $this->input->post('change_subject');
		$change_company = $this->input->post('change_company');
		$change_departement = $this->input->post('change_departement');
		$change_to = $this->input->post('change_to');
		$change_cc = $this->input->post('change_cc');
		$summernote = $this->input->post('summernote');
		// var_dump(array($change_id,$change_ad,$change_departement,$change_status));
		   
		$data=$this->Master_model->edit_mtemail($change_id,$change_title,$change_from,$change_subject,$change_company,$change_departement,$change_to,$change_cc,$summernote);
	}

	function delete_mtemail()
	{
		$delete_id = $this->input->post('delete_id');
		$delete_subject = $this->input->post('delete_subject');
		$data=$this->Master_model->delete_mtemail($delete_id,$delete_subject);
	}

	// AKHIR MTEMAIL

	// AWAL MTDEPARTEMENT
	public function mtdepartement_index()
	{
		$bau_cookies 			= $this->input->cookie('bau_cookies',true);
		$r_cookies = json_decode($bau_cookies, true);
		if($r_cookies[0]["department"] == 'LEGAL' OR $r_cookies[0]["department"] == 'IT')
		{
			$this->load->view('admin/page_master_departement',$data);
		}
		else
		{
        
			$this->session->set_flashdata('login_msg', 'failed');
			redirect("Login");
		}
	}

	function get_mtdepartement_all()
	{

		$list = $this->Master_model->get_datatables_mtdepartement();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array(); 
			if($field->VSTATUS == 1){
				$STATUS = 'ACTIVE';
			}else {
				$STATUS = 'NOT ACTIVE';
			}
			$row[] = $no;
			$row[] = $field->ID;
			$row[] = $field->VNAME;
			$row[] = $STATUS;
			$row[] = $field->VUSER;
			$row[] = $field->DCREATED;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Master_model->count_all_mtdepartement(),
			"recordsFiltered" => $this->Master_model->count_filtered_mtdepartement(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	function insert_mtdepartement()
	{
		$add_created = $this->input->post('add_created');
		$add_ad = $this->input->post('add_ad');
		$add_name = $this->input->post('add_name');
		
	
		$data=$this->Master_model->insert_mtdepartement($add_created,$add_ad,$add_name);

	}

	function get_mtdepartement_by_id($id)
	{
		$data=$this->Master_model->get_mtdepartement_by_id($id);
        echo json_encode($data);	
	}

	function edit_mtdepartement()
	{
		// $change_ad = $this->input->post('change_ad');
		$change_id = $this->input->post('change_id');
		$change_departement = $this->input->post('change_departement');
		$change_status = $this->input->post('change_status');
		// var_dump(array($change_id,$change_ad,$change_departement,$change_status));
		   
		$data=$this->Master_model->edit_mtdepartement($change_id,$change_departement,$change_status);
	}

	function delete_mtdepartement()
	{
		$delete_id = $this->input->post('delete_id');
		$delete_departement = $this->input->post('delete_departement');
		$data=$this->Master_model->delete_mtdepartement($delete_id,$delete_departement);
	}

	// AKHIR MTDEPARTEMENT

	// AWAL MTCOMPANY
	public function mtcompany_index()
	{
		$bau_cookies 			= $this->input->cookie('bau_cookies',true);
		$r_cookies = json_decode($bau_cookies, true);
		if($r_cookies[0]["department"] == 'LEGAL' OR $r_cookies[0]["department"] == 'IT')
		{
			$this->load->view('admin/page_master_company',$data);
		}
		else
		{
        
			$this->session->set_flashdata('login_msg', 'failed');
			redirect("Login");
		}
	}

	function get_mtcompany_all()
	{

		$list = $this->Master_model->get_datatables_mtcompany();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array(); 
			if($field->VSTATUS == 1){
				$STATUS = 'ACTIVE';
			}else {
				$STATUS = 'NOT ACTIVE';
			}
			$row[] = $no;
			$row[] = $field->ID;
			$row[] = $field->VNAME;
			$row[] = $STATUS;
			$row[] = $field->VUSER;
			$row[] = $field->DCREATED;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Master_model->count_all_mtcompany(),
			"recordsFiltered" => $this->Master_model->count_filtered_mtcompany(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	function insert_mtcompany()
	{
		$add_created = $this->input->post('add_created');
		$add_ad = $this->input->post('add_ad');
		$add_name = $this->input->post('add_name');
		
	
		$data=$this->Master_model->insert_mtcompany($add_created,$add_ad,$add_name);

	}

	function get_mtcompany_by_id($id)
	{
		$data=$this->Master_model->get_mtcompany_by_id($id);
        echo json_encode($data);	
	}

	function edit_mtcompany()
	{
		// $change_ad = $this->input->post('change_ad');
		$change_id = $this->input->post('change_id');
		$change_company = $this->input->post('change_company');
		$change_status = $this->input->post('change_status');
		// var_dump(array($change_id,$change_ad,$change_company,$change_status));
		   
		$data=$this->Master_model->edit_mtcompany($change_id,$change_company,$change_status);
	}

	function delete_mtcompany()
	{
		$delete_id = $this->input->post('delete_id');
		$delete_company = $this->input->post('delete_company');
		$data=$this->Master_model->delete_mtcompany($delete_id,$delete_company);
	}
	// AKHIR MTCOMPANY

	

	

	
}
