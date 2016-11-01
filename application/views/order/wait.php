<link rel="stylesheet" href="<?php echo base_url();?>assets/site/css/wait.css" />
<script type="text/javascript">
<?php if (1 == 1) { ?>
        jQuery(function($)
        {
            $(".confirmation_root_link").colorbox({inline: true, width: "660px", open: true});
            update();

        });
        function close_popup() {
            jQuery.colorbox.close();
        }
        function update() {
            jQuery.post("<?php echo site_url('order/confirmatin_status') ?>", {id: 0}, function(responseText) {
                jQuery('#holder').html(responseText);
                jQuery(".confirmation_root_link").colorbox.resize();
            }, "html");
            setTimeout("update()", 3000);
        }
<?php } ?>
</script>
<div class="container">
    <div class="row">
        <div><b class="green">THANKS YOU FOR YOUR ORDER!</b></div>
        <p><b>What happens next?</b></p>
        <p>
            &#8658;&nbsp;<b>Email Confirmation</b><br />
            You will receive an email with a response from restaurant on the order you have placed.
            You can also verify the status of the order by clicking on the order details in the link below and you can always access the order details in "<a href="<?= base_url() ?>customer">My Account</a> &raquo; <a href="<?= base_url() ?>customer/orderoverview">Order Overview</a>".<br /><br />
        </p>
        <p>
            &#8658;&nbsp;<b><?php $OrderPolicyId == '1' ? print 'Pick Up' : print 'Delivery';     ?></b><br />
            <?php $OrderPolicyId == '1' ? print 'You are requested to pick up your order from the restaurant!' : print 'The restaurant will deliver your order at the confirmed time!'; ?> <br /><br />
        </p>

        <p>
            &#8658;&nbsp;<b>Important</b><br />
            Please Call on <?php  echo $this->config->item('phone') ?><br />
            This is <strong>IMPORTANT</strong> otherwise you risk  having your order canceled.<br /><br />
        </p>

        <p><b>If you have any questions</b><br /><br /></p>
        <p>
            IF YOU WANT TO MAKE CHANGES OR IF YOU HAVE QUESTIONS TO THE ORDER, THEN CALL THE RESTAURANT DIRECTLY ON THEIR PHONE: <?= $this->config->item('phone') ?><br />
            If you want to cancel the order then contact <?php echo $this->config->item('company') ?> as fast as possible on email: <?php $this->config->item('website') != '' ? print $this->config->item('website') : $this->config->item('company') ?><br /><br />
        </p>
        <p>
            <b><a href="<?php echo $this->config->site_url(array("customer", "orderdetail", $OrderId)) ?>">Click here to see your order details</a></b><br />
        </p>
    </div>
</div>


<a class='confirmation_root_link' href="#popup_confirmation" style="display:none">Inline HTML conf</a>
<div style='display:none'>
    <div id="popup_confirmation">
        <div class="menu_popup_area_top">
            <h1>Order Confirmation</h1>

        </div>
        <div class="menu_popup_area_bottom">
            <div id="holder" class="wait-font1">
                Your order is will be confirmed by the merchant in this window, if you wait
            </div>
            <div style="text-align:center">
                <a href="javascript:void(0);" onclick="close_popup()" class="button blue" style="margin:0 170px;">Close and Receive Email</a>
            </div>
        </div>
    </div>
</div>