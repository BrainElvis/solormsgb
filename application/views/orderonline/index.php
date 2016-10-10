<?php
//debugPrint($apiData);
if (isset($apiData) && !empty($apiData)) {
    $menuData['categories'] = $apiData ['categories'];
    $menuData['bases'] = $apiData ['bases'];
    $menuData['selections'] = $apiData ['selections'];
    $menuData['restaurant_status'] = $apiData ['restaurant_status'];
    $menuData['order_policy'] = $apiData ['order_policy'];
    $menuData['pre_hide_status'] = $apiData ['pre_hide_status'];
    $restaurantInfoData ['info'] = $apiData ['rest_info'];
    $restaurantInfoData ['cuisines'] = $apiData ['cuisines'];
    $restaurantInfoData ['cuisines'] = $apiData ['cuisines'];
    $restaurantInfoData ['deliverypolicy'] = $apiData ['deliverypolicy'];
    $restaurantInfoData ['deliveryarea'] = $apiData ['deliveryarea'];
    $restaurantInfoData ['delarea'] = $apiData ['delarea'];
    $restaurantSchedule ['schedule'] = $apiData ['schedule'];
}
?>
<div class="section service">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if (true == $api_status): ?>
                    <!-- Nav tabs -->
                    <div class="card">
                        <ul class="nav nav-tabs" role="tablist">
                            <?php if (1): ?>
                                <li role="presentation" class="active"><a href="#restaurantMenu" aria-controls="home" role="tab" data-toggle="tab"><?php echo $this->lang->line('online_menu_tab') ?></a></li>
                            <?php endif; ?>
                            <?php if (1): ?>
                                <li role="presentation"><a href="#restaurantInfo" aria-controls="profile" role="tab" data-toggle="tab"><?php echo $this->lang->line('online_info_tab') ?></a></li>
                            <?php endif; ?>
                            <?php if (1): ?>
                                <li role="presentation"><a href="#restaurantOpeningTime" aria-controls="messages" role="tab" data-toggle="tab"><?php echo $this->lang->line('online_opening_time_tab') ?></a></li>
                            <?php endif; ?>
                            <?php if ($this->config->item('online_review') == 'on'): ?>
                                <li role="presentation"><a href="#customerReviews" aria-controls="settings" role="tab" data-toggle="tab"><?php echo $this->lang->line('online_review_tab') ?></a></li>
                            <?php endif; ?>
                            <?php if ($this->config->item('online_book') == 'on'): ?>
                                <li role="presentation"><a href="#tableReservation" aria-controls="order" role="tab" data-toggle="tab"><?php echo $this->lang->line('online_book_a_table_tab') ?></a></li>
                            <?php endif; ?>
                        </ul>
                        <!--Tab panes -->
                        <div class = "tab-content">
                            <?php
                            /* ----------------------Menu Items------------------------ */
                            if (1) {
                                $this->load->view('orderonline/subviews/items', isset($menuData) ? $menuData : '');
                            }
                            /* ----------------------Restaurant Information-------------- */
                            if (1) {
                                $this->load->view('orderonline/subviews/restaurantinfo', isset($restaurantInfoData) ? $restaurantInfoData : '');
                            }
                            /* ----------------------Restaurant Opening Time-------------- */
                            if (1) {
                                $this->load->view('orderonline/subviews/openingtime', isset($restaurantSchedule) ? $restaurantSchedule : '');
                            }
                            /* ----------------------Customer Reviews--------------------- */
                            if ($this->config->item('online_review') == 'on') {
                                $this->load->view('orderonline/subviews/reviews');
                            }
                            /* ----------------------Customer Reviews--------------------- */
                            if ($this->config->item('online_book') == 'on') {
                                $this->load->view('orderonline/subviews/tablebook');
                            }
                            ?>
                        </div>
                    </div>
                <?php else: ?>
                    <?php echo $api_message ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- .container -->
</div>
