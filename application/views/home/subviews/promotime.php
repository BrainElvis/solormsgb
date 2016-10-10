<?php //debugPrint($rest_vouchers) ?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="dl">
                <div class="brand">
                    <h2><?php echo $this->lang->line('homepage_head_promo_offer') ?></h2>
                </div>
                <?php if (!empty($rest_promotion)): ?>
                    <?php
                    $min_amount = $rest_promotion[0]['MinAmount'];
                    $max_amount = $rest_promotion[0]['MaxAmount'];
                    $discount = (float) $rest_promotion[0]['Discount'];
                    $discount_string = '';

                    if ($discount < 1) {
                        $percent_discount = $discount * 100;
                        $discount_string = (string) $percent_discount . "%";
                    } else {
                        $fixed_discount = to_currency($discount);
                        $discount_string = $fixed_discount;
                    }
                    $order_type_string = "";

                    $order_type = explode(',', $rest_promotion[0]['order_type']);
                    if (in_array(1, $order_type)) {
                        $order_type_string.="Collection";
                    }
                    if (in_array(1, $order_type) && in_array(2, $order_type)) {
                        $order_type_string.="&nbsp;and&nbsp;";
                    }
                    if (in_array(2, $order_type)) {
                        $order_type_string.="Delivery";
                    }
                    ?>
                <?php endif; ?>
                <div class="discount alizarin"><?php echo $discount_string; ?> <?php echo $this->lang->line('homepage_promotion_off') ?> <?php echo $order_type_string; ?></div>
                <div class="descr">
                    <strong>
                        <?php echo $this->lang->line('homepage_on_order_amount') ?> <?= to_currency($min_amount) . "-" . to_currency($max_amount) ?><br/><?php echo $rest_promotion[0]['Description'] ?>
                    </strong>
                </div>
                <?php if (!empty($rest_vouchers)): ?>
                    <div class="coupon midnight-blue">
                        <a data-toggle="collapse" href="#code-1" class="open-code"><?php echo $this->lang->line('homepage_get_a_code') ?></a>
                        <div id="code-1" class="collapse code">
                            <p><?php echo $rest_vouchers[0]['code'] ?></p>
                            <p>Get <?php $rest_vouchers[0]['price_func'] == 'pound' ? print to_currency($rest_vouchers[0]['price']) : print $rest_vouchers[0]['price'] . '%'; ?> Discount on Voucher</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!--------------- End Third Box work ------------------->
        <!------------ First Box work ----------------->
        <div class="col-md-6">
            <div class="openingbg">
                <h2><?php echo $this->lang->line('homepage_head_opening_hours') ?></h2>
                <ul>
                    <?php if ($restaurant_status == 1): ?>
                        <li><?php echo $this->lang->line('homepage_its') ?><?php echo date('l') ?> <?php echo date("h:i:s A"); ?> - <?php echo $this->lang->line('homepage_rest_opened') ?></li>
                    <?php else: ?>
                        <li><?php echo $this->lang->line('homepage_rest_closed') ?>!</li>
                    <?php endif; ?>
                    <?php ?>
                    <li><a data-toggle="modal" data-target="#modal-state" href=""><?php echo $this->lang->line('homepage_head_view_schedule') ?><i class="fa fa-clock-o"></i></a></li>
                </ul>
            </div>
        </div><!--------------- End First Box work ------------------->
    </div>              
</div>
<!--------------------- Opening time Modal  -------------------------------->  
<div class="modal fade" id="modal-state" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content modalborderbg">
            <div class="modal-header topborderbg">
                <button type="button" class="close mainclosebg" data-dismiss="modal">&times;</button>
                <h4 class="modal-title hourtitlebg"><?php echo $this->lang->line('homepage_head_popup_schedule') ?></h4>
            </div>
            <div class="modal-body hourtextbgli">
                <?php isset($rest_schedule) ? print $rest_schedule : print''; ?>
            </div>
        </div>
    </div>
</div>
<!--------------------- End Open Part -------------------------------->