<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Site_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_layout('public');
        $this->site_title = 'Solo Rms';
    }

    public function index() {
        $this->page_title = 'Home';
        $this->current_section = "Restaurant Home";
        $this->body_class[] = 'home';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        if (1) {
            $this->template->set_partial('home_slider', 'home/subviews/slider');
        }
        if (1) {
            $this->template->set_partial('home_weserve', 'home/subviews/weserve');
        }
        if (1) {
            $this->template->set_partial('home_menucarousel', 'home/subviews/menucarousel');
        }
        if (1) {
            $this->template->set_partial('home_ourfeatures', 'home/subviews/ourfeatures');
        }
        if (1) {
            $this->template->set_partial('home_testimonials', 'home/subviews/testimonials');
        }

        $this->render_page('home/index');
    }

}
