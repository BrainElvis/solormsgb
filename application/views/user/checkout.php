<div class="container">
    <div class="row accountbg">
        <div class="col-md-9">
            <div class="commoncontentarea">
                <form onsubmit="return chaeckvalidation()" id="checkout_payment" name="checkout_payment" method="post" action="<?php echo site_url('user/process') ?>">
                    <!--
                    <input value="1" id="dareaok" name="dareaok" type="hidden">
                    <input value="0" id="totalprice" name="totalprice" type="hidden">
                    <input value="0.00" id="hfee" name="hfee" type="hidden">
                    -->
                    <div class="paymentarea">
                        <div class="panmentspan3">
                            <h1 class="delivery_status_type" <?php ($this->session->userdata('deliverytype') == 1) ? print'style="display:none"' : print'style="display:block"' ?>>Delivery Address: 
                                Delivery Address:
                                <span id="address_list_container_orderplace" class="float_right">
                                    <div style="float:left; font-size: 15px">Select Address&nbsp;&nbsp;</div>
                                    <select name="addlabel" id="addlabel" onchange="changeaddress()" class="dropdown" style="background-color:#fff;">   
                                        <?php foreach ($cust_info as $cust_info1) : ?>
                                        <?php endforeach; ?>
                                        <option value="<?= $cust_info1->CustId; ?>" <?php if ($this->session->userdata['CustAddLabel'] == $cust_info1->CustAddLabel) echo "selected"; ?>>
                                            <?php echo "Primary" ?> </option>  
                                        <?php foreach ($cust_address as $addlbl) : ?>
                                            <option value="<?= $addlbl->CustAddId; ?>" <?php if ($this->session->userdata['CustAddLabel'] == $addlbl->CustAddLabel) echo "selected"; ?>> 
                                                <?= $addlbl->CustAddLabel; ?> </option>
                                        <?php endforeach ?>
                                        <option value="addnew">Add new Address</option>
                                    </select>
                                </span>
                            </h1>
                            <?php //debugPrint($cust_info1);?>
                            <h1 class="collection_status_type" <?php ($this->session->userdata('deliverytype') == 2) ? print'style="display:none"' : print'style="display:block"' ?>>Pickup Address:</h1>
                            <!--    For Delivery Segment [ Start ]  -->
                            <div <?php ($this->session->userdata('deliverytype') == 2) ? print'style="display:block"' : print'style="display:none"' ?> class="delivery_status_type" id="customer_buyer">
                                <span>Where would you like your food to be deliverd?</span>
                                <table class="payment-table" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <input value="0" name="as_new_add" id="as_new_add" type="hidden">
                                    <tbody>
                                        <tr style="display: none" class="even">
                                            <td class="bdr-bottom bdr-right" width="40%">First Name :</td>
                                            <td class="bdr-bottom" width="60%">
                                                <input value="<?php isset($cust_info1->CustFirstName) ? print $cust_info1->CustFirstName : print'' ?>" id="cust_fname" name="cust_fname" class="textfield" type="text">
                                            </td>
                                        </tr>
                                        <tr style="display: none" class="odd">
                                            <td class="bdr-bottom bdr-right" width="40%">Last Name :</td>
                                            <td class="bdr-bottom" width="60%">
                                                <input value="<?php isset($cust_info1->CustLastName) ? print $cust_info1->CustLastName : print'' ?>" id="cust_lname" name="cust_lname" class="textfield" type="text">
                                            </td>
                                        </tr>
                                        <tr class="even">
                                            <td class="bdr-bottom bdr-right" width="40%">Address:</td>
                                            <td class="bdr-bottom" width="60%">
                                                <input readonly="readonly" value="<?php isset($cust_info1->CustAdd1) ? print $cust_info1->CustAdd1 : print'' ?>" id="customers_address1" name="customers_address1" class="textfield cl_op_field" type="text">
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td class="bdr-bottom bdr-right" width="40%">Phone Number :</td>
                                            <td class="bdr-bottom" width="60%">
                                                <input readonly="readonly" value="<?php isset($cust_info1->CustMobile) ? print $cust_info1->CustMobile : print'' ?>" id="customers_telephone" name="customers_telephone" class="textfield cl_op_field" type="text">
                                            </td>
                                        </tr>
                                        <tr class="even">
                                            <td class="bdr-bottom bdr-right" width="40%">City :</td>
                                            <?php
                                            $CustTown = $cust_info1->CustTown;
                                            $cities = $this->session->userdata('cities');
                                            ?>

                                            <td width="60%" class="bdr-bottom">
                                                <select  class="dropdown cl_op_field"  id="customers_town" name="customers_town" onchange="area_zone_selector(this.value)" >
                                                    <option value="">Select Area</option>
                                                    <?php foreach ($cities as $obj) : ?>
                                                        <option value="<?php echo $obj->CityId ?>" <?php if ($CustTown == $obj->CityId) { ?> selected="selected" <?php } ?> ><?php echo $obj->CityName ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>

                                        </tr>
                                        <?php
                                        $CustArea = $cust_info1->CustArea;
                                        $CityId = 0;
                                        if ($CustTown > 0) {
                                            $CityId = $CustTown;
                                        }
                                        $areas = array(); //$this->Usermodel->get_list('area_list', array('CityId' => $CityId, 'status' => 1));
                                        if ($this->session->userdata('areas')) {
                                            $areas = $this->session->userdata('areas');
                                        }
                                        $ecity = array();
                                        if (!empty($areas)) {
                                            foreach ($areas as $area) {
                                                if ($area->CityId == $CityId && $area->status == 1) {
                                                    $ecity[] = $area;
                                                }
                                                else {
                                                    continue;
                                                }
                                            }
                                        }
                                        ?>
                                        <tr class="odd">
                                            <td width="40%" class="bdr-bottom bdr-right">Area :</td>
                                            <td width="60%" class="bdr-bottom" name="area_zone_selector_div" id="area_zone_selector_div" >
                                                <select class="dropdown cl_op_field cl_op_field_area"  id="customers_area" name="customers_area" >
                                                    <option value="">Select Area</option>
                                                    <?php foreach ($ecity as $obj) : ?>
                                                        <option value="<?php echo $obj->AreaId ?>" <?php
                                                        if ($CustArea == $obj->AreaId) {
                                                            echo 'selected="selected"';
                                                        }
                                                        ?> ><?php echo $obj->AreaName ?></option>
                                                            <?php endforeach; ?>   
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="even">
                                            <td class="bdr-bottom bdr-right" width="40%">Postcode:</td>
                                            <td class="bdr-bottom" width="60%">
                                                <input readonly="readonly" value="<?php isset($cust_info1->CustPostcode) ? print $cust_info1->CustPostcode : print'' ?>" id="customers_postcode" name="customers_postcode" class="textfield cl_op_field" type="text">
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td class="bdr-bottom bdr-right" width="40%">Address Label :</td>
                                            <td class="bdr-bottom" width="60%">
                                                <input readonly="readonly" value="<?php isset($cust_info1->CustAddLabel) ? print $cust_info1->CustAddLabel : print'' ?>" id="customers_address_label" name="customers_address_label" class="textfield cl_op_field" type="text">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="collection_status_type" id="customer_buyer_recever" <?php ($this->session->userdata('deliverytype') == 2) ? print'style="display:none"' : print'style="display:block"' ?>>
                                <span>You are required to collect this order from restaurant.</span>
                                <table class="payment-table" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                        <tr class="even">
                                            <td class="bdr-bottom bdr-right" width="40%">Restaurant Name :</td>
                                            <td class="bdr-bottom" width="60%">
                                                <input class="textfield" value="<?php echo $this->config->item('company') ?>" readonly="TRUE" type="text">
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td class="bdr-bottom bdr-right" width="40%">Address:</td>
                                            <td class="bdr-bottom" width="60%">
                                                <textarea readonly="readonly" class="additional-textarea" name="rece_lname_new" id="rece_lname_new"><?php echo $this->config->item('address') ?></textarea>
                                            </td>
                                        </tr>
                                        <tr class="even">
                                            <td class="bdr-bottom bdr-right" width="40%">Phone Number:</td>
                                            <td class="bdr-bottom" width="60%">
                                                <input class="textfield" value="<?php echo $this->config->item('phone') ?>" readonly="TRUE" type="text">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--    For Collection Segment [ End ]  -->
                        </div>
                        <div id="deliverytype_timetable" class="panmentspan3">
                            <div class="global_gap"></div>
                            <h1 class="delivery_status_type" <?php ($this->session->userdata('deliverytype') == 2) ? print'style="display:block"' : print'style="display:none"' ?>>When to deliver ? :</h1>
                            <h1 class="collection_status_type" <?php ($this->session->userdata('deliverytype') == 2) ? print'style="display:none"' : print'style="display:block"' ?>>When to Pick Up ? :</h1>
                            <table class="payment-table" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                    <tr class="even">
                                        <td class="bdr-bottom bdr-right" width="40%">Time of Delivery :</td>
                                        <td width="60%" class="bdr-bottom">
      
                                            <?php if ($order_times) : ?>
                                                <span class="lbl_radio_button_checked" onclick="disable_time_ddl();">
                                                    <input name="time_type" type="radio" id="ortime" value="asap"  checked="checked" />&nbsp;&nbsp;Now 
                                                    <input type="hidden" name="ortime" id="ortime" value="asap" />
                                                </span>
                                            <?php endif; ?>

                                            <?php if ($order_times) : ?>
                                                <span class="lbl_radio_button" onclick="enable_time_ddl();" >
                                                    <input type="radio" id="time_type2" name="time_type" value="2" onclick="" />&nbsp;&nbsp;Later
                                                </span> 
                                            <?php else : ?>
                                                <span class="lbl_radio_button_checked" >
                                                    <input type="radio" id="time_type2" name="time_type" checked="checked" value="2" onclick="" />&nbsp;&nbsp;Later
                                                </span>
                                            <?php endif; ?>
                                            <?php if (!$order_times) : ?> 
                                                <div>
                                                    <select class="select" name="orderdate" id="orderdate" onchange="checkfreetimeslot()">
                                                        <option value="" ><?php echo $this->lang->line('pre_order_day'); ?> </option>
                                                        <?php for ($i = 0; $i < 7; $i++) : ?>                                       
                                                            <option value="<?php echo strtolower(date('D', strtotime("+$i day"))) . '_' . $i; ?>" > 
                                                                <?php echo date("d-m-Y", strtotime("$now, +$i day")); ?>
                                                            </option>
                                                        <?php endfor; ?>
                                                    </select>
                                                    <input type="hidden" name="preorder" id="preorder" value="1">

                                                </div>
                                            <?php endif; ?>

                                            <div class="global_gap"></div>
                                            <div  id="scheduletime">
                                                <div id="scheduletime1" <?php if (!$order_times) { ?> style="display:none;" <?php } ?>>
                                                    <?php if ($order_times) : ?>
                                                        <select   disabled="disabled"  class="dropdown"  name="order_time" id="order_time">
                                                            <?php foreach ($order_times as $time) : ?>                           
                                                                <option value="<?php echo $time; ?>"><?php echo ( date('d') == date('d', $time) ) ? date("g:i A", $time) . ' ' . $this->lang->line('today') : date("g:i A", $time) . ' ' . $this->lang->line('nestday'); ?></option>                           
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <?php else : ?>  
                                                        <select  class="dropdown" disabled="disabled" name="order_time" id="order_time">
                                                            <option value="">Select Time</option>                           
                                                        </select>
                                                    <?php endif; ?>              
                                                    <input type="hidden" name="asap" id="asap" value="<?php isset($order_times[0])? print $order_times[0]:print'' ; ?>" />                                  
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="panmentspan3 overflow_auto">
                            <div class="global_gap"></div>
                            <h1>Payment Information :</h1>
                            <table class="payment-table" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                    <?php ///if ($this->config->item('payment_cod') == 'payment_cod'): ?>
                                    <tr class="odd">
                                        <td class="bdr-bottom cod_text" width="100%">
                                            <span id="mod_span_cod">
                                                <input value="cod" id="pmt-cod" name="pay_mathod" type="radio" checked />
                                                <label for="pmt-cod">Cash On Delivery</label>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php //endif; ?>
                                    <?php //if ($this->config->item('payment_online') == 'payment_online'): ?>
                                    <tr class="even">
                                        <td class="bdr-bottom paypal_text" width="100%">
                                            <span id="mod_span_cod">
                                                <input value="online" id="pmt-online" name="pay_mathod" type="radio">
                                                <label for="pmt-online">Online Payment</label>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php //endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="panmentspan1">
                            <div class="global_gap"></div>
                            <h1>Special Comments :</h1>
                            <textarea id="delivery_note" name="delivery_note" placeholder="Anything extra to tell the restaurant" class="additional-textarea"></textarea>
                        </div>
                        <div class="panmentspan2">
                            <div class="global_gap"></div>
                            <h1>Do you have a voucher ? :</h1>
                            <div class="discount-btnapply"><input value="Apply" onclick="usepromocode()" type="button"></div>
                            <input id="txtpromocode" name="txtpromocode" placeholder="Enter discount code" class="discount-input" type="text">
                        </div>
                        <div id="id_cod_details" style="display:none" class="panmentspan2">
                            <div class="global_gap"></div>
                            <div class="div_voucher_rem" style="display:none">
                                <input value="Remove Voucher" onclick="remove_voucher()" type="button">
                            </div>
                            <div class="div_voucher_app">
                                <h1>Do you have a voucher? :</h1>
                                <div class="discount-btnapply"><input value="Apply" onclick="usepromocode()" type="button"></div>
                                <input id="txtpromocode" name="txtpromocode" placeholder="Enter discount code" class="discount-input" type="text" value="<?php ($this->session->userdata('promocode'))? print $this->session->userdata('promocode') : print'' ?>">
                            </div>
                        </div>
                        <div class="global_gap"></div>
                        <div class="panmentspan3">
                            <div class="processpayment">
                                <input value="Process Payment" class="btn-processpayment paymenttbg" type="submit">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3">

            <div class="content-cartspan" id="scolling-content-cart" style="position: relative; min-height: 0px;">
                <?php echo $mycart; ?>
            </div>
        </div>
    </div>
