
<div role="tabpanel" class="tab-pane active" id="restaurantMenu">
    <div class="row" style="min-height: 600px; width: 100%; margin: 0px; padding: 0px; border: 1px solid #eee; ">
        <div class="col-sm-9" style="width: 100%; padding: 0px; margin-top: 15px">
            <div class="col-xs-3 left-ctbg">
                <!-- required for floating -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs2">
                    <div class="categorybg"><h2>Category</h2></div>
                    <?php if (isset($categories) && !empty($categories)): ?>
                        <?php $index1 = 0; ?>
                        <?php foreach ($categories as $category) : ?>
                            <?php $index1++; ?>
                            <li class="<?php ($index1 == 1) ? print'active' : '' ?>"><a href="#<?php echo $category['CatId'] ?>" data-toggle="tab"><?php echo $category ['CatName'] ?></a></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="active"><a href="#1" data-toggle="tab">Starters</a></li>
                        <li><a href="#2" data-toggle="tab">Popular</a></li>
                        <li><a href="#3" data-toggle="tab">Rice and Nan</a></li>
                        <li><a href="#4" data-toggle="tab">Pizz</a></li>
                        <li><a href="#5" data-toggle="tab">New Popular</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-xs-9 left-ctbg2" style=" padding: 0px; width: 48%; margin-left: 12px; margin-bottom:20px;">
                <!-- Tab panes -->
                <div class="tab-content">
                    <?php if (isset($categories) && !empty($categories)): ?>
                        <?php //debugPrint($categories);?>
                        <?php $index2 = 0; ?>
                        <?php foreach ($categories as $category): ?>
                            <?php $index2++; ?>
                            <div class="tab-pane <?php ($index2 == 1) ? print'active' : '' ?> " id="<?php echo $category ['CatId'] ?>">
                                <div class="topimg"><img src="<?php echo ASSETS_SITE_IMAGE_PATH ?>ordermenuicon.jpg"></div>
                                <div class="menuheading"><?php echo $category ['CatName'] ?></div>
                                <div class="menuheading-img">
                                    <?php if (isset($category['cat_image'])): ?>
                                        <img src="<?php echo $this->config->item('api_host') ?>assets/uploads/menu_item/category/<?= $category ['cat_image'] ?>" width="100%" height="150px" alt="" title="<?= $category ['CatName'] ?>" />
                                    <?php endif; ?>
                                </div>
                                <?php if ($category ['Special'] == 0) : ?>
                                    <?php if ($bases [$category ['CatId']] != NULL) : ?>
                                        <?php
                                        $count = 1;
                                        $ij = 0;
                                        $base_count = sizeof($bases [$category['CatId']]);
                                        $bcount = 0;
                                        ?>
                                        <?php foreach ($bases [$category ['CatId']] as $base): ?>
                                            <?php
                                            if (empty($base)) {
                                                continue;
                                            }
                                            $showonmenu = 1;
                                            $selectionexist = 0;
                                            $bcount ++;
                                            $liClass = ($base_count == $bcount) ? "class='nobg'" : "";
                                            foreach ($selections [$category['CatId']] [$base ['BaseId']] as $selonmenu) {
                                                if (empty($selonmenu)) {
                                                    continue;
                                                }
                                                if ($selonmenu ['Show']) {
                                                    $showonmenu = 0;
                                                }
                                                $selectionexist = 1;
                                            }
                                            if ($base ['IsSpecial'] == 1) {                               
                                                //$result = base_special_criteria($base ['BaseId']);
                                                 $result = base_special_criteria(3792);

                                                debugPrint($result, 'check');
                                                if (empty($result)) {
                                                    continue;
                                                }
                                            }

                                            if (isset($base->Hotlevel)) {
                                                $hl = str_split($base->Hotlevel);
                                                if (sizeof($hl) == 1) {
                                                    if ($hl [0] == 1)
                                                        $hlimg = 'hot.png';
                                                    if ($hl [0] == 2)
                                                        $hlimg = 'midium-hot.png';
                                                    if ($hl [0] == 3)
                                                        $hlimg = 'very-hot.png';
                                                    if ('V' == $hl [0])
                                                        $imgveg = 'veg.png';
                                                    if ('M' == $hl [0])
                                                        $imgvem = 'nuts.png';
                                                }
                                                elseif (sizeof($hl) == 2 && is_numeric($hl [0])) {
                                                    if ($hl [0] == 1)
                                                        $hlimg = 'hot.png';
                                                    if ($hl [0] == 2)
                                                        $hlimg = 'midium-hot.png';
                                                    if ($hl [0] == 3)
                                                        $hlimg = 'very-hot.png';
                                                    if ($hl [1] == 'M')
                                                        $imgvem = 'nuts.png';
                                                    if ($hl [1] == 'V')
                                                        $imgveg = 'veg.png';
                                                } else if (sizeof($hl) == 2 && !is_numeric($hl [0])) {
                                                    $imgveg = 'vagiterian.png';
                                                    $imgvem = 'nuts.png';
                                                } else if (sizeof($hl) == 3 && is_numeric($hl [0])) {
                                                    if ($hl [0] == 1)
                                                        $hlimg = 'hot.png';
                                                    if ($hl [0] == 2)
                                                        $hlimg = 'midium-hot.png';
                                                    if ($hl [0] == 3)
                                                        $hlimg = 'very-hot.png';
                                                    $imgveg = 'veg.png';
                                                    $imgvem = 'nuts.png';
                                                }
                                            }



                                            //discout code
                                            if ($base['BaseDiscount'] > 0) {
                                                $basediscount = number_format(($base ['BasePrice'] - ($base ['BasePrice'] * $base ['BaseDiscount'])), 2, '.', '');
                                            } else {
                                                $basediscount = number_format(($base ['BasePrice'] - ($base ['BasePrice'] * $category['CatDiscount'])), 2, '.', '');
                                            }
                                            // end discount code
                                            $discountForSecondaryItem = $basediscount;
                                            $item_no = $base['ItemNo'] ? $base['ItemNo'] . ".  " : "  ";
                                            ?>
                                            <!--------------------- Product One ---------------------->
                                            <div class="restaurant-odd" >
                                                <ul>
                                                    <li>
                                                        <span class="itemfulldescription">
                    <?php if ($showonmenu) : ?>
                                                                <?php if ($base ['IsSpecial'] == 1): ?>
                                                                    <span class="itemname" onclick='addspecialtocart("",<?= $base ['CatId'] ?>,<?= $base ['BaseId'] ?>, 0, "<?= $base['BasePrice'] ?>&<?= $basediscount ?>")'> <a  data-toggle="modal" data-target="#myModal" href="#"><?= $item_no ?><?= html_entity_decode($base ['BaseName'], ENT_QUOTES) ?></a>
                                                                    <?php if (isset($imgveg)): ?>
                                                                            <img src="<?php echo $this->config->item('api_host') ?>assets/admin/images/<?= $imgveg ?>" title="Vegetarian"/>
                                                                        <?php endif; ?>
                                                                        <?php if (isset($hlimg)): ?>
                                                                            <img src="<?php echo $this->config->item('api_host') ?>assets/admin/images/<?= $hlimg ?>" title="Vegetarian"/>
                                                                        <?php endif; ?>

                                                                        <?php if (isset($imgvem)): ?>
                                                                            <img src="<?php echo $this->config->item('api_host') ?>assets/admin/images/<?= $imgvem ?>" title="Vegetarian"/>
                                                                        <?php endif; ?>
                                                                        <?php if (isset($base['base_image']) && $base['base_image']): ?>
                                                                            <a  class="photo cboxElement" rel="gal" href="<?= $this->config->item('api_host') ?>assets/uploads/menu_item/base/<?= $base ['base_image'] ?>">
                                                                                <img src="<?php echo $this->config->item('api_host') ?>assets/admin/images/photo.png" border="0" title="Photo"  width="16" height="16" />
                                                                            </a>
                            <?php endif; ?>
                                                                    </span>
                                                                    <?php else: ?>
                                                                    <?php
                                                                    $basePrice = $base ['BasePrice'];
                                                                    $basePriceForSecondaryItem = $basePrice;
                                                                    if ($selectionexist) {
                                                                        $basePrice = 0;
                                                                        $basediscount = 0;
                                                                    }
                                                                    if ($selections [$category ['CatId']] [$base ['BaseId']] != NULl) {
                                                                        $primarySelectionExist = 1;
                                                                        foreach ($selections as $sel) {
                                                                            if (empty($sel)) {
                                                                                continue;
                                                                            }
                                                                            if (isset($sel [$base ['BaseId']])) {
                                                                                foreach ($sel [$bas ['BaseId']] as $selection) {
                                                                                    if ($selection ['Show']) {
                                                                                        $primarySelectionExist = 0;
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        if ($primarySelectionExist) {
                                                                            $basePrice = $basePriceForSecondaryItem;
                                                                            $basediscount = $discountForSecondaryItem;
                                                                        }
                                                                    }
                                                                    $item_no = $base ['ItemNo'] ? $base ['ItemNo'] . ".  " : "  ";
                                                                    ?>
                                                                    <span class="itemname"> <?= $item_no ?><?= html_entity_decode($base ['BaseName'], ENT_QUOTES) ?>
                                                                    <?php if (isset($imgveg)): ?>
                                                                            <img src="<?php echo $this->config->item('api_host') ?>assets/admin/images/<?= $imgveg ?>" title="Vegetarian"/>
                                                                        <?php endif; ?>
                                                                        <?php if (isset($hlimg)): ?>
                                                                            <img src="<?php echo $this->config->item('api_host') ?>assets/admin/images/<?= $hlimg ?>" title="Vegetarian"/>
                                                                        <?php endif; ?>

                                                                        <?php if (isset($imgvem)): ?>
                                                                            <img src="<?php echo $this->config->item('api_host') ?>assets/admin/images/<?= $imgvem ?>" title="Vegetarian"/>
                                                                        <?php endif; ?>
                                                                        <?php if (isset($base['base_image']) && $base['base_image']): ?>
                                                                            <a  class="photo cboxElement" rel="gal" href="<?= $this->config->item('api_host') ?>assets/uploads/menu_item/base/<?= $base ['base_image'] ?>">
                                                                                <img src="<?php echo $this->config->item('api_host') ?>assets/admin/images/photo.png" border="0" title="Photo"  width="16" height="16" />
                                                                            </a>
                            <?php endif; ?>
                                                                    </span>
                                                                    <?php endif; ?>
                                                            <?php else: ?>
                                                                <span class="itemname">   <?= $item_no ?><?= html_entity_decode($base ['BaseName'], ENT_QUOTES) ?>
                                                                <?php if (isset($imgveg)): ?>
                                                                        <img src="<?php echo $this->config->item('api_host') ?>assets/admin/images/<?= $imgveg ?>" title="Vegetarian"/>
                                                                    <?php endif; ?>
                                                                    <?php if (isset($hlimg)): ?>
                                                                        <img src="<?php echo $this->config->item('api_host') ?>assets/admin/images/<?= $hlimg ?>" title="Vegetarian"/>
                                                                    <?php endif; ?>

                                                                    <?php if (isset($imgvem)): ?>
                                                                        <img src="<?php echo $this->config->item('api_host') ?>assets/admin/images/<?= $imgvem ?>" title="Vegetarian"/>
                                                                    <?php endif; ?>
                                                                    <?php if (isset($base['base_image']) && $base['base_image']): ?>
                                                                        <a  class="photo cboxElement" rel="gal" href="<?= $this->config->item('api_host') ?>assets/uploads/menu_item/base/<?= $base ['base_image'] ?>">
                                                                            <img src="<?php echo $this->config->item('api_host') ?>assets/admin/images/photo.png" border="0" title="Photo"  width="16" height="16" />
                                                                        </a>
                        <?php endif; ?>
                                                                </span>
                                                                <?php endif; ?>
                                                            <?php if ($selections [$category ['CatId']] [$base ['BaseId']] != NULl): ?>
                                                                <?php
                                                                $primarySelectionExist = 1;
                                                                foreach ($selections as $sel) {
                                                                    if (empty($sel)) {
                                                                        continue;
                                                                    }
                                                                    if (isset($sel [$base['BaseId']])) {
                                                                        foreach ($sel [$base ['BaseId']] as $selection) {
                                                                            if ($selection ['Show']) {
                                                                                $primarySelectionExist = 0;
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                                <?php if ($primarySelectionExist): ?>
                                                                    <?php if ($basePriceForSecondaryItem != $discountForSecondaryItem): ?>
                                                                        <span class="itemprice">
                                                                            <span style="text-decoration:line-through;"><?php echo to_currency($basePriceForSecondaryItem) ?></span><br/>
                                <?php echo to_currency($discountForSecondaryItem) ?>
                                                                        </span>
                                                                        <?php else: ?>
                                                                        <span class="itemprice"><?php echo to_currency($discountForSecondaryItem); ?></span>
                                                                    <?php endif; ?>
                                                                    <span class="itembasket"><a class="btn-lg" data-toggle="modal" data-target="#myModal" href=""><img title="" alt="" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>inactive-plus.png"></a> </span>
                                                                <?php endif; ?>
                                                                <?php if ($base ['BaseDesc']): ?>
                                                                    <span class="itemdescription"id="des<?= $base['BaseId'] ?>"><?= html_entity_decode($base ['BaseDesc'], ENT_QUOTES) ?></span>
                                                                <?php endif; ?>
                                                            <?php endif; ?>   
                                                            <?php if ($selections [$category ['CatId']] [$base ['BaseId']] != NULl): ?>
                                                                <?php if (isset($sel [$base ['BaseId']])): ?>
                                                                    <?php foreach ($sel [$base['BaseId']] as $selection): ?>
                                                                        <?php
                                                                        if (empty($selection)) {
                                                                            continue;
                                                                        }
                                                                        ?>
                                                                        <?php if ($selection ['Show']): ?>
                                                                            <?php
                                                                            if ($selection ['SelectionDesc'] != '') {
                                                                                $desc = $selection['SelectionDesc'];
                                                                            } else {
                                                                                $desc = str_replace(',', '|', $base ['BaseDesc']);
                                                                            }
                                                                            // echo $base->BaseDiscount.'dis'; //discount code
                                                                            if ($base ['BaseDiscount'] > 0) {
                                                                                $seldiscount = ($selection ['SelectionPrice']) - ($selection['SelectionPrice']) * $base ['BaseDiscount'];
                                                                            } else {
                                                                                $seldiscount = ($selection ['SelectionPrice']) - ($selection['SelectionPrice']) * $category ['CatDiscount'];
                                                                            }
                                                                            if ($seldiscount != $selection ['SelectionPrice']) {
                                                                                $beforediscout = $selection ['SelectionPrice'];
                                                                                $printdiscout = $seldiscount;
                                                                            } else {
                                                                                $beforediscout = 0;
                                                                                $printdiscout = $selection['SelectionPrice'];
                                                                            }
                                                                            // end discount code
                                                                            $baseselprice = $selection['SelectionPrice'];
                                                                            ?>
                                                                            <div class="full-width-container">
                                                                            <?php if (($restaurant_status == 1) && (count($order_policy) >= 1) && $pre_hide_status == 0) : ?>
                                                                                    <span class="itemname"> 
                                                                                        <span class="itemdescription">
                                                                                            &#8658;&nbsp;&nbsp;<a href="#" class="black"><?= html_entity_decode($selection ['DetailsName'], ENT_QUOTES) ?></a>
                                                                                        </span>
                                                                                    </span>
                                    <?php else : ?>
                                                                                    <span class="itemname">
                                                                                        <span class="itemdescription">
                                                                                            &#8658;&nbsp;&nbsp;<a href="#" class="black"><?= html_entity_decode($selection ['DetailsName'], ENT_QUOTES) ?></a>
                                                                                        </span>
                                                                                    </span>
                                    <?php endif; ?>    

                                                                                <?php if ($beforediscout != 0) : ?>
                                                                                    <span class="itemprice">
                                                                                        <span style="text-decoration:line-through;"><?= to_currency($beforediscout) ?></span><br/>
                                        <?= to_currency($printdiscout) ?></span>
                                                                                    <?php else : ?>
                                                                                    <span class="itemprice"><?= to_currency($printdiscout) ?></span>
                                                                                <?php endif; ?>

                                                                                <?php if (($restaurant_status == 1) && (count($order_policy) >= 2 || (count($order_policy) == 1 && $order_policy [0]->PolicyId != 3)) && $pre_hide_status == 0) : ?>
                                                                                    <span class="itembasket"><a onclick='addtocart("",<?= $base ['CatId'] ?>,<?= $base ['BaseId'] ?>, <?= $selection ['SelectionId'] ?>, "<?= $baseselprice ?>&<?= $seldiscount ?>")'  ><img src="<?= $this->config->item('api_host') ?>assets/images/menuplus.png" alt="" title="" /></a></span>
                                                                                <?php else: ?>
                                                                                    <span class="itembasket">
                                                                                        <a  ><img src="<?= base_url() ?>assets/images/menuplus.png" alt="" title="" /></a>
                                                                                    </span>
                                    <?php endif; ?>       
                                                                            </div>
                                                                            <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <?php
                                                                if ($basediscount != $base ['BasePrice']) {
                                                                    $beforediscout = $base ['BasePrice'];
                                                                    $printdiscout = $basediscount;
                                                                } else {
                                                                    $beforediscout = 0;
                                                                    $printdiscout = $base ['BasePrice'];
                                                                }
                                                                ?>
                                                                <?php if ($beforediscout != 0): ?>
                                                                    <span class="itemprice">
                                                                        <span style="text-decoration:line-through;"><?= to_currency($beforediscout) ?></span><br/>
                            <?= to_currency($printdiscout) ?></span>
                                                                    <?php else: ?>
                                                                    <span class="itemprice"><?= to_currency($printdiscout) ?></span>
                                                                <?php endif; ?>

                                                                <?php if ($base['IsSpecial'] == 1): ?>
                                                                    <?php if (($restaurant_status == 1) && (count($order_policy) >= 2 || (count($order_policy) == 1 && $order_policy [0]['PolicyId'] != 3)) && $pre_hide_status == 0): ?>
                                                                        <span class="itembasket"><a onclick='addspecialtocart("",<?= $base ['CatId'] ?>,<?= $base ['BaseId'] ?>, 0, "<?= $base['BasePrice'] ?>&<?= $basediscount ?>")'  ><img src="<?= $this->config->item('api_host') ?>assets/images/menuplus.png" alt="" title="" /></a></span>
                                                                    <?php else: ?>
                                                                        <span class="itembasket"><a  ><img src="<?= $this->config->item('api_host') ?>assets/images/menuplus.png" alt="" title="" /></a></span>
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                    <?php if (($restaurant_status == 1) && (count($order_policy) >= 2 || (count($order_policy) == 1 && $order_policy [0]['PolicyId'] != 3)) && $pre_hide_status == 0): ?>
                                                                        <span class="itembasket"><a onclick='addtocart("",<?= $base ['CatId'] ?>,<?= $base['BaseId'] ?>, 0, "<?= $base ['BasePrice'] ?>&<?= $basediscount ?>")'  ><img src="<?= $this->config->item('api_host') ?>assets/images/menuplus.png" alt="" title="" /></a></span>
                                                                    <?php else: ?>
                                                                        <span class="itembasket"><a  ><img src="<?= $this->config->item('api_host') ?>assets/images/menuplus.png" alt="" title="" /></a></span>        
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                                <span class="itemdescription"><?php isset($base->BaseDesc) ? print html_entity_decode($base->BaseDesc, ENT_QUOTES) : print '' ?></span>
                                                            <?php endif; ?>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!--------------------- End Product one --------------------->
                <?php endforeach; ?>   
                                    <?php endif; ?> 
                                <?php endif; ?>    
                            </div>
                            <?php endforeach; ?>
                    <?php else: ?>
                        <?php echo $this->lang->line('items_no_items_to_display') ?>
                    <?php endif; ?>

                </div>
            </div>

            <div class="col-md-3 yourorderbg">
                <div style="position: relative; min-height: 0px;" id="scolling-content-cart" class="content-cartspan">
                    <div class="mycart theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; top: 0px;">
                        <div class="cartheading">
                            <div class="cartheading_text">YOUR ORDER</div>
                            <!--<h2><a href="javascript:void(0);" onclick="cancelcart();">Empty</a></h2>-->
                        </div>
                        <div class="cartdelpick">
                            <ul>
                                <li>
                                    <span class="delpick">
                                        <input type="radio" onclick="" id="delivery_type" checked="" value="2" name="deliverytype">Delivery<a class="edit-icon" title="Change Area" onclick="changePostcode(2, & quot; 15 & quot; , 0)" href="javascript:void(0)"></a>

                                        <input type="radio" onclick="" id="collection_type" value="1" name="deliverytype">Pick Up
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="cartscroll" style="overflow: hidden; padding: 0px; width: 270px;">
                            <div class="jspContainer" style="width: 269px; height: 0px;"><div class="jspPane" style="padding: 0px; top: 0px; left: 0px; width: 269px;"></div></div>
                        </div>
                        <div class="calculation">
                            <div class="caltext1">Sub Total</div>
                            <div class="caltext2">£0.00</div>
                        </div>
                        <div class="calculation2">
                            <div class="caltext3">Discount : </div>
                            <div class="caltext4">£0.00</div>
                        </div>
                        <div class="calculation2">
                            <div class="caltext3">Delivery Fee : </div>
                            <div class="caltext4">£0.00</div>
                        </div>

                        <div class="calculation2">
                            <div class="caltext3">TAX : </div>
                            <div class="caltext4">£0.00</div>
                        </div>
                        <div class="calculation">
                            <div class="caltext1">Total : </div>
                            <div class="caltext2">£0.00</div>
                        </div>
                        <div><a href="checkout.html"><input type="submit" value="Checkout" class="checkoutbg"></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------ADD TO CART POPUP MODAL------------------------------->