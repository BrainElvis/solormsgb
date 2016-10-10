<?php

defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL);

class Orderonline extends Site_Controller {

    public $apiReponseData;

    function __construct() {
        parent::__construct();
        $this->site_title = 'Solo Rms';
        $this->template->set_layout('public');
        $this->load->model('Orderonline_Model');
        $this->load->model('Apimodel');
    }

    public function index() {
        $data = [];
        $this->page_title = 'Online Order';
        $this->current_section = 'Order Online';
        $this->body_class[] = 'menu-order-online';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        $apiData = $this->Apimodel->get_api_data();
       // debugPrint($apiData);
        $data['api_status'] = $apiData->status;
        $data['api_message'] = $apiData->message;
        $apiData = objectToArray($apiData->data);
        //$apiData = $apiData->data;
        $data['apiData'] = $apiData;
        $this->render_page('orderonline/index', $data);
    }

    public function test() {

        $result = $this->Apimodel->get_test();
        debugPrint($result);
    }

}
