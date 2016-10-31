<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Apimodel
 *
 * @author Md.Aktaruzzaman
 */
class Apimodel extends CI_Model {

    public $requestedData;

    function __construct() {
        parent::__construct();
        $this->requestedData['api_rest_id'] = $this->config->item('api_id');
        $this->requestedData['api_rest_name'] = $this->config->item('api_name');
        $this->requestedData['api_rest_url'] = $this->config->item('api_website');
        $this->requestedData['api_rest_host'] = $this->config->item('api_host');
        $this->requestedData['api_username'] = $this->config->item('api_username');
        $this->requestedData['api_password'] = $this->config->item('api_password');
        $this->requestedData['api_key'] = $this->config->item('api_key');
    }

    public function get_api_data() {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/index',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $this->requestedData,
            CURLOPT_COOKIESESSION => true,
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        if (empty($output)) {
            $hitcounter = 1;
            do
                {
                $output = curl_exec($ch);
                $hitcounter++;
                }
            while (!empty($output) || $hitcounter < 3);
        }
        else {
            curl_close($ch);
            return json_decode($output);
        }
    }

    public function get_promotime() {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/promotime',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $this->requestedData,
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        if (empty($output)) {
            $hitcounter = 1;
            do
                {
                $output = curl_exec($ch);
                $hitcounter++;
                }
            while (!empty($output) || $hitcounter < 3);
        }
        else {
            curl_close($ch);
            return json_decode($output);
        }
    }

    public function get_basicpopup() {
        $this->requestedData['baseid'] = $this->input->post('baseid');
        $this->requestedData['catid'] = $this->input->post('catid');
        $this->requestedData['selid'] = $this->input->post('selid');
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/basicpopup',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $this->requestedData,
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        if (empty($output)) {
            $hitcounter = 1;
            do
                {
                $output = curl_exec($ch);
                $hitcounter++;
                }
            while (!empty($output) || $hitcounter < 3);
        }
        else {
            curl_close($ch);
            return $output;
        }
    }

    public function get_attrfortopping() {
        $this->requestedData['catId'] = $this->input->post('catId');
        $this->requestedData['baseId'] = $this->input->post('baseId');
        $this->requestedData['selId'] = $this->input->post('selId');
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/getattrfortopping',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $this->requestedData,
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        if (empty($output)) {
            $hitcounter = 1;
            do
                {
                $output = curl_exec($ch);
                $hitcounter++;
                }
            while (!empty($output) || $hitcounter < 3);
        }
        else {
            curl_close($ch);
            return $output;
        }
    }

    public function get_specialpopup() {
        $this->requestedData['spbaseid'] = $this->input->post('spbaseid');
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/specialpopup',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $this->requestedData,
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        if (empty($output)) {
            $hitcounter = 1;
            do
                {
                $output = curl_exec($ch);
                $hitcounter++;
                }
            while (!empty($output) || $hitcounter < 3);
        }
        else {
            curl_close($ch);
            return $output;
        }
    }

