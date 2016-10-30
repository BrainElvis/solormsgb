<script> var base_url = '<?php echo base_url(); ?>';</script>
<nav class="navbar navbar-inverse navbar-fixed-top mainnavbg" role="navigation">
    <div class="container">
        <div class="row">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="col-md-3">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url() ?>"><img src="<?php echo ASSETS_SITE_IMAGE_PATH ?>logo.png" width="178" height="49"></a>
                </div>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="col-md-9">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right navigationbg">
                        <li><a href="<?php echo site_url() ?>"><?php echo $this->lang->line('menu_home') ?></a></li>
                        <li><a href="<?php echo site_url('gallery'); ?>"><?php echo $this->lang->line('menu_photogallery') ?></a></li>
                        <li><a href="<?php echo site_url('orderonline'); ?>"><?php echo $this->lang->line('menu_online_order') ?></a></li>
                        <li><a href="<?php echo site_url('contact'); ?>"><?php echo $this->lang->line('menu_contact') ?></a></li>
                        <?php if ($this->session->userdata('CustId')): ?>
                            <li><a href="<?php echo site_url('customer'); ?>"><?php echo $this->lang->line('menu_my_account') ?></a></li>
                            <li><a href="<?php echo site_url('customer/logout'); ?>"><?php echo $this->lang->line('common_logout') ?></a></li>
                        <?php else: ?>
                            <li><button class="registerbg" data-toggle="modal" data-target="#registration"><i class="fa fa-sign-out" aria-hidden="true"></i><?php echo $this->lang->line('menu_register') ?></button></li>
                            <li><button class="lgbg" data-toggle="modal" data-target="#login"><i class="fa fa-user" aria-hidden="true"></i><?php echo $this->lang->line('menu_login') ?></button></li>
                                <?php endif; ?>
                    </ul>             
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </div>
    <!-- /.container -->
</nav>