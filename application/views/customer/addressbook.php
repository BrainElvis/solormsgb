<!-- Start Services Section -->
<div class="container">
    <div class="row accountbg">
        <?php $this->load->view('customer/subviews/nav') ?>
        <div class="col-md-9">
            <div class="content-innerspan2">
                <div class="innercommon-right">
                    <h1>
                        Address List <span class="float_right">
                            <a onclick="return prepare_for_new_add()"   class="black form-action" href="javascript:void(0);">Add New Address</a>
                        </span>
                    </h1>
                    <div class="innercommon-right-content">
                        <table class="payment-table" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr class="even">
                                    <th class="bdr-bottom bdr-right">Name</th>
                                    <th class="bdr-bottom bdr-right">Address</th>
                                    <?php if (isset($cust_address) && !empty($cust_address)): ?>
                                        <th class="bdr-bottom bdr-right"></th>
                                        <th class="bdr-bottom bdr-right"></th>
                                    <?php else: ?>
                                        <th class="bdr-bottom bdr-right">Action</th>
                                    <?php endif; ?>
                                </tr>
                                <tr class="odd">
                                    <td class="bdr-bottom bdr-right"><?= $customer_info ['CustAddLabel']; ?></td>
                                    <td class="bdr-bottom bdr-right">
                                        <?php echo $customer_info['CustAdd1'] . ' ' . $customer_info ['CustAdd2'] . ', ' . $areas[$customer_info['CustTown']][$customer_info['CustArea']] . ', ' . $customer_info ['CustPostcode'] . ', ' . $cities[$customer_info['CustTown']]; ?>
                                    </td>
                                    <?php if ($cust_address): ?>
                                        <td class="bdr-bottom bdr-right"><a  href="<?php echo base_url(); ?>customer/addressbook/Primary">Edit</a></td>
                                    <?php else: ?>
                                        <td class="bdr-bottom bdr-right"> <a class="icon icon-edit" href="<?php echo base_url(); ?>customer/addressbook/Primary">Edit</a></td>
                                    <?php endif; ?>
                                </tr>
                                <?php if (is_array($cust_address) && !empty($cust_address)): ?>
                                    <?php $count = 0; ?>
                                    <?php foreach ($cust_address as $cust_adrs): ?>
                                        <tr class="<?php $count % 2 == 0 ? print'even' : print"odd" ?>">
                                            <td class="bdr-bottom bdr-right"><?= $cust_adrs ['CustAddLabel']; ?></td>
                                            <td class="bdr-bottom bdr-right">
                                                <?php echo $cust_adrs['CustAdd1'] . ' ' . $cust_adrs ['CustAdd2'] . ', ' . $areas[$cust_adrs['CustTown']][$cust_adrs['CustArea']] . ', ' . $cust_adrs ['CustPostcode'] . ', ' . $cities[$cust_adrs['CustTown']]; ?>
                                            </td>
                                            <td class="bdr-bottom bdr-right"> <a href="<?php echo base_url(); ?>customer/addressbook/<?= $cust_adrs['CustAddId']; ?>" class="form-action">Edit</a></td>
                                            <td class="bdr-bottom bdr-right"> <a  onclick="deleteAddress('<?= $cust_adrs['CustAddId']; ?>');" href="javascript:void(0);">Delete</a></td>
                                        </tr>
                                        <?php $count++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <form style=" <?php $this->uri->segment(3) == '' ? print'display:none;' : print 'display:block' ?>" id="edit" name="edit" enctype="multipart/form-data" method="post" action="<?php echo site_url('customer/saveaddress/' . $addid); ?>">
                        <div id="add_new_location" class="innercommon-right-content">
                            <table class="payment-table" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <?php
                                $editadd = array();
                                if (count($edit_address))
                                    $editadd = $edit_address[0];
                                ?>
                                <tbody>
                                    <tr class="even">
                                        <td class="bdr-bottom" colspan="3"><b>Create New Address </b></td>
                                    </tr>
                                    <tr class="odd">
                                        <td class="bdr-bottom bdr-right" width="40%">Address :</td>
                                        <td width="60%" class="bdr-bottom">
                                            <input type="text" name="customers_address1" <?php if ($addid == 'Primary') echo ""; ?>
                                                   id="customers_address1" value="<?Php if (isset($editadd ['CustAdd1'])) echo $editadd ['CustAdd1']; ?>" class="textfield input1"/>
                                            <input type="hidden" name="customers_address2" id="customers_address2" value="" class="textfield input1" />
                                        </td>
                                    </tr>
                                    <tr class="odd">
                                        <td class="bdr-bottom bdr-right" width="40%">City:</td>
                                        <td class="bdr-bottom" width="60%">
                                            <select name="customers_town" id="customers_town" class="dropdown input1" onchange="get_dist_by_city(this.value)">
                                                <option value="">City</option>
                                                <?php foreach ($cities as $key => $value) : ?>
                                                    <option  value="<?php echo $key ?>"<?php
                                                    if ((isset($editadd ['CustTown']) && $editadd ['CustTown'] == $key)) {
                                                        echo 'selected="selected"';
                                                    }
                                                    ?>> <?php echo $value ?> </option>  
                                                         <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="odd">
                                        <td class="bdr-bottom bdr-right" width="40%">Area:</td>
                                        <?php
                                        $cityId = isset($editadd ['CustTown']) ? $editadd['CustTown'] : 1;
                                        $arealist = $this->User_Model->get_area_list($cityId);
                                        ?>
                                        <td class="bdr-bottom" width="60%">
                                            <div id="address_book_area_container">
                                                <select name="cust_area" id="cust_area" class="dropdown input1">
                                                    <option value="">Select Area</option>
                                                    <?php foreach ($arealist as $obj) : ?>
                                                        <option  value="<?php echo $obj->AreaId ?>"
                                                        <?php
                                                        if ((isset($editadd ['CustArea']) && $editadd ['CustArea'] == $obj->AreaId) || ( isset($_POST['cust_area']) &&  $_POST['cust_area']== $obj->AreaId)) {
                                                            echo 'selected="selected"';
                                                        }
                                                        ?>>
                                                                     <?php echo $obj->AreaName ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="odd">
                                        <td width="40%" class="bdr-bottom bdr-right">Postcode:</td>
                                        <td width="60%" class="bdr-bottom">
                                            <?php
                                            $postcode = array();
                                            $postcode[0] = '';
                                            $postcode[1] = '';
                                            if (isset($editadd ['CustPostcode'])) {
                                                $postcode = explode(" ", $editadd['CustPostcode']);
                                            }
                                            if (!isset($postcode[0]))
                                                $postcode[0] = '';
                                            if (!isset($postcode[1]))
                                                $postcode[1] = '';
                                            ?>
                                            <input class="textfield-small"  name="customers_postcode1" style="text-transform: uppercase" type="text" maxlength="3" onkeyup="jQuery(this).val(jQuery(this).val().toUpperCase());" id="customers_postcode1" value="<?Php echo $postcode[0]; ?>" />

                                            <input class="textfield-small" name="customers_postcode2" style="text-transform: uppercase" type="text" maxlength="3" onkeyup="jQuery(this).val(jQuery(this).val().toUpperCase());" id="customers_postcode2" value="<?Php echo $postcode[1]; ?>"/>
                                        </td>
                                    </tr>
                                    <tr class="even">
                                        <td width="40%" class="bdr-bottom bdr-right"><?php echo $this->lang->line('common_phone_number'); ?> :</td>
                                        <td width="60%" class="bdr-bottom">
                                            <input  name="phone"  id="phone" type="text" class="textfield  input1" <?php if ($addid == "Primary") { ?> value="<?php if (isset($editadd ['CustTelephone'])) echo $editadd ['CustTelephone']; ?>" <?php }else { ?> value="<?php
                                                if (isset($editadd ['CustPhone']))
                                                    echo $editadd['CustPhone'];
                                            }
                                            ?>" />
                                        </td>
                                    </tr>
                                    <tr class="odd">
                                        <td width="40%" class="bdr-bottom bdr-right">Address Label:</td>
                                        <td width="60%" class="bdr-bottom"><input  name="customers_add_label" type="text" class="textfield  input1" <?php if ($addid == 'Primary') echo "readonly"; ?>  id="customers_add_label"  value="<?php
                                            if (isset($editadd['CustAddLabel']))
                                                echo $editadd['CustAddLabel'];
                                            else if ($addid == 'Primary')
                                                echo 'Primary';
                                            ?>" />
                                        </td>
                                    </tr>	
                                    <tr>
                                        <td width="40%" class="bdr-bottom bdr-right">&nbsp;</td>
                                        <td width="60%" class="bdr-bottom">
                                            <?php if (isset($editadd['CustAddLabel'])): ?>
                                                <input type="hidden" name="PrevCustAddLabel" value="<?php echo $editadd['CustAddLabel'] ?>">
                                            <?php endif ?>
                                            <input type="hidden" id="as_new_add" name="as_new_add" value="0" />
                                            <input type="submit" onclick="return validation()"  name="submit" id="btn-submit" class="common-btn" value="<?= $addid ? "Update" : "Save" ?>"/> 
                                            <input type="submit" onclick="return cancel()" class="common-btn"  name="submit"  value="Cancel"/> 
                                        </td>
                                    </tr>	
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function deleteAddress(id)
    {
        if (confirm("Are you sure you want to remove this address from your address list?"))
            window.location = "<?php echo base_url(); ?>customer/addressbook/del/" + id;
        else
            return false
    }

    function prepare_for_new_add() {
        jQuery("#add_new_location").show();
        jQuery('.register_input03').val('');
        jQuery('.input1').val('');
        jQuery('.register_input02').val('');
        jQuery('#as_new_add').val('1');
        jQuery('#btn-submit').val('SAVE');
        jQuery('#customers_add_label').removeAttr('readonly');
    }

    function cancel() {
        jQuery("#add_new_location").hide();
        return false;
    }

    function IsNumeric(sText)
    {
        var ValidChars = "0123456789";
        var IsNumber = true;
        var Char;
        for (i = 0; i < sText.length && IsNumber == true; i++)
        {
            Char = sText.charAt(i);
            if (ValidChars.indexOf(Char) == -1)
            {
                IsNumber = false;
            }
        }
        return IsNumber;
    }
    function validation()
    {
        if (document.edit.customers_address1.value == "")
        {
            alert("<?php echo $this->lang->line('required_cust_address'); ?>");
            document.edit.customers_address1.focus();
            return false;
        }
        if (document.edit.customers_town.value == 'Select your town or city' || document.edit.customers_town.value == '')
        {
            alert("<?php echo $this->lang->line('required_cust_city'); ?>");
            document.edit.customers_town.focus();
            return false;
        }
        if (document.edit.cust_area.value == 'Select your area' || document.edit.cust_area.value == '')

        {
            alert("Select an area");
            document.edit.cust_area.focus();
            return false;
        }

        if (document.edit.customers_postcode1.value == '')

        {
            alert("Postal Code is a required field.");
            document.edit.customers_postcode1.focus();
            return false;
        }

        if (document.edit.customers_postcode2.value == '')
        {
            alert("Postal Code is a required field.");
            document.edit.customers_postcode2.focus();
            return false;
        }

        if (document.edit.customers_postcode1.value != '' && document.edit.customers_postcode1.value.length < 3)
        {
            alert("Please enter first 3 digits of your postal code");
            document.edit.customers_postcode1.focus();
            return false;
        }

        if (document.edit.customers_postcode2.value != '' && document.edit.customers_postcode2.value.length < 3)

        {

            alert("Please enter last 3 digits of your postal code");
            document.edit.customers_postcode2.focus();
            return false;

        }

        if (document.edit.customers_add_label.value == "")
        {
            alert("<?php echo $this->lang->line('required_address_level'); ?>");
            document.edit.customers_add_label.focus();
            return false;
        }
        return true;
    }
</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(".form-action").click(function() {
            jQuery("#edit").show();
        });
        //called when key is pressed in textbox
        jQuery("#phone").keypress(function(e)

        {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
            {
                //display error message
                jQuery("#phmsg").html("Digits Only").show().fadeOut("slow");
                return false;
            }
        });

    });

</script> 
<script type="text/javascript">
    function format(input) {
        var nStr = input.value + '';
        if (input.value.length < 12) {
            nStr = nStr.replace(/\s/g, "");
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            //var rgx = /(\d3)(\d{3})/;
            var rgx = /(\d{3})(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ' ' + '$2');
            }
            input.value = x1 + x2;
        }
        ;
    }
    ;

    function get_dist_by_city(cid) {
        jQuery.post("<?= site_url('user/get_dist_by_city') ?>", {cityid: cid}, function(response) {
            jQuery('#address_book_area_container').html(response);
        });
    }
</script>