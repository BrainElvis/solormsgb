<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orderonline extends Site_Controller {

    public $apiReponseData;

    function __construct() {
        parent::__construct();
        $this->site_title = 'Solo Rms';
        $this->template->set_layout('public');
        $this->load->model('Orderonline_Model');
        
    
        $apiRequestedData = array(
            'restId' => $this->config->item('api_id'),
            'restApiKey' => $this->config->item('api_key'),
            'cusineName' => '',
            'testcookie' => 1,
            'restName' => $this->config->item('api_name'),
            'restUrl' => $this->config->item('api_website'),
            'restHost' => $this->config->item('api_host'),
        );
        $this->apiReponseData = $this->Orderonline_Model->get_api_data($apiRequestedData);
    }

    public function index() {
        $this->page_title = 'Online Order';
        $this->current_section = 'Order Online';
        $this->body_class[] = 'menu-order-online';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        $data = [];
        if (!empty($this->apiReponseData)) {
            $apiData = $this->apiReponseData;
            $data['apiData']=$apiData;
        }
        $this->render_page('orderonline/index', $data);
    }

}
