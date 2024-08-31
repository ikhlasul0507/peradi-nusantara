<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {

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
        $this->load->model('Mbg','M');
        $server_key = htmlspecialchars(addslashes($this->M->getParameter('@server_key')));
        $isProduction = $this->M->getParameter('@isProduction') === '1' ? true : false;
        $params = array('server_key' => $server_key, 'production' => $isProduction);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');
    }

	public function index()
	{
		echo 'test notification handler';
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result);

		if($result){
			$notif = $this->veritrans->status($result->order_id);
		}

		$transaction = $result->transaction_status;
		$type = $result->payment_type;
		$order_id = $result->order_id;
		$fraud = $result->fraud_status;
		$statusCode = $result->status_code;

		$va_numbers = $result->va_numbers[0]->va_number;
		$bank = $result->va_numbers[0]->bank;

		$bill_key = $result->bill_key;

		if ($transaction == 'capture') {
		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
			    if($fraud == 'challenge'){
			      // TODO set payment status in merchant's database to 'Challenge by FDS'
			      // TODO merchant should decide whether this transaction is authorized or not in MAP
			      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
			      $this->db->query("UPDATE voucherauto SET typetransfer = '$type', virtualAccount = '$va',statusBayar='D' WHERE idVoucherAuto = '$idVoucherAuto'");
			      }else {
			      // TODO set payment status in merchant's database to 'Success'
			      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
			      $this->db->query("UPDATE voucherauto SET typetransfer = '$type', virtualAccount = '$va',statusBayar='D' WHERE idVoucherAuto = '$idVoucherAuto'");
			      }
		    }
		}else if ($transaction === 'settlement' && $statusCode === '200'){
		  	$this->db->query("UPDATE voucherauto SET typetransfer = '$bank', virtualAccount = '$va_numbers',statusBayar='D' WHERE idVoucherAuto = '$order_id'");
		  	if($type === 'qris'){
		  		$this->db->query("UPDATE voucherauto SET typetransfer = '$type', virtualAccount = '00000000',statusBayar='D' WHERE idVoucherAuto = '$order_id'");
		  	}
		}else if($transaction === 'pending' && $statusCode === '201'){
		 	$this->db->query("UPDATE voucherauto SET typetransfer = '$bank', virtualAccount = '$va_numbers',statusBayar='H' WHERE idVoucherAuto = '$order_id'");
		 	if($type === 'qris'){
		  		$this->db->query("UPDATE voucherauto SET typetransfer = '$type', virtualAccount = '00000000',statusBayar='H' WHERE idVoucherAuto = '$order_id'");
		  	}
		}else if ($transaction === 'expire' && $statusCode === '202') {
		  	$this->db->query("UPDATE voucherauto SET typetransfer = '$bank', virtualAccount = '$va_numbers',statusBayar='E' WHERE idVoucherAuto = '$order_id'");
		  	if($type === 'qris'){
		  		$this->db->query("UPDATE voucherauto SET typetransfer = '$type', virtualAccount = '00000000',statusBayar='E' WHERE idVoucherAuto = '$order_id'");
		  	}
		}


		if($transaction === 'pending' && $statusCode === '201' && $type === 'echannel'){

			//for virtual acccount mandiri
		 	$this->db->query("UPDATE voucherauto SET typetransfer = 'Mandiri', virtualAccount = '$bill_key',statusBayar='H' WHERE idVoucherAuto = '$order_id'");
		 	if($type === 'qris'){
		  		$this->db->query("UPDATE voucherauto SET typetransfer = '$type', virtualAccount = '00000000',statusBayar='H' WHERE idVoucherAuto = '$order_id'");
		  	}
		}

	}
}
