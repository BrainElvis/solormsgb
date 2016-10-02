<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Design
 *
 * @author Md.Aktaruzzaman
 */
class Design extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function form_advanced() {
        $this->load->view('design/form_advanced');
    }

}
