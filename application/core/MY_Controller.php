<?php

class MY_Controller extends MX_Controller {

    public $appconfig;

    function __construct() {
        parent::__construct();
        $this->appconfig = $this->Appconfig->get_all()->result();
    }

    public function uploadimage($config) {
        $this->load->helper('directory');
        $config = $config;
        $this->load->library('upload', $config);
        $this->upload->do_upload('image');
        return strlen($this->upload->display_errors()) == 0 || !strcmp($this->upload->display_errors(), '<p>' . $this->lang->line('upload_no_file_selected') . '</p>');
    }

    public function prepareRegistrationData() {
        $items = [];
        foreach ($this->input->post() as $key => $value) {
            if ($key == 'CustPassword') {
                continue;
            }

            $items[] = $key;
        }
        $data = elements($items, $this->input->post());
        $data['CustPassword'] = md5($this->input->post('CustPassword'));
        return $data;
    }

    public function prepareData() {
        $items = [];
        foreach ($this->input->post() as $key => $value) {
            if ($key == 'submit_form' || $key == 'id') {
                continue;
            }
            $items[] = $key;
        }
        $data = elements($items, $this->input->post());
        return $data;
    }

}
