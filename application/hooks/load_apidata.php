<?php

class Apidata {

    private $ApiObj;

    function __construct() {
        $this->ApiObj = & get_instance();
    }

    public function menu() {
        $CI = $this->ApiObj;
        $ch = curl_init();
        $postData = array(
            'restId' =>$CI->config->item('api_id') ,
            'restApiKey' => $CI->config->item('api_key'),
            'cusineName' => '',
            'testcookie' => 1,
            'restName' => $CI->config->item('api_name'),
            'restUrl' => $CI->config->item('api_webisite'),
            'restHost' => $CI->config->item('api_host'),
        );

        curl_setopt_array($ch, array(
            CURLOPT_URL =>$CI->config->item('api_host').'menu',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_FOLLOWLOCATION => true
        ));

        $output = curl_exec($ch);
        if (!empty($output)) {
            $CI->config->set_item('menu_items', serialize($output));
            curl_close($ch);
        }
    }

}
