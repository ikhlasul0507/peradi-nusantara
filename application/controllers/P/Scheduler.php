<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scheduler extends CI_Controller
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
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mbg','M');
		$this->load->library('service');
		$this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
	}
	public function index()
	{
		$this->startScheduler();
	}

	public function startScheduler()
	{

		$data_send_notif= ['start' => date('Y-m-d H:i:s'), 'handphone' => trim('08151654015'),'msg'=> 'Jalankan Scheduler...'];
		$this->service->send_whatsapp($data_send_notif, 'start_scheduler');
		
		$db_name = 'backup-on-' . date('Y-m-d-H-i-s') . '.zip';
		$this->backup_database($db_name);
		echo "startScheduler :" .date('Y-m-d H:i:s')."</br>";
		$this->M->add_log_history('System Peradi',"startScheduler :" .date('Y-m-d H:i:s'));
		//checkDatePaymentEveryMonth
		//setUnpaidPayment
		//checkDatePaymentEveryMonthCS
		//setUnpaidPayment
		//engineSendNotifPayment
		$this->engineSendNotifPayment();
		//clearPaymentExpiredAfterGenerated
		$this->clearPaymentExpiredAfterGenerated();
		//clearWhatsappTemp
		$this->clearWhatsappTemp();
	}

	public function setUnpaidPayment()
	{
		$datePayment = (int)$this->M->getParameter('@setDatePaymentDeadline') + 1;
		$dayOfMonth = date('j');
		if ($dayOfMonth == $datePayment){

			$data_send_notif= ['start' => date('Y-m-d H:i:s'), 'handphone' => trim('08151654015'),'msg'=> 'Jalankan Scheduler donePaymentEveryMonth To N'];
			// $this->service->send_whatsapp($data_send_notif, 'start_scheduler');

			$lockDB = $this->M->update_to_db('parameter',['value_parameter'=> 'N'],'nama_parameter','@donePaymentEveryMonth');

			echo "donePaymentEveryMonth = N </br>";
		}
	}
	public function checkDatePaymentEveryMonth()
	{
		$datePayment = (int)$this->M->getParameter('@setDatePaymentDeadline');
		$dayOfMonth = date('j');
		if ($dayOfMonth == $datePayment && $this->M->getParameter('@donePaymentEveryMonth') == 'N') {

			$data_send_notif= ['start' => date('Y-m-d H:i:s'), 'handphone' => trim('08151654015'),'msg'=> 'Jalankan Scheduler Lock Login For EveryOne'];
			// $this->service->send_whatsapp($data_send_notif, 'start_scheduler');

			$lockDB = $this->M->update_to_db('parameter',['value_parameter'=> 'Y'],'nama_parameter','@lockLoginForEveryOne');
			echo "lockLoginForEveryOne = Y </br>";
		}
	}

	public function setUnpaidPaymentCS()
	{
		$datePayment = (int)$this->M->getParameter('@setDatePaymentCSDeadline') + 1;
		$dayOfMonth = date('j');
		if ($dayOfMonth == $datePayment){

			$data_send_notif= ['start' => date('Y-m-d H:i:s'), 'handphone' => trim('08151654015'),'msg'=> 'Jalankan Scheduler donePaymentEveryMonth To N'];
			// $this->service->send_whatsapp($data_send_notif, 'start_scheduler');

			$lockDB = $this->M->update_to_db('parameter',['value_parameter'=> 'N'],'nama_parameter','@donePaymentCSEveryMonth');

			echo "donePaymentCSEveryMonth = N </br>";
		}
	}
	public function checkDatePaymentEveryMonthCS()
	{
		$datePayment = (int)$this->M->getParameter('@setDatePaymentCSDeadline');
		$dayOfMonth = date('j');
		if ($dayOfMonth == $datePayment && $this->M->getParameter('@donePaymentCSEveryMonth') == 'N') {

			$data_send_notif= ['start' => date('Y-m-d H:i:s'), 'handphone' => trim('08151654015'),'msg'=> 'Jalankan Scheduler Lock Login For EveryOne CS'];
			// $this->service->send_whatsapp($data_send_notif, 'start_scheduler');

			$lockDB = $this->M->update_to_db('parameter',['value_parameter'=> 'Y'],'nama_parameter','@lockLoginForEveryOneCS');
			echo "lockLoginForEveryOneCS = Y </br>";
		}
	}

	public function backup_database($db_name) {
        // Create the backup
        $prefs = array(
            'format' => 'zip', // gzip or zip, can also be sql
            'filename' => 'db_backup.sql', // File name in the zip archive
        );

        // Backup the entire database and assign it to a variable
        $backup = $this->dbutil->backup($prefs);

        // Set the backup file name with date
        $save = './backups/' . $db_name;

        // Write the file to your server's backup directory
        write_file($save, $backup);

        $data_send_notif= ['start' => date('Y-m-d H:i:s'), 'handphone' => trim('08151654015'),'msg'=> 'Jalankan Scheduler Backup Database'];
        //send wa
		$this->service->send_whatsapp($data_send_notif, 'start_scheduler');
		//send email
		if($this->M->getParameter('@sendEmailBackupDatabase') == 'Y') {
			$this->service->sendEmailWithAttachment();
		}
        // Force download the file
        // force_download($db_name, $backup);
        echo "Jalankan Scheduler Backup Database </br>";
    }

    public function engineSendNotifPayment()
    {
    	$query = $this->M->getAllPaymentSendNotif();
		$totalSegeraBayar = 0;
		$totalLewatBayar = 0;
    	if($query){
    		foreach ($query as $key => $value) {

    			$data_send_notif = [
					'handphone' => trim($value['handphone']),
					'namalengkap' => trim($value['nama_lengkap']),
					'namaKelas' => trim($value['nama_kelas']),
					'metodeBayar' => trim($value['metode_bayar']),
					'nominal_payment' => number_format(trim($value['nominal_payment']), 2),
					'date_payment' => trim($value['date_payment']),
					'url_virtual_account' => trim(base_url('P/Payment/virtual_account/'.$value['id_virtual_account']))
				];

    			if($value['date_payment'] <= date('Y-m-d')){
    				//lewat tanggal bayar
    				$this->service->send_whatsapp($data_send_notif, 'generate_payment');
    				$totalLewatBayar++;
    			}else{
    				//segera bayar
    				$this->service->send_whatsapp($data_send_notif, 'generate_payment_yesterday');
    				$totalSegeraBayar++;
    			}
    		}
    	}
    	$msg = "Jalankan Send Notif Payment 

    	- Total Lewat Bayar = ".$totalLewatBayar."
    	- Total Segera Bayar = ".$totalSegeraBayar;

    	$data_send_notif= ['start' => date('Y-m-d H:i:s'), 'handphone' => trim('08151654015'),'msg'=> $msg];
		$this->service->send_whatsapp($data_send_notif, 'start_scheduler');
    }

    public function clearPaymentExpiredAfterGenerated()
	{
		$intervalClearPaymentExpired = (int)$this->M->getParameter('@intervalClearPaymentExpired');

		$this->M->clearPaymentExpiredAfterGenerated($intervalClearPaymentExpired);
		$data_send_notif= ['start' => date('Y-m-d H:i:s'), 'handphone' => trim('08151654015'),'msg'=> 'Jalankan Scheduler clearPaymentExpiredAfterGenerated'];
		$this->service->send_whatsapp($data_send_notif, 'start_scheduler');
		echo "clearPaymentExpiredAfterGenerated</br>";
	}

	public function clearWhatsappTemp()
	{
		$intervalclearWhatsappTemp = (int)$this->M->getParameter('@intervalClearWhatsappTemp');

		$this->M->clearWhatsappTemp($intervalclearWhatsappTemp);
		$data_send_notif= ['start' => date('Y-m-d H:i:s'), 'handphone' => trim('08151654015'),'msg'=> 'Jalankan Scheduler clearWhatsappTemp'];
		$this->service->send_whatsapp($data_send_notif, 'start_scheduler');
		echo "clearWhatsappTemp</br>";
	}
}
