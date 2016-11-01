<?php

class Order extends Site_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Order_Model');
        $this->load->model('Apimodel');
        $this->template->set_layout('public');
        $this->site_title = $this->config->item('company');
        $this->load->model("Notification");
    }

    public function process($busket_order = False) {
        if (!$this->session->userdata('CustId')) {
            redirect('home');
        }
        $custInfo = $this->db->get_where('customers', array('CustId' => $this->session->userdata('CustId')))->row();
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
                $MNOID = $this->Apimodel->makeRemotCODorder($customerBusket, $customerOrderDetailBusket, $customerOrderDetailAttrBusket, $CustEmail);
                $orderid = $this->_makeCODorder($customerBusket, $customerOrderDetailBusket, $customerOrderDetailAttrBusket);
                if ($MNOID) {
                    $this->db->update('customer_order', array('MNOID' => $MNOID), array('OrderId' => $orderid));
                }
                if ($orderid && $MNOID) {
                    $this->sent_order_mail($orderid, $MNOID);
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
                    $session_data['MNOID'] = $MNOID;
                    $this->session->set_userdata($session_data);
                    redirect("order/wait", "refresh");
                }
            }
            if ($customerBusket->PaymentMethod == 'online') {
                $this->onlineorder($busket_order);
            }
        }
        else {
            redirect('home');
        }
    }

    public function onlineorder($BusketId) {
        $data['gateway'] = $gateway = strtolower($this->config->item('payment_gateway'));
        $data['paymentmode'] = $paymentmode = strtolower($this->config->item('payment_mode'));
        $data['merchant_id'] = $this->config->item('payment_merchant_id');
        $customer_order = $this->Order_Model->get_customer_order_busket($BusketId);
        $data['OrderId'] = $customer_order->OrderId;
        $data['total'] = $customer_order->total_price + $customer_order->HandlingFee + $customer_order->Vat + $customer_order->CCFee + $customer_order->DeliveryCost;
        $this->render_page('order/online/' . $gateway, $data);
    }

    public function nochex_callback() {
        $response = $this->_nochex_http_post("www.nochex.com", 80, "/nochex.dll/apc/apc", $_POST);
        $order_id = $_POST['order_id'];
        $isAuthorised = strstr($response, "AUTHORISED");
        if (isset($order_id) && $isAuthorised) {
            $this->db->update('customer_order_busket', array('PayStatus' => '1'), array('OrderId' => $order_id));
            $custInfo = $this->db->get_where('customers', array('CustId' => $this->session->userdata('CustId')))->row();
            $CustEmail = $custInfo->CustEmail;
            $customerBusket = $this->Order_Model->get_customer_order_busket($order_id);
            $customerOrderDetailBusket = $this->Order_Model->get_customer_order_detail_busket($order_id);
            $customerOrderDetailAttrBusket = array();
            if (!empty($customerOrderDetailBusket)) {
                foreach ($customerOrderDetailBusket as $CODB) {
                    $result = $this->Order_Model->get_customer_order_detail_attr_busket($CODB->OrderItermId);
                    if (!empty($result)) {
                        $customerOrderDetailAttrBusket[$CODB->OrderItermId] = $result;
                    }
                }
            }
            $MNOID = $this->Apimodel->makeRemotCODorder($customerBusket, $customerOrderDetailBusket, $customerOrderDetailAttrBusket, $CustEmail);
            $orderid = $this->_makeCODorder($customerBusket, $customerOrderDetailBusket, $customerOrderDetailAttrBusket);
            if ($MNOID) {
                $this->db->update('customer_order', array('MNOID' => $MNOID), array('OrderId' => $orderid));
            }
            if ($orderid && $MNOID) {
                $session_data['orderid'] = $orderid;
                $session_data['MNOID'] = $MNOID;
                $this->session->set_userdata($session_data);
                $this->sent_order_mail($orderid, $MNOID);
            }
            redirect('order/success');
        }
    }

    public function success() {
        $session_data['cart'] = NULL;
        $session_data['sp_details'] = NULL;
        $session_data['spdatails'] = NULL;
        $session_data['attrcart'] = NULL;
        $session_data['payment_info'] = NULL;
        $session_data['promocode'] = NULL;
        $session_data['promocodediscount'] = NULL;
        $session_data['donation'] = NULL;
        $session_data['donationval'] = NULL;
        $this->session->set_userdata($session_data);
        redirect("order/wait", "refresh");
    }

    public function cancel() {
        redirect('orderonline');
    }

    private function sent_order_mail($orderid, $MNOID = False) {
        $this->load->library('email');
        $this->load->library("my_cart", array('orid' => $orderid));
        $cart = $this->my_cart->get();
        $cust_order = $this->db->get_where('customer_order', array('OrderId' => $orderid))->row();
        $rest_info = $this->session->userdata('rest_info');
        $cust_info = $this->db->get_where('customers', array('CustId' => $this->session->userdata('CustId')))->row();
        $email_template = $this->Notification->get_email_template();
        $body_txt = $this->orderdetails_email($cart, $cust_order, $rest_info, $cust_info, $MNOID);
        $body_txt = str_replace('BODY_TEXT', $body_txt, $email_template);
        $config['wordwrap'] = false;
        $config['mailtype'] = 'html';
        $config['protocol'] = 'sendmail';
        $this->email->initialize($config);
        $this->email->from($this->config->item('email'), $this->config->item('company'));
        $this->email->to(array($cust_info->CustEmail, $this->config->item('email'), 'info@munchnow.co.uk'));
        //$this->email->cc('info@munchnow.co.uk');
        $this->email->subject($this->config->item('company') . ' Order #' . $orderid . "-" . $MNOID);
        $this->email->message($body_txt);
        $this->email->send();
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

    public function wait() {
        $data = [];
        $this->page_title = 'Wait';
        $this->current_section = "Wait";
        $this->body_class[] = 'order-wait';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        $orderid = $this->session->userdata('orderid');
        $order = $this->db->get_where('customer_order', array('OrderId' => $orderid, 'CustId' => $this->session->userdata('CustId')))->row();
        $this->render_page('order/wait', $order);
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

    private function orderdetails_email($cart, $cust_order, $rest_info, $cust_info, $MNOID = False) {
        $grand_total = $cart["total"];
        $dt = explode(' ', $cust_order->OrderDate);
        $dd = explode('-', $dt[0]);
        $tt = explode(':', $dt[1]);
        $orderdate_time = date('d/m/Y H:i:s', mktime($tt[0], $tt[1], $tt[2], $dd[1], $dd[2], $dd[0]));
        $dt = explode(' ', $cust_order->DeliveryTime);
        $dd = explode('-', $dt[0]);
        $tt = explode(':', $dt[1]);
        $delivery_time = date('d/m/Y H:i:s', mktime($tt[0], $tt[1], $tt[2], $dd[1], $dd[2], $dd[0]));
        if ($cust_order->OrderPolicyId == "1") {
            $order_type = "Pick Up Order";
        }
        else {
            $order_type = "Delivery Order";
        }
        $cities = $this->session->userdata('cities');
        $areas = $this->session->userdata('areas');
        foreach ($cities as $city) {
            $cityList[$city->CityId] = $city->CityName;
        }
        if ($areas) {
            foreach ($areas as $area) {
                $areaList[$area->AreaId] = $area->AreaName;
            }
        }
        $resturant_address = /* $rest_info->Building. ', ' . */ $areaList[$rest_info->AreaId] . ", " . $cityList[$rest_info->City] . ", " . strtoupper($rest_info->ZipCode) . ". Phone: " . $rest_info->Contact;
        if ($cust_order->PaymentMethod != "cod") {
            $payment_status = "Paid";
            $payment_method = "Online";
        }
        else {
            $payment_method = "Cash On Delivery";
            $payment_status = "Not Paid";
        }
        $body_txt = '
                <table  cellpadding="0" cellspacing="0" width="500">
                  <tbody>
<tr>
                       <td style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif;font-size:13px; color:#666;padding-left:28px;padding-top:18px;" >Dear ' . $cust_info->CustFirstName . ' ' . $cust_info->CustLastName . ',</td>
                             
                   </tr>                         
                <tr>
                      <td style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif;font-size:13px; color:#666;padding-top:20px;padding-left:28px;padding-top:18px;">Please find the verification of your order below:</td>
                </tr>    
                <tr>
                      <td style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif;font-size:13px; color:#393F4D;padding-top:0px;font-weight:bold;padding-left:28px;">Restaurant: ' . $rest_info->RestName . '<br />Order Number: ' . order_id($cust_order->OrderId) . "#" . order_id($MNOID) . '</td>
                 
                   </tr>    
                ';
        if ($cust_order->OrderPolicyId == "2") {
            $body_txt .= '    
                <tr>
                      <td style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif;font-size:13px; color:#666;padding-left:28px;padding-top:18px;">Time of delivery requested: ' . $delivery_time . '</td>
                </tr>';
        }
        $body_txt .= '   <tr>
                      <td style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif;font-size:13px; color:#666;padding-left:28px;padding-top:18px;">Order Type: ' . $order_type . '</td>
                </tr>   
                 
                <tr>
                      <td style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif;font-size:13px; color:#666;padding-left:28px;padding-top:0px;">Order Date: ' . $orderdate_time . '<br />Payment: ' . $payment_method . ' ( ' . $payment_status . ' )</td>
                </tr>';
        if ($cust_order->OrderPolicyId == "1") {
            $body_txt .= '  <tr>
                      <td style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif;font-size:13px; color:#393F4D;padding-left:28px;padding-top:18px;font-weight:bold;">Pick Up Address:</td>
                </tr>           
                 <tr>
                      <td style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif;font-size:13px;padding-left:28px;padding-top:0px; color:#666;padding-top:0px;">' . $rest_info->RestName . '<br />' . $resturant_address . '<br /> </td>
                </tr>   </table>        ';
        }
        else {
            $body_txt .= '  <tr>
                      <td style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif;font-size:13px; color:#393F4D;padding-left:28px;padding-top:18px;font-weight:bold;">Delivery Address:</td>
                </tr>           
                 <tr>
                      <td style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif;font-size:13px;padding-left:28px;padding-top:0px; color:#666;padding-top:0px;">' . $cust_info->CustFirstName . ' ' . $cust_info->CustLastName . '<br />' . $cust_order->OrderAdd1 . ' ' . $cust_order->OrderAdd2 . ' ' . $areaList[$cust_order->OrderAddArea] . ' ' . $cityList[$cust_order->OrderAddTown] . ' ' . $cust_order->OrderAddPostcode . '<br /><a href="mailto:' . $cust_info->CustEmail . '" style="color:#C1272D;">' . $cust_info->CustEmail . '</a>, ' . $cust_order->CustTelephone . '</td>
                </tr>    </table>       ';
        }
        $body_txt .= '<br /><table border="0" cellspacing="0" cellpadding="0" style="overflow:hidden;border:2px solid #393F4D;border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; margin-top:10px; padding-bottom:16px;">
                    
                   <thead bgcolor="#393F4D">
                           
                        <tr>
                            <td width="268" height="34" bgcolor="#393F4D" valign="middle"  style="border-right:1px solid #c7c7c7;padding-left:12px;font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#fff;font-weight:bold;">Product Name
                            </td>
                            <td width="70"  height="34" bgcolor="#393F4D" valign="middle" style="border-right:1px solid #c7c7c7;padding-left:12px;font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#fff;font-weight:bold;">Price
                            </td>
                            <td width="70"  height="34" bgcolor="#393F4D" valign="middle" style="border-right:1px solid #c7c7c7;padding-left:12px;font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#fff;font-weight:bold;">Quantity
                            </td>
                            <td width="70"  height="34" bgcolor="#393F4D" valign="middle" style="padding-left:12px;font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#fff;font-weight:bold;">Sub Total
                            </td>
                        </tr>
                            
                   </thead>
                   <tbody>';
        foreach ($cart["items"] as $item) {
            $body_txt .= '<tr><td width="268" height="24"  style="border-bottom:1px solid #c7c7c7;border-right:1px solid #c7c7c7;padding-left:12px;font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:26px;">';
            $body_txt .= $item["title"] . "<br>" . $item['attr'];
            $body_txt .= '</td><td width="70"  height="24"  style="border-bottom:1px solid #c7c7c7;border-right:1px solid #c7c7c7;padding-left:12px;font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:26px;">';
            $body_txt .= to_currency($item["price"] + $item['attrprice']);
            $body_txt .= '</td><td width="70"  height="24"  style="border-bottom:1px solid #c7c7c7;border-right:1px solid #c7c7c7;text-align:center; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:26px;">';
            $body_txt .= $item["quanity"];
            $body_txt .= '</td><td width="70"  height="24"  style="border-bottom:1px solid #c7c7c7;border-right:1px solid #c7c7c7;padding-left:12px;font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:26px;">';
            $body_txt .= to_currency(($item["quanity"] * ($item["price"] + $item['attrprice'])));
            $body_txt .= '</td></tr>';
        }
        $body_txt .= '   <tr>
                            <td colspan="3"  height="24" align="right" style="padding-top:8px;padding-right:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;font-weight:bold;">Order total:
                            </td>
                           
                            <td  height="24"   style="padding-left:12px;  padding-top:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;">' . to_currency($grand_total) . '
                            </td> </tr> ';
        if ($cust_order->OrderTotalDiscount > 0) {
            $body_txt .= '
                            <tr>  
                                <td colspan="3"  height="24"  align="right" style="padding-top:8px;padding-right:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;font-weight:bold;">Order Discount:</td>
                                <td   style="padding-left:12px; padding-top:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;">' . to_currency($cust_order->OrderTotalDiscount) . ' </td>   
                            </tr>   ';
        }
        if ($cust_order->PromocodePrice > 0) {
            $body_txt .= ' 
                                <tr>  
                                    <td colspan="3"   height="24" align="right" style="padding-top:8px;padding-right:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;font-weight:bold;">Promotion Discount:</td>
                                    <td  height="24"  style="padding-left:12px; padding-top:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;">' . to_currency($cust_order->PromocodePrice) . ' </td>   
                                </tr>   ';
        }
        $body_txt .= ' 
                                <tr>  
                                    <td colspan="3"  height="24" align="right" style="padding-top:8px;padding-right:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;font-weight:bold;">Sub total:</td>
                                    <td    height="24" style="padding-left:12px; padding-top:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;">' . to_currency($grand_total) . ' </td>   
                                </tr>   ';
        if ($cust_order->OrderPolicyId == "2") {
            $body_txt .= ' 
                                    <tr>  
                                        <td colspan="3"  height="24" align="right" style="padding-top:8px;padding-right:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;font-weight:bold;">Delivery Charge:</td>
                                        <td  height="24"  style="padding-left:12px; padding-top:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;">' . to_currency($cust_order->DeliveryCost) . ' </td>   
                                    </tr>   ';
            $grand_total += $cust_order->DeliveryCost;
        }
        if ($cust_order->HandlingFee > 0.00) {
            $body_txt .= ' 
                                    <tr>  
                                        <td colspan="3"  height="24"  align="right" style="padding-top:8px;padding-right:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;font-weight:bold;">Handling Fees:</td>
                                        <td   height="24" style="padding-left:12px; padding-top:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;">' . to_currency($cust_order->HandlingFee) . ' </td>   
                                    </tr>   ';
            $grand_total += $cust_order->HandlingFee;
        }
        if ($cust_order->CCFee > 0) {
            $body_txt .= ' 
                                    <tr>  
                                        <td colspan="3"  height="24"  align="right" style="padding-top:8px;padding-right:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;font-weight:bold;">CC Fees:</td>
                                        <td  height="24"  style="padding-left:12px; padding-top:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;">' . to_currency($cust_order->CCFee) . ' </td>   
                                    </tr>   ';
            $grand_total += $cust_order->CCFee;
        }
        if ($cust_order->Vat >= 0) {
            $body_txt .= ' 
                                        <tr>  
                                            <td colspan="3"   height="24" align="right" style="padding-top:8px;padding-right:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;font-weight:bold;">Tax:</td>
                                            <td  height="24"  style="padding-left:12px; padding-top:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;">' . to_currency($cust_order->Vat) . ' </td>   
                                        </tr>   ';
            $grand_total += $cust_order->Vat;
        }
        $body_txt .= ' 
                                        <tr>  
                                            <td colspan="3"  height="24" align="right" style="padding-top:8px;padding-right:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;font-weight:bold;">Grand Total:</td>
                                            <td  height="24"  style="padding-left:12px; padding-top:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;">' . to_currency($grand_total) . ' </td>   
                                        </tr>   ';
        if ($cust_order->BalanceDeduction > 0.00) {
            $body_txt .= ' 
                                        <tr>  
                                            <td colspan="3"  height="24" align="right" style="padding-top:8px;padding-right:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;font-weight:bold;">Deduction from account balance:</td>
                                            <td   height="24" style="padding-left:12px; padding-top:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;">' . to_currency($cust_order->BalanceDeduction) . ' </td>   
                                        </tr>   ';
            $grand_total = $grand_total - $cust_order->BalanceDeduction;
        }
        $body_txt .= '          
                          
                        <tr>
                            <td colspan="4"><div style="margin-top:8px;border-top:2px solid #000;"></div>
                            </td>
                        </tr>
                         <tr>
                            <td colspan="3"  align="right" style="padding-top:8px;padding-right:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;font-weight:bold;">Total:
                            </td>
                           
                            <td   style="padding-left:12px; padding-top:8px; font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#464646;line-height:18px;">' . to_currency($grand_total) . ' 
                            </td>
                        </tr>
                    </tbody>
                    
                                    
                  </table>
  ';
        return $body_txt;
    }

    private function _nochex_http_post($server, $port, $url, $vars) {
        // get urlencoded vesion of $vars array 
        $urlencoded = "";
        foreach ($vars as $Index => $Value) // loop round variables and encode them to be used in query
            $urlencoded .= urlencode($Index) . "=" . urlencode($Value) . "&";
        $urlencoded = substr($urlencoded, 0, -1);   // returns portion of string, everything but last character

        $headers = "POST $url HTTP/1.0\r\n"  // headers to be sent to the server
                . "Content-Type: application/x-www-form-urlencoded\r\n"
                . "Host: www.nochex.com\r\n"
                . "Content-Length: " . strlen($urlencoded) . "\r\n\r\n";  // length of the string

        $fp = fsockopen($server, $port, $errno, $errstr, 10);  // returns file pointer
        if (!$fp)
            return "ERROR: fsockopen failed.\r\nError no: $errno - $errstr";  // if cannot open socket then display error message
        fputs($fp, $headers);  //writes to file pointer
        fputs($fp, $urlencoded);
        $ret = "";
        while (!feof($fp))
            $ret .= fgets($fp, 1024); // while it’s not the end of the file it will loop 
        fclose($fp);  // closes the connection
        return $ret; // array 
    }

}
