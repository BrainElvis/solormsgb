<div class="top-footerbg">
    <div class="container">
        <div class="row topfooterbgbottom">
            <div class="col-md-2 topfooterbg2">
                <p><a href="#"><img src="<?php echo ASSETS_SITE_IMAGE_PATH ?>ssl-png.png" alt="ssl" width="93" height="102"></a></p>
            </div>
            <div class="col-md-6 col-md-offset-4 topfooterbg">
                <ul>
                    <li>We Support The Following Payment Methods: </li>
                    <li><a href="#"><img src="<?php echo ASSETS_SITE_IMAGE_PATH ?>paypalbg.png"></a></li>
                    <li><a href="#"><img src="<?php echo ASSETS_SITE_IMAGE_PATH ?>vishapng.png"></a></li>
                    <li><a href="#"><img src="<?php echo ASSETS_SITE_IMAGE_PATH ?>mastercardpng.png"></a></li>
                    <li><a href="#"><img src="<?php echo ASSETS_SITE_IMAGE_PATH ?>paymentpngbg.png"></a></li>
                    <li><a href="#"><img src="<?php echo ASSETS_SITE_IMAGE_PATH ?>paymentpngbg2.png"></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!------------------------- Copyright part ------------------------->
    <div class="copyright-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?php $api_host = explode('//', $this->config->item('api_host')); ?>
                    <?php $api_host_domain = explode('/', $api_host[1]) ?>
                    <p>&COPY;<?php echo date('Y') ?>&nbsp;<strong><?php echo $this->config->item('company') ?></strong>.<?php echo $this->lang->line('common_copyright', 'TO DO') ?>&nbsp;<?php echo $this->lang->line('common_powered_by', 'TO DO') ?> <a href="<?php echo $this->config->item('api_host') ?>"><strong><?php echo $api_host_domain[0] ?></strong></a>.</p>
                </div>
                <!-- .col-md-6 -->
                <div class="col-md-6">
                    <ul class="footer-nav">
                        <li><a href="<?php echo base_url() ?>">Home</a></li>
                        <li><a href="<?php echo base_url() ?>gallery">Photogallery</a></li>
                        <li><a href="<?php echo base_url() ?>menu">Online Order</a></li>
                        <li><a href="<?php echo base_url() ?>contact">Contact</a></li>
                        <li><a href="<?php echo base_url() ?>">Help</a></li>
                    </ul>
                </div>
                <!-- .col-md-6 -->
            </div>
        </div>
        <!-- .row -->
    </div>
    <!---------------------------- End copyright --------------------->
</div>
<!-------------------------------------------------------- End Main Footer Part work ----------------------------------------------------->

<!-- Return to Top -->
<a href="javascript:" id="return-to-top"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
<!-- Test the scroll -->
<script>
// ===== Scroll to Top ==== 
    $(window).scroll(function () {
        if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200);   // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function () {      // When arrow is clicked
        $('body,html').animate({
            scrollTop: 0                       // Scroll to top of body
        });
    });
</script>

<!---------------- Login --------------------->
<?php $this->load->view('partials/subviews/common-modal') ?>
<!---------------- End Login ------------>
<!---------------- Registration --------------------->
<?php $this->load->view('partials/subviews/login-modal') ?>
<!---------------- End Registration ------------> 
<!--------------------------------- General Modal ------------------------------>
<?php $this->load->view('partials/subviews/registration-modal') ?>
