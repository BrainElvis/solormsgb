<?php
if ($this->input->post('status') == 1) {
    $this->Apimodel->rearrange_cart_item();
}
$resname = $this->Resturantmodel->getdataforid('RestId', $this->session->userdata('restid'), 'resturant_info');
$cdis = $this->Usermodel->getinfobyid('delevary_policy', 'RestId', $this->session->userdata('restid'), 'Discount,CrossPromotion');
$restname = $resname[0]->RestName;
$minorder = $this->session->userdata('minorder');
if (!$this->session->userdata('customer')) {
    $page = base_url() . 'user/checkout/' . $this->session->userdata('restid');
}
else {
    $page = base_url() . 'user/payment/' . $this->session->userdata('restid');
}

$unique = '';
if ($this->session->userdata('cart')) {
    $unique = array_unique($this->session->userdata['cart']);
}

if (!empty($unique)) {
    foreach ($unique as $val) {
	$dup[$val] = $this->Usermodel->findDuplicates($this->session->userdata['cart'], $val);
    }
}

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

    $arrunique = $this->Usermodel->arrayUnique($array_attribute);
    foreach ($arrunique as $key1 => $arr) {
	foreach ($arr as $key2 => $attr) {
	    $sql = "select menu_attributes.*,menu_category_attributes_details.AttrName from menu_attributes Inner Join menu_category_attributes_details 
                ON menu_attributes.AttrDetailsId = menu_category_attributes_details.AttrDetailsId where AttrId='" . $key2 . "'";
	    $query = $this->db->query($sql);
	    $attribute_sets[$key1][$key2] = $query->result();
	    $dupattr[$key1][$key2] = $this->Usermodel->findDuplicates($this->session->userdata['attrcart'], $attr);
	}
    }
}

/* Check view menu status */
$now_day = strtolower(date('D'));
$now_hour = strftime("%H");
$now_min = strftime("%M");
$restaurant_status = 0;
$restId = $this->session->userdata('restid');
$message_for_view_menu = '';
$sql = "SELECT * FROM resturant_openingtime WHERE RestId=" . $restId . " AND WeekDay='" . $now_day . "' AND (StartHr*60+StartMin) <= " . ($now_hour * 60 + $now_min) . "   AND (EndHr*60+EndMin) >= " . ($now_hour * 60 + $now_min) . " AND PolicyId=0";
$query = $this->db->query($sql);
if (($query->num_rows() > 0)) {
    $restaurant_status = 1;
    // $message_for_view_menu=$this->lang->line('res_close_day');
}
$ord_plc = $order_policy = $this->Resturantmodel->getdataforid('RestId', $this->session->userdata('restid'), 'resturant_order_policy', "PolicyId", "ASC");

if ((!$message_for_view_menu ) && (count($order_policy) < 1) || (count($ord_plc) == 1 && $ord_plc[0]->PolicyId == 3)) {
    $message_for_view_menu = $this->lang->line('res_pri_not');
}
$rinfo = $this->db->query("select *from resturant_info where RestId='" . $this->session->userdata('restid') . "'")->row();
$query = $this->db->get_where("restaurant_type", array("TypeId" => $rinfo->membership_type));
$restaurant_membership = $query->row();
$previlise = explode('|', $restaurant_membership->privileges);
if (in_array('7', $previlise))
    $pre_hide_status = 0;
else
    $pre_hide_status = 1;
if (!$message_for_view_menu && $pre_hide_status) {
    $message_for_view_menu = $this->lang->line('res_pri_not');
}
if (!$restaurant_status) {
    $message_for_view_menu = $this->lang->line('res_pri_not');
}

