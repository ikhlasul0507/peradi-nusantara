<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_service {

    private $access_token = 'lIQtzhDvZsTDl-1dOoyVZBO39ggV1u67Swv7L8Y13ag';
    private $refresh_token = '';
    private $token_expiration_time = 0; // Timestamp for token expiration
    private $client_id = 'RRrn6uIxalR_QaHFlcKOqbjHMG63elEdPTair9B9YdY';
    private $client_secret = 'Sa8IGIh_HpVK1ZLAF0iFf7jU760osaUNV659pBIZR00';
    private $username = 'peradinusantarabydsa@gmail.com';
    private $password = '123Qwe#adt';

    public function __construct() {
        // Load necessary helpers
        $this->CI = &get_instance();
        $this->CI->load->helper('url');
    }

    // Function to get the access token
    public function get_token() {
        // Check if the token is expired or not set
        if ($this->is_token_expired()) {
            $this->refresh_access_token();
        }
        $this->access_token = 'lIQtzhDvZsTDl-1dOoyVZBO39ggV1u67Swv7L8Y13ag';
        return $this->access_token;
    }

    // Function to check if the token is expired
    private function is_token_expired() {
        return time() > $this->token_expiration_time;
    }

    // Function to refresh the access token
    private function refresh_access_token() {
        $url = "https://service-chat.qontak.com/oauth/token";

        $data = [
            'username' => $this->username,
            'password' => $this->password,
            'grant_type' => 'password',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'refresh_token' => $this->refresh_token // Use the refresh token
        ];

        $response = $this->curl_post_request($url, $data);

        // Parse the response
        $json_response = json_decode($response);

        if (isset($json_response->access_token)) {
            $this->access_token = $json_response->access_token;
            $this->refresh_token = $json_response->refresh_token;
            $this->token_expiration_time = time() + $json_response->expires_in;
        } else {
            // Handle error
            log_message('error', 'Failed to refresh token: ' . $response);
        }
    }

    public function get_whatsapp_broadcast_log($broadcast_id) {
        // Get the access token (it will refresh if expired)
        $access_token = $this->get_token();

        $url = "https://service-chat.qontak.com/api/open/v1/broadcasts/{$broadcast_id}/whatsapp/log";

        $response = $this->curl_get_request($url, $access_token);

        if ($response) {
            return $response;
        } else {
            return "Error retrieving broadcast log.";
        }
    }

    // Function to send the notification message
    public function send_notification($to_number, $to_name, $message_template_id, $channel_integration_id) {
        // Get the access token (it will refresh if expired)
        $access_token = $this->get_token();

        $url = "https://service-chat.qontak.com/api/open/v1/broadcasts/whatsapp/direct";
        $data = [
            'to_number' => $to_number,
            'to_name' => $to_name,
            'message_template_id' => $message_template_id,
            'channel_integration_id' => $channel_integration_id,
            'language' => [
                'code' => 'id'
            ]
            ,
            'parameters' => [
                'body' => [
                    // [
                    //     'key' => '1',
                    //     'value' => 'full_name',
                    //     'value_text' => $to_name
                    // ]
                ]
            ]
        ];

        $response = $this->curl_post_request($url, $data, $access_token);

        if ($response) {
            return $response;
        } else {
            return "Error sending notification.";
        }
    }

    // Function to send bulk notification
    public function send_bulk_notification($phone_numbers, $channel_integration_id) {
        // Validate phone numbers
        $valid_numbers = $this->validate_phone_numbers($phone_numbers);

        if (empty($valid_numbers)) {
            return "No valid phone numbers found.";
        }

        // Get the access token (it will refresh if expired)
        $access_token = $this->get_token();

        $url = "https://service-chat.qontak.com/api/open/v1/broadcasts/contacts";
        $data = [
            'channel_integration_id' => $channel_integration_id,
            'phone_numbers' => $valid_numbers
        ];

        $response = $this->curl_post_request($url, $data, $access_token);

        if ($response) {
            return $response;
        } else {
            return "Error sending bulk notification.";
        }
    }

    // Function to validate phone numbers
    private function validate_phone_numbers($phone_numbers) {
        $valid_numbers = [];
        $phone_regex = '/^\+?[1-9]\d{1,14}$/'; // Simple regex to validate phone numbers

        foreach ($phone_numbers as $number) {
            if (preg_match($phone_regex, $number)) {
                $valid_numbers[] = $number;
            }
        }

        return $valid_numbers;
    }

    // Function to get channel integrations
    public function get_channel_integrations() {
        $access_token = $this->get_token();
        $url = "https://service-chat.qontak.com/api/open/v1/integrations?target_channel=wa&limit=10";

        $response = $this->curl_get_request($url, $access_token);

        return json_decode($response); // Return decoded response
    }

    // Function to get message templates
    public function get_message_templates() {
        $access_token = $this->get_token();
        $url = "https://service-chat.qontak.com/api/open/v1/templates/whatsapp";

        $response = $this->curl_get_request($url, $access_token);

        return json_decode($response); // Return decoded response
    }

    // Helper function to perform the GET request with cURL (Using native PHP cURL)
    private function curl_get_request($url, $access_token) {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer $access_token"
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    // Helper function to perform the POST request with cURL (Using native PHP cURL)
    private function curl_post_request($url, $data, $access_token = '') {
        $ch = curl_init($url);

        $headers = ["Content-Type: application/json"];
        if ($access_token) {
            $headers[] = "Authorization: Bearer $access_token";
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
?>
