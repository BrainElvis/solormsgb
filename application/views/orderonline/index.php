<?php
$menuData['categories'] = $categories;
$menuData['bases'] = $bases;
$menuData['selections'] = $selections;
$menuData['restaurant_status'] = $restaurant_status;
$menuData['order_policy'] = $order_policy;
$menuData['pre_hide_status'] = $pre_hide_status;
$restaurantInfoData ['info'] = $rest_info;
$restaurantInfoData ['cuisines'] = $cuisines;
$restaurantInfoData ['deliverypolicy'] = $deliverypolicy;
$restaurantInfoData ['deliveryarea'] = $deliveryarea;
$restaurantInfoData ['delarea'] = $delarea;
$restaurantSchedule ['schedule'] = $schedule;
$res_status = 0;
$res_collection = 0;
$res_delivery = 0;
$reservation = 0;
foreach ($policy as $res) {
    if ($res->PolicyId == "1") {
        $res_collection = 1;
    }
    if ($res->PolicyId == "2") {
        $res_delivery = 1;
    }
    if ($res->PolicyId == "3") {
        $res_status = 1;
        $reservation = 1;
    }
}
?>
<style>
    #cboxClose{
        display: none;
    }
</style>
<script>
    jQuery(document).ready(function () {
        jQuery("#cboxCloseAlt").click(function () {
            jQuery.colorbox.close();
            return false;
        });
    });
    function isInteger(s) {
        return Math.ceil(s) == Math.floor(s);
    }
    function addtocart(name, cat, base, selection, price) {
        jQuery("#ajaxLoading").show();
        jQuery("#bselprice").val(price);
        jQuery("#bselname").val(name);
        jQuery("#bcatid").val(cat);
        jQuery("#bselid").val(selection);
        jQuery("#baseid").val(base);
        jQuery('#sptitle').html("");
        jQuery('#modifyowndetails').html("");
        jQuery('#modifyowndetails').html("<a class='btn addtocart-btn' href='javascript:void(0)' name='menusave' id='menusave' onclick='addmenu();' style='float:left;'> ADD TO CART  </a>");
        jQuery('#specialtabledetails').html("");
        jQuery(".add_to_cart_root_link").colorbox({
            inline: true,
            slideshow: false,
            width: "475px",
            scrolling: false,
            height: "auto",
            open: true
        });
        jQuery.post("<?php echo site_url('orderonline/menupopup') ?> ", {
            catid: cat,
            baseid: base,
            selid: selection
        }, function (response) {
            if (response != '') {
                jQuery("#ajaxLoading").hide();
                jQuery('#specialtabledetails').html(response);
                jQuery(".add_to_cart_root_link").colorbox.resize();
                if (jQuery("#selection1").length) {
                    var selattr = '';
                    var alldata = '';
                    var selattr = jQuery("#selection1").html();
                    console.log(selattr);
                    if (selattr != '' && selattr != null) {
                        alldata = selattr.split("++");
                        addtoppingsAttribute(alldata[0], alldata[1], alldata[2], alldata[3]);
                    }
                }

            } else {
                addmenu();
            }
        });
    }

    function addmenu() {
        jQuery("#ajaxLoading").show();
        var quantity = jQuery("#quantityItem").val();
        var comments = jQuery("#comments").val();
        if ((quantity == '' || quantity == 0)) {
            alert('Quantity Field Must Not Be Empty');
            return false;
        }
        if (quantity > 50) {
            alert('Quantity Field Must Not Be More Than 50');
            return false;
        }
        if (parseInt(quantity) <= 0) {
            alert('Give Positive Integer Number');
            return false;
        }
        if (isInteger(quantity) == false) {
            alert('Give Positive Integer Number');
            return false;
        }
        var id = Array();
        var attrdata = '';
        var data = Array();
        var selprice = 0;
        var selname = '';
        if (jQuery("input[type='checkbox'][name='attr']").length) {
            alert("input checkbox");
            jQuery.each(jQuery("input[type='checkbox'][name='attr']:checked"), function () {
                var attrid = jQuery(this).val();
                id = attrid.split('@');
                if (id[1] !== undefined) {
                    attrdata = attrdata + "=" + jQuery(this).val();
                }
            });
        }
        if (jQuery("input[type='radio'][id='selection']")) {
            jQuery.each(jQuery("input[type='radio'][id='selection']:checked"), function () {
                var seldata = jQuery(this).val();
                data = seldata.split('@');
                selprice = parseFloat(selprice) + parseFloat(data[2]);
                if (selname != '')
                    selname = selname + '==' + data[0];
                else
                    selname = data[0];
            });
        }

        var seldiscout = jQuery("#bselprice").val();
        var seldiscountarr = seldiscout.split('&');
        var mainprice = parseFloat(selprice) + parseFloat(seldiscountarr[0]);
        if (parseFloat(seldiscountarr[0]) != parseFloat(seldiscountarr[1])) {
            var discount = parseFloat(parseFloat(seldiscountarr[0]) - parseFloat(seldiscountarr[1])) / parseFloat(seldiscountarr[0]);
            selprice = parseFloat(mainprice) + '*' + parseFloat(mainprice - (discount * mainprice));
        } else
            selprice = mainprice + '*' + mainprice;
        selname = jQuery("#bselname").val() + '==' + selname;
        jQuery.post("<?php echo site_url('orderonline/ajaxcall') ?>", {
            comments: comments,
            quantityOfItem: quantity,
            name: selname,
            cat: jQuery("#bcatid").val(),
            base: jQuery("#baseid").val(),
            sel: jQuery("#bselid").val(),
            price: selprice,
            attritemid: attrdata,
            current_res_id: parseInt('<?php echo $this->config->item('api_id'); ?>')
        }, function (response) {
            jQuery("#ajaxLoading").hide();
            jQuery.colorbox.close();
            console.log(response);
            res = response.split('@@');
            jQuery("#generationId").val(res[2]);
            sellist = jQuery("#bselid").val();
            sellist = sellist + selname;
            addToppings();
        });
    }

    function addspecialtocart(name, cat, base, selection, price) {
         jQuery("#ajaxLoading").show();
        jQuery("#bselprice").val(price);
        jQuery("#bselname").val(name);
        jQuery("#bcatid").val(cat);
        jQuery("#bselid").val(selection);
        jQuery("#baseid").val(base);
        jQuery('#sptitle').html('');
        jQuery('#modifyowndetails').html('');
        jQuery('#specialtabledetails').html('');
        jQuery.post("<?php echo site_url('orderonline/specialpopup') ?> ", {spbaseid: base}, function (response) {
            if (response != 0)
            {
                jQuery("#ajaxLoading").hide();
                jQuery('#specialtabledetails').html(response);
                jQuery('#modifyowndetails').html("<a href='javascript:void(0)' name='specialsave' style='float:right;' class='btn addtocart-btn' id='specialsave' onclick='addspecial(0);'>ADD TO CART</a>");
                if (jQuery('#smallpage').val() == '1') {
                    jQuery(
                            ".add_to_cart_root_link").colorbox(
                            {inline: true, width: "450px", height: "auto", open: true});
                } else {
                    jQuery(".add_to_cart_root_link").colorbox({inline: true, width: "450px", height: "auto", open: true});
                    jQuery(".ui-dialog-titlebar").hide();
                }
            } else {
                addspecial(0);
            }
        });
    }
    function addspecial(id) {
        jQuery("#ajaxLoading").show();
        var quantity = jQuery("#quantityItem").val();
        var comments = jQuery("#comments").val();
        jQuery("#addquantity").val(quantity);
        if ((quantity == '' || quantity == 0)) {
            alert('Quantity Field Must Not Be Empty');
            return false;
        }
        if (parseInt(quantity) <= 0) {
            alert('Give Positive Integer Number');
            return false;
        }
        if (isInteger(quantity) == false) {
            alert('Give Positive Integer Number')
            return false;
        }
        if (quantity > 50) {
            alert('Quantity Field Must Not Be More Than 50');
            hide_global_loader();
            return false;
        }
        var spprice1 = jQuery('#spprice').val();
        var mandatory = jQuery('#spmandatory').val();
        var current_res_id = jQuery("#aciverestid").val();
        var data = '';
        var checkexists = 0;
        var checkman = Array();
        var totalcombo = jQuery('#combocount').val();
        var count = 1;
        for (i = 0; i < totalcombo; i++) {
            if (jQuery('#offer' + i).val() != '') {
                data = data + "==" + jQuery('#offer' + i).val();
            } else {
                count = 0;
            }
        }
        var spcatid = jQuery("#baseid").val();
        if (count) {
            jQuery("#food2usloader").slideDown();
            var seldiscout = jQuery("#bselprice").val();
            var seldiscountarr = seldiscout.split('&');
            var selprice = parseFloat(seldiscountarr[0]) + '*' + parseFloat(seldiscountarr[1]);
            ////////////////////////////////////////////////////////////////////////////////////////
            var toppings = '';
            jQuery.each(jQuery(".toppings"), function () {
                if (jQuery(this).is(':checked')) {
                    if (jQuery(this).hasClass("default")) {
                        if (!jQuery(this).hasClass("locked")) {
                            if (!jQuery(this).hasClass("unlocked")) {
                                toppings = toppings + jQuery(this).val() + '++';
                                // addsSingleAtrributes(jQuery(this).val());
                            }
                        }
                    } else {
                        // addsSingleAtrributes(jQuery(this).val());
                        toppings = toppings + jQuery(this).val() + '++';
                    }
                } else {
                    if (jQuery(this).hasClass("default")) {
                        if (jQuery(this).hasClass("unlocked")) {
                            //addsSingleAtrributes(jQuery(this).val());
                            toppings = toppings + jQuery(this).val() + '++';
                        }
                    }
                }
            })
            var genid = jQuery('#generationId').val();
            jQuery.post("<?php echo site_url('orderonline/ajaxcall') ?>", {
                comments: comments,
                spbase: spcatid,
                items: data,
                quantity: quantity,
                toppings: toppings,
                price: selprice,
                quantity: quantity,
                        current_res_id: parseInt('<?php echo $this->config->item('api_id'); ?>')
            }, function (response) {
                jQuery("#ajaxLoading").hide();
                jQuery.colorbox.close();
                res = response.split('@@');
                // jQuery("#points").html("<?php echo $this->lang->line('points_show'); ?>" + res[3]);
                jQuery("#genId").val(res[2]);
                jQuery("#generationId").val(res[2]);
                showcart('1');
                //scrolling_cart();
            });
        } else {
            alert("Please choose items from every list");
        }
    }
    function getSpecialattr(number, baseid) {
        jQuery("#ajaxLoading").show();
        var attrPrice = parseFloat(jQuery("#spCatAttrPrice" + number).val());
        var price_span = jQuery(
                '#price_span').html().split(
                "<?= $this->config->item('currency_symbol') ?>");
        var price_span = parseFloat(
                price_span[1]);
        price_span = price_span - attrPrice;
        //jQuery("#price_span" ).html("<?= $this->config->item('currency_symbol'); ?>"+price_span.toFixed(2));
        jQuery("#spCatAttrPrice" + number).val("0");
        var spcat = jQuery('select[id=offer' + number + ']').val();
        if (spcat != '') {
            jQuery.post("<?= site_url('orderonline/getdefForSpecial') ?> ", {spbase: spcat, base: baseid, serial_number: number}, function (response) {
                if (response != 0) {
                     jQuery("#ajaxLoading").hide();
                    jQuery("#toppingsatt" + number).html(response);
                } else {
                     jQuery("#ajaxLoading").hide();
                    jQuery("#toppingsatt" + number).html('');
                }
            });
        } else {
            jQuery("#toppingsatt" + number).html('');
        }
    }

    function addtoppingsAttribute(catId, baseId, selId, selprice) {
        var basePrice = jQuery('#base_price_hidden').val();
        //alert(basePrice);
        var newPrice = parseFloat(basePrice) + parseFloat(selprice);
        jQuery('#selected_sel_price').val(selprice);
        var price1 = parseFloat(newPrice);
        /*jQuery('#price_span').html("<?= $this->config->item('currency_symbol'); ?>"+price1.toFixed(2));*/
        jQuery.post("<?= site_url('orderonline/attrfortopping') ?> ", {
            catId: catId,
            baseId: baseId,
            selId: selId
        }, function (response) {
            jQuery("#addtop").html(response);
        });
    }
    function addToppings() {
        var AttribuesList = "";
        if (jQuery(".categoryWithAttribuesInfo").length) {
            jQuery.each(jQuery(".categoryWithAttribuesInfo"), function () {
                catInfo = jQuery(this).val();
                catInfo = catInfo.split("_");
                AttribuesList = AttribuesList + "," + catInfo[4];
                if (AttribuesList == "") {
                    showcart(1);
                } else {
                    addsSingleAtrributes(AttribuesList);
                }
            });
        } else {
            showcart(1);
        }
    }
    function addsSingleAtrributes(id) {
        var genid = jQuery('#generationId').val();
        jQuery("#loader").slideDown();
        jQuery.post("<?php echo site_url('orderonline/addattr') ?>", {
            itemid: id,
            genid: genid
        }, function (responseattr) {
            showcart(1);
        });
    }
    function showcart(status) {
        jQuery("#ajaxLoadingShowcart").show();
        jQuery.post("<?php echo site_url('orderonline/showcart') ?>", {
            status: status,
            showcart: 1
        }, function (response) {
            jQuery("#ajaxLoadingShowcart").show();
            jQuery("#scolling-content-cart").html('');
            res = response.split('@@');
            document.getElementById("scolling-content-cart").innerHTML = res[0];
          
            if (jQuery('#collection_type').is(':checked')) {
                jQuery(".collection_area_info").show();
                jQuery(".delivery_area_info").hide();
            } else {
                jQuery(".collection_area_info").hide();
                jQuery(".delivery_area_info").show();
            }
            scrolling_cart();
        });
    }
    function addtoQueue(catid, id, price) {
        var attrbutesId = "";
        var catInfo = jQuery('#cat' + catid).val();
        catInfo = catInfo.split("_");
        var maxAlert = catInfo[2];
        var freeAlert = catInfo[3];
        if (jQuery('#' + id).is(':checked')) {
            if (!jQuery('#' + id).hasClass("default")) {
                if (maxAlert >= catInfo[0] && catInfo[0] > 0) {
                    alert('me11');
                    alert("Sorry but you have reached your maximum number of choices");
                    jQuery('#' + id).attr('checked', false);
                    return;
                }
                if (freeAlert >= catInfo[1] && catInfo[1] > 0) {
                    //alert("You have reached your free attributes limit. ");
                    alert("Sorry but you have reached your maximum number of free choices");
                    changePriceInPopup(id, price)
                } else if (catInfo[1] == 0) {
                    changePriceInPopup(id, price)
                }
                if (catInfo[4] == "") {
                    var attrarray = jQuery('#' + id).val();
                    var attrarray1 = attrarray.split('*');
                    attrbutesId = attrarray1[0];
                    catInfo[4] = attrbutesId;
                    maxAlert++;
                    freeAlert++;
                    catInfo[2] = maxAlert;
                    catInfo[3] = freeAlert;
                    catInfo = catInfo.join("_");
                    jQuery('#cat' + catid).val(catInfo);
                    //changePriceInPopup(id,price)       
                } else {
                    attr_array = catInfo[4].split(",");
                    aid = jQuery('#' + id).val();
                    aid1 = aid.split('*');
                    var found = 0;
                    for (var i = 0; i < attr_array.length; i++) {
                        if (attr_array[i] === aid1[0]) {
                            found = 1;
                        }
                    }
                    if (found == 0) {
                        var attrarray = jQuery('#' + id).val();
                        var attrarray1 = attrarray.split('*');
                        attrbutesId = catInfo[4] + ',' + attrarray1[0];
                        catInfo[4] = attrbutesId;
                        maxAlert++;
                        freeAlert++;
                        catInfo[2] = maxAlert;
                        catInfo[3] = freeAlert;
                        catInfo = catInfo.join("_");
                        jQuery('#cat' + catid).val(catInfo);
                    }
                }
            } else {
                if (catInfo[4] != "") {
                    attr_array = catInfo[4].split(",");
                    aid = jQuery('#' + id).val();
                    aid1 = aid.split('*');
                    var found = 0;
                    for (var i = 0; i < attr_array.length; i++) {
                        if (attr_array[i] === aid1[0]) {
                            found = 1;
                            attr_array.splice(i, 1);
                        }
                    }
                    attr_array = attr_array.join(",");
                    catInfo[2] = maxAlert;
                    catInfo[3] = freeAlert;
                    catInfo[4] = attr_array;
                    catInfo = catInfo.join("_");
                    jQuery('#cat' + catid).val(catInfo);
                }
            }
        } else {
            if (!jQuery('#' + id).hasClass("default")) {
                if (catInfo[4] != "") {
                    attr_array = catInfo[4].split(",");
                    attr_array1 = catInfo[4].split(",");
                    aid = jQuery('#' + id).val();
                    aid1 = aid.split('*');
                    if (catInfo[3] > catInfo[1]) {
                        //free count has crossed
                        var found1 = 0;
                        for (var j = catInfo[1]; j < attr_array1.length; j++) {
                            if (attr_array1[j] === aid1[0]) {
                                found1 = 1;
                            }
                        }
                        //alert('found:'+found1);
                        if (found1 != 0) {
                            changePriceInPopup(id, price)
                        } else if (found1 == 0) {
                            //recalculate price
                            var selsection = jQuery('#selection1').html();
                            if (selsection) {
                                var selhtml = selsection.split('++');
                                var selprice = parseFloat(jQuery('#selected_sel_price').val());
                                var price1 = parseFloat(jQuery('#base_price_hidden').val());
                                for (var i = 0; i < attr_array1.length; i++) {
                                    if (attr_array1[i] === aid1[0]) {
                                        attr_array1.splice(i, 1);
                                    }
                                }
                                //alert('ch arr: '+attr_array1);
                                for (var i = 0; i < attr_array1.length; i++) {
                                    if (i > catInfo[1]) {
                                        var attrstr = jQuery('#' + attr_array1[i]).val();
                                        var attrarr = attrstr.split('*');
                                        price1 = parseFloat(attrarr[1]) + parseFloat(price1);
                                    }
                                }
                                //alert(price1);
                                price1 = parseFloat(selprice) + parseFloat(price1);
                                //jQuery('#price_span').html("<?= $this->config->item('currency_symbol'); ?>"+price1.toFixed(2));
                            } else {
                                var price1 = parseFloat(jQuery('#base_price_hidden').val());
                                for (var i = 0; i < attr_array1.length; i++) {
                                    if (attr_array1[i] === aid1[0]) {
                                        attr_array1.splice(i, 1);
                                    }
                                }
                                //alert('ch arr: '+attr_array1);
                                for (var i = 0; i < attr_array1.length; i++) {
                                    if (i > catInfo[1]) {
                                        var attrstr = jQuery('#' + attr_array1[i]).val();
                                        var attrarr = attrstr.split('*');
                                        price1 = parseFloat(attrarr[1]) + parseFloat(price1);
                                    }
                                }
                            }
                        }
                    }
                    var found = 0;
                    for (var i = 0; i < attr_array.length; i++) {
                        if (attr_array[i] === aid1[0]) {
                            found = 1;
                            attr_array.splice(i, 1);
                        }
                    }
                    attr_array = attr_array.join(",");
                    maxAlert--;
                    freeAlert--;
                    catInfo[2] = maxAlert;
                    catInfo[3] = freeAlert;
                    catInfo[4] = attr_array;
                    catInfo = catInfo.join("_");
                    jQuery('#cat' + catid).val(catInfo);
                    //changePriceInPopup(id,price)    
                }
            } else {
                attr_array = catInfo[4].split(",");
                aid = jQuery('#' + id).val();
                aid1 = aid.split('*');
                var found = 0;
                for (var i = 0; i < attr_array.length; i++) {
                    if (attr_array[i] === aid1[0]) {
                        found = 1;
                    }
                }
                if (found == 0) {
                    var attrarray = jQuery('#' + id).val();
                    var attrarray1 = attrarray.split('*');
                    attrbutesId = catInfo[4] + ',' + attrarray1[0];
                    catInfo[4] = attrbutesId;
                    catInfo[2] = maxAlert;
                    catInfo[3] = freeAlert;
                    catInfo = catInfo.join("_");
                    jQuery('#cat' + catid).val(catInfo);
                }
            }
        }
    }
    function changePriceInPopup(id, price) {
        //var main_price = parseFloat(jQuery('#price_span').html());   
        var main_price = jQuery('#price_span').html().split("<?php echo $this->config->item('currency_symbol') ?>");
        var main_price = parseFloat(main_price[1]);
        if (jQuery('#' + id).is(':checked')) {
            var new_price = main_price + parseFloat(price);
        } else {
            var new_price = main_price - parseFloat(price);
        }
        //alert(new_price);
        var newPrice = parseFloat(new_price);
        //jQuery('#price_span').html("<?php echo $this->config->item('currency_symbol') ?>"+newPrice.toFixed(2));
        return;
    }
    function changemenucard(id, res_id, areaId) {
        if (id == 2 && !areaId) {
            postcodepopup();
            return false;
        }
        if (id == '2') {
            jQuery(".collection_area_info").hide();
            jQuery(".delivery_area_info").show();
            jQuery('#delivery_type').attr('checked', true);
        } else {
            jQuery(".collection_area_info").show();
            jQuery(".delivery_area_info").hide();
            jQuery('#collection_type').attr('checked', true);
        }
        show_loader("cartscroll");
        jQuery.post("<?php echo site_url('orderonline/changedelivery') ?>", {
            deliveryid: id,
            restid: res_id
        }, function (response) {
            showcart(1);
            //jQuery('#modal').trigger('reveal:close');
            jQuery.colorbox.close();
        });
        //jQuery('#modal').trigger('reveal:close');
        jQuery.colorbox.close();
    }
    function postcodepopup()
    {
        jQuery(".entering_postcode_root_link").colorbox({inline: true, width: "660px", open: true});
    }
    function show_loader(divClass)
    {
        jQuery("." + divClass).addClass("spinned");
    }
    function hide_loader(divClass)
    {
        jQuery("." + divClass).removeClass("spinned");
    }
    function continuewithcollection() {
        jQuery.colorbox.close();
        jQuery.post("<?php echo site_url('orderonline/get_continuewith_collection') ?> ", function (response) {
            showcart(1);
        });
    }
    function getDeliveryArea(restid) {
        var enter_postcode = jQuery('#your_postcode').val();
        var enter_area = jQuery('#your_area').val();
        if (enter_postcode == "") {
            alert("Please Give Your Post Code.");
            jQuery('#your_postcode').focus();
            return false;
        }
        if (enter_area == "") {
            alert("Please Select Your Area.");
            jQuery('#your_area').focus();
            return false;
        }

        jQuery('#loaderImage').show();
        jQuery.post("<?php echo site_url('orderonline/get_delivery_area') ?>",
                {
                    enter_area: enter_area,
                    enter_postcode: enter_postcode,
                    restid: restid
                },
                function (response) {
                    jQuery('#loaderImage').hide();
                    console.log(response);
                    jQuery('#loader').slideUp();
                    res = response.split('*@*');
                    if (res[0] != "0") {
                        jQuery(
                                '#orderMinAmount').html(res[2]);
                        showcart(1);
                        jQuery.colorbox.close();
                    } else {
                        jQuery('#col').show();
                        jQuery.colorbox.resize();
                    }
                });
    }
    function changePostcode(id, res_id, areaId) {
        if (id == 2 && !areaId) {
            postcodepopup();
            return false;
        }
        jQuery("#loading_full").show();
        if (id == '2') {
            jQuery(".collection_area_info").hide();
            jQuery(".delivery_area_info").show();
            jQuery('#delivery_type').attr('checked', true);
        } else {
            jQuery(".collection_area_info").show();
            jQuery(".delivery_area_info").hide();
            jQuery('#collection_type').attr('checked', true);
        }
        jQuery.post("<?php echo site_url('orderonline/changedelivery') ?>", {
            deliveryid: id,
            restid: res_id
        }, function (response) {
            jQuery("#loading_full").hide();
            jQuery('#loader').slideUp();
            showcart(1);
            jQuery('#loader').slideDown();
            //jQuery('#modal').trigger('reveal:close');
            jQuery.colorbox.close();
        });
        //jQuery('#modal').trigger('reveal:close');
        jQuery.colorbox.close();
    }
    function addone(id, name) {
        jQuery("#" + name).show();
        jQuery.post("orderonline/ajaxcall", {
            itemid: id,
            current_res_id: parseInt('<?php echo $this->config->item('api_id'); ?>')
        }, function (response) {
            jQuery("#" + name).hide();
            res = response.split('@@');
            document.getElementById("scolling-content-cart").innerHTML = res[0];
            if (jQuery('#collection_type').is(':checked')) {
                jQuery(".collection_area_info").show();
                jQuery(".delivery_area_info").hide();
            } else {
                jQuery(".collection_area_info").hide();
                jQuery(".delivery_area_info").show();
            }
            scrolling_cart();
        });
    }
    function scrolling_cart() {
        jQuery('.content-cartspan').theiaStickySidebar({additionalMarginTop: 0});
        var api = jQuery('.cartscroll').jScrollPane({
            stickToBottom: true,
            maintainPosition: true,
            showArrows: false,
            verticalDragMinHeight: 50,
            verticalDragMaxHeight: 50
        }).data('jsp').scrollToBottom();
    }
    function lessone(id, name) {
        jQuery("#" + name).show();
        jQuery.post("<?= site_url('orderonline/lessitem') ?>", {
            itemlessid: id,
            current_res_id: parseInt('<?php echo $this->config->item('api_id'); ?>')
        }, function (response) {
            jQuery("#" + name).hide();
            res = response.split('@@');
            document.getElementById("scolling-content-cart").innerHTML = res[0];
            if (jQuery('#collection_type').is(':checked')) {
                jQuery(".collection_area_info").show();
                jQuery(".delivery_area_info").hide();
            } else {
                jQuery(".collection_area_info").hide();
                jQuery(".delivery_area_info").show();
            }
            scrolling_cart();
        });
    }

    function removeItem(id, name) {
        jQuery("#" + name).show();
        jQuery.post("<?= site_url('orderonline/removeitem') ?>", {
            itemlessid: id,
            current_res_id: parseInt('<?php echo $this->config->item('api_id'); ?>')
        }, function (response) {
            jQuery("#" + name).hide();
            res = response.split('@@');
            document.getElementById("scolling-content-cart").innerHTML = res[0];
            if (jQuery('#collection_type').is(':checked')) {
                jQuery(".collection_area_info").show();
                jQuery(".delivery_area_info").hide();
            } else {
                jQuery(".collection_area_info").hide();
                jQuery(".delivery_area_info").show();
            }
            scrolling_cart();
        });
    }
