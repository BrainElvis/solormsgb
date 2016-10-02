<?php

error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends Site_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_layout('public');
        $this->site_title = 'Solo Rms';
        array_push($this->assets_css, 'popcss/jquery.fancybox.css', 'popcss/jquery.fancybox-buttons.css', 'popcss/jquery.fancybox-thumbs.css', 'datepicker.css', 'tab.css');
        array_push($this->assets_js, 'popjs/jquery.fancybox.js', 'popjs/jquery.fancybox-buttons.js', 'popjs/jquery.fancybox-media.js', 'bootstrap-datepicker.js', 'popjs/custom.js');
    }

    public function index() {
        $this->page_title = 'Online Order';
        $this->current_section = "Online Order'";
        $this->body_class[] = 'menu';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        $this->render_page('menu/index');
        /* $ch = curl_init();
          $postData = array(
          'restId' => 3,
          'restApiKey' => 'secretpassword',
          'cusineName' => '',
          'testcookie' => 1
          );
          curl_setopt_array($ch, array(
          CURLOPT_URL => API_URL,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POST => true,
          CURLOPT_POSTFIELDS => $postData,
          CURLOPT_FOLLOWLOCATION => true
          ));
          $output = curl_exec($ch);
          if (!empty($output)) {
          $restMenuData = json_decode($output);
          curl_close($ch);
          }
          echo "<pre>";
          print_r($restMenuData);
          echo "</pre>";
         */
    }

    public function home() {
        $this->render_page('menu/index');
    }

}
