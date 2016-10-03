<?php

class Login extends MX_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if ($this->Login_model->is_logged_in()) {
            redirect('home');
        }
        else {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('login');
            }
            else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                if ($this->login_check($username, $password)) {
                    redirect('admin');
                }
                else {
                    $message = 'Invalid username or password';
                    $this->load->view('login');
                }
            }
        }
    }

    function login_check($username, $password) {
        if (!$this->Login_model->login($username, $password)) {
            return false;
        }
        return true;
    }

}
