<?php

class User extends Site_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_layout('public');
        $this->site_title = $this->config->item('company');
        $this->load->model('User_Model');
        $this->load->model('Apimodel');
        $this->load->library('data');
        $this->load->model("Notification");
        $this->load->library('email');
        $this->load->model('Customer_Model');
    }

    function checkout() {
        $data = [];
        $this->page_title = 'Checkout';
        $this->current_section = "Checkout";
        $this->body_class[] = 'customer-login';
        $data['mycart'] = $this->User_Model->showmycart();
        $data['cust_info'] = $this->Customer_Model->get_primary_address($this->session->userdata('CustId'));
        $data['cust_address'] = $this->Customer_Model->get_customeraddress($this->session->userdata['CustId']);
        $order_prepared_time = 0;
        $raw_openingtime = $this->session->userdata('raw_openingtime');
        if (!$this->session->userdata('deliverytype')) {
            $this->session->set_userdata('deliverytype', 1);
        }
        $opening_time = array();
        foreach ($raw_openingtime as $ro) {
            if ($ro->PolicyId == $this->session->userdata('deliverytype')) {
                $opening_time[] = $ro;
            }
        }
        $data['opening_time'] = $opening_time; //$this->Usermodel->get_openingtime($restid, $this->session->userdata('deliverytype'));
        $order_time = array();
        $prev_day = strtolower(date('D', strtotime("-1 day")));
        foreach ($data['opening_time'] as $index => $row) {
            $new_slot = array();
            if ($row->EndHr > 23 && $row->WeekDay == $prev_day) {
                $new_slot["start"] = strtotime("00:00");
                $new_slot_end_hr = ( $row->EndHr - 24 );
                $new_slot_end_min = ( $row->EndMin );
                $new_slot["end"] = strtotime("$new_slot_end_hr:$new_slot_end_min");
                array_push($order_time, $new_slot);
            }
            elseif ($row->EndHr > 23) {
                $new_slot["start"] = ( $row->StartHr == 23 && $row->StartMin == 60 ) ? strtotime($row->StartHr . ":" . ( $row->StartMin - 1 )) : strtotime($row->StartHr . ":" . $row->StartMin);
                $new_slot["end"] = strtotime("23:59");
                array_push($order_time, $new_slot);
                $extra_slot = array();
                $extra_slot["start"] = strtotime("+1 day 00:00");
                $new_slot_end_hr = ( $row->EndHr - 24 );
                $new_slot_end_min = ( $row->EndMin );
                $extra_slot["end"] = strtotime("+1 day $new_slot_end_hr:$new_slot_end_min");
                array_push($order_time, $extra_slot);
            }
            else {
                $new_slot["start"] = ( $row->StartHr == 23 && $row->StartMin == 60 ) ? strtotime($row->StartHr . ":" . ( $row->StartMin - 1 )) : strtotime($row->StartHr . ":" . $row->StartMin);
                $new_slot["end"] = ( $row->EndHr == 23 && $row->EndMin == 60 ) ? strtotime($row->EndHr . ":" . ( $row->EndMin - 1 )) : strtotime($row->EndHr . ":" . $row->EndMin);
                array_push($order_time, $new_slot);
            }
            $data["order_start"] = ( $order_time[$index]['start'] <= time() && $order_time[$index]['end'] >= time() ) ? $order_time[$index]['start'] : $data["order_start"];
        }
        $order_times = array();
        $today = date('d');
        foreach ($order_time as $row) {
            $data["order_start"] = ( $row['start'] >= time() && $data["order_start"] == '' ) ? $row['start'] : ( ( $row['end'] < time() ) ? $row['start'] : $data["order_start"] );
            $slot_start_time = ( $today == date('d', $row['start']) ) ? time() + ( 60 * $order_prepared_time ) : $row['start'];
            for ($time = $slot_start_time; $time <= $row['end']; $time += ( 60 * 5 )) {
                if (( 60 * $order_prepared_time ) + time() > $time) {
                    continue;
                }
                $order_times[] = $time;
            }
        }
        sort($order_times);
        $data['order_times'] = $order_times;
        $this->render_page('user/checkout', $data);
    }

    public function process() {
        $custid = $this->session->userdata('CustId');
        if ($custid) {
            $abc = $this->User_Model->getdataforid('CustId', $custid, 'customers');
            $data['custinfo'] = $abc[0];
            $order_busket = $this->User_Model->getdataforid('CustId', $custid, 'customer_order_busket');
            if (!empty($order_busket)) {
                $orderid = $order_busket[0]->OrderId;
                $order_details_busket = $this->User_Model->getdataforid('OrderId', $orderid, 'order_detail_busket');
                if (!empty($order_details_busket) && isset($order_details_busket[0]->OrderItermId)) {
                    $orderdetailsid = $order_details_busket[0]->OrderItermId;
                    $this->User_Model->deletedata('OrderDetailId', $orderdetailsid, 'order_attribute_basket');
                }
                $this->User_Model->deletedata('OrderId', $orderid, 'order_detail_busket');
                $this->User_Model->deletedata('CustId', $custid, 'customer_order_busket');
            }
        }
        if ($this->input->post('preorder')) {
            $d1 = explode('_', $this->input->post('orderdate'));
            $d = $d1[1];
            $day = date("Y-m-d", strtotime("$now, +$d day"));
            $deltime = date($day . " H:i:s", $this->input->post('preorder'));
        }
        else {
            if ($this->input->post('time_type') == "asap") {
                $deltime = ( $this->input->post("asap") != "" ) ? date("Y-m-d H:i:s", $this->input->post("asap")) : date("Y-m-d H:i:s", strtotime("+1 hour"));
            }
            else {
                $deltime = ( $this->input->post("order_time") != "" ) ? date("Y-m-d H:i:s", $this->input->post("order_time")) : date("Y-m-d H:i:s", strtotime("+1 hour"));
            }
        }
        $grand_total = $total_wcom = $this->session->userdata('cart_item_total');
        $globaldiscountObj = $this->session->userdata('globaldiscount'); //$this->db->get('order_del_email')->row()->globaldiscount;
        $gdiscount_total = ($grand_total * $globaldiscountObj->globaldiscount / 100);
        $rpromo = 0;
        $restPromotions = array();
        if ($this->session->userdata('rest_promotion')) {
            $restPromotions = $this->session->userdata('rest_promotion');
        }
        $tdiscount = 0;
        if (!empty($restPromotions)) {
            if (count($cdis) && $cdis[0]->CrossPromotion == "0") {
                foreach ($restPromotions as $promoObj) {
                    if ($grand_total >= $promoObj->MinAmount) {
                        $rpromo = $promoObj->Discount * 100;
                        break;
                    }
                }
                $newDiscount_total = ($grand_total * $rpromo / 100);
                $tdiscount = $gdiscount_total + $newDiscount_total;
            }
            else {
                foreach ($restPromotions as $promoObj) {
                    if ($total_wcom >= $promoObj->MinAmount) {
                        $rpromo = $promoObj->Discount * 100;
                        break;
                    }
                }
                $newDiscount_total = ($total_wcom * $rpromo / 100);
                $tdiscount = $gdiscount_total + $newDiscount_total;
            }
        }
        $new_total = $grand_total - $tdiscount;
        $item_total = $grand_total;
        $order_total_d = $new_total;
        $order_total_discount = $grand_total - $new_total;
        $Promocode = '';
        $PromocodeProvider = $this->config->item('api_id');
        $voucher_cost = 0;
        if ($this->session->userdata('promocodediscount')) {
            $voucher_cost = $this->session->userdata('promocodediscount');
        }
        if ($this->session->userdata('promocode')) {
            $Promocode = $this->session->userdata('promocode');
        }

        $final_promo_discount = $voucher_cost;
        $subtotal = $order_total_d - $voucher_cost;
        $final_total = $subtotal;
        $delivery_plan = $this->Apimodel->get_delivery_plan_new($this->session->userdata('sinput'), $grand_total);

        $final_del_cost = 0;
        $vat = 0;
        $del_cost=0;
        if (!empty($delivery_plan)) {
            $final_del_cost = $del_cost = $delivery_plan->delivery_cost;
            if ($this->session->userdata('deliverytype') == 2) {
                $final_total += $final_del_cost;
                $vat = $_SESSION['carttax'] + ( $delivery_plan->delivery_cost * $delivery_plan->taxOnDeliveryCharge ) / 100;
            }
        }
        if ($this->session->userdata('deliverytype') == 1) {
            $final_del_cost = 0;
            $del_cost = 0;
            $vat = $_SESSION['carttax'];
        }
       
        $final_total += $vat;
        $paymethod = 'cod';
        if (isset($_POST['pay_mathod'])) {
            $paymethod = $_POST['pay_mathod'];
        }
        if ($paymethod != 'cod') {
            $data['cc_fee'] = $cc_fee = $globaldiscountObj->CCFee;
        }
        else {
            $data['cc_fee'] = $cc_fee = 0;
        }
        $final_total += $cc_fee;
        $data['paymethod'] = $paymethod;
        $hfee = $globaldiscountObj->HFee;
        $final_total += $hfee;
        $final_charity_id = 0;
        $charity_donation = 0;
        $final_total += $charity_donation;
        $from_balance = 0;
        $data['deduction_from_balance'] = $from_balance;
        $final_total -= $from_balance;
        $negative_balance = 0;
        if ($final_total < 0) {
            $negative_balance = $final_total;
            $final_total = 0;
        }
        $cust_info = new stdClass();
        if ($this->session->userdata('deliverytype') == 2) {
            $cust_info->CustFirstName = $this->input->post('cust_fname');
            $cust_info->CustLastName = $this->input->post('cust_lname');
            $cust_info->CustAdd1 = $this->input->post('customers_address1');
            $cust_info->CustAdd2 = $this->input->post('customers_address2');
            $cust_info->CustTown = $this->input->post('customers_town');
            $cust_info->CustPostcode = $this->input->post('customers_postcode');
            $cust_info->CustArea = $this->input->post('customers_area');
            $cust_info->CustTelephone = $this->input->post('customers_telephone');
            $cust_info->CustAddLabel = $this->input->post('customers_address_label');
        }
        else {
            $customers_info = $this->db->query("SELECT * FROM customers where CustId='" . $this->session->userdata('CustId') . "'")->row();
            $cust_info->CustFirstName = $customers_info->CustFirstName;
            $cust_info->CustLastName = $customers_info->CustLastName;
            $cust_info->CustAdd1 = $customers_info->CustAdd1;
            $cust_info->CustAdd2 = $customers_info->CustAdd2;
            $cust_info->CustTown = $customers_info->CustTown;
            $cust_info->CustState = $customers_info->County;
            $cust_info->CustPostcode = $customers_info->CustPostcode;
            $cust_info->CustArea = $customers_info->CustArea;
            $cust_info->CustTelephone = $customers_info->CustTelephone;
            $cust_info->CustAddLabel = $customers_info->CustAddLabel;
        }
        if ($this->input->post('as_new_add') != 0) {
            $this->User_Model->modify_customer_address($cust_info, $this->input->post('as_new_add'));
        }

        $orderid = $this->User_Model->order_generate($deltime, $paymethod, $new_total, $hfee, $from_balance, $Promocode, $PromocodeProvider, $voucher_cost, $_POST['delivery_note'], $cc_fee, $del_cost, $order_total_discount, $vat, $final_charity_id, $cust_info);
        $curr_busket = $this->db->query("select * from customer_order_busket where OrderId='$orderid'")->result();
        $order = $curr_busket[0];
        $restaurantFeesCommission = $this->session->userdata('rest_fees_commission');
        $globalcomm = $globaldiscountObj;
        $rest_service = $this->session->userdata('rest_service');
        $res_comm = array();
        $default_comm = 0;
        if (!empty($rest_service)) {
            $res_comm = $rest_service;
        }
        if (count($res_comm) > 0) {
            $default_comm = 0;
        }
        else {
            if (!empty($restaurantFeesCommission)) {
                $default_comm = ( $restaurantFeesCommission->commissionType == 1 ) ? $restaurantFeesCommission->Commission : 0;
            }
            else {
                $default_comm = $globalcomm->Commission;
            }
        }
        $res_vat = $globalcomm->Vat;
        $final_vat = 0;
        $com_amount = $order->total_price - $order->OrderTotalDiscount;
        $acc_credit = 0;
        $res_comm1 = 0;
        if (strtolower($paymethod) == 'cod') {
            if (!empty($res_comm)) {
                $res_comm1 = $final_vat = $res_comm->Commission_Cash + $default_comm;
            }
        }
        else {
            if (!empty($res_comm)) {
                $res_comm1 = $final_vat = $res_comm->Commission + $default_comm;
            }
        }
        $order_comm = ( $com_amount ) * $res_comm1 / 100;
        $actual_comm = number_format($order_comm + ( $order_comm * $res_vat / 100 ), 2, '.', '');

        if ($order->PromocodeProvider == 'owner') {
            $acc_credit = $order->PromocodePrice + $order->BalanceDeduction - $order->HandlingFee;
        }
        else {
            $acc_credit = $order->BalanceDeduction - $order->HandlingFee;
        }
        $actual_balance = $acc_credit - $actual_comm;
        $actual_balance = $actual_balance + $order->rest_aff_amount;
        $sqlStr = "update customer_order_busket set GrandTotal='$final_total', OrderCommission='$actual_comm',CreditAmount='$acc_credit', ComAmount='$com_amount' , ActualBalance='$actual_balance',ComRate='$final_vat',VatRate='$res_vat' where OrderId='$orderid'";
        $query2 = $this->db->query($sqlStr);
        $busket_id_data = array(
            'busket_id' => $orderid
        );
        $this->session->set_userdata($busket_id_data);
        $this->User_Model->insert_order_items($orderid);
        $this->db->set('last_paypal_orderid', 0);
        $this->db->where('CustId', $this->session->userdata('CustId'));
        $this->db->update('customers');
        redirect('order/process/' . $orderid);
    }

    function userpromocode() {
        if ($this->session->userdata('rest_vouchers')) {
            $code = $this->input->post('promocode');
            $vouchers = $this->session->userdata('rest_vouchers');
            $myVoucher = array();
            foreach ($vouchers as $voucher) {
                if ($voucher->code == $code) {
                    $myVoucher = $voucher;
                }
            }

            if (!empty($myVoucher)) {
                $promocode = $myVoucher->code;
                $price = $myVoucher->price_func == 'pound' ? $myVoucher->price : float($myVoucher->price) / 100;
                $session_data = array(
                    'promocodediscount' => $price,
                    'promocode' => $promocode
                );
                $this->session->set_userdata($session_data);
                echo 1;
            }
            else {
                echo "Invalid discount code";
            }
        }
        else {
            echo "Invalid discount code";
        }
    }

    public function showmycart() {
        echo $this->User_Model->showmycart();
    }

    public function get_delivery_area() {
        $parea = $this->input->post('enter_area');
        $pcode = $this->input->post('enter_postcode');
        $pcode = trim(strtoupper($pcode));
        if (!$this->session->userdata('deliverytype') || $this->session->userdata('deliverytype') == 1) {
            $this->session->set_userdata('deliverytype', 2);
        }
        if ($this->session->userdata('deliveryarea')) {
            $deliveryarea = $this->session->userdata('deliveryarea');
            if ($deliveryarea[0]->DeliveryAreaId) {
                $this->session->set_userdata('sinput', $parea);
                $this->session->set_userdata('delareaidforpostcode', $deliveryarea[0]->DeliveryAreaId);
                $udata = array(
                    'DelTime' => $deliveryarea[0]->DelTime,
                    'MinOrder' => $deliveryarea[0]->MinOrder,
                    'delivery_cost' => $deliveryarea[0]->DeliveryCharge,
                    'delareaidforpostcode' => $deliveryarea[0]->DeliveryAreaId,
                    "Address_change" => "",
                    "deliverytype" => "2",
                    "sinput" => $parea,
                    "search_postcode" => $pcode
                );
                $this->session->set_userdata('udata', $udata);
                echo $str = $deliveryarea[0]->DeliveryAreaId . '*@*' . to_currency($deliveryarea[0]->DeliveryCharge) . '*@*' . to_currency($deliveryarea[0]->MinOrder) . '*@*' . $deliveryarea[0]->DelTime . ' MIN';
            }
            else {
                echo $str = "0*@*0*@*0*@*0";
            }
        }
    }

    function changeaddress() {
        $address = array();
        $cust_info = $this->Customer_Model->get_primary_address($this->session->userdata('CustId'));
        if ($this->input->post('table') == "ci") {
            $address = $this->Customer_Model->get_primary_address($this->input->post('id'));
        }
        if ($this->input->post('table') == "cai") {
            $address = $this->Customer_Model->get_customeraddress_by_CustAddId($this->input->post('id'));
        }
        echo json_encode(array('CustInfo' => $cust_info, 'address' => $address));
    }

    function login() {
        $this->page_title = 'Customer Login';
        $this->current_section = "Customer Login";
        $this->body_class[] = 'customer-login';
        $data = [];
        $isPopup = 'no';
        if ($this->input->post()) {
            $this->form_validation->set_rules('CustEmail', 'User Name', 'required');
            $this->form_validation->set_rules('CustPassword', 'Password', 'required');
            $this->form_validation->set_error_delimiters('<div class="error" style="background:#ffffff; color:#FF0000;padding:5px">', '</div>');
            $username = $data['username'] = $this->input->post('CustEmail');
            $data['password'] = $this->input->post('CustPassword');
            $password = md5($this->input->post('CustPassword'));
            $isPopup = $this->input->post('isPopup');
            $loginValidate = $this->User_Model->validate($username, $password);
            if ($loginValidate > 0) {
                $banned = 0;
                $custdata = $this->User_Model->logincutomerinfo($username);
                if ($custdata[0]->baned == '100') {
                    $banned = 1;
                    $problem = $this->lang->line('ip_blocked');
                }
                if ($custdata[0]->baned == '010') {
                    $banned = 2;
                    $problem = $this->lang->line('email_blocked');
                }
                if ($custdata[0]->baned == '001') {
                    $banned = 3;
                    $problem = $this->lang->line('phone_blocked');
                }
                if ($custdata[0]->baned == '111') {
                    $banned = 4;
                    $problem = $this->lang->line('iep_blocked');
                }
                if ($custdata[0]->baned == '101') {
                    $banned = 5;
                    $problem = $this->lang->line('iph_blocked');
                }
                if ($custdata[0]->baned == '110') {
                    $banned = 6;
                    $problem = $this->lang->line('ie_blocked');
                }
                if ($custdata[0]->baned == '011') {
                    $banned = 7;
                    $problem = $this->lang->line('ep_blocked');
                }
                if ($custdata[0]->CustStatus == 0) {
                    $banned = 8;
                    $problem = "Your account is not active, Please check your email for activation link.";
                }
                if ($banned == 0) {
                    $this->session->unset_userdata('udata');
                    $session_data = array(
                        "customer" => $username,
                        "CustId" => $custdata[0]->CustId,
                        "CustFirstName" => $custdata[0]->CustFirstName,
                        "CustLastName" => $custdata[0]->CustLastName,
                        "CustName" => $custdata[0]->CustFirstName . " " . $custdata[0]->CustLastName,
                        "CustAdd1" => $custdata[0]->CustAdd1,
                        "CustAdd2" => $custdata[0]->CustAdd2,
                        "CustTown" => $custdata[0]->CustTown,
                        "CustState" => $custdata[0]->CustState,
                        "CustComments" => $custdata[0]->CustComments,
                        "County" => $custdata[0]->County,
                        "Country" => 'Republic of Ireland',
                        "CustEmail" => $custdata[0]->CustEmail,
                        "CustTel" => $custdata[0]->CustTelephone,
                        "CustPostcode" => $custdata[0]->CustPostcode,
                        "CustArea" => $custdata[0]->CustArea,
                        'sinput' => $custdata[0]->CustPostcode,
                        "CustAddLabel" => $custdata[0]->CustAddLabel,
                        "aff_cust_id" => $custdata[0]->affiliate_from,
                        "CustGender" => $custdata[0]->CustGender,
                        "delareaidforpostcode" => ''
                    );
                    $this->session->set_userdata('login_bol', 'y');
                    $this->session->set_userdata($session_data);
                    $error = array(
                        'login_error' => ''
                    );
                    $this->session->set_userdata($error);
                    if ($isPopup == 'yes') {
                        echo "1";
                    }
                    else {
                        redirect('user/checkout');
                    }
                }
                else {
                    if ($isPopup == 'yes') {
                        echo $problem;
                    }
                    else {
                        $data['problem'] = $problem;
                    }
                }
            }
            else {
                if ($isPopup == 'yes') {
                    echo "Invalid email or password";
                }
                else {
                    $data['problem'] = "Invalid email or password";
                }
            }
        }
        if (!isset($isPopup) || $isPopup == 'no') {
            $this->render_page('user/login', $data);
        }
    }

    function registration() {
        $data = [];
        if ($this->input->post()) {
            $data = $this->prepareRegistrationData();
            $data['CustAddLabel'] = "Primary";
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run('customer_registration') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                echo validation_errors();
            }
            else {

                if ($this->User_Model->save($data)) {
                    $this->Apimodel->customer_resgistration($data);
                    $notification = $this->Notification->get_configuration('EMAIL_CUSTOMER_REGISTRATION');
                    $email_template = $this->Notification->get_email_template();
                    $pattern = array(
                        '/CUSTOMER_NAME/' => $this->input->post("CustFirstName") . ' ' . $this->input->post("CustLastName"),
                        '/USER_NAME/' => $this->input->post("CustEmail"),
                        '/CUSTOMER_EMAIL/' => $this->input->post("CustEmail"),
                        '/PASSWORD/' => $this->input->post("CustPassword"),
                        '/CUSTOMER_EMAIL/' => $this->input->post("CustEmail"),
                        '/ACCOUNT_ACTIVATION_LINK/' => anchor('user/activate/' . md5($this->input->post("CustEmail")), 'Click Here to Activate Account'),
                        '/CUSTOMER_ADDRESS/' => $this->input->post("CustAdd1"),
                        '/SITE_NAME/' => $this->config->item('company')
                    );
                    $body_txt = preg_replace(array_keys($pattern), array_values($pattern), $notification->message);
                    $body_txt = str_replace('BODY_TEXT', nl2br($body_txt), $email_template);
                    $data['v_method'] = $veri_method = $this->User_Model->get_verification_method();
                    if (( $veri_method == 1 ) || ( $veri_method == 3 )) {
                        $config['wordwrap'] = false;
                        $config['mailtype'] = 'html';
                        $config['protocol'] = 'sendmail';
                        $this->email->initialize($config);
                        $this->email->from($this->config->item('email'), $this->config->item('company'));
                        $this->email->to($this->input->post("CustEmail"));
                        $this->email->subject("Welcome to " . $this->config->item('company'));
                        $this->email->message($body_txt);
                        $this->email->send();
                    }
                    if ($notification->reciever['admin'] == 1) {
                        $config['wordwrap'] = false;
                        $config['mailtype'] = 'html';
                        $config['protocol'] = 'sendmail';
                        $this->email->initialize($config);
                        $this->email->from($this->config->item('company'));
                        $this->email->to($this->config->item('email'));
                        $this->email->subject('One customer has signed up at ' . $this->config->item('company'));
                        $this->email->message($body_txt);
                        $this->email->send();
                    }
                    echo "1";
                }
            }
        }
    }

    function success() {
        $this->page_title = 'Success';
        $this->current_section = "Registration Success";
        $this->body_class[] = 'success';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        $this->render_page('user/success');
    }

    function activate() {
        $code = $this->uri->segment(3);
        if ($code != "") {
            $data = array(
                'md5(CustEmail)' => $code
            );
            if ($this->db->update('customers', array('CustStatus' => '1', 'verified' => '1'), $data)) {
                $customer = $this->db->get_where('customers', $data)->row();
                $this->Apimodel->activate(array('CustEmail' => $customer->CustEmail));
            }
        }
        $this->page_title = 'Account Activation';
        $this->current_section = "Account Activation";
        $this->body_class[] = 'account Activation';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        $this->render_page('user/activate');
    }

    function forgotpass() {
        $this->page_title = 'Customer Login';
        $this->current_section = "Customer Login";
        $this->body_class[] = 'customer-login';
        $data = [];
        $data['error'] = $error = 0;
        if ($this->input->post('u_name') != null) {
            $uname = $this->input->post('u_name');
            $info = $this->Usermodel->cutomerinfo($uname);
            if (count($info) < 1) {
                $data['error'] = $error = 1;
                $this->session->set_userdata(array(
                    'forgotMessage' => '<strong class="errorMessage">Sorry! There is no customer registered with this email address.</strong>'
                ));
            }
            else {
                $this->load->model("Notification");
                $email_template = $this->Notification->get_email_template();
                $body_txt = '';
                $body_txt .= 'Dear ';
                $body_txt .= $info[0]->CustFirstName . ' ' . $info[0]->CustLastName . ',<br /><br />';
                $body_txt .= "Someone recently requested to change your&nbsp;" . $this->config->item('company') . "&nbsp;account's password.<br /><br />";
                $body_txt .= "If this was you, you can set a new password  " . anchor('user/resetPassword/' . base64_encode($this->input->post("u_name")), 'here') . ".<br /><br />";
                $body_txt .= anchor('user/resetPassword/' . base64_encode($this->input->post("u_name")), 'Reset password');
                $body_txt .= "<br /><br />If you don't want to change your password, just ignore this message.<br /><br />";
                $body_txt .= "Thanks. <br />" . $this->config->item('company') . "&nbsp;Team";
                $body_txt = str_replace('BODY_TEXT', $body_txt, $email_template);
                $config['wordwrap'] = false;
                $config['mailtype'] = 'html';
                $config['protocol'] = 'sendmail';
                $this->email->initialize($config);
                $this->email->from($this->config->item('email'), $this->config->item('company'));
                $this->email->to($uname);
                $this->email->subject($this->config->item('company') . '&nbsp' . $this->lang->line('pass_subject_mess1'));
                $this->email->message($body_txt);
                $this->email->send();
                $this->session->set_userdata(array(
                    'forgotMessage' => '<strong class="successMessage">Account resting mail has been sent to your mail account. please check</strong>'
                ));
                $data['error'] = $error = 0;
                $sql1 = $this->db->query("UPDATE customers SET CustStatus='0'  WHERE CustEmail ='" . trim($uname) . "'");
            }
        }
        $this->render_page('user/forgotpass', $data);
    }

    function resetPassword($encoded_email, $msg = Null) {
        $userEmail = base64_decode($encoded_email);
        if ($userEmail) {
            $sql = $this->db->query("SELECT CustId,CustStatus FROM customers WHERE CustEmail ='" . trim($userEmail) . "'")->row();
            if ($sql->CustId) {
                if ($sql->CustStatus == 0) {
                    $data['encoded_email'] = trim($userEmail);
                    if ($msg != Null)
                        $data['password_change_succ'] = $msg;
                    $this->template->write('title', 'ieat.co.uk');
                    $theme = $this->template->template['template'] = 'theme3';
                    $data['css'] = $this->template->template['template'] . '_style.css';
                    if (HEADER)
                        $this->template->write_view(HEADER, $theme . '/common/header_menu.php', $data, $overwrite = FALSE);
                    if (CONTENT)
                        $this->template->write_view(CONTENT, 'site_views/' . CONTLR_NAME . '/reset_password_body.php', $data, $overwrite = FALSE);
                    if (HOME_BOTTOM)
                        $this->template->write_view(HOME_BOTTOM, 'theme3/common/footer.php', $data, $overwrite = FALSE);
                    $this->template->render();
                }
                else {
                    $msg = "Your password has been reset already.";
                    $data['password_change_succ'] = $msg;
                    $this->template->write('title', 'ieat.co.uk');
                    $theme = $this->template->template['template'] = 'theme3';
                    $data['css'] = $this->template->template['template'] . '_style.css';
                    if (HEADER)
                        $this->template->write_view(HEADER, $theme . '/common/header_menu.php', $data, $overwrite = FALSE);
                    if (CONTENT)
                        $this->template->write_view(CONTENT, 'site_views/' . CONTLR_NAME . '/reset_password_body.php', $data, $overwrite = FALSE);
                    if (HOME_BOTTOM)
                        $this->template->write_view(HOME_BOTTOM, 'theme3/common/footer.php', $data, $overwrite = FALSE);
                    $this->template->render();
                }
            }
            else {
                redirect('user/forgotpassword');
            }
        }
        else {
            redirect('user/forgotpassword');
        }
    }

    function get_dist_by_city() {
        $cid = $this->input->post('cityid');
        $areas = array();
        if ($this->session->userdata('areas')) {
            $areas = $this->session->userdata('areas');
        }
        $ecity = array();
        if (!empty($areas)) {
            foreach ($areas as $area) {
                if ($area->CityId == $cid && $area->status == 1) {
                    $ecity[] = $area;
                }
                else {
                    continue;
                }
            }
        }
        ?>
        <select name="cust_area" id="cust_area" class="input1">

            <option value="" selected="selected"><?php
                echo $this->lang->line('select_zone');
                ?></option>
            <?php
            foreach ($ecity as $citye) {
                ?>

                <option  value="<?php
                echo $citye->AreaId;
                ?>"><?php
                             echo $citye->AreaName;
                             ?></option>

                <?php
            }
            ?>

        </select>

        <?php
    }

    function get_area_by_city() {
        $cid = $this->input->post('cityid');
        $areas = array();
        if ($this->session->userdata('areas')) {
            $areas = $this->session->userdata('areas');
        }
        $ecity = array();
        if (!empty($areas)) {
            foreach ($areas as $area) {
                if ($area->CityId == $cid && $area->status == 1) {
                    $ecity[] = $area;
                }
                else {
                    continue;
                }
            }
        }
        $CustArea = '';
        if ($this->session->userdata('CustArea')) {
            $CustArea = $this->session->userdata('CustArea');
        }
        ?>
        <select name="CustArea" id="CustArea">
            <option value="" <?php if ($CustArea == "") { ?> selected="selected" <?php } ?> ><?php echo $this->lang->line('select_zone'); ?></option> <?php foreach ($ecity as $citye) { ?>
                <option value="<?php echo $citye->AreaId; ?>" <?php
                if ($CustArea == $citye->AreaId) {
                    echo 'selected="selected"';
                }
                ?> ><?php echo $citye->AreaName; ?></option>   
                    <?php } ?>
        </select>
        <?php
    }

    function get_dist_by_city_order_place() {
        $cid = $this->input->post('cityid');
        $selected_area = $this->input->post('selected_area');
        $areas = array();
        if ($this->session->userdata('areas')) {
            $areas = $this->session->userdata('areas');
        }
        $ecity = array();
        if (!empty($areas)) {
            foreach ($areas as $area) {
                if ($area->CityId == $cid && $area->status == 1) {
                    $ecity[] = $area;
                }
                else {
                    continue;
                }
            }
        }
        ?>
        <select class="dropdown cl_op_field cl_op_field_area"  id="customers_area" name="customers_area" >

            <option value="" selected="selected"><?php
                echo $this->lang->line('select_zone');
                ?></option>

            <?php
            foreach ($ecity as $citye) {
                ?>

                <option  value="<?php
                echo $citye->AreaId;
                ?>" <?php
                         if ($selected_area == $citye->AreaId)
                             echo 'selected="selected"';
                         ?>><?php
                             echo $citye->AreaName;
                             ?></option>

                <?php
            }
            ?>

        </select>

        <?php
    }

}
