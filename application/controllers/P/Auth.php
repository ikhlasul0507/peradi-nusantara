<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
		// header("Content-Security-Policy: default-src 'self'; script-src 'self'; object-src 'none';");
		parent::__construct();
		$this->load->library('service');
		$this->load->model('Mbg','M');
	}
	public function index()
	{
		$data['startAngkatan'] = (int) $this->M->getParameter('@startNumberAngkatan');
		$data['endAngkatan'] = (int) $this->M->getParameter('@endNumberAngkatan');
		$data['list_pic'] = explode(",",$this->M->getParameter('@picRegister'));
		$this->load->view('p/auth/register',$data);
	}

	public function login()
	{
		// $this->checkLockAccount();
		$this->load->view('p/auth/login');
	}

	public function lupa_password()
	{
		$this->load->view('p/auth/lupa_password');
	}

	public function forget_password($uuid)
	{
		$data['uuid'] = $uuid;
		$this->load->view('p/auth/new_password', $data);
	}

	public function process_register()
	{
		// if(filter_var(trim($this->input->post('namalengkap')), FIL))
		$check = true;
		// $referenceFromDB = $this->M->getParameter('@picRegister');
		// if(strpos($referenceFromDB, strtoupper($this->input->post('pic'))) !== false){
		// 	$check = true;
		// }else{
		// 	$data = $this->session->set_flashdata('pesan', 'PIC Tidak Terdaftar !');
		// 	redirect('P/Auth',$data);
		// }
		if($check){
			$checkUserExist =  $this->M->checkUserExist(trim($this->input->post('nik')), trim($this->input->post('handphone')));
			
			if($checkUserExist < 1){
				$uploadKTP = $this->service->do_upload('img','file_ktp');
					if($uploadKTP['code'] == 200){
						$data_register = [
							'nama_lengkap' => trim($this->input->post('namalengkap')),
							'nik' => trim($this->input->post('nik')),
							'email' => trim($this->input->post('email')),
							'handphone' => trim($this->input->post('handphone')),
							'usia' => trim($this->input->post('usia')),
							'asal_kampus' => trim($this->input->post('asalkampus')),
							'semester' => trim($this->input->post('semester')),
							'reference' => trim($this->input->post('reference')),
							'pic' => trim($this->input->post('pic')),
							'angkatan' => '',
							'latar_belakang' => trim($this->input->post('latar_belakang')),
							'password' => trim($this->input->post('password')),
							'password_hash' => password_hash(trim($this->input->post('password')), PASSWORD_DEFAULT),
							'is_active' => 'Y',
							'user_level' => 4,
							'foto_ktp' => $uploadKTP['upload_data']['file_name'],
							'is_new_user' => trim($this->input->post('is_new_user'))
						];
						$add_db = $this->M->add_to_db('user', $data_register);
						if($add_db){
							$add_history = $this->M->add_log_history($this->input->post('namalengkap'),"Pendaftaran Akun Baru");
							if($add_history){
								if($this->M->getParameter('@sendNotifWaRegister') == 'Y'){
									$data_send_notif = [
										'handphone' => trim($this->input->post('handphone')),
										'namalengkap' => trim($this->input->post('namalengkap')),
										'url_login' => trim(base_url('P/Auth/login'))
									];
									$this->service->send_whatsapp($data_send_notif, 'new_register');
								}
							}
							$data = $this->session->set_flashdata('pesan', 'Akun berhasil terdaftar !');
							redirect('P/Auth/login',$data);
						}else{
							$data = $this->session->set_flashdata('pesan', 'Gagal Register Data !');
							redirect('P/Auth',$data);
						}
				}else{
					$data = $this->session->set_flashdata('pesan', 'Harap Upload Foto KTP !');
					redirect('P/Auth',$data);
				}
			}else{
				$data = $this->session->set_flashdata('pesan', 'Akun telah terdaftar !');
				redirect('P/Auth',$data);
			}
		}
	}

	public function process_login()
	{
		$recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
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
			$isLogin = false;
				$user = $this->M->getWhere('user',['handphone'=>trim($this->input->post('handphone'))]);
				if($user){
					if($user['user_level'] == 1){
						$isLogin = true;
					}else{
						if($this->M->getParameter('@lockLoginForEveryOne') == 'N'){
							$isLogin = true;
						}else{
							$data = $this->session->set_flashdata('pesan', 'Tidak bisa Login\nWhatsapp dan Virtual Account tidak terhubung !');
							redirect('P/Auth/login',$data);
						}
					}
				}else{
					$data = $this->session->set_flashdata('pesan', 'Akun belum terdaftar !');
					redirect('P/Auth/login',$data);
				}
			

			if($isLogin){
				if(password_verify(trim($this->input->post('password')),$user['password_hash'])){
					if($user['is_active'] == 'Y'){
						if($this->M->getParameter('@sendNotifWaLogin') == 'Y'){
							$data_send_notif = [
								'handphone' => trim($user['handphone']),
								'namalengkap' => trim($user['nama_lengkap']),
								'url_login' => trim(base_url('P/Auth/login'))
							];
							$this->service->send_whatsapp($data_send_notif, 'login');
						}
						$add_history = $this->M->add_log_history($user['nama_lengkap'],"Login Akun");
						$data_session = [
							'id_user' =>trim($user['id_user']),
							'nama_lengkap' =>trim($user['nama_lengkap']),
							'handphone' =>trim($this->input->post('handphone')),
							'user_level' =>trim($user['user_level']),
							'foto_kta' => trim($user['foto_kta']),
							'is_owner' => trim($user['is_owner']),
							'is_digital_marketing' => trim($user['is_digital_marketing'])
						];
						$this->session->set_userdata($data_session);
		        		$data = $this->session->set_flashdata('pesan', 'Selamat Anda Berhasil Login !');
		        		if(trim($user['user_level']) <= 3){
		        			redirect('P/Admin/main',$data);
		        		}else{
							redirect('P/Admin',$data);
						}
					}else{
						$data = $this->session->set_flashdata('pesan', 'Akun tidak aktif sementara !');
						redirect('P/Auth/login',$data);
					}
				}else{
					$data = $this->session->set_flashdata('pesan', 'Password salah !');
					redirect('P/Auth/login',$data);
				}
			}
		}else{
			$data = $this->session->set_flashdata('pesan', 'Silahkan Aktivasi Captcha !');
					redirect('P/Auth/login',$data);
		}
		
	}

	public function process_logout()
	{
		$this->session->unset_userdata('handphone');
		$this->session->sess_destroy();
		redirect('P/Auth/login');
	}

	public function process_forget_password()
	{
		$user = $this->M->getWhere('user',['handphone'=>trim($this->input->post('handphone'))]);
		if($user){
			$uuid = $this->service->generateSecureRandomString(30);
			$data_forget = [
				'uuid' => $uuid,
				'handphone' => $user['handphone'],
				'nik' => $user['nik']
			];
			$add_db = $this->M->add_to_db('forget_password', $data_forget);
			if($add_db){
				if($this->M->getParameter('@sendNotifWaForgetPassword') == 'Y'){
					$data_send_notif = [
						'namalengkap' => trim($user['nama_lengkap']), 
						'handphone' => trim($user['handphone']),
						'url_forget' => trim(base_url('P/Auth/forget_password/'.$uuid))
					];
					$this->service->send_whatsapp($data_send_notif, 'forget_password');
				}
				$data = $this->session->set_flashdata('pesan', 'Silahkan cek notifikasi whatsapp !');
				redirect('P/Auth/lupa_password',$data);
			}
		}else{
			$data = $this->session->set_flashdata('pesan', 'Akun belum terdaftar !');
			redirect('P/Auth/lupa_password',$data);
		}
	}

	public function process_new_password()
	{
		if(trim($this->input->post('password')) == trim($this->input->post('password1'))){
			$cek = $this->M->getWhere('forget_password',['uuid'=>trim($this->input->post('uuid'))]);
			if($cek){
				$data_send = [
					'password' => trim($this->input->post('password')),
					'password_hash' => password_hash(trim($this->input->post('password')), PASSWORD_DEFAULT)
				];
				$updatePassword = $this->M->update_to_db('user',$data_send,'handphone',$cek['handphone']);
				if($updatePassword){
					$this->M->delete_to_db('forget_password','uuid',trim($this->input->post('uuid')));
					$data = $this->session->set_flashdata('pesan', 'Reset password berhasil\nSilahkan login !');
					redirect('P/Auth/login',$data);
				}
			}else{
				$data = $this->session->set_flashdata('pesan', 'Akses gagal !');
					redirect('P/Auth/lupa_password',$data);
			}
		}else{
			$data = $this->session->set_flashdata('pesan', 'Password harus sama !');
					redirect('P/Auth/forget_password/'.trim($this->input->post('uuid')),$data);
		}	
	}
	public function checkLockAccount()
	{
		if((int)date('d') >= (int)$this->M->getParameter('@setDatePaymentDeadline') && $this->M->getParameter('@lockLoginForEveryOne') == 'N' && $this->M->getParameter('@donePaymentEveryMonth') == 'N'){
			$lockDB = $this->M->update_to_db('parameter',['value_parameter'=> 'Y'],'nama_parameter','@lockLoginForEveryOne');
		}
	}

}
