<?php
$OrderStatus = array("Pending", "Confirmed", "Concluded", "Cancelled By Customer", "Cancelled By Restaurant", "Bad Order");
$pickup_address = "";
$delivery_address = "";
$pickup_address .= $rest_info['Address2'];
$pickup_address .= $rest_info['ZipCode'] ? ", " . strtoupper($rest_info['ZipCode']) : "";
$pickup_address .= $rest_info ['City'];
$pickup_address .= $rest_info['AreaId'];
$pickup_address .= $rest_info['Contact'] ? ". Phone: " . $rest_info ['Contact'] : "";
$delivery_address .= $customer_order['OrderAdd1'];
$delivery_address .= $customer_order['OrderAdd2'];
$delivery_address .= $customer_order['OrderAddTown'];
$delivery_address .= $customer_order['OrderAddArea'];
$delivery_address .= $customer_order['OrderAddPostcode'] ? ", " . strtoupper($customer_order['OrderAddPostcode']) : "";
$delivery_address .= $customer_order['CustTelephone'] ? ". Phone: " . $customer_order['CustTelephone'] : "";
?>

<div class="container">
    <div class="row accountbg">
        <?php $this->load->view('customer/subviews/nav') ?>
        <div class="col-md-9">
            <div class="content-innerspan2">
                <div class="innercommon-right">
                    <h1>Order Details</h1>
                    <div class="innercommon-right-content">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="payment-table">
                            <tbody>
                                <tr class="even">
                                    <td class="bdr-bottom" colspan="3"><b>Your Address</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="payment-table">
                            <tbody>
                                <tr class="odd">
                                    <td width="40%" class="bdr-bottom bdr-right">Order ID</td>
                                    <td width="60%" class="bdr-bottom"><?php echo $customer_order['OrderId'] ?></td>
                                </tr>
                                <tr class="even">
                                    <td width="40%" class="bdr-bottom bdr-right">Restaurant</td>
                                    <td width="60%" class="bdr-bottom"><?php echo $rest_info['RestName'] ?></td>
                                </tr>
                                <tr class="odd">
                                    <td width="40%" class="bdr-bottom bdr-right">Order Status</td>
                                    <td width="60%" class="bdr-bottom">
                                        <span 
                                            <?php if ($customer_order['Status'] == 0) { ?>class="blink"<?php } ?>
                                            style="
                                            <?php
                                            if ($customer_order['Status'] == 1)
                                                echo 'color:#219921; font-weight:bold;';
                                            elseif ($customer_order['Status'] == 4)
                                                echo 'color:#D52229;font-weight:bold;';
                                            else
                                                echo 'color:#FF9900;font-weight:bold;';
                                            ?>">
                                                <?php
                                                if ($customer_order['Status'] == 1)
                                                    echo "Confirmed";
                                                elseif ($customer_order['Status'] == 4)
                                                    echo "Cancelled";
                                                else
                                                    echo "Pending";
                                                ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr class="even">
                                    <td width="40%" class="bdr-bottom bdr-right">Order Type</td>
                                    <td width="60%" class="bdr-bottom"><?php ($customer_order['OrderPolicyId']==1)? print'Pick up':print'Delivery' ?></td>
                                </tr>
                                <tr class="odd">
                                    <td width="40%" class="bdr-bottom bdr-right">Order Date</td>
                                    <td width="60%" class="bdr-bottom"><?= date("d, M Y, h:i A", strtotime($customer_order['OrderDate'])); ?></td>
                                </tr>
                                <tr class="even">
                                    <td width="40%" class="bdr-bottom bdr-right">Payment Method</td>
                                    <td width="60%" class="bdr-bottom"><?= $customer_order['PaymentMethod'] == "cod" ? "Cash On Delivery" : "Online"; ?></td>
                                </tr>
                                <tr class="odd">
                                    <!--	<td width="40%" class="bdr-bottom bdr-right">Customer Address</td>	-->
                                    <td width="40%" class="bdr-bottom bdr-right"><?= $customer_order['OrderPolicyId'] == "1" ? "PICK UP" : "DELIVERY"; ?> ADDRESS:</td>
                                    <td width="60%" class="bdr-bottom"><?= $customer_order ['OrderPolicyId'] == "1" ? $pickup_address : $delivery_address; ?></td>
                                </tr>
                                <tr class="even">
                                    <td width="40%" class="bdr-bottom bdr-right">Customer Name</td>
                                    <td width="60%" class="bdr-bottom"><?= $customer_order ['OrderPolicyId'] == "1" ? $rest_info['RestName'] : $customer_order ['CustFirstName'] . ' ' . $customer_order['CustLastName']; ?></td>
                                </tr>
                                 <?php if ($customer_order ['CustComments']): ?>
                                <tr class="odd">
                                    <td width="40%" class="bdr-bottom bdr-right">Message</td>
                                    <td width="60%" class="bdr-bottom"><?= $customer_order['CustComments']; ?></td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                       <div class="innercommon-right-content">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="payment-table">
                        <tr class="even">
                            <td width="40%" class="bdr-bottom bdr-right">Name</td>
                            <td width="20%" class="bdr-bottom bdr-right">Price</td>
                            <td width="20%" class="bdr-bottom bdr-right">Qty</td>
                            <td width="20%" class="bdr-bottom bdr-right">Sub Toal</td>
                        </tr>
                        <?php global $total; ?>
                        <?php $total = 0.0; ?>
                        <?php foreach ($order_detail as $item) : ?>
                            <tr class="odd">
                                <td width="40%" class="bdr-bottom bdr-right">
                                    <?php
                                    $pname = "";
                                    $pprice = 0;
                                    $pqty = 0;
                                    $ptprice = 0;
                                    $patbt = "";
                                    if ($item->BaseUnitPrice > 0) {
                                        $pname = $item->CatName . "-" . $item->BaseName;
                                        if (strlen($item->SelectionName) > 0) {
                                            $pname.= "<br>";
                                            $snameget = explode("==", $item->SelectionName);
                                            foreach ($snameget as $sn) {
                                                $sn_arr = explode('##', $sn);
                                                //debugPrint($sn_arr);
                                                if (isset($sn_arr[0]) && strlen($sn_arr[0]) > 0) {
                                                    $pname.="[ " . $sn_arr[0];
                                                    $pname.=" ]";
                                                    
                                                    if (isset($sn_arr[1]) && strlen($sn_arr[1]) > 0) {
                                                        $spatt_arr = explode('@@', $sn_arr[1]);
                                                        $satt_arr = array();
                                                        foreach ($spatt_arr as $satt) {
                                                            $satt_arr[] = $satt;
                                                        }
                                                        $pname.= ' - (' . implode(', ', $satt_arr) . ')';
                                                    }
                                                    $pname.="<br>";
                                                }
                                            }
                                        }
                                        $pprice = $item->BaseUnitPrice;
                                        $pqty = $item->total_qty;
                                        $ptprice = $item->BaseUnitPrice * $pqty;
                                    }
                                    elseif ($item->SelectionUnitPrice > 0) {
                                        $pname = $item->CatName . "-" . $item->BaseName;
                                        if (strlen($item->SelectionName) > 0) {
                                            $pname.= "<br>";
                                            $snameget = explode("==", $item->SelectionName);
                                            foreach ($snameget as $sn) {
                                                if (strlen($sn) > 0) {
                                                    $pname.="[" . $sn . "]";
                                                }
                                            }
                                        }
                                        $pprice = $item->SelectionUnitPrice;
                                        $pqty = $item->total_qty;
                                        $ptprice = $pprice * $pqty;
                                    }
                                    $patbt = "";
                                    foreach ($order_attribute as $patt) {
                                        if ($patt->OrderDetailId == $item->OrderItermId) {
                                            if ($patt->OrderAttrUnitPrice) {
                                                $patbt.="<br>" . $patt->OrderAttrName . " [" . $patt->AttrQty . " X " . ' ' . to_currency($patt->OrderAttrUnitPrice) . "]";
                                            }
                                            else {
                                                $patbt.="<br>" . $patt->OrderAttrName;
                                            }
                                            $ptprice = $ptprice + (($patt->AttrQty * $patt->OrderAttrUnitPrice) * $pqty);
                                            $pprice = $pprice + $patt->OrderAttrUnitPrice;
                                        }
                                    }
                                    ?>
                                    <?php echo $pname . $patbt; ?> </td>

                                <td width="20%" class="bdr-bottom bdr-right">
                                    <?php echo to_currency($pprice); ?>
                                </td>

                                <td width="20%" class="bdr-bottom bdr-right">
                                    <?php echo $pqty; ?>
                                </td>

                                <td width="20%" class="bdr-bottom bdr-right">
                                    <?php
                                    echo to_currency($ptprice);
                                    $total+=$ptprice;
                                    ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        <tr class="even">
                            <td width="80%" align="right" class="bdr-bottom bdr-right" colspan="3"><?php echo $this->lang->line('order_total'); ?> :</td>
                            <td width="20%" class="bdr-bottom bdr-right"><?php       if (isset($total))  echo to_currency($total); ?>
                            </td>
                        </tr>

                        <tr class="odd">
                            <td width="80%" align="right" class="bdr-bottom bdr-right" colspan="3"><?php echo $this->lang->line('promocode_discount'); ?> :</td>
                            <td width="20%" class="bdr-bottom bdr-right">
                                -
                                <?php
                                if (isset($total))
                                    $total-=$customer_order['OrderTotalDiscount'];
                                if (isset($total))
                                    $total-=$customer_order['PromocodePrice'];
                                echo to_currency($customer_order['PromocodePrice'] + $customer_order['OrderTotalDiscount'])
                                ?>
                            </td>
                        </tr>
                        <?php if (isset($total)) if ($customer_order['OrderPolicyId'] == '2') : ?>
                                <tr class="even">
                                    <td width="80%" align="right" class="bdr-bottom bdr-right" colspan="3"><?php echo $this->lang->line('delivery_cost'); ?> :</td>
                                    <td width="20%" class="bdr-bottom bdr-right">+<?php
                                        if (isset($total))
                                            $total+=$customer_order['DeliveryCost'];
                                        echo to_currency($customer_order['DeliveryCost'])
                                        ?>
                                    </td>
                                </tr>

                                <tr class="odd">
                                    <td width="80%" align="right" class="bdr-bottom bdr-right" colspan="3"><?php echo $this->lang->line('subtotal'); ?> :</td>
                                    <td width="20%" class="bdr-bottom bdr-right"><?php if (isset($total)) echo to_currency($total); ?>
                                    </td>
                                </tr>
                        <?php  endif; ?>
                        <tr class="even">
                            <td width="80%" align="right" class="bdr-bottom bdr-right" colspan="3"><?php echo $this->lang->line('vat'); ?> :</td>
                            <td width="20%" class="bdr-bottom bdr-right">+ <?php
                                $total+=$customer_order['Vat'];
                                echo to_currency($customer_order['Vat'])
                                ?> </td>
                        </tr>
                        <tr class="odd">
                            <td width="80%" align="right" class="bdr-bottom bdr-right" colspan="3"><?php echo $this->lang->line('handling_fee'); ?> :</td>
                            <td width="80%" class="bdr-bottom bdr-right">+<?php
                                if (isset($total))
                                    $total+=$customer_order['HandlingFee'];
                                echo to_currency($customer_order ['HandlingFee'])
                                ?>
                            </td>
                        </tr>

                        <?php
                        if (isset($total))
                            $total+=$customer_order['CCFee'];
                        ?>
                        <?php if ($customer_order['PaymentMethod'] != 'cod') : ?>
                            <tr class="even">
                                <td width="80%" align="right" class="bdr-bottom bdr-right" colspan="3"><?php echo $this->lang->line('credit_card_fees'); ?> :</td>
                                <td width="20%" class="bdr-bottom bdr-right">+<?php echo to_currency($customer_order['CCFee']) ?>
                                </td>
                            </tr>
                        <?php endif ?>
                        <tr class="odd">
                            <td width="80%" align="right" class="bdr-bottom bdr-right" colspan="3"><?php echo $this->lang->line('grand_total'); ?> :</td>
                            <td width="20%" class="bdr-bottom bdr-right"> <?php if (isset($total)) echo to_currency($total); ?> </td>
                        </tr>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
