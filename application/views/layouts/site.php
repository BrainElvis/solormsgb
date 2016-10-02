<!DOCTYPE html>
<html lang="en" style="overflow-y: hidden;">
    <head>
        <meta charset="utf-8">
        <title><?php echo $template['title'] ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo $template['metadata'] ?>
    </head>
    <body class="<?php echo $body_class ?>">
        <!-- Full Body Container -->
        <div id="container">
            <!-- Start Header Section -->
            <?php echo $template['partials']['header'] ?>
            <!-- End Header Section -->
            <?php echo $template['body'] ?>
            <!--------------------------------- Footer Part work ---------------------------------------------------------->
            <?php echo $template['partials']['footer'] ?>
            <!--------------------------------- End Footer Part ----------------------------------------------------------->
            <!-- All Popup Modal Modal -->
            <?php echo $template['partials']['addtocart'] ?>
            <!-- End Modal -->
            <!---------------- Login --------------------->
            <?php echo $template['partials']['loginform'] ?>
            <!---------------- End Login ------------>
            <!---------------- Registration --------------------->
            <?php echo $template['partials']['registrationform'] ?>
            <!---------------- End Registration ------------>
            <!--------------------- Modal Part -------------------------------->  
        </div>
        <!-- End Full Body Container -->
        <!-- Go To Top Link -->
        <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
        <!-- Style Switcher -->
        <div id="ascrail2000" class="nicescroll-rails" style="width: 5px; z-index: 999999999; cursor: default; position: fixed; top: 0px; height: 100%; right: 0px; opacity: 0;">
            <div style="position: relative; top: 0px; float: right; width: 5px; height: 71px; border: 0px; border-radius: 0px; background-color: rgb(51, 51, 51); background-clip: padding-box;"></div>
        </div>

    </body>
</html>