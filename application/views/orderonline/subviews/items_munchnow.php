<div class="showmenu">
    <?php foreach ($categories as $category) : ?>
        <div class="menuheading">
            <a href="javascript:void(0);" class="restaurant-menu-name" id="<?= $category->CatName ?>"><?= $category->CatName ?></a>
        </div>
        <div class="menuheading-img">
            <?php if (isset($category->cat_image) && $category->cat_image && file_exists('./assets/uploads/menu_item/category/' . $category->cat_image)): ?>
                <img src="<?= base_url() ?>assets/uploads/menu_item/category/<?= $category->cat_image ?>" alt="" title="<?= $category->CatName ?>" />
            <?php endif; ?>
        </div>
        <?php if ($category->Special == 0) : ?>
                <?php if ($bases[$category->CatId] != NULL) : ?>
                    <?php
                    $count = 1;
                    $ij = 0;
                    $base_count = sizeof($bases [$category->CatId]);
                    $bcount = 0;
                    foreach ($bases [$category->CatId] as $base):
                    $showonmenu = 1;
                    $selectionexist = 0;
                    $bcount ++;
                    $liClass = ($base_count == $bcount) ? "class='nobg'" : "";
                    foreach ($selections [$category->CatId] [$base->BaseId] as $selonmenu)
                    {
                        if ($selonmenu->Show)
                        {
                            $showonmenu = 0;
                        }
                        $selectionexist = 1;
                    }
                    if ($base->IsSpecial == 1)
                    {
                        $this->db->select('BaseId');
                        $this->db->where('BaseId', $base->BaseId);
                        $query = $this->db->get('special_criteria');
                        $result = $query->row();
                        if (empty($result))
                        {
                            continue;
                        }
                    }
                    $hlimg = NULL;
                    $imgveg = NULL;
                    $imgvem = NULL;
                    if (isset($base->Hotlevel))
                    {
                        $hl = str_split($base->Hotlevel);
                        if (sizeof($hl) == 1)
                        {
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
                        elseif (sizeof($hl) == 2 && is_numeric($hl [0]))
                        {
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
                        } else if (sizeof($hl) == 2 && !is_numeric($hl [0]))
                        {
                            $imgveg = 'vagiterian.png';
                            $imgvem = 'nuts.png';
                        }
                        else if (sizeof($hl) == 3 && is_numeric($hl [0]))
                        {
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
                    if ($base->BaseDiscount > 0)
                    {
                        $basediscount = number_format(($base->BasePrice - ($base->BasePrice * $base->BaseDiscount)), 2, '.', '');
                    }
                    else
                    {
                        $basediscount = number_format(($base->BasePrice - ($base->BasePrice * $category->CatDiscount)), 2, '.', '');
                    }
                    // end discount code
                    $discountForSecondaryItem = $basediscount;
                    $item_no = $base->ItemNo ? $base->ItemNo . ".  " : "  ";
                    ?>
                    <div class="restaurant-<?= $bcount % 2 ? "odd" : "even" ?>">
                        <ul>
                            <li>
                                <?php
                                if ($showonmenu)
                                {
                                    if ($base->IsSpecial == 1)
                                    {
                                        ?>				
                                        <span class="itemname" onclick='addspecialtocart("",<?= $base->CatId ?>,<?= $base->BaseId ?>, 0, "<?= $base->BasePrice ?>&<?= $basediscount ?>")'>					<?= $item_no ?><?= html_entity_decode($base->BaseName, ENT_QUOTES) ?>
                                            <?php if (isset($imgveg)): ?>
                                                <img src="<?= base_url() ?>assets/admin/images/<?= $imgveg ?>" title="Vegetarian"/>
                                            <?php endif; ?>
                                            <?php if (isset($hlimg)): ?>
                                                <img src="<?= base_url() ?>assets/admin/images/<?= $hlimg ?>" title="Vegetarian"/>
                                            <?php endif; ?>

                                            <?php if (isset($imgvem)): ?>
                                                <img src="<?= base_url() ?>assets/admin/images/<?= $imgvem ?>" title="Vegetarian"/>
                                            <?php endif; ?>
                                            <?php if (isset($base->base_image) && $base->base_image && file_exists('./assets/uploads/menu_item/base/' . $base->base_image)): ?>
                                                <a  class="photo cboxElement" rel="gal" href="<?= base_url() ?>assets/uploads/menu_item/base/<?= $base->base_image ?>">
                                                    <img src="<?= base_url() ?>assets/admin/images/photo.png" border="0" title="Photo"  width="16" height="16" />
                                                </a>
                                            <?php endif; ?>
                                        </span>
                                        <?php
                                    }
                                    else
                                    {
                                        $basePrice = $base->BasePrice;
                                        $basePriceForSecondaryItem = $basePrice;
                                        if ($selectionexist)
                                        {
                                            $basePrice = 0;
                                            $basediscount = 0;
                                        }
                                        if ($selections [$category->CatId] [$base->BaseId] != NULl)
                                        {
                                            $primarySelectionExist = 1;
                                            foreach ($selections as $sel)
                                            {
                                                if (isset($sel [$base->BaseId]))
                                                {
                                                    foreach ($sel [$base->BaseId] as $selection)
                                                    {
                                                        if ($selection->Show)
                                                        {
                                                            $primarySelectionExist = 0;
                                                        }
                                                    }
                                                }
                                            }
                                            if ($primarySelectionExist)
                                            {
                                                $basePrice = $basePriceForSecondaryItem;
                                                $basediscount = $discountForSecondaryItem;
                                            }
                                        }
                                        $item_no = $base->ItemNo ? $base->ItemNo . ".  " : "  ";
                                        ?>
                                        <span class="itemname"><?= $item_no ?><?= html_entity_decode($base->BaseName, ENT_QUOTES) ?>
                                            <?php if (isset($imgveg)): ?>
                                                <img src="<?= base_url() ?>assets/admin/images/<?= $imgveg ?>" title="Vegetarian"/>
                                            <?php endif; ?>

                                            <?php if (isset($hlimg)): ?>
                                                <img src="<?= base_url() ?>assets/admin/images/<?= $hlimg ?>" title="Vegetarian"/>
                                            <?php endif; ?>

                                            <?php if (isset($imgvem)): ?>
                                                <img src="<?= base_url() ?>assets/admin/images/<?= $imgvem ?>" title="Vegetarian"/>
                                            <?php endif; ?>
                                            <?php if (isset($base->base_image) && $base->base_image && file_exists('./assets/uploads/menu_item/base/' . $base->base_image)): ?>
                                                <a  class="photo cboxElement" rel="gal" href="<?= base_url() ?>assets/uploads/menu_item/base/<?= $base->base_image ?>">
                                                    <img src="<?= base_url() ?>assets/admin/images/photo.png" border="0" title="Photo"  width="16" height="16" />
                                                </a>
                                            <?php endif; ?>
                                        </span>
                                        <?php
                                        //problem
                                    }
                                }
                                else
                                {
                                    ?>		 
                                    <span class="itemname">
                                        <?= $item_no ?><?= html_entity_decode($base->BaseName, ENT_QUOTES) ?>
                                        <?php if (isset($imgveg)): ?>
                                            <img src="<?= base_url() ?>assets/admin/images/<?= $imgveg ?>" title="Vegetarian"/>
                                        <?php endif; ?>

                                        <?php if (isset($hlimg)): ?>
                                            <img src="<?= base_url() ?>assets/admin/images/<?= $hlimg ?>" title="Vegetarian"/>
                                        <?php endif; ?>

                                        <?php if (isset($imgvem)): ?>
                                            <img src="<?= base_url() ?>assets/admin/images/<?= $imgvem ?>" title="Vegetarian"/>
                                        <?php endif; ?>
                                        <?php if (isset($base->base_image) && $base->base_image && file_exists('./assets/uploads/menu_item/base/' . $base->base_image)): ?>
                                            <a  class="photo cboxElement" rel="gal" href="<?= base_url() ?>assets/uploads/menu_item/base/<?= $base->base_image ?>">
                                                <img src="<?= base_url() ?>assets/admin/images/photo.png" border="0" title="Photo"  width="16" height="16" />
                                            </a>
                                        <?php endif; ?>
                                    </span>

                                <?php } ?>

                                <?php
                                if (isset($menus ['selection_attributes']))
                                {
                                    $selection_attributes = $menus ['selection_attributes'];
                                }
                                if ($selections [$category->CatId] [$base->BaseId] != NULl)
                                {
                                    $primarySelectionExist = 1;
                                    foreach ($selections as $sel)
                                    {
                                        if (isset($sel [$base->BaseId]))
                                        {
                                            foreach ($sel [$base->BaseId] as $selection)
                                            {
                                                if ($selection->Show)
                                                {
                                                    $primarySelectionExist = 0;
                                                }
                                            }
                                        }
                                    }
                                    if ($primarySelectionExist)
                                    {
                                        if ($base->BaseDesc)
                                        {
                                            // Base Description goes here
                                        }
                                        if ($basePriceForSecondaryItem != $discountForSecondaryItem)
                                        {
                                            ?>
                                            <span class="itemprice">
                                                <span style="text-decoration:line-through;">
                                                    <?= CURRENCY . "" . number_format($basePriceForSecondaryItem, 2, '.', '') ?>
                                                </span><br/>
                                                <?= CURRENCY . "" . number_format($discountForSecondaryItem, 2, '.', '') ?>
                                            </span>

                                            <?php
                                        }
                                        else
                                        {
                                            if ($discountForSecondaryItem > 0)
                                            {
                                                ?>
                                                <span class="itemprice"><?= CURRENCY . number_format($discountForSecondaryItem, 2, '.', ''); ?></span>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <?php
                                        if (($restaurant_status == 1) && (count($order_policy) >= 2 ||
                                                (count($order_policy) == 1 && $order_policy [0]->PolicyId != 3)) && $pre_hide_status == 0)
                                        {
                                            ?>
                                            <span class="itembasket"><a onclick='addtocart("",<?= $base->CatId ?>,<?= $base->BaseId ?>, 0, "<?= $basePriceForSecondaryItem ?>&<?= $discountForSecondaryItem ?>")'  ><img src="<?= base_url() ?>assets/images/menuplus.png" alt="" title="" /></a></span>

                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <span class="itembasket">
                                                <a  ><img src="<?= base_url() ?>assets/images/menuplus.png" alt="" title="" /></a>
                                            </span>
                                            <?php
                                        }
                                    }
                                    if ($base->BaseDesc)
                                    {
                                        ?>
                                        <span class="itemdescription" id="des<?= $base->BaseId ?>"> <?= html_entity_decode($base->BaseDesc, ENT_QUOTES) ?> </span>
                                        <?php
                                    }
                                }
                                ?>
                                <?php
                                if ($selections [$category->CatId] [$base->BaseId] != NULl)
                                {
                                    foreach ($selections as $sel)
                                    {
                                        if (isset($sel [$base->BaseId]))
                                            foreach ($sel [$base->BaseId] as $selection)
                                            {
                                                if ($selection->Show)
                                                {
                                                    if ($selection->SelectionDesc != '')
                                                    {
                                                        $desc = $selection->SelectionDesc;
                                                    }
                                                    else
                                                    {
                                                        $desc = str_replace(',', '|', $base->BaseDesc);
                                                    }
                                                    // echo $base->BaseDiscount.'dis'; //discount code
                                                    if ($base->BaseDiscount > 0)
                                                    {
                                                        $seldiscount = ($selection->SelectionPrice) - ($selection->SelectionPrice) * $base->BaseDiscount;
                                                    }
                                                    else
                                                    {
                                                        $seldiscount = ($selection->SelectionPrice) - ($selection->SelectionPrice) * $category->CatDiscount;
                                                    }
                                                    if ($seldiscount != $selection->SelectionPrice)
                                                    {
                                                        $beforediscout = $selection->SelectionPrice;
                                                        $printdiscout = $seldiscount;
                                                    }
                                                    else
                                                    {
                                                        $beforediscout = 0;
                                                        $printdiscout = $selection->SelectionPrice;
                                                    }
                                                    // end discount code
                                                    $baseselprice = $selection->SelectionPrice;
                                                    ?>

                                                    <div class="full-width-container">
                                                        <?php
                                                        if (($restaurant_status == 1) && (count($order_policy) >= 1) && $pre_hide_status == 0)
                                                        {
                                                            ?>
                                                            <span class="itemname"> 
                                                                <span class="itemdescription">
                                                                    &#8658;&nbsp;&nbsp;<a href="#" class="black"><?= html_entity_decode($selection->DetailsName, ENT_QUOTES) ?></a>
                                                                </span>
                                                            </span>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <span class="itemname">
                                                                <span class="itemdescription">
                                                                    &#8658;&nbsp;&nbsp;<a href="#" class="black"><?= html_entity_decode($selection->DetailsName, ENT_QUOTES) ?></a>
                                                                </span>
                                                            </span>
                                                            <?php
                                                        }
                                                        if ($beforediscout != 0)
                                                        {
                                                            ?>
                                                            <span class="itemprice">
                                                                <span style="text-decoration:line-through;"><?= CURRENCY . "" . number_format($beforediscout, 2, '.', '') ?></span><br/>
                                                                <?= CURRENCY . "" . number_format($printdiscout, 2, '.', '') ?></span>


                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <span class="itemprice"><?= CURRENCY . "" . number_format($printdiscout, 2, '.', '') ?></span>

                                                            <?php
                                                        }
                                                        if (($restaurant_status == 1) && (count($order_policy) >= 2 || (count($order_policy) == 1 && $order_policy [0]->PolicyId != 3)) && $pre_hide_status == 0)
                                                        {
                                                            ?>

                                                            <span class="itembasket"><a onclick='addtocart("",<?= $base->CatId ?>,<?= $base->BaseId ?>, <?= $selection->SelectionId ?>, "<?= $baseselprice ?>&<?= $seldiscount ?>")'  ><img src="<?= base_url() ?>assets/images/menuplus.png" alt="" title="" /></a></span>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <span class="itembasket">
                                                                <a  ><img src="<?= base_url() ?>assets/images/menuplus.png" alt="" title="" /></a>
                                                            </span>
                                                        <?php } ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                    }
                                }
                                else
                                {
                                    if ($basediscount != $base->BasePrice)
                                    {
                                        $beforediscout = $base->BasePrice;
                                        $printdiscout = $basediscount;
                                    }
                                    else
                                    {
                                        $beforediscout = 0;
                                        $printdiscout = $base->BasePrice;
                                    }
                                    if ($base->BaseDesc)
                                    {
                                        // Base desc goes here	
                                    }


                                    if ($beforediscout != 0)
                                    {
                                        ?>
                                        <span class="itemprice">
                                            <span style="text-decoration:line-through;"><?= CURRENCY . "" . number_format($beforediscout, 2, '.', '') ?></span><br/>
                                            <?= CURRENCY . "" . number_format($printdiscout, 2, '.', '') ?></span>


                                    <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <span class="itemprice"><?= CURRENCY . "" . number_format($printdiscout, 2, '.', '') ?></span>
                                        <?php
                                    }

                                    if ($base->IsSpecial == 1)
                                    {
                                        if (($restaurant_status == 1) && (count($order_policy) >= 2 || (count($order_policy) == 1 && $order_policy [0]->PolicyId != 3)) && $pre_hide_status == 0)
                                        {
                                            ?>
                                            <span class="itembasket"><a onclick='addspecialtocart("",<?= $base->CatId ?>,<?= $base->BaseId ?>, 0, "<?= $base->BasePrice ?>&<?= $basediscount ?>")'  ><img src="<?= base_url() ?>assets/images/menuplus.png" alt="" title="" /></a></span>

                                        <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <span class="itembasket"><a  ><img src="<?= base_url() ?>assets/images/menuplus.png" alt="" title="" /></a></span>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        if (($restaurant_status == 1) && (count($order_policy) >= 2 || (count($order_policy) == 1 && $order_policy [0]->PolicyId != 3)) && $pre_hide_status == 0)
                                        {
                                            ?>
                                            <span class="itembasket"><a onclick='addtocart("",<?= $base->CatId ?>,<?= $base->BaseId ?>, 0, "<?= $base->BasePrice ?>&<?= $basediscount ?>")'  ><img src="<?= base_url() ?>assets/images/menuplus.png" alt="" title="" /></a></span>
                                        <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <span class="itembasket"><a  ><img src="<?= base_url() ?>assets/images/menuplus.png" alt="" title="" /></a></span> 
                                            <?php
                                        }
                                    }
                                    ?>	
                                    <span class="itemdescription" id="des<?= $base->BaseId ?>"> <?= html_entity_decode($base->BaseDesc, ENT_QUOTES) ?> </span>
                    <?php
                } // expriment
                             $count ++;
                             ?>
                            </li>
                        </ul>
                    </div>
                    <?php $ij++; ?> 
            <?php endforeach; ?>
                    <?php endif; ?>
            <?php endif; ?>
        <div class="full_width_resitem_gap"></div>
<?php endforeach; ?>
</div>