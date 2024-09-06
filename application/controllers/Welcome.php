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
    }

	public function index()
	{
		redirect('P/Auth');
		// $this->load->view('welcome_message');
	}

	public function otp()
	{
		echo "hai";

		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.fonnte.com/send',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array(
			'target' => '082280524264',
			'message' =>$this->template_meesage('verify_data'),
			'url' => 'https://md.fonnte.com/images/wa-logo.png',
			'schedule' => $this->getMilisecondTime(),
		),
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: UxptNbkURakM+D++6#sa'
		  ),
		));

		$response = curl_exec($curl);
		if (curl_errno($curl)) {
		  $error_msg = curl_error($curl);
		}
		curl_close($curl);

		if (isset($error_msg)) {
		 echo $error_msg;
		}
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

	public function generatePdf()
    {
    	error_reporting(0); 
        // Load the Pdf library
        $image1 = "./assets/p/sertifikat/sertifikat.png";

        // Create a new PDF instance
        $pdf = new FPDF('l', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('Arial', 'B', 36);

        $pdf->Image($image1,0,0,310,210);//margin left - margin top - size lebar, size tinggi
        // Add a cell
        $pdf->Cell(290, 150, 'Ikhlasul Amal, S.Kom', 0, 1, 'C'); //margin left
        // Specify the folder where you want to save the file
        $outputDir = './assets/p/document/';
        // Set the file name
        $fileName = 'hello_world 2.pdf';
        // Output the PDF to the browser
        // $pdf->Output('F', $outputDir.$fileName);

        //forcedownload
        // $pdf->Output('D', 'report.pdf');
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
        // Database credentials from the CodeIgniter database config
        $db_host = $this->db->hostname;
        $db_user = $this->db->username;
        $db_pass = $this->db->password;
        $db_name = $this->db->database;

        // Directory where the backup file will be saved
        $backup_directory = './backups/';
        if (!file_exists($backup_directory)) {
            mkdir($backup_directory, 0777, true); // Create directory if it doesn't exist
        }

        // File name with current date and time
        $backup_file = $backup_directory . $db_name . '_backup_' . date('Y-m-d_H-i-s') . '.sql';

        // MySQL dump command to export the database
        $command = "mysqldump --host=$db_host --user=$db_user --password=$db_pass $db_name > $backup_file";

        // Execute the command
        $output = null;
        $return_var = null;
        exec($command, $output, $return_var);

        // Check if backup was successful
        if ($return_var === 0) {
            // Optional: Force download of the backup file
            $this->load->helper('download');
            force_download($backup_file, NULL);
            
            echo "Backup successful! File saved to: " . base_url($backup_file);
        } else {
            echo "Backup failed!";
        }
    }
}

