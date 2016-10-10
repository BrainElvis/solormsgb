<?php echo form_open('admin/config/save_homepage/', array('id' => 'homepage_config_form', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal')); ?>
<div id="config_wrapper">
    <fieldset id="config_info">
        <div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
        <ul id="homepage_error_message_box" class="error_message_box"></ul>
        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('config_homepage_slider'), 'home_slider', array('class' => 'control-label col-xs-2')); ?>
            <div class='col-xs-8'>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'home_slider',
                        'value' => 'on',
                        'checked' => $this->config->item('home_slider') === "on"));
                    ?>
                    <?php echo $this->lang->line('config_home_page_option_on') ?>
                </label>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'home_slider',
                        'value' => 'off',
                        'checked' => $this->config->item('home_slider') === "off"));
                    ?>
                    <?php echo $this->lang->line('config_home_page_option_off') ?>
                </label>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('config_homepage_wesearve'), 'home_weserve', array('class' => 'control-label col-xs-2')); ?>
            <div class='col-xs-8'>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'home_weserve',
                        'value' => 'on',
                        'checked' => $this->config->item('home_weserve') === "on"));
                    ?>
                    <?php echo $this->lang->line('config_home_page_option_on') ?>
                </label>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'home_weserve',
                        'value' => 'off',
                        'checked' => $this->config->item('home_weserve') === "off"));
                    ?>
                    <?php echo $this->lang->line('config_home_page_option_off') ?>
                </label>
            </div>
        </div>
       
        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('config_homepage_menucarousel'), 'home_menucarousel', array('class' => 'control-label col-xs-2')); ?>
            <div class='col-xs-8'>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'home_menucarousel',
                        'value' => 'on',
                        'checked' => $this->config->item('home_menucarousel') === "on"));
                    ?>
                    <?php echo $this->lang->line('config_home_page_option_on') ?>
                </label>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'home_menucarousel',
                        'value' => 'off',
                        'checked' => $this->config->item('home_menucarousel') === "off"));
                    ?>
                    <?php echo $this->lang->line('config_home_page_option_off') ?>
                </label>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('config_homepage_ourfeatures'), 'home_ourfeatures', array('class' => 'control-label col-xs-2')); ?>
            <div class='col-xs-8'>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'home_ourfeatures',
                        'value' => 'on',
                        'checked' => $this->config->item('home_ourfeatures') === "on"));
                    ?>
                    <?php echo $this->lang->line('config_home_page_option_on') ?>
                </label>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'home_ourfeatures',
                        'value' => 'off',
                        'checked' => $this->config->item('home_ourfeatures') === "off"));
                    ?>
                    <?php echo $this->lang->line('config_home_page_option_off') ?>
                </label>
            </div>
        </div>
        
         <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('config_homepage_testimonials'), 'home_testimonials', array('class' => 'control-label col-xs-2')); ?>
            <div class='col-xs-8'>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'home_testimonials',
                        'value' => 'on',
                        'checked' => $this->config->item('home_testimonials') === "on"));
                    ?>
                    <?php echo $this->lang->line('config_home_page_option_on') ?>
                </label>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'home_testimonials',
                        'value' => 'off',
                        'checked' => $this->config->item('home_testimonials') === "off"));
                    ?>
                    <?php echo $this->lang->line('config_home_page_option_off') ?>
                </label>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('config_homepage_promotime'), 'home_promotime', array('class' => 'control-label col-xs-2')); ?>
            <div class='col-xs-8'>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'home_promotime',
                        'value' => 'on',
                        'checked' => $this->config->item('home_promotime') === "on"));
                    ?>
                    <?php echo $this->lang->line('config_home_page_option_on') ?>
                </label>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'home_promotime',
                        'value' => 'off',
                        'checked' => $this->config->item('home_promotime') === "off"));
                    ?>
                    <?php echo $this->lang->line('config_home_page_option_off') ?>
                </label>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('config_online_book'), 'online_book', array('class' => 'control-label col-xs-2')); ?>
            <div class='col-xs-8'>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'online_book',
                        'value' => 'on',
                        'checked' => $this->config->item('online_book') === "on"));
                    ?>
                    <?php echo $this->lang->line('config_home_page_option_on') ?>
                </label>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'online_book',
                        'value' => 'off',
                        'checked' => $this->config->item('online_book') === "off"));
                    ?>
                    <?php echo $this->lang->line('config_home_page_option_off') ?>
                </label>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('config_online_review'), 'online_review', array('class' => 'control-label col-xs-2')); ?>
            <div class='col-xs-8'>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'online_review',
                        'value' => 'on',
                        'checked' => $this->config->item('online_review') === "on"));
                    ?>
                    <?php echo $this->lang->line('config_home_page_option_on') ?>
                </label>
                <label class="radio-inline">
                    <?php
                    echo form_radio(array(
                        'name' => 'online_review',
                        'value' => 'off',
                        'checked' => $this->config->item('online_review') === "off"));
                    ?>
                    <?php echo $this->lang->line('config_home_page_option_off') ?>
                </label>
            </div>
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
        $('#homepage_config_form').validate({
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
            errorLabelContainer: "#homepage_error_message_box",
            wrapper: "li",
            highlight: function (e) {
                $(e).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (e) {
                $(e).closest('.form-group').removeClass('has-error');
            },
            rules:
                    {
                        //payment_merchant_id: "required",
                    },
            messages:
                    {
                        //payment_merchant_id: "<?php echo $this->lang->line('config_merchant_id_required'); ?>"
                    }
        });
    });
</script>