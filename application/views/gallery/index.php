<!------------------------------ Gallery HTML -------------------------->   
<style>
    body{font:12px/1.2 Verdana, sans-serif; padding:0 10px;}
    a:link, a:visited{text-decoration:none; color:#416CE5; border-bottom:1px solid #416CE5;}
    h2{font-size:13px; margin:15px 0 0 0;}
</style>

<div class="container">    
    <div class="row" style="margin-top: 50px; text-align:center; border-bottom:1px dashed #ccc;  padding:0 0 20px 0; margin-bottom:40px;">
        <h3 style="font-family:arial; font-weight:600; font-size:30px; text-transform: uppercase;"><?php isset($current_section) ? print $current_section : print'' ?></h3>
    </div>

    <ul class="row gallery">
        <?php if (!empty($gallery_images)): ?>
            <?php foreach ($gallery_images as $image) : ?>  
                <li class="col-md-2">
                    <a class="group4"  href="<?php echo ASSETS_SITE_GALLERY_IMAGE_PATH . $image->name ?>" title="<?php echo $image->name ?>"> <img class="img-responsive" src="<?php echo ASSETS_SITE_GALLERY_IMAGE_PATH . $image->name ?>"></a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>

    </ul>             
</div> 
<!-- /container -->
<script>
    $(document).ready(function () {
        //Examples of how to assign the Colorbox event to elements

        $(".group4").colorbox({rel: 'group4', slideshow: true});
        $(".callbacks").colorbox({
            onOpen: function () {
                alert('onOpen: colorbox is about to open');
            },
            onLoad: function () {
                alert('onLoad: colorbox has started to load the targeted content');
            },
            onComplete: function () {
                alert('onComplete: colorbox has displayed the loaded content');
            },
            onCleanup: function () {
                alert('onCleanup: colorbox has begun the close process');
            },
            onClosed: function () {
                alert('onClosed: colorbox has completely closed');
            }
        });

        //Example of preserving a JavaScript event for inline calls.
        $("#click").click(function () {
            $('#click').css({"background-color": "#f00", "color": "#fff", "cursor": "inherit"}).text("Open this window again and this message will still be here.");
            return false;
        });
    });
</script>