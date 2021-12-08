<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// $bau_cookies 			= $this->input->cookie('bau_cookies',true);
		// $r_cookies = json_decode($bau_cookies, true);
		// if($r_cookies[0]["department"] == 'LEGAL' OR $r_cookies[0]["department"] == 'IT')
		// {
			// $this->load->view('admin/page_home');
			// redirect("Admin/Capture_controller/dashboard_page");
			redirect("Admin/Main_controller");
			
		// }
		// else
		// {
		// 	$this->session->set_flashdata('login_msg', 'failed');
		// 	$this->load->view('login_page');
		// }
		
	}

	public function check_login()
	{
		$this->load->helper(array('form'));
		$this->load->library('form_validation','session');
			
		$this->form_validation->set_rules('username', 'username', 'required'); 
		$this->form_validation->set_rules('password', 'password', 'required'); 

		if ($this->form_validation->run() == FALSE) 
        { 
			$this->session->set_flashdata('message_login', '<br><div class="well error-msg" style="color: red">É obrigatório preencher os campos!</div>');
			redirect("Login");
		}else {

			// Connection to AD server 
        	if (!($connect = @ldap_connect("172.16.10.10",389))) //vpn.baracoal.com
        	{
				die("Could not connect!"); 
			} 
			$username = $this->input->post('username', TRUE);
			$password = $this->input->post('password', TRUE);
			
			$ldaprdn = 'bau' . "\\" . $username;
			ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
			
			$bind = @ldap_bind($connect, $ldaprdn, $password);

			if ($bind) 
			{
				// var_dump('BIND');
				$filter="(sAMAccountName=$username)";
				$result = ldap_search($connect,"dc=BAU,dc=CORP",$filter);
				ldap_sort($connect,$result,"sn");
				$info = ldap_get_entries($connect, $result);
				
				$userDn = '';
            	$company = '';
				$department= '';
				for ($i=0; $i<$info["count"]; $i++)
				{
					$userDn = $info[$i]["samaccountname"][0]; 
					$company = $info[$i]["company"][0]; 
					$department = $info[$i]["department"][0]; 
					
				}

				$bau_cookies= array('name'   => 'bau_cookies','value'  => '[{"username":'.'"'.$username.'"'.','.'"password":'.'"'."$password".'"'.','.'"company":'.'"'."$company".'"'.','.'"department":'.'"'."$department".'"'.'}]' ,'expire' => 86400*360);
				$this->input->set_cookie($bau_cookies);
				if ($department == 'LEGAL' or $department == 'IT')
				{
					redirect("Admin/Main_controller");
				}else 
				{
					echo "<script>alert('MAAF ANDA TIDAK MEMILIKI AKSES UNTUK APLIKASI INI, HUBUNGI TEAM IT. TERIMAKASIH');</script>";
					redirect("Login");
				}
			} else
			{
				redirect("Login");
			}

		}
	}


	public function logout()
    {
		$this->session->sess_destroy();
		
		delete_cookie('bau_cookies');
		redirect("Login");
	}


}
