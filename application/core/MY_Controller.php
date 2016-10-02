<?php

class MY_Controller extends MX_Controller {

    public $appconfig;

    function __construct() {
        parent::__construct();
        $this->appconfig = $this->Appconfig->get_all();
        debugPrint($this->appconfig);
    }

}
