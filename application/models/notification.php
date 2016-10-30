<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Notification extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function get_configuration($key) {
        $std           = new stdClass();
        $query         = $this->db->get_where("configuration", array(
            "configuration_key" => $key
        ));
        $row           = $query->row();
        $std->message  = $row->configuration_description;
        $reciever      = explode("|", $row->configuration_value);
        $std->reciever = array(
            "admin" => $reciever[0],
            "restaurant_owner" => $reciever[1],
            "customer" => $reciever[2]
        );
        return $std;
    }
    function get_email_template() {
        $query = $this->db->get_where("configuration", array(
            "configuration_key" => "EMAIL_TEMPLATE"
        ));
        if ($query->num_rows() > 0) {
            $row      = $query->row();
            $template = $row->configuration_value;
        } else {
            $template = '';
        }
        return $template;
    }
    function via_email($service_settings, $rest_info, $message, $order_id) {
        if ($service_settings->Email == '') {
            $QUERY   = $this->db->get_where("owner_registration", array(
                'OwnerId' => $rest_info->OwnerId
            ));
            $owner   = $QUERY->row();
            $toEmail = $owner->Email;
        } else {
            $toEmail = $service_settings->Email;
        }
        $config['wordwrap'] = false;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from(SITE_EMAIL, SHORT_SITE_NAME);
        $this->email->to($toEmail);
        $this->email->subject('Order #' . $order_id . ' from munchnow');
        $this->email->message($message);
        $this->email->send();
    }
    function via_fax($service_settings, $cart, $cust_order, $rest_info, $cust_info) {
        $grand_total = $cart["total"];
        $messages    = 'Online Order from ' . FULL_SITE_NAME . '<br />';
        $messages .= 'Order No:' . order_id($cust_order->OrderId) . '<br />';
        $messages .= 'Order Date & Time: 	' . show_date($cust_order->OrderDate, false, 'd/m/Y H:is') . '	<br />';
        if ($cust_order->OrderPolicyId == "2") {
            $messages .= 'Order Type: 	Order Delivery <br />';
            $messages .= 'Delivery Time: ' . show_date($cust_order->DeliveryTime, false, 'd/m/Y H:is') . '<br /><br />';
        } else {
            $messages .= 'Order Type: 	Order Pick Up <br />';
            $messages .= 'Pick Up Time: ' . show_date($cust_order->DeliveryTime, false, 'd/m/Y H:is') . '<br /><br />';
        }
        $messages .= 'Restaurant Name' . $rest_info->RestName . '<br />';
        $messages .= 'Restaurant Address: ' . $rest_info->Street . ", " . $rest_info->ZipCode . ", " . $rest_info->City . '<br />';
        $messages .= 'Restaurant Tel No:' . $rest_info->Contact . '<br />';
        $payment_status = ($cust_order->PaymentMethod != "cod") ? "Paid" : "Not paid";
        $messages .= 'Payment Status: 	' . $payment_status . '<br /><br />';
        $messages .= 'Customer Address:<br />';
        $messages .= 'Name:' . $cust_info->CustFirstName . ' ' . $cust_info->CustLastName . '<br />';
        $messages .= 'Address 1:' . $cust_info->CustAdd1 . '<br />';
        $messages .= 'Address 2:' . $cust_info->CustAdd2 . '<br />';
        $messages .= 'City/Town:' . $cust_info->CustTown . '<br />';
        $messages .= 'State:' . $cust_info->CustState . '<br />';
        $messages .= 'County: 	LetsEat<br />';
        $messages .= 'Post Code:' . $cust_info->CustPostcode . '<br />';
        $messages .= 'Fax:' . $cust_info->CustFax . '<br />';
        $messages .= 'Phone:' . $cust_info->CustTelephone . '<br />';
        $messages .= 'Email:' . $cust_info->CustEmail . '<br /><br />';
        $messages .= 'Delivery Address:<br />';
        $messages .= 'Address 1:' . $cust_order->OrderAdd1 . '<br />';
        $messages .= 'Address 2: ' . $cust_order->OrderAdd2 . '<br />';
        $messages .= 'City/Town: ' . $cust_order->OrderAddTown . '<br />';
        $messages .= 'State: ' . $cust_order->OrderAddState . '<br />';
        $messages .= 'County: 	LetsEat<br /><br />';
        $messages .= 'Product Name - Price - Quantity -	Sub Total<br />';
        foreach ($cart["items"] as $item) {
            $messages .= $item["title"] . ' - ' . number_format($item["price"], 2, '.', '') . ' - ' . $item["quanity"] . ' - ' . number_format(($item["quanity"] * $item["price"]), 2, '.', '');
        }
        $messages .= 'Handling Fees - ' . number_format($cust_order->HandlingFee, 2, '.', '') . '<br />';
        $grand_total += $cust_order->HandlingFee;
        if ($cust_order->OrderPolicyId == "2") {
            $messages .= 'Delivery Cost - ' . number_format($cust_order->DeliveryCost, 2, '.', '') . '<br />';
            $grand_total += $cust_order->DeliveryCost;
        }
        if ($cust_order->BalanceDeduction > 0) {
            $messages .= 'Deduction from balance (-) ' . number_format($cust_order->BalanceDeduction, 2, '.', '') . '<br />';
            $grand_total = $grand_total - $cust_order->BalanceDeduction;
        }
        $messages .= '-------------------------------------------------------------<br />';
        $messages .= 'Total - ' . number_format($grand_total, 2, '.', '') . '<br />';
        $messages .= '<br />Customer Comments:';
        $config['wordwrap'] = false;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from(SITE_EMAIL, SHORT_SITE_NAME);
        $this->email->to($service_settings->FaxNo);
        $this->email->subject('Order Notification');
        $this->email->message($messages);
        $this->email->send();
    }
    function via_machine($service_settings, $cart, $cust_order, $rest_info, $cust_info) {
        $grand_total = $cart["total"];
        $messages    = 'Online Order from ' . FULL_SITE_NAME . '<br />';
        $messages .= 'Order No:' . order_id($cust_order->OrderId) . '<br />';
        $messages .= 'Order Date & Time: 	' . show_date($cust_order->OrderDate, false, 'd/m/Y H:is') . '	<br />';
        if ($cust_order->OrderPolicyId == "2") {
            $messages .= 'Order Type: 	Order Delivery <br />';
            $messages .= 'Delivery Time: ' . show_date($cust_order->DeliveryTime, false, 'd/m/Y H:is') . '<br /><br />';
        } else {
            $messages .= 'Order Type: 	Order Pick Up <br />';
            $messages .= 'Pick Up Time: ' . show_date($cust_order->DeliveryTime, false, 'd/m/Y H:is') . '<br /><br />';
        }
        $messages .= 'Restaurant Name' . $rest_info->RestName . '<br />';
        $messages .= 'Restaurant Address: ' . $rest_info->Street . ", " . $rest_info->ZipCode . ", " . $rest_info->City . '<br />';
        $messages .= 'Restaurant Tel No:' . $rest_info->Contact . '<br />';
        $payment_status = ($cust_order->PaymentMethod != "cod") ? "Paid" : "Not paid";
        $messages .= 'Payment Status: 	' . $payment_status . '<br /><br />';
        $messages .= 'Customer Address:<br />';
        $messages .= 'Name:' . $cust_info->CustFirstName . ' ' . $cust_info->CustLastName . '<br />';
        $messages .= 'Address 1:' . $cust_info->CustAdd1 . '<br />';
        $messages .= 'Address 2:' . $cust_info->CustAdd2 . '<br />';
        $messages .= 'City/Town:' . $cust_info->CustTown . '<br />';
        $messages .= 'State:' . $cust_info->CustState . '<br />';
        $messages .= 'County: 	LetsEat<br />';
        $messages .= 'Post Code:' . $cust_info->CustPostcode . '<br />';
        $messages .= 'Fax:' . $cust_info->CustFax . '<br />';
        $messages .= 'Phone:' . $cust_info->CustTelephone . '<br />';
        $messages .= 'Email:' . $cust_info->CustEmail . '<br /><br />';
        $messages .= 'Delivery Address:<br />';
        $messages .= 'Address 1:' . $cust_order->OrderAdd1 . '<br />';
        $messages .= 'Address 2: ' . $cust_order->OrderAdd2 . '<br />';
        $messages .= 'City/Town: ' . $cust_order->OrderAddTown . '<br />';
        $messages .= 'State: ' . $cust_order->OrderAddState . '<br />';
        $messages .= 'County: 	LetsEat<br /><br />';
        $messages .= 'Product Name - Price - Quantity -	Sub Total<br />';
        foreach ($cart["items"] as $item) {
            $messages .= $item["title"] . ' - ' . number_format($item["price"], 2, '.', '') . ' - ' . $item["quanity"] . ' - ' . number_format(($item["quanity"] * $item["price"]), 2, '.', '');
        }
        $messages .= 'Handling Fees - ' . number_format($cust_order->HandlingFee, 2, '.', '') . '<br />';
        $grand_total += $cust_order->HandlingFee;
        if ($cust_order->OrderPolicyId == "2") {
            $messages .= 'Delivery Cost - ' . number_format($cust_order->DeliveryCost, 2, '.', '') . '<br />';
            $grand_total += $cust_order->DeliveryCost;
        }
        if ($cust_order->BalanceDeduction > 0) {
            $messages .= 'Deduction from balance (-) ' . number_format($cust_order->BalanceDeduction, 2, '.', '') . '<br />';
            $grand_total = $grand_total - $cust_order->BalanceDeduction;
        }
        $messages .= '-------------------------------------------------------------<br />';
        $messages .= 'Total - ' . number_format($grand_total, 2, '.', '') . '<br />';
        $messages .= '<br />Customer Comments:';
        $config['wordwrap'] = false;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from(SITE_EMAIL, SHORT_SITE_NAME);
        $this->email->to($service_settings->PrintCode);
        $this->email->subject('Order Notification');
        $this->email->message($messages);
        $this->email->send();
    }
    function via_gprs($service_settings, $cart, $cust_order, $rest_info, $cust_info) {
        $CI =& get_instance();
        return true;
    }
    function via_sms($service_settings, $cart, $cust_order, $rest_info, $cust_info) {
        $this->db->where(array(
            "CustId" => $cust_info->CustId,
            "PayStatus" => '1'
        ));
        $customer_prev_total = $this->db->count_all_results("customer_order");
        foreach ($cart["items"] as $item) {
            $product_title = ($item["attr"] == '') ? $item["title"] : $item["title"] . "[ " . $item["attr"] . " ]";
            $product_price = ($item["price"] + $item["attrprice"]) * $item["quanity"];
            $items[]       = $item["quanity"] . ',' . str_replace(',', ' ', $product_title) . ',' . number_format($product_price, 2, '.', " ");
        }
        $grand_total = $cust_order->total_price;
        $PayStatus   = ($cust_order->PayStatus == 1) ? 6 : 7;
        $OrderPolicy = ($cust_order->OrderPolicyId == 1) ? 2 : (($cust_order->OrderPolicyId == 2) ? 1 : 3);
        $IsVerified  = ($cust_info->CustStatus == 1) ? 4 : 5;
        if ($cust_order->OrderPolicyId == 2) {
            $order_type       = "delivery";
            $customer_address = $cust_order->OrderAdd1;
            $customer_address .= ($cust_order->OrderAddTown != "") ? ' ' . $cust_order->OrderAddTown : '';
            $customer_address .= ($cust_order->OrderAddPostcode != "") ? ' ' . $cust_order->OrderAddPostcode : '';
        } else {
            $order_type       = "Pick Up";
            $customer_address = $cust_info->CustAdd1;
            $customer_address .= ($cust_info->CustTown != "") ? ' ' . $cust_info->CustTown : '';
            $customer_address .= ($cust_info->CustPostcode != "") ? ' ' . $cust_info->CustPostcode : '';
        }
        $lines      = str_replace(" - ", " ", "%23" . $cust_order->RestId . "*" . $OrderPolicy . "*" . $cust_order->OrderId . "*" . implode(';', $items) . "*" . number_format($cust_order->DeliveryCost, 2, '.', " ") . ";" . number_format(($cust_order->HandlingFee + $cust_order->CCFee), 2, '.', " ") . ";" . number_format($grand_total, 2, '.', " ") . ";" . $IsVerified . ";" . str_replace(',', ' ', $cust_info->CustFirstName . ' ' . $cust_info->CustLastName) . ";" . str_replace(array(
            ',',
            ';'
        ), ' ', $customer_address)) . ";" . date("H:i", strtotime($cust_order->DeliveryTime)) . ' ' . date("d-m-y", strtotime($cust_order->OrderDate)) . ";" . $customer_prev_total . ";" . $PayStatus . ";" . $cust_order->PaymentMethod . ":" . $cust_order->AuthorizationCode . ";" . $cust_info->CustTelephone . "*" . str_replace(';', ' ', str_replace("-", "", $cust_order->CustComments)) . "%23";
        $lines      = str_replace(' ', '+', $lines);
        $sms_length = strlen($lines);
        if ($sms_length > 160) {
            $concat = "&concat=" . ceil($sms_length / 160);
        } else {
            $concat = NULL;
        }
        $user     = "PUT_USER_NAME";
        $password = "PSS_GOES_HERE";
        $api_id   = "API_ID";
        $sms_url  = "http://api.clickatell.com/http/sendmsg?user=$user&password=$password&api_id=$api_id&to=" . $service_settings->PrintCode . '&text=' . $lines . $concat;
        if (file($sms_url)) {
        }
    }
}
