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
		header("Access-Control-Allow-Methods:GET,OPTIONS,POST");
		parent::__construct();
		$this->load->model('Mbg', 'M');
		$this->config->set_item('csrf_protection', false);
		$server_key = htmlspecialchars(addslashes($this->M->getParameter('@serverKeyMitrans')));
		$isProduction = $this->M->getParameter('@isProductionMitrans') === 'Y' ? true : false;
		$params = array('server_key' => $server_key, 'production' => $isProduction);
		$this->load->library('midtrans');
		$this->load->library('service');
		$this->midtrans->config($params);
		$this->load->helper('url');
    }

	public function index()
	{
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result);

		if($result){
			$statusCode = $result->status_code;
			$transaction = $result->transaction_status;
			$type = $result->payment_type;
			$order_id_va = $result->order_id;
			$fraud = $result->fraud_status;


			if ($transaction === 'settlement' && $statusCode === '200'){
				echo json_encode($this->updateVirtualAccount($order_id_va, $result));
			}
			if ($transaction === 'pending' && $statusCode === '201'){
				$this->M->update_to_db('order_payment',['status_payment' => 'G'],'id_virtual_account',$order_id_va);  
			}

		}
		// if ($transaction == 'capture') {
		//   // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		//   if ($type == 'credit_card'){
		// 	    if($fraud == 'challenge'){
		// 	      // TODO set payment status in merchant's database to 'Challenge by FDS'
		// 	      // TODO merchant should decide whether this transaction is authorized or not in MAP
		// 	      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
		// 	      $this->db->query("UPDATE voucherauto SET typetransfer = '$type', virtualAccount = '$va',statusBayar='D' WHERE idVoucherAuto = '$idVoucherAuto'");
		// 	      }else {
		// 	      // TODO set payment status in merchant's database to 'Success'
		// 	      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
		// 	      $this->db->query("UPDATE voucherauto SET typetransfer = '$type', virtualAccount = '$va',statusBayar='D' WHERE idVoucherAuto = '$idVoucherAuto'");
		// 	      }
		//     }
		// }else if ($transaction === 'settlement' && $statusCode === '200'){
		//   	$this->db->query("UPDATE voucherauto SET typetransfer = '$bank', virtualAccount = '$va_numbers',statusBayar='D' WHERE idVoucherAuto = '$order_id'");
		//   	if($type === 'qris'){
		//   		$this->db->query("UPDATE voucherauto SET typetransfer = '$type', virtualAccount = '00000000',statusBayar='D' WHERE idVoucherAuto = '$order_id'");
		//   	}
		// }else if($transaction === 'pending' && $statusCode === '201'){
		//  	$this->db->query("UPDATE voucherauto SET typetransfer = '$bank', virtualAccount = '$va_numbers',statusBayar='H' WHERE idVoucherAuto = '$order_id'");
		//  	if($type === 'qris'){
		//   		$this->db->query("UPDATE voucherauto SET typetransfer = '$type', virtualAccount = '00000000',statusBayar='H' WHERE idVoucherAuto = '$order_id'");
		//   	}
		// }else if ($transaction === 'expire' && $statusCode === '202') {
		//   	$this->db->query("UPDATE voucherauto SET typetransfer = '$bank', virtualAccount = '$va_numbers',statusBayar='E' WHERE idVoucherAuto = '$order_id'");
		//   	if($type === 'qris'){
		//   		$this->db->query("UPDATE voucherauto SET typetransfer = '$type', virtualAccount = '00000000',statusBayar='E' WHERE idVoucherAuto = '$order_id'");
		//   	}
		// }


		// if($transaction === 'pending' && $statusCode === '201' && $type === 'echannel'){

		// 	//for virtual acccount mandiri
		//  	$this->db->query("UPDATE voucherauto SET typetransfer = 'Mandiri', virtualAccount = '$bill_key',statusBayar='H' WHERE idVoucherAuto = '$order_id'");
		//  	if($type === 'qris'){
		//   		$this->db->query("UPDATE voucherauto SET typetransfer = '$type', virtualAccount = '00000000',statusBayar='H' WHERE idVoucherAuto = '$order_id'");
		//   	}
		// }

	}

	public function updateVirtualAccount($idOrderVADB, $result){

		$oP = $this->M->getWhere('order_payment',['id_virtual_account'=>trim($idOrderVADB)]);
		if($oP){
			$id_order = $oP['id_order_booking'];
			
	    	$data_update = [
	    		'payment_type' => $result->payment_type,
	    		'status_code' => $result->status_code,
	    		'status_message' => $result->status_message,
	    		'transaction_id' => $result->transaction_id,
	    		'transaction_status' => $result->transaction_status,
	    		'transaction_time' => $result->transaction_time,
	    		'va_nunmbers' => json_encode([
				        "bank" => $result->va_numbers[0]->bank,
				        "va_number" => $result->va_numbers[0]->va_number,
				]),
	    	];

	    	$update = $this->M->update_to_db('request_payment',$data_update,'order_id',$idOrderVADB);
			$updateOB = $this->M->update_to_db('order_payment',['status_payment' => 'D'],'id_virtual_account',$idOrderVADB);  
			$namaKelas = "";  	
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
	                        $namaKelas = trim($getListKelas['nama_kelas']);
							$user = $this->M->getWhere('user',['id_user'=>trim($orderBook['id_user'])]);
							$url = "";
							if($oP['sequence_payment'] == 1){
								$url = trim($getListKelas['link_group_wa']);
							}
							$data_send_notif = [
								'handphone' => trim($user['handphone']),
								'namalengkap' => trim($user['nama_lengkap']),
								'namaKelas' => trim($getListKelas['nama_kelas']),
								'metodeBayar' => trim($orderBook['metode_bayar']),
								'nominal_payment' => number_format(trim($orderPayment['nominal_payment']),2),
								'date_payment' => trim($orderPayment['date_payment']),
								'url_login' => trim(base_url('P/Admin')),
								'link_wa'=> trim($url),
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
							'namaKelas' => trim($namaKelas),
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
    	}else{
    		return ['status_code' => 400, 'msg' => 'ID not found'];
    	}
    }

    public function sendNotifWa()
    {
    	
    	$this->load->view('p/auth/sendNotifWa');
    }
    
    public function getUserIDLogic()
	{
	    $getUsersParam = $this->M->getParameter('@logicChooseUserCS');
	    $arrayUsers = explode(",", $getUsersParam);
	    $idUserLogic = $this->engineLogicPriorityCS();
	    $totalTry = 1; 

	    if ($idUserLogic == 0) {
	        for ($i = 0; $i < count($arrayUsers); $i++) {
	            $idUs = explode("-", $arrayUsers[$i]);
	            if ((int)$idUs[1] == 0) {
	                $totalTry++; 
	            }
	        }
	        if ($totalTry > 0) {
	            for ($i = 0; $i < $totalTry; $i++) {
	                $idUserLogic = $this->engineLogicPriorityCS(); 
	                if ($idUserLogic > 0) {
	                    break; 
	                }
	                sleep(2); 
	            }
	        }
	    }
	    return $idUserLogic;
	    // $arrayUsers = ['id_users' => $idUserLogic];
	    // echo json_encode($arrayUsers);
	}

    public function engineLogicPriorityCS()
	{
	    $date = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
	    $dateToday = $date->format('Y-m-d');
	    $getUsersParam = $this->M->getParameter('@logicChooseUserCS');
	    $arrayUsers = explode(",", $getUsersParam); // Example: 51-1-1,52-0-2,53-1-3
	    $cekData = $this->M->getLogicCSDB($dateToday);
	    $lastSequenceFromDB = $cekData == null ? 0 : $cekData[0]['sequence']; 
	    $totalUsersParam = count($arrayUsers);
	    $totalCheckData = count($cekData);
	    $choose_id_user = 0;
	    $seq = 0;
	    
	    $forFase = ceil($totalCheckData / $totalUsersParam);
	    $allPriority = ($forFase % 2 == 0);
	    if($cekData == null){
	        $allPriority = true;
	    }
	    for ($i = 0; $i < count($arrayUsers); $i++) {
	        $idUs = explode("-", $arrayUsers[$i]);
	        if (!$allPriority) {

	            // Handle user selection when not all priority
	            if ($lastSequenceFromDB == count($arrayUsers)) {
	                if ((int)$idUs[2] == 1) {
	                    $choose_id_user = (int)$idUs[0];
	                    $seq = 1;
	                    break;
	                }
	            } else {
	                if ((int)$idUs[2] == $lastSequenceFromDB + 1) {
	                    $choose_id_user = (int)$idUs[0];
	                    $seq = $lastSequenceFromDB + 1;
	                    break;
	                }
	            }
	        } else {
	            // Handle user selection when all priority
	            if ((int)$idUs[1] > 0) {
	                if ($lastSequenceFromDB == count($arrayUsers)) {
	                    if ((int)$idUs[2] == 1) {
	                        $choose_id_user = (int)$idUs[0];
	                        $seq = 1;
	                        break;
	                    }
	                } else {
	                    if ((int)$idUs[2] == $lastSequenceFromDB + 1) {
	                        $choose_id_user = (int)$idUs[0];
	                        $seq = $lastSequenceFromDB + 1;
	                        break;
	                    }
	                }
	            } else {
	                $seq = $lastSequenceFromDB + 1;
	            }
	        }
	    }

	    // Save the selected user and sequence to the database
	    $send_db = [
	        'id_user' => $choose_id_user,
	        'sequence' => $seq
	    ];
	    $this->M->add_to_db('logic_cs', $send_db);
	    // Log the chosen user for debugging
	    return $choose_id_user; // Return selected user ID
	}


}
