<div class="whatdobg">
    <?php
    if ($this->config->item('home_weserve') == 'on') {
        echo $this->load->view('home/subviews/service');
    }
    if ($this->config->item('home_promotime') == 'on') {
        echo $this->load->view('home/subviews/promotime');
    }
    ?>
    <!-- .container -->
</div>