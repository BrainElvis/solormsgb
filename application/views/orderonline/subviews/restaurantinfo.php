<?php //debugPrint($deliverypolicy)     ?>
<?php if (!empty($deliverypolicy)): ?>
    <div role="tabpanel" class="tab-pane" id="restaurantInfo">
        <div class="row" style="min-height: 600px; width: 100%; margin: 0px; padding: 0px; border: 1px solid #eee;">
            <div class="col-md-9">
                <div style="display: block;" id="info" class="menucontentarea">
                    <div class="info_area">
                        <div class="info_data_area">
                            <h1><?php echo $this->lang->line('online_info_restaurant_overview') ?></h1>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="payment-table">
                                <tbody>
                                    <tr class="even">
                                        <td width="25%" class="bdr-bottom bdr-right"><?php echo $this->lang->line('online_info_address') ?></td>
                                        <td width="75%" class="bdr-bottom">
                                            <?php echo $this->config->item('address') ?>
                                        </td>
                                    </tr>
                                    <tr class="odd">
                                        <td width="25%" class="bdr-bottom bdr-right"><?php echo $this->lang->line('online_info_cuisines') ?></td>
                                        <td width="75%" class="bdr-bottom">
                                            <?php if (!empty($cuisines)) : ?>     
                                                <?php echo ($cuisines['cusine']) ? str_replace(' ', ' | ', $cuisines['cusine']) : ''; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr class="even">
                                        <td width="25%" class="bdr-bottom bdr-right"><?php echo $this->lang->line('online_info_delivery_fee') ?></td>
                                        <td width="75%" class="bdr-bottom"><?php echo to_currency($deliverypolicy[0]['DelCost']) ?></td>
                                    </tr>
                                    <?php if (isset($deliverypolicy[0]['MinOrder'])): ?>
                                        <tr class="odd">
                                            <td width="25%" class="bdr-bottom bdr-right"><?php echo $this->lang->line('online_info_min_order_amount') ?></td>
                                            <td width="75%" class="bdr-bottom"><?php echo to_currency($deliverypolicy[0]['MinOrder']) ?> </td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr class="even">
                                        <td width="25%" class="bdr-bottom bdr-right"><?php echo $this->lang->line('online_info_delivery_time') ?></td>
                                        <td width="75%" class="bdr-bottom"><?php echo $deliverypolicy[0]['DelTime'] ?>  Minutes</td>
                                    </tr>
                                    <tr class="odd">
                                        <td width="25%" class="bdr-bottom bdr-right"><?php echo $this->lang->line('online_info_pickup_time') ?></td>
                                        <td width="75%" class="bdr-bottom"><?php echo $deliverypolicy[0]['TakeTime'] ?>  Minutes</td>
                                    </tr>  
                                    <?php if ($delarea || $deliveryarea): ?>
                                        <tr class="odd">
                                            <td width="25%" class="bdr-bottom bdr-right"><?php echo $this->lang->line('online_info_delivery_area') ?></td>
                                            <td width="75%" class="bdr-bottom"><?php echo $delarea . "[" . $deliveryarea[0]['PostcodeList'] . "]" ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr class="even">
                                        <td width="25%" class="bdr-bottom bdr-right"><?php echo $this->lang->line('online_info_payment_method') ?></td>
                                        <td width="75%" class="bdr-bottom">
                                            <?php $this->config->item('payment_cod') ? print $this->lang->line('config_payment_cod') : '' ?>
                                            <?php
                                            if ($this->config->item('payment_online')) {
                                                echo "," . $this->lang->line('config_payment_online');
                                                if ($this->config->item('payment_gateway')) {
                                                    echo "[" . $this->config->item('payment_gateway') . "]";
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                    <?php if ($deliverypolicy[0]['Note'] != '')  ?>
                                    <tr class="odd">
                                        <td width="25%" class="bdr-bottom bdr-right"><?php echo $this->lang->line('online_info_notification') ?></td>
                                        <td width="75%" class="bdr-bottom"><?php echo $deliverypolicy[0]['Note']; ?></td>
                                    </tr>
                                    <?php ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="content-cartspan" id="scolling-content-cart" style="position: relative; min-height: 0px; padding-top: 15px;">
                    <div style="padding-top: 0px; padding-bottom: 1px; position: static; top: 0px;" class="mycart theiaStickySidebar">
                        <div class="cartheading">
                            <div class="cartheading_text">YOUR ORDER</div>
                            <!--<h2><a href="javascript:void(0);" onclick="cancelcart();">Empty</a></h2>-->
                        </div>
                        <div class="cartdelpick">
                            <ul>
                                <li>
                                    <span class="delpick">
                                        <input type="radio" name="deliverytype" value="2" checked="" id="delivery_type" onclick="changemenucard(2, & quot; 15 & quot; , & quot; & quot; )">Delivery<a href="javascript:void(0)" onclick="changePostcode(2, & quot; 15 & quot; , 0)" title="Change Area" class="edit-icon"></a>
                                        <input type="radio" name="deliverytype" value="1" id="collection_type" onclick="changemenucard(1, & quot; 15 & quot; , & quot; & quot; )">Pick Up
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div style="overflow: hidden; padding: 0px; width: 270px;" class="cartscroll">
                            <div style="width: 269px; height: 0px;" class="jspContainer"><div style="padding: 0px; top: 0px; left: 0px; width: 269px;" class="jspPane"></div></div>
                        </div>
                        <div class="calculation">
                            <div class="caltext1">Sub Total</div>
                            <div class="caltext2">£0.00</div>
                        </div>
                        <div class="calculation2">
                            <div class="caltext3">Discount : </div>
                            <div class="caltext4">£0.00</div>
                        </div>
                        <div class="calculation2">
                            <div class="caltext3">Delivery Fee : </div>
                            <div class="caltext4">£0.00</div>
                        </div>
                        <div class="calculation2">
                            <div class="caltext3">TAX : </div>
                            <div class="caltext4">£0.00</div>
                        </div>
                        <div class="calculation">
                            <div class="caltext1">Total : </div>
                            <div class="caltext2">£0.00</div>
                        </div>
                        <div><a href="checkout.html"><input type="submit" value="Checkout" class="checkoutbg"></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>