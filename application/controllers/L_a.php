<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class L_a extends CI_Controller {

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
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mbg','M');
	}
	public function index()
	{
		$this->load->view('admin/login');
	}
	public function plog()
	{
		$email = $this->input->post('email');
		$pass = $this->input->post('password');

		$recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
        $userIp=$this->input->ip_address();
        $secret='6Le5ctkZAAAAADjfn6DswRC--OAnyiMMrkOITdx_'; // ini adalah Secret key yang didapat dari google, silahkan disesuaikan
        $credential = array(
              'secret' => $secret,
              'response' => $this->input->post('g-recaptcha-response')
          );
        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);

        $status= json_decode($response, true);

        if($status['success']){

		$user = $this->db->get_where('tbl_admin',['email'=>$email])->row_array();
			if($user){
				if($user['email']==$email){
					if($user['password']==$pass){
								$data = [
					        		'email' => $user['email']
					        	];
						        $localIP = getHostByName(getHostName());
						   		ob_start();  
						   		system('ipconfig /all');  
						   		$configdata=ob_get_contents();  
						   		ob_clean(); 
							    $mac = "Physical";  
							    $pmac = strpos($configdata, $mac);
						   		$macaddr=substr($configdata,($pmac+36),17);  
							    $browserName =  $_SERVER['HTTP_USER_AGENT'];
							    $dataLogin = [
							    	'username' => $email,
							    	'ipaddress' => $localIP,
							    	'macaddress' => $macaddr,
							    	'browser' => $browserName,
							    	'action' => 1
							    ];
				        		$this->session->set_userdata($data);
				        		$data = $this->session->set_flashdata('pesan', 'Selamat Anda Berhasil Login !');
    							redirect('Admin',$data);


					}else{
						//pass salah
						$data = $this->session->set_flashdata('pesan', 'Password Salah !');
						redirect('L_a',$data);
					}

				}else{
					//email salah
					$data = $this->session->set_flashdata('pesan', 'Email Salah !');
					redirect('L_a',$data);
				}
			}else{
				//tidak ada akun
				$data = $this->session->set_flashdata('pesan', 'Akun Tidak Ditemukan !');
				redirect('L_a',$data);
			}
		}else{
			$data = $this->session->set_flashdata('pesan', 'Silahkan Aktivasi Captcha !');
				redirect('L_a',$data);
		}
	}
	public function logad(){

			$email = $this->session->userdata('email');

			$this->session->unset_userdata('email');
			$this->session->sess_destroy();
			//jika tidak ada user
			$localIP = getHostByName(getHostName());
	   		ob_start();  
	   		system('ipconfig /all');  
	   		$configdata=ob_get_contents();  
	   		ob_clean(); 
		    $mac = "Physical";  
		    $pmac = strpos($configdata, $mac);
	   		$macaddr=substr($configdata,($pmac+36),17);  
		    $browserName =  $_SERVER['HTTP_USER_AGENT'];
		    $dataLogin = [
		    	'username' => $email,
		    	'ipaddress' => $localIP,
		    	'macaddress' => $macaddr,
		    	'browser' => $browserName,
		    	'action' => 0
		    ];
		    $this->db->insert('tbl_history', $dataLogin);
			$data = $this->session->set_flashdata('pesan','Keluar !');

	        redirect('L_a',$data);                
	}

}