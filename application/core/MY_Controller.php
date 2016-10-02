<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of MY_Controller
 *
 * @author lenova
 */
class MY_Controller extends MX_Controller {
    public $my_data=array('Public my data available in both site and admin');
    function __construct() {
	parent::__construct();
    }
}