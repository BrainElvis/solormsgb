<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_cart {

    var $cart = false;

    function MY_cart($busket = false) {
        $CI = & get_instance();
        $total = 0;
        $actual_total = 0;
        $items = array();
        $orid = $busket['orid'];
        if ($orid > 0) {
            $query = $CI->db->get_where("customer_order", array(
                "OrderId" => $orid
            ));
            if ($query->num_rows() > 0) {
                $customer_order_busket = $query->result();
            }
            $pay_discount = $customer_order_busket[0]->BalanceDeduction + $customer_order_busket[0]->OrderTotalDiscount + $customer_order_busket[0]->DeliveryDiscount + $customer_order_busket[0]->PromocodePrice;
            $query = $CI->db->get_where("order_detail", array(
                "OrderId" => $orid
            ));
            if ($query->num_rows() > 0) {
                $order_detail_busket = $query->result();
                $i = 0;
                foreach ($order_detail_busket as $record) {
                    $items[$i]["quanity"] = $record->total_qty;
                    $items[$i]["price"] = ($record->BaseUnitPrice == 0) ? $record->SelectionUnitPrice : $record->BaseUnitPrice;
                    $items[$i]["mainprice"] = ($record->BaseMainPrice == 0) ? $record->SelectionMainPrice : $record->BaseMainPrice;
                    $items[$i]["title"] = $record->CatName . ' - ' . $record->BaseName . ' - ' . $record->SelectionName;
                    $attrquery = $CI->db->get_where("order_attribute", array(
                        "OrderDetailId" => $record->OrderItermId
                    ));
                    $attrprice = 0;
                    $attrdetails = '';
                    if ($attrquery->num_rows() > 0) {
                        $order_attr_busket = $attrquery->result();
                        foreach ($order_attr_busket as $attrrecord) {
                            $attrdetails .= ',' . $attrrecord->OrderAttrName;
                            $attrprice += $attrrecord->AttrQty * $attrrecord->OrderAttrUnitPrice;
                        }
                    }
                    $items[$i]["attr"] = $attrdetails;
                    $items[$i]["attrprice"] = $attrprice;
                    $total += ($items[$i]["price"] * $items[$i]["quanity"]) + $attrprice;
                    $i++;
                }
            }
        }
        if (!isset($customer_order_busket)) {
            return false;
        }
        $this->cart = array(
            "items" => $items,
            "total" => $customer_order_busket[0]->total_price,
            "totaldiscount" => $pay_discount
        );
    }

    function get() {
        return $this->cart;
    }

}

?>
