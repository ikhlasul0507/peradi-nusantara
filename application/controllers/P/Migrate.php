<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migrate extends CI_Controller
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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->writeLine();
		echo "<b>..............Time Migrate " . date("d-m-Y h:m:s") . "</b></br>";
	
		$this->writeLine();
		$this->addnewtable();
		$this->writeLine();
		$this->alterTable();
		$this->writeLine();
		$this->alterTableIndex();
		$this->writeLine();
		$this->insertDataTable();
		$this->writeLine();
		$this->setDBIncludeCharacter();
		$this->updateDataTable();
		echo "<h4>Congratulations your migrate successfully 100%</h4>";
		$this->writeLine();
		// redirect("L_a");
	}

	public function writeLine()
	{
		echo ".....................................................................................................................................</br>";
	}

	public function setDBIncludeCharacter()
	{
		//=================================================================================================
		$query = "ALTER TABLE history_call_center MODIFY COLUMN notes_call TEXT CHARACTER SET utf8mb4 		COLLATE utf8mb4_unicode_ci";
		if ($this->db->query($query)) {
			echo "||............[setDBIncludeCharacter successfully]</br>";
		} else {
			echo "||............[setDBIncludeCharacter failed]</br>";
		}
		//=================================================================================================
		$databaseName = $this->db->database;
		
		$query = "ALTER DATABASE `$databaseName` CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci";
		if ($this->db->query($query)) {
			echo "||............[setDBIncludeCharacter successfully]</br>";
		} else {
			echo "||............[setDBIncludeCharacter failed]</br>";
		}
		//=================================================================================================
		$query = "ALTER TABLE history_call_center CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
		if ($this->db->query($query)) {
			echo "||............[setDBIncludeCharacter successfully]</br>";
		} else {
			echo "||............[setDBIncludeCharacter failed]</br>";
		}
		//=================================================================================================
		$query = "SET NAMES utf8mb4";
		if ($this->db->query($query)) {
			echo "||............[setDBIncludeCharacter successfully]</br>";
		} else {
			echo "||............[setDBIncludeCharacter failed]</br>";
		}
	}

	public function addnewtable()
	{
		//=================================================================================================
		$title = "Table structure for table `user`";
		$query = "CREATE TABLE IF NOT EXISTS `user` (
				  `id_user` int(5) NOT NULL AUTO_INCREMENT,
				  `nik` int(21) NOT NULL,
				  `email` varchar(50) NOT NULL,
				  `nama_lengkap` varchar(50) NOT NULL,
				  `handphone` varchar(20) NOT NULL,
				  `usia` int(5) NOT NULL,
				  `asal_kampus` varchar(150) NOT NULL,
				  `semester` int(5) NOT NULL,
				  `password` varchar(50) NOT NULL,
				  `password_hash` varchar(250) NOT NULL,
				  `is_active` char(1) NOT NULL,
				  `user_level` int(5) NOT NULL,
				  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				  PRIMARY KEY (id_user)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}

		//=================================================================================================
		$title = "Table structure for table `parameter`";
		$query = "CREATE TABLE IF NOT EXISTS `parameter` (
					  `id_parameter` int(11) NOT NULL AUTO_INCREMENT,
					  `nama_parameter` varchar(128) NOT NULL,
					  `value_parameter` varchar(128) NOT NULL,
					  `type_parameter` char(1) DEFAULT NULL,
					   PRIMARY KEY (id_parameter)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}

		//=================================================================================================
		$title = "Table structure for table `log_history`";
		$query = "CREATE TABLE IF NOT EXISTS `log_history` (
				  `id_log_history` int(11) NOT NULL AUTO_INCREMENT,
				  `time_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				  `nik` varchar(50) NOT NULL,
				  `ipaddress` varchar(20) NOT NULL,
				  `macaddress` varchar(20) NOT NULL,
				  `browser` varchar(100) NOT NULL,
				  `action` text NOT NULL,
				   PRIMARY KEY (id_log_history)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}

		//=================================================================================================
		$title = "Table structure for table `forget_password`";
		$query = "CREATE TABLE IF NOT EXISTS `forget_password` (
				  `id_forget_password` int(11) NOT NULL AUTO_INCREMENT,
				  `time_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				  `uuid` varchar(50) NOT NULL,
				  `handphone` varchar(20) NOT NULL,
				  `nik` varchar(20) NOT NULL,
				   PRIMARY KEY (id_forget_password)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}

		//=================================================================================================
		$title = "Table structure for table `master_kelas`";
		$query = "CREATE TABLE IF NOT EXISTS `master_kelas` (
				  `id_master_kelas` int(11) NOT NULL AUTO_INCREMENT,
				  `time_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				  `nama_kelas` varchar(50) NOT NULL,
				  `deskripsi_kelas` text NOT NULL,
				  `foto_kelas` varchar(50) NOT NULL,
				  `metode_bayar` varchar(50) NOT NULL,
				  `is_active` char(1) NOT NULL,
				   PRIMARY KEY (id_master_kelas)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `order_booking`";
		$query = "CREATE TABLE IF NOT EXISTS `order_booking` (
				  `id_order_booking` int(11) NOT NULL AUTO_INCREMENT,
				  `time_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  `id_user` int(11) NOT NULL,
				  `id_master_kelas` int(11) NOT NULL,
				  `metode_bayar` varchar(50) NOT NULL,
				  `status_order` char(1) NOT NULL,
				   PRIMARY KEY (id_order_booking)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `order_payment`";
		$query = "CREATE TABLE IF NOT EXISTS `order_payment` (
				  `id_order_payment` int(11) NOT NULL AUTO_INCREMENT,
				  `time_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				  `id_order_booking` int(11) NOT NULL,
				  `id_virtual_account` varchar(50) NOT NULL,
				  `sequence_payment` int(11) NOT NULL,
				  `nominal_payment` varchar(50) NOT NULL,
				  `date_payment` date NOT NULL,
				  `status_payment` char(1) NOT NULL,
				   PRIMARY KEY (id_order_payment)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `request_payment`";
		$query = "CREATE TABLE IF NOT EXISTS `request_payment` (
				  `id_request_payment` int(11) NOT NULL AUTO_INCREMENT,
				  `time_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				  `gross_amount` int(30) NOT NULL,
				  `order_id` varchar(100) NOT NULL,
				  `payment_type` varchar(100) NOT NULL,
				  `status_code` varchar(100) NOT NULL,
				  `status_message` varchar(100) NOT NULL,
				  `transaction_id` varchar(100) NOT NULL,
				  `transaction_status` varchar(50) NOT NULL,
				  `transaction_time` varchar(50) NOT NULL,
				  `va_nunmbers` text NOT NULL,
				   PRIMARY KEY (id_request_payment)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `approve_cetificate`";
		$query = "CREATE TABLE IF NOT EXISTS `approve_cetificate` (
				  `id_approve_cetificate` int(11) NOT NULL AUTO_INCREMENT,
				  `time_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				  `id_user` int(30) NOT NULL,
				  `id_order_booking` int(30) NOT NULL,
				  `number_certificate` varchar(100) NOT NULL,
				  `count_print` int(30) NOT NULL,
				  `type_certificate` char(1) NOT NULL,
				   PRIMARY KEY (id_approve_cetificate)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `cart`";
		$query = "CREATE TABLE IF NOT EXISTS `cart` (
				  `id_cart` int(11) NOT NULL AUTO_INCREMENT,
				  `time_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				  `id_user` int(30) NOT NULL,
				  `id_master_kelas` int(30) NOT NULL,
				   PRIMARY KEY (id_cart)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Table structure for table `document_sumpah`";
		$query = "CREATE TABLE IF NOT EXISTS `document_sumpah` (
				  `id_document_sumpah` int(11) NOT NULL AUTO_INCREMENT,
				  `time_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				  `id_user` int(30) NOT NULL,
				  `id_order_booking` int(30) NOT NULL,
				  `jenis_dokument` varchar(50) NOT NULL,
				  `document_name` varchar(100) NOT NULL,
				   PRIMARY KEY (id_document_sumpah)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}

		//=================================================================================================
		$title = "Table structure for table `history_call_center`";
		$query = "CREATE TABLE IF NOT EXISTS `history_call_center` (
				  `id_history_call_center` int(11) NOT NULL AUTO_INCREMENT,
				  `time_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  `id_user` int(11) NOT NULL,
				  `customer_name` varchar(50) NOT NULL,
				  `customer_phone` varchar(50) NOT NULL,
				  `notes_call` text NULL,
				  `last_call` timestamp NULL,
				  `status_call_center` char(1) NOT NULL,
				   PRIMARY KEY (id_history_call_center)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}

		//=================================================================================================
		//quick true is msg from chatbot, false from users
		$title = "Table structure for table `chat_whatsapp`";
		$query = "CREATE TABLE IF NOT EXISTS `chat_whatsapp` (
				  `id_chat_whatsapp` int(11) NOT NULL AUTO_INCREMENT,
				  `time_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  `quick` TINYINT(1), 
				  `device` varchar(50) NOT NULL,
				  `pesan` varchar(50) NOT NULL,
				  `pengirim` text NULL,
				  `member` varchar(50),
				  `message` varchar(50) NOT NULL,
				  `text` text NULL,
				  `sender` varchar(50),
				  `name` varchar(50),
				  `type` varchar(20),
				  PRIMARY KEY (`id_chat_whatsapp`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}

		//=================================================================================================
		//quick true is msg from chatbot, false from users
		$title = "Table structure for table `chat_whatsapp_temp`";
		$query = "CREATE TABLE IF NOT EXISTS `chat_whatsapp_temp` (
				  `id_chat_whatsapp_temp` int(11) NOT NULL AUTO_INCREMENT,
				  `time_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  `quick` TINYINT(1), 
				  `device` varchar(50) NOT NULL,
				  `pesan` varchar(50) NOT NULL,
				  `pengirim` text NULL,
				  `member` varchar(50),
				  `message` varchar(50) NOT NULL,
				  `text` text NULL,
				  `sender` varchar(50),
				  `name` varchar(50),
				  `type` varchar(20),
				  PRIMARY KEY (`id_chat_whatsapp_temp`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		//quick true is msg from chatbot, false from users
		$title = "Table structure for table `logic_cs`";
		$query = "CREATE TABLE IF NOT EXISTS `logic_cs` (
				  `id_logic_cs` int(11) NOT NULL AUTO_INCREMENT,
				  `time_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  `id_user` int(11) NOT NULL,
				  `sequence` int(5) NOT NULL,
				  PRIMARY KEY (`id_logic_cs`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		//quick true is msg from chatbot, false from users
		$title = "Table structure for table `token_wa`";
		$query = "CREATE TABLE IF NOT EXISTS `token_wa` (
				  `id_token_wa` int(11) NOT NULL AUTO_INCREMENT,
				  `time_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  `id_user` int(11) NOT NULL,
				  `token` varchar(50) NOT NULL,
				  PRIMARY KEY (`id_token_wa`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		//quick true is msg from chatbot, false from users
		$title = "Table structure for table `kta`";
		$query = "CREATE TABLE IF NOT EXISTS `kta` (
				  `id_kta` int(11) NOT NULL AUTO_INCREMENT,
				  `time_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  `id_order_booking` int(11) NOT NULL,
				  `jenis_kta` char(1) NOT NULL,
				  `nama_kta` varchar(50) NOT NULL,
				  `berlaku_kta` varchar(50) NOT NULL,
				  `nomor_kta` int(5) NOT NULL,
				  PRIMARY KEY (`id_kta`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}

		//=================================================================================================
		$title = "Table structure for table `materi_kelas`";
		$query = "CREATE TABLE IF NOT EXISTS `materi_kelas` (
					  `id_materi_kelas` int(11) NOT NULL AUTO_INCREMENT,
					  `id_master_kelas` varchar(128) NOT NULL,
					  `angkatan` int(11) NOT NULL,
					  `sequence` int(11) NOT NULL,
					  `dokument_materi`varchar(128) NOT NULL,
					  `dokument_video`varchar(128) NOT NULL,
					  `link_zoom`varchar(128) NOT NULL,
					  `status_materi_kelas` char(1) NOT NULL,
					   PRIMARY KEY (id_materi_kelas)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
	}













	public function insertDataTable()
	{
		//=================================================================================================
		$title = "Dumping data for table `parameter`";
		$query = "INSERT IGNORE INTO `parameter` (`id_parameter`, `nama_parameter`, `value_parameter`, `type_parameter`) VALUES
					(1, '@sendNotifWaRegister', 'Y', 'O'),
					(2, '@linkWhatsapp', 'http://wa', 'T'),
					(3, '@lockLoginForEveryOne', 'N', 'O'),
					(4, '@donePaymentEveryMonth', 'N', 'O'),
					(5, '@setDatePaymentDeadline', '29', 'T'),
					(6, '@sendNotifWaLogin', 'Y', 'O'),
					(7, '@sendNotifWaForgetPassword', 'Y', 'O'),
					(8, '@sendNotifOrderClass', 'Y', 'O'),
					(9, '@sendNotifValidOrderClass', 'Y', 'O'),
					(10, '@sendNotifGeneratePayment', 'Y', 'O'),
					(11, '@chargeAdminPayment', '4500', 'T'),
					(12, '@serverKeyMitrans', 'SB-Mid-server-lTemQorAAVdcIfNydIqypwhc', 'T'),
					(13, '@clientKeyMitrans', 'SB-Mid-client-PwxtVC_cSfBUs6kI', 'T'),
					(14, '@isProductionMitrans', 'N', 'O'),
					(15, '@timeExpiredMitrans', '60', 'T'),
					(16, '@urlSandboxMitrans', 'https://app.sandbox.midtrans.com/snap/snap.js', 'T'),
					(17, '@urlProductionMitrans', 'https://app.midtrans.com/snap/snap.js', 'T'),
					(18, '@sendNotifDonePayment', 'Y', 'O'),
					(19, '@sendNotifCompletePayment', 'Y', 'O'),
					(20, '@companyName', 'Peradi Nusantara', 'T'),
					(21, '@companyAddress1', 'Angelonia Medang', 'T'),
					(22, '@companyAddress2', 'Tangerang Banten', 'T'),
					(23, '@companyPhoneNumber', '0811-1212-12121', 'T'),
					(24, '@companyEmail', 'peradi@gmail.com', 'T'),
					(25, '@sendNotifApproveCertificate', 'Y', 'O'),
					(26, '@startNumberCertificatePKPA', '200', 'T'),
					(27, '@startNumberCertificateUPA', '200', 'T'),
					(28, '@startNumberCertificateBREVET', '200', 'T'),
					(29, '@startNumberCertificateParalegal', '200', 'T'),
					(30, '@startNumberCertificateCPT', '200', 'T'),
					(31, '@startNumberCertificateMediator', '200', 'T'),
					(32, '@startNumberCertificateAgraria', '200', 'T'),
					(33, '@idMasterPKPAForLogicApprove', '1', 'T'),
					(34, '@idMasterUPAForLogicApprove', '3', 'T'),
					(35, '@picRegister', 'handi,gabi', 'T'),
					(36, '@startNumberAngkatan', '1', 'T'),
					(37, '@endNumberAngkatan', '100', 'T'),
					(38, '@allowImportDataPeserta', 'N', 'O'),
					(39, '@allowButtonApprove', 'N', 'O'),
					(40, '@totalRowPerPagePaging', '100', 'T'),
					(41, '@waAdminNotif', '088973832651', 'T'),
					(42, '@manualNumberCertificate', 'N', 'O'),
					(43, '@logicChooseUserCS', '-', 'T'),
					(44, '@donePaymentCSEveryMonth', 'N', 'O'),
					(45, '@setDatePaymentCSDeadline', '11', 'T'),
					(46, '@lockLoginForEveryOneCS', 'N', 'O'),
					(47, '@linkGroupWaSosilisasi', '-', 'T'),
					(48, '@sendNotifAutoChatbotFromSystem', 'Y', 'O'),
					(49, '@recordChatWaOfficial', 'Y', 'O'),
					(50, '@apiKeyRemoveBG', 'kwc1EuNi1vCsbrJWoLKbXtYo', 'T'),
					(51, '@sendEmailBackupDatabase', 'Y', 'O'),
					(52, '@recordChatWaTemp', 'Y', 'O'),
					(53, '@intervalClearPaymentExpired', '2', 'T'),
					(54, '@intervalClearWhatsappTemp', '7', 'T')
					";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
		//=================================================================================================
		$title = "Dumping data for table `user`";
		$query = "INSERT IGNORE INTO `user` (`id_user`,`nik`, `email`, `nama_lengkap`, `handphone`,`usia`,`asal_kampus`,`semester`,`password`,`password_hash`,`is_active`,`user_level`,`foto_ktp`) VALUES
					(1,12345678912345, 'ikhlasul0507@gmail.com', 'Ikhlasul Amal', '082280524264',20,'Asal Kampus',2,'1234512345','QWEQW21312312','Y',1,'logo_peradi.jpg')
					";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}

		//=================================================================================================
		$title = "Dumping data for table `master_kelas`";
		$query = "INSERT  IGNORE INTO `master_kelas`(`id_master_kelas`,`time_history`,`nama_kelas`,`deskripsi_kelas`,`foto_kelas`,`metode_bayar`,`is_active`,`foto_sertifikat`,`link_group_wa`,`is_sumpah`,`prefix_certificate`) VALUES 
				(1,'2024-08-22 18:57:06','PKPA','PKPA','4UBEenGlf2YdZFKy4V2R.jpg','Cicilan,Lunas,Bertahap','Y','iqf5W7sLYlujOzYzX4k6.png','https://chat.whatsapp.com/E2ORTyUx0cKBA3NlZb54Us','N','PKPA'),
				(2,'2024-08-22 18:58:01','PARALEGAL','PARALEGAL','aa2r7xpEfDjZsq6xovgP.jpg','Cicilan,Lunas,Bertahap','Y','7Z74kwWv5HZkgdQmfNo7.png','https://chat.whatsapp.com/E2ORTyUx0cKBA3NlZb54Us','N','PARALEGAL'),
				(3,'2024-08-22 18:58:14','UPA','UPA','umKcdXkLrDVWxpnu8rtw.jpg','Cicilan,Lunas,Bertahap','Y','UK7gcHlJdPgK1nVNMTGf.png','https://chat.whatsapp.com/E2ORTyUx0cKBA3NlZb54Us','N','SUPA'),
				(4,'2024-08-29 16:31:12','BREVET A & B','BREVET A & B Hukum','Nc6W08o9t0DMzbNZh4PU.jpg','Cicilan,Lunas,Bertahap','Y','8q6kD8z7VyyJKmZG1HJh.png','https://chat.whatsapp.com/E2ORTyUx0cKBA3NlZb54Us','N','BREVET'),
				(5,'2024-08-23 17:05:54','SUMPAH','SUMPAH Hukum','Nu2PhUrdQ2Slm63Iaxvj.jpg','Cicilan,Lunas,Bertahap','Y','6BadPAVV1sIscwNyVImn.jpg','https://chat.whatsapp.com/E2ORTyUx0cKBA3NlZb54Us','Y','SUMPAH'),
				(6,'2024-08-22 18:59:36','CPT','CPT','YV3RWFKc9qcLK5z6UkyN.jpg','Cicilan,Lunas,Bertahap','Y','Rpujd1HbukcKOCVjfSLu.png','https://chat.whatsapp.com/E2ORTyUx0cKBA3NlZb54Us','N','CPT'),
				(7,'2024-08-23 17:06:01','MEDIATAOR','MEDIATAOR','musYqHBtkvFjLCiBpht4.jpg','Cicilan,Lunas,Bertahap','Y','o931UmL3PjcQWkmTfnLJ.jpg','https://chat.whatsapp.com/E2ORTyUx0cKBA3NlZb54Us','N','MEDIATAOR'),
				(8,'2024-08-23 17:06:08','AGRARIA','AGRARIA','SEZaksDdNtc6SvZkU5ea.jpg','Cicilan,Lunas,Bertahap','Y','gG9Ed9eGs6SfVIE6WgLE.jpg','https://chat.whatsapp.com/E2ORTyUx0cKBA3NlZb54Us','N','AGRARIA')
				";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
	}

	public function updateDataTable()
	{

		//=================================================================================================
		$title = "Update data for table `order_booking`";
		$query = "UPDATE order_booking SET angkatan_kelas = 'angkatan-10~' WHERE angkatan_kelas = ''";
		if ($this->db->query($query)) {
			echo "||............[Migrate successfully " . $title . "]</br>";
		} else {
			echo "||............[Migrate failed " . $title . "]</br>";
		}
	}
	

	public function alterTableIndex()
	{
		$column = "sender";
		$table_name = "chat_whatsapp";
		$title = "Create Index on " . $column . " for table " . $table_name;
		$query = "SELECT COUNT(*) as count 
		          FROM information_schema.statistics 
		          WHERE table_schema=DATABASE() 
		          AND table_name= '" . $table_name . "' 
		          AND index_name = 'idx_" . $column . "'";
		$check = $this->db->query($query)->first_row('array');

		if ($check['count'] == '0') {
		    $queryIndex = "CREATE INDEX idx_" . $column . " ON $table_name($column);";
		    if ($this->db->query($queryIndex)) {
		        echo "||............[Migrate successfully " . $title . "]</br>";
		    } else {
		        echo "||............[Migrate failed " . $title . "]</br>";
		    }
		} else {
		    echo "||............[Index already exists for " . $column . " on table " . $table_name . "]</br>";
		}

		// Repeat for 'customer_phone' index
		$column = "customer_phone";
		$table_name = "history_call_center";
		$title = "Create Index on " . $column . " for table " . $table_name;
		$query = "SELECT COUNT(*) as count 
		          FROM information_schema.statistics 
		          WHERE table_schema=DATABASE() 
		          AND table_name= '" . $table_name . "' 
		          AND index_name = 'idx_" . $column . "'";
		$check = $this->db->query($query)->first_row('array');

		if ($check['count'] == '0') {
		    $queryIndex = "CREATE INDEX idx_" . $column . " ON $table_name($column);";
		    if ($this->db->query($queryIndex)) {
		        echo "||............[Migrate successfully " . $title . "]</br>";
		    } else {
		        echo "||............[Migrate failed " . $title . "]</br>";
		    }
		} else {
		    echo "||............[Index already exists for " . $column . " on table " . $table_name . "]</br>";
		}

	}

	public function alterTable()
	{
		//=================================================================================================
		$column = "status_certificate";
		$table_name = "order_booking";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column CHAR(1) DEFAULT 'P';";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		//=================================================================================================
		$column = "foto_sertifikat";
		$table_name = "master_kelas";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(50) DEFAULT '';";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		$column = "id_master_kelas";
		$table_name = "approve_cetificate";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column int(30) DEFAULT 0;";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		$column = "date_periode";
		$table_name = "approve_cetificate";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(100) DEFAULT '';";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		$column = "link_group_wa";
		$table_name = "master_kelas";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(100) DEFAULT '';";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		$column = "is_sumpah";
		$table_name = "master_kelas";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column char(1) DEFAULT 'N';";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}

		//=================================================================================================
		$column = "prefix_certificate";
		$table_name = "master_kelas";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(100) DEFAULT 'PKPA';";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}

		//=================================================================================================
		$column = "list_kelas";
		$table_name = "order_booking";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(100) DEFAULT '';";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		$column = "id_master_kelas";
		$table_name = "approve_cetificate";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column int(10) DEFAULT '';";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		$column = "qr_code_name";
		$table_name = "approve_cetificate";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(100) DEFAULT '';";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}

		//=================================================================================================
		$column = "jadwal_pelatihan";
		$table_name = "approve_cetificate";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(100) DEFAULT '';";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		$column = "reference";
		$table_name = "user";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(100) DEFAULT '';";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		$column = "pic";
		$table_name = "user";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(100) DEFAULT '';";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		$column = "angkatan";
		$table_name = "user";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(100) DEFAULT '';";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		$column = "latar_belakang";
		$table_name = "user";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column int(10) DEFAULT '1';";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		$column = "nik";
		$table_name = "user";
		$title = "Change Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			MODIFY $column VARCHAR(50)";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		$column = "foto_ktp";
		$table_name = "user";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column VARCHAR(150)";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		$column = "foto_kta";
		$table_name = "user";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column VARCHAR(150)";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}

		//=================================================================================================
		$column = "on_request_payment";
		$table_name = "request_payment";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column VARCHAR(5) DEFAULT 'N'";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}

		//=================================================================================================
		$column = "is_marketing";
		$table_name = "user";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column CHAR(1) DEFAULT 'N'";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}

		//=================================================================================================
		$column = "is_owner";
		$table_name = "user";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column CHAR(1) DEFAULT 'N'";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}

		//=================================================================================================
		$column = "is_digital_marketing";
		$table_name = "user";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column CHAR(1) DEFAULT 'N'";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}

		//=================================================================================================
		$column = "priority";
		$table_name = "history_call_center";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column CHAR(1) DEFAULT '0'";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}

		//=================================================================================================
		$column = "type_group"; //hot, warm, could, closing
		$table_name = "history_call_center";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column CHAR(1) DEFAULT ''";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}

		//=================================================================================================
		$column = "is_deleted"; //hot, warm, could, closing
		$table_name = "history_call_center";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column CHAR(1) DEFAULT 'N'";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		$columnsToModify = [
		    "pesan" => "TEXT NULL",
		    "pengirim" => "VARCHAR(50)",
		    "message" => "TEXT NULL",
		    "text" => "VARCHAR(50)"
		];

		$table_name = "chat_whatsapp";

		foreach ($columnsToModify as $column => $newType) {
		    $title = "Modify Column " . $column . " in table " . $table_name;
		    $query = "SELECT COUNT(*) as count 
		              FROM information_schema.columns 
		              WHERE table_schema=DATABASE() 
		              AND table_name= '" . $table_name . "' 
		              AND column_name = '" . $column . "'";
		    
		    $check = $this->db->query($query)->first_row('array');

		    if ($check['count'] > 0) {
		        $queryAlter = "ALTER TABLE $table_name MODIFY $column $newType";
		        if ($this->db->query($queryAlter)) {
		            echo "||............[Migrate successfully: " . $title . "]</br>";
		        } else {
		            echo "||............[Migrate failed: " . $title . "]</br>";
		        }
		    } else {
		        echo "||............[Column " . $column . " does not exist in table " . $table_name . "]</br>";
		    }
		}

		//=================================================================================================
		$column = "is_new_user"; //hot, warm, could, closing
		$table_name = "user";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column CHAR(1) DEFAULT 'Y'";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================
		//=================================================================================================
		$column = "angkatan_kelas"; //hot, warm, could, closing
		$table_name = "order_booking";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column varchar(150) DEFAULT ''";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================

		//=================================================================================================
		$column = "is_paid"; //hot, warm, could, closing
		$table_name = "order_booking";
		$title = "Add Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			ADD $column char(1) DEFAULT 'N'";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}
		//=================================================================================================

		//=================================================================================================
		$column = "time_history";
		$table_name = "order_booking";
		$title = "Change Column " . $column . " to table " . $table_name;
		$query = "SELECT COUNT(*) as count FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name= '" . $table_name . "' AND column_name = '" . $column . "'";
		$check = $this->db->query($query)->first_row('array');
		if ($check['count'] == '0') {
			$queryAlter = "ALTER TABLE $table_name
			MODIFY $column TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";
			if ($this->db->query($queryAlter)) {
				echo "||............[Migrate successfully " . $title . "]</br>";
			} else {
				echo "||............[Migrate failed " . $title . "]</br>";
			}
		} else {
			echo "||............[Migrate successfully " . $title . "]</br>";
		}

	}

}
