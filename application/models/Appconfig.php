<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Appconfig extends CI_Model {

    function exists($key) {
        $this->db->from('config');
        $this->db->where('config.key', $key);
        $query = $this->db->get();
        return ($query->num_rows() == 1);
    }

    function get_all() {
        $this->db->from('config');
        $this->db->order_by("key", "asc");
        return $this->db->get();
    }

    function get($key) {
        $query = $this->db->get_where('config', array('key' => $key), 1);

        if ($query->num_rows() == 1) {
            return $query->row()->value;
        }

        return "";
    }

    function save($key, $value) {
        $config_data = array(
            'key' => $key,
            'value' => $value
        );

        if (!$this->exists($key)) {
            return $this->db->insert('config', $config_data);
        }

        $this->db->where('key', $key);
        return $this->db->update('config', $config_data);
    }

    function batch_save($data) {
        $success = true;

        //Run these queries as a transaction, we want to make sure we do all or nothing
        $this->db->trans_start();
        foreach ($data as $key => $value) {
            if (!$this->save($key, $value)) {
                $success = false;
                break;
            }
        }

        $this->db->trans_complete();
        return $success;
    }

    function delete($key) {
        return $this->db->delete('config', array('key' => $key));
    }

    function delete_all() {
        return $this->db->empty_table('config');
    }

}

?>