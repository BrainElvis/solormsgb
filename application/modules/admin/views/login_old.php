<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $this->config->item('company_name')?> | <?php echo $this->lang->line('login_login')?></title>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo ASSETS_ADMIN_CSS_PATH ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo ASSETS_ADMIN_FONTS_PATH ?>css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo ASSETS_ADMIN_CSS_PATH ?>animate.min.css" rel="stylesheet">
        <!-- Custom styling -->
        <link href="<?php echo ASSETS_ADMIN_CSS_PATH ?>custom.css" rel="stylesheet">
        <link href="<?php echo ASSETS_ADMIN_CSS_PATH ?>style.css" rel="stylesheet">
        <!-- Bootstrap core js -->
        <script src="<?php echo ASSETS_ADMIN_JS_PATH ?>jquery.min.js"></script>
        <!-- Bootstrap core js -->
        <script src="<?php echo ASSETS_ADMIN_JS_PATH ?>bootstrap.min.js"></script>
        <!--[if lt IE 9]>
              <script src="../assets/js/ie8-responsive-file-warning.js"></script>
              <![endif]-->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
              <![endif]-->
        <script type="text/javascript">
            window.onload = function ()
            {
                document.getElementById("username").focus();
            };
        </script>
    </head>
    <body style="background:#F7F7F7;">
        <div class="login-form">
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>
            <div id="wrapper">
                <div id="login" class="animate form">
                    <section class="login_content">
                        <?php echo form_open('admin/login') ?>
                        <h1>Login Form</h1>
                        <div align="center" style="color:red"><?php echo validation_errors(); ?></div>
                        <div>
                            <?php echo form_input(array('name' => 'username', 'id' => 'username', 'class' => 'form-control', 'size' => '20')); ?>
                        </div>
                        <div>
                            <?php echo form_password(array('name' => 'password', 'id' => 'password', 'class' => 'form-control', 'size' => '20')); ?>
                        </div>
                        <div>
                            <input class="btn btn-primary btn-block" type="submit" name="loginButton" value="Go"/>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-paw" style="font-size: 26px;"></i>Solo RMS</h1>
                                <p>©2016 All Rights Reserved. Powered by <a href="http://munchnow.com">munchnow.co.uk</a></p>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                        <!-- form -->
                    </section>
                    <!-- content -->
                </div>
            </div>
        </div>

    </body>

</html>
