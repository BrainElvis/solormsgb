<?php

class User_Model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = 'customers';
    }

    function get_verification_method() {
        $sql = "SELECT * FROM verification_method";
        $query = $this->db->query($sql);
        $data = $query->result();
        return $data[0]->verification_by;
    }

    function validate($name, $password) {
        $this->db->where('CustEmail', $name, TRUE);
        $this->db->where('CustPassword', $password, TRUE);
        $query = $this->db->get("customers");
        if (count($query->result()) > 0) {
            $result = $query->num_rows();
            return $result;
        }
        else {
            return 0;
        }
    }

    function logincutomerinfo($username) {
        $query = $this->db->get_where('customers', array(
            'CustEmail' => $username
        ));
        if ($query)
            return $query->result();
        else
            return false;
    }

    public function get_area_list($city) {
        $areas = array();
        if ($this->session->userdata('areas')) {
            $areas = $this->session->userdata('areas');
        }
        $ecity = array();
        if (!empty($areas)) {
            foreach ($areas as $area) {
                if ($area->CityId == $city && $area->status == 1) {
                    $ecity[] = $area;
                }
                else {
                    continue;
                }
            }
        }
        return $ecity;
    }

    public function showmycart() {
        $data = array();
        return $this->load->view('user/partial/mycart', $data, true);
    }

    function getdataforid($idname, $idvalue, $table, $order_by_field = NULL, $order_by_type = "ASC") {
        if ($order_by_field != NULL and $order_by_type != NULL)
            $this->db->order_by($order_by_field, $order_by_type);
        $this->db->where($idname, $idvalue);
        $query = $this->db->get($table);
        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    function deletedata($idname, $idvalue, $table) {
        $this->db->where($idname, $idvalue);
        if ($this->db->delete($table)) {
            return "Successfully Deleted";
        }
        else {
            return "Delete Failed";
        }
    }

    function modify_customer_address($cust_info, $as_new_add) {
        $data = array(
            'CustFirstName' => $cust_info->CustFirstName,
            'CustLastName' => $cust_info->CustLastName,
            'CustAdd1' => $cust_info->CustAdd1,
            'CustAdd2' => $cust_info->CustAdd2,
            'CustTown' => $cust_info->CustTown,
            'County' => $cust_info->CustState,
            'CustPostcode' => $cust_info->CustPostcode,
            'CustPhone' => $cust_info->CustTelephone,
            'CustAddLabel' => $cust_info->CustAddLabel
        );
        if ($this->session->userdata('CustId')) {
            if ($as_new_add) {
                $data_n = $data;
                $data_n['CustId'] = $this->session->userdata('CustId');
                $this->db->insert('customer_address', $data_n);
                $data['CustEmail'] = $this->session->userdata('CustEmail');
                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_URL => $this->config->item('api_host') . 'api/add_address',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $data,
                    CURLOPT_FOLLOWLOCATION => true
                ));
                $output = curl_exec($ch);
                curl_close($ch);
                //return $output;
            }
        }
    }

}
