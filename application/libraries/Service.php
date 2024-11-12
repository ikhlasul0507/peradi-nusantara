<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service {

	protected $CI;

	public function __construct() {
        // Get the CodeIgniter super object
        $this->CI =& get_instance();
        // Load the upload library
        $this->CI->load->library('upload');
        $this->CI->load->library('email');
    }

	public function send_whatsapp($params, $type, $tanggalSend = "")
	{
		$timeSechedule = 0;
		if($tanggalSend != ""){
			$timeSechedule = $this->getMilisecondTime($tanggalSend);
		}
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
			'target' => $params['handphone'],
			'message' =>$this->template_meesage($type, $params),
			'url' => 'https://md.fonnte.com/images/wa-logo.png',
			'schedule' => $timeSechedule,
			'preview ' => true
		),
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: bzVr-4tLk#4CBRGNK4y2'
		  ),
		));

		$response = curl_exec($curl);
		if (curl_errno($curl)) {
		  $error_msg = curl_error($curl);
		}
		curl_close($curl);

		if (isset($error_msg)) {
		 // echo $error_msg;
		}
		// echo "tanggalSend = " .$tanggalSend ;
		// echo "timeSechedule = " .$timeSechedule ;
		// echo $response;
	}

	public function getMilisecondTime($tanggalSend)
	{
		//Example usage:
		$tanggal  = explode("-", $tanggalSend);
		$year = $tanggal[0];
		$month = $tanggal[1];
		$day = $tanggal[2];
		$hour = 8;
		$minute = 0;
		$second = 0;

		$gmt = 5;
		$hour = $hour - $gmt;
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
				$name = $params['namalengkap'];
				$url = $params['url_login'];
				return '*--Registrasi Telah Berhasil --*

Selamat Datang, '.$name.',

Silahkan Login 
Lakukan pembelian paket belajar
Akses link berikut : '.$url.'

Terima Kasih

-Peradi Nusantara-';
				break;
			case 'forget_password':
				$name = $params['namalengkap'];
				$url = $params['url_forget'];
				return '*--Lupa Password --*

Selamat Datang, '.$name.',

Silahkan  
Lakukan Reset Password
Akses link berikut : '.$url.'

Terima Kasih

-Peradi Nusantara-';
				break;
			case 'login':
				$name = $params['namalengkap'];
				return '*--Login Telah Berhasil --*

Selamat Datang, '.$name.',

Selamat anda telah Login 

Terima Kasih

-Peradi Nusantara-';
				break;
			case 'order_class':
				$name = $params['namalengkap'];
				$namaKelas = $params['namaKelas'];
				$metodeBayar = $params['metodeBayar'];
				return '*--Pembelian Berhasil --*

Selamat Datang, '.$name.',

Detail Pembelian:

-Paket : *'.$namaKelas.'*
-Metode Pembayaran : *'.$metodeBayar.'*

Admin akan verifikasi data
mohon di tunggu ya 

Terima Kasih

-Peradi Nusantara-';
			case 'order_notif_admin':
				$name = $params['namalengkap'];
				$namaKelas = $params['namaKelas'];
				$metodeBayar = $params['metodeBayar'];
				return '*--Notifikasi Pembelian Berhasil --*

---Orderan Masuk---

Atas Nama : '.$name.',

Detail Pembelian:

-Paket : *'.$namaKelas.'*
-Metode Pembayaran : *'.$metodeBayar.'*

Admin Mohon verifikasi data

Terima Kasih

-Peradi Nusantara-';
			case 'valid_order_class':
				$name = $params['namalengkap'];
				$namaKelas = $params['namaKelas'];
				$metodeBayar = $params['metodeBayar'];
				// $link_wa = $params['link_wa'];
				return '*--Validasi Pembelian Berhasil --*

Selamat Datang, '.$name.',

Detail Pembelian:

-Paket : *'.$namaKelas.'*
-Metode Pembayaran : *'.$metodeBayar.'*
Verifikasi telah berhasil 
mohon ditunggu pemberitahuan
detail pembayarannya 

Terima Kasih

-Peradi Nusantara-';
			case 'generate_payment':
				$name = $params['namalengkap'];
				$namaKelas = $params['namaKelas'];
				$metodeBayar = $params['metodeBayar'];
				$nominal_payment = $params['nominal_payment'];
				$date_payment = $params['date_payment'];
				$url_virtual_account = $params['url_virtual_account'];

				return '*--Pembayaran Kelas--*

Selamat Datang, '.$name.',

Lakukan Pembayaran 
Pembelian Paket *'.$namaKelas.'*

- Total Pembayaran : Rp.'.$nominal_payment.'
- Tanggal Bayar : '.$date_payment.'

Klik Link Berikut :
'.$url_virtual_account.'

*Terima Kasih*

-*Peradi Nusantara*-';
			case 'generate_payment_yesterday':
				$name = $params['namalengkap'];
				$namaKelas = $params['namaKelas'];
				$metodeBayar = $params['metodeBayar'];
				$nominal_payment = $params['nominal_payment'];
				$date_payment = $params['date_payment'];
				$url_virtual_account = $params['url_virtual_account'];

				return '*--Pembayaran Kelas--*

Selamat Datang, '.$name.',

Lakukan Pembayaran 
Pembelian Paket *'.$namaKelas.'*

*Sebelum Tanggal Jatuh Tempo*

- Total Pembayaran : Rp.'.$nominal_payment.'
- Tanggal Bayar : '.$date_payment.'

Klik Link Berikut :
'.$url_virtual_account.'

*Terima Kasih*

-*Peradi Nusantara*-';
			case 'generate_payment_tomorrow':
				$name = $params['namalengkap'];
				$namaKelas = $params['namaKelas'];
				$metodeBayar = $params['metodeBayar'];
				$nominal_payment = $params['nominal_payment'];
				$date_payment = $params['date_payment'];
				$url_virtual_account = $params['url_virtual_account'];

				return '*--Pembayaran Kelas--*

Selamat Datang, '.$name.',

*Abaikan Pesan ini !! Jika tagihan sudah lunas*

Jika Belum melakukan pembayaran,
Silahkan
Lakukan Pembayaran 
Pembelian Paket *'.$namaKelas.'*

- Total Pembayaran : Rp.'.$nominal_payment.'
- Tanggal Bayar : '.$date_payment.'

Klik Link Berikut :
'.$url_virtual_account.'

*Terima Kasih*

-*Peradi Nusantara*-';
			case 'done_payment':
				$name = $params['namalengkap'];
				$namaKelas = $params['namaKelas'];
				$metodeBayar = $params['metodeBayar'];
				$nominal_payment = $params['nominal_payment'];
				$date_payment = $params['date_payment'];
				$url_login = $params['url_login'];
				$link_wa = $params['link_wa'];

				$list_name_kelas = explode(",",$namaKelas);
				$list_link_wa = explode(",",$link_wa);
				$dataWa = "";
				for ($i = 0; $i < count($list_name_kelas); $i++) {
					$dataWa = $dataWa . $list_name_kelas[$i].' : '.$list_link_wa[$i].' , ';
				}
				return '*--Pembayaran Kelas Berhasil--*

Selamat Datang, '.$name.',

Pembayaran Berhasil
Pembelian Paket *'.$namaKelas.'*

- Total Pembayaran : Rp.'.$nominal_payment.'
- Tanggal Bayar : '.$date_payment.'

Join Group Wa :
'.$dataWa.'
Untuk melihat detail :
- Akses '.$url_login.'
- Login dengan account 
- Pilih menu *Kelas Ku*
- Pilih Kelas *'.$namaKelas.'*
- Klik *Buka Kelas*

*Terima Kasih*

-*Peradi Nusantara*-';
			case 'complete_payment':
				$name = $params['namalengkap'];
				$namaKelas = $params['namaKelas'];
				$url_invoice = $params['url_invoice'];

				return '*--Pelunasan Pembayaran Kelas Berhasil--*

Selamat Datang, '.$name.',

Pelunasan Pembayaran Berhasil
Pembelian Paket *'.$namaKelas.'*

Untuk melihat invoice :
- Akses '.$url_invoice.'

*Terima Kasih*

-*Peradi Nusantara*-';
			case 'approve_certificate':
				$name = $params['namalengkap'];
				$namaKelas = $params['namaKelas'];
				$url_certificate = $params['url_certificate'];

				return '*--Sertifikat Terbit--*

Selamat Datang, '.$name.',

Sertifikat Telah Terbit
Pada Kelas *'.$namaKelas.'*

Untuk melihat detail :
- Akses '.$url_certificate.'

*Terima Kasih*

-*Peradi Nusantara*-';
			case 'start_scheduler':
				$start = $params['start'];
				$msg = $params['msg'];
				return '*--Start Scheduler--*

Start : '.$start.'

'.$msg.'

*Terima Kasih*
-*Peradi Nusantara*-';
			default:
				# code...
				break;
		}
	}

	public function generateSecureRandomString($length = 20) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[random_int(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	public function do_upload($url, $filename) {
        $config['upload_path'] = './assets/p/'.$url;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 10048; // 2MB
        $config['max_width'] = 10048;
        $config['max_height'] = 10048;
        $config['file_name'] = $this->generateSecureRandomString(20);
 
        $this->CI->upload->initialize($config);

        if (!$this->CI->upload->do_upload($filename)) {
            return array('error' => $this->CI->upload->display_errors(),'code'=> 401);
        } else {
            return array('upload_data' => $this->CI->upload->data(),'code'=> 200);
        }
    }

    public function delete_photo($url, $photo_id) {
        
        if ($photo_id) {
            $photo_path = './assets/p/'.$url.'/'.$photo_id; // Construct the file path

            // Delete the file from the server
            if (file_exists($photo_path)) {
                if (unlink($photo_path)) {
                    return array('delete_data' => 'Photo deleted successfully.','code'=> 200);
                } else {
                	return array('error' => 'Failed to delete the photo.','code'=> 401);
                }
            } else {
            	return array('error' => 'File does not exist.','code'=> 401);
            }
        } else {
        	return array('error' => 'Photo not found.','code'=> 401);
        }
    }
    public function formatDate($date) {
	    setlocale(LC_TIME, 'id_ID'); // Set the locale to Indonesian
	    $timestamp = strtotime($date);
	    return strftime("%d %B %Y", $timestamp);
	}

	public function removeBG($api_key, $image_name)
    {
    	$outputFile = "";
		// Your Remove.bg API key
		$apiKey = $api_key;

		// The path to the input image file
		$imagePath = './assets/p/kta/'.$image_name;


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
		    $fileName = $this->generateSecureRandomString(20).'.png';
		    $outputFile = './assets/p/kta/'.$fileName;
		    file_put_contents($outputFile, $response);
		}

		// Close the cURL session
		curl_close($ch);
		return $fileName;
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

	    $this->CI->email->initialize($config);

	    // Email content
	    $emailAddress = 'wuisanlaw@gmail.com';
	    $this->CI->email->from('backupdatabase@peradinusantara.org', 'Peradi Nusantara');
	    $this->CI->email->to($emailAddress);
	    $this->CI->email->subject('Schedule Backup Database');
	    $this->CI->email->message(date('Y-m-d H:i:s').' - Backup Database ...');

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

	    $this->CI->email->attach($latestFile);

	    // Send email and check status
	    if ($this->CI->email->send()) {
	        echo 'Email sent successfully with attachment.';
	    } else {
	        echo "Failed to send email. Error details:";
	        echo $this->CI->email->print_debugger(['headers']);
	    }
	}
}
