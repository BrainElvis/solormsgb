<footer>
    <div class="copyright-info">
        <?php $api_host = explode('//', $this->config->item('api_host')); ?>
        <?php $api_host_domain = explode('/', $api_host[1]) ?>
        <p>&COPY;<?php echo date('Y') ?>&nbsp;<strong><?php echo $this->config->item('company') ?></strong>.<?php echo $this->lang->line('common_copyright', 'TO DO') ?>&nbsp;<?php echo $this->lang->line('common_powered_by', 'TO DO') ?> <a href="<?php echo $this->config->item('api_host') ?>"><strong><?php echo $api_host_domain[0] ?></strong></a>.</p>
    </div>
    <div class="clearfix"></div>
</footer>