$spitem = $this->session->userdata('sp_details');
$grand_total = 0.0;
$total_com = 0.0;
$total_wcom = 0.0;
$total_tax = 0.0;
?>
<div class="mycart theiaStickySidebar">
    <div class="cartheading">
        <div class="cartheading_text">YOUR ORDER</div>
        <!--<h2><a href="javascript:void(0);" onclick="cancelcart();">Empty</a></h2>-->
    </div>
    <div class="cartdelpick">
        <ul>
            <li>
                <span class="delpick">
		    <?php if ((count($ord_plc) == 1) || (count($ord_plc) == 2 && $ord_plc[1]->PolicyId == 3)) {
			if ($ord_plc[0]->PolicyId == 1) { ?> Pick up only  <?php } ?>
			<?php if ($ord_plc[0]->PolicyId == 2) { ?> Delivery Only  <a href='javascript:void(0)' onclick='changePostcode(2,"<?= $_SESSION['restid'] ?>",0)'  title='Change Area' class='edit-icon'></a><?php } ?>
			<?php  }  else { ?>
			<?php
			$clck = ''; 
			$dvck = '';
			if ($this->session->userdata('deliverytype') == 1) {
			    $clck = 'checked';
			}
			if ($this->session->userdata('deliverytype') == 2) {
			    $dvck = 'checked';
			}
			?>
			<?php isset($areaid) ? $areaid = $areaid : $areaid = '' ?>
			    <input type='radio' name='deliverytype' value='2' <?= $dvck ?> id='delivery_type' onclick='changemenucard(2,"<?= $_SESSION['restid'] ?>","<?= $areaid ?>")' /><?= $this->lang->line('delivery_status') ?> 
			    <a href='javascript:void(0)' onclick='changePostcode(2,"<?= $_SESSION['restid'] ?>",0)'  title='Change Area' class='edit-icon'></a>
			    <input type='radio' name='deliverytype' value='1' <?= $clck ?> id='collection_type' onclick='changemenucard(1,"<?= $_SESSION['restid'] ?>","<?= $areaid ?>")'/> <?= $this->lang->line('collection_status') ?> 
			<?php } ?>
		</span>
	    </li>
	</ul>
    </div>

