<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Buy extends CI_Controller
{

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods:GET,OPTIONS");
		parent::__construct();
		$this->load->model('Mbg', 'M');
		$server_key = htmlspecialchars(addslashes($this->M->getParameter('@server_key')));
		$isProduction = $this->M->getParameter('@isProduction') === '1' ? true : false;
		$params = array('server_key' => $server_key, 'production' => $isProduction);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
	}

	public function index()
	{
		$isVoucherMultipleVirtualAccount = $this->M->getParameter('@isVoucherMultipleVirtualAccount');

		if ($isVoucherMultipleVirtualAccount === '1') {

			$urlProductionMitrans = htmlspecialchars(addslashes($this->M->getParameter('@urlProductionMitrans')));
			$urlSandboxMitrans = htmlspecialchars(addslashes($this->M->getParameter('@urlSandboxMitrans')));
			$data['dataclientkey'] = htmlspecialchars(addslashes($this->M->getParameter('@data-client-key')));
			$data['urlMitrans'] = $this->M->getParameter('@isProduction') === '1' ? $urlProductionMitrans : $urlSandboxMitrans;
			$data['urlRedirect'] = htmlspecialchars(addslashes($this->M->getParameter('@urlRedirectBuyingVoucher')));
			$data['valueOfHandphoneAdmin'] = htmlspecialchars(addslashes($this->M->getParameter('@valueOfHandphoneAdmin')));
			$data['valueNameRekening'] = htmlspecialchars(addslashes($this->M->getParameter('@valueNameRekening')));
			$this->load->view('checkout_snap', $data);
		} else {

			$urlProductionMitrans = htmlspecialchars(addslashes($this->M->getParameter('@urlProductionMitrans')));
			$urlSandboxMitrans = htmlspecialchars(addslashes($this->M->getParameter('@urlSandboxMitrans')));
			$data['dataclientkey'] = htmlspecialchars(addslashes($this->M->getParameter('@data-client-key')));
			$data['urlMitrans'] = $this->M->getParameter('@isProduction') === '1' ? $urlProductionMitrans : $urlSandboxMitrans;
			$data['urlRedirect'] = htmlspecialchars(addslashes($this->M->getParameter('@urlRedirectBuyingVoucher')));
			$data['valueOfHandphoneAdmin'] = htmlspecialchars(addslashes($this->M->getParameter('@valueOfHandphoneAdmin')));
			$data['valueNameRekening'] = htmlspecialchars(addslashes($this->M->getParameter('@valueNameRekening')));
			$this->load->view('buyingVoucher/buy', $data);
		}
	}

	public function token()
	{
		$data = $this->input->get("data");
		// Required
		$gross = 0;
		$item_details = [];

		$nama;
		$emailVal;
		$hp;
		$totalVoucher = 0;

		$textError = "";
		$cekVc = false;
		$randomID = rand();
		foreach ($data as $value) {
			$gross += $value['voucher'] * $value['jumlah'];
			$nama = $value['nama'];
			$emailVal = $value['email'];
			$hp = $value['handphone'];
			$totalVoucher += $value['jumlah'];

			$item1_details = array(
				'id' => $value['no'],
				'price' => $value['voucher'],
				'quantity' => $value['jumlah'],
				'name' => "Voucher " . $value['voucher']
			);
			for ($i = 0; $i < $value['jumlah']; $i++) {
				$nominalVc =  $value['voucher'];
				$queryVC = $this->db->query("SELECT * FROM tbl_vc WHERE nmv ='$nominalVc' AND st_vc=0 LIMIT 1")->row_array();
				if ($queryVC != null) {
					$dataVC = [
						'idVoucherAuto' => $randomID,
						'nominalVoucher' => $nominalVc,
						'kodeVoucher' => $queryVC['kv'],
						'statusVoucher' => 'N'
					];
					$newIDVC = $queryVC['id_vc'];
					$this->db->query("UPDATE tbl_vc SET st_vc = 1 WHERE id_vc = '$newIDVC'");
					$this->db->insert('voucherautoitem', $dataVC);
				} else {
					$textError = $textError . " Voucher " . $value['voucher'] . " Belum Tersedia,";
					$cekVc = true;
				}
			}
			array_push($item_details, $item1_details);
		}
		//for admin
		if (!$cekVc) {
			$valueAdmin = $this->M->getParameter('@valueChargeFreeMitrans');
			$gross += $valueAdmin;
			$item1_details = array(
				'id' => '00',
				'price' => $valueAdmin,
				'quantity' => '1',
				'name' => 'Biaya Penanganan'
			);
			array_push($item_details, $item1_details);

			$item1_details = array(
				'id' => '00',
				'price' => 0,
				'quantity' => '1',
				'name' => 'Biaya Admin Bank'
			);
			array_push($item_details, $item1_details);

			$transaction_details = array(
				'order_id' => $randomID,
				'gross_amount' => $gross, // no decimal allowed for creditcard
			);

			// Optional
			$customer_details = array(
				'first_name'    => $nama,
				'last_name'     => "",
				'email'         => $emailVal,
				'phone'         => $hp,
			);

			// Data yang akan dikirim untuk request redirect_url.
			$credit_card['secure'] = true;
			//ser save_card true to enable oneclick or 2click
			//$credit_card['save_card'] = true;

			$time = time();
			$waktuExpired = htmlspecialchars(addslashes($this->M->getParameter('@durationExpiredMinutesMitrans')));
			$custom_expiry = array(
				'start_time' => date("Y-m-d H:i:s O", $time),
				'unit' => 'minute',
				'duration'  => number_format($waktuExpired)
			);

			$transaction_data = array(
				'transaction_details' => $transaction_details,
				'item_details'       => $item_details,
				'customer_details'   => $customer_details,
				'credit_card'        => $credit_card,
				'expiry'             => $custom_expiry
			);

			//save header

			$datavoucher = [
				'idVoucherAuto' => $randomID,
				'nama' => $nama,
				'handphone' => $hp,
				'email' => $emailVal,
				'totalVoucher' => $totalVoucher,
				'totalBayar' => $gross,
				'typetransfer' => '',
				'virtualAccount' => '',
				'statusBayar' => 'N',
			];
			$this->db->insert('voucherauto', $datavoucher);

			error_log(json_encode($transaction_data));
			$snapToken = $this->midtrans->getSnapToken($transaction_data);

			error_log($snapToken);
			$dataSuccess = [
				'status' => '200',
				'token' => $snapToken
			];
			echo json_encode($dataSuccess);
		} else {
			$dataError = [
				'status' => '201',
				'value' => $textError
			];
			echo json_encode($dataError);
		}
	}

	public function tokenManual()
	{
		$data = $this->input->get("data");
		$idFoto = $this->input->get("idFoto");
		// Required
		$gross = 0;
		$item_details = [];

		$nama;
		$emailVal;
		$hp;
		$uploadBuktiBayar;
		$totalVoucher = 0;

		$textError = "";
		$cekVc = false;
		$randomID = rand();
		foreach ($data as $value) {
			$gross += $value['voucher'] * $value['jumlah'];
			$nama = $value['nama'];
			$emailVal = $value['email'];
			$hp = $value['handphone'];
			$uploadBuktiBayar = $idFoto . ".png";
			$totalVoucher += $value['jumlah'];

			for ($i = 0; $i < $value['jumlah']; $i++) {
				$nominalVc =  $value['voucher'];
				$queryVC = $this->db->query("SELECT * FROM tbl_vc WHERE nmv ='$nominalVc' AND st_vc=0 LIMIT 1")->row_array();
				if ($queryVC != null) {
					$dataVC = [
						'idVoucherManual' => $randomID,
						'nominalVoucher' => $nominalVc,
						'kodeVoucher' => $queryVC['kv'],
						'statusVoucher' => 'N'
					];
					$newIDVC = $queryVC['id_vc'];
					$this->db->query("UPDATE tbl_vc SET st_vc = 1 WHERE id_vc = '$newIDVC'");
					$this->db->insert('vouchermanualitem', $dataVC);
				} else {
					$textError = $textError . " Voucher " . $value['voucher'] . " Belum Tersedia,";
					$cekVc = true;
				}
			}
		}
		//for admin
		if (!$cekVc) {

			$datavoucher = [
				'idVoucherManual' => $randomID,
				'nama' => $nama,
				'handphone' => $hp,
				'email' => $emailVal,
				'totalVoucher' => $totalVoucher,
				'totalBayar' => $gross,
				'typetransfer' => 'Transfer',
				'uploadBuktiBayar' => $uploadBuktiBayar,
				'statusBayar' => 'N',
			];
			$this->db->insert('vouchermanual', $datavoucher);

			$dataSuccess = [
				'status' => '200',
				'value' => 'Pembelian Berhasil Silahkan Hubungi '
			];
			echo json_encode($dataSuccess);
		} else {
			$dataError = [
				'status' => '201',
				'value' => $textError
			];
			echo json_encode($dataError);
		}
	}

	public function finish()
	{
		$result = json_decode($this->input->post('result_data'));
		echo 'RESULT <br><pre>';
		var_dump($result);
		echo '</pre>';
	}

	public function updateVirtualAccount()
	{
		$idVoucherAuto = $this->input->get('id');
		$type = $this->input->get('type');
		$va = $this->input->get('va');
		$idt = $this->input->get('idt');

		$this->db->query("UPDATE voucherauto SET typetransfer = '$type', virtualAccount = '$va',statusBayar='H', transaction_id = '$idt' WHERE idVoucherAuto = '$idVoucherAuto'");
		echo "virtual = " . $va;
	}

	public function updateTransferDone()
	{
		$idVoucherAuto = $this->input->get('id');
		$type = $this->input->get('type');
		$va = $this->input->get('va');
		$idt = $this->input->get('idt');

		$this->db->query("UPDATE voucherauto SET typetransfer = '$type', virtualAccount = '$va',statusBayar='D', transaction_id = '$idt' WHERE idVoucherAuto = '$idVoucherAuto'");
		echo "virtual = " . $va;
	}

	public function searchDataSellingVoucher()
	{
		$valueSearch = $this->input->get('valueSearch');
		$result = array();
		$query = $this->db->query("SELECT * FROM voucherauto WHERE  (nama LIKE '%$valueSearch%' OR handphone = '$valueSearch') ORDER BY dateCreatedAdd DESC")->result_array();
		foreach ($query as $key => $value) {
			if ($value['statusBayar'] === "D") {
				$qItem = $this->db->get_where('voucherautoitem', ['idVoucherAuto' => $value['idVoucherAuto']])->result_array();
			} else {
				$qItem = [];
			}
			$object = ['voucherauto' => $query[$key], 'voucherautoitem' => $qItem];
			array_push($result, $object);
		}
		echo json_encode($result);
	}

	public function searchDataSellingVoucherManual()
	{
		$valueSearch = $this->input->get('valueSearch');
		$result = array();
		$query = $this->db->query("SELECT * FROM vouchermanual WHERE  (nama LIKE '%$valueSearch%' OR handphone = '$valueSearch') ORDER BY dateCreatedAdd DESC")->result_array();
		foreach ($query as $key => $value) {
			if ($value['statusBayar'] === "D") {
				$qItem = $this->db->get_where('vouchermanualitem', ['idVoucherManual' => $value['idVoucherManual']])->result_array();
			} else {
				$qItem = [];
			}
			$object = ['vouchermanual' => $query[$key], 'vouchermanualitem' => $qItem];
			array_push($result, $object);
		}
		echo json_encode($result);
	}

	public function uploadPhoto($id)
	{
		$config['upload_path'] = './assets/img/sellingVoucher';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['file_name'] = $id . ".png";;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file')) {
			$status = "error";
			$msg = $this->upload->display_errors();
		} else {
			$dataupload = $this->upload->data();
			$status = "success";
			$msg = $dataupload['file_name'] . " berhasil diupload";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
	}
}
