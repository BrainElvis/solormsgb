<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Orderonline_Model
 *
 * @author lenova
 */
class Orderonline_Model extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_api_data($apiRequestedData) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $apiRequestedData['restHost'] . 'soloapi/menu',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $apiRequestedData,
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        do {
            if (empty($output)) {
                $output = curl_exec($ch);
            }
            return $output;
        } while (!empty($output));
        curl_close($ch);
    }

    public function get_special_criteria($BaseId) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'soloapi/get_special_criteria',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => array('BaseId' => $BaseId),
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        return $output;
        curl_close($ch);
    }

}