<?php if ($this->session->userdata('restid')) : ?>
        <div class="cartscroll">
	    <?php
	    $trcolor = '#fef0f0';
	    if (!empty($unique)) {
		$unique = array_reverse($unique);
		krsort($unique);
	    }
	    if (!empty($unique)) {
		foreach ($unique as $key => $un) {
		    ?>
	    	<div class="cartitem">
	    	    <ul> 
			    <?php
			    $total_for_tax = 0;
			    $trcolor = ($trcolor == '#d7ffc4') ? '#d7ffc4' : '#d7ffc4';
			    $data111 = "";
			    $arr_cart = explode("|", $un);
			    $attrSpecialPrice = 0;
			    if (!empty($spitem)) {
				foreach ($spitem as $key12 => $val12) {

				    if (count($arr_cart) == 3) {
					$details_arr_key = $arr_cart[0] . '|' . $arr_cart[1];
					if ($details_arr_key == $key12) {
					    foreach ($val12 as $key13 => $val13) {
						$asss = explode("|", $key13);
						$spselnameget = $this->Resturantmodel->getspselname_by_id($asss[0]);
						$spbasenameget = $this->Resturantmodel->getbasename_by_id($spselnameget[0]->BaseId);

						if (trim($spbasenameget, '\n') == trim($spselnameget[0]->SpItemName, '\n')) {
						    $data111.= "[" . $spselnameget[0]->SpItemName . "]";
						}
						else {
						    $data111.= "[" . $spbasenameget . " - " . $spselnameget[0]->SpItemName . "]";
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
									}
									else {
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
				}
				else {
				    $com_status = 1;
				}
				$flag = 1;
			    }

			    if (count($arrKey) == 4) {
				//Below line is for VAT calculation for different selection @Added By : Rubel @30-01-2012////////////
				$catname = array_reverse(explode('/', $arrKey[0]));
				$catname = $catname[0];
				$catname = array_reverse(explode('@', $catname)); // This is for special category item only @Added By : Rubel @30-03-2012
				$catname = $catname[0];
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				$basename = $arrKey[1];
				$selection_name = $arrKey[2];
				$name = $arrKey[1] . '|' . $arrKey[2];
				$ppu_arr = explode('*', $arrKey[3]);
				$p_p_u = $ppu_arr[1];
				if ($ppu_arr[0] == $ppu_arr[1]) {

				    $com_status = 0;
				}
				else {
				    $com_status = 1;
				}
				$flag = 0;
			    }
			    $cat_tax = $this->db->get_where('menu_category', array('CatId' => $catname))->row()->Tax;
			    $no_of_ins = $dup[$un];
			    $total = $p_p_u * $no_of_ins;
			    $total_for_tax += $p_p_u * $no_of_ins;
			    if ($com_status == "1") {
				$total_com = $total_com + $p_p_u * $no_of_ins;
			    }
			    else {
				$total_wcom = $total_wcom + $p_p_u * $no_of_ins;
			    }
			    $nameexplode = explode('==', $name);
			    $name = array_shift($nameexplode);
			    $selection_name_a = explode('|', $name);
			    if (count($selection_name_a) > 1) {
				if (trim($selection_name_a[1], '\n') == trim($selection_name_a[0], '\n')) {
				    $basenameget = $this->Resturantmodel->getbasename_by_id($selection_name_a[0]);
				    $name = $basenameget . "";
				}
				else {

				    $basenameget = $this->Resturantmodel->getbasename_by_id($selection_name_a[0]);
				    //$name=$selection_name_a[0];
				    $name = $basenameget;
				    if (strlen($selection_name_a[1]) > 0) {
					$selnameget = $this->Resturantmodel->getselname_by_id($selection_name_a[1]);
					//$name .= " - ".$selection_name_a[1];
					$name .= " - " . $selnameget;
				    }
				    $name .= "";
				}
			    }
			    else {
				$basenameget = $this->Resturantmodel->getbasename_by_id($selection_name_a[0]);
				$name = $basenameget . "";
			    }
			    foreach ($nameexplode as $nitem) {
				if (strlen($nitem) > 0) {
				    $selnameget = $this->Resturantmodel->getselname_by_id($nitem);
				    $name.='[' . $selnameget . ']';
				}
			    }
			    $position = NULL; // Added By R @13-01-2014 to avoid not initialization warnnig. 
			    if ($position != NULL) :
				if ($un[$position - 1] == 0) :
				    ?>
		    		<li>
		    		    <span class="itemdesc">
		    			<div class="itemname"><?= $name ?></div>
		    			<div class="itemqty">Quantity : <span class="qtyred"><?= $no_of_ins ?>*<?= CURRENCY . "" . number_format($p_p_u, 2, '.', '') ?></span></div>
		    			<div class="itemcount">
		    			    <span class="plus"><a href='javascript:void(0)' onclick='addone(
		    					"<?= $id_item ?>");'>+</a></span>
		    			    <span class="minus"><a href='javascript:void(0)' onclick='lessone(
		    					"<?= $id_item ?>");'>-</a></span>
		    			    <span class="reduce"><a href='javascript:void(0)' onclick='removeItem(
		    					"<?= $id_item ?>");'>x</a></span>
		    <?php if ($_SESSION['comments'][$un]): ?> 
						    <span class="reduce"><a href='javascript:void(0)' onclick='removeItem(
								"<?= $id_item ?>");' title="<?= $_SESSION['comments'][$un] ?>">x</a></span>
				    <?php endif; ?>
		    			</div>
		    		    </span>
		    		    <span class="itemprice">
		    			<div class="pricefont1"><?= CURRENCY . "" . number_format($total, 2, '.', '') ?></div>
		    		    </span>
		    		</li>
		<?php endif; ?>
								  <?php if ($un[$position - 1] == 1) : ?>
		    		<li>
		    		    <span class="itemdesc">
		    			<div class="itemname"><?= $name ?></div>
		    			<!-- <div class="itemdesc"></div>-->
		    			<div class="itemqty">Quantity : <span class="qtyred"><?= $no_of_ins ?>*<?= CURRENCY . "" . number_format($p_p_u, 2, '.', '') ?></span></div>
		    			<div class="itemcount">
		    			    <span class="plus"><a href='javascript:void(0)' onclick='addone(
		    					"<?= $id_item ?>");'>+</a></span>
		    			    <span class="minus"><a href='javascript:void(0)' onclick='lessone(
		    					"<?= $id_item ?>");'>-</a></span>
		    			    <span class="reduce"><a href='javascript:void(0)' onclick='removeItem(
		    					"<?= $id_item ?>");'>x</a></span>
		    <?php if ($_SESSION['comments'][$un]): ?> 
						    <span class="reduce"><a href='javascript:void(0)' onclick='removeItem(
								"<?= $id_item ?>");' title="<?= $_SESSION['comments'][$un] ?>">x</a></span>
				    <?php endif; ?>
		    			</div>
		    		    </span>
		    		    <span class="itemprice">
		    			<div class="pricefont1"><?= CURRENCY . "" . number_format($total, 2, '.', '') ?></div>
		    		    </span>
		    		</li>
				<?php endif; ?>
			    <?php else : ?>
				<?php
				/*				 * ***************************************** */
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
					    $catId = array_pop(explode('/', $val[0]));
					}
					else if (count($val) == 5) {
					    $selectionId = (implode(',', explode('==', $val[2])));
					    $selectionId = preg_replace('/,/', '', $selectionId, 1);
					    $baseId = $val[1];
					    $catId = array_pop(explode('/', $val[0]));
					}
					if (array_key_exists($unkeys, $attribute_sets)) {
					    foreach ($attribute_sets[$unkeys] as $attrkey => $attrdetails) {
						$level = '';
						if (count($val) == 5) {
						    $strsql = "select * from menu_attributes where  BaseId=" . $baseId . " and SelectionId in ($selectionId) and  RestId=" . $this->session->userdata('restid');
						    if (!$this->db->query($strsql)->row()) {
							$level = 1;
							$selectionId = 0;
						    }
						    else {
							$selection = explode(',', $selectionId);
							$selectionId = array_pop($selection);
						    }
						}if ($level == 1 || count($val) == 4) {
						    $strsql = "select * from menu_attributes where  BaseId=" . $baseId . " and SelectionId =0 and  RestId=" . $this->session->userdata('restid');
						    if (!$this->db->query($strsql)->row()) {
							$level = 1;
							$selectionId = 0;
							$baseId = 0;
						    }
						}
						$menuAttributsConfig = $this->db->get_where('menu_attributes_configuration', array('RestId' => $this->session->userdata('restid'), 'menu_category' => $catId, 'menu_base' => $baseId, 'menu_selection' => $selectionId, 'attributes_category' => $attrdetails[0]->AttrCatId))->row();
						$attribuesfreecount = $this->session->userdata('attribuesfreecount');
						//$attribuesfreecount[$un.'|'.$attrdetails[0]->AttrCatId.'|totalfree']=$menuAttributsConfig->free_attributes;
						if (count($menuAttributsConfig))
						    $attribuesfreecount[$un . '|' . $attrdetails[0]->AttrCatId . '|totalfree'] = $menuAttributsConfig->free_attributes;
						else
						    $attribuesfreecount[$un . '|' . $attrdetails[0]->AttrCatId . '|totalfree'] = 0;
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
						    }
						    else {
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
				}
				else {
				    $attrtable = '';
				}
				$grand_total+=$total;

				if ($com_status == "1") {
				    $total_com = $total_com + $total_attr;
				}
				else {
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
					<div class="itemqty">Quantity : <span class="qtyred"><?= $no_of_ins ?>*<?= CURRENCY . "" . number_format($p_p_u, 2, '.', '') ?></span></div>
					<div class="itemcount">
					    <span class="plus"><a href='javascript:void(0)' onclick='addone(
							"<?= $id_item ?>");'>+</a></span>
					    <span class="minus"><a href='javascript:void(0)' onclick='lessone(
							"<?= $id_item ?>");'>-</a></span>
					    <span class="reduce"><a href='javascript:void(0)' onclick='removeItem(
							"<?= $id_item ?>");'>x</a></span>
		<?php if ($_SESSION['comments'][$un]): ?> 
		    			    <span class="reduce"><img src="<?php echo SITE_IMG ?>add-comment.png" title="<?= $_SESSION['comments'][$un] ?>" alt="Comment"/></span>
		<?php endif; ?>
					</div>
				    </span>
				    <span class="itemprice">
					<div class="pricefont1"><?= CURRENCY . "" . number_format($total, 2, '.', '') ?></div>
				    </span>
				</li>


		    <?php endif; ?> 
			    <?php $total_tax += $total_for_tax * ($cat_tax / 100); ?>
	    	    </ul>
	    	</div>
	    <?php
	}
    }
    ?>

        </div>
        <div class="calculation">
    	<div class="caltext1">Sub Total</div>
    	<div class="caltext2"><?= CURRENCY . '' . number_format($grand_total, 2, '.', '') ?></div>
        </div>
	<?php
	$globaldiscount = $this->db->get('order_del_email')->row()->globaldiscount;
	$gdiscount_total = ($grand_total * $globaldiscount / 100);
	$rpromo = 0;
	if (count($cdis) && $cdis[0]->CrossPromotion == "0") {
	    $rpromo = $this->Resturantmodel->getRestaurantPromotion($this->session->userdata('restid'), $grand_total);
	    $newDiscount_total = ($grand_total * $rpromo / 100);
	    $tdiscount = $gdiscount_total + $newDiscount_total;
	}
	else {
	    $rpromo = $this->Resturantmodel->getRestaurantPromotion($this->session->userdata('restid'), $total_wcom);
	    $newDiscount_total = ($total_wcom * $rpromo / 100);
	    $tdiscount = $gdiscount_total + $newDiscount_total;
	}
	$new_total = $grand_total - $tdiscount;
	?>
        <div class="calculation2">
    	<div class="caltext3"><?= $this->lang->line('order_total_discount') ?> : </div>
    	<div class="caltext4"><?= CURRENCY . "" . number_format($tdiscount, 2, '.', '') ?></div>
        </div>						
	<?php
	$delivery_plan = $this->Usermodel->get_delivery_plan_new($this->session->userdata('restid'), $this->session->userdata('sinput'), $grand_total);
	if (!$delivery_plan) {
	    $delivery_plan = new stdClass();
	    $delivery_plan->delivery_cost = 0;
	    $delivery_plan->taxOnDeliveryCharge = 0;
	    $delivery_plan->MinOrder = 0;
	}
	if ($delivery_plan && $delivery_plan->delivery_cost > 0) {
	    $dcost = CURRENCY . "" . number_format($delivery_plan->delivery_cost, 2, '.', '');
	    $ftotal = $new_total + number_format($delivery_plan->delivery_cost, 2, '.', '');
	    $udata = array(
		'delivery_cost' => $delivery_plan->delivery_cost,
		'total_order' => $new_total
	    );
	    $this->session->set_userdata($udata);
	}
	else {
	    $dcost = $this->lang->line('order_free');
	    //$ftotal = $new_total+number_format($delivery_plan->delivery_cost, 2, '.', '');  
	    $ftotal = $new_total;
	}
	?>
	<?php if ($this->session->userdata('deliverytype') == '2') : ?>
	    <div class="calculation2">
		<div class="caltext3">Delivery Fee : </div>
		<div class="caltext4"><?= CURRENCY . "" . number_format($delivery_plan->delivery_cost, 2, '.', '') ?></div>
	    </div>
	<?php endif; ?>
	<?php $_SESSION['carttax'] = $total_tax; ?>
    <?php if ($this->session->userdata('deliverytype') == '2') : ?>
	<?php $total_tax = $total_tax + ($delivery_plan->delivery_cost * $delivery_plan->taxOnDeliveryCharge) / 100; ?>
	    <div class="calculation2">
		<div class="caltext3">TAX : </div>
		<div class="caltext4"><?= CURRENCY . "" . number_format($total_tax, 2, '.', '') ?></div>
	    </div>
	<?php else : ?>
	    <div class="calculation2">
		<div class="caltext3">TAX : </div>
		<div class="caltext4"><?= CURRENCY . "" . number_format($total_tax, 2, '.', '') ?></div>
	    </div>
    <?php endif; ?>
    <?php
    $ftotal = $ftotal + number_format($total_tax, 2, '.', '');
    $extra_fee = $this->Resturantmodel->get_extra_fee();
    ?>
	<?php if ($extra_fee[0]->HFee > 0) : ?>
	    <?php $ftotal = $ftotal + number_format($extra_fee[0]->HFee, 2, '.', ''); ?>	
	    <div class="calculation2">
		<div class="caltext3"><?= $this->lang->line('handling_fee') ?> : </div>
		<div class="caltext4"><?= CURRENCY . "" . number_format($extra_fee[0]->HFee, 2, '.', '') ?></div>
	    </div>
    <?php endif; ?>
    <?php
    if ($grand_total > 0) {
	if ($this->session->userdata('deliverytype') == '1') {
	    $grand_total_without_del_cost = ($delivery_plan && $delivery_plan->delivery_cost > 0) ? number_format(($ftotal - $delivery_plan->delivery_cost), 2, '.', '') : number_format($ftotal, 2, '.', '');
	    ?>

	        <div class="calculation">
	    	<div class="caltext1">Total : </div>
	    	<div class="caltext2"><?= CURRENCY . "" . $grand_total_without_del_cost ?></div>
	        </div>
	    <?php
	}
	else if ($this->session->userdata('deliverytype') == '2') {
	    ?>				   

	        <div class="calculation">
	    	<div class="caltext1">Total : </div>
	    	<div class="caltext2"><?= CURRENCY . "" . number_format($ftotal, 2, '.', '') ?></div>
	        </div>
	    <?php
	}
    }
    else {
	?>
	    <div class="calculation">
		<div class="caltext1">Total : </div>
		<div class="caltext2"><?= CURRENCY . "" . number_format($grand_total, 2, '.', '') ?></div>
	    </div>
	    <?php
	}

	$minorder = 0;
	if ($delivery_plan && $delivery_plan->MinOrder > 0 && $this->session->userdata('deliverytype') == "2") {
	    $minorder = $delivery_plan->MinOrder;
	}
	?>
	<?php if ($minorder <= $grand_total && $grand_total > 0) : ?>
	    <div class="checkoutarea">
		<div class="btncheckout">
		    <a href="<?= $page ?>">CHECKOUT</a>
		</div>
	    </div>
    <?php endif; ?>
    
    
<?php else : ?>
    <?php $tblcart.="<span style='padding:10px;'>" . $this->lang->line('empty_cart') . "</span>"; ?>
<?php endif; ?>
    <input type="hidden" value="" id="generationId" name="generationId">  
</div>
