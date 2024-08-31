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

		if(!$this->session->userdata('email')){
			//jika ada user masuk sembarangan
        	$data = $this->session->set_flashdata('pesan', 'Anda Belum Login !');
			redirect('L_a',$data);
		}
	}

	public function index()
	{
		$this->rekapHasil();
	}
	public function lihat($id_p){
		$data['ps'] = $this->M->listpsby($id_p);
		$data['hasilps'] = $this->M->hasilPs($id_p);
		$data['title'] = "Halaman Detail Peserta";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/lihat',$data);
		$this->load->view('admin/temp/footer');
	}
	public function ver($id_p){
		$a = $this->db->query("UPDATE tbl_peserta SET _st_byr='1',_st_p='1' WHERE id_p='$id_p'");
		if ($a) {
			$data = $this->session->set_flashdata('pesan','Verifikasi Berhasil');
			redirect('Admin/ps',$data);
		} 
	}
	public function dp()
	{
		$data['ps'] = $this->M->ps_t();
		$data['title'] = "Halaman Peserta";
		$this->load->view('admin/temp/header',$data);
		if($this->M->getParameter('@usingDataWithAPI') == 1){
			$this->load->view('admin/api-p_ter',$data);
		}else{
			$this->load->view('admin/p_ter',$data);
		}
		$this->load->view('admin/temp/footer');
	}
	public function duser()
	{
		$data['ps'] = $this->M->d_u();
		$data['dTabel'] = $this->M->dTabel();
		$data['title'] = "Halaman User";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/user',$data);
		$this->load->view('admin/temp/footer');
	}
	public function historyVoucherExpired()
	{
		$data['ps'] = $this->M->d_u();
		$data['dTabel'] = $this->M->dTabel();
		$data['title'] = "Halaman historyVoucherExpired";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/historyVoucherExpired',$data);
		$this->load->view('admin/temp/footer');
	}
	public function parameter()
	{
		$data['ps'] = $this->M->d_u();
		$data['dTabel'] = $this->M->dTabel();
		$data['title'] = "Halaman User";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/parameter',$data);
		$this->load->view('admin/temp/footer');
	}
	public function t_a()
	{
		$data['title'] = "Halaman Tambah User";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/ta',$data);
		$this->load->view('admin/temp/footer');
	}
	public function setPrintVoucher()
	{
		$data['title'] = "Halaman Set Voucher";
		$data['dp'] = $this->M->setPrintVoucher();
		$data['activePrintVoucher'] = $this->M->getParameter('@activePrintVoucher');
		$data['optionsNominalVoucher'] = $this->M->getParameter('@optionsNominalVoucher');

		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/setPrintVoucher',$data);
		$this->load->view('admin/temp/footer');
	}
	public function t_paramater()
	{
		$data['title'] = "Halaman Tambah Parameter";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/taParameter',$data);
		$this->load->view('admin/temp/footer');
	}
	public function p_ta()
	{
		$data=[
			'email' => htmlspecialchars($this->input->post('email')),
			'password' => htmlspecialchars($this->input->post('password')),
		];
		$query = $this->db->query("SELECT * FROM tbl_admin")->result_array();
		if(count($query) < 5){
			$this->db->insert('tbl_admin',$data);
			$data = $this->session->set_flashdata('pesan','Berhasil Tambah User Admin');
		}else{
			$data = $this->session->set_flashdata('pesan','User Sudah Penuh !');
		}
		redirect('Admin/duser',$data);
	}

	public function p_taParameter()
	{
		$data=[
			'namaParameter' => htmlspecialchars($this->input->post('namaParameter')),
			'valueParameter' => htmlspecialchars($this->input->post('valueParameter')),
			'typeParameter' => htmlspecialchars($this->input->post('typeParameter'))
		];
	
			$this->db->insert('tbl_parameter',$data);
			$data = $this->session->set_flashdata('pesan','Berhasil Tambah Parameter');
		
		redirect('Admin/Parameter',$data);
	}

	public function resetVote1(){
		$this->db->query("DELETE FROM tbl_vt");
		$data = $this->session->set_flashdata('pesan','Berhasil Di Reset Vote 1');
		redirect('Admin/duser',$data);

	}
	public function resetVote2(){
		$this->db->query("DELETE FROM tbl_vt1");
		$data = $this->session->set_flashdata('pesan','Berhasil Di Reset Vote 2');
		redirect('Admin/duser',$data);

	}
	public function h_a($id_a)
	{
		$this->db->query("DELETE FROM tbl_admin WHERE id_a='$id_a'");
		$data = $this->session->set_flashdata('pesan','Berhasil Di Hapus');
		redirect('Admin/duser',$data);

	}
	public function h_parameter($id_a)
	{
		$this->db->query("DELETE FROM tbl_parameter WHERE idParameter='$id_a'");
		$data = $this->session->set_flashdata('pesan','Berhasil Di Hapus');
		redirect('Admin/parameter',$data);

	}
	public function e_p()
	{
		$data = array( 'title' => 'Laporan Excel | Peserta','ps' => $this->M->ps_t());
		$this->load->view('admin/e_ps',$data);
	}
	public function e_c()
	{
		$data = array( 'title' => 'Laporan  | Peserta','ps' => $this->M->ps_t());
		$this->load->view('admin/e_c',$data);
	}
	public function hp($id_p)
	{
		$this->db->query("DELETE FROM tbl_peserta WHERE id_p='$id_p'");
		$data = $this->session->set_flashdata('pesan','Berhasil Di Hapus');
		redirect('Admin/dp',$data);

	}
	public function o_r()
	{
		$this->db->query("UPDATE tbl_set SET set_daftar='1' WHERE id_set='1'");
		$data = $this->session->set_flashdata('pesan','Registrasi Di Buka');
		redirect('Admin/dp',$data);
	}
	public function c_r()
	{
		$this->db->query("UPDATE tbl_set SET set_daftar='0' WHERE id_set='1'");
		$data = $this->session->set_flashdata('pesan','Registrasi Di Tutup');
		redirect('Admin/dp',$data);
	}
	public function ht()
	{
		$data['ps'] = $this->M->p_dft();
		$data['title'] = "Halaman Hasil Tes";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/ht',$data);
		$this->load->view('admin/temp/footer');
	}
	public function o_s()
	{
		$this->db->query("UPDATE tbl_set SET set_soal='1' WHERE id_set='1'");
		$data = $this->session->set_flashdata('pesan','Soal Di Buka');
		redirect('Admin/ht',$data);
	}
	public function c_s()
	{
		$this->db->query("UPDATE tbl_set SET set_soal='0' WHERE id_set='1'");
		$data = $this->session->set_flashdata('pesan','Soal Di Tutup');
		redirect('Admin/ht',$data);
	}
	public function e_ht()
	{
		$data = array( 'title' => 'Laporan Excel | Hasil TES ONLINE','ps' => $this->M->p_dft());
		$this->load->view('admin/e_ht',$data);
	}
	public function c_ht()
	{
		$data = array( 'title' => 'Laporan Cetak | Hasil TES ONLINE','ps' => $this->M->p_dft());
		$this->load->view('admin/c_ht',$data);
	}
	public function htg()
	{
		$data['ps'] = $this->M->p_dftg();
		$data['title'] = "Halaman Hasil Tes Gagal";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/htg',$data);
		$this->load->view('admin/temp/footer');
	}
	public function uu($id_p)
	{
		$this->db->query("UPDATE tbl_peserta SET _st_soal='0' WHERE id_p='$id_p'");
		$data = $this->session->set_flashdata('pesan','Ujian Ulang');
		redirect('Admin/htp',$data);
	}

	public function u_parameter($id_p)
	{
		echo $id_p;die;
		$this->db->query("UPDATE tbl_peserta SET _st_soal='0' WHERE id_p='$id_p'");
		$data = $this->session->set_flashdata('pesan','Ujian Ulang');
		redirect('Admin/htp',$data);
	}

	public function htp()
	{
		$data['ps'] = $this->M->ps_t();
		$data['title'] = "Halaman Peserta";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/htp',$data);
		$this->load->view('admin/temp/footer');
	}
	public function dvc()
	{
		$data['vc'] = $this->M->dvc();
		$data['title'] = "Halaman Pembelian Voucher";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/dvc',$data);
		$this->load->view('admin/temp/footer');
	}
	public function v_s()
	{
		$this->db->query("UPDATE tbl_set SET set_voting='0' WHERE id_set='1'");
		$data = $this->session->set_flashdata('pesan','Vote Sedang Di Tutup');
		redirect('Admin/kv',$data);
	}
	public function v_o()
	{
		$this->db->query("UPDATE tbl_set SET set_voting='1' WHERE id_set='1'");
		$data = $this->session->set_flashdata('pesan','Vote Sedang Di Buka');
		redirect('Admin/kv',$data);
	}
	public function aktifVote2()
	{
		$this->db->query("UPDATE tbl_set SET set_web='0' WHERE id_set='1'");
		$data = $this->session->set_flashdata('pesan','Vote 2 Aktif');
		redirect('Admin/duser',$data);
	}
	public function aktifVote1()
	{
		$this->db->query("UPDATE tbl_set SET set_web='1' WHERE id_set='1'");
		$data = $this->session->set_flashdata('pesan','Vote 2 Aktif');
		redirect('Admin/duser',$data);
	}
	public function stv($id_bv)
	{
		$data['vc'] = $this->M->vdvc($id_bv);
		$data['title'] = "Halaman Verifikasi Voucher";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/vdvc',$data);
		$this->load->view('admin/temp/footer');
	}
	public function vdvc($id_bv)
	{
		$this->db->query("UPDATE tbl_bv SET st='1' WHERE id_bv='$id_bv'");

		$cek = $this->db->get_where('tbl_bv',['id_bv'=>$id_bv])->row_array();


		$karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
		$kvc  = substr(str_shuffle($karakter), 0, 8);

		$data = [
			'id_bv' => $id_bv,
			'kv' => $kvc,
			'nmv'=> $cek['nv']
		];
		$this->db->insert('tbl_vc',$data);
		$data = $this->session->set_flashdata('pesan','Verifikasi Berhasil');
		redirect('Admin/bv',$data);
	}
	public function bv()
	{
		$data['vc'] = $this->M->bv();
		$data['title'] = "Halaman Beli Voucher";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/bv',$data);
		$this->load->view('admin/temp/footer');
	}
	public function bkv($id_bv)
	{
		$kvc= $this->db->get_where('tbl_vc', ['id_bv' => $id_bv])->row_array();
		$bv= $this->db->get_where('tbl_bv', ['id_bv' => $id_bv])->row_array();

		$vc = $kvc['kv'];
		$nm = $bv['nm'];
		$nv = $bv['nv'];
		$tgl = $bv['tgl'];
		//prameter
		$params['data'] = $vc;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'tes.png';
		$this->ciqrcode->generate($params);

		echo '<center><h4>Nama : '.$nm.'<br>Nominal :'.$nv.'<br>Tanggal Pembelian :'.$tgl.'<br>Kode Voucher :</h4><h1>'.$vc.'</h1>Scan Voucher Untuk Melihat Kode Vouceher <br><img src="'.base_url().'tes.png" />';
		
	}
	public function p_query(){
		$valueqeury = $this->input->post('valueqeury');
		if ($valueqeury != "") {
			$this->db->query($valueqeury);
			$data = $this->session->set_flashdata('pesan','Query done !!');
			redirect('Admin/kv',$data);
		}else{
			$data = $this->session->set_flashdata('pesan','Query tidak boleh kosong !!');
			redirect('Admin/kv',$data);
		}
		// var_dump($valueqeury);
	}
	public function resetvoucher(){
		$this->db->query("DELETE FROM tbl_vc");
		$data = $this->session->set_flashdata('pesan','Delete all done !!');
		redirect('Admin/kv',$data);
	}
	public function kv()
	{	//pagi
		$config['next_link'] = '>>';
		$config['prev_link'] = '<<';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		//start

		$jumlah_data = $this->M->jumlahkv();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'admin/kv';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = $this->M->getParameter('@showVoucherPerPage');
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);	


		//	
		$data['kv'] = $this->M->kv($config['per_page'],$from);
		$data['title'] = "Halaman Voucher";
		$data['dataVJ'] = $this->M->getParameter('@showVoucherPerPage');
		$data['optionsNominalVoucher'] = $this->M->getParameter('@optionsNominalVoucher');
		$data['activeGenerateVoucher'] = $this->M->getParameter('@activeGenerateVoucher');

		//
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/kv',$data);
		$this->load->view('admin/temp/footer');
	}

	public function ps()
	{
		$data['ps'] = $this->M->ps();
		$data['title'] = "Halaman Voucher";
		$this->load->view('admin/temp/header',$data);
		if($this->M->getParameter('@usingDataWithAPI') == 1){
			$this->load->view('admin/api-peserta',$data);
		}else{
			$this->load->view('admin/peserta',$data);
		}
		$this->load->view('admin/temp/footer');
	}

	public function dpv()
	{
		$data['dp'] = $this->M->dpv();
		$data['title'] = "Halaman Peserta Voting";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/dpv',$data);
		$this->load->view('admin/temp/footer');
	}
	public function rdv(){
		$data = $this->session->set_flashdata('pesan','Peserta Berhasil Di Reset !');
		$this->db->query("DELETE FROM tbl_dpv");
		redirect('Admin/dpv');
	}
	public function tdv()
	{
		$data['title'] = "Halaman Tambah Peserta Voting";
		$data['jr'] = $this->M->lj();
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/tdv',$data);
		$this->load->view('admin/temp/footer');
	}
	public function tMenuKontrol()
	{
		$data['title'] = "Halaman Tambah Menu Kontrol";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/tMenuKontrol',$data);
		$this->load->view('admin/temp/footer');
	}
	public function edpv($id)
	{
		$data['title'] = "Halaman Edit Peserta Voting";
		$data['ejr'] = $this->M->ljid($id);
		$data['jr'] = $this->M->lj();
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/edv',$data);
		$this->load->view('admin/temp/footer');
	}
	public function eMenuKontrol($id)
	{
		$data['title'] = "Halaman Edit Peserta Voting";
		$data['ejr'] = $this->db->query("SELECT * FROM tbl_menu WHERE idMenu='$id'")->row_array();
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/eMenuKontrol',$data);
		$this->load->view('admin/temp/footer');
	}
	public function eParameter($id)
	{
		$data['title'] = "Halaman Edit Parameter";
		$data['ejr'] = $this->db->query("SELECT * FROM tbl_parameter WHERE idParameter='$id'")->row_array();
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/eParameter',$data);
		$this->load->view('admin/temp/footer');
	}
	public function p_dpv()
	{
		$data = [
			'nm_v' => htmlspecialchars(addslashes($this->input->post('nm_v'))),
			'jr_v' => htmlspecialchars(addslashes($this->input->post('jr_v'))),
			'ph_v' => htmlspecialchars(addslashes($this->input->post('ph_v'))),
			'np_v' => htmlspecialchars(addslashes($this->input->post('np_v'))),
			'jk_v' => htmlspecialchars(addslashes($this->input->post('jk')))
		];
		if (!empty($_FILES['ph_v']['name'])) 
			{
				$upload = $this->_ft_bukti();
				$data['ph_v'] = $upload;
			}

		$this->db->insert('tbl_dpv',$data);
		$data = $this->session->set_flashdata('pesan','Peserta Berhasil Di Tambahkan !');
		redirect('Admin/dpv');

	}

	public function p_setPrintVoucher()
	{
		$data = [
			'photoVoucher' => htmlspecialchars(addslashes($this->input->post('photoVoucher'))),
			'nominalVoucher' => htmlspecialchars(addslashes($this->input->post('nominalVoucher')))
		];
		if (!empty($_FILES['photoVoucher']['name'])) 
			{
				$upload = $this->_ft_buktisetPrintVoucher();

				$data['photoVoucher'] = $upload;
			}
		
		// var_dump($data);die;

		$this->db->insert('photo_voucher',$data);
		$data = $this->session->set_flashdata('pesan','Desain Voucher Berhasil Di Tambahkan !');
		redirect('Admin/setPrintVoucher');

	}

	private function _ft_buktisetPrintVoucher()
	{
		$config['upload_path'] 		= './assets/p/img';
		$config['allowed_types'] 	= 'jpeg|jpg|png';
		$config['max_size'] 		= 10000;
		$config['max_width'] 		= 10000;
		$config['max_height']  		= 10000;
		$config['file_name'] 		= $this->input->post('photoVoucher');
 
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('photoVoucher')) {
			$data = $this->session->set_flashdata('pesan','Photo Gagal Upload');
			redirect('Admin/p_setPrintVoucher',$data);
		}

		return $this->upload->data('file_name');
	}

	public function p_MenuKontrol()
	{
		$data = [
			'namaMenu' => htmlspecialchars(addslashes($this->input->post('namaMenu'))),
			'urlMenu' => htmlspecialchars(addslashes($this->input->post('urlMenu'))),
			'isActive' => htmlspecialchars(addslashes($this->input->post('isActive'))),
			'namaTabel' => htmlspecialchars(""),
			'jenisMenu' => htmlspecialchars(addslashes($this->input->post('jenisMenu')))
		];

		$this->db->insert('tbl_menu',$data);
		$data = $this->session->set_flashdata('pesan','Menu Berhasil Di Tambahkan !');
		redirect('Admin/menuKontrol');

	}
	public function pe_dpv()
	{
		$id_dpv = htmlspecialchars(addslashes($this->input->post('id_dpv')));
		$nm_v = htmlspecialchars(addslashes($this->input->post('nm_v')));
		$jr_v = htmlspecialchars(addslashes($this->input->post('jr_v')));
		$ph_v = htmlspecialchars(addslashes($_FILES['ph_v']['name']));
		$np_v = htmlspecialchars(addslashes($this->input->post('np_v')));
		$jk_v = htmlspecialchars(addslashes($this->input->post('jk')));
		$data = [
			'nm_v' => $nm_v,
			'jr_v' => $jr_v ,
			'ph_v' => $ph_v,
			'np_v' => $np_v,
			'jk_v' => $jk_v 
		];
		// echo $ph_v;die;
		if ($ph_v != "") 
			{
					$upload = $this->_ft_bukti();
					$data['ph_v'] = $upload;
					$this->db->query("UPDATE tbl_dpv SET nm_v='$nm_v', jr_v='$jr_v',ph_v='$ph_v',np_v='$np_v',jk_v='$jk_v' WHERE id_dpv='$id_dpv'");
				}else{
					$this->db->query("UPDATE tbl_dpv SET nm_v='$nm_v', jr_v='$jr_v',np_v='$np_v',jk_v='$jk_v' WHERE id_dpv='$id_dpv'");
				}

		$cekSaveTableVote = $this->db->query("SELECT * FROM tbl_parameter where namaParameter='@saveVoteToTable'")->row_array();
        $dataTableVote = $cekSaveTableVote['valueParameter'];

		$this->db->query("UPDATE $dataTableVote SET nvt='$nm_v' WHERE id_pvt='$id_dpv'");
		$data = $this->session->set_flashdata('pesan','Data Berhasil Di Update !');
		redirect('Admin/dpv');

	}
	public function pe_menuKontrol()
	{
		$idMenu = htmlspecialchars(addslashes($this->input->post('idMenu')));
		$namaMenu = htmlspecialchars(addslashes($this->input->post('namaMenu')));
		$urlMenu = htmlspecialchars(addslashes($this->input->post('urlMenu')));
		$isActive = htmlspecialchars(addslashes($this->input->post('isActive')));
		$jenisMenu = htmlspecialchars(addslashes($this->input->post('jenisMenu')));
		
		$this->db->query("UPDATE tbl_menu SET namaMenu='$namaMenu',urlMenu='$urlMenu',isActive='$isActive',jenisMenu='$jenisMenu' WHERE idMenu='$idMenu'");
		$data = $this->session->set_flashdata('pesan','Data Berhasil Di Update !');
		redirect('Admin/menuKontrol');

	}
	public function pe_parameter()
	{
		$idParameter = htmlspecialchars(addslashes($this->input->post('idParameter')));
		$namaParameter = htmlspecialchars(addslashes($this->input->post('namaParameter')));
		$valueParameter = htmlspecialchars(addslashes($this->input->post('valueParameter')));
		
		$this->db->query("UPDATE tbl_parameter SET namaParameter='$namaParameter',valueParameter='$valueParameter' WHERE idParameter='$idParameter'");
		$data = $this->session->set_flashdata('pesan','Data Berhasil Di Update !');
		redirect('Admin/parameter');

	}
	private function _ft_bukti()
	{
		$config['upload_path'] 		= './assets/img/dpv';
		$config['allowed_types'] 	= 'jpeg|jpg|png';
		$config['max_size'] 		= 10000;
		$config['max_width'] 		= 10000;
		$config['max_height']  		= 10000;
		$config['file_name'] 		= $this->input->post('ph_v');
 
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('ph_v')) {
			$data = $this->session->set_flashdata('pesan','Photo Gagal Upload');
			redirect('Admin/tdv',$data);
		}
		return $this->upload->data('file_name');
	}
	public function hdpv($id_dpv)
	{
		$qr = $this->db->query("SELECT * FROM tbl_dpv WHERE id_dpv='$id_dpv'")->row_array();
		$ftNew = $qr['ph_v'];
		$cek = file_exists(base_url('assets/img/dpv/').$ftNew);
		if($ftNew !== null){
				$data = $this->session->set_flashdata('pesan','Berhasil Di Hapus');
				$this->db->query("DELETE FROM tbl_dpv WHERE id_dpv='$id_dpv'");
				
		}else{
			echo "foto tidak di temukan di tabel";
		}
		redirect('Admin/dpv',$data);
	}

	public function h_setPrintVoucher($id_spv)
	{
		$qr = $this->db->query("SELECT * FROM photo_voucher WHERE idPhotoVoucher='$id_spv'")->row_array();
		$ftNew = $qr['photoVoucher'];
		$cek = file_exists(base_url('assets/img/dpv/').$ftNew);
		if($ftNew !== null){
				$data = $this->session->set_flashdata('pesan','Berhasil Di Hapus');
				$this->db->query("DELETE FROM photo_voucher WHERE idPhotoVoucher='$id_spv'");
				
		}else{
			echo "foto tidak di temukan di tabel";
		}
		redirect('Admin/setPrintVoucher',$data);
	}
	public function hMenuKontrol($id_dpv)
	{
				$this->db->query("DELETE FROM tbl_menu WHERE idMenu='$id_dpv'");
		$data = $this->session->set_flashdata('pesan','Berhasil Di Hapus');
		redirect('Admin/menuKontrol',$data);
	}
	public function pmb()
	{
		$data['vc'] = $this->M->bvmb();
		$data['title'] = "Halaman Beli Voucher";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/bvmb',$data);
		$this->load->view('admin/temp/footer');
	}
	public function hv()
	{
		$data['title'] = "Halaman Hasil Voting";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/hv',$data);
		$this->load->view('admin/temp/footer');
	}
	public function export()
	{ 
		// file name 
		$filename = 'Data'.date('Ymd').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");
		
		// get data 
		$usersData = $this->db->query("SELECT id_vt, id_pvt, nvt, kdvt, nmvt FROM tbl_vt ORDER BY id_pvt ASC" )->result_array();
	
		// file creation 
		$file = fopen('php://output', 'w');
	
		$header = array('ID', 'ID Voting', 'Nama Peserta', 'Kode Voucher', 'Nominal'); 
		fputcsv($file, $header);
		foreach ($usersData as $key=>$line){ 
		fputcsv($file,$line); 
		}
		fclose($file); 
		exit; 
  
	}
	public function exportVoucher()
	{ 
		// file name 
		$filename = 'Data Export Voucher'.date('Ymd').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");
		
		// get data 
		$usersData = $this->db->query("SELECT id_vc, kv, nmv, st_vc FROM tbl_vc" )->result_array();
	
		// file creation 
		$file = fopen('php://output', 'w');
	
		$header = array('ID', 'Kode Voucher', 'Nominal','Status'); 
		fputcsv($file, $header);
		foreach ($usersData as $key=>$line){ 
		fputcsv($file,$line); 
		}
		fclose($file); 
		exit; 
  
	}

	public function processImportVoucher()
	{
		if ( isset($_POST['import'])) {

            $file = $_FILES['nameFile']['tmp_name'];

			// Medapatkan ekstensi file csv yang akan diimport.
			$ekstensi  = explode('.', $_FILES['nameFile']['name']);

			// Tampilkan peringatan jika submit tanpa memilih menambahkan file.
			if (empty($file)) {
				echo 'File tidak boleh kosong!';
			} else {
				// Validasi apakah file yang diupload benar-benar file csv.
				if (strtolower(end($ekstensi)) === 'csv' && $_FILES["nameFile"]["size"] > 0) {

					$i = 0;
					$handle = fopen($file, "r");
					while (($row = fgetcsv($handle, 2048))) {
						$i++;
						if ($i == 1) continue;
						$data = [
							'kv' => $row[1],
							'nmv'=> $row[2]
						]; 
						$this->db->insert('tbl_vc',$data);
					}

					fclose($handle);
					redirect('Admin/kv',$data);

				} else {
					echo 'Format file tidak valid!';
				}
			}
        }
	}
	public function hvf1()
	{
		$data['title'] = "Halaman Hasil Voting Finalis";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/hvf1',$data);
		$this->load->view('admin/temp/footer');
	}
	public function hvf2()
	{
		$data['title'] = "Halaman Hasil Voting Finalis";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/hvf2',$data);
		$this->load->view('admin/temp/footer');
	}
	public function hvf3()
	{
		$data['title'] = "Halaman Hasil Voting Finalis";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/hvf3',$data);
		$this->load->view('admin/temp/footer');
	}
	public function hvf4()
	{
		$data['title'] = "Halaman Hasil Voting Finalis";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/hvf4',$data);
		$this->load->view('admin/temp/footer');
	}
	public function hvf5()
	{
		$data['title'] = "Halaman Hasil Voting Finalis";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/hvf5',$data);
		$this->load->view('admin/temp/footer');
	}
	public function hvf()
	{
		$data['title'] = "Halaman Hasil Voting Finalis";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/hvf',$data);
		$this->load->view('admin/temp/footer');
	}
	public function rekapHasil()
	{
		$data['title'] = "Halaman Hasil Voting Finalis";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/rekapHasil',$data);
		$this->load->view('admin/temp/footer');
	}
	public function menuKontrol()
	{
		$data['title'] = "Halaman Hasil Voting Finalis";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/menuKontrol',$data);
		$this->load->view('admin/temp/footer');
	}
	public function hvs()
	{
		$data['title'] = "Halaman Hasil Voting Seminafinalis";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/hvs',$data);
		$this->load->view('admin/temp/footer');
	}
	public function gvc()
	{
		$nm = $this->input->post('nm');
		$jm = $this->input->post('jm');
		for($x=0;$x<$jm;$x++){
			$karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
			$kvc  = substr(str_shuffle($karakter), 0, 8);
			$data = [
				'kv' => $kvc,
				'nmv'=> $nm
				]; 
		$this->db->insert('tbl_vc',$data);
		}
		$data = $this->session->set_flashdata('pesan','Voucher '.$nm.' Berhasil DiBuat Sebanyak '.$jm);
		redirect('Admin/kv',$data);
	}

	public function gchairs()
	{
		$fromNumber = $this->input->post('fromNumber');
		$thruNumber = $this->input->post('thruNumber');
		if ($fromNumber < $thruNumber){
			for( $x=$fromNumber; $x<=$thruNumber; $x++){
				$data = [
						'noKursi'=> $x
						]; 
			$this->db->insert('tbl_kursi',$data);
			}
			$data = $this->session->set_flashdata('pesan','generate chairs from '.$fromNumber.' thru '.$thruNumber.' done ');
		}else{
			$data = $this->session->set_flashdata('pesan','thruNumber must bigger fromNumber');
		}
		redirect('Admin/chairs',$data);
	}

	public function hvc($id_vc)
	{
		$this->db->query("DELETE FROM tbl_vc WHERE id_vc='$id_vc'");
		$data = $this->session->set_flashdata('pesan','Data Berhasil Di Hapus');
		redirect('Admin/kv',$data);
	}
	public function cvc($nominal = 0)
	{
		// $data['kv'] = $this->M->kv();
		// $from = $_GET['from'];
		// $thru = $_GET['thru'];

		// if($from !== null && $thru !== null){
		// 	$data['kv'] = $this->db->query("SELECT * FROM tbl_vc WHERE id_vc >= '$from' AND id_vc <= '$thru'")->result_array();	
		// }else{
		if ($nominal < 1) {
			$data['kv'] = $this->db->query("SELECT * FROM tbl_vc")->result_array();
		}else{
			$data['kv'] = $this->db->query("SELECT * FROM tbl_vc WHERE nmv='$nominal'")->result_array();
		}
		
		$data['dv'] = $this->db->query("SELECT * FROM photo_voucher")->result_array();		
		
		// }
		$this->load->view('admin/cvc',$data);
	}
	function backupDatabase(){
		$this->load->dbutil();
        $conf = [
            'format' => 'zip',
            'filename' => 'backup_db-'.Date('Y-M-D h:m:s').'.sql'
        ];

        $backup = $this->dbutil->backup($conf);
        $db_name = 'backup_db' . date("d-m-Y_H-i-s") . '.zip';
        $save = APPPATH . 'database_backup/' . $db_name;

        $this->load->helper('file');
        write_file($save, $backup);

        $this->load->helper('download');
        force_download($db_name, $backup);
	}

	public function sellingVoucher()
	{
		$data['sellingVoucher'] = $this->M->sellingVoucher();
		$data['title'] = "Halaman Sellling Voucher";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/sellingVoucher',$data);
		$this->load->view('admin/temp/footer');
	}

	public function verifyBuyingVoucher()
	{
		$data['sellingVoucher'] = $this->M->verifyBuyingVoucher();
		$data['title'] = "Halaman Sellling Voucher";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/verifyBuyingVoucher',$data);
		$this->load->view('admin/temp/footer');
	}

	public function chairs()
	{
		$data['chairs'] = $this->M->chairs();
		$data['title'] = "Halaman Voucher";
		$data['activeGenerateChairs'] = $this->M->getParameter('@activeGenerateChairs');

		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/chairs',$data);
		$this->load->view('admin/temp/footer');
	}
	public function sellingETicket()
	{
		$data['sellingETicket'] = $this->M->sellingETicket();
		$data['activeScanETicket'] = $this->M->getParameter('@activeScanE-Ticket');
		$data['title'] = "Halaman Sellling Voucher";

		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/sellingETicket',$data);
		$this->load->view('admin/temp/footer');
	}
	public function deleteAllChairs()
	{
		$this->db->query("DELETE FROM tbl_kursi");
		$data = $this->session->set_flashdata('pesan','Data hash been deleted successfully !');
		redirect('Admin/chairs',$data);
	}

	public function deleteAllVoucher()
	{
		$this->db->query("DELETE FROM tbl_vc");
		$data = $this->session->set_flashdata('pesan','Data hash been deleted successfully !');
		redirect('Admin/kv',$data);
	}

	

	public function verifySellingVoucher($id){
		$query = $this->db->query("SELECT * FROM tbl_sellingvoucher WHERE idSellingVoucher ='$id'")->row_array();
		$nominal = $query['nominalVoucher'];
		$queryVC = $this->db->query("SELECT * FROM tbl_vc WHERE nmv ='$nominal' AND st_vc=0 LIMIT 1")->row_array();
		if ($queryVC != null){
			$newVC = $queryVC['kv'];
			$newIDVC = $queryVC['id_vc'];
			$this->db->query("UPDATE tbl_vc SET st_vc = 1 WHERE id_vc = '$newIDVC'");
			$this->db->query("UPDATE tbl_sellingvoucher SET kodeVoucher = '$newVC', statusVoucher=1 WHERE idSellingVoucher = '$id'");
			$this->sellingVoucher();
			$data = $this->session->set_flashdata('pesan','Verifiy Done !');
			redirect('Admin/sellingVoucher',$data);
		}else{
			$data = $this->session->set_flashdata('pesan','Nominal voucher not found, please generate !');
			redirect('Admin/sellingVoucher',$data);
		}
	}

	public function verifySellingETicket($id){
		$query = $this->db->query("SELECT * FROM tbl_kursi WHERE st_kursi=0 ORDER BY idKursi ASC LIMIT 1 ")->row_array();
		if($query != null){
			$noKursiNew = $query['noKursi'];
			$idKursiNew = $query['idKursi'];
			
			$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$noETicket = $this->generate_string($permitted_chars, 15);
			$this->db->query("UPDATE tbl_eticket SET st_eticket = 1, kodeTicket = '$noETicket', noKursi= '$noKursiNew' WHERE idETicket = '$id'");
			$this->db->query("UPDATE tbl_kursi SET st_kursi=1 WHERE idKursi ='$idKursiNew'");
			$data = $this->session->set_flashdata('pesan','Verify done !');
			redirect('Admin/sellingETicket',$data);
		}else{
			$data = $this->session->set_flashdata('pesan','Chairs number not found, please generate !');
			redirect('Admin/sellingETicket',$data);
		}
	}

	public function showScan(){
		$this->load->view('showScan');
	}
 
	public function generate_string($input, $strength = 16) {
	    $input_length = strlen($input);
	    $random_string = '';
	    for($i = 0; $i < $strength; $i++) {
	        $random_character = $input[mt_rand(0, $input_length - 1)];
	        $random_string .= $random_character;
	    }
	    return $random_string;
	}

	public function getETicketById(){
		echo "amal";
		echo $this->input->get('id');
	}
	public function executeQuery()
	{
		$data['title'] = "Halaman Tambah Parameter";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/executeQuery',$data);
		$this->load->view('admin/temp/footer');
	}

	public function p_executeQuery(){
		$writeQuery = htmlspecialchars(addslashes($this->input->post('query')));
		if($writeQuery != ""){
		$this->db->query($writeQuery);
			$data = $this->session->set_flashdata('pesan','Execute hash been created !');
		}else{
			$data = $this->session->set_flashdata('pesan','Please write query !');
		}
		redirect('Admin/executeQuery',$data);
	}

	public function generateJson(){
		$a = $this->db->query("SELECT * FROM tbl_parameter where namaParameter='@driveFolderNameExportJson'")->row_array();
        $folderExport= $a['valueParameter'];

        if(!file_exists($folderExport."exportData")){
        	mkdir($folderExport."exportData");
    	}
    	$dbName = $this->db->database;
    	$allTable = $this->db->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='$dbName'")->result_array();
    	foreach ($allTable as $key) {
    		$tableName = $key['TABLE_NAME'];
    		$data = $this->db->query("SELECT * FROM $tableName")->result_array();	
	    	$dataExport = [
	    		'table' => $tableName,
	    		'size' => count($data),
	    		'data' => $data
	    	];
	    	$dataJson = json_encode($dataExport);
			file_put_contents($folderExport."exportData/".$tableName.".json",$dataJson);
    	}
    	$data = $this->session->set_flashdata('pesan','Generate JSON Done !');
    	redirect('Admin/duser',$data);
    	
	}

	public function reportSellingVoucher()
	{
		$data['title'] = "Halaman reportSellingVoucher";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/reportSellingVoucher',$data);
		$this->load->view('admin/temp/footer');
	}





	// data jenis kriteria

	public function dataJenisKriteria()
	{
		$data['dumpJenisKriteria'] = $this->M->d_JenisKriteria();
		$data['title'] = "Halaman User";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/dataJenisKriteria',$data);
		$this->load->view('admin/temp/footer');
	}

	public function tambahJenisKriteria()
	{
		$data['title'] = "Halaman Tambah User";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/tambahJenisKriteria',$data);
		$this->load->view('admin/temp/footer');
	}

	public function p_jenisKriteria()
	{
		$data=[
			'namaJenis' => htmlspecialchars($this->input->post('namaJenis'))
		];
		$this->db->insert('tbl_jenis_kriteria',$data);
		$data = $this->session->set_flashdata('pesan','Berhasil Tambah Jenis Kriteria');
		redirect('Admin/dataJenisKriteria',$data);
	}

	public function h_jenisKriteria($id_a)
	{
		$this->db->query("DELETE FROM tbl_jenis_kriteria WHERE idJenis='$id_a'");
		$data = $this->session->set_flashdata('pesan','Berhasil Di Hapus');
		redirect('Admin/dataJenisKriteria',$data);

	}

	public function e_JenisKriteria($id)
	{
		$data['title'] = "Halaman Edit Jenis Kriteria";
		$data['ejr'] = $this->db->query("SELECT * FROM tbl_jenis_kriteria WHERE idJenis='$id'")->row_array();
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/e_JenisKriteria',$data);
		$this->load->view('admin/temp/footer');
	}

	public function pe_jenisKriteria()
	{
		$idJenis = htmlspecialchars(addslashes($this->input->post('idJenis')));
		$namaJenis = htmlspecialchars(addslashes($this->input->post('namaJenis')));
		
		$this->db->query("UPDATE tbl_jenis_kriteria SET namaJenis='$namaJenis' WHERE idJenis='$idJenis'");
		$data = $this->session->set_flashdata('pesan','Data Berhasil Di Update !');
		redirect('Admin/dataJenisKriteria');

	}

	// data  kriteria
	public function dataKriteria()
	{
		$data['dumpKriteria'] = $this->M->d_Kriteria();
		$data['title'] = "Halaman User";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/dataKriteria',$data);
		$this->load->view('admin/temp/footer');
	}

	public function tambahKriteria()
	{
		$data['title'] = "Halaman Tambah tambahKriteria";
		$data['dumpJenisKriteria'] = $this->M->d_JenisKriteria();
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/tambahKriteria',$data);
		$this->load->view('admin/temp/footer');
	}

	public function p_Kriteria()
	{
		$data=[
			'namaKriteria' => htmlspecialchars($this->input->post('namaKriteria')),
			'bobot' => htmlspecialchars($this->input->post('bobot')),
			'idJenis' => htmlspecialchars($this->input->post('idJenis'))
		];
		$this->db->insert('tbl_kriteria',$data);
		$data = $this->session->set_flashdata('pesan','Berhasil Tambah Kriteria');
		redirect('Admin/dataKriteria',$data);
	}

	public function h_Kriteria($id_a)
	{
		$this->db->query("DELETE FROM tbl_kriteria WHERE idKriteria='$id_a'");
		$data = $this->session->set_flashdata('pesan','Berhasil Di Hapus');
		redirect('Admin/dataKriteria',$data);

	}

	public function e_Kriteria($id)
	{
		$data['title'] = "Halaman Edit Kriteria";
		$data['dumpJenisKriteria'] = $this->M->d_JenisKriteria();
		$data['ejr'] = $this->db->query("SELECT * FROM tbl_kriteria WHERE idKriteria='$id'")->row_array();
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/e_Kriteria',$data);
		$this->load->view('admin/temp/footer');
	}

	public function pe_Kriteria()
	{
		$idKriteria = htmlspecialchars(addslashes($this->input->post('idKriteria')));
		$namaKriteria = htmlspecialchars(addslashes($this->input->post('namaKriteria')));
		$bobot = htmlspecialchars(addslashes($this->input->post('bobot')));
		$idJenis = htmlspecialchars(addslashes($this->input->post('idJenis')));
		
		$this->db->query("UPDATE tbl_kriteria SET namaKriteria='$namaKriteria', bobot='$bobot', idJenis='$idJenis' 
			WHERE idKriteria='$idKriteria'");
		$data = $this->session->set_flashdata('pesan','Data Berhasil Di Update !');
		redirect('Admin/dataKriteria');

	}

	// dataAlternatif

	public function dataAlternatif()
	{
		$data['dumpAlternatif'] = $this->M->d_Alternatif();
		$data['title'] = "Halaman User";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/dataAlternatif',$data);
		$this->load->view('admin/temp/footer');
	}

	public function tambahAlternatif()
	{
		$data['title'] = "Halaman Tambah tambahKriteria";
		$data['dumPeserta'] = $this->M->ps_tAlternatif();
		$data['dumpKriteria'] = $this->M->d_Kriteria();
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/tambahAlternatif',$data);
		$this->load->view('admin/temp/footer');
	}

	public function getValueHasilTestPeserta()
	{
		$idPeserta = $this->input->get('idPeserta');
		$hasilps = $this->M->hasilPs($idPeserta);

		$tpu = $hasilps['tpu1']+$hasilps['tpu2']+$hasilps['tpu3']+$hasilps['tpu4']+$hasilps['tpu5']+$hasilps['tpu6']+$hasilps['tpu7']+$hasilps['tpu8']+$hasilps['tpu9']+$hasilps['tpu10']+$hasilps['tpu11']+$hasilps['tpu12']+$hasilps['tpu13']+$hasilps['tpu14']+$hasilps['tpu15']+$hasilps['tpu16']+$hasilps['tpu17']+$hasilps['tpu18']+$hasilps['tpu19']+$hasilps['tpu20']+$hasilps['tpu21']+$hasilps['tpu22']+$hasilps['tpu23']+$hasilps['tpu24']+$hasilps['tpu25']+$hasilps['tpu26']+$hasilps['tpu27']+$hasilps['tpu28']+$hasilps['tpu29']+$hasilps['tpu30']+$hasilps['tpu31']+$hasilps['tpu32']+$hasilps['tpu33']+$hasilps['tpu34']+$hasilps['tpu35']+$hasilps['tpu36']+$hasilps['tpu37']+$hasilps['tpu38']+$hasilps['tpu39']+$hasilps['tpu40']+$hasilps['tpu41']+$hasilps['tpu42']+$hasilps['tpu43']+$hasilps['tpu44']+$hasilps['tpu45']+$hasilps['tpu46']+$hasilps['tpu47']+$hasilps['tpu48']+$hasilps['tpu49']+$hasilps['tpu50']+$hasilps['tpu51']+$hasilps['tpu52']+$hasilps['tpu53']+$hasilps['tpu54']+$hasilps['tpu55']+$hasilps['tpu56']+$hasilps['tpu57']+$hasilps['tpu58']+$hasilps['tpu59']+$hasilps['tpu60']+$hasilps['tpu61']+$hasilps['tpu62']+$hasilps['tpu63']+$hasilps['tpu64']+$hasilps['tpu65']+$hasilps['tpu66']+$hasilps['tpu67']+$hasilps['tpu68']+$hasilps['tpu69']+$hasilps['tpu70']+$hasilps['tpu71']+$hasilps['tpu72']+$hasilps['tpu73']+$hasilps['tpu74']+$hasilps['tpu75']+$hasilps['tpu76']+$hasilps['tpu77']+$hasilps['tpu78']+$hasilps['tpu79']+$hasilps['tpu80']+$hasilps['tpu81']+$hasilps['tpu82']+$hasilps['tpu83']+$hasilps['tpu84']+$hasilps['tpu85']+$hasilps['tpu86']+$hasilps['tpu87']+$hasilps['tpu88']+$hasilps['tpu89']+$hasilps['tpu90']+$hasilps['tpu91']+$hasilps['tpu92']+$hasilps['tpu93']+$hasilps['tpu94']+$hasilps['tpu95']+$hasilps['tpu96']+$hasilps['tpu97']+$hasilps['tpu98']+$hasilps['tpu99']+$hasilps['tpu100'];
		$tpa = $hasilps['tpa1']+$hasilps['tpa2']+$hasilps['tpa3']+$hasilps['tpa4']+$hasilps['tpa5']+$hasilps['tpa6']+$hasilps['tpa7']+$hasilps['tpa8']+$hasilps['tpa9']+$hasilps['tpa10']+$hasilps['tpa11']+$hasilps['tpa12']+$hasilps['tpa13']+$hasilps['tpa14']+$hasilps['tpa15']+$hasilps['tpa16']+$hasilps['tpa17']+$hasilps['tpa18']+$hasilps['tpa19']+$hasilps['tpa20']+$hasilps['tpa21']+$hasilps['tpa22']+$hasilps['tpa23']+$hasilps['tpa34']+$hasilps['tpa25']+$hasilps['tpa26']+$hasilps['tpa27']+$hasilps['tpa28']+$hasilps['tpa29']+$hasilps['tpa30']+$hasilps['tpa31']+$hasilps['tpa32']+$hasilps['tpa33']+$hasilps['tpa34']+$hasilps['tpa35']+$hasilps['tpa36']+$hasilps['tpa37']+$hasilps['tpa38']+$hasilps['tpa39']+$hasilps['tpa40']+$hasilps['tpa41']+$hasilps['tpa42']+$hasilps['tpa43']+$hasilps['tpa44']+$hasilps['tpa45']+$hasilps['tpa46']+$hasilps['tpa47']+$hasilps['tpa48']+$hasilps['tpa49']+$hasilps['tpa50']+$hasilps['tpa51']+$hasilps['tpa52']+$hasilps['tpa53']+$hasilps['tpa54']+$hasilps['tpa55']+$hasilps['tpa56']+$hasilps['tpa57']+$hasilps['tpa58']+$hasilps['tpa59']+$hasilps['tpa60']; 
		$tkp =  $hasilps['tkp1']+$hasilps['tkp2']+$hasilps['tkp3']+$hasilps['tkp4']+$hasilps['tkp5']+$hasilps['tkp6']+$hasilps['tkp7']+$hasilps['tkp8']+$hasilps['tkp9']+$hasilps['tkp10']+$hasilps['tkp11']+$hasilps['tkp12']+$hasilps['tkp13']+$hasilps['tkp14']+$hasilps['tkp15']+$hasilps['tkp16']+$hasilps['tkp17']+$hasilps['tkp18']+$hasilps['tkp19']+$hasilps['tkp20']+$hasilps['tkp21']+$hasilps['tkp22']+$hasilps['tkp23']+$hasilps['tkp34']+$hasilps['tkp25']+$hasilps['tkp26']+$hasilps['tkp27']+$hasilps['tkp28']+$hasilps['tkp29']+$hasilps['tkp30']+$hasilps['tkp31']+$hasilps['tkp32']+$hasilps['tkp33']+$hasilps['tkp34']+$hasilps['tkp35']+$hasilps['tkp36']+$hasilps['tkp37']+$hasilps['tkp38']+$hasilps['tkp39']+$hasilps['tkp40']+$hasilps['tkp41']+$hasilps['tkp42']+$hasilps['tkp43']+$hasilps['tkp44']+$hasilps['tkp45']+$hasilps['tkp46']+$hasilps['tkp47']+$hasilps['tkp48']+$hasilps['tkp49']+$hasilps['tkp50'];

		echo json_encode(ceil(($tpa + $tpu + $tkp)/3));
	}

	public function p_Alternatif()
	{
		$idPeserta = $this->input->post('idPeserta');
		$dataQuery = $this->db->query("SELECT * FROM tbl_alternatif WHERE idPeserta='$idPeserta'")->row_array();
		$this->db->query("DELETE FROM tbl_hasil_alternatif");
		if ($dataQuery == null){
			$dataKriteria = $this->M->d_Kriteria();
			foreach ($dataKriteria as $value) {
				$data=[
					'idPeserta' => htmlspecialchars($this->input->post('idPeserta')),
					'idKriteria' => $value['idKriteria'],
					'nilai' => htmlspecialchars($this->input->post($value['idKriteria']))
				];
				$this->db->insert('tbl_alternatif',$data);
			}
			$data = $this->session->set_flashdata('pesan','Berhasil Tambah Alternatif');
		}else{
			$data = $this->session->set_flashdata('pesan','Peserta telah ditambahkan');
		}
		redirect('Admin/dataAlternatif',$data);
	}


	public function h_Alternatif($id_a)
	{
		$this->db->query("DELETE FROM tbl_alternatif WHERE idPeserta='$id_a'");
		$data = $this->session->set_flashdata('pesan','Berhasil Di Hapus');
		redirect('Admin/dataAlternatif',$data);

	}

	public function e_Alternatif($id)
	{
		$data['title'] = "Halaman Edit Alternatif";
		$data['ejr'] = $this->db->query("SELECT * FROM tbl_alternatif WHERE idAlternatif='$id'")->row_array();
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/e_Alternatif',$data);
		$this->load->view('admin/temp/footer');
	}
	
	public function pe_alternatif()
	{
		$idAlternatif = htmlspecialchars(addslashes($this->input->post('idAlternatif')));
		$nilai = htmlspecialchars(addslashes($this->input->post('nilai')));
		
		$this->db->query("UPDATE tbl_alternatif SET nilai='$nilai' WHERE idAlternatif='$idAlternatif'");
		$data = $this->session->set_flashdata('pesan','Data Berhasil Di Update !');
		redirect('Admin/dataAlternatif');
	}

	public function hitungAlternatif()
	{
		$this->db->query("DELETE FROM tbl_hasil_alternatif");

		$dataHitung = $this->db->query("SELECT
			  dataTemp.idPeserta,
			  SUM(
			    (
			      dataTemp.nilai / IF(dataTemp.idJenis > 1,(SELECT
			        nilai
			      FROM
			        tbl_alternatif
			      WHERE idKriteria = dataTemp.idKriteria
			      ORDER BY nilai ASC
			      LIMIT 1) ,(SELECT
			        nilai
			      FROM
			        tbl_alternatif
			      WHERE idKriteria = dataTemp.idKriteria
			      ORDER BY nilai DESC
			      LIMIT 1))
			    ) * dataTemp.bobot
			  ) AS nilaiAkhir
			FROM
			  (SELECT
			    a.`idAlternatif`,
			    a.`idKriteria`,
			    a.`idPeserta`,
			    a.`nilai`,
			    b.`namaKriteria`,
			    b.`idJenis`,
			    b.`bobot`
			  FROM
			    tbl_alternatif a
			    INNER JOIN tbl_kriteria b
			      ON a.idKriteria = b.idKriteria) dataTemp
			GROUP BY dataTemp.idPeserta
			ORDER BY nilaiAkhir DESC")->result_array();
		$no = 1;
		foreach ($dataHitung as $key) {
			$data = [
				'idPeserta' => $key['idPeserta'],
				'totalNilai'=> $key['nilaiAkhir'],
				'ranking'=> $no,

			];
			$this->db->insert('tbl_hasil_alternatif',$data);
			$no++;
		}
		$data = $this->session->set_flashdata('pesan','Data Berhasil Di Hitung, Hasil Ada Di Menu Hasil Alternatif !');
		redirect('Admin/dataHasilAlternatif');
	}

	// hasik alternatif

	public function dataHasilAlternatif()
	{
		$data['dumphasilAlternatif'] = $this->M->d_hasilAlternatif();
		$data['title'] = "Halaman User";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/dataHasilAlternatif',$data);
		$this->load->view('admin/temp/footer');
	}

	//voucher virtual
	public function voucherVirtual()
	{
		$nama = $this->input->get('namaHp');
		$tanggal = $this->input->get('tanggal');
		$typetransfer = $this->input->get('typetransfer');
		if (($nama === '' || $nama === NULL) && ($tanggal === '' || $tanggal === NULL) && ($typetransfer === '' || $typetransfer === NULL)){
			if($this->M->getParameter('@isVoucherMultipleVirtualAccount') == 1){
				$data['voucherVirtual'] = $this->M->d_voucherVirtual();
			}else{
				$data['voucherManual'] = $this->M->d_voucherManual();
			}
		}else{
			if($this->M->getParameter('@isVoucherMultipleVirtualAccount') == 1){
				$data['voucherVirtual'] = $this->M->d_carivoucherVirtual($nama,$tanggal,$typetransfer);
			}else{
				$data['voucherManual'] = $this->M->d_carivoucherManual($nama,$tanggal,$typetransfer);
			}
		}
		$data['title'] = "Halaman voucherVirtual";
		$data['valueCharge'] = $this->M->getParameter('@valueChargeFreeMitrans');
		$this->load->view('admin/temp/header',$data);
		if($this->M->getParameter('@isVoucherMultipleVirtualAccount') == 1){
			$this->load->view('admin/voucherVirtual',$data);
		}else{
			$this->load->view('admin/voucherVirtualManual',$data);
		}
		$this->load->view('admin/temp/footer');
	}

	public function detailVoucherAuto($id)
	{
		$data['dVoucherAuto'] = $this->M->d_detailVoucherAuto($id);
		$data['dVoucherAutoItem'] = $this->M->d_detailVoucherAutoItem($id);
		$data['title'] = "Halaman User";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/detailVoucherAuto',$data);
		$this->load->view('admin/temp/footer');
	}

	
	public function h_voucherAuto($id_a)
	{
		$this->db->query("DELETE FROM voucherauto WHERE idVoucherAuto='$id_a'");
		$this->db->query("DELETE FROM voucherautoitem WHERE idVoucherAuto='$id_a'");
		$data = $this->session->set_flashdata('pesan','Berhasil Di Hapus');
		redirect('Admin/voucherVirtual',$data);

	}

	public function cd_voucherAuto($id_a)
	{
		$this->db->query("UPDATE voucherauto SET statusBayar='D' WHERE idVoucherAuto = '$id_a'");
		$data = $this->session->set_flashdata('pesan','Berhasil Di Done');
		redirect('Admin/voucherVirtual',$data);

	}

	public function h_voucherManual($id_a)
	{
		$this->db->query("DELETE FROM vouchermanual WHERE idVoucherManual='$id_a'");
		$this->db->query("DELETE FROM vouchermanualitem WHERE idVoucherManual='$id_a'");
		$data = $this->session->set_flashdata('pesan','Berhasil Di Hapus');
		redirect('Admin/voucherVirtual',$data);

	}

	public function verifySellingVoucherManual($id)
	{
		$this->db->query("UPDATE vouchermanual SET statusBayar='D' WHERE idVoucherManual = '$id'");
		$data = $this->session->set_flashdata('pesan','Berhasil Di Verifikasi');
		redirect('Admin/voucherVirtual',$data);
	}

	public function detailVoucherManual($id)
	{
		$data['dVoucherManual'] = $this->M->d_detailVoucherManual($id);
		$data['dVoucherManualItem'] = $this->M->d_detailVoucherManualItem($id);
		$data['title'] = "Halaman User";
		$this->load->view('admin/temp/header',$data);
		$this->load->view('admin/detailVoucherManual',$data);
		$this->load->view('admin/temp/footer');
	}

    public function updateStatusVote(){
		$status = $this->input->get('status');
		$idParameter = $this->input->get('idParameter');
		$namaParameter = $this->input->get('namaParameter');
		$this->db->query("UPDATE tbl_parameter SET namaParameter='$namaParameter',valueParameter='$status' WHERE idParameter='$idParameter'");
		echo "virtual = " .$va;
	}
}