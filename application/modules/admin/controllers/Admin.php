<?php

class Admin extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->site_title = 'Solo Rms';
        //array_push($this->assets_css, 'maps/jquery-jvectormap-2.0.3.css','floatexamples.css');
        //array_push($this->assets_js, 'datepicker/daterangepicker.js');
    }

    public function index() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Dashboard";
        $this->body_class[] = 'admin-dashboard';
        $this->render_page('admin/admin/index');
    }

    public function plain() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Plain Page";
        $this->body_class[] = 'Plain Page';
        $this->render_page('admin/admin/plain');
    }

    public function form() {
        $this->page_title = 'Form Test';
        $this->current_section = "Form Test";
        $this->body_class[] = 'Plain Page';
        $this->render_page('admin/admin/form');
    }

    function logout() {
        $this->Login_model->logout();
    }

}
