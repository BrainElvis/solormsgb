<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $template['title'] ?></title>
        <?php echo $template['metadata'] ?>
        <!--[if lt IE 9]>
              <script src="../assets/js/ie8-responsive-file-warning.js"></script>
         <![endif]-->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
       <![endif]-->

    </head>
    <body class="nav-md <?php echo $body_class ?>">
        <div class="container body">
            <div class="main_container">
                <!-- left and top navigation -->
                <?php echo $template['partials']['header'] ?>
                <!-- page content -->
                <div class="right_col" role="main">
                    <div id="feedback_bar"></div>
                    <?php echo $template['body'] ?>
                    <!-- footer content -->
                    <?php echo $template['partials']['footer'] ?>
                    <!-- /footer content -->
                </div>
                <!-- /page content -->
            </div>
        </div>
        <?php echo $template['partials']['notification'] ?>
        <script type="text/javascript"></script>
    </body>
</html>
