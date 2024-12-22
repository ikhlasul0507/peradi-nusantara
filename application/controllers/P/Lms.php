<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lms extends CI_Controller {

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
		$this->load->model('Crud_model');
		$this->load->library('service');
		$this->load->library('Pdf');
		$this->load->library('ciqrcode');
		$this->load->library('pagination'); 
		if(!$this->session->userdata('id_user')){
			//jika ada user masuk sembarangan
        	$data = $this->session->set_flashdata('pesan', 'Anda Belum Login !');
			redirect('P/Auth/login',$data);
		}
	}
	public function index()
	{	
		$data['list_data'] = $this->M->getAllDataMateriKelas();
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$this->load->view('p/lms/header',$data);
		$this->load->view('p/lms/list_master_materi',$data);
		$this->load->view('p/lms/footer');
	}


	
	public function add_master_materi()
	{
		$data['startAngkatan'] = (int) $this->M->getParameter('@startNumberAngkatan');
		$data['endAngkatan'] = (int) $this->M->getParameter('@endNumberAngkatan');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$data['list_master_kelas'] = $this->M->getAllMasterWhereOneCondition('master_kelas','is_active','Y');
		$this->load->view('p/lms/header',$data);
		$this->load->view('p/lms/add_master_materi',$data);
		$this->load->view('p/lms/footer');
	}

	public function process_add_master_materi()
	{
		$upload = $this->service->do_upload('file','dokument_materi');
		if($upload['code'] == 200){
			$data_db = [
				'id_master_kelas' => trim($this->input->post('id_master_kelas')),
				'angkatan' => trim($this->input->post('angkatan')),
				'sequence' => 1,
				'dokument_materi' => $upload['upload_data']['file_name'],
				'dokument_video' => trim($this->input->post('dokument_video')),
				'link_zoom' => trim($this->input->post('link_zoom')),
				'date_field' => trim($this->input->post('date_field')),
				'waktu' => trim($this->input->post('waktu')),
				'status_materi_kelas' => 'A',
			];
			$add_db = $this->M->add_to_db('materi_kelas', $data_db);
			if($add_db){
				$this->M->add_log_history($this->session->userdata('nama_lengkap'),"process_add_materi_kelas");
				$data = $this->session->set_flashdata('pesan', 'Berhasil tambah data !');
				redirect('P/Lms/add_master_materi',$data);
			}
		}else{
			$data = $this->session->set_flashdata('pesan', 'Upload foto gagal !');
			redirect('P/Lms/add_master_materi',$data);
		}
	}

	public function list_master_materi()
	{
		$data['list_data'] = $this->M->getAllDataMateriKelas();
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$this->load->view('p/lms/header',$data);
		$this->load->view('p/lms/list_master_materi', $data);
		$this->load->view('p/lms/footer');
	}

	public function delete_materi_kelas($id)
	{
		if($id){
			$data = $this->M->getWhere('materi_kelas',['id_materi_kelas'=>trim($id)]);
			if($data){
				$delete_foto = $this->service->delete_photo('file',$data['dokument_materi']);
				if($delete_foto['code'] == 200){
					$this->M->add_log_history($this->session->userdata('nama_lengkap'),"delete_materi_kelas " .$data['id_materi_kelas']);
					$this->M->delete_to_db('materi_kelas','id_materi_kelas',$id);
					$data = $this->session->set_flashdata('pesan', 'Berhasil di hapus !');
					redirect('P/Lms/list_master_materi',$data);
				}else{
					$data = $this->session->set_flashdata('pesan', 'Gagal di hapus !');
					redirect('P/Lms/list_master_materi',$data);
				}
			}else{
				$data = $this->session->set_flashdata('pesan', 'Gagal di hapus !');
				redirect('P/Lms/list_master_materi',$data);
			}
		}else{
			$data = $this->session->set_flashdata('pesan', 'Gagal di hapus !');
			redirect('P/Lms/list_master_materi',$data);
		}
	}

	public function edit_materi_kelas($id)
	{
		$data['startAngkatan'] = (int) $this->M->getParameter('@startNumberAngkatan');
		$data['endAngkatan'] = (int) $this->M->getParameter('@endNumberAngkatan');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$data['list_master_kelas'] = $this->M->getAllMasterWhereOneCondition('master_kelas','is_active','Y');
		$data['value'] = $this->M->getWhere('materi_kelas',['id_materi_kelas'=>trim($id)]);
		$this->load->view('p/lms/header',$data);
		$this->load->view('p/lms/edit_master_materi',$data);
		$this->load->view('p/lms/footer');
	}

	public function process_edit_master_materi()
	{
		$fileMateri = trim($this->input->post('dokument_materi_lama'));
		if(isset($_FILES['dokument_materi']) && $_FILES['dokument_materi']['error'] === UPLOAD_ERR_OK){
			if(trim($this->input->post('dokument_materi_lama')) != ''){
				$delete_foto = $this->service->delete_photo('file',trim($this->input->post('dokument_materi_lama')));
			}
			$upload = $this->service->do_upload('file','dokument_materi');
			$fileMateri = $upload['upload_data']['file_name'];
		}
		
		$data_db = [
			'id_master_kelas' => trim($this->input->post('id_master_kelas')),
			'angkatan' => trim($this->input->post('angkatan')),
			'sequence' => 1,
			'dokument_materi' => $fileMateri,
			'dokument_video' => trim($this->input->post('dokument_video')),
			'link_zoom' => trim($this->input->post('link_zoom')),
			'date_field' => trim($this->input->post('date_field')),
			'waktu' => trim($this->input->post('waktu')),
			'status_materi_kelas' => 'A',
		];
		$add_db = $this->M->update_to_db('materi_kelas', $data_db, 'id_materi_kelas', trim($this->input->post('id_materi_kelas')));
		if($add_db){
			$this->M->add_log_history($this->session->userdata('nama_lengkap'),"process_edit_materi_kelas");
			$data = $this->session->set_flashdata('pesan', 'Berhasil edit data !');
			redirect('P/Lms/list_master_materi',$data);
		}

	}

	//end
	public function main()
	{	
		$isLock = true;
		if($this->session->userdata('user_level') <= 1){
			$isLock = false;
		}else{
			if($this->M->getParameter('@lockLoginForEveryOneCS') == 'N'){
				$isLock = false;
			}
		}
		$data['lock'] = $isLock;
		$this->load->view('p/temp/main', $data);
	}

	public function call_center()
	{	
		if($this->session->userdata('user_level') <= 2){
			$data['list_data'] = $this->M->getListHistoryCall();
			$data['list_marketing'] = $this->M->getAllMarketing();
		}else{
			$data['list_data'] = $this->M->getListHistoryCall(null,null,$this->session->userdata('id_user'));
			$data['list_marketing'] = $this->M->getAllMarketing($this->session->userdata('id_user'));
		}
		$this->load->view('p/callcenter/call_center', $data);
	}
	public function wa_official()
	{	
		$this->load->view('p/callcenter/wa_official');
	}
	
	public function get_data_wa_official() {
		$dateToday = $this->input->get('dateToday');
		if($dateToday != ""){
        	$data =$this->M->getChatWhatsappOfficial($dateToday);
    	}else{
    		$data =$this->M->getChatWhatsappOfficial();
    	}
        echo json_encode($data);
    }

	public function get_data_call_center() {
		$query = $this->input->get('query');
		if($query != ""){
			if($this->session->userdata('user_level') <= 2){
        		$data =$this->M->getListHistoryCall("query", $query);
			}else{
        		$data =$this->M->getListHistoryCall("query", $query,$this->session->userdata('id_user'));
			}
    	}else{
    		if($this->session->userdata('user_level') <= 2){
				$data = $this->M->getListHistoryCall();
			}else{
				$data = $this->M->getListHistoryCall(null,null,$this->session->userdata('id_user'));
			}
    	}
        echo json_encode($data);
    }

    public function get_data_call_center_first() {
		$query = $this->input->get('query');
		if($query != ""){
			if($this->session->userdata('user_level') <= 2){
        		$data =$this->M->getListHistoryCallFirst("query", $query);
			}else{
        		$data =$this->M->getListHistoryCallFirst("query", $query,$this->session->userdata('id_user'));
			}
    	}else{
    		if($this->session->userdata('user_level') <= 2){
				$data = $this->M->getListHistoryCallFirst();
			}else{
				$data = $this->M->getListHistoryCallFirst(null,null,$this->session->userdata('id_user'));
			}
    	}
        echo json_encode($data);
    }

    public function get_data_call_center_detail() 
    {
		$query = $this->input->get('query');
		if($query != ""){
        	$data =$this->M->getListHistoryCall("id", $query);
    	}else{
    		$data =$this->M->getListHistoryCall();
    	}
        echo json_encode($data);
    }

    public function get_group_marketing_call()
    {
    	$id_user = $this->input->get('id_user') == "" ? null : $this->input->get('id_user');
    	$type_group = $this->input->get('type_group') == "" ? null : $this->input->get('type_group');
    	$searchDate = $this->input->get('searchDate') == "" ? null : $this->input->get('searchDate');
    	$data = $this->M->getGroupMarketingCall($id_user, $type_group, $searchDate);
    	echo json_encode($data);
    }

    public function change_type_group_wa_call_center()
    {
    	$query = explode("-", $this->input->get('query'));
    	$updateDB = $this->M->update_to_db('history_call_center',['type_group'=>$query[1]],'id_history_call_center',$query[0]);
    	if($updateDB){
    		echo json_encode(['status_code' => 200, 'msg' => "Berhasil Update"]);
    	}else{
    		echo json_encode(['status_code' => 201, 'msg' => "Gagal Update"]);
    	}
    }

    public function update_priority_wa_call_center()
    {
    	$query = $this->input->get('query');
    	$updateDB = $this->M->update_to_db('history_call_center',['priority'=>1],'id_history_call_center',$query);
    	if($updateDB){
    		echo json_encode(['status_code' => 200, 'msg' => "Berhasil Update"]);
    	}else{
    		echo json_encode(['status_code' => 201, 'msg' => "Gagal Update"]);
    	}
    }

    public function delete_wa_call_center()
    {
    	$query = $this->input->get('query');
    	$value = $this->input->get('value');
    	$updateDB = $this->M->update_to_db('history_call_center',['is_deleted'=>$value],'id_history_call_center',$query);
    	if($updateDB){
    		echo json_encode(['status_code' => 200, 'msg' => "Berhasil Delete"]);
    	}else{
    		echo json_encode(['status_code' => 201, 'msg' => "Gagal Delete"]);
    	}
    }
    

    public function update_notes_wa_call_center()
    {
    	if ($this->input->is_ajax_request()) {
	    	$query = $this->input->post('query');
	    	$value = $this->input->post('value');
	    	$date = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
			$formattedDate = $date->format('Y-m-d H:i:s');
			$dataUpdate = [
				'notes_call'=>$value,
				'status_call_center' => 'P',
				'last_call' => $formattedDate
			];
	    	$updateDB = $this->M->update_to_db('history_call_center',$dataUpdate,'id_history_call_center',$query);
	    	if($updateDB){
	    		echo json_encode(['status_code' => 200, 'msg' => "Berhasil Update"]);
	    	}else{
	    		echo json_encode(['status_code' => 201, 'msg' => "Gagal Update"]);
	    	}
    	} else {
            // If not an AJAX request, show a 404 error
            show_404();
        }
    }

	public function master_product()
	{
		$data['list_data'] = $this->M->getAllData('master_kelas');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/master_product', $data);
		$this->load->view('p/temp/footer');
	}

	public function master_notif_wa()
	{
		$data['list_data'] = $this->M->getAllData('master_kelas');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/master_notif_wa', $data);
		$this->load->view('p/temp/footer');
	}

	public function report()
	{
		$this->report_peserta();
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
			$reference != "" ||
			$pic != "" ||
			$angkatan != "" || 	
			$status_lunas != ""){

			$data['list_report'] = $this->M->get_report($nama_lengkap,$time_history,$id_master_kelas,$status_sertifikat,$status_lunas, $reference, $pic, $angkatan);
		}else{
			$data['list_report'] = [];
		}
		$data['list_master_kelas'] = $this->M->getAllData('master_kelas');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');

		$data['nama_lengkap'] = $nama_lengkap;
		$data['reference'] = $reference;
		$data['pic'] = $pic;
		$data['angkatan'] = $angkatan;
		$data['id_master_kelas'] = $id_master_kelas;
		$data['status_sertifikat'] = $status_sertifikat;
		$data['status_lunas'] = $status_lunas;
		$data['time_history'] = $time_history;
		$data['allowImportDataPeserta'] = $this->M->getParameter('@allowImportDataPeserta');
		$data['startAngkatan'] = (int) $this->M->getParameter('@startNumberAngkatan');
		$data['endAngkatan'] = (int) $this->M->getParameter('@endNumberAngkatan');
		$data['list_pic'] = explode(",",$this->M->getParameter('@picRegister'));
		$this->load->view('p/report/header',$data);
		$this->load->view('p/report/report_peserta', $data);
		$this->load->view('p/temp/footer');
	}
	public function report_kta_peserta()
	{
		$nama_lengkap = trim($this->input->post('nama_lengkap'));
		$pic = trim($this->input->post('pic'));
		$angkatan = trim($this->input->post('angkatan'));
		$jenis_kta = trim($this->input->post('jenis_kta'));
		if($nama_lengkap != "" ||
			$pic != "" ||
			$angkatan != "" || 	
			$jenis_kta != ""){
			$data['list_report'] = $this->M->get_report_kta($nama_lengkap,$pic, $angkatan,$jenis_kta);
		}else{
			$data['list_report'] = [];
		}
		$data['list_master_kelas'] = $this->M->getAllData('master_kelas');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');

		$data['nama_lengkap'] = $nama_lengkap;
		$data['pic'] = $pic;
		$data['angkatan'] = $angkatan;
		$data['allowImportDataPeserta'] = $this->M->getParameter('@allowImportDataPeserta');
		$data['startAngkatan'] = (int) $this->M->getParameter('@startNumberAngkatan');
		$data['endAngkatan'] = (int) $this->M->getParameter('@endNumberAngkatan');
		$data['list_pic'] = explode(",",$this->M->getParameter('@picRegister'));
		$this->load->view('p/report/header',$data);
		$this->load->view('p/report/report_kta_peserta', $data);
		$this->load->view('p/temp/footer');
	}
	
	public function log_activity()
	{
		$nik = trim($this->input->post('nik'));
		$action = trim($this->input->post('action'));
		$time_history = trim($this->input->post('time_history'));
		if($nik != "" || 
			$time_history != "" ||
			$action != ""){
			$data['list_report'] = $this->M->get_log_history($nik,$action, $time_history);
		}else{
			$data['list_report'] = [];
		}
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');

		$data['nik'] = $nik;
		$data['action'] = $action;
		$data['time_history'] = $time_history;
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/log_activity', $data);
		$this->load->view('p/temp/footer');
	}

	public function management_database()
	{	
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['tables'] = $this->db->list_tables();
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/management_database/index', $data);
		$this->load->view('p/temp/footer');
	}
	public function view($table) {
		 // Pagination Configuration
	    $config = array();
	    $config['base_url'] = site_url('P/Admin/view/' . $table);
	    $config['total_rows'] = $this->Crud_model->record_count($table); // Total rows in the table
	    $config['per_page'] = (int)$this->M->getParameter('@totalRowPerPagePaging'); // Number of records per page
	    $config['uri_segment'] = 5; // The segment in the URL that contains the page number

	    // Customizing the pagination
	    $config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul>';
	    
	    $config['first_link'] = 'First';
	    $config['first_tag_open'] = '<li class="page-item">';
	    $config['first_tag_close'] = '</li>';
	    
	    $config['last_link'] = 'Last';
	    $config['last_tag_open'] = '<li class="page-item">';
	    $config['last_tag_close'] = '</li>';
	    
	    $config['next_link'] = '&raquo;';
	    $config['next_tag_open'] = '<li class="page-item">';
	    $config['next_tag_close'] = '</li>';
	    
	    $config['prev_link'] = '&laquo;';
	    $config['prev_tag_open'] = '<li class="page-item">';
	    $config['prev_tag_close'] = '</li>';
	    
	    $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
	    $config['cur_tag_close'] = '</a></li>';
	    
	    $config['num_tag_open'] = '<li class="page-item">';
	    $config['num_tag_close'] = '</li>';
	    
	    $config['attributes'] = array('class' => 'page-link');

	    // Initialize pagination
	    $this->pagination->initialize($config);

	    // Get the current page number
	    $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
	    $data['records'] = $this->Crud_model->fetch_records($table, $config['per_page'], $page);
    	$data['links'] = $this->pagination->create_links();

		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
        $data['table'] = $table;
        $this->load->view('p/temp/header',$data);
        $this->load->view('p/management_database/view', $data);
        $this->load->view('p/temp/footer');
    }

    public function create($table) {
    	$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
        if ($this->input->post()) {
            $data = $this->input->post();
            $this->Crud_model->insert($table, $data);
            redirect("P/Admin/view/$table");
        } else {
            $data['table'] = $table;
            $data['fields'] = $this->db->list_fields($table);
            $this->load->view('p/temp/header',$data);
            $this->load->view('p/management_database/create', $data);
            $this->load->view('p/temp/footer');
        }
    }

    public function edit($table, $id) {
    	$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
        if ($this->input->post()) {
            $data = $this->input->post();
            $this->Crud_model->update($table, $id, $data, 'id_'.$table);
            redirect("P/Admin/view/$table");
        } else {
            $data['table'] = $table;
            $data['record'] = $this->Crud_model->get_by_id($table, $id, 'id_'.$table);
            $data['fields'] = $this->db->list_fields($table);
            // Get detailed field information
   			$field_data = $this->db->field_data($table);
   			$data['field_data'] = $field_data;
            $this->load->view('p/temp/header',$data);
            $this->load->view('p/management_database/edit', $data);
            $this->load->view('p/temp/footer');
        }
    }

    public function delete($table, $id) {
        $this->Crud_model->delete($table, $id, 'id_'.$table);
        redirect($this->input->server('HTTP_REFERER'));
    }

	public function parameter()
	{
		if($this->session->userdata('user_level') == 3){
			$ids = ['@startNumberCertificatePKPA', '@startNumberCertificateUPA']; // array of ids
			$this->db->where_in('nama_parameter', $ids);
			$query = $this->db->get('parameter')->result_array();
			$data['list_data'] = $query;
		}else{
			$data['list_data'] = $this->M->getAllData('parameter');
		}
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/parameter', $data);
		$this->load->view('p/temp/footer');
	}

	public function MyClass()
	{
		$data['list_data'] = $this->M->getAllMasterWhereOneCondition('order_booking','id_user',$this->session->userdata('id_user'));
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/myclass',$data);
		$this->load->view('p/temp/footer');
	}

	public function master_user_peserta()
	{
		$data['list_data'] = $this->M->getAllMasterWhereOneCondition('user', 'user_level', 4);
		$data['url_level'] = $this->uri->segment(4);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/master_user',$data);
		$this->load->view('p/temp/footer');
	}

	public function master_user_admin()
	{
		$data['list_data'] = $this->M->getAllMasterWhereOneCondition('user', 'user_level', 3);
		$data['url_level'] = $this->uri->segment(4);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/master_user',$data);
		$this->load->view('p/temp/footer');
	}

	public function master_user_owner()
	{
		$data['list_data'] = $this->M->getAllMasterWhereOneCondition('user', 'user_level', 2);
		$data['url_level'] = $this->uri->segment(4);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
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
			$data['previous_url'] = $this->input->server('HTTP_REFERER');
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
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/orderclass',$data);
		$this->load->view('p/temp/footer');
	}

	public function DoneClass()
	{
		$data['list_data'] = $this->M->get_order_booking_list_kelas('status_order','D');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/doneclass',$data);
		$this->load->view('p/temp/footer');
	}

	public function Sertifikat()
	{
		$data['list_data'] = $this->M->get_order_booking_not_approve('status_order','D');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$data['allowButtonApprove'] = $this->M->getParameter('@allowButtonApprove');
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/sertifikat',$data);
		$this->load->view('p/temp/footer');
	}

	public function DoneSertifikat()
	{
		$data['list_data'] = $this->M->get_order_booking_approved('status_order','D');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$data['allowButtonApprove'] = $this->M->getParameter('@allowButtonApprove');
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/done_sertifikat',$data);
		$this->load->view('p/temp/footer');
	}

	public function daftarorderan()
	{
		$data['list_data'] = $this->M->get_order_booking_list_kelas('status_order','L');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/daftarorderan',$data);
		$this->load->view('p/temp/footer');
	}


	public function detail_master_product($id)
	{
		$data['list_data'] = $this->M->getWhere('master_kelas',['id_master_kelas'=>trim($id)]);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/detail_master_product', $data);
		$this->load->view('p/temp/footer');
	}

	public function show_profile()
	{
		$data['list_data'] = $this->M->getWhere('user',['id_user'=>trim($this->session->userdata('id_user'))]);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/show_profile', $data);
		$this->load->view('p/temp/footer');
	}

	public function edit_master_product($id)
	{
		$data['list_data'] = $this->M->getWhere('master_kelas',['id_master_kelas'=>trim($id)]);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/edit_master_product', $data);
		$this->load->view('p/temp/footer');
	}

	public function edit_parameter($id)
	{
		$data['list_data'] = $this->M->getWhere('parameter',['id_parameter'=>trim($id)]);
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
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
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$data['list_pic'] = explode(",",$this->M->getParameter('@picRegister'));
		$data['startAngkatan'] = (int) $this->M->getParameter('@startNumberAngkatan');
		$data['endAngkatan'] = (int) $this->M->getParameter('@endNumberAngkatan');
		$data['list_kta'] = $this->M->getWhereList('kta',['id_order_booking'=>trim($idOrder)]);
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
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
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
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
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
				$this->M->add_log_history($this->session->userdata('nama_lengkap'),"process_add_master_product");
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
			$this->M->add_log_history($this->session->userdata('nama_lengkap'),"process_edit_master_product");
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
			$this->M->add_log_history($this->session->userdata('nama_lengkap'),"process_edit_parameter");
			$data = $this->session->set_flashdata('pesan', 'Berhasil edit data !');
			redirect('P/Admin/parameter',$data);
		}

	}

	public function process_edit_user_profile()
	{
		$fileNameFoto = trim($this->input->post('foto_ktp_lama'));
		$fileNameFotoKta = trim($this->input->post('foto_kta_lama'));
	
		if(isset($_FILES['foto_ktp']) && $_FILES['foto_ktp']['error'] === UPLOAD_ERR_OK){
			if(trim($this->input->post('foto_ktp_lama')) != ''){
				$delete_foto = $this->service->delete_photo('img',trim($this->input->post('foto_ktp_lama')));
			}
			$upload = $this->service->do_upload('img','foto_ktp');
			$fileNameFoto = $upload['upload_data']['file_name'];
		}

		if(isset($_FILES['foto_kta']) && $_FILES['foto_kta']['error'] === UPLOAD_ERR_OK){
			if(trim($this->input->post('foto_kta_lama')) != ''){
				$delete_foto = $this->service->delete_photo('kta',trim($this->input->post('foto_kta_lama')));
			}
			$upload = $this->service->do_upload('kta','foto_kta');
			$fileNameFotoKta = $upload['upload_data']['file_name'];
		}
		if($fileNameFotoKta){
			$removeBGKTA = $this->service->removeBG($this->M->getParameter('@apiKeyRemoveBG'),$fileNameFotoKta);
			if($removeBGKTA != ""){
				$delete_foto = $this->service->delete_photo('kta',$fileNameFotoKta);
				$fileNameFotoKta = $removeBGKTA;
			}
		}

		$data_send_db = [
			'nama_lengkap' => trim($this->input->post('nama_lengkap')),
			'nik' => trim($this->input->post('nik')),
			'email' => trim($this->input->post('email')),
			'handphone' => trim($this->input->post('handphone')),
			'foto_ktp' => trim($fileNameFoto),
			'foto_kta' => trim($fileNameFotoKta)
		];
		$add_db = $this->M->update_to_db('user', $data_send_db, 'id_user', trim($this->session->userdata('id_user')));
		if($add_db){
			$this->M->add_log_history($this->session->userdata('nama_lengkap'),"process_edit_user_profile = ".$this->input->post('nama_lengkap'));
			$data = $this->session->set_flashdata('pesan', 'Berhasil perbaharui data !');
			redirect('P/Admin/show_profile',$data);
		}
	}

	public function delete_cart_product($id_master_kelas)
	{
		if($id_master_kelas){
			$data = $this->M->getWhere('cart',['id_master_kelas'=>trim($id_master_kelas), 'id_user'=>trim($this->session->userdata('id_user'))]);
			if($data){
				$this->M->add_log_history($this->session->userdata('nama_lengkap'),"delete_cart_product ".$data['id_master_kelas']);
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

	public function delete_user($id_user)
	{
		if($id_user){
			$data = $this->M->getWhere('user',['id_user'=>trim($id_user)]);
			$getAllColumn = $this->M->getColumnTableAll('id_user');
			if($data){
				foreach ($getAllColumn as $ga) {
					$this->M->delete_to_db($ga['table_name'],'id_user',$data['id_user']);
				}
				$this->M->add_log_history($this->session->userdata('nama_lengkap'),"delete_user ".$data['nama_lengkap']);
				$data = $this->session->set_flashdata('pesan', 'Berhasil di hapus !');
				redirect($this->input->server('HTTP_REFERER'),$data);
			}else{
				$data = $this->session->set_flashdata('pesan', 'Gagal di hapus !');
				redirect($this->input->server('HTTP_REFERER'),$data);
			}
		}else{
			$data = $this->session->set_flashdata('pesan', 'Gagal di hapus !');
			redirect($this->input->server('HTTP_REFERER'),$data);
		}
	}

	
	public function delete_master_product($id)
	{
		if($id){
			$data = $this->M->getWhere('master_kelas',['id_master_kelas'=>trim($id)]);
			if($data){
				$delete_foto = $this->service->delete_photo('img',$data['foto_kelas']);
				if($delete_foto['code'] == 200){
					$this->M->add_log_history($this->session->userdata('nama_lengkap'),"delete_master_product " .$data['nama_kelas']);
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
				$this->M->add_log_history($this->session->userdata('nama_lengkap'),"Melakukan Order Kelas = ". trim($dataKelas['nama_kelas']));
				$this->M->delete_to_db('cart','id_user',trim($this->session->userdata('id_user')));
				if($this->M->getParameter('@sendNotifOrderClass') == 'Y'){
					$data_send_notif = [
						'handphone' => trim($this->session->userdata('handphone')),
						'namalengkap' => trim($this->session->userdata('nama_lengkap')),
						'namaKelas' => trim($dataKelas['nama_kelas']),
						'metodeBayar' => trim($this->input->post('metode_bayar')),
					];
					$sendUser = $this->service->send_whatsapp($data_send_notif, 'order_class');
					if($sendUser){
						$data_send_notif_admin = [
							'handphone' => trim($this->M->getParameter('@waAdminNotif')),
							'namalengkap' => trim($this->session->userdata('nama_lengkap')),
							'namaKelas' => trim($dataKelas['nama_kelas']),
							'metodeBayar' => trim($this->input->post('metode_bayar')),
						];
						$this->service->send_whatsapp($data_send_notif_admin, 'order_notif_admin');
					}
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

	public function process_valid_order()
	{
		$id_user = trim($this->input->post('id_user'));
		$idOrder = trim($this->input->post('id_order_booking'));
		$metode_bayar = trim($this->input->post('metode_bayar'));
		$pic = trim($this->input->post('pic'));
		$nama_kelas = trim($this->input->post('nama_kelas'));
		$arrnama_kelas = explode(",", $nama_kelas);
		$list_angakatan = "";
        foreach ($arrnama_kelas as $t) {
		    $angkatan = trim($this->input->post('angkatan_'.str_replace(' ', '', $t)));
		    if ($angkatan) {
		        $list_angakatan .= $angkatan . "~";
		    }
		}
		$data = $this->M->getWhere('order_booking',['id_user'=>trim($id_user),'id_order_booking' =>trim($idOrder)]);
		if($data){
			$data_update = [
				'metode_bayar' => $metode_bayar,
				'status_order' => 'L',
				'angkatan_kelas' => $list_angakatan
			];
			$update = $this->M->update_to_db('order_booking',$data_update,'id_order_booking',$idOrder);
			$this->M->update_to_db('user',['pic'=>$pic],'id_user',$id_user);
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
				$add_history = $this->M->add_log_history($this->session->userdata('nama_lengkap'),"Validasi Order ".$getListKelas['nama_kelas']." Berhasil Untuk = ".$user['nama_lengkap']);
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


	public function process_add_kta()
	{
		$dataOB = $this->M->getWhere('order_booking',['id_order_booking'=>trim($this->input->post('id_order_booking'))]);
		if($dataOB){
			if(strpos($dataOB['list_kelas'], strtoupper(trim($this->input->post('jenis_kta')))) !== false){ 
				$dataUser = $this->M->getWhere('user',['id_user'=>trim($dataOB['id_user'])]);
				if($dataUser['foto_kta'] != null){
					//ada
					$dataKTA = $this->M->getWhere('kta',['jenis_kta'=>trim($this->input->post('jenis_kta')),'id_order_booking'=>trim($this->input->post('id_order_booking'))]);
					if(!$dataKTA){
						//boleh add
						$data_where = [
							'id_order_booking' => trim($this->input->post('id_order_booking')),
							'id_user'=>trim($dataOB['id_user']),
							'id_master_kelas' => trim($this->input->post('jenis_kta')),
						];
						$dataNOKTA = $this->M->getWhere('approve_cetificate',$data_where);
						$dataSendDB = [
							'id_order_booking' => trim($this->input->post('id_order_booking')),
							'jenis_kta' => trim($this->input->post('jenis_kta')),
							'nama_kta' => trim($this->input->post('nama_kta')),
							'berlaku_kta' => trim($this->input->post('berlaku_kta')),
							'nomor_kta' => $dataNOKTA['number_certificate']
						];
						$add_db = $this->M->add_to_db('kta', $dataSendDB);
						if($add_db){
							$data = $this->session->set_flashdata('pesan', 'KTA Berhasil Di terbitkan !');
						}
					}else{
						$data = $this->session->set_flashdata('pesan', 'KTA Telah Terbit !');
					}
				}else{
					$data = $this->session->set_flashdata('pesan', 'Harap Upload Foto Customer Pada Profile Customer !');
				}
			}else{
				$data = $this->session->set_flashdata('pesan', 'Kelas Tidak Tersedia !');
			}
		}
		redirect('P/Admin/valid_order/'.trim($this->input->post('id_user')).'/'.trim($this->input->post('id_order_booking')),$data);
	}

	public function process_add_order_payment()
	{
		if($this->session->userdata('user_level') > 3){
			redirect('P/Auth/process_logout');
		}

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

                        $this->M->add_log_history($this->session->userdata('nama_lengkap'),"Add Payment Order ".$getListKelas['nama_kelas']." Berhasil Untuk = ".$user['nama_lengkap']."Nominal ".$orderPayment['nominal_payment']);
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
							// $this->service->send_whatsapp($data_send_notif, 'generate_payment',trim($orderPayment['date_payment']));
							// if(trim($this->input->post('sequence_payment')) > 1){
							// 	//function generate jatuh tempo
							// 	$this->generateNotifJatuhTempo($data_send_notif, trim($orderPayment['date_payment']));
							// }
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

	public function generateNotifJatuhTempo($data, $tanggal){
		// Create a DateTime object for the current date and time
		$now = new DateTime($tanggal);

		// Clone the DateTime object and modify it to get the next 3 dates
		$today = clone $now;
		$tomorrow1 = clone $now;
		$tomorrow2 = clone $now;
		$tomorrow3 = clone $now;

		$yesterday1 = clone $now;
		$yesterday2 = clone $now;
		$yesterday3 = clone $now;

		$tomorrow1->modify('+1 day');
		$tomorrow2->modify('+2 days');
		$tomorrow3->modify('+3 days');

		$yesterday1->modify('-1 day');
		$yesterday2->modify('-2 day');
		$yesterday3->modify('-3 day');

		$dateYesterday = [$yesterday1->format('Y-m-d'),$yesterday2->format('Y-m-d'),$yesterday3->format('Y-m-d')];
		$dateTomorrow = [$tomorrow1->format('Y-m-d'),$tomorrow2->format('Y-m-d'),$tomorrow3->format('Y-m-d')];
		foreach($dateYesterday as $dy){
			$this->service->send_whatsapp($data, 'generate_payment_yesterday',trim($dy));
		}
		foreach($dateTomorrow as $dt){
			$this->service->send_whatsapp($data, 'generate_payment_tomorrow',trim($dt));
		}
	}

	public function delete_order_class($idOrder)
	{
		if($idOrder){
			$order = $this->M->getWhere('order_booking',['id_order_booking'=>trim($idOrder)]);
			if($order){
				$add_history = $this->M->add_log_history($this->session->userdata('nama_lengkap'),"Delete Order ".$idOrder." Berhasil");
				$this->M->delete_to_db('order_booking','id_order_booking',$idOrder);
				$data = $this->session->set_flashdata('pesan', 'Berhasil hapus order !');
				redirect($this->input->server('HTTP_REFERER'),$data);
			}else{
				$data = $this->session->set_flashdata('pesan', 'gagal hapus order !');
				redirect($this->input->server('HTTP_REFERER'),$data);
			}
		}else{
			$data = $this->session->set_flashdata('pesan', 'gagal hapus order !');
			redirect($this->input->server('HTTP_REFERER'),$data);
		}
	}

	public function delete_order_payment($id_user, $idOrderPayment)
	{
		if($idOrderPayment){
			$payment = $this->M->getWhere('order_payment',['id_order_payment'=>trim($idOrderPayment)]);
			if($payment){
				$add_history = $this->M->add_log_history($this->session->userdata('nama_lengkap'),"Delete Order Untuk User ".$id_user." Berhasil");
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
		$totalCustomer = 0;
		$totalSertifikat = 0;
		$check = false;
		foreach ($list_id_order as $val) {
			$update = $this->M->update_to_db('order_booking',['status_certificate'=>'A'],'id_order_booking',$val);
			$orderB = $this->M->getWhere('order_booking',['id_order_booking'=>trim($val)]);
			$totalCustomer++;
			$incPKPAUPA = 0;
			$isPKPA = false;
			$isUPA= false;
			$idPKPA = 0;
			$idUPA = 0;
			$startNumber = 0;
			$list_kelas = explode("~", $orderB['list_kelas']);
			foreach ($list_kelas as $valIDKelas) {
				if($valIDKelas != ""){
					$totalSertifikat++;
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
					$getCer = $this->db->query("SELECT number_certificate FROM approve_cetificate WHERE id_master_kelas = '$valIDKelas' ORDER BY CAST(number_certificate AS UNSIGNED) DESC LIMIT 1")->row_array();
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

					if($this->M->getParameter('@manualNumberCertificate') == 'Y'){
						if (strpos($getMK['nama_kelas'], 'PKPA') !== false) {
							$createNumber = (int) $this->M->getParameter('@startNumberCertificatePKPA'); //from parameter
						}else if (strpos($getMK['nama_kelas'], 'UPA') !== false) {
							$createNumber = (int) $this->M->getParameter('@startNumberCertificateUPA'); //from parameter
						}
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
			$check = true;
			if($this->M->getParameter('@sendNotifApproveCertificate') == 'Y' && 
				$orderB['list_kelas'] != '5~'){
				$array = explode("~", $orderB['list_kelas']);
                $array = array_filter($array, function($value) {
                    return $value !== '';
                });
                $inClause = implode(",", $array);
                $query = "SELECT GROUP_CONCAT(nama_kelas)AS nama_kelas , foto_kelas, GROUP_CONCAT(link_group_wa) AS link_group_wa  FROM master_kelas WHERE id_master_kelas IN ($inClause)";
                $getListKelas = $this->db->query($query)->row_array();
			// 		$master_kelas = $this->M->getWhere('master_kelas',['id_master_kelas'=>trim($orderB['id_master_kelas'])]);

				$user = $this->M->getWhere('user',['id_user'=>trim($orderB['id_user'])]);
                $add_history = $this->M->add_log_history($this->session->userdata('nama_lengkap'),"Approve Kelas ".$getListKelas['nama_kelas']. "Atas Nama ".$user['nama_lengkap']);

				$data_send_notif = [
					'handphone' => trim($user['handphone']),
					'namalengkap' => trim($user['nama_lengkap']),
					'namaKelas' => trim($getListKelas['nama_kelas']),
					'url_certificate' => trim(base_url('P/Payment/generateCertificate/'.$orderB['id_user'].'/'.trim($val)))
				];
				$sendWa = $this->service->send_whatsapp($data_send_notif, 'approve_certificate');
				if($sendWa){
					$check = true;
				}

			}
			// }

		}
		if($check){
			echo json_encode([
				'status_code' => 200, 
				'totalSertifikat' => $totalSertifikat,
				'totalCustomer' => $totalCustomer
			]);
		}else{
			echo json_encode(['status_code' => 400]);
		}
	}

	

	public function process_add_master_user($level)
	{
		$data_register = [
			'nama_lengkap' => trim($this->input->post('nama_lengkap')),
			'nik' => trim((int)$this->input->post('nik')),
			'email' => trim($this->input->post('email')),
			'handphone' => trim($this->input->post('handphone')),
			'usia' => trim($this->input->post('usia')),
			'asal_kampus' => trim($this->input->post('asal_kampus')),
			'semester' => trim($this->input->post('semester')),
			'password' => trim($this->input->post('password')),
			'password_hash' => password_hash(trim($this->input->post('password')), PASSWORD_DEFAULT),
			'is_active' => 'Y',
			'user_level' => $level,
			'foto_ktp' => 'logo_peradi.jpg',
			'is_marketing' => trim($this->input->post('is_marketing'))
		];

		$checkUserExist =  $this->M->checkUserExist(trim($this->input->post('nik')), trim($this->input->post('handphone')));
		// die;
		if($checkUserExist < 1){

			// echo json_encode($data_register);die;
			$add_db = $this->M->add_to_db('user', $data_register);
			if($add_db){
				$add_history = $this->M->add_log_history($this->session->userdata('nama_lengkap'),"Pendaftaran Akun Baru Melalui Admin");
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
                $dataUpload = $this->upload->data();
                echo "File " . $file . " uploaded successfully!";
                $checkUpload = true;
    //            
            } else {
                echo "Error uploading file " . $file . ": " . $this->upload->display_errors();
                $data = $this->session->set_flashdata('pesan', 'Error Upload File !');
				$this->redirectUpload($data, $id_order_booking, $dataOB['id_user']);
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

    public function importDataPeserta() {
        // Load the file upload library
        $config['upload_path'] = './assets/p/file/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = 10000; // 1MB

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file_excel')) {
            $data = $this->session->set_flashdata('pesan', 'Import Gagal !');
			redirect('P/Admin/report_peserta/');
        } else {
            $data = $this->upload->data();
            $file_path = $data['full_path'];

            $header = [
				"nik",
				"email",
				"nama_lengkap",
				"handphone",
				"usia",
				"asal_kampus",
				"sudah_lulus",
				"latar_belakang_hukum",
				"reference",
				"pic",
				"angkatan",
				"nama_kelas",
				"metode_bayar",
				"lunas",
				"cicilan",
				"bertahap",
				"tanggal_bayar",
				"nominal",
				"status_bayar",
				"status_sertifikat",
				"no_sertifikat",
				"jadwal_pelatihan"
			];
            // Load the CSV file
            $dataArray = [];
            $file = fopen($file_path, 'r');
            $number = 0;
            while (($row = fgetcsv($file, 1000, ";")) !== FALSE) {
            	if($number > 0){
	                $objectArr = [];
	                $checkValue = false;
	                for ($i=0; $i < count($header); $i++) { 
	                	if($row[0] != ""){
	                		$checkValue = true;
	                	 	$objectArr[$header[$i]] = trim($row[$i]);
	                	}else{
	                		continue;
	                	}
	                }
	                
	                if($checkValue){
	                	array_push($dataArray,$objectArr);
	            	}
            	}
                $number++;
            }
            fclose($file);
            // Delete the file after processing
            unlink($file_path);

            // echo json_encode($dataArray);
            // die;
            //prepare insert to db
            $checkData = false;
            $totalDataImport = 0;
            foreach ($dataArray as $key => $value) {
            	// insert to table user
            	$data_send_user = [
					'nama_lengkap' => trim($value['nama_lengkap']),
					'nik' => trim($value['nik']),
					'email' => trim($value['email']),
					'handphone' => trim($value['handphone']),
					'usia' => trim($value['usia']),
					'asal_kampus' => trim($value['asal_kampus']),
					'semester' => trim($value['sudah_lulus']),
					'reference' => trim($value['reference']),
					'pic' => trim($value['pic']),
					'angkatan' => trim("Angkatan Ke - ".$value['angkatan']),
					'latar_belakang' => trim($value['latar_belakang_hukum']),
					'password' => trim($value['handphone']),
					'password_hash' => password_hash(trim($value['handphone']), PASSWORD_DEFAULT),
					'is_active' => 'Y',
					'user_level' => 4,
					'foto_ktp' => 'logo_peradi.jpg'           		
            	];
            	$call_id_user = $this->M->add_to_db('user', $data_send_user);

            	if($call_id_user){
            		//prepare insert to order_booking
            		$status_order = "N";
            		if(trim($value['lunas']) == "Y"){
            			$status_order = "D";
            		}
            		if(trim($value['cicilan']) == "Y" || trim($value['bertahap']) == "Y"){
            			$status_order = "L";
            		}

            		$className = strtoupper(trim($value['nama_kelas']));
            		$list_kelas = "";

            		if(strpos($className, strtoupper("PKPA")) !== false){
						$list_kelas = $list_kelas."1~";
					}
					if(strpos($className, strtoupper("UPA")) !== false){
						$list_kelas = $list_kelas."3~";
					}
					if(strpos($className, strtoupper("SUMPAH")) !== false){
						$list_kelas = $list_kelas."5~";
					}
					if(strpos($className, strtoupper("BREVET")) !== false){
						$list_kelas = $list_kelas."4~";
					}
					if(strpos($className, strtoupper("PARALEGAL")) !== false){
						$list_kelas = $list_kelas."2~";
					}
					if(strpos($className, strtoupper("CPT")) !== false){
						$list_kelas = $list_kelas."6~";
					}
					if(strpos($className, strtoupper("MEDIAT")) !== false){
						$list_kelas = $list_kelas."7~";
					}
					if(strpos($className, strtoupper("AGRARIA")) !== false){
						$list_kelas = $list_kelas."8~";
					}


            		$data_send_ob = [
						'id_user' => trim($call_id_user),
						'id_master_kelas' => 0,
						'metode_bayar' => trim($value['metode_bayar']),
						'status_order' => $status_order,
						'list_kelas' => trim($list_kelas),
					];
					$call_id_ob = $this->M->add_to_db('order_booking', $data_send_ob);
					//add log activity
					$this->M->add_log_history($this->session->userdata('nama_lengkap'),"Add Order ".$value['nama_kelas']." Berhasil Untuk = ".$value['nama_lengkap']);

					if($call_id_ob){
						//prepare insert to order payment
						$status_payment = explode("|",$value['status_bayar'] == "" ? "N" : $value['status_bayar']);
						
						if(trim($value['lunas']) == "Y"){
	            			$value['tanggal_bayar'] = str_replace('|', '', $value['tanggal_bayar']);
	            			$value['nominal'] = str_replace('|', '', $value['nominal']);
	            			$status_payment = str_replace('|', '', $status_payment);
	            		}

	            		$nominal = explode("|",$value['nominal']);
						$tanggal_bayar = explode("|",$value['tanggal_bayar']);

            			// echo json_encode($nominal);
            			$checkAllLunas = 0;
            			//add payment
						for ($ip=0; $ip < count($tanggal_bayar); $ip++) { 

							$id_virtual_account = $this->service->generateSecureRandomString(40);
							$data_send_op = [
								'id_order_booking' => trim($call_id_ob),
								'id_virtual_account' => trim($id_virtual_account),
								'sequence_payment' => trim($ip+1),
								'nominal_payment' => (int) str_replace('.', '', $nominal[$ip]),
								'date_payment' => trim(str_replace(' ', '', date('Y-m-d', strtotime($tanggal_bayar[$ip])))),
								'status_payment' => trim($status_payment[$ip]) == "Y" ? 'D' : "P"
							];


							$call_id_op = $this->M->add_to_db('order_payment', $data_send_op);
							if(trim($status_payment[$ip]) == "N"){
								if($this->M->getParameter('@sendNotifGeneratePayment') == 'Y'){
									$orderPayment = $this->M->getWhere('order_payment',['id_order_payment'=>trim($call_id_op)]);
									$orderBook = $this->M->getWhere('order_booking',['id_order_booking'=>trim($call_id_ob)]);
									if($orderBook){
										
										$array = explode("~", $orderBook['list_kelas']);
				                        $array = array_filter($array, function($value) {
				                            return $value !== '';
				                        });
				                        $inClause = implode(",", $array);
				                        $query = "SELECT GROUP_CONCAT(nama_kelas)AS nama_kelas , foto_kelas, GROUP_CONCAT(link_group_wa) AS link_group_wa  FROM master_kelas WHERE id_master_kelas IN ($inClause)";
				                        $getListKelas = $this->db->query($query)->row_array();

										$user = $this->M->getWhere('user',['id_user'=>trim($orderBook['id_user'])]);

				                        $this->M->add_log_history($this->session->userdata('nama_lengkap'),"Add Payment Order ".$getListKelas['nama_kelas']." Berhasil Untuk = ".$user['nama_lengkap']);

										$data_send_notif = [
											'handphone' => trim($user['handphone']),
											'namalengkap' => trim($user['nama_lengkap']),
											'namaKelas' => trim($getListKelas['nama_kelas']),
											'metodeBayar' => trim($orderBook['metode_bayar']),
											'nominal_payment' => number_format(trim($orderPayment['nominal_payment']), 2),
											'date_payment' => trim($orderPayment['date_payment']),
											'url_virtual_account' => trim(base_url('P/Payment/virtual_account/'.$orderPayment['id_virtual_account']))
										];

										$dateSendNotif = "";
										if(trim(str_replace(' ', '', date('Y-m-d', strtotime($tanggal_bayar[$ip])))) < date('Y-m-d')){
											$dateSendNotif = date('Y-m-d');
											$this->service->send_whatsapp($data_send_notif, 'generate_payment');
										}else{
											$dateSendNotif = trim($orderPayment['date_payment']);
											$this->service->send_whatsapp($data_send_notif, 'generate_payment',trim($orderPayment['date_payment']));
											//function generate jatuh tempo
											$this->generateNotifJatuhTempo($data_send_notif, trim($orderPayment['date_payment']));
										}

										// echo json_encode(['dateSend' => $dateSendNotif,'dataAgo' => trim(str_replace(' ', '', date('Y-m-d', strtotime($tanggal_bayar[$ip])))) ]);die;
										// if(trim($this->input->post('sequence_payment')) == 1){
										// 	$this->service->send_whatsapp($data_send_notif, 'generate_payment');
										// }else{
										// 	$this->service->send_whatsapp($data_send_notif, 'generate_payment',trim($orderPayment['date_payment']));
										// 	if(trim($this->input->post('sequence_payment')) > 1){
										// 		//function generate jatuh tempo
										// 		$this->generateNotifJatuhTempo($data_send_notif, trim($orderPayment['date_payment']));
										// 	}
										// }
									}
								}
							}
							//if order payment status N send notif wa 
							if(trim($status_payment[$ip]) == "Y"){
								$checkAllLunas++;
							}
							if($call_id_op){
								$checkData = true;
							}
						}

						if($checkAllLunas == count($tanggal_bayar)){
							$this->M->update_to_db('order_booking', ['status_order' => 'D'], 'id_order_booking', trim($call_id_ob));
						}

						$totalDataImport++;
					}
            	}

            }

            if($checkData){
				$data = $this->session->set_flashdata('pesan', 'Total Import Berhasil '.$totalDataImport.' !');
				redirect('P/Admin/report_peserta/');
            }
            // $string = $dataArray[0];

			// // Split the string by ';' delimiter
			// $fields = explode(";", $string);

			// // Output the resulting array
			// echo json_encode($dataArray);

            // $data = $this->session->set_flashdata('pesan', 'Import Gagal !');
			// redirect('P/Admin/report_peserta/');
        }
    }

    public function generateKTA($id_user, $id_kta)
    {
    	error_reporting(0); 
        // Load the Pdf library
        if($id_kta){
        	$user = $this->M->getWhere('user',['id_user'=>trim($id_user)]);
        	$getKta = $this->M->getWhere('kta',['id_kta'=>trim($id_kta)]);
        	$ac = $this->M->getWhere('approve_cetificate',['id_order_booking'=>trim($getKta['id_order_booking']),'id_master_kelas' => $getKta['jenis_kta']]);
        	$imgQRCode = "./assets/p/qrcode/".$ac['qr_code_name'];

        	$jenis_kta = $getKta['jenis_kta'];
        	$titleName = "KTA_";
	    	if($jenis_kta == 4){
	        	//Cetak KTA Pajak
		        $pdf = new FPDF('P', 'mm', [86, 136],true, 'UTF-8', false); 
		        $pdf->AddPage();
		        $pdf->SetFont('Arial', 'B', 15);
		        $imageKTA = "./assets/p/kta/".$user['foto_kta'];
		        $image1 = "./assets/p/kta/kta_pajak_1.jpg";
		        $imageBG = "./assets/p/kta/kta_pajak_bg.png";
		        $pdf->Image($image1,0,0,86,136);//margin left - margin top - size lebar, size tinggi

		        $pdf->Image($imageKTA,0,25,67,80);
		        $pdf->Image($imageBG,0,83,86,53);
		        $pdf->Image($imgQRCode,10,107.7,25,25);
		        $pdf->SetTextColor(5, 43, 130);
		        $pdf->SetDrawColor(255, 255, 255);
		        // Nama
			    $pdf->SetXY(11,95); 
		        $pdf->Cell(38, 10, $getKta['nama_kta'], 0, 0,'L'); //margin left

		        $pdf->SetFont('Arial', 'B', 10);
		        $pdf->SetXY(45, $pdf->GetPageHeight() - 5);
		        $pdf->Cell(10, -25, 'NIA :24.000'.$getKta['nomor_kta'], 0, 0, 'L');
		        $pdf->SetXY(45, $pdf->GetPageHeight() - 5);
		        $pdf->Cell(10, -17, 'Berlaku SD ' .$getKta['berlaku_kta'], 0, 0, 'L');
		        
		        $pdf->AddPage();
		        $image1 = "./assets/p/kta/kta_pajak_2.jpg";
		        $pdf->Image($image1,0,0,86,136);
		        $titleName = $titleName.'Pajak_'.$getKta['nama_kta'];
	    	}else if($jenis_kta == 2){
	    		//Cetak KTA Paralegal
		        $pdf = new FPDF('P', 'mm', [86, 136]); 
		        $pdf->AddPage();
		        $pdf->SetFont('Arial', 'B', 15);
		        $imageKTA = "./assets/p/kta/".$user['foto_kta'];
		        $image1 = "./assets/p/kta/kta_advokat_1.jpg";
		        $imageBG = "./assets/p/kta/kta_advokat_bg.png";
		        $pdf->Image($image1,0,0,86,136);//margin left - margin top - size lebar, size tinggi
		        $pdf->Image($imageKTA,32,28,53,64);
		        $pdf->Image($imageBG,0,80,86,53);
		        $pdf->Image($imgQRCode,15,95,20,20);
		       // Nama
			    $pdf->SetXY(2,81); 
		        $pdf->SetTextColor(0, 0, 0);
		        $pdf->SetDrawColor(255, 255, 255);
		        $pdf->Cell(38, 10,$getKta['nama_kta'], 0, 1); //margin left
		        $pdf->SetXY(2,86); 
		        $pdf->SetFont('Arial', 'B', 10);
		        $pdf->Cell(30, 10, 'Paralegal', 0, 1); //margin left

		        $pdf->SetXY(10, $pdf->GetPageHeight() - 5);
		        $pdf->Cell(10, -25, 'NIA :24.000'.$getKta['nomor_kta'], 0, 0, 'L');
		        $pdf->SetXY(10, $pdf->GetPageHeight() - 5);
		        $pdf->Cell(10, -17, 'Berlaku SD ' .$getKta['berlaku_kta'], 0, 0, 'L');

		        $pdf->AddPage();
		        $image1 = "./assets/p/kta/kta_advokat_2.jpg";
		        $pdf->Image($image1,0,0,86,136);
		        $titleName = $titleName.'Paralegal_'.$getKta['nama_kta'];
	    	}else if($jenis_kta == 1){
	    		//Cetak KTA Advokat
	    		$pdf = new FPDF('P', 'mm', [86, 136]); 
		        $pdf->AddPage();
		        $pdf->SetFont('Arial', 'B', 15);
		        $imageKTA = "./assets/p/kta/".$user['foto_kta'];
		        $image1 = "./assets/p/kta/kta_advokat_1.jpg";
		        $imageBG = "./assets/p/kta/kta_advokat_bg.png";
		        $pdf->Image($image1,0,0,86,136);//margin left - margin top - size lebar, size tinggi
		        $pdf->Image($imageKTA,25,35,40,45);
		        $pdf->Image($imageBG,0,83,86,53);
		        $pdf->Image($imgQRCode,15,93,20,20);
		       // Nama
			    $pdf->SetXY(2,81); 
		        $pdf->SetTextColor(0, 0, 0);
		        $pdf->SetDrawColor(255, 255, 255);
		        $pdf->Cell(38, 10, 'Adv. '.$getKta['nama_kta'], 0, 1); //margin left

		        $pdf->SetFont('Arial', 'B', 10);
		        $pdf->SetXY(10, $pdf->GetPageHeight() - 5);
		        $pdf->Cell(10, -27, 'NIA :24.000'.$getKta['nomor_kta'], 0, 0, 'L');
		        $pdf->SetXY(10, $pdf->GetPageHeight() - 5);
		        $pdf->Cell(10, -17, 'Berlaku SD ' .$getKta['berlaku_kta'], 0, 0, 'L');

		        $pdf->AddPage();
		        $image1 = "./assets/p/kta/kta_advokat_2.jpg";
		        $pdf->Image($image1,0,0,86,136);
		        $titleName = $titleName.'Advokat_'.$getKta['nama_kta'];
	    	}
	    	// $pdf->Output();
	    	//forcedownload
	        $pdf->Output('D', $titleName.".pdf");
	        echo "PDF has been saved to " . $outputDir . $fileName;
    	}
    }



}