<!------------------------------ Gallery HTML -------------------------->   
<div class="container">    
    <div class="row" style="margin-top: 50px; text-align:center; border-bottom:1px dashed #ccc;  padding:0 0 20px 0; margin-bottom:40px;">
        <h3 style="font-family:arial; font-weight:600; font-size:30px; text-transform: uppercase;"><?php isset($current_section) ? print $current_section : print'' ?></h3>
    </div>

    <ul class="row">
        <?php if (!empty($gallery_images)): ?>
            <?php foreach ($gallery_images as $image) : ?>    
                <li class="col-md-2">
                    <img class="img-responsive" src="<?php echo ASSETS_SITE_GALLERY_IMAGE_PATH.$image->name ?>">
                </li>
            <?php endforeach; ?>

        <?php else: ?>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-174908-rocking-the-night-away-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-287182-blah-blah-blah-yellow-road-sign-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-460760-colors-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-461673-retro-party-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-514834-touchscreen-technology-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-916206-legal-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-1062948-nature-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-1471528-insant-camera-kid-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-2255072-relaxed-man-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-2360379-colors-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-2360571-jump-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-2361384-culture-for-business-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-2441670-spaghetti-with-tuna-fish-and-parsley-s.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-2943363-budget-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-3444921-street-art-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-3552322-insurance-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-3807845-food-s.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-3835655-down-office-worker-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-4619216-ui-control-knob-regulators-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-5771958-health-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-268693-businesswoman-using-laptop-outdoors-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-352207-search-of-code-s.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-247190-secret-email-xs.jpg">
            </li>
            <li class="col-md-2">
                <img class="img-responsive" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>photodune-682990-online-search-xs.jpg">
            </li>
        <?php endif; ?>

    </ul>             
</div> 
<!-- /container -->
