<?php
if ($this->input->post('status') == 1) {
    $this->Apimodel->rearrange_cart_item();
}
if ($this->session->userdata('rest_info')) {
    $resname = $this->session->userdata('rest_info');
    $restname = $resname->RestName;
}
if ($this->session->userdata('deliverypolicy')) {
    $cdis = $this->session->userdata('deliverypolicy');
    $cdi = $cdis[0];
    $minorder = $cdi->MinOrder;
}

if (!$this->session->userdata('customer')) {
    $page = base_url() . 'user/login/';
} else {
    $page = base_url() . 'user/checkout/';
}
$deliverytype = 1;
if ($this->session->userdata('deliverytype')) {
    $deliverytype = $this->session->userdata('deliverytype');
}

$unique = '';
if ($this->session->userdata('cart')) {
    $unique = array_unique($this->session->userdata['cart']);
}

if (!empty($unique)) {
    foreach ($unique as $val) {
        $dup[$val] = $this->Apimodel->findDuplicates($this->session->userdata['cart'], $val);
    }
}
$attribute_sets = array();
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

    $arrunique = $this->Apimodel->arrayUnique($array_attribute);
    foreach ($arrunique as $key1 => $arr) {
        foreach ($arr as $key2 => $attr) {
            $attribute_sets[$key1][$key2] = $this->Apimodel->key2($key2);
            $dupattr[$key1][$key2] = $this->Apimodel->findDuplicates($this->session->userdata['attrcart'], $attr);
        }
    }
}
$restaurant_status = 0;
if ($this->session->userdata('restaurant_status')) {
    $restaurant_status = $this->session->userdata('restaurant_status');
}
$ord_plc = array();
if ($this->session->userdata('order_policy')) {
    $ord_plc = $order_policy = $this->session->userdata('order_policy');
}
$message_for_view_menu = '';
if ((!$message_for_view_menu ) && (count($order_policy) < 1) || (count($ord_plc) == 1 && $ord_plc[0]->PolicyId == 3)) {
    $message_for_view_menu = $this->lang->line('res_pri_not');
}
$pre_hide_status = 0;
if ($this->session->userdata('pre_hide_status')) {
    $pre_hide_status = $this->session->userdata('pre_hide_status');
}
if (!$message_for_view_menu && $pre_hide_status) {
    $message_for_view_menu = $this->lang->line('res_pri_not');
}
if (!$restaurant_status) {
    $message_for_view_menu = $this->lang->line('res_pri_not');
}
$spitem = array();
if ($this->session->userdata('sp_details')) {
    $spitem = $this->session->userdata('sp_details');
}
$grand_total = 0.0;
$total_com = 0.0;
$total_wcom = 0.0;
$total_tax = 0.0;
?>

