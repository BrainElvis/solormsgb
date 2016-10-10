<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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

    public function inbox() {
        $this->load->model('Emails');
        $this->page_title = 'Dashboard';
        $this->current_section = "Inbox";
        $this->body_class[] = 'admin-inbox';
        $this->load->library('pagination');
        $config['base_url'] = base_url() . "admin/inbox/";
        $config['total_rows'] = 3;
        $config['per_page'] = 10; //$this->config->item('lines_per_page');
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a><strong>';
        $config['cur_tag_close'] = '</strong></a></li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $start = 1;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['inbox_mails'] = $this->Emails->get_mails($start - 1, $config['per_page']);
        //debugPrint($data);
        $this->render_page('admin/admin/inbox', $data);
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
