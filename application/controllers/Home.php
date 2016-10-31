<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Site_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_layout('public');
        $this->site_title = $this->config->item('company');
        $this->load->model('Apimodel');
        $this->load->library('data');
    }

    public function index() {
        $data = [];
        $this->page_title = 'Home';
        $this->current_section = "Restaurant Home";
        $this->body_class[] = 'home';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        if ($this->config->item('home_slider') == 'on') {
            $this->template->set_partial('home_slider', 'home/subviews/slider');
        }
        if ($this->config->item('home_weserve') == 'on') {
            $this->template->set_partial('home_weserve', 'home/subviews/weserve');
        }
        if ($this->config->item('home_menucarousel') == 'on') {
            $this->template->set_partial('home_menucarousel', 'home/subviews/menucarousel');
        }
        if ($this->config->item('home_ourfeatures') == 'on') {
            $this->template->set_partial('home_ourfeatures', 'home/subviews/ourfeatures');
        }
        if ($this->config->item('home_testimonials') == 'on') {
            $this->template->set_partial('home_testimonials', 'home/subviews/testimonials');
        }
        //$this->data->clear_home_session();
        $restaurant_status = $this->data->get_rest_status();
        $rest_schedule = $this->data->get_rest_schedule();
        if (!$restaurant_status && !$rest_schedule) {
            $this->data->clear_home_session();
            if ($this->config->item('home_promotime') == 'on') {
                if ($this->data->get_rest_status() == '' || $this->data->get_rest_schedule() == '') {
                    $promotime = $this->Apimodel->get_promotime();
                    if (isset($promotime->status) && isset($promotime->message)) {
                        $this->data->set_api_status($promotime->status);
                        $this->data->set_api_message($promotime->message);
                    }
                    if (!empty($promotime->data)) {
                        $this->data->set_rest_status($promotime->data->restaurant_status);
                        $this->data->set_rest_schedule($promotime->data->rest_schedule);
                        $this->data->set_rest_promotion($promotime->data->rest_promotion);
                        $this->data->set_rest_vouchers($promotime->data->rest_vouchers);
                        $this->data->set_cities($promotime->data->cities);
                        $this->data->set_areas($promotime->data->areas);
                    }
                }
            }
        }
        $data['restaurant_status'] = $this->data->get_rest_status();
        $data['rest_schedule'] = $this->data->get_rest_schedule();
        $data['rest_promotion'] = $this->data->get_rest_promotion();
        $data['rest_vouchers'] = $this->data->get_rest_vouchers();
        $this->render_page('home/index', $data);
    }

}
