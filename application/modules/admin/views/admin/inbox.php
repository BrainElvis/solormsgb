<?php ?>
<div class="page-content">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo $current_section ?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="content bulk_action input">
                    <table class="table table-striped responsive-utilities jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th><input type="checkbox" id="check-all" class="flat"></th>
                                <th class="column-title">Serial#</th>
                                <th class="column-title">Sender</th>
                                <th class="column-title">Email</th>
                                <th class="column-title">Message</th>
                                <th class="column-title">Sent At</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($inbox_mails)): ?>
                                <?php $count = 1; ?>
                                <?php foreach ($inbox_mails as $mail): ?> 
                                    <tr class="pointer <?php $count % 2 == 0 ? print'even' : print'odd' ?>">
                                        <td class="a-center "><input type="checkbox" class="flat" name="id" value="<?php echo $mail->id; ?>"></td>
                                        <td><?php echo $count ?></td>
                                        <td class=" "><?php echo $mail->name ?></td>
                                        <td class=" "><?php echo $mail->email ?></td>
                                        <td class=" "><?php echo substr($mail->message, 0, 10) ?>...</td>
                                        <td class=" "><?php echo $mail->sent_at ?></td>
                                        <td class=" last">
                                            <a href="#">Reply</a>
                                            <span>&nbsp;|&nbsp;</span>
                                            <a href="#">View</a>
                                            <span>&nbsp;|&nbsp;</span>
                                            <a href="#">Delete</a>
                                        </td>
                                    </tr>
                                    <?php $count++; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <ul class="pagination pagination-sm">
                        <?php echo $pagination; ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>