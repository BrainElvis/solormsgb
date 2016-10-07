<?php
if (isset($apiData)) {
    $apiDataArray = objectToArray (json_decode($apiData));
    if (isset($apiDataArray)) {
        $menuData['categories'] = $apiDataArray ['categories'] ;
        $menuData['bases'] = $apiDataArray ['bases'];
        $menuData['selections'] = $apiDataArray ['selections'];
        $menuData['restaurant_status'] = $apiDataArray ['restaurant_status'];
        $menuData['order_policy'] = $apiDataArray ['order_policy'];
        $menuData['pre_hide_status'] = $apiDataArray ['pre_hide_status'];
    }
    //$menuData['test']=  base_special_criteria(3792);
   // debugPrint($menuData);
}
?>
<div class="section service">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Nav tabs --><div class="card">
                    <ul class="nav nav-tabs" role="tablist">
                        <?php if (1): ?>
                            <li role="presentation" class="active"><a href="#restaurantMenu" aria-controls="home" role="tab" data-toggle="tab">Menu</a></li>
                        <?php endif; ?>
                        <?php if (1): ?>
                            <li role="presentation"><a href="#restaurantInfo" aria-controls="profile" role="tab" data-toggle="tab">Info</a></li>
                        <?php endif; ?>
                        <?php if (1): ?>
                            <li role="presentation"><a href="#restaurantOpeningTime" aria-controls="messages" role="tab" data-toggle="tab">Opening Hour</a></li>
                        <?php endif; ?>
                        <?php if (1): ?>
                            <li role="presentation"><a href="#customerReviews" aria-controls="settings" role="tab" data-toggle="tab">Reviews</a></li>
                        <?php endif; ?>
                        <?php if (1): ?>
                            <li role="presentation"><a href="#tableReservation" aria-controls="order" role="tab" data-toggle="tab">Book a Table</a></li>
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
                            $this->load->view('orderonline/subviews/restaurantinfo');
                        }
                        /* ----------------------Restaurant Opening Time-------------- */
                        if (1) {
                            $this->load->view('orderonline/subviews/openingtime');
                        }
                        /* ----------------------Customer Reviews--------------------- */
                        if (1) {
                            $this->load->view('orderonline/subviews/reviews');
                        }
                        /* ----------------------Customer Reviews--------------------- */
                        if (1) {
                            $this->load->view('orderonline/subviews/tablebook');
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .container -->
</div>
