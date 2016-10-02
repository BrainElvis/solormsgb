<div class="container">
    <div class="row" id="content-wrapbg">
         <?php $this->load->view('customer/subviews/nav') ?>
        <div class="col-md-9">
            <div class="content-innerspan2">
                <div class="innercommon-right">
                    <h1>Order Review</h1>
                    <p>Let us know your opinion about order&nbsp;#10003</p>
                    <div class="innercommon-right-content">
                        <table class="payment-table" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr class="odd">
                                    <td class="bdr-bottom bdr-right" width="50%">Restaurnat Name: </td>
                                    <td class="bdr-bottom" width="50%">Your Restaurant Name</td>
                                </tr>
                                <tr class="even">
                                    <td class="bdr-bottom bdr-right" width="50%">Order No :</td>
                                    <td class="bdr-bottom" width="50%">10003</td>
                                </tr>
                                <tr class="odd">
                                    <td class="bdr-bottom bdr-right" width="50%">Order Type :</td>
                                    <td class="bdr-bottom" width="50%">Pick Up Order</td>
                                </tr>
                                <tr class="even">
                                    <td class="bdr-bottom bdr-right" width="50%">Order Value :</td>
                                    <td class="bdr-bottom" width="50%">£79.00 (Cash On Delivery)</td>
                                </tr>
                                <tr class="odd">
                                    <td class="bdr-bottom bdr-right" width="50%">Order Date :</td>
                                    <td class="bdr-bottom" width="50%">12, Jul 2016, 10:43 AM</td>
                                </tr>
                                <tr class="even">
                                    <td class="bdr-bottom" colspan="2">Pick Up Time Confimed By Restaurant: 12, Jul 2016, 10:43 AM</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="innercommon-right-content">
                        <table class="payment-table" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr class="even">
                                    <td class="bdr-bottom" colspan="3"><b>Your Rating On Order# 10003 </b></td>
                                </tr>
                                <tr class="odd order-td">
                                    <td class="bdr-bottom bdr-right" width="40%">Quality</td>
                                    <td class="bdr-bottom" width="60%">Star</td>
                                </tr>
                                <tr class="even order-td">
                                    <td class="bdr-bottom bdr-right" width="40%">Service</td>
                                    <td class="bdr-bottom" width="60%">Star</td>
                                </tr>
                                <tr class="odd order-td">
                                    <td class="bdr-bottom bdr-right" width="40%">Delivery</td>
                                    <td class="bdr-bottom" width="60%">Star</td>
                                </tr>
                                <tr class="even">
                                    <td class="bdr-bottom bdr-right" width="40%">Charge</td>
                                    <td class="bdr-bottom order-td" width="60%">Star</td>
                                </tr>
                                <tr class="odd">
                                    <td class="bdr-bottom" colspan="2">
                                        <form onsubmit="return isRated();" id="edit" name="edit" enctype="multipart/form-data" method="post" action="http://gksoft.co.uk/ieat_new_2/customer/makerating/10003/14">
                                            <textarea rows="15" cols="75" name="tmText" id="tmText"></textarea>
                                            <script>
                                                tinyMCE.execCommand("mceAddControl", true, 'tmText');
                                            </script>
                                            <br>								<input value="14" id="RestId" name="RestId" type="hidden">
                                            <input value="Brian Elvis" id="tmBy" name="tmBy" type="hidden">
                                            <input value="1" id="tmLocation" name="tmLocation" type="hidden">
                                            <input value="10003" id="orderid" name="orderid" type="hidden">
                                            <input value="0" id="rat1" name="rat1" type="hidden">
                                            <input value="0" id="rat2" name="rat2" type="hidden">
                                            <input value="0" id="rat3" name="rat3" type="hidden">
                                            <input value="0" id="rat4" name="rat4" type="hidden">
                                        </form>
                                    </td>
                                </tr>
                                <tr class="even">
                                    <td class="bdr-bottom" colspan="2">
                                        <input class="common-btn" value="Submit" id="add" name="add" type="submit">
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
