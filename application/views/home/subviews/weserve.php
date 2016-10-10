<div class="whatdobg">

    <?php
   // debugPrint($promotime);
    if ($this->config->item('home_weserve') == 'on') {
        echo $this->load->view('home/subviews/service');
    }
    if ($this->config->item('home_promotime') == 'on') {
        $promotimeData['rest_schedule'] = $promotime['data']['rest_schedule'];
        $promotimeData['rest_promotion'] = $promotime['data']['rest_promotion'];
        $promotimeData['rest_vouchers'] = $promotime['data']['rest_vouchers'];
        $promotimeData['restaurant_status'] = $promotime['data']['restaurant_status'];
        echo $this->load->view('home/subviews/promotime', $promotimeData);
    }
    ?>
    <!-- .container -->
</div>