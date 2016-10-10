<?php echo form_open('admin/config/save_api/', array('id' => 'api_config_form', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal')); ?>
<div id="config_wrapper">
    <fieldset id="config_info">
        <div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
        <ul id="api_error_message_box" class="error_message_box"></ul>
        <div class="form-group form-group-sm">	
            <?php echo form_label($this->lang->line('config_api_id'), 'api_id', array('class' => 'control-label col-xs-2 required')); ?>
            <div class="col-xs-6">
                <div class="input-group">
                    <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-triangle-right"></span></span>
                    <?php
                    echo form_input(array(
                        'name' => 'api_id',
                        'id' => 'api_id',
                        'class' => 'form-control input-sm required',
                        'value' => $this->config->item('api_id')));
                    ?>
                </div>
            </div>
        </div>

        <div class="form-group form-group-sm">	
            <?php echo form_label($this->lang->line('config_api_name'), 'api_name', array('class' => 'control-label col-xs-2 required')); ?>
            <div class="col-xs-6">
                <div class="input-group">
                    <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-triangle-right"></span></span>
                    <?php
                    echo form_input(array(
                        'name' => 'api_name',
                        'id' => 'api_name',
                        'class' => 'form-control input-sm required',
                        'value' => $this->config->item('api_name')));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">	
            <?php echo form_label($this->lang->line('config_api_website'), 'api_website', array('class' => 'control-label col-xs-2 required')); ?>
            <div class="col-xs-6">
                <div class="input-group">
                    <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-triangle-right"></span></span>
                    <?php
                    echo form_input(array(
                        'name' => 'api_website',
                        'id' => 'api_website',
                        'class' => 'form-control input-sm required',
                        'value' => $this->config->item('api_website')));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">	
            <?php echo form_label($this->lang->line('config_api_host'), 'api_host', array('class' => 'control-label col-xs-2 required')); ?>
            <div class="col-xs-6">
                <div class="input-group">
                    <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-triangle-right"></span></span>
                    <?php
                    echo form_input(array(
                        'name' => 'api_host',
                        'id' => 'api_host',
                        'class' => 'form-control input-sm required',
                        'value' => $this->config->item('api_host')));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">	
            <?php echo form_label($this->lang->line('config_api_key'), 'api_key', array('class' => 'control-label col-xs-2 required')); ?>
            <div class="col-xs-6">
                <div class="input-group">
                    <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-triangle-right"></span></span>
                    <?php
                    echo form_input(array(
                        'name' => 'api_key',
                        'id' => 'api_key',
                        'class' => 'form-control input-sm required',
                        'value' => $this->config->item('api_key')));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">	
            <?php echo form_label($this->lang->line('config_api_username'), 'api_username', array('class' => 'control-label col-xs-2 required')); ?>
            <div class="col-xs-6">
                <div class="input-group">
                    <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-triangle-right"></span></span>
                    <?php
                    echo form_input(array(
                        'name' => 'api_username',
                        'id' => 'api_username',
                        'class' => 'form-control input-sm required',
                        'value' => $this->config->item('api_username')));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">	
            <?php echo form_label($this->lang->line('config_api_password'), 'api_password', array('class' => 'control-label col-xs-2 required')); ?>
            <div class="col-xs-6">
                <div class="input-group">
                    <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-triangle-right"></span></span>
                    <?php
                    echo form_password(array(
                        'name' => 'api_password',
                        'id' => 'api_password',
                        'class' => 'form-control input-sm required',
                        'value' => $this->config->item('api_password')));
                    ?>
                </div>
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
    $(document).ready(function()
    {
        $('#api_config_form').validate({
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    success: function(response) {
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
            errorLabelContainer: "#api_error_message_box",
            wrapper: "li",
            highlight: function(e) {
                $(e).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(e) {
                $(e).closest('.form-group').removeClass('has-error');
            },
            rules:
                    {
                        api_id: "required",
                        api_name: "required",
                        api_website: "required",
                        api_host: "required",
                        api_key: "required",
                        api_username: "required",
                        api_password: "required"
                    },
            messages:
                    {
                        api_id: "<?php echo $this->lang->line('config_api_id_required'); ?>",
                        api_name: "<?php echo $this->lang->line('config_api_name_required'); ?>",
                        api_website: "<?php echo $this->lang->line('config_api_website_required'); ?>",
                        api_host: "<?php echo $this->lang->line('config_api_host_required'); ?>",
                        api_key: "<?php echo $this->lang->line('config_api_key_required'); ?>",
                        api_username: "<?php echo $this->lang->line('config_api_username_required'); ?>",
                        api_password: "<?php echo $this->lang->line('config_api_password_required'); ?>"
                    }
        });
    });
</script>