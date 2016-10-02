<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Site_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_layout('public');
        $this->site_title = 'Solo Rms';
    }

    public function index() {
        $this->page_title = 'Contact';
        $this->current_section = "Contact us";
        $this->body_class[] = 'contact';
        $this->page_meta_keywords = 'Online,order, Restaurant, Contact ';
        $this->page_meta_description = 'Contact for online Order at Restaurant';
        $this->render_page('contact/index');
    }

}