function removeattr(attrid) {
	jQuery.post("<?php echo site_url('orderonline/lessattribute') ?>", {
	   attr: attrid
	}, function (response) {
	   showcart(1);
	});
    }
</script>

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
<a class='entering_postcode_root_link' href="#postcode_popup_area" style="display:none">Inline HTML</a>
<!--Popup Show-->
<div style="display:none">
    <div id="postcode_popup_area" class="popupouter">
        <div class="popupshow">
            <div class="seperate_div">
                <div class="popup_heading">Your Area</span></div>
                <div class="popup_commontext">Please Select your Area below...</div>
                <div class="popupspan_100">
                    <div class="full-width-container-gap"></div>
                    <div class="popupspan_100">
                        <?php
                        $citiesArray = array();
                        if ($cities) {
                            foreach ($cities AS $obj) {
                                $citiesArray[$obj->CityId] = $obj->CityName;
                            }
                        }
                        ?>
                        <div class="popupspan_100">
                            <select class="choose_zone_home_small popup_input" id="your_area" name="your_area" >
                                <option value="">Choose Zone</option>
                                <?php if (!empty($areas)) : ?>
                                    <?php foreach ($areas AS $obj) : ?>
                                        <option value="<?php echo $obj->AreaId; ?>"><?php echo $citiesArray[$obj->CityId] . ", " . $obj->AreaName; ?></option>
                                    <?php endforeach; ?>
                                <?php endif ?>
                            </select>
                        </div>
                        <div class="popupspan_100">
                            <label>Post Code</label>
                            <input type="text" placeholder="e.g. T9K 0K9" name="your_postcode" id="your_postcode" class="popup_input" onkeyup="jQuery(this).val(jQuery(this).val().toUpperCase());" maxlength="7" />
                        </div>
                    </div>
                </div>

                <div class="full-width-container-gap"></div>
                <div class="popupspan_100">
                    <?php if ($res_collection): ?>
                        <a href="javascript:void(0)" id="col" onclick="continuewithcollection();
                           " class="common-btn">Pick Up</a>
                       <?php endif; ?>
                       <?php if ($res_delivery): ?>
                        <a href="javascript:void(0)" id="sub" onclick="getDeliveryArea(<?php echo $this->config->item('api_id'); ?>)"  class="common-btn">Delivery</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<a class='add_to_cart_root_link' href="#maskspecial-popup" style="display:none">Inline HTML</a>
