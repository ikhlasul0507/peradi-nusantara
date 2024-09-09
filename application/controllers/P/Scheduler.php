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
		echo "startScheduler :" .date('Y-m-d H:i:s');
		//checkDatePaymentEveryMonth
		$this->checkDatePaymentEveryMonth();
		//setUnpaidPayment
		$this->setUnpaidPayment();
	}

	public function setUnpaidPayment()
	{
		$datePayment = (int)$this->M->getParameter('@setDatePaymentDeadline') + 1;
		$dayOfMonth = date('j');
		if ($dayOfMonth == $datePayment){

			$data_send_notif= ['start' => date('Y-m-d H:i:s'), 'handphone' => trim('08151654015'),'msg'=> 'Jalankan Scheduler donePaymentEveryMonth To N'];
			$this->service->send_whatsapp($data_send_notif, 'start_scheduler');

			$lockDB = $this->M->update_to_db('parameter',['value_parameter'=> 'N'],'nama_parameter','@donePaymentEveryMonth');
		}
	}
	public function checkDatePaymentEveryMonth()
	{
		$datePayment = (int)$this->M->getParameter('@setDatePaymentDeadline');
		$dayOfMonth = date('j');
		if ($dayOfMonth == $datePayment && $this->M->getParameter('@donePaymentEveryMonth') == 'N') {

			$data_send_notif= ['start' => date('Y-m-d H:i:s'), 'handphone' => trim('08151654015'),'msg'=> 'Jalankan Scheduler Lock Login For EveryOne'];
			$this->service->send_whatsapp($data_send_notif, 'start_scheduler');

			$lockDB = $this->M->update_to_db('parameter',['value_parameter'=> 'Y'],'nama_parameter','@lockLoginForEveryOne');
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
		$this->service->send_whatsapp($data_send_notif, 'start_scheduler');
        // Force download the file
        // force_download($db_name, $backup);
    }
}