<div class="mycart theiaStickySidebar">
    <div class="cartheading">
        <div class="cartheading_text"><?php echo $this->lang->line('online_cart_your_ordeer') ?></div>
        <!--<h2><a href="javascript:void(0);" onclick="cancelcart();">Empty</a></h2>-->
    </div>
    <div class="cartdelpick">
        <ul>

            <li>
                <span class="delpick">
                    <?php
                    if ((count($ord_plc) == 1) || (count($ord_plc) == 2 && $ord_plc[1]->PolicyId == 3)) {
                        if ($ord_plc[0]->PolicyId == 1) {
                            ?> Pick up only  <?php } ?>
                        <?php if ($ord_plc[0]->PolicyId == 2) { ?> Delivery Only  <a href='javascript:void(0)' onclick='changePostcode(2, "<?= $this->config->item('api_id') ?>", 0)'  title='Change Area' class='edit-icon'></a><?php } ?>
                    <?php } else { ?>
                        <?php
                        $clck = '';
                        $dvck = '';
                        if ($deliverytype == 1) {
                            $clck = 'checked';
                        }
                        if ($deliverytype == 2) {
                            $dvck = 'checked';
                        }
                        ?>
                        <?php isset($areaid) ? $areaid = $areaid : $areaid = '' ?>
                        <!--<input type='radio' name='deliverytype' value='2' <?= $dvck ?> id='delivery_type' onclick='changemenucard(2, "<?= $this->config->item('api_id') ?>", "<?= $areaid ?>")' /><?= $this->lang->line('delivery_status') ?>-->
                        <input type='radio' name='deliverytype' value='2' <?= $dvck ?> id='delivery_type' onclick='getDeliveryArea()' /><?= $this->lang->line('delivery_status') ?>
                        <!--<a href='javascript:void(0)' onclick='changePostcode(2, "<?= $this->config->item('api_id') ?>", 0)'  title='Change Area' class='edit-icon'>&nbsp;Edit&nbsp;</a>-->
                        <input type='radio' name='deliverytype' value='1' <?= $clck ?> id='collection_type' onclick='changemenucard(1, "<?= $this->config->item('api_id') ?>", "<?= $areaid ?>")'/> <?= $this->lang->line('collection_status') ?> 
                    <?php } ?>
                </span>
            </li>
        </ul>
    </div>
    <div class="cartscroll">
        <div class="jspContainer" style="width: 269px; height: 0px;"><div class="jspPane" style="padding: 0px; top: 0px; left: 0px; width: 269px;"></div></div>
        <?php
        $trcolor = '#fef0f0';
        if (!empty($unique)) {
            $unique = array_reverse($unique);
            krsort($unique);
        }
        ?>
        <?php if (!empty($unique)): ?>
            <?php foreach ($unique as $key => $un) : ?>  
                <div class="cartitem">
                    <span  class="loading centered" id="ajaxLoadingShowcart" style="display:none;"><img src="<?php echo ASSETS_SITE_IMAGE_PATH . 'ajax-loader.gif' ?>" alt="Loading..."/></span>
                    <ul>
                        <?php
                        $total_for_tax = 0;
                        $trcolor = ($trcolor == '#d7ffc4') ? '#d7ffc4' : '#d7ffc4';
                        $data111 = "";
                        $arr_cart = explode("|", $un);
                        $attrSpecialPrice = 0;
                        ?>
                        <?php
                        if (!empty($spitem)) {
                            foreach ($spitem as $key12 => $val12) {
                                if (count($arr_cart) == 3) {
                                    $details_arr_key = $arr_cart[0] . '|' . $arr_cart[1];
                                    if ($details_arr_key == $key12) {
                                        foreach ($val12 as $key13 => $val13) {
                                            $asss = explode("|", $key13);
                                            $spselnameget = $this->Apimodel->getspselname_by_id($asss[0]);
                                            $spbasenameget = $this->Apimodel->getbasename_by_id($spselnameget->BaseId);

                                            if (trim($spbasenameget, '\n') == trim($spselnameget->SpItemName, '\n')) {
                                                $data111.= "[" . $spselnameget->SpItemName . "]";
                                            } else {
                                                $data111.= "[" . $spbasenameget . " - " . $spselnameget->SpItemName . "]";
                                            }
                                            if (isset($attribute_sets) && !empty($attribute_sets)) {
                                                $attrtable = "";
                                                $attrcnt = 0;
                                                $freeattrcnt = 0;
                                                foreach (array_keys($attribute_sets) as $attrkeys) {
                                                    $thisitem = substr($attrkeys, 0, strrpos($attrkeys, "|"));
                                                    if ($thisitem != $un)
                                                        continue;
                                                    $unkeys = explode('|', $attrkeys);
                                                    $pop = array_pop($unkeys);
                                                    $unkeys = $un . '|' . $pop;
                                                    if (isset($attribute_sets[$unkeys]) && !empty($attribute_sets[$unkeys])) {

                                                        foreach ($attribute_sets[$unkeys] as $attrkey => $attrdetails) {
                                                            if ($attrdetails[0]->SpCatDetailId == $asss[0]) {

                                                                if ($freeattrcnt >= $freeAttr) {
                                                                    $attrSpecialPrice+=$attrdetails[0]->AttrPrice;
                                                                }

                                                                $attrname = $attrdetails[0]->AttrName;
                                                                if ($attrdetails[0]->Default != 1) {

                                                                    if ($attrcnt > 0)
                                                                        $attrtable.="<br/>";
                                                                    $attrtable.="<a title='Remove this topping' style='color: #4f5151;  font-size:11px;' href='javascript:void(0)' onclick='removeattr(\"$unkeys\")'>+Add: $attrname - " . $attrdetails[0]->AttrPrice . "</a>";
                                                                    $attrcnt = $attrcnt + 1;
                                                                    $freeattrcnt++;
                                                                }else {

                                                                    if ($attrcnt > 0)
                                                                        $attrtable.="<br/>";

                                                                    if ($attrdetails[0]->defaultlock == 1) {
                                                                        $attrtable.="-Remove: $attrname - " . $attrdetails[0]->AttrPrice;
                                                                    } else {
                                                                        $attrtable.="<a title='Remove this topping' style='color: #4f5151; font-size:11px;' href='javascript:void(0)' onclick='removeattr(\"$unkeys\")'>-Remove: $attrname - " . $attrdetails[0]->AttrPrice . "</a>";
                                                                    }
                                                                    $attrcnt = $attrcnt + 1;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                $attrtable.="";
                                            }
                                            if (isset($attrtable) && $attrtable != " ()")
                                                $data111.= $attrtable . "<br />";
                                        }
                                    }
                                }
                            }
                        }
                        $attrtable = '';
                        $discount_item_price = 0.0;
                        $id_item = $unique[$key];
                        $total = 0.0;

                        $arrKey = explode('|', $un);
                        $catname = '';
                        $p_p_u = '';
                        $name = '';
                        $com_status = '';
                        if (count($arrKey) == 3) {
                            $catname = array_reverse(explode('/', $arrKey[0]));
                            $catname = $catname[0];
                            $catname = array_reverse(explode('@', $catname)); // This is for special category item only @Added By : Rubel @30-03-2012
                            $catname = $catname[0];
                            $basename = $arrKey[1];
                            $name = $arrKey[1];
                            $ppu_arr = explode('*', $arrKey[2]);
                            $p_p_u = $ppu_arr[1];
                            if ($ppu_arr[0] == $ppu_arr[1]) {
                                $com_status = 0;
                            } else {
                                $com_status = 1;
                            }
                            $flag = 1;
                        }
                        if (count($arrKey) == 4) {
                            $catname = array_reverse(explode('/', $arrKey[0]));
                            $catname = $catname[0];
                            $catname = array_reverse(explode('@', $catname));
                            $catname = $catname[0];
                            $basename = $arrKey[1];
                            $selection_name = $arrKey[2];
                            $name = $arrKey[1] . '|' . $arrKey[2];
                            $ppu_arr = explode('*', $arrKey[3]);
                            $p_p_u = $ppu_arr[1];
                            if ($ppu_arr[0] == $ppu_arr[1]) {
                                $com_status = 0;
                            } else {
                                $com_status = 1;
                            }
                            $flag = 0;
                        }
                        //$cat_tax = array(); //$this->db->get_where('menu_category', array('CatId' => $catname))->row()->Tax;
                        $cat_tax = 0;
                        if ($this->session->userdata('categories')) {
                            $categories = $this->session->userdata('categories');
                            $catname = '';
                            foreach ($categories as $catObj) {
                                if ($catObj->CatId == $catname) {
                                    $cat_tax = $catObj->Tax;
                                    break;
                                }
                            }
                        }
                        $no_of_ins = $dup[$un];
                        $total = $p_p_u * $no_of_ins;
                        $total_for_tax += $p_p_u * $no_of_ins;
                        if ($com_status == "1") {
                            $total_com = $total_com + $p_p_u * $no_of_ins;
                        } else {
                            $total_wcom = $total_wcom + $p_p_u * $no_of_ins;
                        }

                        $nameexplode = explode('==', $name);
                        $name = array_shift($nameexplode);
                        $selection_name_a = explode('|', $name);

                        if (count($selection_name_a) > 1) {
                            if (trim($selection_name_a[1], '\n') == trim($selection_name_a[0], '\n')) {
                                $basenameget = $this->Apimodel->getbasename_by_id($selection_name_a[0]);
                                $name = $basenameget . "";
                            } else {

                                $basenameget = $this->Apimodel->getbasename_by_id($selection_name_a[0]);
                                $name = $basenameget;
                                if (strlen($selection_name_a[1]) > 0) {
                                    $selnameget = $this->Apimodel->getselname_by_id($selection_name_a[1]);
                                    $name .= " - " . $selnameget;
                                }
                                $name .= "";
                            }
                        } else {
                            $basenameget = $this->Apimodel->getbasename_by_id($selection_name_a[0]);
                            $name = $basenameget . "";
                        }
                        foreach ($nameexplode as $nitem) {
                            if (strlen($nitem) > 0) {
                                $selnameget = $this->Apimodel->getselname_by_id($nitem);
                                $name.='[' . $selnameget . ']';
                            }
                        }
                        $position = NULL;
                        ?>
                        <?php if ($position != NULL): ?>
                            <?php if ($un[$position - 1] == 0): ?>
                                <li>
                                    <span class="itemdesc">
                                        <div class="itemname"><?= $name ?></div>
                                        <div class="itemqty">Quantity : <span class="qtyred"><?= $no_of_ins ?>*<?= to_currency($p_p_u) ?></span></div>
                                    </span>
                                    <span class="itemprice">
                                        <div class="pricefont1"><?= to_currency($total) ?></div>
                                    </span>
                                </li>
                            <?php endif; ?>
                            <?php if ($un[$position - 1] == 1) : ?>
                                <li>
                                    <span class="itemdesc">
                                        <div class="itemname"><?= $name ?></div>
                                        <!-- <div class="itemdesc"></div>-->
                                        <div class="itemqty">Quantity : <span class="qtyred"><?= $no_of_ins ?>*<?= to_currency($p_p_u) ?></span></div>
                                    </span>
                                    <span class="itemprice">
                                        <div class="pricefont1"><?= to_currency($total) ?></div>
                                    </span>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php
                            $attrprice = $attrSpecialPrice;
                            $total_attr = 0.0;
                            $attrtable1 = "";
                            if (isset($attribute_sets) && !empty($attribute_sets)) {
                                $attrtable = "";
                                $attrtable1 = "";
                                $attrcnt = 0;
                                $freeattrcnt = 0;
                                foreach (array_keys($attribute_sets) as $attrkeys) {
                                    $val = $unkeys = explode('|', $attrkeys);
                                    $pop = array_pop($unkeys);
                                    $unkeys = $un . '|' . $pop;
                                    if (count($val) == 4) {
                                        $selectionId = 0;
                                        $baseId = $val[1];
                                        $catId = 0;
                                        $vals = explode('/', $val[0]);
                                        $catId = array_pop($vals);
                                    } else if (count($val) == 5) {
                                        $selectionId = (implode(',', explode('==', $val[2])));
                                        $selectionId = preg_replace('/,/', '', $selectionId, 1);
                                        $baseId = $val[1];
                                        $vals = explode('/', $val[0]);
                                        $catId = array_pop($vals);
                                    }

                                    if (array_key_exists($unkeys, $attribute_sets)) {
                                        foreach ($attribute_sets[$unkeys] as $attrkey => $attrdetails) {
                                            $level = '';
                                            if (count($val) == 5) {
                                                $strsql = $this->Apimodel->get_menu_attributes($level, count($val), $baseId, $selectionId);
                                                if (!empty($strsql)) {
                                                    $level = 1;
                                                    $selectionId = 0;
                                                } else {
                                                    $selection = explode(',', $selectionId);
                                                    $selectionId = array_pop($selection);
                                                }
                                            }if ($level == 1 || count($val) == 4) {
                                                $strsql = $this->Apimodel->get_menu_attributes($level, count($val), $baseId, $selectionId);
                                                if (!empty($strsql)) {
                                                    $level = 1;
                                                    $selectionId = 0;
                                                    $baseId = 0;
                                                }
                                            }
                                            $menuAttributsConfig = $this->Apimodel->get_menuAttributsConfig($catId, $baseId, $selectionId, $attrdetails[0]->AttrCatId);
                                            if ($this->session->userdata('attribuesfreecount')) {
                                                $attribuesfreecount = $this->session->userdata('attribuesfreecount');
                                            }
                                            if (!empty($menuAttributsConfig) && count($menuAttributsConfig) > 0) {
                                                $attribuesfreecount[$un . '|' . $attrdetails[0]->AttrCatId . '|totalfree'] = $menuAttributsConfig->free_attributes;
                                            } else {
                                                $attribuesfreecount[$un . '|' . $attrdetails[0]->AttrCatId . '|totalfree'] = 0;
                                            }
                                            $attribuesfreecount[$un . '|' . $attrdetails[0]->AttrCatId . '|count'] = 0;
                                            $this->session->set_userdata('attribuesfreecount', $attribuesfreecount);
                                        }
                                    }
                                }

                                foreach (array_keys($attribute_sets) as $attrkeys) {
                                    $thisitem = substr($attrkeys, 0, strrpos($attrkeys, "|"));
                                    if (sizeof(explode('@', $un)) > 1)
                                        continue;
                                    if ($thisitem != $un)
                                        continue;
                                    $unkeys = explode('|', $attrkeys);
                                    $pop = array_pop($unkeys);
                                    $unkeys = $un . '|' . $pop;
                                    if (isset($attribute_sets[$unkeys]) && !empty($attribute_sets[$unkeys])) {
                                        foreach ($attribute_sets[$unkeys] as $attrkey => $attrdetails) {
                                            $no_of_attr = $dupattr[$unkeys][$attrdetails[0]->AttrId];
                                            if ($attrdetails[0]->Default == 0) {
                                                $attribuesfreecount = $this->session->userdata('attribuesfreecount');
                                                $count = intval($attribuesfreecount[$un . '|' . $attrdetails[0]->AttrCatId . '|count']);
                                                $count++;
                                                $attribuesfreecount[$un . '|' . $attrdetails[0]->AttrCatId . '|count'] = $count;
                                                $this->session->set_userdata('attribuesfreecount', $attribuesfreecount);
                                            }
                                            $attribuesfreecount = $this->session->userdata('attribuesfreecount');
                                            if (($attribuesfreecount[$un . '|' . $attrdetails[0]->AttrCatId . '|count'] > $attribuesfreecount[$un . '|' . $attrdetails[0]->AttrCatId . '|totalfree']) && $attrdetails[0]->Default == 0) {
                                                $attrprice+=$attrdetails[0]->AttrPrice * (int) $no_of_attr;
                                            }
                                            $attrname = $attrdetails[0]->AttrName;
                                            if ($attrdetails[0]->Default != 1) {
                                                if ($attrcnt > 0)
                                                    $attrtable1.="<br/>";
                                                $attrtable1.="<a title='Remove this topping' class='item-remove-title' href='javascript:void(0)' onclick='removeattr(\"$unkeys\")'>+Add: $attrname - " . $attrdetails[0]->AttrPrice . "</a>";
                                                $attrcnt = $attrcnt + 1;
                                                $freeattrcnt++;
                                            }else {
                                                if ($attrcnt > 0)
                                                    $attrtable1.="<br/>";
                                                if ($attrdetails[0]->defaultlock == 1) {
                                                    $attrtable1.="-Remove: $attrname - " . $attrdetails[0]->AttrPrice;
                                                } else {
                                                    $attrtable1.="<a title='Remove this topping' class='item-remove-title' href='javascript:void(0)' onclick='removeattr(\"$unkeys\")'>-Remove: $attrname - " . $attrdetails[0]->AttrPrice . "</a>";
                                                }
                                                $attrcnt = $attrcnt + 1;
                                            }
                                        }
                                    }
                                }
                                $total+=$attrprice * $no_of_ins;
                                $total_for_tax += $attrprice * $no_of_ins;
                                $total_attr += $attrprice * $no_of_ins;
                                $attrtable2 = "";
                            }
                            if ($attrtable1 && isset($attrtable1)) {
                                $attrtable = $attrtable . $attrtable1 . $attrtable2;
                            } else {
                                $attrtable = '';
                            }
                            $grand_total+=$total;

                            if ($com_status == "1") {
                                $total_com = $total_com + $total_attr;
                            } else {
                                $total_wcom = $total_wcom + $total_attr;
                            }

                            $nameexplode = explode('==', $name);
                            $name = array_shift($nameexplode) . '&nbsp;';
                            foreach ($nameexplode as $nitem) {
                                if (strlen($nitem) > 0) {
                                    $name.='[' . $nitem . ']';
                                }
                            }
                            $attr_sel = "";
                            if (isset($data111) && !empty($data111)) {

                                $attr_sel.=$data111;
                            }
                            if (isset($attrtable) && !empty($attrtable) && (strlen($attrtable) > 2)) {
                                $attr_sel.=$attrtable;
                            }
                            ?>
                            <li>
                                <span class="itemdesc">
                                    <div class="itemname"><?= $name ?></div>
                                    <div class="itemdesc"><?= $attr_sel ?></div>
                                    <div class="itemqty">Quantity : <span class="qtyred"><?= $no_of_ins ?>*<?= to_currency($p_p_u) ?></span></div>
                                </span>
                                <span class="itemprice">
                                    <div class="pricefont1"><?= to_currency($total) ?></div>
                                </span>
                            </li>
                        <?php endif; ?>
                        <?php //endif;  ?>
                        <?php $total_tax += $total_for_tax * ($cat_tax > 0 ? $cat_tax / 100 : 0); ?>         
                    </ul>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
    <div class="calculation">
        <div class="caltext1"><?php echo $this->lang->line('online_cart_sub_total') ?></div>
        <div class="caltext2"><?php echo to_currency($grand_total) ?></div>
    </div>
    <?php
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
        } else {
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
    $this->session->set_userdata('cart_item_total', number_format($grand_total, 2, '.', ''));
    if($this->session->userdata('promocodediscount')){
        $tdiscount+=$this->session->userdata('promocodediscount');
    }
     //echo "zaman". $this->session->userdata('promocodediscount');
    
    $new_total = $grand_total - $tdiscount;
    ?>
    <div class="calculation2">
        <div class="caltext3"><?php echo $this->lang->line('online_cart_discount') ?> </div>
        <div class="caltext4"><?php echo to_currency($tdiscount) ?></div>
    </div>
    <?php
    $delivery_plan = $this->Apimodel->get_delivery_plan_new($this->session->userdata('sinput'), $grand_total);
    //debugPrint($delivery_plan);
    $dcost;
    if (!$delivery_plan) {
        $delivery_plan = new stdClass();
        $delivery_plan->delivery_cost = 0;
        $delivery_plan->taxOnDeliveryCharge = 0;
        $delivery_plan->MinOrder = 0;
    }
    if ($delivery_plan && $delivery_plan->delivery_cost > 0) {
        $dcost = $delivery_plan->delivery_cost;
        $ftotal = $new_total + $delivery_plan->delivery_cost;
        $udata = array(
            'delivery_cost' => $delivery_plan->delivery_cost,
            'total_order' => $new_total
        );
    } else {
        $dcost = 0;
        $ftotal = $new_total;
    }
      $this->session->set_userdata('delivery_cost', $dcost);
    ?>
    <?php if ($deliverytype == 2) : ?>
        <div class="calculation2">
            <div class="caltext3"><?php echo $this->lang->line('online_cart_delivery_fee') ?></div>
            <div class="caltext4"><?php echo to_currency($dcost) ?></div>
        </div>
    <?php endif; ?>

    <?php $_SESSION['carttax'] = $total_tax; ?>
    <?php if ($deliverytype == 2) : ?>
        <?php $total_tax = $total_tax + ($delivery_plan->delivery_cost * $delivery_plan->taxOnDeliveryCharge) / 100; ?>
        <div class="calculation2">
            <div class="caltext3"><?php echo $this->lang->line('online_cart_tax') ?></div>
            <div class="caltext4"><?= to_currency($total_tax) ?></div>
        </div>
    <?php else : ?>
        <div class="calculation2">
            <div class="caltext3"><?php echo $this->lang->line('online_cart_tax') ?></div>
            <div class="caltext4"><?= to_currency($total_tax) ?></div>
        </div>
    <?php endif; ?>

    <?php
    $ftotal = $ftotal + $total_tax;
    ?>
    <?php if ($globaldiscountObj->HFee > 0) : ?>
        <?php $ftotal = $ftotal + $globaldiscountObj->HFee; ?>	
        <div class="calculation2">
            <div class="caltext3"><?= $this->lang->line('handling_fee') ?> : </div>
            <div class="caltext4"><?= to_currency($globaldiscountObj->HFee) ?></div>
        </div>
    <?php endif; ?>
    <?php if ($grand_total > 0) : ?>
        <?php if ($deliverytype == 1) : ?>
            <?php $grand_total_without_del_cost = ($delivery_plan && $delivery_plan->delivery_cost > 0) ? (($ftotal - $delivery_plan->delivery_cost)) : $ftotal; ?>
            <div class="calculation">
                <div class="caltext1"><?php echo $this->lang->line('online_cart_total') ?></div>
                <div class="caltext2"><?= to_currency($grand_total_without_del_cost) ?></div>
            </div>
        <?php endif ?> 
        <?php if ($deliverytype == 2) : ?>		
            <div class="calculation">
                <div class="caltext1"><?php echo $this->lang->line('online_cart_total') ?> </div>
                <div class="caltext2"><?= to_currency($ftotal) ?></div>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <div class="calculation">
            <div class="caltext1"><?php echo $this->lang->line('online_cart_total') ?> </div>
            <div class="caltext2"><?= (to_currency($grand_total)) ?></div>
        </div>
    <?php endif; ?>
    <?php
    $minorder = 0;
    if ($delivery_plan && $delivery_plan->MinOrder > 0 && $deliverytype == 2) {
        $minorder = $delivery_plan->MinOrder;
    }
    ?>
        <div class="checkoutarea">
            <div class="btncheckout">
                <a href="<?= site_url('orderonline') ?>">BACK TO MENU</a>
            </div>
        </div>

</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var deliveryType = "<?php echo $this->session->userdata('deliverytype') ?>";
        if (deliveryType == 2) {
            jQuery('#delivery_type').attr('checked', true);
        } else {
            jQuery('#collection_type').attr('checked', true);
        }
    });

</script>