</div>
<script>
    function changemenucard(id) {
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
            restid: <?php echo $this->config->item('api_id') ?>
        }, function(response) {
            window.location.reload();
        });
    }
    function disable_time_ddl() {
        jQuery('#order_time').attr('disabled', 'disabled');
        jQuery('#order_date').attr('disabled', 'disabled');
    }
    function enable_time_ddl() {
        jQuery('#order_time').removeAttr('disabled');
        jQuery('#order_date').removeAttr('disabled');
    }

    function area_zone_selector(cid) {
        jQuery.post(
                "<?= site_url('user/get_dist_by_city_order_place') ?>",
                {cityid: cid, selected_area: ''},
        function(response) {
            jQuery(
                    '#area_zone_selector_div').html(
                    response);
        });
    }
    function changeaddress()
    {
        if (document.getElementById('addlabel').value == 'addnew') {
            alert("Ok");
            prepare_for_new_add();
            return false;
        } else {
            $('#aioConceptName').find(":selected").text();
            jQuery('#as_new_add').val('0');
            if (document.getElementById('addlabel').selectedIndex == 0)
            {
                name = "ci";
                cid = document.getElementById('addlabel').value;
            }
            else
            {
                name = "cai";
                cid = document.getElementById('addlabel').value;
            }
            jQuery("#test").html('');
            jQuery.post("<?= site_url('user/changeaddress') ?>", {table: name, id: cid},
            function(response) {
                if (response) {

                    var obj = jQuery.parseJSON(response);
                    var custInfo = obj.CustInfo[0];
                    var address = obj.address[0];
                    jQuery('#cust_fname').val(custInfo.CustFirstName);
                    jQuery('#cust_lname').val(custInfo.CustLastName);
                    jQuery('#customers_address1').val(address.CustAdd1);
                    jQuery('#customers_address2').val(address.CustAdd2);
                    jQuery('#customers_town').val(address.CustTown);
                    jQuery.post("<?= site_url('user/get_dist_by_city_order_place') ?>", {cityid: '<?php echo $CustTown ?>', selected_area: '<?php echo $CustArea ?>'},
                    function(response) {
                        jQuery('#area_zone_selector_div').html(response);
                    }
                    );
                    jQuery('#customers_postcode').val(address.CustPostcode);
                    jQuery('#customers_telephone').val(address.CustMobile);
                    jQuery('#customers_address_label').val(address.CustAddLabel);
                    getDeliveryArea();
                    showmycart();
                }
            });
        }
    }
    function prepare_for_new_add() {
        jQuery("#customer_buyer").show();
        jQuery('#customers_email').removeAttr('readonly');
        jQuery('.cl_op_field').val('');
        jQuery(".cl_op_field_area").empty();
        jQuery("#customers_postcode").removeAttr('readonly');
        jQuery("#customers_address1").removeAttr('readonly');
        jQuery("#customers_telephone").removeAttr('readonly');
        jQuery("#customers_address_label").removeAttr('readonly');
        jQuery('#as_new_add').val('1');
    }

    function getDeliveryArea() {
        var enter_postcode = jQuery('#customers_postcode').val();
        var enter_area = jQuery('#customers_area').val();
        jQuery.post("<?php echo site_url('user/get_delivery_area') ?>",
                {
                    enter_area: enter_area,
                    enter_postcode: enter_postcode,
                    restid: <?php echo $this->config->item('api_id') ?>
                },
        function(response) {
            console.log(response);
            res = response.split('*@*');
            if (res[0] != "0") {
                jQuery('#orderMinAmount').html(res[2]);
                showmycart();
            }
        });
    }

    function showmycart() {
        jQuery("#ajaxLoadingShowcart").show();
        jQuery.post("<?php echo site_url('user/showmycart') ?>", {
        }, function(response) {
            jQuery("#ajaxLoadingShowcart").hide();
            jQuery("#scolling-content-cart").html('');
            res = response.split('@@');
            document.getElementById("scolling-content-cart").innerHTML = res[0];
        });
    }
    function usepromocode()
    {
        if (jQuery('#txtpromocode').val() != '')
        {
            jQuery.post("<?= base_url() . 'user/userpromocode' ?>",
                    {promocode: jQuery('#txtpromocode').val()},
            function(response) {
                if (response == 1) {
                    alert("Dicount Code Received Successfully");
                    window.location.reload();
                }
                else {
                    alert(response);
                }

            });
        }
        else
        {
            alert("Please enter discount/promotion code");
        }
    }

</script>