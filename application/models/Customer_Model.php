<?php

class Customer_Model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = 'customers';
        $this->_primary_key = 'CustId';
    }

    public function get_primary_address($cust_id) {
        $this->_table_name = 'customers';
        $this->_primary_key = 'CustId';
        return $this->get_by(array('CustId' => $cust_id));
    }

    public function get_customeraddress($id) {
        $this->_table_name = 'customer_address';
        $this->_primary_key = 'CustAddId';
        return $this->get_by(array('CustId' => $id));
    }

    function get_customeraddress_by_CustAddId($caid) {
        $this->_table_name = 'customer_address';
        $this->_primary_key = 'CustAddId';
        return $this->get_by(array('CustAddId' => $caid));
    }

    function saveCustomerAdd($data) {
        $this->_table_name = 'customer_address';
        $this->_primary_key = 'CustAddId';
        return $this->save($data);
    }

    function updateCustomerAdd($data, $id) {
        $this->_table_name = 'customer_address';
        $this->_primary_key = 'CustAddId';
        return $this->save($data, $id);
    }

    function deleteCustomerAdd($id) {
        $this->_table_name = 'customer_address';
        $this->_primary_key = 'CustAddId';
        return $this->delete($id);
    }

    public function get_order_list() {
        $this->_table_name = 'customer_order';
        $this->_primary_key = 'OrderId';
        return $this->get_by(array('CustId' => $this->session->userdata('CustId')));
    }

    function get_attributes($id) {
        $sqlStr = "SELECT `order_attribute`.*
			FROM
			`order_attribute`
			INNER JOIN `order_detail` ON `order_attribute`.`OrderDetailId`=`order_detail`.`OrderItermId`
			WHERE `order_detail`.`OrderId`=$id
			";
        $query = $this->db->query($sqlStr);
        if ($query)
            return $query->result();
        else
            return 0;
    }

}
