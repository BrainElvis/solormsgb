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
            'Status'=>'0',
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
            'OrderAddState' => isset($cust_info->CustState) ? $cust_info->CustState : '',
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
        }
        else {
            return false;
        }
    }

    function insert_order_items($orderid) {
        $CI = & get_instance();
        $CI->load->model('Apimodel');
        if ($orderid > 0) {
            $data['attribute_sets'] = array();
            $unique = array_unique($this->session->userdata['cart']);
            $data['unique'] = $unique;
            foreach ($unique as $val) {
                $dup[$val] = $this->findDuplicates($this->session->userdata['cart'], $val);
            }
            $data['dup'] = $dup;
            if (isset($this->session->userdata['attrcart']) && !empty($this->session->userdata['attrcart'])) {
                $i = 0;
                foreach ($this->session->userdata['attrcart'] as $key => $val) {
                    $id = explode('|', $val);
                    if (count($id) == 4) {
                        $attr_id = $id[3];
                        $attr_item = $attrarray[$id[0] . '|' . $id[1] . '|' . $id[2] . '|' . $id[3]][$i] = $val;
                        $array_attribute[$id[0] . '|' . $id[1] . '|' . $id[2] . '|' . $id[3]][$attr_id] = $val;
                    }
                    if (count($id) == 5) {
                        $attr_id = $id[4];
                        $attr_item = $attrarray[$id[0] . '|' . $id[1] . '|' . $id[2] . '|' . $id[3] . '|' . $id[4]][$i] = $val;
                        $array_attribute[$id[0] . '|' . $id[1] . '|' . $id[2] . '|' . $id[3] . '|' . $id[4]][$attr_id] = $val;
                    }
                    $i++;
                }
                $arrunique = $CI->Apimodel->arrayUnique($array_attribute);
                foreach ($arrunique as $key1 => $arr) {
                    foreach ($arr as $key2 => $attr) {
                        //$sql = "select menu_attributes.*,menu_category_attributes_details.AttrName from menu_attributes Inner Join menu_category_attributes_details 
                        //				  ON menu_attributes.AttrDetailsId = menu_category_attributes_details.AttrDetailsId where AttrId='" . $key2 . "'";
                        //$query = $this->db->query($sql);
                        $attribute_sets[$key1][$key2] = $CI->Apimodel->key2($key2);
                        $dupattr[$key1][$key2] = $CI->Apimodel->findDuplicates($this->session->userdata['attrcart'], $attr);

                        //$attribute_sets[$key1][$key2] = $query->result();
                        //$dupattr[$key1][$key2] = $this->findDuplicates($this->session->userdata['attrcart'], $attr);
                    }
                }
                $data['attribute_sets'] = $attribute_sets;
                $data['attrunique'] = $arrunique;
                $data['dupattr'] = $dupattr;
            }
            $order_price = 0.0;
            $order_real_price = 0.0;
            if ($this->session->userdata('cart')) {
                $arr = $CI->Apimodel->arrayUnique($this->session->userdata('cart'));
                foreach ($arr as $key => $val) {
                    $selname = '';
                    $special_item = 0;
                    $totalattrprice = 0;
                    $no_of_item = $this->findDuplicates($this->session->userdata('cart'), $val);
                    $total_item = $no_of_item;
                    $menu_item = explode("|", $val);
                    $aaa = explode('@', $val);
                    $selgen = "";
                    if (count($menu_item) == 3 && !(strpos($menu_item[0], '@') === false)) {
                        $special_item = 1;
                        $sel = 0;
                        if (isset($aaa[1]))
                            $item_details = explode('|', $aaa[1]);
                        else
                            $item_details = $menu_item;
                        $catid = $item_details[0];

                        $catname = $CI->Apimodel->getcatname_by_id($item_details[0]);
                        $baseid = $item_details[1];

                        $basename = $CI->Apimodel->getbasename_by_id($item_details[1]);
                        $selname = '';
                        $arrspdetails = $this->session->userdata('sp_details');
                        $selcnt = 0;
                        $freeAttr = $CI->Apimodel->get_free_attr_by_baseid($baseid);  //$this->db->get_where('menu_base', array('BaseId' => $baseid))->row()->FreeAttr;
                        if ($this->session->userdata('sp_details') && !empty($arrspdetails)) {
                            foreach ($arrspdetails[$menu_item[0] . '|' . $menu_item[1]] as $spkey => $spval) {
                                if ($selcnt > 0)
                                    $selgen .= "==";
                                $selgen .= $spkey . "=>" . $spval;
                                $spkey1 = explode('|', $spkey);
                                $spselnameget = $CI->Apimodel->getspselname_by_id($spkey1[0]);
                                $spbasenameget = $CI->Apimodel->getbasename_by_id($spselnameget->BaseId);
                                if (trim($spselnameget->SpItemName, '\n') != trim($spbasenameget, '\n')) {
                                    $selname .= "==" . $spbasenameget . " - " . $spselnameget->SpItemName;
                                }
                                else {
                                    $selname .= "==" . $spselnameget->SpItemName;
                                }
                                $attrsetfinal = $data['attribute_sets'];
                                $attrcnt = 0;
                                $freeattrcnt = 0;
                                $spattr_arr = array();
                                if (isset($attrsetfinal) && !empty($attrsetfinal)) {
                                    foreach (array_keys($attrsetfinal) as $attrkeys) {
                                        $thisitem = substr($attrkeys, 0, strrpos($attrkeys, "|"));
                                        if ($thisitem != $val)
                                            continue;
                                        $unkeys = explode('|', $attrkeys);
                                        $pop = array_pop($unkeys);
                                        $pop_arr = explode('_', $pop);
                                        if ($spkey1[0] != $pop_arr[1])
                                            continue;
                                        $unkeys = $val . '|' . $pop;
                                        if (isset($attrsetfinal[$unkeys]) && !empty($attrsetfinal[$unkeys])) {
                                            foreach ($attrsetfinal[$unkeys] as $attrkey => $attrdetails) {
                                                $no_of_attr = $dupattr[$unkeys][$attrdetails[0]->AttrId];
                                                if ($freeattrcnt >= $freeAttr) {
                                                    $attrprice = $attrdetails[0]->AttrPrice;
                                                }
                                                else {
                                                    $attrprice = 0;
                                                }
                                                $attrname = $attrdetails[0]->AttrName;
                                                $attrgen = $val . "|" . $pop;
                                                if (!$attrdetails[0]->Default) {
                                                    $spattr_arr[] = $attrname;
                                                    $totalattrprice += $attrprice;
                                                }
                                                else {
                                                    $spattr_arr[] = 'no ' . $attrname;
                                                }
                                                $attrid = explode('_', $pop);
                                                foreach ($defaultattr as $i => $value) {
                                                    if ($value == $attrid[0]) {
                                                        unset($defaultattr[$i]);
                                                    }
                                                }
                                                $attrcnt++;
                                                if (!$attrdetails[0]->Default) {
                                                    $freeattrcnt++;
                                                }
                                            }
                                        }
                                    }
                                }
                                if ($attrcnt > 0) {
                                    $selname .= '##' . implode('@@', $spattr_arr);
                                }
                                $selcnt++;
                            }
                        }
                        if (strlen($selgen) > 0)
                            $selgen = $menu_item[0] . '|' . $menu_item[1] . "===" . $selgen;
                    } else {
                        $sel = 1;
                        if (strpos($menu_item[0], '/') === false) {
                            $catid = $menu_item[0];
                        }
                        else {
                            $tempcat = explode('/', $menu_item[0]);
                            if (count($tempcat) > 0)
                                $catid = array_pop($tempcat);
                            else
                                $catid = $tempcat[0];
                        }
                        $catname = $CI->Apimodel->getcatname_by_id($catid);
                        $baseid = $menu_item[1];
                        $basename = $CI->Apimodel->getbasename_by_id($menu_item[1]);
                        $selname = "";
                        if (count($menu_item) != 3) {
                            $selname_arr = explode("==", $menu_item[2]);
                            $scnt = 0;
                            foreach ($selname_arr as $sname) {
                                if (strlen($sname) > 0) {
                                    if ($scnt > 0)
                                        $selname .= "==";
                                    $selname .= $CI->Apimodel->getselname_by_id($sname);
                                    $scnt++;
                                }
                            }
                        }
                    }
                    $total_sel = 0;
                    $total_base = 0;
                    if ($sel == 0) {
                        $sel_price = 0;
                        $sel_main_price = 0;
                        $base_price_arr = explode('*', $menu_item[2]);
                        $base_price = $base_price_arr[1];
                        $base_main_price = $base_price_arr[0];
                        $total_base = $this->findDuplicates($arr, $val);
                        $order_price += $base_price * $total_base;
                        $order_real_price += $base_main_price * $total_base;
                        $no_of_item = $total_base;
                        $base_price += $totalattrprice;
                    }
                    else {
                        if (count($menu_item) == 3) {
                            $sel_price = 0;
                            $sel_main_price = 0;
                            $base_price_arr = explode('*', $menu_item[2]);
                            $base_price = $base_price_arr[1];
                            $base_main_price = $base_price_arr[0];
                            $total_base = $this->findDuplicates($arr, $val);
                            $order_price += $base_price * $total_base;
                            $order_real_price += $base_main_price * $total_base;
                            $no_of_item = $total_base;
                        }
                        else {
                            $sel_price_arr = explode('*', $menu_item[3]);
                            $sel_price = $sel_price_arr[1];
                            $sel_main_price = $sel_price_arr[0];
                            $base_price = 0;
                            $base_main_price = 0;
                            $total_sel = $this->findDuplicates($arr, $val);
                            $order_price += $sel_price * $total_sel;
                            $order_real_price += $sel_main_price * $total_sel;
                            $no_of_item = $total_sel;
                        }
                    }
                    $orderdata = array(
                        'OrderId' => $orderid,
                        'ResId' => $this->config->item('api_id'),
                        'CatId' => $catid,
                        'CatName' => $catname,
                        'BaseId' => $baseid,
                        'BaseName' => $basename,
                        'BaseQty' => $total_base,
                        'BaseUnitPrice' => $base_price,
                        'SelectionId' => NULL,
                        'SelectionName' => $selname,
                        'SelectionQty' => $total_sel,
                        'SelectionUnitPrice' => $sel_price,
                        'item_name' => '',
                        'total_qty' => $total_item,
                        'BaseMainPrice' => $base_main_price,
                        'SelectionMainPrice' => $sel_main_price,
                        'item_comments' => $_SESSION['comments'][$val],
                        'CartGenID' => $val,
                        'CartSelGenID' => $selgen
                    );
                    if ($this->db->insert('order_detail_busket ', $orderdata)) {
                        $order_insert_id = $this->db->insert_id();
                    }
                    if ($special_item == 0) {
                        $attrsetfinal = $data['attribute_sets'];
                        if (isset($attrsetfinal) && !empty($attrsetfinal)) {
                            $attrcnt = 0;
                            $freeattrcnt = 0;
                            $freeAttr = $CI->Apimodel->get_free_attr_by_baseid($baseid); //$this->db->get_where('menu_base', array('BaseId' => $baseid ))->row()->FreeAttr;
                            if (!empty($attrsetfinal)) {
                                foreach (array_keys($attrsetfinal) as $attrkeys) {
                                    $thisitem = substr($attrkeys, 0, strrpos($attrkeys, "|"));
                                    if ($thisitem != $val)
                                        continue;
                                    $val12 = $unkeys = explode('|', $attrkeys);
                                    $pop = array_pop($unkeys);
                                    $unkeys = $thisitem . '|' . $pop;
                                    $catId = 0;
                                    if (count($val12) == 4) {
                                        $selectionId = 0;
                                        $baseId = $val12[1];
                                        $catIdArr = explode('/', $val12[0]);
                                        $catId = array_pop($catIdArr);
                                    }
                                    else if (count($val12) == 5) {
                                        $selectionId = (implode(',', explode('==', $val12[2])));
                                        $selectionId = preg_replace('/,/', '', $selectionId, 1);
                                        $baseId = $val12[1];
                                        $catIdArr = explode('/', $val12[0]);
                                        $catId = array_pop($catIdArr);
                                    }
                                    foreach ($attribute_sets[$unkeys] as $attrkey => $attrdetails) {
                                        $level = '';
                                        if (count($val) == 5) {
                                            $strsql = $CI->Apimodel->get_menu_attributes($level, count($val), $baseId, $selectionId);
                                            if (!empty($strsql)) {
                                                $level = 1;
                                                $selectionId = 0;
                                            }
                                            else {
                                                $selection = explode(',', $selectionId);
                                                $selectionId = array_pop($selection);
                                            }
                                        }if ($level == 1 || count($val) == 4) {
                                            $strsql = $CI->Apimodel->get_menu_attributes($level, count($val), $baseId, $selectionId);
                                            if (!empty($strsql)) {
                                                $level = 1;
                                                $selectionId = 0;
                                                $baseId = 0;
                                            }
                                        }
                                        $menuAttributsConfig = $CI->Apimodel->get_menuAttributsConfig($catId, $baseId, $selectionId, $attrdetails[0]->AttrCatId);
                                        if ($this->session->userdata('attribuesfreecount')) {
                                            $attribuesfreecount = $this->session->userdata('attribuesfreecount');
                                        }
                                        if (!empty($menuAttributsConfig) && count($menuAttributsConfig) > 0) {
                                            $attribuesfreecount[$thisitem . '|' . $attrdetails[0]->AttrCatId . '|totalfree'] = $menuAttributsConfig->free_attributes;
                                        }
                                        else {
                                            $attribuesfreecount[$thisitem . '|' . $attrdetails[0]->AttrCatId . '|totalfree'] = 0;
                                        }
                                        $attribuesfreecount[$thisitem . '|' . $attrdetails[0]->AttrCatId . '|count'] = 0;
                                        $this->session->set_userdata('attribuesfreecount', $attribuesfreecount);
                                    }
                                }
                            }
                            foreach (array_keys($attrsetfinal) as $attrkeys) {
                                $thisitem = substr($attrkeys, 0, strrpos($attrkeys, "|"));
                                if ($thisitem != $val) {
                                    continue;
                                }
                                $unkeys = explode('|', $attrkeys);
                                $pop = array_pop($unkeys);
                                $unkeys = $val . '|' . $pop;
                                if (isset($attrsetfinal[$unkeys]) && !empty($attrsetfinal[$unkeys])) {
                                    foreach ($attrsetfinal[$unkeys] as $attrkey => $attrdetails) {
                                        $no_of_attr = $dupattr[$unkeys][$attrdetails[0]->AttrId];
                                        if ($attrdetails[0]->Default == 0) {
                                            $attribuesfreecount = $this->session->userdata('attribuesfreecount');
                                            $count = intval($attribuesfreecount[$thisitem . '|' . $attrdetails[0]->AttrCatId . '|count']);
                                            $count++;
                                            $attribuesfreecount[$thisitem . '|' . $attrdetails[0]->AttrCatId . '|count'] = $count;
                                            $this->session->set_userdata('attribuesfreecount', $attribuesfreecount);
                                        }
                                        $attribuesfreecount = $this->session->userdata('attribuesfreecount');
                                        if (($attribuesfreecount[$thisitem . '|' . $attrdetails[0]->AttrCatId . '|count'] > $attribuesfreecount[$thisitem . '|' . $attrdetails[0]->AttrCatId . '|totalfree']) && $attrdetails[0]->Default == 0) {
                                            $attrprice = $attrdetails[0]->AttrPrice;
                                        }
                                        else {
                                            $attrprice = 0;
                                        }
                                        if ($attrdetails[0]->Default) {
                                            $attrname = 'no ' . $attrdetails[0]->AttrName;
                                        }
                                        else {
                                            $attrname = $attrdetails[0]->AttrName;
                                        }
                                        $attrgen = $val . "|" . $pop;
                                        $oderattr = array(
                                            'OrderDetailId' => $order_insert_id,
                                            'OrderCat' => $catid,
                                            'OrderBase' => $baseid,
                                            'OrderAttrName' => $attrname,
                                            'AttrQty' => 1,
                                            'OrderAttrUnitPrice' => $attrprice,
                                            'CartAttrGenID' => $attrgen
                                        );
                                        if ($this->db->insert('order_attribute_basket ', $oderattr)) {
                                            
                                        }
                                        $attrcnt++;
                                        if (!$attrdetails[0]->Default) {
                                            $freeattrcnt++;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    function findDuplicates($data, $dupval) {
        $nb = 0;
        foreach ($data as $key => $val)
            if ($val == $dupval)
                $nb++;
        return $nb;
    }

}
