<div class="container">
    <div class="row accountbg">
        <?php $this->load->view('customer/subviews/nav') ?>
        <div class="col-md-9">
            <div class="content-innerspan2">
                <div class="innercommon-right">
                    <h1><?php echo $current_section ?></h1>
                    <?php $orders = array_reverse($orders) ?>

                    <div class="innercommon-right-content">
                        <table class="payment-table" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <th class="bdr-bottom bdr-right">Ref.#</th>
                                    <th class="bdr-bottom bdr-right">Date</th>
                                    <th class="bdr-bottom bdr-right">Total</th>
                                    <th class="bdr-bottom bdr-right">Status</th>
                                    <th class="bdr-bottom bdr-right">Type</th>
                                    <th class="bdr-bottom bdr-right">Action</th>
                                </tr>
                                <?php if (!empty($orders)): ?>
                                    <?php foreach ($orders as $order): ?>
                                        <tr class="odd">
                                            <td class="bdr-bottom bdr-right"><?php echo $order->OrderId ?></td>
                                            <td class="bdr-bottom bdr-right"><?php echo date("d, M Y", strtotime($order->OrderDate)); ?></td>
                                            <td class="bdr-bottom bdr-right"><?php echo to_currency($order->total_price + $order->HandlingFee + $order->Vat + $order->CCFee + $order->DeliveryCost) ?></td>
                                            <td class="bdr-bottom bdr-right">
                                                <span style="color:#FF9900;" class="blink">
                                                    <?php
                                                    if ($order->Status == 0 || $order->Status == null) {
                                                        echo "Pending";
                                                    }
                                                    if ($order->Status == 1) {
                                                        echo "Confirmed";
                                                    }
                                                    if ($order->Status == 3) {
                                                        echo "Rejected";
                                                    }
                                                    ?>

                                                </span>
                                            </td>
                                            <td class="bdr-bottom bdr-right">
                                                <?php
                                                if ($order->OrderPolicyId == 1) {
                                                    echo "Pick Up";
                                                }
                                                if ($order->OrderPolicyId == 2) {
                                                    echo "Delivery";
                                                }
                                                ?>
                                            </td>
                                            <td class="bdr-bottom bdr-right">
                                                <span class="label-status order-status-reviewed"><a href="<?php echo site_url('customer/orderdetail/' . $order->OrderId) ?>">View Details</a></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr class="odd">
                                        <td class="bdr-bottom bdr-right" colspan="6">No Orders Found </td>
                                    </tr>
                                <?php endif; ?>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
