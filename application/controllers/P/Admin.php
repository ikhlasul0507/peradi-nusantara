<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		$this->load->library('service');
		$this->load->library('Pdf');
		$this->load->library('ciqrcode'); 
		if(!$this->session->userdata('id_user')){
			//jika ada user masuk sembarangan
        	$data = $this->session->set_flashdata('pesan', 'Anda Belum Login !');
			redirect('P/Auth/login',$data);
		}
	}

	public function index()
	{
		$data['list_data'] = $this->M->getAllMasterWhereOneCondition('master_kelas','is_active','Y');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/product',$data);
		$this->load->view('p/temp/footer');
	}

	public function master_product()
	{
		$data['list_data'] = $this->M->getAllData('master_kelas');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/master_product', $data);
		$this->load->view('p/temp/footer');
	}

	public function report_peserta()
	{
		$nama_lengkap = trim($this->input->post('nama_lengkap'));
		$reference = trim($this->input->post('reference'));
		$pic = trim($this->input->post('pic'));
		$angkatan = trim($this->input->post('angkatan'));
		$id_master_kelas = trim($this->input->post('id_master_kelas'));
		$status_sertifikat = trim($this->input->post('status_sertifikat'));
		$status_lunas = trim($this->input->post('status_lunas'));
		$time_history = trim($this->input->post('time_history'));
		if($nama_lengkap != "" || 
			$id_master_kelas != "" || 
			$status_sertifikat != "" || 
			$time_history != "" || 	
			$status_lunas != ""){
			$data['list_report'] = $this->M->get_report($nama_lengkap,$time_history,$id_master_kelas,$status_sertifikat,$status_lunas, $reference, $pic, $angkatan);
		}else{
			$data['list_report'] = [];
		}
		$data['list_master_kelas'] = $this->M->getAllData('master_kelas');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));

		$data['nama_lengkap'] = $nama_lengkap;
		$data['reference'] = $reference;
		$data['pic'] = $pic;
		$data['angkatan'] = $angkatan;
		$data['id_master_kelas'] = $id_master_kelas;
		$data['status_sertifikat'] = $status_sertifikat;
		$data['status_lunas'] = $status_lunas;
		$data['time_history'] = $time_history;

		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/report_peserta', $data);
		$this->load->view('p/temp/footer');
	}

	public function parameter()
	{
		$data['list_data'] = $this->M->getAllData('parameter');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/parameter', $data);
		$this->load->view('p/temp/footer');
	}

	public function MyClass()
	{
		$data['list_data'] = $this->M->getAllMasterWhereOneCondition('order_booking','id_user',$this->session->userdata('id_user'));
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/myclass',$data);
		$this->load->view('p/temp/footer');
	}

	public function master_user_peserta()
	{
		$data['list_data'] = $this->M->getAllMasterWhereOneCondition('user', 'user_level', 4);
		$data['url_level'] = $this->uri->segment(4);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/master_user',$data);
		$this->load->view('p/temp/footer');
	}

	public function master_user_admin()
	{
		$data['list_data'] = $this->M->getAllMasterWhereOneCondition('user', 'user_level', 3);
		$data['url_level'] = $this->uri->segment(4);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/master_user',$data);
		$this->load->view('p/temp/footer');
	}

	public function master_user_owner()
	{
		$data['list_data'] = $this->M->getAllMasterWhereOneCondition('user', 'user_level', 2);
		$data['url_level'] = $this->uri->segment(4);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/master_user',$data);
		$this->load->view('p/temp/footer');
	}

	public function master_user_developer()
	{
		if($this->session->userdata('user_level') == 1){
			$data['list_data'] = $this->M->getAllMasterWhereOneCondition('user', 'user_level', 1);
			$data['url_level'] = $this->uri->segment(4);
			$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
			$this->load->view('p/admin/master_user',$data);
			$this->load->view('p/temp/footer');
		}else{
			redirect('P/Admin/');
		}
	}
	

	public function OrderanClass()
	{
		$data['list_data'] = $this->M->get_order_booking_list_kelas('status_order','N');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/orderclass',$data);
		$this->load->view('p/temp/footer');
	}

	public function DoneClass()
	{
		$data['list_data'] = $this->M->get_order_booking_list_kelas('status_order','D');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/doneclass',$data);
		$this->load->view('p/temp/footer');
	}

	public function Sertifikat()
	{
		$data['list_data'] = $this->M->get_order_booking_not_approve('status_order','D');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/sertifikat',$data);
		$this->load->view('p/temp/footer');
	}

	public function daftarorderan()
	{
		$data['list_data'] = $this->M->get_order_booking_list_kelas('status_order','L');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/daftarorderan',$data);
		$this->load->view('p/temp/footer');
	}

	public function add_master_product()
	{
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/add_master_product');
		$this->load->view('p/temp/footer');
	}

	public function detail_master_product($id)
	{
		$data['list_data'] = $this->M->getWhere('master_kelas',['id_master_kelas'=>trim($id)]);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/detail_master_product', $data);
		$this->load->view('p/temp/footer');
	}

	public function show_profile()
	{
		$data['list_data'] = $this->M->getWhere('user',['id_user'=>trim($this->session->userdata('id_user'))]);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/show_profile', $data);
		$this->load->view('p/temp/footer');
	}

	public function edit_master_product($id)
	{
		$data['list_data'] = $this->M->getWhere('master_kelas',['id_master_kelas'=>trim($id)]);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/edit_master_product', $data);
		$this->load->view('p/temp/footer');
	}

	public function edit_parameter($id)
	{
		$data['list_data'] = $this->M->getWhere('parameter',['id_parameter'=>trim($id)]);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/edit_parameter', $data);
		$this->load->view('p/temp/footer');
	}

	public function valid_order($idUser, $idOrder)
	{
		$getOB = $this->M->get_order_booking_valid($idUser,$idOrder);
		$data['value'] = $getOB;
		$data['orderPayment'] = $this->M->getAllMasterWhereOneCondition('order_payment','id_order_booking',$idOrder);
		$dataSequenceDB = $this->M->getWhereOrderByLimit('order_payment',['id_order_booking'=>trim($idOrder)],1,'sequence_payment','DESC');
		if($dataSequenceDB){
			$data['sequenceNumber'] = ['sequence_payment'=> ((int)$dataSequenceDB['sequence_payment'] + 1)];
		}else{
			$data['sequenceNumber'] = ['sequence_payment'=>1];
		}
		$data['list_kelas_data'] = $this->M->get_name_kelas_list($getOB['list_kelas']);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/valid_order',$data);
		$this->load->view('p/temp/footer');
	}

	public function uploadBerkasSumpah($idUser, $idOrder)
	{
		$getOB = $this->M->get_order_booking_valid($idUser,$idOrder);
		$data['value'] = $getOB;
		$data['orderPayment'] = $this->M->getAllMasterWhereOneCondition('order_payment','id_order_booking',$idOrder);
		$dataSequenceDB = $this->M->getWhereOrderByLimit('order_payment',['id_order_booking'=>trim($idOrder)],1,'sequence_payment','DESC');
		if($dataSequenceDB){
			$data['sequenceNumber'] = ['sequence_payment'=> ((int)$dataSequenceDB['sequence_payment'] + 1)];
		}else{
			$data['sequenceNumber'] = ['sequence_payment'=>1];
		}
		$data['list_kelas_data'] = $this->M->get_name_kelas_list($getOB['list_kelas']);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['list_berkas_sumpah'] = $this->M->getWhereList('document_sumpah',['id_user'=>trim($idUser),'id_order_booking' => $idOrder]);
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/uploadBerkasSumpah',$data);
		$this->load->view('p/temp/footer');
	}

	public function open_class($idUser, $idOrder)
	{
		$getOB = $this->M->get_order_booking_valid($idUser,$idOrder);
		$data['value'] = $getOB;
		$data['orderPayment'] = $this->M->getAllMasterWhereOneCondition('order_payment','id_order_booking',$idOrder);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['list_kelas_data'] = $this->M->get_name_kelas_list($getOB['list_kelas']);
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/open_class',$data);
		$this->load->view('p/temp/footer');
	}
	
	public function process_add_master_product()
	{
		$upload = $this->service->do_upload('img','foto_kelas');
		$uploadSertifikat = $this->service->do_upload('img','foto_sertifikat');
		if($upload['code'] == 200 && $uploadSertifikat['code']){
			$data_db = [
				'nama_kelas' => trim($this->input->post('nama_kelas')),
				'deskripsi_kelas' => trim($this->input->post('deskripsi_kelas')),
				'foto_kelas' => $upload['upload_data']['file_name'],
				'metode_bayar' => trim($this->input->post('metode_bayar')),
				'is_active' => trim($this->input->post('is_active')),
				'foto_sertifikat' => $uploadSertifikat['upload_data']['file_name'],
				'link_group_wa' => trim($this->input->post('link_group_wa')),
				'is_sumpah' => trim($this->input->post('is_sumpah')),
				'prefix_certificate' => trim($this->input->post('prefix_certificate')),
			];
			$add_db = $this->M->add_to_db('master_kelas', $data_db);
			if($add_db){
				$data = $this->session->set_flashdata('pesan', 'Berhasil tambah data !');
				redirect('P/Admin/add_master_product',$data);
			}
		}else{
			$data = $this->session->set_flashdata('pesan', 'Upload foto gagal !');
			redirect('P/Admin/add_master_product',$data);
		}
	}

	public function process_edit_master_product()
	{
		$fileNameFoto = trim($this->input->post('foto_kelas_lama'));
		$fileNameFotoSertifikat = trim($this->input->post('foto_sertifikat_lama'));

		if(isset($_FILES['foto_kelas']) && $_FILES['foto_kelas']['error'] === UPLOAD_ERR_OK){
			if(trim($this->input->post('foto_kelas_lama')) != ''){
				$delete_foto = $this->service->delete_photo('img',trim($this->input->post('foto_kelas_lama')));
			}
			$upload = $this->service->do_upload('img','foto_kelas');
			$fileNameFoto = $upload['upload_data']['file_name'];
		}
		//sertifikat
		if(isset($_FILES['foto_sertifikat']) && $_FILES['foto_sertifikat']['error'] === UPLOAD_ERR_OK){
			if(trim($this->input->post('foto_sertifikat')) != ''){
				$delete_foto = $this->service->delete_photo('img',trim($this->input->post('foto_sertifikat_lama')));
			}
			$upload = $this->service->do_upload('img','foto_sertifikat');
			$fileNameFotoSertifikat = $upload['upload_data']['file_name'];
		}
		$data_db = [
			'nama_kelas' => trim($this->input->post('nama_kelas')),
			'deskripsi_kelas' => trim($this->input->post('deskripsi_kelas')),
			'foto_kelas' => $fileNameFoto,
			'metode_bayar' => trim($this->input->post('metode_bayar')),
			'is_active' => trim($this->input->post('is_active')),
			'foto_sertifikat' => $fileNameFotoSertifikat,
			'link_group_wa' => trim($this->input->post('link_group_wa')),
			'is_sumpah' => trim($this->input->post('is_sumpah')),
			'prefix_certificate' => trim($this->input->post('prefix_certificate')),
		];
		$add_db = $this->M->update_to_db('master_kelas', $data_db, 'id_master_kelas', trim($this->input->post('id_master_kelas')));
		if($add_db){
			$data = $this->session->set_flashdata('pesan', 'Berhasil edit data !');
			redirect('P/Admin/master_product',$data);
		}

	}

	public function process_edit_parameter()
	{
		$data_send_db = [
			'value_parameter' => trim($this->input->post('value_parameter')),
		];
		$add_db = $this->M->update_to_db('parameter', $data_send_db, 'id_parameter', trim($this->input->post('id_parameter')));
		if($add_db){
			$data = $this->session->set_flashdata('pesan', 'Berhasil edit data !');
			redirect('P/Admin/parameter',$data);
		}

	}

	public function process_edit_user_profile()
	{
		$data_send_db = [
			'nama_lengkap' => trim($this->input->post('nama_lengkap')),
			'nik' => trim($this->input->post('nik')),
			'email' => trim($this->input->post('email')),
			'handphone' => trim($this->input->post('handphone')),
		];
		$add_db = $this->M->update_to_db('user', $data_send_db, 'id_user', trim($this->session->userdata('id_user')));
		if($add_db){
			$data = $this->session->set_flashdata('pesan', 'Berhasil perbaharui data !');
			redirect('P/Admin/show_profile',$data);
		}
	}

	public function delete_cart_product($id_master_kelas)
	{
		if($id_master_kelas){
			$data = $this->M->getWhere('cart',['id_master_kelas'=>trim($id_master_kelas), 'id_user'=>trim($this->session->userdata('id_user'))]);
			if($data){
				$this->M->delete_to_db('cart','id_cart',$data['id_cart']);
				$data = $this->session->set_flashdata('pesan', 'Berhasil di hapus !');
				redirect('P/Admin',$data);
			}else{
				$data = $this->session->set_flashdata('pesan', 'Gagal di hapus !');
				redirect('P/Admin',$data);
			}
		}else{
			$data = $this->session->set_flashdata('pesan', 'Gagal di hapus !');
			redirect('P/Admin',$data);
		}
	}
	public function delete_master_product($id)
	{
		if($id){
			$data = $this->M->getWhere('master_kelas',['id_master_kelas'=>trim($id)]);
			if($data){
				$delete_foto = $this->service->delete_photo('img',$data['foto_kelas']);
				if($delete_foto['code'] == 200){
					$this->M->delete_to_db('master_kelas','id_master_kelas',$id);
					$data = $this->session->set_flashdata('pesan', 'Berhasil di hapus !');
					redirect('P/Admin/master_product',$data);
				}else{
					$data = $this->session->set_flashdata('pesan', 'Gagal di hapus !');
					redirect('P/Admin/master_product',$data);
				}
			}else{
				$data = $this->session->set_flashdata('pesan', 'Gagal di hapus !');
				redirect('P/Admin/master_product',$data);
			}
		}else{
			$data = $this->session->set_flashdata('pesan', 'Gagal di hapus !');
			redirect('P/Admin/master_product',$data);
		}
	}

	public function process_order_product()
	{
		$data = $this->M->getWhere('order_booking',['id_user'=>trim($this->input->post('id_user')),'id_master_kelas' =>trim($this->input->post('id_master_kelas')) ]);
		if(!$data){
			$data_db = [
				'id_user' => trim($this->input->post('id_user')),
				'id_master_kelas' => trim($this->input->post('id_master_kelas')),
				'metode_bayar' => trim($this->input->post('metode_bayar')),
				'status_order' => 'N'
			];
			$add_db = $this->M->add_to_db('order_booking', $data_db);
			if($add_db){
				if($this->M->getParameter('@sendNotifOrderClass') == 'Y'){
					$data_send_notif = [
						'handphone' => trim($this->session->userdata('handphone')),
						'namalengkap' => trim($this->session->userdata('nama_lengkap')),
						'namaKelas' => trim($this->input->post('nama_kelas')),
						'metodeBayar' => trim($this->input->post('metode_bayar')),
					];
					$this->service->send_whatsapp($data_send_notif, 'order_class');
				}
				$data = $this->session->set_flashdata('pesan', 'Kelas berhasil di pesan !');
				redirect('P/Admin/myclass',$data);
			}
			echo json_encode($add_db);
		}else{
			$data = $this->session->set_flashdata('pesan', 'Kelas sudah pernah di pesan !');
			redirect('P/Admin',$data);
		}
	}

	public function process_order_product_list()
	{
		// $data = $this->M->getWhere('order_booking',['id_user'=>trim($this->input->post('id_user')),'id_master_kelas' =>trim($this->input->post('id_master_kelas')) ]);

		$dataKelas = $this->M->get_name_kelas_list(trim($this->input->post('list_kelas')));
		// if(!$data){
			$data_db = [
				'id_user' => trim($this->session->userdata('id_user')),
				'id_master_kelas' => 0,
				'metode_bayar' => trim($this->input->post('metode_bayar')),
				'status_order' => 'N',
				'list_kelas' => trim($this->input->post('list_kelas')),
			];
			$add_db = $this->M->add_to_db('order_booking', $data_db);
			if($add_db){
				$this->M->delete_to_db('cart','id_user',trim($this->session->userdata('id_user')));
				if($this->M->getParameter('@sendNotifOrderClass') == 'Y'){
					$data_send_notif = [
						'handphone' => trim($this->session->userdata('handphone')),
						'namalengkap' => trim($this->session->userdata('nama_lengkap')),
						'namaKelas' => trim($dataKelas['nama_kelas']),
						'metodeBayar' => trim($this->input->post('metode_bayar')),
					];
					$this->service->send_whatsapp($data_send_notif, 'order_class');
				}
				$data = $this->session->set_flashdata('pesan', 'Kelas berhasil di pesan !');
				redirect('P/Admin/myclass',$data);
			}
			// echo json_encode($add_db);
		// }else{
		// 	$data = $this->session->set_flashdata('pesan', 'Kelas sudah pernah di pesan !');
		// 	redirect('P/Admin',$data);
		// }
	}

	public function add_order_cart($id_master_kelas)
	{
		$data = $this->M->getWhere('cart',['id_user'=>trim($this->session->userdata('id_user')),'id_master_kelas' =>trim($id_master_kelas)]);
		if(!$data){
			$data_db = [
				'id_user' => trim($this->session->userdata('id_user')),
				'id_master_kelas' => trim($id_master_kelas),
			];
			$add_db = $this->M->add_to_db('cart', $data_db);
			if($add_db){
				$data = $this->session->set_flashdata('pesan', 'Berhasil dimasukan ke keranjang !');
				redirect('P/Admin',$data);
			}
		}else{
			$data = $this->session->set_flashdata('pesan', 'Kelas sudah ada di keranjang !');
			redirect('P/Admin',$data);
		}
	}

	public function process_valid_order($id_user, $idOrder)
	{
		$data = $this->M->getWhere('order_booking',['id_user'=>trim($id_user),'id_order_booking' =>trim($idOrder)]);
		if($data){
			$update = $this->M->update_to_db('order_booking',['status_order'=>'L'],'id_order_booking',$idOrder);
			if($update){
				$user = $this->M->getWhere('user',['id_user'=>trim($id_user)]);
				
				$array = explode("~", $data['list_kelas']);
                $array = array_filter($array, function($value) {
                    return $value !== '';
                });
                $inClause = implode(",", $array);
                $query = "SELECT GROUP_CONCAT(nama_kelas)AS nama_kelas , foto_kelas, GROUP_CONCAT(link_group_wa) AS link_group_wa  FROM master_kelas WHERE id_master_kelas IN ($inClause)";
                $getListKelas = $this->db->query($query)->row_array();


				if($user){
					if($this->M->getParameter('@sendNotifValidOrderClass') == 'Y'){
						$data_send_notif = [
							'handphone' => trim($user['handphone']),
							'namalengkap' => trim($user['nama_lengkap']),
							'namaKelas' => trim($getListKelas['nama_kelas']),
							'metodeBayar' => trim($data['metode_bayar']),
						];
						$this->service->send_whatsapp($data_send_notif, 'valid_order_class');
					}
				}
				$data = $this->session->set_flashdata('pesan', 'Validasi order berhasil !');
				redirect('P/Admin/valid_order/'.$id_user.'/'.$idOrder,$data);
			}else{
				$data = $this->session->set_flashdata('pesan', 'Valid order gagal !');
				redirect('P/Admin/valid_order/'.$id_user.'/'.$idOrder,$data);
			}
		}else{	
			$data = $this->session->set_flashdata('pesan', 'User dan Order tidak ditemukan !');
			redirect('P/Admin/valid_order/'.$id_user.'/'.$idOrder,$data);
		}
	}

	public function process_add_order_payment()
	{
		$data = $this->M->getWhere('order_payment',['id_order_booking'=>trim($this->input->post('id_order_booking')),'sequence_payment' =>trim($this->input->post('sequence_payment')) ]);
		if(!$data){
			$id_virtual_account = $this->service->generateSecureRandomString(40);
			$rupiah = $this->input->post('nominal_payment');
			$data_send_db = [
				'id_order_booking' => trim($this->input->post('id_order_booking')),
				'id_virtual_account' => trim($id_virtual_account),
				'sequence_payment' => trim($this->input->post('sequence_payment')),
				'nominal_payment' => (int) str_replace(['Rp', '.', ' '], '', $rupiah),
				'date_payment' => trim($this->input->post('date_payment')),
				'status_payment' => 'P'
			];
			$add_db = $this->M->add_to_db('order_payment', $data_send_db);
			if($add_db){
				if($this->M->getParameter('@sendNotifGeneratePayment') == 'Y'){
					$orderPayment = $this->M->getWhere('order_payment',['id_virtual_account'=>trim($id_virtual_account)]);
					$orderBook = $this->M->getWhere('order_booking',['id_order_booking'=>trim($this->input->post('id_order_booking'))]);
					if($orderBook){
						
						$array = explode("~", $orderBook['list_kelas']);
                        $array = array_filter($array, function($value) {
                            return $value !== '';
                        });
                        $inClause = implode(",", $array);
                        $query = "SELECT GROUP_CONCAT(nama_kelas)AS nama_kelas , foto_kelas, GROUP_CONCAT(link_group_wa) AS link_group_wa  FROM master_kelas WHERE id_master_kelas IN ($inClause)";
                        $getListKelas = $this->db->query($query)->row_array();


						$user = $this->M->getWhere('user',['id_user'=>trim($orderBook['id_user'])]);
						$data_send_notif = [
							'handphone' => trim($user['handphone']),
							'namalengkap' => trim($user['nama_lengkap']),
							'namaKelas' => trim($getListKelas['nama_kelas']),
							'metodeBayar' => trim($orderBook['metode_bayar']),
							'nominal_payment' => number_format(trim($orderPayment['nominal_payment']), 2),
							'date_payment' => trim($orderPayment['date_payment']),
							'url_virtual_account' => trim(base_url('P/Payment/virtual_account/'.$orderPayment['id_virtual_account']))
						];
						if(trim($this->input->post('sequence_payment')) == 1){
							$this->service->send_whatsapp($data_send_notif, 'generate_payment');
						}else{
							$this->service->send_whatsapp($data_send_notif, 'generate_payment',trim($orderPayment['date_payment']));
						}
					}
				}
			}
			$data = $this->session->set_flashdata('pesan', 'Generate Payment Berhasil !');
			redirect('P/Admin/valid_order/'.trim($this->input->post('id_user')).'/'.trim($this->input->post('id_order_booking')),$data);
		}else{
			$data = $this->session->set_flashdata('pesan', 'Urutan orderan sudah ada !');
			redirect('P/Admin/valid_order/'.trim($this->input->post('id_user')).'/'.trim($this->input->post('id_order_booking')),$data);
		}
	}

	public function delete_order_class($idOrder)
	{
		if($idOrder){
			$order = $this->M->getWhere('order_booking',['id_order_booking'=>trim($idOrder)]);
			if($order){
				$this->M->delete_to_db('order_booking','id_order_booking',$idOrder);
				$data = $this->session->set_flashdata('pesan', 'Berhasil hapus order !');
				redirect('P/Admin/OrderanClass',$data);
			}else{
				$data = $this->session->set_flashdata('pesan', 'gagal hapus order !');
				redirect('P/Admin/OrderanClass',$data);
			}
		}else{
			$data = $this->session->set_flashdata('pesan', 'gagal hapus order !');
			redirect('P/Admin/OrderanClass',$data);
		}
	}

	public function delete_order_payment($id_user, $idOrderPayment)
	{
		if($idOrderPayment){
			$payment = $this->M->getWhere('order_payment',['id_order_payment'=>trim($idOrderPayment)]);
			if($payment){
				$this->M->delete_to_db('order_payment','id_order_payment',$idOrderPayment);
				$data = $this->session->set_flashdata('pesan', 'Berhasil hapus order !');
				redirect('P/Admin/valid_order/'.trim($id_user).'/'.trim($payment['id_order_booking']),$data);
			}else{
				$data = $this->session->set_flashdata('pesan', 'gagal hapus order !');
				redirect('P/Admin/valid_order/'.trim($id_user).'/'.trim($payment['id_order_booking']),$data);
			}
		}else{
			$data = $this->session->set_flashdata('pesan', 'gagal hapus order !');
			redirect('P/Admin/valid_order/'.trim($id_user).'/'.trim($payment['id_order_booking']),$data);
		}
	}

	public function approve_certificate()
	{
		$list_id_order = explode(",", $this->input->get('list_id_order'));
		$dataJadwal = $this->input->get('dataJadwal')['data'];

		$check = false;
		foreach ($list_id_order as $val) {
			$update = $this->M->update_to_db('order_booking',['status_certificate'=>'A'],'id_order_booking',$val);
			$orderB = $this->M->getWhere('order_booking',['id_order_booking'=>trim($val)]);

			$incPKPAUPA = 0;
			$isPKPA = false;
			$isUPA= false;
			$idPKPA = 0;
			$idUPA = 0;
			$startNumber = 0;
			$list_kelas = explode("~", $orderB['list_kelas']);
			foreach ($list_kelas as $valIDKelas) {
				if($valIDKelas != ""){
					$qrCodeName = $this->service->generateSecureRandomString(40);
					$this->generateQRCODE($orderB['id_user'], $val, $valIDKelas, $qrCodeName);

					$getMK = $this->M->getWhere('master_kelas',['id_master_kelas'=>trim($valIDKelas)]);
					$stringJadwal = "";

					if (strpos($getMK['nama_kelas'], 'PKPA') !== false) {
						$stringJadwal = $dataJadwal['jadwal_pkpa'];
						$startNumber = (int) $this->M->getParameter('@startNumberCertificatePKPA'); //from parameter
					}else if (strpos($getMK['nama_kelas'], 'PARALEGAL') !== false) {
						$stringJadwal = $dataJadwal['jadwal_paralegal'];
						$startNumber = (int) $this->M->getParameter('@startNumberCertificateParalegal'); //from parameter
					}else if (strpos($getMK['nama_kelas'], 'UPA') !== false) {
						$stringJadwal = $dataJadwal['jadwal_upa'];
						$startNumber = (int) $this->M->getParameter('@startNumberCertificateUPA'); //from parameter
					}else if (strpos($getMK['nama_kelas'], 'BREVET') !== false) {
						$stringJadwal = $dataJadwal['jadwal_brevet'];
						$startNumber = (int) $this->M->getParameter('@startNumberCertificateBREVET'); //from parameter
					}else if (strpos($getMK['nama_kelas'], 'CPT') !== false) {
						$stringJadwal = $dataJadwal['jadwal_cpt'];
						$startNumber = (int) $this->M->getParameter('@startNumberCertificateCPT'); //from parameter
					}


					//number certificate
					$createNumber = "";
					$getCer = $this->db->query("SELECT number_certificate FROM approve_cetificate WHERE id_master_kelas = '$valIDKelas' ORDER BY number_certificate DESC LIMIT 1")->row_array();
					if($getCer){
						$createNumber = (int) $getCer['number_certificate'] + 1;
					}else{
						$createNumber = $startNumber;
					}


					if (strpos($getMK['nama_kelas'], 'UPA') !== false) {
						$incPKPAUPA = $createNumber;
						$isUPA = true;
						$idPKPA = (int) $this->M->getParameter('@idMasterPKPAForLogicApprove'); //from parameter
					}
					if (strpos($getMK['nama_kelas'], 'PKPA') !== false) {
						$incPKPAUPA = $createNumber;
						$isPKPA = true;
						$idUPA = (int) $this->M->getParameter('@idMasterUPAForLogicApprove'); //from parameter
					}
					$send_db = [
						'id_user' => $orderB['id_user'],
						'id_order_booking' => $val,
						'id_master_kelas' => $valIDKelas,
						'number_certificate' => $createNumber,
						'count_print' => 0,
						'qr_code_name' => $qrCodeName.'.png',
						'jadwal_pelatihan'=> $stringJadwal
					];
					$add_db = $this->M->add_to_db('approve_cetificate', $send_db);
				}
			}
			if($isUPA && !$isPKPA){
				$send_db = [
					'id_user' => $orderB['id_user'],
					'id_order_booking' => $val,
					'id_master_kelas' => $idPKPA,
					'number_certificate' => $incPKPAUPA,
					'count_print' => 0,
					'qr_code_name' => $qrCodeName.'.png',
					'jadwal_pelatihan'=> $stringJadwal
				];
				$add_db = $this->M->add_to_db('approve_cetificate', $send_db);
			}else if(!$isUPA && $isPKPA){
				$send_db = [
					'id_user' => $orderB['id_user'],
					'id_order_booking' => $val,
					'id_master_kelas' => $idUPA,
					'number_certificate' => $incPKPAUPA,
					'count_print' => 0,
					'qr_code_name' => $qrCodeName.'.png',
					'jadwal_pelatihan'=> $stringJadwal
				];
				$add_db = $this->M->add_to_db('approve_cetificate', $send_db);
			}
			// $send_db = [
			// 	'id_user' => $orderB['id_user'],
			// 	'id_order_booking' => $val,
			// 	'number_certificate' => 123,
			// 	'count_print' => 0
			// ];
			// $add_db = $this->M->add_to_db('approve_cetificate', $send_db);
			// if($add_db){
			// 	$check = true;
			// 	if($this->M->getParameter('@sendNotifApproveCertificate') == 'Y'){
			// 		$master_kelas = $this->M->getWhere('master_kelas',['id_master_kelas'=>trim($orderB['id_master_kelas'])]);
			// 		$user = $this->M->getWhere('user',['id_user'=>trim($orderB['id_user'])]);
			// 		$data_send_notif = [
			// 			'handphone' => trim($user['handphone']),
			// 			'namalengkap' => trim($user['nama_lengkap']),
			// 			'namaKelas' => trim($master_kelas['nama_kelas']),
			// 			'url_certificate' => trim(base_url('P/Admin/generateCertificate/'.$orderB['id_user'].'/'.trim($val)))
			// 		];
			// 		$sendWa = $this->service->send_whatsapp($data_send_notif, 'approve_certificate');
			// 		if($sendWa){
						$check = true;
			// 		}

			// 	}
			// }

		}
		if($check){
			echo json_encode(['status_code' => 200, '$dataJadwal' => $dataJadwal]);
		}else{
			echo json_encode(['status_code' => 400]);
		}
	}

	

	public function process_add_master_user($level)
	{
		$data_register = [
			'nama_lengkap' => trim($this->input->post('nama_lengkap')),
			'nik' => trim($this->input->post('nik')),
			'email' => trim($this->input->post('email')),
			'handphone' => trim($this->input->post('handphone')),
			'usia' => trim($this->input->post('usia')),
			'asal_kampus' => trim($this->input->post('asal_kampus')),
			'semester' => trim($this->input->post('semester')),
			'password' => trim($this->input->post('password')),
			'password_hash' => password_hash(trim($this->input->post('password')), PASSWORD_DEFAULT),
			'is_active' => 'Y',
			'user_level' => $level
		];

		echo json_encode($data_register);
		
		$checkUserExist =  $this->M->checkUserExist(trim($this->input->post('nik')), trim($this->input->post('handphone')));
		// die;
		if($checkUserExist < 1){
			$add_db = $this->M->add_to_db('user', $data_register);
			if($add_db){
				$data_history = [
					'nik' =>trim($this->input->post('nik')),
					'action' => "Pendaftaran Akun Baru"
				];
				$add_history = $this->M->add_log_history($data_history);
				if($add_history){
					if($this->M->getParameter('@sendNotifWaRegister') == 'Y'){
						$data_send_notif = [
							'handphone' => trim($this->input->post('handphone')),
							'namalengkap' => trim($this->input->post('namalengkap'))
						];
						$this->service->send_whatsapp($data_send_notif, 'new_register');
					}
				}
				$data = $this->session->set_flashdata('pesan', 'Akun berhasil terdaftar !');
				redirect($this->checkURLUser($level),$data);
			}
		}else{
			$data = $this->session->set_flashdata('pesan', 'Akun telah terdaftar !');
			redirect($this->checkURLUser($level),$data);
		}
	}

	public function checkURLUser($level){
		if($level == 1){
			return "P/Admin/master_user_developer/".$level;
		}else if($level == 2){
			return "P/Admin/master_user_owner/".$level;
		}else if($level == 3){
			return "P/Admin/master_user_admin/".$level;
		}else if($level == 4){
			return "P/Admin/master_user_peserta/".$level;
		}
	}


	public function generateQRCODE($id_user,$id_order_booking, $id_master_kelas, $qr_code_name)
	{
		$config['cacheable']    		= true; //boolean, the default is true
        $config['cachedir']             = './assets/'; //string, the default is application/cache/
        $config['errorlog']             = './assets/'; //string, the default is application/logs/
        $config['imagedir']             = './assets/p/qrcode/'; //direktori penyimpanan qr code
        $config['quality']              = true; //boolean, the default is true
        $config['size']                 = '1024'; //interger, the default is 1024
        $config['black']                = array(224,255,255); // array, default is array(255,255,255)
        $config['white']                = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $qr_code_name.'.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = base_url('P/Payment/getDetailQRCODE/'.$id_user.'/'.$id_order_booking.'/'.$id_master_kelas); //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
	}

	public function do_upload_document($id_order_booking) {

		// $config['upload_path'] = './assets/p/document';
  //       $config['allowed_types'] = 'gif|jpg|png'; // Add or modify file types as needed
  //       $config['max_size'] = 2048; // Max size in kilobytes (2MB)
       
        $dataOB = $this->M->getWhere('order_booking',['id_order_booking'=>trim($id_order_booking)]);

        $files = ['ktp', 'magang', 'skpidana', 'sppns', 'ijazah', 'fcpkpa', 'fcupa', 'skadvokat', 'skck'];

        $cekData = $this->M->getWhereList('document_sumpah',['id_user'=>trim($dataOB['id_user']),'id_order_booking' => $id_order_booking]);
        if($cekData){
        	foreach ($cekData as $key => $value) {
        		$delete_foto = $this->service->delete_photo('document',$value['document_name']);
        	}
        	$this->M->delete_to_db('document_sumpah','id_order_booking',$id_order_booking);
        }

        $checkUpload = false;
        foreach ($files as $file) {
        	$upload = $this->service->do_upload('document','file-upload-' .$file);
			
            if ($upload && $upload['code'] == 200) {
            	$fileNameDoc = $upload['upload_data']['file_name'];
            	$send_db = [
					'id_user' => $dataOB['id_user'],
					'id_order_booking' => $id_order_booking,
					'jenis_dokument' => $file,
					'document_name' => $fileNameDoc
				];
				$add_db = $this->M->add_to_db('document_sumpah', $send_db);
                $data = $this->upload->data();
                echo "File " . $file . " uploaded successfully!";
                $checkUpload = true;
    //            
            } else {
                echo "Error uploading file " . $file . ": " . $this->upload->display_errors();
            }

        }

        if($checkUpload){
        	$data = $this->session->set_flashdata('pesan', 'Berhasil Upload Semua Berkas Sumpah !');
			$this->redirectUpload($data, $id_order_booking, $dataOB['id_user']);
		}
    }


    public function redirectUpload($data, $id_order_booking, $id_user)
    {
    	 redirect('P/Admin/uploadBerkasSumpah/'.trim($id_user).'/'.trim($id_order_booking),$data);
    }

    public function generateFormSumpah($id_user) {

    	if($id_user){
    		$data = $this->M->getWhere('user',['id_user'=>trim($id_user)]);
    		if($data){
		        // Create instance of FPDF
		        $pdf = new FPDF();
		        $pdf->AddPage();
		        
		        // Add Header (Logo and Title)
		        $pdf->Image(base_url('assets/p/img/bg_form_sumpah.jpg'),0,0,210);  // Adjust the path to your logo
		        $pdf->Ln(30);
		        $pdf->SetFont('Arial','B',12);
		        $pdf->Cell(0,10,'FORMULIR PENDAFTARAN PENYUMPAHAN ADVOKAT PENGADILAN TINGGI',0,1,'C');
		        $pdf->Ln(10);
		        // Add form fields
		        $pdf->SetFont('Arial', '', 12);
		        $pdf->Cell(50, 6, '1. Nama', 0, 0);
		        $pdf->Cell(100, 6, ': '.$data['nama_lengkap'], 0, 1);

		        $pdf->Cell(50, 6, '2. Jenis Kelamin', 0, 0);
		        $pdf->Cell(100, 6, ': Laki-laki/Perempuan', 0, 1);

		        $pdf->Cell(50, 6, '3. Tempat/Tgl. Lahir', 0, 0);
		        $pdf->Cell(100, 6, ': .............................................', 0, 1);

		        $pdf->Cell(50, 6, '4. Agama', 0, 0);
		        $pdf->Cell(100, 6, ': .............................................', 0, 1);

		        $pdf->Cell(50, 6, '5. Alamat', 0, 0);
		        $pdf->Cell(100, 6, ': .............................................', 0, 1);

		        $pdf->Cell(50, 6, '6. NIK', 0, 0);
		        $pdf->Cell(100, 6, ': .............................................', 0, 1);

		        $pdf->Cell(50, 6, '7. No. Telpon', 0, 0);
		        $pdf->Cell(100, 6, ': '.$data['handphone'], 0, 1);

		        $pdf->Cell(50, 6, '8. Organisasi', 0, 0);
		        $pdf->Cell(100, 6, ': PERSAUDARAAN ADVOKATINDO NUSANTARA', 0, 1);

		        $pdf->SetFont('Arial', 'B', 12);
		        $pdf->Cell(50, 6, '9. Dokumen Pelangkap', 0, 0);

		        $pdf->Ln(10);
		        // Table creation
			
		        // Add Table
		        $header = ['No', 'Nama Dokumen', 'Sistem', 'Verifikator'];
		        $w = [10, 130, 20, 30];

		        // Set header
		        $pdf->SetFont('Arial','B',10);
		        for($i=0;$i<count($header);$i++)
		            $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
		        $pdf->Ln();

		        // Set data
		        $data = [
		            ['1', 'Fotocopy Kartu Tanda Penduduk (KTP)/Surat Izin Mengemudi (SIM)', 'OK', ''],
		            ['2', 'Surat Keterangan Magang minimal 2 tahun berturut-turut', 'OK', ''],
		            ['3', 'Surat Keterangan tidak pernah pidana atau diancam hukuman pidana 5 tahun', 'OK', ''],
		            ['', 'dari Pengadilan Negeri Domisili setempat', '', ''],
		            ['4', 'Surat pernyataan tidak berstatus Aparat Sipil Negara (ASN) (PNS, TNI, POLRI,', 'OK', ''],
		            ['', 'Notaris, Pejabat Negara)', '', ''],
		            ['5', 'Fotocopy Ijazah Sekolah Tinggi Hukum dilegalisir Basah', 'OK', ''],
		            ['6', 'Fotocopy Pendidikan Khusus Profesi Advokat (PKPA)', 'OK', ''],
		            ['7', 'Fotocopy Sertifikat Pelatihan Advokat dan Lulus Ujian Profesi Advokat', 'OK', ''],
		            ['8', 'Fotocopy SK Pengangkatan Advokat', 'OK', ''],
		            ['9', 'Surat Keterangan Berprilaku Baik, Jujur, Bertanggung Jawab, adil', 'OK', ''],
		            ['', 'dan mempunyai Integritas yang tinggi', '', ''],
		        ];

		        // Add rows
		        $pdf->SetFont('Arial','',10);
		        foreach($data as $row) {
		            $pdf->Cell($w[0],6,$row[0],'LR',0,'C');
		            $pdf->Cell($w[1],6,$row[1],'LR');
		            $pdf->Cell($w[2],6,$row[2],'LR',0,'C');
		            $pdf->Cell($w[3],6,$row[3],'LR',0,'C');
		            $pdf->Ln();
		        }
		        
		        // Closing line
		        $pdf->Cell(array_sum($w),0,'','T');
		        $pdf->Ln(5);
		        $pdf->SetFont('Arial','B',12);
		        $pdf->Cell(50, 6, '10. Keterangan : Sudah memenuhi syarat untuk diambil sumpah sebagai ADVOKAT', 0, 1);
		         $pdf->Ln(5);
		        $pdf->SetFont('Arial','',10);
		        $pdf->Cell(50, 6, 'Catatan :', 0, 1);
		         $pdf->Cell(50, 6, 'Kirimankan dokumen fisik yang sudah lengkap ke alamat Cluster Angelonia Blok A1 No B6 Medang', 0, 1);
		          $pdf->Cell(50, 6, 'Pagedangan Tangerang Banten dan pastikan bahwa administrasi sudah lunas', 0, 0);
		        $pdf->Ln(18);
		        $pdf->SetFont('Arial','B',12);
		        $pdf->Cell(50, 6, 'Verifikator', 0, 0);
		        $pdf->Ln(25);
		        $pdf->Cell(50, 6, 'Handy', 0, 0);
		        // Output the PDF
		        // $pdf->Output('D', 'Formulir_Pendaftaran.pdf');  // Forces download

		        $pdf->SetXY(162,60);
		        $pdf->Cell(38, 50, 'Foto 3x4', 1,0,'C'); // Draw an empty box

		        $pdf->Output();
	    	}else{
	    		echo "Data Tidak Di Temukan";
	    	}
    	}
    }
}