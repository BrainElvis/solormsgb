<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if ($this->Login_model->is_logged_in()) {
            redirect('admin');
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('login');
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                if ($this->Login_model->login($username, $password)) {
                    redirect('admin');
                } else {
                    $data['message'] = $this->lang->line('login_invalid_username_and_password');
                    $this->load->view('login', $data);
                }
            }
        }
    }

}
