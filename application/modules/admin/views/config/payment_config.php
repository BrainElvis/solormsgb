<?php echo form_open('admin/config/save_payment/', array('id' => 'payment_config_form', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal')); ?>
<div id="config_wrapper">
    <fieldset id="config_info">
        <div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
        <ul id="paymnet_error_message_box" class="error_message_box"></ul>
        <div class="form-group form-group-sm">
            <label class="checkbox-inline">
                <?php
                echo form_checkbox(array(
                    'name' => 'payment_online',
                    'value' => 'payment_online',
                    'checked' => $this->config->item('payment_online')));
                ?>
                 <?php echo $this->lang->line('config_payment_online'); ?>
            </label>  
        </div>
        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('config_paymnet_gateways'), 'payment_gateway', array('class' => 'control-label col-xs-2')); ?>
            <div class='col-xs-8'>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'payment_gateway',
                        'value' => 'Nochex',
                        'checked' => $this->config->item('payment_gateway') === "Nochex"));
                    ?>
                    <?php echo $this->lang->line('config_nochex') ?>
                </label>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'payment_gateway',
                        'value' => 'Paypal',
                        'checked' => $this->config->item('payment_gateway') === "Paypal"));
                    ?>
                    <?php echo $this->lang->line('config_paypal') ?>
                </label>
            </div>
        </div>


        <div class="form-group form-group-sm">	
            <?php echo form_label($this->lang->line('config_merchant_id'), 'payment_merchant_id', array('class' => 'control-label col-xs-2 required')); ?>
            <div class="col-xs-6">
                <div class="input-group">
                    <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-home"></span></span>
                    <?php
                    echo form_input(array(
                        'name' => 'payment_merchant_id',
                        'id' => 'payment_merchant_id',
                        'class' => 'form-control input-sm required',
                        'value' => $this->config->item('payment_merchant_id')));
                    ?>
                </div>
            </div>
        </div>


        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('config_paymnet_mode'), 'payment_mode', array('class' => 'control-label col-xs-2')); ?>
            <div class='col-xs-8'>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'payment_mode',
                        'value' => 'Test',
                        'checked' => $this->config->item('payment_mode') === "Test"));
                    ?>
                    <?php echo $this->lang->line('config_payment_mode_test') ?>
                </label>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'payment_mode',
                        'value' => 'Live',
                        'checked' => $this->config->item('payment_mode') === "Live"));
                    ?>
                    <?php echo $this->lang->line('config_payment_mode_live') ?>
                </label>
            </div>
            
        </div>
        <div class="form-group form-group-sm">
            <label class="checkbox-inline">
                <?php
                echo form_checkbox(array(
                    'name' => 'payment_cod',
                    'value' => 'payment_cod',
                    'checked' => $this->config->item('payment_cod')));
                ?>
                <?php echo $this->lang->line('config_payment_cod'); ?>
            </label>  
        </div>
            
        
       
        <div class="form-group form-group-sm">	
            <div class="col-sm-offset-2">
                <?php
                echo form_submit(array(
                    'name' => 'submit_form',
                    'id' => 'submit_form',
                    'value' => $this->lang->line('common_submit'),
                    'class' => 'btn btn-primary btn-sm'));
                ?>
            </div>
        </div>
    </fieldset>
</div>
<?php echo form_close() ?>

<script type='text/javascript'>
//validation and submit handling
    $(document).ready(function ()
    {
        $('#payment_config_form').validate({
            submitHandler: function (form) {
                $(form).ajaxSubmit({
                    success: function (response) {
                        if (response.success)
                        {
                            set_feedback(response.message, 'alert alert-dismissible alert-success', false);
                        } else
                        {
                            set_feedback(response.message, 'alert alert-dismissible alert-danger', true);
                        }
                    },
                    dataType: 'json'
                });
            },
            errorClass: "has-error",
            errorLabelContainer: "#paymnet_error_message_box",
            wrapper: "li",
            highlight: function (e) {
                $(e).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (e) {
                $(e).closest('.form-group').removeClass('has-error');
            },
            rules:
                    {
                        payment_merchant_id: "required",
                    },
            messages:
                    {
                        payment_merchant_id: "<?php echo $this->lang->line('config_merchant_id_required'); ?>"
                    }
        });
    });
</script>