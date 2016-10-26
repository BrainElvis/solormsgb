<?php

defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL);

class Orderonline extends Site_Controller {

    public $apiReponseData;

    function __construct() {
        parent::__construct();
        $this->site_title = 'Solo Rms';
        $this->template->set_layout('public');
        $this->load->model('Orderonline_Model');
        $this->load->model('Apimodel');
        $this->load->library('data');
    }

    public function index() {
        $data = [];
        $this->page_title = 'Online Order';
        $this->current_section = 'Order Online';
        $this->body_class[] = 'menu-order-online';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        $restinfo = $this->data->get_rest_info();
        $order_policy = $this->data->get_order_policy();
        //$this->data->clear_menupage_session();
        // $this->session->unset_userdata('cart');
        //$this->session->unset_userdata('sp_details');
        if (empty($restinfo) || empty($order_policy)) {
            //$this->data->clear_menupage_session();
            $apiData = $this->Apimodel->get_api_data();
            if (isset($apiData->status) && isset($apiData->message)) {
                $this->data->set_api_status($apiData->status);
                $this->data->set_api_message($apiData->message);
            }
            if (!empty($apiData->data)) {
                $this->data->set_rest_status($apiData->data->restaurant_status);
                $this->data->set_rest_info($apiData->data->rest_info);
                $this->data->set_order_policy($apiData->data->order_policy);
                $this->data->set_membership($apiData->data->membership);
                $this->data->set_pre_hide_status($apiData->data->pre_hide_status);
                $this->data->set_cuisines($apiData->data->cuisines);
                $this->data->set_deliverypolicy($apiData->data->deliverypolicy);
                $this->data->set_deliveryarea($apiData->data->deliveryarea);
                $this->data->set_delarea($apiData->data->delarea);
                $this->data->set_schedule($apiData->data->schedule);
                $this->data->set_categories($apiData->data->categories);
                $this->data->set_bases($apiData->data->bases);
                $this->data->set_selections($apiData->data->selections);
                $this->data->set_selection_category($apiData->data->selection_category);
                $this->data->set_selcategory($apiData->data->selcategory);
                $this->data->set_cities($apiData->data->cities);
                $this->data->set_areas($apiData->data->areas);
                $this->data->set_policy($apiData->data->policy);
                $this->data->set_globaldiscount($apiData->data->globaldiscount);
                $this->data->set_menu_base($apiData->data->menu_base);
                $this->data->set_menu_attributes_collection($apiData->data->menu_attributes);
                $this->data->set_special_criteria_details($apiData->data->special_criteria_details);
                $this->data->set_menu_selection($apiData->data->menu_selection);
                $this->data->set_menu_attributes_configuration($apiData->data->menu_attributes_configuration);
                $this->data->set_raw_openingtime($apiData->data->raw_openingtime);
                $this->data->set_rest_promotion($this->data->get_rest_promotion());
            }
        }
        $data['api_status'] = $this->data->get_api_status();
        $data['api_message'] = $this->data->get_api_message();
        $data['restaurant_status'] = $this->data->get_rest_status();
        $data['rest_info'] = objectToArray($this->data->get_rest_info());
        $data['order_policy'] = objectToArray($this->data->get_order_policy());
        //$data['membership'] = objectToArray($this->data->get_membership());
        $data['pre_hide_status'] = $this->data->get_pre_hide_status();
        $data['cuisines'] = objectToArray($this->data->get_cuisines());
        $data['deliverypolicy'] = objectToArray($this->data->get_deliverypolicy());
        $data['deliveryarea'] = objectToArray($this->data->get_deliveryarea());
        $data['delarea'] = $this->data->get_delarea();
        $data['schedule'] = $this->data->get_schedule();
        $data['categories'] = objectToArray($this->data->get_categories());
        $data['bases'] = objectToArray($this->data->get_bases());
        $data['selections'] = objectToArray($this->data->get_selections());
        // $data['selection_category'] = $this->data->get_selection_category();
        // $data['selcategory'] = $this->data->get_selcategory();
        $data['cities'] = $this->data->get_cities();
        $data['areas'] = $this->data->get_areas();
        $data['policy'] = $this->data->get_policy();
        // $data['globaldiscount'] = objectToArray($this->data->get_globaldiscount());
        // $data['menu_base'] = objectToArray($this->data->get_menu_base());
        //$data['menu_attributes_collection'] = objectToArray($this->data->get_menu_attributes_collection());
        //$data['menu_selection'] = objectToArray($this->data->get_menu_selection());
        // $data['special_criteria_details'] = objectToArray($this->data->get_special_criteria_details());
        // $data['menu_attributes_configuration'] = objectToArray($this->data->get_menu_attributes_configuration());
        // $data['raw_openingtime'] = $this->data->get_raw_openingtime();
        //debugPrint($data);
        //exit();
        $cartdata = $this->Apimodel->showcart();
        $showcartdata = explode('@@', $cartdata);
        $data['showcartdata'] = $showcartdata[0];
        // debugPrint($this->session->userdata('menu_attributes_collection'));
        $this->render_page('orderonline/index', $data);
    }

