<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Apimodel
 *
 * @author Md.Aktaruzzaman
 */
class Apimodel extends CI_Model {

    public $requestedData;

    function __construct() {
        parent::__construct();
        $this->load->library('rest');
        $config = array('server' => $this->config->item('api_host'),
            'api_key' => $this->config->item('api_key'),
            'api_name' => 'API-KEY'
                //'http_user' 		=> 'username',
                //'http_pass' 		=> 'password',
                //'http_auth' 		=> 'basic',
                //'ssl_verify_peer' => TRUE,
                //'ssl_cainfo' 		=> '/certs/cert.pem')
        );
        $this->rest->initialize($config);
        $this->requestedData['api_rest_id'] = $this->config->item('api_id');
        $this->requestedData['api_rest_name'] = $this->config->item('api_name');
        $this->requestedData['api_rest_url'] = $this->config->item('api_website');
        $this->requestedData['api_rest_host'] = $this->config->item('api_host');
        $this->requestedData['api_username'] = $this->config->item('api_username');
        $this->requestedData['api_password'] = $this->config->item('api_password');
        $this->requestedData['api_key'] = $this->config->item('api_key');
    }

    public function get_api_data() {
        return $this->rest->post('api/restauratdata', $this->requestedData);
    }

    public function get_promotime() {
        return $this->rest->post('api/promotime', $this->requestedData);
    }

}
