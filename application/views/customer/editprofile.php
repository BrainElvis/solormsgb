<div class="container">
    <div class="row accountbg">
        <?php $this->load->view('customer/subviews/nav') ?>
        <div class="col-md-9">
            <div class="content-innerspan2">
                <div class="innercommon-right">
                    <h1>Edit Profile</h1>
                    <div class="innercommon-right-content">
                        <span></span>
                        <table class="payment-table" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr class="even">
                                    <td class="bdr-bottom" colspan="3"><b>Create New Address </b></td>
                                </tr>
                            <form onsubmit="return validation();" id="edit" name="edit" enctype="multipart/form-data" method="post" action="http://gksoft.co.uk/ieat_new_2/customer/profileedit"></form>
                            <tr class="odd">
                                <td class="bdr-bottom bdr-right" width="40%">First Name:</td>
                                <td class="bdr-bottom" width="60%">
                                    <input value="Brian" id="customers_firstname" class="textfield input1" name="customers_firstname" type="text">
                                </td>
                            </tr>
                            <tr class="even">
                                <td class="bdr-bottom bdr-right" width="40%">Last Name:</td>
                                <td class="bdr-bottom" width="60%">
                                    <input value="Elvis" class="textfield input1" id="customers_lastname" name="customers_lastname" type="text">
                                </td>
                            </tr>
                            <tr class="odd">
                                <td class="bdr-bottom bdr-right" width="40%">E-mail Address:</td>
                                <td class="bdr-bottom" width="60%">
                                    <input onblur="check_availablity(this.value);" value="zaman@isoftware.com.bd" class="textfield  input1" id="customers_email_address" name="customers_email_address" type="text">
                                </td>
                            </tr>
                            <tr class="even">
                                <td class="bdr-bottom bdr-right" width="40%">Phone:</td>
                                <td class="bdr-bottom" width="60%">
                                    <input onkeyup="format(this)" class="textfield  input1" id="customers_telephone" onblur="if (value == '') {
                                                this.value = 'e.g 902 717 0461';
                                                this.style.color = '#CCCCCC';
                                            }" onfocus="if (value == 'e.g 902 717 0461') {
                                                        this.value = '';
                                                        this.style.color = '#3E3E3E';
                                                    }" value="123 123 123" name="customers_telephone" style="color:#3E3E3E;" type="text">
                                </td>
                            </tr>
                            <tr class="odd">
                                <td class="bdr-bottom bdr-right" width="40%">Address:</td>
                                <td class="bdr-bottom" width="60%">
                                    <input value="71 pethybridge Road" class="textfield input1" id="customers_address1" name="customers_address1" type="text">
                                </td>
                            </tr>
                            <tr class="even">
                                <td class="bdr-bottom bdr-right" width="40%">City / Town :</td>
                                <td class="bdr-bottom" width="60%">
                                    <select onchange="get_dist_by_city(this.value)" class="dropdown  input1" id="customers_town" name="customers_town">
                                        <option value="" style="margin-left:5px; font-weight:bold;">Select City</option>
                                        <option selected="selected" value="1">Birmingham</option>
                                        <option value="2">Leeds</option>
                                        <option value="3">Liverpool </option>
                                        <option value="4">Cardiff</option>
                                        <option value="5">London</option>
                                        <option value="6">Manchester</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="odd">
                                <td class="bdr-bottom bdr-right" width="40%">Area:</td>
                                <td class="bdr-bottom" width="60%">
                                    <div id="address_book_area_container">
                                        <select class="dropdown input1" id="cust_area" name="cust_area">
                                            <option value="">Select Area</option>
                                            <option selected="selected" value="1">Bromford</option>
                                            <option value="2">Lozzels</option>
                                            <option value="10">Aston</option>
                                            <option value="11">Great-Bar</option>
                                            <option value="12">zone1</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr class="odd">
                                <td class="bdr-bottom bdr-right" width="40%">Eircode:</td>
                                <td class="bdr-bottom" width="60%">
                                    <input value="" onkeyup="jQuery(this).val(jQuery(this).val().toUpperCase());" maxlength="3" size="3" name="customers_postcode" style="text-transform: uppercase" class="textfield-small" type="text">
                                    <input value="" onkeyup="jQuery(this).val(jQuery(this).val().toUpperCase());" maxlength="3" size="3" name="customers_postcode2" style="text-transform: uppercase" class="textfield-small" type="text">
                                </td>
                            </tr>
                            <tr>
                                <td class="bdr-bottom bdr-right" width="40%"></td>
                                <td class="bdr-bottom bdr-right" width="40%">
                                    <input class="common-btn" value="Save" name="Submit" type="submit">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
