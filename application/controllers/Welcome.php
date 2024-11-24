<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	function __construct(){
        parent::__construct();
        $this->load->library('Pdf'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('email');
        //duplicate database
        $this->load->model('Database_model');
    }

    public function replaceHP () {
			$phone = "082280802808";
			$updatedPhone = preg_replace("/^08/", "628", $phone);
			echo $updatedPhone;
			$pesan = "Halo Peradi Nusantara. Saya Ingin Bertanya nih.,";
		if (
            strpos($pesan, 'Halo') !== false || strpos($pesan, 'halo') !== false ||
            strpos($pesan, 'Halo!') !== false || strpos($pesan, 'halo!') !== false ||
            strpos($pesan, 'Halo,') !== false || strpos($pesan, 'halo,') !== false ||
            strpos($pesan, 'hallo,') !== false || strpos($pesan, 'Hallo,') !== false ||
            strpos($pesan, 'hello,') !== false || strpos($pesan, 'Hello,') !== false ||
            strpos($pesan, 'hello!') !== false || strpos($pesan, 'Hello!') !== false ||
            strpos($pesan, 'admin,') !== false || strpos($pesan, 'Admin,') !== false
        ) {
        	echo "masuk";
		}else{
			echo "tidak masuk";
		}

		$countPengirim = count("120363241565334981@g.us");
		echo "countPengirim = " . $countPengirim;
    }
    public function duplicate() {
        
        $original_db = 'db_peradi'; 
        $new_db = 'db_backup_peradi';

        $result = $this->Database_model->duplicate_database($original_db, $new_db);
		echo $result;

    }

    public function sendEmailWithAttachment() {
    	// Email configurations
	    $config['protocol'] = 'smtp';
	    $config['smtp_host'] = 'mail.peradinusantara.org';
	    $config['smtp_port'] = 587;
	    $config['smtp_user'] = 'backupdatabase@peradinusantara.org';
	    $config['smtp_pass'] = 'V8N_;knY~?nZ';
	    $config['mailtype'] = 'html';
	    $config['charset'] = 'utf-8';
	    $config['wordwrap'] = TRUE;
	    $config['newline'] = "\r\n"; // For compatibility

	    $this->email->initialize($config);

	    // Email content
	    $emailAddress = 'wuisanlaw@gmail.com';
	    $this->email->from('backupdatabase@peradinusantara.org', 'Peradi Nusantara');
	    $this->email->to($emailAddress);
	    $this->email->subject('Schedule Backup Database');
	    $this->email->message(date('Y-m-d H:i:s').' - Backup Database ...');

	    // Locate latest .zip file
	    $folderPath = FCPATH . 'backups'; // Use absolute path
	    $zipFiles = glob($folderPath . '/*.zip');
	    if (empty($zipFiles)) {
	        echo "No .zip files found in the folder.";
	        return;
	    }

	    $latestFile = null;
	    $latestModifiedTime = 0;
	    foreach ($zipFiles as $file) {
	        $fileModifiedTime = filemtime($file);
	        if ($fileModifiedTime > $latestModifiedTime) {
	            $latestModifiedTime = $fileModifiedTime;
	            $latestFile = $file;
	        }
	    }

	    // Ensure file exists before attaching
	    if (!file_exists($latestFile)) {
	        echo "File does not exist: $latestFile";
	        return;
	    }

	    $this->email->attach($latestFile);

	    // Send email and check status
	    if ($this->email->send()) {
	        echo 'Email sent successfully with attachment.';
	    } else {
	        echo "Failed to send email. Error details:";
	        echo $this->email->print_debugger(['headers']);
	    }
	}


    public function removeBG()
    {

		// Your Remove.bg API key
		$apiKey = 'kwc1EuNi1vCsbrJWoLKbXtYo';

		// The path to the input image file
		$imagePath = './assets/p/kta/IJ88XtF9W8hrGDWjqr1f.jpg';

		// The URL for Remove.bg API
		$url = 'https://api.remove.bg/v1.0/removebg';

		// Prepare cURL request with image file
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'X-Api-Key: ' . $apiKey,
		));

		// Attach image to request
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
		    'image_file' => new CURLFile($imagePath),
		    'size' => 'auto', // Option: 'auto', 'full' (choose 'auto' for most cases)
		));

		// Execute the request
		$response = curl_exec($ch);

		// Check for errors
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		} else {
		    // Save the result
		    $fileName = 'awiyhehqw12896368'.'.png';
		    $outputFile = './assets/p/kta/'.$fileName;
		    file_put_contents($outputFile, $response);
		    echo "Background removed successfully! Saved as $outputFile";
		}

		// Close the cURL session
		curl_close($ch);

    }

    public function cekNotifPaymentNoSumpah()
    {
    	if('Y' == 'Y' && 
				'5~' != '5~'){
    		//
    		echo "send without sumpah";
    	}else{
    		echo "no send";
    	}
    }
	public function index()
	{
		redirect('P/Auth');
		// $this->load->view('welcome_message');
	}

	public function otp()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.fonnte.com/device',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: V+HAMmJQocwuU_VxQmjk'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
	}

	public function getMilisecondTime()
	{
		//Example usage:
		$year = 2024;
		$month = 8;
		$day = 7;
		$hour = 0;
		$minute = 0;
		$second = 0;

		$timestamp = $this->convertToUnixTimestampGMT7($year, $month, $day, $hour, $minute, $second);
		return $timestamp;

	}

	public function convertToUnixTimestampGMT7($year, $month, $day, $hour = 0, $minute = 0, $second = 0) {
	    // Create a DateTime object for the given date and time in GMT+7
	    $dateTime = new DateTime();
	    $dateTime->setDate($year, $month, $day);
	    $dateTime->setTime($hour, $minute, $second);
	    
	    // Set the timezone to GMT+7
	    $dateTime->setTimezone(new DateTimeZone('Asia/Bangkok')); // GMT+7

	    // Convert to Unix timestamp (seconds since Unix epoch)
	    // This will automatically adjust the timestamp to UTC (GMT+0)
	    return $dateTime->getTimestamp();
	}

	public function template_meesage($code, $params = null)
	{
		switch ($code) {
			case 'new_register':
				return '*--Registrasi Telah Berhasil --*

Halo Ikhlasul Amal,

Silahkan Login 
lakukan pembelian paket belajar
akses link berikut : http://google.com

Terima Kasih

-Peradi Nusantara-';
				break;
			case 'buying_product':
				return '*--Pembelian Berhasil --*

Halo Ikhlasul Amal,

Detail Pembelian:

-Order ID : 123jkh
-Paket : *PKWW*
-Metode Pembayaran : *Cicilan*

admin akan verifikasi data
mohon di tunggu ya 

Terima Kasih

-Peradi Nusantara-';
			case 'verify_data':
				return '*--Verifikasi Data Pembelian Berhasil --*

Halo Ikhlasul Amal,

Total Pembayaran : Rp.2.000.000 

VA : 121434324234
Bank : BCA

Langkah-langkah :
    - Login ke BCA mobile
    - Pilih m-Transfer dan pilih BCA Virtual Account
    - Masukkan nomor BCA Virtual Account dari e-commerce dan klik Send
    - Masukkan nominal
    - Cek detail transaksi, klik OK
    - Masukkan PIN dan transaksi berhasil

*Terima Kasih*

-*Peradi Nusantara*-';
			default:
				# code...
				break;
		}
	}

	public function generateKTAPajak()
    {
    	error_reporting(0); 
        // Load the Pdf library

        // Create a new PDF instance
        $pdf = new FPDF('P', 'mm', [86, 136]); 
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 15);
        $imageKTA = "./assets/p/kta/foto.jpg";
        $image1 = "./assets/p/kta/kta_pajak_1.jpg";
        $pdf->Image($image1,0,0,86,136);//margin left - margin top - size lebar, size tinggi
        $pdf->Image($imageKTA,23,44,40,50);
        $pdf->Ln(84);
        $pdf->SetTextColor(5, 43, 130);
        $pdf->SetDrawColor(255, 255, 255);
        $pdf->Cell(38, 10, 'Ikhlasul Amal, S.Kom', 0, 1); //margin left
        $pdf->AddPage();
        $image1 = "./assets/p/kta/kta_pajak_2.jpg";
        $pdf->Image($image1,0,0,86,136);
        $pdf->Output();
        echo "PDF has been saved to " . $outputDir . $fileName;
    }

    public function createInvoice() {
    // Create a new instance of the FPDF class

    	$invoiceData = array(
		    'customer_name' => 'John Doe',
		    'customer_address' => '123 Main Street, City, Country',
		    'invoice_number' => 'INV-1001',
		    'invoice_date' => '2024-08-09',
		    'due_date' => '2024-09-09',
		    'items' => array(
		        array('description' => 'Item 1', 'quantity' => 2, 'unit_price' => 50.00),
		        array('description' => 'Item 2', 'quantity' => 1, 'unit_price' => 75.00),
		        array('description' => 'Item 3', 'quantity' => 3, 'unit_price' => 20.00)
		    )
		);

	    $pdf = new FPDF('P', 'mm', 'A4'); // Portrait, millimeters, A4 paper size
	    $pdf->AddPage();

	    // Set Title
	    $pdf->SetFont('Arial', 'B', 16);
	    $pdf->Cell(0, 10, 'INVOICE', 0, 1, 'C');

	    // Add some space
	    $pdf->Ln(10);

	    // Set Company Information
	    $pdf->SetFont('Arial', '', 12);
	    $pdf->Cell(0, 5, 'Your Company Name', 0, 1);
	    $pdf->Cell(0, 5, 'Address Line 1', 0, 1);
	    $pdf->Cell(0, 5, 'Address Line 2', 0, 1);
	    $pdf->Cell(0, 5, 'Phone: 123-456-7890', 0, 1);
	    $pdf->Cell(0, 5, 'Email: info@company.com', 0, 1);

	    // Add some space
	    $pdf->Ln(10);

	    // Customer Information
	    $pdf->SetFont('Arial', 'B', 12);
	    $pdf->Cell(0, 5, 'Bill To:', 0, 1);
	    $pdf->SetFont('Arial', '', 12);
	    $pdf->Cell(0, 5, $invoiceData['customer_name'], 0, 1);
	    $pdf->Cell(0, 5, $invoiceData['customer_address'], 0, 1);

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
	    $pdf->Cell(10, 10, '#', 1);
	    $pdf->Cell(80, 10, 'Description', 1);
	    $pdf->Cell(30, 10, 'Quantity', 1);
	    $pdf->Cell(30, 10, 'Unit Price', 1);
	    $pdf->Cell(30, 10, 'Total', 1);
	    $pdf->Ln();

	    // Table body
	    $pdf->SetFont('Arial', '', 12);
	    $totalAmount = 0;
	    foreach ($invoiceData['items'] as $index => $item) {
	        $pdf->Cell(10, 10, $index + 1, 1);
	        $pdf->Cell(80, 10, $item['description'], 1);
	        $pdf->Cell(30, 10, $item['quantity'], 1, 0, 'C');
	        $pdf->Cell(30, 10, number_format($item['unit_price'], 2), 1, 0, 'C');
	        $itemTotal = $item['quantity'] * $item['unit_price'];
	        $pdf->Cell(30, 10, number_format($itemTotal, 2), 1, 0, 'R');
	        $pdf->Ln();
	        $totalAmount += $itemTotal;
	    }

	    // Total Amount
	    $pdf->Ln(5);
	    $pdf->SetFont('Arial', 'B', 12);
	    $pdf->Cell(120, 10, '', 0, 0);
	    $pdf->Cell(30, 10, 'Total:', 0, 0, 'R');
	    $pdf->Cell(30, 10, number_format($totalAmount, 2), 0, 1, 'R');

	    // Save the PDF to a file or output to the browser
	    $pdf->Output('I', 'invoice.pdf'); // 'I' for browser output, 'F' for saving to file
	}

	public function do_upload() {
        $config['upload_path'] = './assets/p/document';
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            echo json_encode($data);
        }
    }

    public function generateFormSumpah() {
        // Create instance of FPDF
        $pdf = new FPDF();
        $pdf->AddPage();
        
        // Add Header (Logo and Title)
        $pdf->Image(base_url('assets/p/img/logo_peradi.jpg'),10,6,50);  // Adjust the path to your logo
        $pdf->Ln(20);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,10,'FORMULIR PENDAFTARAN PENYUMPAHAN ADVOKAT PENGADILAN TINGGI',0,1,'C');
        $pdf->Ln(10);
        // Add form fields
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 6, '1. Nama', 0, 0);
        $pdf->Cell(100, 6, ': .............................................', 0, 1);

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
        $pdf->Cell(100, 6, ': .............................................', 0, 1);

        $pdf->Cell(50, 6, '8. Organisasi', 0, 0);
        $pdf->Cell(100, 6, ': .............................................', 0, 1);

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
            ['', 'dari Pengadilan Negeri Domisili setempat', 'OK', ''],
            ['4', 'Surat pernyataan tidak berstatus Aparat Sipil Negara (ASN) (PNS, TNI, POLRI,', '', ''],
            ['', 'Notaris, Pejabat Negara)', 'OK', ''],
            ['5', 'Fotocopy Ijazah Sekolah Tinggi Hukum dilegalisir Basah', 'OK', ''],
            ['6', 'Fotocopy Pendidikan Khusus Profesi Advokat (PKPA)', 'OK', ''],
            ['7', 'Fotocopy Sertifikat Pelatihan Advokat dan Lulus Ujian Profesi Advokat', 'OK', ''],
            ['8', 'Fotocopy SK Pengangkatan Advokat', 'OK', ''],
            ['9', 'Surat Keterangan Berprilaku Baik, Jujur, Bertanggung Jawab, adil', '', ''],
            ['', 'dan mempunyai Integritas yang tinggi', 'OK', ''],
        ];

        // Add rows
        $pdf->SetFont('Arial','',10);
        foreach($data as $row) {
            $pdf->Cell($w[0],6,$row[0],'LR',0,'C');
            $pdf->Cell($w[1],6,$row[1],'LR');
            $pdf->Cell($w[2],6,'OK','LR',0,'C');
            $pdf->Cell($w[3],6,$row[3],'LR',0,'C');
            $pdf->Ln();
        }
        
        // Closing line
        $pdf->Cell(array_sum($w),0,'','T');
        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(50, 6, '10. Keterangan : Sudah memenuhi syarat untuk diambil sumpah sebagai ADVOKAT', 0, 0);
        $pdf->Ln(20);
        $pdf->Cell(50, 6, 'Verifikator', 0, 0);
        $pdf->Ln(25);
        $pdf->Cell(50, 6, 'Ronald Samuel Wuisan', 0, 0);
        // Output the PDF
        // $pdf->Output('D', 'Formulir_Pendaftaran.pdf');  // Forces download

        $pdf->SetXY(150,52);
        $pdf->Cell(38, 50, 'Foto 3x4', 1,0,'C'); // Draw an empty box

        $pdf->Output();
    }

    public function createNotifDeadlinePayment()
    {
		// Create a DateTime object for the current date and time
		$now = new DateTime("2024-09-01");

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

		// Format the dates as needed, e.g., 'Y-m-d' for a standard date format
		echo "today: " . $today->format('Y-m-d') . "\n";
		echo "<br>";
		echo "tomorrow1: " . $tomorrow1->format('Y-m-d') . "\n";
		echo "<br>";
		echo "tomorrow2: " . $tomorrow2->format('Y-m-d') . "\n";
		echo "<br>";
		echo "tomorrow3: " . $tomorrow3->format('Y-m-d') . "\n";
		echo "<br>";
		echo "==============================";
		echo "<br>";
		echo "yesterday1: " . $yesterday1->format('Y-m-d') . "\n";
		echo "<br>";
		echo "yesterday2: " . $yesterday2->format('Y-m-d') . "\n";
		echo "<br>";
		echo "yesterday3: " . $yesterday3->format('Y-m-d') . "\n";
    }

    public function backup_database() {
        // Create the backup
        $prefs = array(
            'format' => 'zip', // gzip or zip, can also be sql
            'filename' => 'db_backup.sql', // File name in the zip archive
        );

        // Backup the entire database and assign it to a variable
        $backup = $this->dbutil->backup($prefs);

        // Set the backup file name with date
        $db_name = 'backup-on-' . date('Y-m-d-H-i-s') . '.zip';
        $save = './backups/' . $db_name;

        // Write the file to your server's backup directory
        write_file($save, $backup);

        // Force download the file
        // force_download($db_name, $backup);
    }
}

