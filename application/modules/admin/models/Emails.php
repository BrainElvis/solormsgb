<?php

class Emails extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    public function get_mails($offset = NULL, $num = NULL) {
        $sql = "select * from contact";
        if ($offset) {
            $sql .= " LIMIT $offset,$num";
        } else {
            $sql .= " LIMIT $offset,$num";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

}
