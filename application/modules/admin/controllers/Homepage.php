<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends Admin_Controller {

    function __construct() {
        parent::__construct('config');
        $this->site_title = 'Solo Rms';
        //array_push($this->assets_css, 'maps/jquery-jvectormap-2.0.3.css','floatexamples.css');
        //array_push($this->assets_js, 'datepicker/daterangepicker.js');
    }

    public function slider() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Slider";
        $this->body_class[] = 'home-slider';
        $this->render_page('admin/homepage/slider');
    }

    public function weserve() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Homepage What We Do ";
        $this->body_class[] = 'home-weserve';
        $this->render_page('admin/homepage/weserve');
    }

    public function menucarousel() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Horizontal Menu Carousel";
        $this->body_class[] = 'home-menucarousel';
        $this->render_page('admin/homepage/menucarousel');
    }

    public function ourfeatures() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Our Features";
        $this->body_class[] = 'home-our-features';
        $this->render_page('admin/homepage/ourfeatures');
    }

    public function testimonials() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Client Testimonials";
        $this->body_class[] = 'home-testimonials';
        $this->render_page('admin/homepage/testimonials');
    }

}