    public function getallattributesforcat($catId, $baseId, $selId, $restId) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/getallattributesforcat',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => array('cat' => $catId, 'base' => $baseId, 'selection' => $selId, 'rest_id' => $restId),
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        if (empty($output)) {
            $hitcounter = 1;
            do
                {
                $output = curl_exec($ch);
                $hitcounter++;
                }
            while (!empty($output) || $hitcounter < 3);
        }
        else {
            return json_decode($output);
            curl_close($ch);
        }
    }

    public function get_basenameforspecial($spbase) {

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/get_basenameforspecial',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => array('spbase' => $spbase),
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        if (empty($output)) {
            $hitcounter = 1;
            do
                {
                $output = curl_exec($ch);
                $hitcounter++;
                }
            while (!empty($output) || $hitcounter < 3);
        }
        else {
            return json_decode($output);
            curl_close($ch);
        }
    }

    public function getdefForSpecial() {

        $this->requestedData['spbase'] = $this->input->post('spbase');
        $this->requestedData['base'] = $this->input->post('base');
        $this->requestedData['serial_number'] = $this->input->post('serial_number');
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/getdefForSpecial',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $this->requestedData,
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        return $output;
        curl_close($ch);
    }

    function showcart($genid = false) {
        $data = array();
        return $this->load->view('orderonline/subviews/cart', $data, true);
    }

    function key2($key2) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/key2',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => array('key2' => $key2),
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        if (empty($output)) {
            $hitcounter = 1;
            do
                {
                $output = curl_exec($ch);
                $hitcounter++;
                }
            while (!empty($output) || $hitcounter < 3);
        }
        else {
            return json_decode($output);
            curl_close($ch);
        }
    }

    function rearrange_cart_item() {
        if (isset($this->session->userdata['cart'])) {
            
        }
        else {
            return;
        }
        $baseitem = $this->session->userdata('cart');
        $attritem = $this->session->userdata('attrcart');
        $selectionitem = $this->session->userdata('sp_details');
        foreach ($baseitem as $key => $val) {
            $lastindex_base = $key;
            $this->call_back_rearrance($lastindex_base);
        }
    }

    function call_back_rearrance($lastindex_base) {
        $baseitem = $this->session->userdata('cart');
        $attritem = $this->session->userdata('attrcart');
        $selectionitem = $this->session->userdata('sp_details');
        $issp = 0;
        if (strpos($baseitem[$lastindex_base], "@") === false) {
            $issp = 0;
            $last_base_genid = substr($baseitem[$lastindex_base], strrpos($baseitem[$lastindex_base], "/") + 1);
        }
        else {
            $issp = 1;
            $last_base_genid = substr($baseitem[$lastindex_base], strrpos($baseitem[$lastindex_base], "@") + 1);
        }
        if ($issp == 1) {
            $total_sel_arr = $this->selection_count($baseitem[$lastindex_base]);
            $total_sel = $total_sel_arr[0];
            $sel_arr = $total_sel_arr[1];
            $sel_val_arr = $total_sel_arr[2];
            $exp_sel = explode(":", $sel_val_arr);
        }
        else
            $total_sel = 0;
        $total_attr_arr = $this->attribute_count($baseitem[$lastindex_base]);
        $total_attr = $total_attr_arr[0];
        $attr_arr = $total_attr_arr[1];
        $attr_val_arr = $total_attr_arr[2];
        $exp_attr = explode(":", $attr_val_arr);
        if ($total_sel == 0 && $total_attr == 0) {
            $samegenid = $this->find_same_genid($last_base_genid);
            $baseitem[$lastindex_base] = $samegenid;
            $session_data['cart'] = $baseitem;
            $this->session->set_userdata($session_data);
        }
        else if ($total_sel == 0 && $total_attr > 0) {
            $samegenid = "";
            $found = 0;
            foreach ($baseitem as $key => $val) {
                if (strpos($val, $baseitem[$lastindex_base]) === false) {
                    if (strpos($baseitem[$lastindex_base], $val) === false) {
                        continue;
                    }
                }
                else {
                    if (strpos($val, $baseitem[$lastindex_base]) == 0)
                        continue;
                }
                $attr_list = $this->get_attr_list($val);
                $exp_new_attr = explode(":", $attr_list);
                $arr_in = array_intersect($exp_new_attr, $exp_attr);
                if ((count($arr_in) == count($exp_attr)) && (count($arr_in) == count($exp_new_attr))) {
                    $samegenid = $val;
                    $found = 1;
                    break;
                }
            }
            if ($found == 1) {
                $this->change_attribute_genid($baseitem[$lastindex_base]);
                for ($i = 0; $i < count($baseitem); $i++) {
                    if ($baseitem[$i] == $baseitem[$lastindex_base]) {
                        $baseitem[$i] = $samegenid;
                    }
                }
                $session_data['cart'] = $baseitem;
                $this->session->set_userdata($session_data);
            }
        }
        else if ($total_sel > 0 && $total_attr == 0) {
            $samegenid = "";
            $found = 0;
            foreach ($baseitem as $key => $val) {
                if (strpos($val, $baseitem[$lastindex_base]) === false) {
                    if (strpos($baseitem[$lastindex_base], $val) === false) {
                        continue;
                    }
                }
                else {
                    if (strpos($val, $baseitem[$lastindex_base]) == 0) {
                        if ($this->reference1ForAttr($val) == 0) {
                            continue;
                        }
                    }
                }
                $sel_list = $this->get_sel_list($val);
                $exp_new_sel = explode(":", $sel_list);
                $arr_in = array_intersect($exp_new_sel, $exp_sel);
                if (count($arr_in) == count($exp_sel) && count($arr_in) == count($exp_new_sel)) {
                    $samegenid = $val;
                    if ($this->reference1ForAttr($samegenid) == 0) {
                        $found = 1;
                        break;
                    }
                }
            }
            if ($found == 1) {
                if ($this->reference1ForAttr($samegenid) == 0) {
                    $this->change_sel_genid($baseitem[$lastindex_base]);
                    for ($i = 0; $i < count($baseitem); $i++) {
                        if ($baseitem[$i] == $baseitem[$lastindex_base]) {
                            $baseitem[$i] = $samegenid;
                        }
                    }
                    $session_data['cart'] = $baseitem;
                    $this->session->set_userdata($session_data);
                }
            }
        }
        else if ($total_sel > 0 && $total_attr > 0) {
            $samegenid = "";
            $found = 0;
            foreach ($baseitem as $key => $val) {
                if (strpos($val, $baseitem[$lastindex_base]) === false) {
                    if (strpos($baseitem[$lastindex_base], $val) === false) {
                        continue;
                    }
                }
                else {
                    if (strpos($val, $baseitem[$lastindex_base]) == 0) {
                        if ($this->reference2ForAttrMatching($baseitem[$lastindex_base], $val) > '0') {
                            continue;
                        }
                    }
                }
                $sel_list = $this->get_sel_list($val);
                $exp_new_sel = explode(":", $sel_list);
                $arr_in = array_intersect($exp_new_sel, $exp_sel);
                $attr_list = $this->get_attr_list($val);
                $exp_new_attr = explode(":", $attr_list);
                $arr_in_a = array_intersect($exp_new_attr, $exp_attr);
                if ((count($arr_in) == count($exp_sel) && count($arr_in) == count($exp_new_sel))) {
                    if (count($arr_in_a) == count($exp_attr) && count($arr_in_a) == count($exp_new_attr)) {
                        $samegenid = $val;
                        if ($this->reference2ForAttrMatching($baseitem[$lastindex_base], $samegenid) > '0') {
                            $found = 1;
                            break;
                        }
                    }
                }
            }
            if ($found == 1) {
                if ($this->reference2ForAttrMatching($baseitem[$lastindex_base], $samegenid) > '0') {
                    $this->change_sel_attr_genid($baseitem[$lastindex_base]);
                    $this->change_sel_genid($baseitem[$lastindex_base]);
                    for ($i = 0; $i < count($baseitem); $i++) {
                        if ($baseitem[$i] == $baseitem[$lastindex_base]) {
                            $baseitem[$i] = $samegenid;
                        }
                    }
                    $session_data['cart'] = $baseitem;
                    $this->session->set_userdata($session_data);
                }
            }
        }
    }

    function selection_count($genid) {
        $newgen = substr($genid, 0, strrpos($genid, "|"));
        $count = 0;
        $val_arr = "";
        $arr = array();
        $selitem = $this->session->userdata['sp_details'];
        foreach ($selitem as $key => $val) {
            if (strpos($key, $newgen) === false || strpos($key, $newgen) > 0) {
                continue;
            }
            else {
                array_push($arr, $key);
                foreach ($val as $nkey => $nval) {
                    $count++;
                    if ($count > 1)
                        $val_arr .= ":";
                    $val_arr .= $nkey;
                }
            }
        }
        $ret_arr = array();
        array_push($ret_arr, $count);
        array_push($ret_arr, $arr);
        array_push($ret_arr, $val_arr);
        return $ret_arr;
    }

    function attribute_count($genid) {
        $count = 0;
        $val_arr = "";
        $arr = array();
        $attritem = $this->session->userdata['attrcart'];
        foreach ($attritem as $key => $val) {
            if (strpos($val, $genid) === false || strpos($val, $genid) > 0) {
                continue;
            }
            else {
                $count++;
                array_push($arr, $key);
                if ($count > 1)
                    $val_arr .= ":";
                $val_arr .= substr($val, strrpos($val, "|") + 1);
            }
        }
        $ret_arr = array();
        array_push($ret_arr, $count);
        array_push($ret_arr, $arr);
        array_push($ret_arr, $val_arr);
        return $ret_arr;
    }

    function find_same_genid($genid) {
        $baseitem = $this->session->userdata['cart'];
        $newgenid = "";
        foreach ($baseitem as $key => $val) {
            if (strpos($val, $genid) === false) {
                continue;
            }
            $total_attr_arr = $this->attribute_count($val);
            $total_attr = $total_attr_arr[0];
            if ($total_attr == 0) {
                $newgenid = $val;
                break;
            }
        }
        return $newgenid;
    }

    function get_attr_list($genid) {
        $val_arr = "";
        $attritem = $this->session->userdata['attrcart'];
        $count = 0;
        foreach ($attritem as $key => $val) {
            if (strpos($val, $genid) === false || strpos($val, $genid) > 0) {
                continue;
            }
            $count++;
            if ($count > 1)
                $val_arr .= ":";
            $val_arr .= substr($val, strrpos($val, "|") + 1);
        }
        return $val_arr;
    }

    function arrayUnique($array, $preserveKeys = true) {
        $arrayRewrite = array();
        $arrayHashes = array();
        foreach ($array as $key => $item) {
            $hash = md5(serialize($item));
            if (!isset($arrayHashes[$hash])) {
                $arrayHashes[$hash] = $hash;
                if ($preserveKeys) {
                    $arrayRewrite[$key] = $item;
                }
                else {
                    $arrayRewrite[] = $item;
                }
            }
        }
        return $arrayRewrite;
    }

    function change_attribute_genid($oldgen) {
        $attritem = $this->session->userdata['attrcart'];
        foreach ($attritem as $key => $val) {
            if (strpos($val, $oldgen) === false) {
                continue;
            }
            else {
                if (strpos($val, $oldgen) == 0) {
                    
                }
            }
        }
        $session_data['attrcart'] = $attritem;
        $this->session->set_userdata($session_data);
    }

    function reference1ForAttr($baseitemIndex) {
        $countattr = 0;
        $attritem = $this->session->userdata['attrcart'];
        $c = 0;
        foreach ($attritem as $attr) {
            $c++;
            if (strpos($attr, $baseitemIndex) === false) {
                
            }
            else {
                if (strpos($attr, $baseitemIndex) == 0) {
                    $countattr++;
                }
            }
        }
        return $countattr;
    }

    function reference2ForAttrMatching($baseitemIndex = '', $val = '') {
        $countattr = 0;
        $retdata = '';
        $attritem = $this->session->userdata['attrcart'];
        foreach ($attritem as $attr) {
            if (strpos($attr, $baseitemIndex) === false) {
                
            }
            else {
                if (strpos($attr, $baseitemIndex) == 0) {
                    $data = explode("|", $attr);
                    $retdata .= end($data) . ':';
                    $countattr++;
                }
            }
        }
        $retdata00 = explode(":", substr($retdata, '0', '-1'));
        $firstData = substr($retdata, '0', '-1');
        $countattr1 = '';
        $retdata1 = '';
        foreach ($attritem as $attr) {
            if (strpos($attr, $val) === false) {
                
            }
            else {
                if (strpos($attr, $val) == 0) {
                    $data1 = explode("|", $attr);
                    $retdata1 .= end($data1) . ':';
                    $countattr1++;
                }
            }
        }
        $retdata11 = explode(":", substr($retdata1, '0', '-1'));
        $common = array_intersect($retdata00, $retdata11);
        if ((count($retdata00) == count($common)) && (count($retdata11) == count($common))) {
            return count($common);
        }
        else {
            return '0';
        }
    }

    function change_sel_attr_genid($oldgen) {
        $attritem = $this->session->userdata['attrcart'];
        foreach ($attritem as $key => $val) {
            if (strpos($val, $oldgen) === false) {
                continue;
            }
            else {
                if (strpos($val, $oldgen) == 0) {
                    $existence = $this->referenceCartExistence($oldgen);
                    if ($existence == '1') {
                        unset($attritem[$key]);
                    }
                }
            }
        }
        $session_data['attrcart'] = $attritem;
        $this->session->set_userdata($session_data);
    }

    function change_sel_genid($oldgen) {
        $newgen = substr($oldgen, 0, strrpos($oldgen, "|"));
        $selitem = $this->session->userdata['sp_details'];
        foreach ($selitem as $key => $val) {
            if (strpos($key, $newgen) === false) {
                continue;
            }
            else {
                if (strpos($key, $newgen) == 0) {
                    unset($selitem[$key]);
                }
            }
        }
        $session_data['sp_details'] = $selitem;
        $this->session->set_userdata($session_data);
    }

    function findDuplicates($data, $dupval) {
        $nb = 0;
        foreach ($data as $key => $val)
            if ($val == $dupval)
                $nb++;
        return $nb;
    }

    public function changedelivery() {
        $id = $this->input->post('deliveryid');
        if ($id == 3) {
            return '1';
        }
        else {
            $raw_openingtime = array();
            if ($this->session->userdata('raw_openingtime')) {
                $raw_openingtime = $this->session->userdata('raw_openingtime');
                foreach ($raw_openingtime as $rot) {
                    if ($rot->PolicyId == $id && $rot->WeekDay == strtolower((date('D')))) {
                        $rotRow = $rot;
                        if (!$rotRow && $id == 2) {
                            return 'Delivery';
                        }
                        if (!$rotRow && $id == 1) {
                            return 'Pick Up';
                        }
                    }
                }
            }
        }
    }

    function getcatname_by_id($id) {
        $categories = $this->session->userdata('categories');
        foreach ($categories as $cat) {
            if ($cat->CatId == $id) {
                return $cat->CatName;
                break;
            }
        }
    }

    function getspselname_by_id($id) {
        $special_criteria_details = $this->session->userdata('special_criteria_details');
        foreach ($special_criteria_details as $scd) {
            if ($scd->SpCatDetailId == $id) {
                return $scd;
                break;
            }
        }
    }

    public function getbasename_by_id($id) {
        $menu_base = $this->session->userdata('menu_base');
        foreach ($menu_base as $menuBase) {
            if ($menuBase->BaseId == $id) {
                return $menuBase->BaseName;
                break;
            }
        }
    }

    public function get_free_attr_by_baseid($id) {
        $menu_base = $this->session->userdata('menu_base');
        foreach ($menu_base as $menuBase) {
            if ($menuBase->BaseId == $id) {
                return $menuBase->FreeAttr;
                break;
            }
        }
    }

    public function getselname_by_id($id) {
        $menu_selection = $this->session->userdata('menu_selection');
        foreach ($menu_selection as $menuSel) {
            if ($menuSel->SelectionId == $id) {
                return $menuSel->SelectionName;
                break;
            }
        }
    }

    public function get_menu_attributes($lavel = '', $val, $baseId, $SelectionId) {
        $menu_attributes_collection = $this->session->userdata('menu_attributes_collection');
        foreach ($menu_attributes_collection as $mac) {
            if ($val == 5) {
                if ($mac->BaseId == $baseId && $mac->SelectionId == $SelectionId && $mac->RestId == $this->config->item('api_id')) {
                    return $mac;
                }
            }
            if ($lavel == 1 || $val == 4) {
                if ($mac->BaseId == $baseId && $mac->SelectionId == 0 && $mac->RestId == $this->config->item('api_id')) {
                    return $mac;
                }
            }
        }
    }

    public function get_menuAttributsConfig($catId, $baseId, $selectionId, $AttrCatId) {
        $menu_attributes_configuration = $this->session->userdata('menu_attributes_configuration');
        foreach ($menu_attributes_configuration as $mac) {
            if ($mac->menu_category == $catId && $mac->menu_base = $baseId && $mac->menu_selection == $selectionId && $mac->attributes_category == $AttrCatId) {
                return $mac;
                break;
            }
        }
    }

    public function get_delivery_plan_new($sinput, $grand_total) {
        $this->requestedData['sinput'] = $sinput;
        $this->requestedData['grand_total'] = $grand_total;
        $this->requestedData['did'] = $this->session->userdata('delareaidforpostcode');
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/get_delivery_plan_new',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $this->requestedData,
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        if (empty($output)) {
            $hitcounter = 1;
            do
                {
                $output = curl_exec($ch);
                $hitcounter++;
                }
            while (!empty($output) || $hitcounter < 3);
        }
        else {
            curl_close($ch);
            return json_decode($output);
        }
    }

    public function get_special_item_details($spdetailsid) {
        $this->requestedData['spdetailsid'] = $spdetailsid;
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/get_special_item_details',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $this->requestedData,
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        if (empty($output)) {
            $hitcounter = 1;
            do
                {
                $output = curl_exec($ch);
                $hitcounter++;
                }
            while (!empty($output) || $hitcounter < 3);
        }
        else {
            echo json_decode($output);
            curl_close($ch);
        }
    }

    function get_sel_list($genid) {
        $newgen = substr($genid, 0, strrpos($genid, "|"));
        $val_arr = "";
        $selitem = $this->session->userdata['sp_details'];
        $count = 0;
        foreach ($selitem as $key => $val) {
            if (strpos($key, $newgen) === false || strpos($key, $newgen) > 0) {
                continue;
            }
            foreach ($val as $nkey => $nval) {
                $count++;
                if ($count > 1)
                    $val_arr .= ":";
                $val_arr .= $nkey;
            }
        }
        return $val_arr;
    }

    public function customer_resgistration($data) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/customer_resgistration',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function activate($data) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/activate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    //Customer Address Book
    function update_primary_address($data) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/update_primary_address/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    function add_address($data) {
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
        return $output;
    }

    function update_address($data) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/update_address/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        debugPrint($output);
        exit();
        return $output;
        curl_close($ch);
    }

    function delete_address($data) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/delete_address/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    function makeRemotCODorder($customerBusket, $customerOrderDetailBusket, $customerOrderDetailAttrBusket, $CustEmail) {

        $data['customer_order'] = objectToArray($customerBusket);
        $data['order_detail'] = objectToArray($customerOrderDetailBusket);
        $data['order_attribute'] = objectToArray($customerOrderDetailAttrBusket);
        $data['CustEmail'] = $CustEmail;
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->config->item('api_host') . 'api/makeRemotCODorder/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_FOLLOWLOCATION => true
        ));
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

}
