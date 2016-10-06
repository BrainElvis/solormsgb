<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $this->config->item('company') ?> | <?php echo $this->lang->line('login_login') ?></title>
        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo ASSETS_ADMIN_LOGIN_PATH; ?>bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo ASSETS_ADMIN_LOGIN_PATH; ?>font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo ASSETS_ADMIN_LOGIN_PATH; ?>/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo ASSETS_ADMIN_LOGIN_PATH; ?>css/style.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php echo ASSETS_ADMIN_LOGIN_PATH; ?>ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo ASSETS_ADMIN_LOGIN_PATH; ?>ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo ASSETS_ADMIN_LOGIN_PATH; ?>ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo ASSETS_ADMIN_LOGIN_PATH; ?>ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo ASSETS_ADMIN_LOGIN_PATH; ?>ico/apple-touch-icon-57-precomposed.png">
    </head>
    <body class="admin-login-form">
        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row row-centered">
                        <div class="col-sm-5 col-centered">
                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <img class="img-responsive logo col-centered" src="<?php echo site_url() ?>uploads/<?php echo $this->config->item('company_logo') ?>">
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <p><?php echo $this->lang->line('login_header_title') ?></p>
                                    <?php if (isset($message)): ?>
                                        <p style="color: #ff0000;"><?php print $message; ?></p>
                                    <?php endif; ?>
                                    <?php echo form_open('admin/login', array('role' => 'form', 'method' => 'post', 'class' => 'login-form')) ?>
                                    <div class="form-group">
                                        <?php echo form_label($this->lang->line('login_username'), '', array('class' => 'sr-only required', 'for' => 'username')) ?>
                                        <input type="text" name="username" placeholder="Username..." class="form-username form-control required" id="form-username" value="<?php echo set_value('username'); ?>" >
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label($this->lang->line('login_password'), '', array('class' => 'sr-only required', 'for' => 'password')) ?>
                                        <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password required" value="<?php echo set_value('password'); ?>">
                                    </div>
                                    <button type="submit" class="btn"><?php echo $this->lang->line('login_go') ?></button>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="footer-border"></div>
                        <?php $api_host = explode('//', $this->config->item('api_host')); ?>
                        <?php $api_host_domain = explode('/', $api_host[1]) ?>
                        <p>&COPY;<?php echo date('Y') ?>&nbsp;<strong><?php echo $this->config->item('company') ?></strong>.<?php echo $this->lang->line('common_copyright', 'TO DO') ?>&nbsp;<?php echo $this->lang->line('common_powered_by', 'TO DO') ?> <a href="<?php echo $this->config->item('api_host') ?>"><strong><?php echo $api_host_domain[0] ?></strong></a>.</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Javascript -->
        <script src="<?php echo ASSETS_ADMIN_LOGIN_PATH; ?>js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo ASSETS_ADMIN_LOGIN_PATH; ?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo ASSETS_ADMIN_LOGIN_PATH; ?>js/jquery.backstretch.min.js"></script>
        <script src="<?php echo ASSETS_ADMIN_LOGIN_PATH; ?>js/scripts.js"></script>
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
    </body>
</html>