    public function menupopup() {
        $basicpopup = $this->Apimodel->get_basicpopup();
        echo $basicpopup;
    }

    public function addtocart() {
        $comments = $this->input->post('comments');
        $quantityOfItem = $this->input->post('quantityOfItem');
        $name = $this->input->post('name');
        $cat = $this->input->post('cat');
        $base = $this->input->post('base');
        $sel = $this->input->post('sel');
        $price = $this->input->post('price');
        $attritemid = $this->input->post('attritemid');
        $current_res_id = $this->input->post('current_res_id');
    }

    public function ajaxcall() {
        $categories = objectToArray($this->data->get_categories());
        $bases = objectToArray($this->data->get_bases());
        $selections = objectToArray($this->data->get_selections());
        $genid = '';
        $quantity = $this->input->post('quantity');
        $comments = $this->input->post('comments');
        $attributesarray = array();
        if (!empty($this->session->userdata['attrcart'])) {
            foreach ($this->session->userdata['attrcart'] as $attributeCart) {
                $attri = $attributeCart;
                $att1 = ( explode('|', $attributeCart) );
                array_pop($att1);
                $att2 = implode('|', $att1);
                if (in_array($att2, $this->session->userdata('cart'))) {
                    $attributesarray[] = $attributeCart;
                }
            }
            array_unique($attributesarray);
        }
        $this->session->set_userdata('attrcart', $attributesarray);
        $normalitem = -1;
        $cur_id = $this->input->post("current_res_id");
        $prev_id = $cur_id;
        if ($this->input->post('attritemid') != '') {
            $data = explode('=', $this->input->post('attritemid'));
            foreach ($data as $postitemid) {
                if ($postitemid) {
                    $postitemid = explode('@', $postitemid);
                    $genid = $postitemid[0] . '|' . $postitemid[1];
                    $itemid = explode('|', $postitemid[0]);
                    $restid = $this->config->item('api_id');
                    $resultcat = array();
                    $resultbase = array();
                    foreach ($categories as $catObj) {
                        if ($catObj['CatName'] == $itemid[0]) {
                            $resultcat = $catObj;
                            foreach ($bases [$resultcat['CatId']] as $baseObj) {
                                if ($baseObj['BaseName'] == $itemid[1]) {
                                    $resultbase = $baseObj;
                                    break;
                                }
                            }
                            break;
                        }
                    }
                    $resultselection = array();
                    if (!is_numeric($itemid[2])) {
                        foreach ($selections as $selCat) {
                            if (!empty($selCat)) {
                                foreach ($selcat as $selBase) {
                                    if (!empty($selBase)) {
                                        foreach ($selBase as $sb) {
                                            if ($sb['BaseId'] == $resultbase['BaseId'] && $sb['SelectionName'] == $itemid[2]) {
                                                $resultselection = $sb;
                                                break;
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        //$attrlist = $this->Apimodel->getallattributesforcat($resultcat['CatId'], $resultbase['BaseId'], $resultselection['SelectionId'], $this->config->item('api_id'));
                    } else {
                        return;
                        //$attrlist = $this->Apimodel->getallattributesforcat($resultcat['CatId'], $resultbase['BaseId'], 0, $this->config->item('api_id'));
                    }
                    $incart = 0;
                    if (isset($this->session->userdata['attrcart'])) {
                        foreach ($this->session->userdata['attrcart'] as $cart) {
                            $sessionattr_data['attrcart'][$incart] = $cart;
                            $incart++;
                        }
                        $newcart = count($this->session->userdata['attrcart']);
                        $sessionattr_data['attrcart'][$newcart] = $genid;
                        $this->session->set_userdata($sessionattr_data);
                    } else {
                        $sessionattr_data['attrcart'][0] = $genid;
                        $this->session->set_userdata($sessionattr_data);
                    }
                }
            }
        }
        if ($this->input->post('spbase') != NULL) {
            $numberOfQuantity = $this->input->post('quantity');
            $normalitem = 0;
            $final_base = $this->input->post('spbase');
            $catid = $this->input->post('spbase');
            $sp_base = $this->Apimodel->get_basenameforspecial($this->input->post('spbase'));
            if (isset($sp_base)) {
                $sp_basename = $sp_base[0]->BaseName;
                $priceattr = explode('*', $this->input->post('price'));
                $price = $priceattr[1];
                $sp_cat = $sp_base[0]->CatName;
                $spbaseid = $sp_base[0]->BaseId;
                $spcatid = $sp_base[0]->CatId;
                $details = explode("==", $this->input->post('items'));
                unset($details[0]);
                foreach ($details as $item) {
                    $item1 = explode(',', $item);
                    //$sp_item = $this->Apimodel->get_special_item_details($item1[0]);
                    $price += $item1[1];
                    $sp_details[$item1[0] . '|' . $spbaseid] = $item1[1];
                }
                $genid = '@' . $spcatid . '|' . $spbaseid . '|' . $this->input->post('price');
                $spgenid = '@' . $spcatid . '|' . $spbaseid;
                if (isset($this->session->userdata['sp_details']))
                    foreach ($this->session->userdata['sp_details'] as $key => $spcart) {
                        if ($spgenid == $key)
                            $spgenid = '1/' . $spgenid;
                    }
                $existence1 = 0;
                if (isset($numberOfQuantity)) {
                    $tempgen1 = '';
                    $tempgen2 = '';
                    if ($this->session->userdata('cart')) {
                        $existence1 = $this->findDuplicateSpecial($this->session->userdata('cart'), $this->session->userdata('attrcart'), $genid);
                    }

                    $tempgen2 = $genid;
                    $tempgen1 = $spgenid;
                    if ($existence1 == 0) {
                        for ($i = 0; $i <= ( $numberOfQuantity - 1 ); $i++) {
                            $co = '';
                            for ($j = 1; $j < ( $i + 1 ); $j++) {
                                
                            }
                            $spgenid2 = $co . $tempgen2;
                            $spgenid = $co . $tempgen1;
                            if ($this->session->userdata('sp_details') != NULL) {
                                $specialdatainarray['sp_details'] = $this->session->userdata('sp_details');
                                $specialdatainarray['sp_details'][$spgenid] = $sp_details;
                                $this->session->set_userdata($specialdatainarray);
                            } else {
                                $special_details['sp_details'][$spgenid] = $sp_details;
                                $this->session->set_userdata($special_details);
                            }
                        }
                    } else {
                        for ($i = 0; $i <= ( $numberOfQuantity - 1 ); $i++) {
                            $co = '';
                            for ($j = 1; $j < ( $i + $existence1 + 1 ); $j++) {
                                
                            }
                            $spgenid2 = $co . $tempgen2;
                            $spgenid = $co . $tempgen1;
                            if ($this->session->userdata('sp_details') != NULL) {
                                $specialdatainarray['sp_details'] = $this->session->userdata('sp_details');
                                $specialdatainarray['sp_details'][$spgenid] = $sp_details;
                                $this->session->set_userdata($specialdatainarray);
                            } else {
                                $special_details['sp_details'][$spgenid] = $sp_details;
                                $this->session->set_userdata($special_details);
                            }
                        }
                    }
                }
                if (isset($this->session->userdata['cart']))
                    foreach ($this->session->userdata['cart'] as $cart) {
                        $existsid = explode('|', $cart);
                        $existsid = $existsid[0] . '|' . $existsid[1];
                        $genidcheck = explode('|', $genid);
                        $genidcheck = $genidcheck[0] . '|' . $genidcheck[1];
                        if ($existsid == $genidcheck)
                            $genid = '1/' . $genid;
                    }
                $attrbase = $this->input->post('spbase');
            }
            $details = explode("==", $this->input->post('items'));
            unset($details[0]);
        }
        else {
            if ($this->input->post('itemid') == NULL) {
                $normalitem = 1;
                $final_base = $this->input->post('base');
                $final_cat = $this->input->post('cat');
                $final_sel = $this->input->post('sel');

                $category = array();
                $base = array();
                foreach ($categories as $catObj) {
                    if ($catObj['CatId'] == $final_cat) {
                        $category = $catObj;
                        foreach ($bases [$category['CatId']] as $baseObj) {
                            if ($baseObj['BaseId'] == $final_base) {
                                $base = $baseObj;
                                break;
                            }
                        }
                        break;
                    }
                }
                $catename = '';
                if (!empty($category)) {
                    $catename = $category['CatName'];
                }
                $basename = '';
                if (!empty($base)) {
                    $basename = $base['BaseName'];
                }
                $selname = $this->input->post('name');
                $price = $this->input->post('price');
                $numberOfQuantity = $this->input->post('quantityOfItem');
                $selexists = explode("==", $selname);
                if ($selexists[1] || $this->input->post('sel') != 0) {
                    if ($selexists[1]) {
                        if ($this->input->post('sel') != 0) {
                            $genid = str_replace("'", "", $this->input->post('cat')) . '|' . str_replace("'", "", $this->input->post('base')) . '|' . str_replace("'", "", $selname) . "==" . $this->input->post('sel') . '|' . $price;
                        } else {
                            $genid = str_replace("'", "", $this->input->post('cat')) . '|' . str_replace("'", "", $this->input->post('base')) . '|' . str_replace("'", "", $selname) . '|' . $price;
                        }
                    } else {
                        $genid = str_replace("'", "", $this->input->post('cat')) . '|' . str_replace("'", "", $this->input->post('base')) . '|' . $this->input->post('sel') . '|' . $price;
                    }
                } else {
                    $genid = str_replace("'", "", $this->input->post('cat')) . '|' . str_replace("'", "", $this->input->post('base')) . '|' . $price;
                }
                if (isset($this->session->userdata['cart'])) {
                    foreach ($this->session->userdata['cart'] as $cart) {
                        $existsid = explode('|', $cart);
                        $existsid = $existsid[0] . '|' . $existsid[1];
                        $genidcheck = explode('|', $genid);
                        $genidcheck = $genidcheck[0] . '|' . $genidcheck[1];
                        if ($existsid == $genidcheck)
                            $genid = '1/' . $genid;
                    }
                }
                $attrbase = $this->input->post('base');
            }
        }
        $_SESSION['genid'] = $geniditem = $genid;
        if ($this->input->post('itemid') != NULL) {
            $genid = $this->input->post('itemid');
        }
        $incart = 0;
        if (isset($this->session->userdata['cart'])) {
            foreach ($this->session->userdata['cart'] as $cart) {
                $session_data['cart'][$incart] = $cart;
                $incart++;
            }
            $newcart = '';
            if (isset($numberOfQuantity)) {
                $newcart = count($this->session->userdata['cart']);
                $tempgen = $genid;
                $existence = $this->findDuplicates2($this->session->userdata['cart'], $genid);
                if ($existence == 0) {
                    for ($i = 0; $i <= ( $numberOfQuantity - 1 ); $i++) {
                        $co = '';
                        for ($j = 1; $j < ( $i + 1 ); $j++) {
                            
                        }
                        $genid = $co . $tempgen;
                        $session_data['cart'][( $i + $newcart )] = $genid;
                    }
                    if ($comments)
                        $_SESSION['comments'][$genid] = $comments;
                    else
                        $_SESSION['comments'][$genid] = '';
                }
                else {
                    $genid = '1/' . $tempgen;
                    for ($i = 0; $i <= ( $numberOfQuantity - 1 ); $i++) {
                        $co = '';
                        for ($j = 1; $j < ( $i + $existence + 1 ); $j++) {
                            
                        }
                        $genid = $co . $tempgen;
                        $session_data['cart'][( $i + $newcart )] = $genid;
                    }
                    if ($comments)
                        $_SESSION['comments'][$genid] = $comments;
                    else
                        $_SESSION['comments'][$genid] = '';
                }
            }
            else {
                $session_data['cart'][$newcart] = $genid;
                if ($comments)
                    $_SESSION['comments'][$genid] = $comments;
                else
                    $_SESSION['comments'][$genid] = '';
            }
        }
        else {
            $tempgen = $genid;
            for ($i = 0; $i <= ( $numberOfQuantity - 1 ); $i++) {
                $co = '';
                for ($j = 1; $j < ( $i + 1 ); $j++) {
                    
                }
                $genid = $co . $tempgen;
                $session_data['cart'][$i] = $genid;
            }
            if ($comments)
                $_SESSION['comments'][$genid] = $comments;
            else
                $_SESSION['comments'][$genid] = '';
        }
        if (isset($this->session->userdata['spdatails'])) {
            $spdataexists = $this->session->userdata['spdatails'];
            if (isset($details))
                $spdataexists[$genid] = $details;
            if (isset($details))
                $session_data['spdatails'] = $spdataexists;
        }
        else {
            if (isset($details))
                $session_data['spdatails'][$genid] = $details;
        }
        foreach ($session_data['cart'] as $in => $ca) {
            if (strstr($ca, '@|') != false)
                unset($session_data['cart'][$in]);
        }
        $this->session->set_userdata($session_data);
        $toppings = array();
        if (isset($_POST['toppings']))
            $toppings = explode("++", substr($_POST['toppings'], 0, -2));
        if (isset($sp_base)) {
            for ($i = 0; $i < sizeof($toppings); $i++) {
                $this->addattr2($geniditem, $toppings[$i], $quantity);
            }
        }
        if (1) {
            $strarray = explode('@@', $this->showcart($genid));
            $cartContent = $strarray[0];
        } else {
            $cartContent = '';
        }
        if (array_key_exists(1, $strarray) && array_key_exists(2, $strarray)) {
            echo $cartContent . '@@' . $strarray[1] . '@@' . $genid . '@@' . $strarray[2] . '@@' . $geniditem;
        } else {
            echo $cartContent . '@@' . $genid . '@@' . $geniditem;
        }
    }

    function addattr() {
        $genid = $this->input->post('genid');
        $itemids = explode(',', $this->input->post('itemid'));
        foreach ($itemids as $itemid) {
            if ($itemid) {
                $menu_attributes_collection = $this->session->userdata('menu_attributes_collection');
                $result = array();
                foreach ($menu_attributes_collection as $mac) {
                    if ($itemid == $mac->AttrId) {
                        $result = $mac;
                        break;
                    }
                }

                if (count($result)) {
                    if ($result->SpCatDetailId) {
                        $itemid .= '_' . $result->SpCatDetailId;
                    }
                    $newgenid = $genid . '|' . $itemid;
                    $incart = 0;
                    if (!in_array($newgenid, $this->session->userdata['attrcart'])) {
                        if (isset($this->session->userdata['attrcart'])) {
                            foreach ($this->session->userdata['attrcart'] as $cart) {
                                $sessionattr_data['attrcart'][$incart] = $cart;
                                $incart++;
                            }
                            $newcart = count($this->session->userdata['attrcart']);
                            $sessionattr_data['attrcart'][$newcart] = $newgenid;
                            $this->session->set_userdata($sessionattr_data);
                        } else {
                            $sessionattr_data['attrcart'][0] = $newgenid;
                            $this->session->set_userdata($sessionattr_data);
                        }
                    }
                }
            }
        }
        $attributesarray = array();
        foreach ($this->session->userdata['attrcart'] as $attributeCart) {
            $attri = $attributeCart;
            $att1 = ( explode('|', $attributeCart) );
            array_pop($att1);
            $att2 = implode('|', $att1);
            if (in_array($att2, $this->session->userdata['cart'])) {
                $attributesarray[] = $attributeCart;
            }
        }
        array_unique($attributesarray);
        $this->session->set_userdata('attrcart', $attributesarray);
    }

    public function specialpopup() {
        $specialpopup = $this->Apimodel->get_specialpopup();
        echo $specialpopup;
    }

    public function attrfortopping() {
        $attrfortopping = $this->Apimodel->get_attrfortopping();
        echo $attrfortopping;
    }

    public function getdefForSpecial() {
        $result = $this->Apimodel->getdefForSpecial();
        echo $result;
    }

    function findDuplicates($data, $dupval) {
        $nb = 0;
        foreach ($data as $key => $val)
            if ($val == $dupval)
                $nb++;
        return $nb;
    }

    function findDuplicates2($data, $dupval) {
        $nb = 0;
        foreach ($data as $key => $val) {
            $explodedgen = explode("/", $val);
            if ($dupval == end($explodedgen)) {
                $nb++;
            }
        }
        return $nb;
    }

    function showcart() {
        echo $this->Apimodel->showcart();
    }

    public function changedelivery() {
        if ($this->session->userdata('deliverytype')) {
            $this->session->unset_userdata('deliverytype');
        }
        $this->session->set_userdata('deliverytype', $this->input->post('deliveryid'));
        echo $this->Apimodel->changedelivery();
    }

    function get_continuewith_collection() {
        $this->session->set_userdata(array(
            'deliverytype' => 1
        ));
        echo 1;
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
            } else {
                echo $str = "0*@*0*@*0*@*0";
            }
        }
    }

    function lessitem() {
        if ($this->input->post('itemlessid') != NULL) {
            if ($this->session->userdata('attrcart')) {
                foreach ($this->session->userdata('attrcart') as $keyattr => $attrcartitem) {
                    $unkeys = explode('|', $attrcartitem);
                    $pop = array_pop($unkeys);
                    $id = $this->input->post('itemlessid') . "|" . $pop;
                }
            }
            $less = $this->input->post('itemlessid');
            if ($this->session->userdata('cart')) {
                $arr = $this->session->userdata('cart');
                foreach ($arr as $key => $val) {
                    $count = 0;
                    if (( $less == $val ) && ( $count == 0 )) {
                        unset($arr[$key]);
                        $count = 1;
                        break;
                    }
                }
                $session_data['cart'] = $arr;
                $this->session->set_userdata($session_data);
            }
        }
        echo $this->Apimodel->showcart();
    }

    function removeitem() {
        if ($this->input->post('itemlessid') != NULL) {
            if ($this->session->userdata('attrcart')) {
                foreach ($this->session->userdata('attrcart') as $keyattr => $attrcartitem) {
                    $unkeys = explode('|', $attrcartitem);
                    $pop = array_pop($unkeys);
                    $id = $this->input->post('itemlessid') . "|" . $pop;
                }
            }
            $less = $this->input->post('itemlessid');
            if ($this->session->userdata('cart')) {
                $arr = $this->session->userdata('cart');
                foreach ($arr as $key => $val) {
                    $count = 0;
                    if (( $less == $val ) && ( $count == 0 )) {
                        unset($arr[$key]);
                        $count = 1;
                    }
                }
                $session_data['cart'] = $arr;
                $this->session->set_userdata($session_data);
            }
        }
        echo $this->Apimodel->showcart();
    }

    function lessattribute() {
        if ($this->session->userdata('attrcart')) {
            $attr = $this->session->userdata('attrcart');
            $less = $this->input->post('attr');
            foreach ($attr as $attrkey => $attrcart) {
                if ($attrcart == $less) {
                    unset($attr[$attrkey]);
                }
            }
            $session_attrdata['attrcart'] = $attr;
            $this->session->set_userdata($session_attrdata);
        }
    }

    function findDuplicateSpecial($data, $attrcart, $dupval) {
        $nb = 0;
        foreach ($data as $key => $val) {
            $explodedgen = explode("/", $val);
            $spGen = explode("|", end($explodedgen));
            $requiredGen = end($explodedgen);
            if ($dupval == $requiredGen) {
                $nb++;
            }
        }
        return $nb;
    }

    public function test() {
        $result = $this->Apimodel->get_test();
    }

    function addattr2($genId = '', $toppingId = '', $quantity = '') {
        $genid = $genId;
        $itemids = explode(',', $toppingId);
        foreach ($itemids as $itemid) {
            if ($itemid) {
                $menu_attributes_collection = $this->session->userdata('menu_attributes_collection');
                $result = array();
                foreach ($menu_attributes_collection as $mac) {
                    if ($itemid == $mac->AttrId) {
                        $result = $mac;
                        break;
                    }

                    if (count($result)) {
                        if ($result->SpCatDetailId) {
                            $itemid .= '_' . $result->SpCatDetailId;
                        }
                        $newgenid = $genid . '|' . $itemid;
                        $incart = 0;
                        if (!in_array($newgenid, $this->session->userdata['attrcart'])) {
                            if (isset($this->session->userdata['attrcart'])) {
                                foreach ($this->session->userdata['attrcart'] as $cart) {
                                    $sessionattr_data['attrcart'][$incart] = $cart;
                                    $incart++;
                                }
                                $newcart = count($this->session->userdata['attrcart']);
                                $sessionattr_data['attrcart'][$newcart] = $newgenid;
                                $this->session->set_userdata($sessionattr_data);
                            } else {
                                $sessionattr_data['attrcart'][0] = $newgenid;
                                $this->session->set_userdata($sessionattr_data);
                            }
                        }
                    }
                }
            }
            $attributesarray = array();
            foreach ($this->session->userdata['attrcart'] as $attributeCart) {
                $attri = $attributeCart;
                $att1 = ( explode('|', $attributeCart) );
                array_pop($att1);
                $att2 = implode('|', $att1);
                if (in_array($att2, $this->session->userdata['cart'])) {
                    $attributesarray[] = $attributeCart;
                }
            }
            array_unique($attributesarray);
            $this->session->set_userdata('attrcart', $attributesarray);
        }
    }

}
