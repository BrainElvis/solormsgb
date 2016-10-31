<?php

class Order_Model extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_customer_order_busket($id) {
        $this->_table_name = 'customer_order_busket';
        $this->_primary_key = "OrderId";
        return $this->get($id, TRUE);
    }

    public function get_customer_order_detail_busket($orderid) {
        $this->_table_name = 'order_detail_busket';
        $this->_primary_key = "OrderItermId";
        return $this->get_by(array('OrderId' => $orderid));
    }

    public function get_customer_order_detail_attr_busket($OrderDetailId) {
        $this->_table_name = 'order_attribute_basket';
        $this->_primary_key = "OrderAttrId";
        return $this->get_by(array('OrderDetailId' => $OrderDetailId));
    }

    public function insert($table, $primary_key, $data) {
        $this->_table_name = $table;
        $this->_primary_key = $primary_key;
        return $this->save(objectToArray($data));
    }

}
