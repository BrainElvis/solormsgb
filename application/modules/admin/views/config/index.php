<div class="page-content">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php isset($current_section) ? print $current_section : print '' ?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="content">

                    <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="active" role="presentation">
                            <a data-toggle="tab" href="#general" title="<?php echo $this->lang->line('config_general_configuration'); ?>"><?php echo $this->lang->line('config_general'); ?></a>
                        </li>
                        <li role="presentation">
                            <a data-toggle="tab" href="#api" title="<?php echo $this->lang->line('config_api_configuration'); ?>"><?php echo $this->lang->line('config_api'); ?></a>
                        </li>
                        <li role="presentation">
                            <a data-toggle="tab" href="#payment" title="<?php echo $this->lang->line('config_payment_configuration'); ?>"><?php echo $this->lang->line('config_payment'); ?></a>
                        </li>
                        <li role="presentation">
                            <a data-toggle="tab" href="#locale" title="<?php echo $this->lang->line('config_locale_configuration'); ?>"><?php echo $this->lang->line('config_locale'); ?></a>
                        </li>
                         <li role="presentation">
                            <a data-toggle="tab" href="#homepage" title="<?php echo $this->lang->line('config_homepage_configuration'); ?>"><?php echo $this->lang->line('config_homepage'); ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="general">
                            <?php $this->load->view("config/general_config"); ?>
                        </div>
                        <div class="tab-pane" id="api">
                            <?php $this->load->view("config/api_config"); ?>
                        </div>
                        <div class="tab-pane" id="payment">
                            <?php $this->load->view("config/payment_config"); ?>
                        </div>
                        <div class="tab-pane" id="locale">
                            <?php $this->load->view("config/locale_config"); ?>
                        </div>
                        <div class="tab-pane" id="homepage">
                            <?php $this->load->view("config/homepage_config"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>