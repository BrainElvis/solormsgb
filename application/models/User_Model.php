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
    function order_generate($deltime, $paymethod, $total, $hfee, $decuction_from_balance = '0', $Promocode = NULL, $PromocodeProvider = NULL, $voucher_cost = NULL, $del_note = '', $cc_fee, $del_cost, $order_total_discount, $vat, $charity_id, $cust_info = NULL) {
        $aff_order = 0;
        if ($this->session->userdata('aff_order') != NULL) {
            $aff_order = $this->session->userdata('aff_order');
        }
        $date = date("Y-m-d H:i:s");
        if ($total == NULL)
            $total = 0.0;
        if ($hfee == 0)
            $hfee = 0.0;
        if ($this->session->userdata('deliverytype') == null)
            $deltype = 1;
        else
            $deltype = $this->session->userdata('deliverytype');
        $data = array(
            'CustId' => $this->session->userdata('CustId'),
            'RestId' => $this->config->item('api_id'),
            'OrderPolicyId' => $deltype,
            'CustFirstName' => $cust_info->CustFirstName,
            'CustLastName' => $cust_info->CustLastName,
            'CustTelephone' => $cust_info->CustTelephone,
            'OrderAdd1' => $cust_info->CustAdd1,
            'OrderAdd2' => $cust_info->CustAdd2,
            'CustBuild' => $this->session->userdata('CustBuild'),
            'CustFloor' => $this->session->userdata('CustFloor'),
            'CustDoorbell' => $this->session->userdata('CustDoorbell'),
            'CustComments1' => $this->session->userdata('CustComments'),
            'OrderAddTown' => $cust_info->CustTown,
            'OrderAddState' => isset($cust_info->CustState)?$cust_info->CustState:'',
            'OrderAddCountry' => "",
            'OrderAddPostcode' => $cust_info->CustPostcode,
            'OrderAddArea' => $this->session->userdata('CustArea'),
            'OrderDate' => $date,
            'DeliveryTime' => $deltime,
            'PaymentMethod' => $paymethod,
            'total_price' => $total,
            'BalanceDeduction' => $decuction_from_balance,
            'HandlingFee ' => $hfee,
            'CCFee' => $cc_fee,
            'DeliveryCost' => $del_cost,
            'OrderTotalDiscount' => $order_total_discount,
            'Vat' => $vat,
            'charity_id' => $charity_id,
            'aff_from_res' => $aff_order,
            'Promocode' => $Promocode,
            'PromocodeProvider' => $PromocodeProvider,
            'PromocodePrice' => $voucher_cost,
            'ord_ip' => $this->session->userdata('ip_address'),
            'OrderLang' => $this->config->item('language'),
            'CustComments' => $del_note
        );
        if ($this->db->insert('customer_order_busket', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

}