<div style="display:none">

    <div id="maskspecial-popup" class="popupouter">
        <div class="popupshow">
            <div class="seperate_div">
                <div class="popup_heading"><span>Adding to Cart</span><a class="pull-right btn addtocart-btn" id="cboxCloseAlt" >X</a></div>
                <span  class="loading centered" id="ajaxLoading" style="display:none;"><img src="<?php echo ASSETS_SITE_IMAGE_PATH . 'ajax-loader.gif' ?>" alt="Loading..."/></span>
                <div id="specialtabledetails" class="full-width-container" style="min-height:200px;"></div>
                <input type="hidden" name="bselprice" id="bselprice"  />
                <input type="hidden" name="bselname" id="bselname"  />
                <input type="hidden" name="bselid" id="bselid"  />
                <input type="hidden" name="bcatid" id="bcatid"  />
                <input type="hidden" name="specialcatid" id="specialcatid"  />
                <input type="hidden" name="baseid" id="baseid"  />
                <input type="hidden" name="baseorder" id="baseorder"  />
                <input type="hidden" value="" id="generationId" name="generationId">  
                <div id="modifyowndetails" style="padding-top:0px; " class="pull-right">
                    <a class="btn addtocart-btn" href="javascript:void(0)" name="specialsave"  id="specialsave" onclick="addspecial(0);">  
                        ADD TO CART
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>