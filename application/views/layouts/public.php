<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $template['title'] ?></title>
        <!--------- META, CSS AND jQuery--------->
        <?php echo $template['metadata'] ?>
    </head>
    <body class="<?php echo $body_class ?>">
        <!-- Navigation -->
        <?php echo $template['partials']['header'] ?>
        <!-------------------------------------- Contact Page --------------------------------------->
        <?php echo $template['body'] ?>
        <!--------------------------Footer including login,registration modal popup------------------------->
        <?php echo $template['partials']['footer'] ?>
    </body>
</html>
