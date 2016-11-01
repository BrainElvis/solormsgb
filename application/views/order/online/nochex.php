
<form method="POST" action="https://secure.nochex.com/" name="nochex" id="nochex" target="_blank"> 
    <input type="hidden" name="merchant_id" value="<?php echo $merchant_id ?>">
    <input type="hidden" name="amount" value="<?php echo to_currency($total); ?>">
    <input type="hidden" name="description" value="<?php echo $this->config->item('company') . " " . "Online Order" ?>">
    <input type="hidden" name="order_id" value="<?php echo $OrderId; ?>"/>
    <?php if ($paymentmode == 'test') : ?>
        <input type="hidden" name="test_transaction" value="<?php echo to_currency($total); ?>">
    <?php endif ?>
    <input type="hidden" name="callback_url" value="<?php echo site_url('order/nochex_callback') ?>">
    <input type="hidden" name="success_url" value="<?php echo site_url('order/success') ?>">
    <input type="hidden" name="cancel_url" value="<?php echo site_url('order/cancel') ?>">
</form>
<script>document.nochex.submit()</script>
<div><img src="<?php echo ASSETS_SITE_IMAGE_PATH . 'ajax-loader.gif' ?>"/></div>