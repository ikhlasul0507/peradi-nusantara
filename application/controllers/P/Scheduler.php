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
	}
	public function index()
	{
		$this->startScheduler();
		
	}

	public function startScheduler()
	{
		$data_send_notif= ['start' => date('Y-m-d H:i:s'), 'handphone' => trim('082280524264'),'msg'=> 'Jalankan Scheduler'];
		$this->service->send_whatsapp($data_send_notif, 'start_scheduler');
		echo "startScheduler :" .date('Y-m-d H:i:s');
	}

	public function setUnpaidPayment()
	{
		$datePayment = (int)$this->M->getParameter('@setDatePaymentDeadline') + 1;
		$dayOfMonth = date('j');
		if ($dayOfMonth == $datePayment){
			$lockDB = $this->M->update_to_db('parameter',['value_parameter'=> 'N'],'nama_parameter','@donePaymentEveryMonth');
		}
	}
	public function checkDatePaymentEveryMonth()
	{
		$datePayment = (int)$this->M->getParameter('@setDatePaymentDeadline');
		$dayOfMonth = date('j');
		if ($dayOfMonth == $datePayment && $this->M->getParameter('@donePaymentEveryMonth') == 'N') {
			$lockDB = $this->M->update_to_db('parameter',['value_parameter'=> 'Y'],'nama_parameter','@lockLoginForEveryOne');
		}
	}
}
