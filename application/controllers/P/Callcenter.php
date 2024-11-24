<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Callcenter extends CI_Controller {

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
		parent::__construct();
		$this->load->model('Mbg', 'M');
		$this->load->library('midtrans');
		$this->load->library('service');
		$this->load->helper('url');
    }

    public function index()
    {
    	
    	$this->load->view('p/auth/sendNotifWa');
    }

    public function process_call_wa()
    {
    	$initial = $this->input->post("initial");
    	$namalengkap = $this->input->post("namalengkap");
    	$handphone = $this->input->post("handphone");

		$date = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
		$formattedDate = $date->format('Y-m-d H:i:s');

    	$call_center = $this->M->getWhere('history_call_center',['customer_phone'=>trim($handphone)]);
    	$sender = "";
    	$id_userWa = 0;
    	if($call_center){
    		$user = $this->M->getWhere('user',['id_user'=>trim($call_center['id_user'])]);
    		$sender = $user['handphone'];
    		$id_userWa = $user['id_user'];

    		$data_update = [
    			'last_call' => $formattedDate
    		];

    		$this->M->update_to_db('history_call_center', $data_update, 'id_user', trim($id_userWa));
    	}else{
    		//get number from user;	
    	
    		$id_userWa = $this->getUserIDLogic();
    		$user = $this->M->getWhere('user',['id_user'=>trim($id_userWa)]);
    		$sender = $user['handphone'];

    		//status_call_center : N (New Request), P (Process Request), H (Hold Request), F (Follow Up), D (Done Payment) 
    		$send_db = [
    			'id_user' => $id_userWa,
    			'customer_name' => $namalengkap,
    			'customer_phone' => preg_replace("/^08/", "628",$handphone),
    			'notes_call' => "",
    			'last_call' => $formattedDate,
    			'status_call_center' => "N"
    		];
    		$this->M->add_to_db('history_call_center', $send_db);
    	}
    	if($sender != ""){
	    	$link = "https://api.whatsapp.com/send/?phone=62".$sender."&text=Hai%2C+Saya+tertarik+dengan+kelas+peradi+nusantara+from+call+center&type=phone_number&app_absent=0";
    		redirect($link);
    	}
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

	public function sync()
	{
		redirect("P/Admin/call_center");
	}
}
