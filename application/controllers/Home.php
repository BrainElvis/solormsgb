<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Site_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_layout('public');
        $this->site_title = 'Solo Rms';
        $this->load->model('Apimodel');
    }

    public function index() {
        $data = [];
        $this->page_title = 'Home';
        $this->current_section = "Restaurant Home";
        $this->body_class[] = 'home';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        //debugPrint($this->config);

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
        if ($this->config->item('home_promotime')=='on') {
            $data['promotime'] = $promotime = objectToArray($this->Apimodel->get_promotime());
            
        }
        $this->render_page('home/index', $data);
    }

}
