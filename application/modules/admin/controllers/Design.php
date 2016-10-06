<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Design extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function form_advanced() {
        $this->load->view('design/form_advanced');
    }

}
