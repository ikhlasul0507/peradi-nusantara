<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webhook extends CI_Controller {

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
		$this->load->library('service');
		$this->load->helper('url');
    }

	public function index()
	{
		$json = file_get_contents('php://input');
		$data = json_decode($json, true);
		$device = $data['device'];
		$sender = $data['sender'];
		$message = $data['message'];
		$member= $data['member']; //group member who send the message
		$name = $data['name'];
		$location = $data['location'];
		//data below will only received by device with all feature package
		//start
		$url =  $data['url'];
		$filename =  $data['filename'];
		$extension=  $data['extension'];
		//end
		
		if ( $message == "test" ) {
			$reply = [
				"message" => "working great! ".$message ."|".$sender ."|".$name,
			];
		} elseif ( $message == "image" ) {
			$reply = [
				"message" => "image message",
				"url" => "https://filesamples.com/samples/image/jpg/sample_640%C3%97426.jpg",
			];
		} elseif ( $message == "audio" ) {
			$reply = [
			        "message" => "audio message",
				"url" => "https://filesamples.com/samples/audio/mp3/sample3.mp3",
				"filename" => "music",
			];
		} elseif ( $message == "video" ) {
			$reply = [
				"message" => "video message",
				"url" => "https://filesamples.com/samples/video/mp4/sample_640x360.mp4",
			];
		} elseif ( $message == "file" ) {
			$reply = [
				"message" => "file message",
				"url" => "https://filesamples.com/samples/document/docx/sample3.docx",
				"filename" => "document",
			];
		} else {
			$reply = [
				"message" => $message,
			];
		}

		$this->sendFonnte($sender, $reply);

	}

	public function sendFonnte($target, $data) {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.fonnte.com/send",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => array(
		    	'target' => $target,
		    	'message' => $data['message'],
		    ),
		  CURLOPT_HTTPHEADER => array(
		    "Authorization: UxptNbkURakM+D++6#sa"
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		return $response;
	}
}
