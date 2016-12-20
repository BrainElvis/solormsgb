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
        $this->load->library('data');
    }

    public function index() {
        $data = [];
        $this->page_title = 'Online Order';
        $this->current_section = 'Order Online';
        $this->body_class[] = 'menu-order-online';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        $restinfo = $this->data->get_rest_info();
        $order_policy = $this->data->get_order_policy();
        if (empty($restinfo) || empty($order_policy)) {
            $this->data->clear_menupage_session();
            $apiData = $this->Apimodel->get_api_data();
            $this->data->set_api_status($apiData->status);
            $this->data->set_api_message($apiData->message);
            $this->data->set_rest_status($apiData->data->restaurant_status);
            $this->data->set_rest_info($apiData->data->rest_info);
            $this->data->set_order_policy($apiData->data->order_policy);
            $this->data->set_membership($apiData->data->membership);
            $this->data->set_pre_hide_status($apiData->data->pre_hide_status);
            $this->data->set_cuisines($apiData->data->cuisines);
            $this->data->set_deliverypolicy($apiData->data->deliverypolicy);
            $this->data->set_deliveryarea($apiData->data->deliveryarea);
            $this->data->set_delarea($apiData->data->delarea);
            $this->data->set_schedule($apiData->data->schedule);
            $this->data->set_categories($apiData->data->categories);
            $this->data->set_bases($apiData->data->bases);
            $this->data->set_selections($apiData->data->selections);
        }
        $data['api_status'] = $this->data->get_api_status();
        $data['api_message'] = $this->data->get_api_message();
        $data['restaurant_status'] = $this->data->get_rest_status();
        $data['rest_info'] = objectToArray($this->data->get_rest_info());
        $data['order_policy'] = objectToArray($this->data->get_order_policy());
        $data['membership'] = objectToArray($this->data->get_membership());
        $data['pre_hide_status'] = $this->data->get_pre_hide_status();
        $data['cuisines'] = objectToArray($this->data->get_cuisines());
        $data['deliverypolicy'] = objectToArray($this->data->get_deliverypolicy());
        $data['deliveryarea'] = objectToArray($this->data->get_deliveryarea());
        $data['delarea'] = $this->data->get_delarea();
        $data['schedule'] = $this->data->get_schedule();
        $data['categories'] = objectToArray($this->data->get_categories());
        $data['bases'] = objectToArray($this->data->get_bases());
        $data['selections'] = objectToArray($this->data->get_selections());
        $this->render_page('orderonline/index', $data);
    }

    public function test() {
        $result = $this->Apimodel->get_test();
        debugPrint($result);
    }

}
