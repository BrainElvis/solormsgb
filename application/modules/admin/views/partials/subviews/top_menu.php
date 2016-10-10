

<div class="top_nav">
    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo site_url('admin/logout') ?>"><span class="glyphicon glyphicon-off" aria-hidden="true"></span><?php echo $this->lang->line('common_logout') ?></a>
                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <?php $mails = get_mails() ?>   
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green"><?php echo count($mails) ?></span>
                        <span>inbox</span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                        <?php if (!empty($mails)): ?>
                            <?php foreach ($mails as $mail): ?>
                                <li>
                                    <a>
                                        <span>
                                            <span><?php echo $mail->name ?></span>
                                        </span>
                                        <span class="message">
                                            <?php echo $mail->message; ?>
                                        </span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <li>
                            <div class="text-center">
                                <a href="<?php echo site_url('admin/inbox')?>">
                                    <strong>See All Messages</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>

</div>