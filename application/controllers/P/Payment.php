<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

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
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods:GET,OPTIONS");
		parent::__construct();
		$this->load->model('Mbg', 'M');
		$server_key = htmlspecialchars(addslashes($this->M->getParameter('@serverKeyMitrans')));
		$isProduction = $this->M->getParameter('@isProductionMitrans') == 'Y' ? true : false;
		$params = array('server_key' => $server_key, 'production' => $isProduction);
		$this->load->library('midtrans');
		$this->load->library('service');
		$this->load->library('Pdf');
		$this->midtrans->config($params);
		$this->load->helper('url');
	}

	public function virtual_account($id_virtual_account)
	{
		$get_payment = $this->M->getWhere('order_payment',['id_virtual_account'=>trim($id_virtual_account)]);
		if($get_payment){
			$get_booking = $this->M->getWhere('order_booking',['id_order_booking'=>trim($get_payment['id_order_booking'])]);
			$get_master_kelas = $this->M->get_name_kelas_list($get_booking['list_kelas']);
			$get_user = $this->M->getWhere('user',['id_user'=>trim($get_booking['id_user'])]);;
			$data['id_virtual_account'] = $id_virtual_account;
			$data['get_payment'] = $get_payment;
			$data['get_master_kelas'] = $get_master_kelas;
			$data['get_user'] = $get_user;
			$data['get_booking'] = $get_booking;
			$data['charge_admin'] = (int)$this->M->getParameter('@chargeAdminPayment');
			$data['clientKeyMitrans'] = $this->M->getParameter('@clientKeyMitrans');
			$data['url_mitrans'] = $this->M->getParameter('@isProductionMitrans') === 'Y' ? $this->M->getParameter('@urlProductionMitrans') : $this->M->getParameter('@urlSandboxMitrans');
			$this->load->view('p/admin/virtual_payment',$data);
		}else{
			echo "Order Telah dibayar !";
		}
	}

	public function token()
    {
		$data = $this->input->get("value");
		// Required

		$this->saveRequestDB($data);

		$transaction_details = array(
		  'order_id' => $data['order_id'],
		  'gross_amount' => $data['gross_amount'], // no decimal allowed for creditcard
		);
		$nameDet = "";
		if(strlen($data['name']) > 20){
			$nameDet = substr($data['name'], 20);
		}else{
			$nameDet = $data['name'];
		}

		// Optional
		$item1_details = array(
		  'id' => $data['order_id'],
		  'price' => $data['gross_amount'],
		  'quantity' => 1,
		  'name' => $nameDet
		);

		// Optional
		$item_details = array ($item1_details);

		// Optional
		$billing_address = array(
		  'first_name'    => "Andri",
		  'last_name'     => "Litani",
		  'address'       => "Kelas : ".$nameDet,
		  'city'          => "",
		  'postal_code'   => "",
		  'phone'         => "",
		  'country_code'  => ''
		);

		// Optional
		$shipping_address = array(
		  'first_name'    => "Peradi",
		  'last_name'     => "Nusantara",
		  'address'       => "Cluster Angelonia Blok A1 No B6",
		  'city'          => "Medang Pagedangan Tangerang",
		  'postal_code'   => "",
		  'phone'         => $this->M->getParameter('@companyPhoneNumber'),
		  'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
		  'first_name'    => $data['nama_lengkap'],
		  'last_name'     => "",
		  'email'         => "peradi@gmail.com",
		  'phone'         => $data['handphone'],
		  'billing_address'  => $billing_address,
		  'shipping_address' => $shipping_address
		);

		$time = time();
        $waktuExpired = (int)$this->M->getParameter('@timeExpiredMitrans'); //get from parameter

        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute', 
            'duration'  => number_format($waktuExpired)
        );

		// Fill transaction details
		$transaction = array(
		  'transaction_details' => $transaction_details,
		  'customer_details' => $customer_details,
		  'item_details' => $item_details
		  // 'expiry' => $custom_expiry
		);
		//error_log(json_encode($transaction));
		$snapToken = $this->midtrans->getSnapToken($transaction);
		error_log($snapToken);
		error_log($snapToken);
		$dataSuccess = [
			'status' => '200',
			'token' => $snapToken,
			'data' =>$data
		];
		echo json_encode($dataSuccess);
    }

    public function finish()
    {
    	$result = json_decode($this->input->post('result_data'));
    	echo 'RESULT <br><pre>';
    	var_dump($result);
    	echo '</pre>' ;

    }

    public function saveRequestDB($data)
    {	
    	$data_send = [
    		'gross_amount' => $data['gross_amount'],
    		'order_id' => $data['order_id']
    	];
    	return $this->M->add_to_db('request_payment', $data_send);
    }

    public function updateVirtualAccount(){
    	$idOrderVADB = $this->input->get('idOrderVADB');
    	$result = $this->input->get('result');
    	$id_order = $this->input->get('id_order');

    	$data_update = [
    		'payment_type' => $result['payment_type'],
    		'status_code' => $result['status_code'],
    		'status_message' => $result['status_message'],
    		'transaction_id' => $result['transaction_id'],
    		'transaction_status' => $result['transaction_status'],
    		'transaction_time' => $result['transaction_time'],
    		'va_nunmbers' => json_encode([
			        "bank" => $result['va_numbers'][0]['bank'],
			        "va_number" => $result['va_numbers'][0]['va_number'],
			]),
    	];

    	$update = $this->M->update_to_db('request_payment',$data_update,'order_id',$idOrderVADB);
		$updateOB = $this->M->update_to_db('order_payment',['status_payment' => 'D'],'id_virtual_account',$idOrderVADB);    	
    	if($update && $updateOB){
    		if($this->M->getParameter('@sendNotifDonePayment') == 'Y'){
    			//send notif done payment to wa
    			$orderPayment = $this->M->getWhere('order_payment',['id_virtual_account'=>trim($idOrderVADB)]);
					$orderBook = $this->M->getWhere('order_booking',['id_order_booking'=>trim($id_order)]);
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
							'nominal_payment' => number_format(trim($orderPayment['nominal_payment']),2),
							'date_payment' => trim($orderPayment['date_payment']),
							'url_login' => trim(base_url('P/Admin')),
							'link_wa'=> trim($getListKelas['link_group_wa']),
						];
						$this->service->send_whatsapp($data_send_notif, 'done_payment');
					}
    		}
    		$getCount = $this->M->get_count_order_payment_status($id_order);
    		if(count($getCount) == 1 && $getCount[0]['status_payment'] == "D"){
    			if($this->M->getParameter('@sendNotifCompletePayment') == 'Y'){
	    			$data_send_notif = [
						'handphone' => trim($user['handphone']),
						'namalengkap' => trim($user['nama_lengkap']),
						'namaKelas' => trim($getListKelas['nama_kelas']),
						'url_invoice' => trim(base_url('P/Payment/createInvoice/'.$id_order))
					];
					$this->service->send_whatsapp($data_send_notif, 'complete_payment');
				}
    			$this->M->update_to_db('order_booking',['status_order' => 'D'],'id_order_booking',$id_order);   
    		}
    		return ['status_code' => 200];
    	}else{
    		return ['status_code' => 400];
    	}
    }

    public function getDetailTransaction($order_id)
    {
    	try {
			$result = $this->midtrans->status($order_id);
		
			if($result){
				$transaction = new stdClass();
				$transaction->status_code = $result->status_code;
				$transaction->transaction_id = $result->transaction_id;
				$transaction->transaction_id_qrcode = $result->transaction_id;
				$transaction->gross_amount = $result->gross_amount;
				$transaction->currency = $result->currency;
				$transaction->order_id = $result->order_id;
				$transaction->payment_type = $result->payment_type;
				$transaction->signature_key = $result->signature_key;
				$transaction->transaction_status = $result->transaction_status;
				$transaction->fraud_status = $result->fraud_status;
				$transaction->status_message = $result->status_message;
				$transaction->merchant_id = $result->merchant_id;

				$bank = "";
				$va_number = "";

				$amount = "";
				$paid_at = "";

				$langkahPembayaran = "";
				if(isset($result->va_numbers) && is_array($result->va_numbers) && !empty($result->va_numbers)){
					$bank = $result->va_numbers[0]->bank;
					$va_number = $result->va_numbers[0]->va_number;
					if($result->va_numbers[0]->bank == 'bni'){
						$text = "<h3>---<b>ATM BNI</b>---</h3>
                             <ul>1. Pada menu utama, pilih Menu Lainnya.</ul>
                             <ul>2. Pilih Transfer</b>.</ul>
                             <ul>3. Pilih Rekening Tabungan.</ul>
                             <ul>4. Pilih Ke Rekening BNI.</ul>
                             <ul>5. Masukkan Nomor Rekening Pembayaran Anda (.......) lalu tekan Benar.</ul>
                             <ul>6. Masukkan jumlah tagihan yang akan Anda bayar secara lengkap. Pembayaran dengan jumlah tidak sesuai akan otomatis ditolak.</ul>
                             <ul>7. Pada halaman konfirmasi transfer akan muncul jumlah yang dibayarkan, nomor rekening dan nama Merchant. Jika informasi telah sesuai tekan Ya.</ul>";
                        $langkahPembayaran = $text;
					}
				}

				if($result->payment_type == 'bank_transfer') {

				}

				if(isset($result->biller_code) && !empty($result->biller_code)){
					$bank = "Mandiri";
					$va_number = $result->bill_key;
					$amount = $result->gross_amount;

					$text = "<h3>---<b>Livin By Mandiri</b>---</h3>
                             <ul>1. Pilih <b>bayar</b> pada menu utama.</ul>
                             <ul>2. Pilih <b>Ecommerce</b>.</ul>
                             <ul>3. Pilih <b>Midtrans</b> di bagian penyedia jasa.</ul>
                             <ul>4. Masukkan nomor <b>virtual account</b> pada bagian <b>kode bayar</b>.</ul>
                             <ul>5. Klik <b>lanjutkan</b> untuk konfirmasi.</ul>
                             <ul>6. Pembayaran selesai.</ul>

                             <h3>---<b>ATM Mandiri</b>---</h3>
                             <ul>1. Pilih <b>bayar/beli</b> pada menu utama.</ul>
                             <ul>2. Pilih <b>lainnya</b>.</ul>
                             <ul>3. Pilih <b>multi payment</b>.</ul>
                             <ul>4. Masukkan kode perusahaan Midtrans <b>70012</b>.</ul>
                             <ul>5. Masukkan <b>kode pembayaran</b>, lalu <b>konfirmasi</b>.</ul>
                             <ul>6. Pembayaran selesai.</ul>

                             <h3>---<b>Mandiri Internet Banking</b>---</h3>
                             <ul>1. Pilih <b>bayar</b> pada menu utama.</ul>
                             <ul>2. Pilih <b>multi payment</b>.</ul>
                             <ul>3. Pilih <b>dari rekening</b>.</ul>
                             <ul>4. Pilih <b>Midtrans</b> di bagian <b>penyedia jasa</b>.</ul>
                             <ul>5. Masukkan <b>kode pembayaran</b>, lalu <b>konfirmasi</b>.</ul>
                             <ul>6. Pembayaran selesai.</ul>

                             ";
                    $langkahPembayaran = $text;
				}

				if($result->payment_type == 'qris') {
					$amount = $result->gross_amount;
					$bank = "QRIS";
					$va_number = "Y";
					$text = "<h3>---<b>Aplikasi Scan QR</b>---</h3>
                             <ul>1. Buka <b>aplikasi Gojek, GoPay atau e-wallet lain</b> Anda.</ul>
                             <ul>2. <b>Download</b> atau <b>pindai QRIS</b> pada layar.</ul>
                             <ul>3. Konfirmasi pembayaran pada aplikasi.</ul>
                             <ul>4. MPembayaran berhasil.</ul>";
                    $langkahPembayaran = $text;
				}	

				$transaction->va_numbers = array(
				    (object) array(
				        'bank' => $bank,
				        'va_number' => $va_number
				    )
				);


				if(isset($result->payment_amounts) && is_array($result->payment_amounts) && !empty($result->payment_amounts)){
					$amount = $result->payment_amounts[0]->amount;
					$paid_at = $result->payment_amounts[0]->paid_at;
				}
				$transaction->payment_amounts = array(
				    (object) array(
				        'amount' => $amount,
				        'paid_at' => $paid_at
				    )
				);
				$transaction->transaction_time = $result->transaction_time;
				$transaction->expiry_time = $result->expiry_time;
				$transaction->langkahPembayaran = $langkahPembayaran;
				// Convert the object to JSON
				$json_data = json_encode($transaction, JSON_PRETTY_PRINT);

				// Display the JSON
				$this->load->view('p/admin/detail_transaction', array('transaction' => $transaction));
			}else{
				echo "generate payment";
			}
		} catch (Exception $e) {
            show_error('An error occurred while fetching the transaction details.', 500); // Return Internal Server Error
        }
    }

    public function createInvoice($id_order_booking)
	{
		$image1 = "./assets/p/invoice/bg.png";
		$orderB = $this->M->getWhere('order_booking',['id_order_booking'=>trim($id_order_booking)]);
		$user = $this->M->getWhere('user',['id_user'=>trim($orderB['id_user'])]);
		$mKelas = $this->M->get_name_kelas_list($orderB['list_kelas']);
		$payment = $this->M->getAllMasterWhereOneCondition('order_payment','id_order_booking',$id_order_booking);

		$invoiceData = array(
		    'customer_name' => $user['nama_lengkap'],
		    'customer_phone' => $user['handphone'],
		    'invoice_number' => 'INV-WS-00'.$id_order_booking,
		    'invoice_date' => $orderB['time_history'],
		    'due_date' => $orderB['time_history'],
		    'items' => array(
		        array('description' => 'Item 1', 'quantity' => 2, 'unit_price' => 50.00),
		        array('description' => 'Item 2', 'quantity' => 1, 'unit_price' => 75.00),
		        array('description' => 'Item 3', 'quantity' => 3, 'unit_price' => 20.00)
		    )
		);

	    $pdf = new FPDF('P', 'mm', 'A4'); // Portrait, millimeters, A4 paper size
	    $pdf->AddPage();
	    $pdf->Image($image1,0,0,210,300);
	    // Set Title
	    $pdf->SetFont('Arial', 'B', 16);
	    $pdf->Cell(0, 10, 'KWITANSI PEMBAYARAN', 0, 1, 'C');

	    // Add some space
	    $pdf->Ln(10);

	    // Set Company Information
	    $pdf->SetFont('Arial', '', 12);
	    $pdf->Cell(0, 5, $this->M->getParameter('@companyName'), 0, 1);
	    $pdf->Cell(0, 5, $this->M->getParameter('@companyAddress1'), 0, 1);
	    $pdf->Cell(0, 5, $this->M->getParameter('@companyAddress2'), 0, 1);
	    $pdf->Cell(0, 5, 'Phone: '.$this->M->getParameter('@companyPhoneNumber'), 0, 1);
	    $pdf->Cell(0, 5, 'Email: '.$this->M->getParameter('@companyEmail'), 0, 1);

	    // Add some space
	    $pdf->Ln(10);

	    // Customer Information
	    $pdf->SetFont('Arial', 'B', 12);
	    $pdf->Cell(0, 5, 'Bill To:', 0, 1);
	    $pdf->SetFont('Arial', '', 12);
	    $pdf->Cell(0, 5, $invoiceData['customer_name'], 0, 1);
	    $pdf->Cell(0, 5, $invoiceData['customer_phone'], 0, 1);

	    // Invoice Information
	    $pdf->Ln(10);
	    $pdf->SetFont('Arial', '', 12);
	    $pdf->Cell(40, 5, 'Invoice Number:', 0, 0);
	    $pdf->Cell(40, 5, $invoiceData['invoice_number'], 0, 1);
	    $pdf->Cell(40, 5, 'Invoice Date:', 0, 0);
	    $pdf->Cell(40, 5, $invoiceData['invoice_date'], 0, 1);
	    $pdf->Cell(40, 5, 'Due Date:', 0, 0);
	    $pdf->Cell(40, 5, $invoiceData['due_date'], 0, 1);

	    // Add some space
	    $pdf->Ln(10);

	    // Table header
	    $pdf->SetFont('Arial', 'B', 12);
	    $pdf->Cell(30, 10, 'Payment Date', 1);
	    $pdf->Cell(110, 10, 'Product', 1);
	    $pdf->Cell(22, 10, 'Sequence', 1);
	    $pdf->Cell(30, 10, 'Unit Price', 1, 0, 'C');
	    $pdf->Ln();

	    // Table body
	    $pdf->SetFont('Arial', '', 12);
	    $totalAmount = 0;
	    foreach ($payment as $key => $value) {
	    	$pdf->Cell(30, 10, $value['date_payment'], 1);
	        $pdf->Cell(110, 10, $mKelas['nama_kelas'], 1);
	        $pdf->Cell(22, 10, $value['sequence_payment'], 1, 0, 'C');
	        $itemTotal = 1 * $value['nominal_payment'];
	        $pdf->Cell(30, 10, number_format($itemTotal, 2), 1, 0, 'R');
	        $pdf->Ln();
	        $totalAmount += $itemTotal;
	    }
	    // foreach ($invoiceData['items'] as $index => $item) {
	    //     $pdf->Cell(10, 10, $index + 1, 1);
	    //     $pdf->Cell(80, 10, $item['description'], 1);
	    //     $pdf->Cell(30, 10, $item['quantity'], 1, 0, 'C');
	    //     $pdf->Cell(30, 10, number_format($item['unit_price'], 2), 1, 0, 'C');
	    //     $itemTotal = $item['quantity'] * $item['unit_price'];
	    //     $pdf->Cell(30, 10, number_format($itemTotal, 2), 1, 0, 'R');
	    //     $pdf->Ln();
	    //     $totalAmount += $itemTotal;
	    // }

	    // Total Amount
	    $pdf->Ln(5);
	    $pdf->SetFont('Arial', 'B', 12);
	    $pdf->Cell(120, 10, '', 0, 0);
	    $pdf->Cell(30, 10, 'Total:', 0, 0, 'R');
	    $pdf->Cell(30, 10, number_format($totalAmount, 2), 0, 1, 'R');

	    $image1 = "./assets/p/img/cap-lunas.jpg";
		$pdf->Image($image1,80,50,40,40);//margin left - margin top - size lebar, size tinggi
	    // Save the PDF to a file or output to the browser
	    $pdf->Output('I', 'invoice.pdf'); // 'I' for browser output, 'F' for saving to file
	}

	public function createInvoiceNew()
	{
		// Create instance of FPDF
		$pdf = new FPDF();
		$pdf->AddPage();

		// Set font
		$pdf->SetFont('Arial', 'B', 12);

		// Add a cell for the title
		$pdf->Cell(190, 10, 'INVOICE', 0, 1, 'C');

		// Line break
		$pdf->Ln(10);

		// Invoice details
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(100, 6, 'No: 0004|08|B.PKPA,UPA', 0, 1);
		$pdf->Cell(100, 6, 'Date: 16 August 2024', 0, 1);

		// Line break
		$pdf->Ln(10);

		// Client details
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(100, 6, 'Bill To:', 0, 1);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(100, 6, 'Arif Purnama Hasyim', 0, 1);
		$pdf->Cell(100, 6, 'Telp: +62 812-8226-4682', 0, 1);

		// Line break
		$pdf->Ln(10);

		// Table header
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(100, 6, 'Description', 1);
		$pdf->Cell(30, 6, 'Qty', 1);
		$pdf->Cell(30, 6, 'Price', 1);
		$pdf->Cell(30, 6, 'Total', 1);
		$pdf->Ln();

		// Table content
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(100, 6, 'Pendidikan PKPA,UPA', 1);
		$pdf->Cell(30, 6, '1', 1, 0, 'C');
		$pdf->Cell(30, 6, 'Rp 6.000.000', 1, 0, 'R');
		$pdf->Cell(30, 6, 'Rp 6.000.000', 1, 0, 'R');
		$pdf->Ln();

		// Subtotal, Tax, and Total
		$pdf->Ln(10);
		$pdf->Cell(160, 6, 'SUBTOTAL', 0, 0, 'R');
		$pdf->Cell(30, 6, 'Rp 6.000.000', 1, 1, 'R');

		$pdf->Cell(160, 6, 'TAX RATE (10%)', 0, 0, 'R');
		$pdf->Cell(30, 6, 'Rp 600.000', 1, 1, 'R');

		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(160, 6, 'TOTAL', 0, 0, 'R');
		$pdf->Cell(30, 6, 'Rp 6.600.000', 1, 1, 'R');

		// Line break
		$pdf->Ln(10);

		// Terms & Conditions
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(100, 6, 'TERM & CONDITIONS', 0, 1);
		$pdf->SetFont('Arial', '', 10);
		$pdf->MultiCell(0, 6, "For description your term and conditions about invoice", 0, 1);

		// Payment Info
		$pdf->Ln(10);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(100, 6, 'PAYMENT INFO', 0, 1);
		$pdf->SetFont('Arial', '', 10);
		$pdf->MultiCell(0, 6, "For description your payment method and more info for invoice", 0, 1);

		// Signature
		$pdf->Ln(20);
		$pdf->Cell(100, 6, 'Signature', 0, 1);

		// Output the PDF
		$pdf->Output('I', 'Invoice.pdf');

	}

	public function getDetailQRCODE($idUser, $idOrder, $idKelas)
	{
		// code...
		$getOB = $this->M->getDetailQRCode($idUser,$idOrder);
		$getMK = $this->M->getWhere('master_kelas',['id_master_kelas'=>trim($idKelas)]);
		if($getOB && $getMK){
			echo "----------------------------------------------</br>";
			echo "---> Data Order #OB-".$getOB['id_order_booking'].'-WS</br>';
			echo "----------------------------------------------</br>";
			echo "---> Waktu Order : ".$getOB['time_history'].'</br>';
			echo "---> Nama : ".$getOB['nama_lengkap'].'</br>';
			echo "---> Email : ".$getOB['email'].'</br>';
			echo "---> Handphone : ".$getOB['handphone'].'</br>';
			echo "---> Nama Kelas : <b>".$getMK['nama_kelas'].'</b></br>';
			echo "---> Status Order : ".($getOB['status_order'] == 'D' ? 'Sudah Lunas' : 'Belum Lunas').'</br>';
			echo "---> Status Sertifikat : ".($getOB['status_certificate'] == 'A' ? 'Telah Terbit' : 'Belum Terbit').'</br>';
			echo "---> Nomor KTA : <b>".$getOB['number_certificate'].'</b></br>';
			echo "----------------------------------------------";
		}else{
			echo "Data Tidak Di Temukan";
		}

	}
	
	public function generateCertificate($idUser, $idOrder)
	{
		$data = $this->M->get_detail_certificate($idUser, $idOrder);
		$pdf = new FPDF('l', 'mm', 'A4', true, 'UTF-8', false);
		$ttdCap = "./assets/p/img/ttd.png";
		$titleName = "";
		if($data){
			$titleName = $data[0]['nama_lengkap'];
			foreach ($data as $key => $value) {
				
				if($value['prefix_certificate'] == "PKPA"){
					error_reporting(0); 
			        // Load the Pdf library
			        $image1 = "./assets/p/img/".$value['foto_sertifikat'];
			        $imgQRCode = "./assets/p/qrcode/".$value['qr_code_name'];
			        // Create a new PDF instance
			        $pdf->AddPage();
			        $pdf->Image($image1,0,0,310,210);//margin left - margin top - size lebar, size tinggi

			        //FOR number
			        $currentMonth = date('n'); // Get the current month as a number (1-12)
					$romanMonth = $this->getRomanMonth($currentMonth);

					//jadwal
					$pdf->SetXY(139,124.5); 
			        $pdf->SetFont('Arial', 'B', 12);
		    		$pdf->Cell(100, 0, $value['jadwal_pelatihan'], 0, 0, 'L');

		    		//number
			        $numberCer = $value['number_certificate'].'/'.$value['prefix_certificate'].'/PERADI-NUSANTARA/'.$romanMonth.'/'.date('Y');
			        $pdf->SetXY(173,36.4); 
			        $pdf->SetFont('Arial', 'B', 12);
		    		$pdf->Cell(100, 0, $numberCer, 0, 0, 'L');

			        // Nama
			        $pdf->SetXY(10,15); 
			        $pdf->SetFont('Arial', 'B', 36);
			        $pdf->Cell(290, 150, $value['nama_lengkap'], 0, 1, 'C'); //margin left
			      
			        // set tanggal cetak
			        $pdf->SetXY(138,143); 
			        $pdf->SetFont('Arial', 'B', 14);
		    		$pdf->Cell(100, 0, $this->getDateTTD($value['time_history']), 0, 0, 'L');
		    		$pdf->Image($imgQRCode,65,150,30,30); // margin left - margin top - size lebar, size tinggi
		    		// $pdf->Image($ttdCap,125,158,70,40);
		    		$titleName = $titleName."_PKPA";
	    		}else if($value['prefix_certificate'] == "PARALEGAL"){
	    			error_reporting(0); 
			        // Load the Pdf library
			        $image1 = "./assets/p/img/".$value['foto_sertifikat'];
			        $imgQRCode = "./assets/p/qrcode/".$value['qr_code_name'];
			        // Create a new PDF instance
			        $pdf->AddPage();
			        $pdf->Image($image1,0,0,310,210);//margin left - margin top - size lebar, size tinggi

			        //FOR number
			        $currentMonth = date('n'); // Get the current month as a number (1-12)
					$romanMonth = $this->getRomanMonth($currentMonth);
	    			//jadwal
					$pdf->SetXY(145,129); 
			        $pdf->SetFont('Arial', 'B', 13);
		    		$pdf->Cell(100, 0, $value['jadwal_pelatihan'], 0, 0, 'L');

		    		//number
			        $numberCer = $value['number_certificate'].'/'.$value['prefix_certificate'].'/PERADI-NUSANTARA/'.$romanMonth.'/'.date('Y');
			        $pdf->SetXY(173,35); 
			        $pdf->SetFont('Arial', 'B', 12);
		    		$pdf->Cell(100, 0, $numberCer, 0, 0, 'L');
			        // Set font
			        $pdf->SetXY(10,15); 
			        $pdf->SetFont('Arial', 'B', 36);
			        $pdf->Cell(290, 150, $value['nama_lengkap'], 0, 1, 'C'); //margin left

			      
			        // set tanggal cetak
			        $pdf->SetXY(144,142); 
			        $pdf->SetFont('Arial', 'B', 15);
		    		$pdf->Cell(100, 0, $this->getDateTTD($value['time_history']), 0, 0, 'L');
		    		$pdf->Image($imgQRCode,40,150,30,30); // margin left - margin top - size lebar, size tinggi
		    		$pdf->Image($ttdCap,125,155,50,20);
		    		$titleName = $titleName."_PARALEGAL";
	    		}else if($value['prefix_certificate'] == "SUPA"){
	    			error_reporting(0); 
			        // Load the Pdf library
			        $image1 = "./assets/p/img/".$value['foto_sertifikat'];
			        $imgQRCode = "./assets/p/qrcode/".$value['qr_code_name'];
			        // Create a new PDF instance
			        $pdf->AddPage();
			        $pdf->Image($image1,0,0,310,210);//margin left - margin top - size lebar, size tinggi

			        //FOR number
			        $currentMonth = date('n'); // Get the current month as a number (1-12)
					$romanMonth = $this->getRomanMonth($currentMonth);
	    			//jadwal
					$pdf->SetXY(172,112.5); 
			        $pdf->SetFont('Arial', 'B', 15);
		    		$pdf->Cell(100, 0, $value['jadwal_pelatihan'], 0, 0, 'L');

		    		//number

			        $numberCer = $value['number_certificate'].'/'.$value['prefix_certificate'].'/PERADI-NUSANTARA/'.$romanMonth.'/'.date('Y');
			        $pdf->SetXY(175,35); 
			        $pdf->SetFont('Arial', 'B', 12);
		    		$pdf->Cell(100, 0, $numberCer, 0, 0, 'L');
			        // Set font
			        $pdf->SetXY(10,15); 
			        $pdf->SetFont('Arial', 'B', 36);
			        $pdf->Cell(290, 150, $value['nama_lengkap'], 0, 1, 'C'); //margin left

			      
			        // set tanggal cetak
			        $pdf->SetXY(138,153); 
			        $pdf->SetFont('Arial', 'B', 15);
		    		$pdf->Cell(100, 0, $this->getDateTTD($value['time_history']), 0, 0, 'L');
		    		$pdf->Image($imgQRCode,65,155,30,30); // margin left - margin top - size lebar, size tinggi
		    		// $pdf->Image($ttdCap,125,170,50,25);
		    		$titleName = $titleName."_UPA";
	    		}else if($value['prefix_certificate'] == "BREVET"){
	    			error_reporting(0); 
			        // Load the Pdf library
			        $image1 = "./assets/p/img/".$value['foto_sertifikat'];
			        $imgQRCode = "./assets/p/qrcode/".$value['qr_code_name'];
			        // Create a new PDF instance
			        $pdf->AddPage();
			        $pdf->Image($image1,0,0,310,210);//margin left - margin top - size lebar, size tinggi

			        //FOR number
			        $currentMonth = date('n'); // Get the current month as a number (1-12)
					$romanMonth = $this->getRomanMonth($currentMonth);
					//jadwal
					$pdf->SetXY(152,159.5); 
			        $pdf->SetFont('Arial', 'B', 15);
		    		// $pdf->Cell(100, 0, $value['jadwal_pelatihan'], 0, 0, 'L');
		    		$prefix = 'BR-';
			        $numberCer = $prefix.$value['number_certificate'].'/SERTIFIKAT/PERADIPAJAKNUSANTARA/'.$romanMonth.'/'.date('Y');
			        $pdf->SetXY(96,61); 
			        $pdf->SetFont('Arial', 'B', 14);
		    		$pdf->Cell(100, 0, $numberCer, 0, 0, 'L');
			        // Set font
			        $pdf->SetXY(10,13); 
			        $pdf->SetFont('Arial', 'B', 36);
			        $pdf->Cell(290, 150, $value['nama_lengkap'], 0, 1, 'C'); //margin left

			      
			        // set tanggal cetak
			        $pdf->SetXY(138,161); 
			        $pdf->SetFont('Arial', 'B', 15);
		    		$pdf->Cell(100, 0, $this->getDateTTD($value['time_history']), 0, 0, 'L');
		    		$pdf->Image($imgQRCode,40,150,30,30); // margin left - margin top - size lebar, size tinggi
		    		// $pdf->Image($ttdCap,135,170,50,25);
		    		$titleName = $titleName."_BREVET";
	    		}else if($value['prefix_certificate'] == "CPT"){
	    			error_reporting(0); 
			        // Load the Pdf library
			        $image1 = "./assets/p/img/".$value['foto_sertifikat'];
			        $imgQRCode = "./assets/p/qrcode/".$value['qr_code_name'];
			        // Create a new PDF instance
			        $pdf->AddPage();
			        $pdf->Image($image1,0,0,310,210);//margin left - margin top - size lebar, size tinggi

			        //FOR number
			        $currentMonth = date('n'); // Get the current month as a number (1-12)
					$romanMonth = $this->getRomanMonth($currentMonth);
			        $numberCer = $prefix.$value['number_certificate'].'/sertifikat-KHP/peradipajaknusantara/'.$romanMonth.'/'.date('Y');
			        $pdf->SetXY(87,63.5); 
			        $pdf->SetFont('Arial', 'B', 15);
		    		$pdf->Cell(100, 0, $numberCer, 0, 0, 'L');
			        // Set font
			        $pdf->SetXY(10,24); 
			        $pdf->SetFont('Arial', 'B', 36);
			        $pdf->Cell(290, 150, $value['nama_lengkap'], 0, 1, 'C'); //margin left

			      
			        // set tanggal cetak
			        $pdf->SetXY(137,141.5); 
			        $pdf->SetFont('Arial', 'B', 15);
		    		$pdf->Cell(100, 0, $this->getDateTTD($value['time_history']), 0, 0, 'L');
		    		$pdf->Image($imgQRCode,60,140,30,30); // margin left - margin top - size lebar, size tinggi
		    		// $pdf->Image($ttdCap,135,150,50,25);
		    		$titleName = $titleName."_CPT";
	    		}
	    		// else{
	    		// 	$pdf->AddPage();
	    		// 	// Set font
			    //     $pdf->SetXY(10,24); 
			    //     $pdf->SetFont('Arial', 'B', 25);
			    //     $pdf->Cell(290, 150, "Sertifikat Belum Tersedia, Silahkan Hubungi Admin", 0, 1, 'C'); //margin left
	    		// }
		        // Specify the folder where you want to save the file
		        $outputDir = './assets/p/document/';
		        // Set the file name
		        $fileName = $value['nama_lengkap']."-".$value['nama_kelas'].'.pdf';
		        // Output the PDF to the browser
		        // $pdf->Output('F', $outputDir.$fileName);
		    }
	        //forcedownload
	        $pdf->Output('D', $titleName.".pdf");
	        $pdf->SetTitle($titleName);
	        // $pdf->Output();
	        echo "PDF has been saved to " . $outputDir . $fileName;
    	}
	}

	public function getDateTTD($valueDate)
	{
		$timestamp = strtotime($valueDate);
		$day = date('d', $timestamp);
		$month = date('m', $timestamp);
		$year = date('Y', $timestamp);

		$formattedDate = $day . ' ' . $this->getMonthName($month) . ' ' . $year;

		return $formattedDate;
	}

	public function getMonthName($monthNumber) {
		    $months = [
		        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
		        '04' => 'April', '05' => 'Mei', '06' => 'Juni',
		        '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
		        '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
		    ];

		    return $months[$monthNumber];
		}

	public function getRomanMonth($monthNumber) {
	    $romanMonths = [
	        1 => 'I',
	        2 => 'II',
	        3 => 'III',
	        4 => 'IV',
	        5 => 'V',
	        6 => 'VI',
	        7 => 'VII',
	        8 => 'VIII',
	        9 => 'IX',
	        10 => 'X',
	        11 => 'XI',
	        12 => 'XII'
	    ];

	    return isset($romanMonths[$monthNumber]) ? $romanMonths[$monthNumber] : null;
	}

	public function report_pembayaran()
	{
		$data['list_data'] = $this->M->getAllData('master_kelas');
		$data['list_cart'] = $this->M->show_cart($this->session->userdata('id_user'));
		$data['previous_url'] = $this->input->server('HTTP_REFERER');
		$order_ids = $this->db->get('request_payment')->result_array();
		$transactions = [];
		foreach ($order_ids as $order) {
            try {
            		$res = [];
            		$result = $this->midtrans->status($order['order_id']);
            		$res['transaction_id'] = $result->transaction_id;
            		$res['transaction_time'] = $result->transaction_time;
            		$res['transaction_status'] = $result->transaction_status;
            		$res['payment_type'] = $result->payment_type;
            		$res['gross_amount'] = $result->gross_amount;
            		$transactions[] = $res;
            	} catch (Exception $e) {
                // Log error in case of failure
                log_message('error', 'Failed to fetch transaction for order ID: ' . $order['order_id'] . ' Error: ' . $e->getMessage());
            }
        }
        $data['transactions'] = $transactions;

		$this->load->view('p/temp/header',$data);
		$this->load->view('p/admin/report_pembayaran', $data);
		$this->load->view('p/temp/footer');
	}

}

