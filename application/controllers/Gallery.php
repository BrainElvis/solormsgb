<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery extends Site_Controller {
    function __construct() {
        parent::__construct();
        $this->template->set_layout('public');
        $this->site_title = 'Solo Rms';
        array_push($this->assets_css, 'gallery.css');
        array_push($this->assets_js, 'gallery.js');
        $this->load->model('Gallery_Model');
    }
    public function index() {
        $this->page_title = 'Gallery';
        $this->current_section = $this->lang->line('photogallery_heading');
        $this->body_class[] = 'home';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        $data['gallery_images']=$this->Gallery_Model->get_by(array('deleted'=>0, 'status'=>1));
        $this->render_page('gallery/index',$data);
    }
}