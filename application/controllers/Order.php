<?php

class Order extends Site_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Order_Model');
        $this->load->model('Apimodel');
        $this->template->set_layout('public');
        $this->site_title = $this->config->item('company');
    }

    public function process($busket_order = False) {
        $custInfo = $this->get_where('customers', array('CustId' => $this->session->userdata('CustId')))->row();
        $CustEmail = $custInfo->CustEmail;
        if ($busket_order && $busket_order == $this->session->userdata('busket_id')) {
            $customerBusket = $this->Order_Model->get_customer_order_busket($busket_order);
            $customerOrderDetailBusket = $this->Order_Model->get_customer_order_detail_busket($busket_order);
            $customerOrderDetailAttrBusket = array();
            if (!empty($customerOrderDetailBusket)) {
                foreach ($customerOrderDetailBusket as $CODB) {
                    $result = $this->Order_Model->get_customer_order_detail_attr_busket($CODB->OrderItermId);
                    if (!empty($result)) {
                        $customerOrderDetailAttrBusket[$CODB->OrderItermId] = $result;
                    }
                }
            }
            if ($customerBusket->PaymentMethod == 'cod') {
                $orderid = $this->_makeCODorder($customerBusket, $customerOrderDetailBusket, $customerOrderDetailAttrBusket);
                $MNOID = $this->Apimodel->makeRemotCODorder($customerBusket, $customerOrderDetailBusket, $customerOrderDetailAttrBusket, $CustEmail);
                if ($MNOID) {
                    $this->db->update('customer_order', array('MNOID' => $MNOID), array('OrderId' => $orderid));
                }
                $session_data['cart'] = NULL;
                $session_data['sp_details'] = NULL;
                $session_data['spdatails'] = NULL;
                $session_data['attrcart'] = NULL;
                $session_data['payment_info'] = NULL;
                $session_data['promocode'] = NULL;
                $session_data['promocodediscount'] = NULL;
                $session_data['donation'] = NULL;
                $session_data['donationval'] = NULL;
                $session_data['orderid'] = $orderid;
                $this->session->set_userdata($session_data);
                redirect("order/wait", "refresh");
            }
            if ($customerBusket->PaymentMethod == 'online') {
                $this->onlineorder($customerBusket, $customerOrderDetailBusket, $customerOrderDetailAttrBusket);
            }
        }
        else {
            redirect('home');
        }
    }

    private function _makeCODorder($customerBusket, $customerOrderDetailBusket, $customerOrderDetailAttrBusket) {
        $orderBusket = $customerBusket;
        unset($orderBusket->OrderId);
        $OrderId = $this->Order_Model->insert('customer_order', 'OrderId', $orderBusket);
        $CODABarray = array();
        foreach ($customerOrderDetailBusket as $CODB) {
            $CODB->OrderId = $OrderId;
            $preOrderItermId = $CODB->OrderItermId;
            unset($CODB->OrderItermId);
            $OrderDetailId = $this->Order_Model->insert('order_detail', 'OrderItermId', $CODB);
            if (!empty($customerOrderDetailAttrBusket)) {
                foreach ($customerOrderDetailAttrBusket as $key => $value) {
                    if ($preOrderItermId == $key) {
                        $CODABarray[$OrderDetailId] = $value;
                    }
                }
            }
        }

        if (!empty($CODABarray)) {
            foreach ($CODABarray as $key => $value) {
                foreach ($value as $att) {
                    unset($att->OrderAttrId);
                    $att->OrderDetailId = $key;
                    $this->Order_Model->insert('order_attribute', 'OrderAttrId', $att);
                }
            }
        }
        return $OrderId;
    }

    public function onlineorder() {
        //send payment gate way data to view  
    }

    public function onlinecallback() {
        
    }

    public function success() {
        
    }

    public function cancel() {
        
    }

    public function wait() {
        $data = [];
        $this->page_title = 'Wait';
        $this->current_section = "Wait";
        $this->body_class[] = 'order-wait';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        $this->render_page('order/wait');
    }

    function confirmatin_status() {
        $orderid = $this->session->userdata("orderid");
        $query = $this->db->get_where("customer_order", array(
            "OrderId" => $orderid
        ));
        $order = $query->row();
        $now_time = strtotime("-31 minutes");
        $order_time = strtotime($order->OrderDate);
        if ($order_time < $now_time && $order->Status < 1) {
            $this->load->model('ordermodel');
            $msg = "Restaurant Temporarily Unavailable.";
            if ($order->Status == 0) {
                $this->autoReject($order->OrderId);
            }
        }
        $restinfo = $this->session->userdata('rest_info'); //$this->db->query("select resturant_info.RestName from resturant_info left join resturant_service on resturant_info.RestId=resturant_service.RestId  where resturant_info.RestId='" . $order->RestId . "'")->row();
        if ($order->Status == 1) {
            echo '<h3 class="status" style="margin-bottom:15px;color: green; text-transform: uppercase; font-size:14px;">' . $this->lang->line('request_accomplished') . '</h3>';
            if ($order->OrderPolicyId == 2) {
                echo '<h3 class="status" style="color:#888; padding-bottom:20px;  font-size:12px;">Your order has been confirmed by "' . strtoupper($restinfo->RestName) . "\" <br/>and will be delivered to you around: " . show_date($order->DeliveryTime, FALSE, "g:i A") . ', ' . show_date($order->DeliveryTime, FALSE, "d/m/Y") . '</h3>';
            }
            else {
                echo '<h3 class="status" style="color:#888; font-size:12px;">Your order has been confirmed by "' . strtoupper($restinfo->RestName) . "\" <br/>and will be ready for collection around: " . show_date($order->DeliveryTime, FALSE, "g:i A") . ', ' . show_date($order->DeliveryTime, FALSE, "d/m/Y") . '</h3>';
            }
            if ($order->Summery != "") {
                echo '<div style="text-align:center; padding-bottom:10px; padding-top:20px; color: #777;">Message from restaurant: <br/><span style="font-size:10px; font-style:italic;">' . $order->Summery . '</span></div>';
            }
        }
        elseif ($order->Status == 4 || $order->Status == 3) {
            echo '<h3 class="status" style="color:#E89497;padding-bottom:20px; padding-top:30px;  font-size:12px;">Your order has been rejected by "' . strtoupper($restinfo->RestName) . '". </h3>';
            if ($order->Summery != "") {
                echo '<div style="text-align:center; padding-bottom:10px; color: #777;">Message from restaurant: <br/><span style="font-size:10px; font-style:italic;">' . $order->Summery . '</span></div>';
            }
        }
        else {
            echo '<h2 class="status">Please wait<br>Order is under Acknowledgement</h2>';
            echo '<div id="holder" class="wait-font2"> Or you can close the window and you will recive a confirmation in your email soon.</div>';
            echo '<table cellspacing="10px" cellpadding="0" width="100%"><tr><td width="41%" align="left"></td><td align="left"><img src="' . ASSETS_SITE_IMAGE_PATH . 'ajax-loader(3).gif" style="margin-left:10px" id="home_loader"  /></td></tr></table>';
        }
    }

}
