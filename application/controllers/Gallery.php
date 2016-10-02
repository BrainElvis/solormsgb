<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery extends Site_Controller {
    function __construct() {
        parent::__construct();
        $this->template->set_layout('public');
        $this->site_title = 'Solo Rms';
        array_push($this->assets_css, 'gallery.css');
        array_push($this->assets_js, 'gallery.js');
    }
    public function index() {
        $this->page_title = 'Gallery';
        $this->current_section = "Photo Gallery";
        $this->body_class[] = 'home';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        $this->render_page('gallery/index');
    }
}