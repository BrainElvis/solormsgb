<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    /*
      Attempts to login Admin and set session. Returns boolean based on outcome.
     */

    function login($username, $password) {
        $query = $this->db->get_where('admin', array('username' => $username, 'password' => md5($password)), 1);
        if ($query->num_rows() == 1) {
            $row = $query->row();
            $this->session->set_userdata('user_id', $row->id);
            return true;
        }
        return false;
    }

    /*
      Logs out a user by destorying all session data and redirect to login
     */

    function logout() {
        $this->session->sess_destroy();
        redirect('admin/login');
    }

    /*
      Determins if a employee is logged in
     */

    function is_logged_in() {
        return $this->session->userdata('user_id') != false;
    }

    /*
      Gets information about the currently logged in employee.
     */

    function get_logged_in_admin_info() {
        if ($this->is_logged_in()) {
            return $this->get_info($this->session->userdata('user_id'));
        }
        return false;
    }

    function get_info($id) {
        $this->db->from('admin');
        $this->db->where('id', $id);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            //Get empty base parent object, as $user_id is NOT an admin
            $user_obj = parent::get_info(-1);
            //Get all the fields from admin table
            $fields = $this->db->list_fields('admin');
            //append those fields to base parent object, we we have a complete empty object
            foreach ($fields as $field) {
                $user_obj->$field = '';
            }
            return $user_obj;
        }
    }

}
