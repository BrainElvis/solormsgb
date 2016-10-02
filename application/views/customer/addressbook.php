<!-- Start Services Section -->
<div class="container">
    <div class="row accountbg">
        <?php $this->load->view('customer/subviews/nav') ?>
            <div class="col-md-9">
                <div class="content-innerspan2">
                    <div class="innercommon-right">
                        <h1>
                            Address List <span class="float_right">
                                <a onclick="return prepare_for_new_add()" class="black" href="javascript:void(0);">Action</a>
                            </span>
                        </h1>
                        <div class="innercommon-right-content">
                            <table class="payment-table" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                    <tr class="even">
                                        <th class="bdr-bottom bdr-right">Name</th>
                                        <th class="bdr-bottom bdr-right">Address</th>
                                        <th class="bdr-bottom bdr-right"></th>
                                        <th class="bdr-bottom bdr-right"></th>
                                    </tr>
                                    <tr class="odd">
                                        <td class="bdr-bottom bdr-right">Primary</td>
                                        <td class="bdr-bottom bdr-right">71 pethybridge Road , Bromford,  , Birmingham</td>
                                        <td class="bdr-bottom bdr-right"><a href="primary.html">Edit</a></td>
                                    </tr>
                                    <tr class="even">
                                        <td class="bdr-bottom bdr-right">address_1</td>
                                        <td class="bdr-bottom bdr-right">address_1 , zone 2, , Leeds</td>
                                        <td class="bdr-bottom bdr-right"> <a href="primary.html">Edit</a></td>
                                        <td class="bdr-bottom bdr-right"> <a href="javascript:void(0);" onclick="deleteAddress('1');">Delete</a></td>
                                    </tr>
                                    <tr class="even">
                                        <td class="bdr-bottom bdr-right">address_2</td>
                                        <td class="bdr-bottom bdr-right">address_2 , Oxford Street, , Cardiff</td>
                                        <td class="bdr-bottom bdr-right"> <a href="http://gksoft.co.uk/ieat_new_2/customer/addressbook/2">Edit</a></td>
                                        <td class="bdr-bottom bdr-right"> <a href="javascript:void(0);" onclick="deleteAddress('2');">Delete</a></td>
                                    </tr>
                                    <tr class="even">
                                        <td class="bdr-bottom bdr-right">address_3</td>
                                        <td class="bdr-bottom bdr-right">address_3 , Greater Manchester, , Manchester</td>
                                        <td class="bdr-bottom bdr-right"> <a href="http://gksoft.co.uk/ieat_new_2/customer/addressbook/4">Edit</a></td>
                                        <td class="bdr-bottom bdr-right"> <a href="javascript:void(0);" onclick="deleteAddress('4');">Delete</a></td>
                                    </tr>
                                    <tr class="even">
                                        <td class="bdr-bottom bdr-right">Test Address</td>
                                        <td class="bdr-bottom bdr-right">address_4 , Oxford Street, CF5 4DR, Cardiff</td>
                                        <td class="bdr-bottom bdr-right"> <a href="http://gksoft.co.uk/ieat_new_2/customer/addressbook/20">Edit</a></td>
                                        <td class="bdr-bottom bdr-right"> <a href="javascript:void(0);" onclick="deleteAddress('20');">Delete</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <form id="edit" name="edit" enctype="multipart/form-data" method="post" action="http://gksoft.co.uk/ieat_new_2/customer/saveaddress/">
                            <div style="display:none;" id="add_new_location" class="innercommon-right-content">
                                <table class="payment-table" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                        <tr class="even">
                                            <td class="bdr-bottom" colspan="3"><b>Create New Address </b></td>
                                        </tr>
                                        <tr class="odd">
                                            <td class="bdr-bottom bdr-right" width="40%">Address :</td>
                                            <td class="bdr-bottom" width="60%">
                                                <input class="textfield input1" value="" id="customers_address1" name="customers_address1" type="text">
                                                <input class="textfield input1" value="" id="customers_address2" name="customers_address2" type="hidden">
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td class="bdr-bottom bdr-right" width="40%">City:</td>
                                            <td class="bdr-bottom" width="60%">
                                                <select onchange="get_dist_by_city(this.value)" class="dropdown input1" id="customers_town" name="customers_town">
                                                    <option value="">City</option>
                                                    <option value="1">Birmingham</option>
                                                    <option value="2">Leeds</option>
                                                    <option value="3">Liverpool</option>
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
                                                        <option value="1">Bromford</option>
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
                                                <input value="" id="customers_postcode1" onkeyup="" maxlength="3" style="text-transform: uppercase" name="customers_postcode1" class="textfield-small" type="text">
                                                <input value="" id="customers_postcode2" onkeyup="" maxlength="3" style="text-transform: uppercase" name="customers_postcode2" class="textfield-small" type="text">
                                            </td>
                                        </tr>
                                        <tr class="even">
                                            <td class="bdr-bottom bdr-right" width="40%">Phone :</td>
                                            <td class="bdr-bottom" width="60%">
                                                <input value="" class="textfield  input1" id="phone" name="phone" type="text">
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td class="bdr-bottom bdr-right" width="40%">Address Label:</td>
                                            <td class="bdr-bottom" width="60%"><input value="" id="customers_add_label" class="textfield  input1" name="customers_add_label" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td class="bdr-bottom bdr-right" width="40%">&nbsp;</td>
                                            <td class="bdr-bottom" width="60%">
                                                <input value="0" name="as_new_add" id="as_new_add" type="hidden">
                                                <input value="Save" class="common-btn" id="btn-submit" name="submit" onclick="return validation()" type="submit">
                                                <input value="Cancel" name="submit" class="common-btn" onclick="return cancel()" type="submit">
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