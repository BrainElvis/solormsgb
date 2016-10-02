<div role="tabpanel" class="tab-pane" id="tableReservation">
    <div class="row" style="min-height: 600px; width: 100%; margin: 0px; padding: 0px; border: 1px solid #eee;">
        <div class="col-md-9">
            <div style="border:none;" class="contact-form2">
                <form id="goform1" name="goform1">
                    <p style="color:#FF3333;display:none;" id="error_msg_div"></p>
                    <ul>
                        <li>
                            <label>Name<span style="color:red">*</span> :</label>
                            <input type="text" value="" id="name" name="name" class="contact-input  register_input">
                        </li>
                        <li>

                            <label>Email<span style="color:red">*</span> :</label>
                            <input type="text" value="" id="email" name="email" class="contact-input register_input"> &nbsp;&nbsp;<span id="emmsg"></span>
                        </li>
                        <li>
                            <label>Telephone<span style="color:red">*</span> :</label>
                            <input type="text" maxlength="13" value="" id="contactno" name="contactno" class="contact-input register_input">
                            &nbsp;&nbsp;<span style="color:red;" id="contactmsg">
                            </span>
                        </li>
                        <li>
                            <label>No. of People :</label>
                            <select id="noofpeople" class="contact-input register_input" name="noofpeople">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>

                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                                <option value="51">51</option>
                                <option value="52">52</option>
                                <option value="53">53</option>
                                <option value="54">54</option>
                                <option value="55">55</option>
                                <option value="56">56</option>
                                <option value="57">57</option>
                                <option value="58">58</option>
                                <option value="59">59</option>
                                <option value="60">60</option>
                                <option value="61">61</option>
                                <option value="62">62</option>
                                <option value="63">63</option>
                                <option value="64">64</option>
                                <option value="65">65</option>
                                <option value="66">66</option>
                                <option value="67">67</option>
                                <option value="68">68</option>
                                <option value="69">69</option>
                                <option value="70">70</option>
                                <option value="71">71</option>
                                <option value="72">72</option>
                                <option value="73">73</option>
                                <option value="74">74</option>
                                <option value="75">75</option>
                                <option value="76">76</option>
                                <option value="77">77</option>
                                <option value="78">78</option>
                                <option value="79">79</option>
                                <option value="80">80</option>
                            </select>
                        </li>
                        <li>

                            <label>Date :</label>
                            <!--<input type="text" readonly="true" id="bookdate" name="datetimepicker4" class="contact-input register_input">-->
                            <div class="input-group date">
                                <input type="text" class="form-control formcntbg"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </li>
                        <li>
                            <label>&nbsp;</label>
                            <span class="chkav1"><input type="button" style="margin:5px 0px 5px 0px;" class="common-btn" value="SEE AVAILABLE TIME" id="checkavailable" name="checkavailable" data-target="#timemodal" data-toggle="modal"></span>
                        </li>
                        <li>
                            <label>Time Band :</label>

                            <div id="timeBand">
                                <select class="contact-input  register_input" id="booktime" name="booktime">
                                    <option value="1:00 AM">1:00 AM</option>
                                    <option value="1:30 AM">1:30 AM</option>
                                    <option value="2:00 AM">2:00 AM</option>
                                    <option value="2:30 AM">2:30 AM</option>
                                    <option value="3:00 AM">3:00 AM</option>
                                    <option value="3:30 AM">3:30 AM</option>
                                    <option value="4:00 AM">4:00 AM</option>
                                    <option value="4:30 AM">4:30 AM</option>
                                    <option value="5:00 AM">5:00 AM</option>
                                    <option value="5:30 AM">5:30 AM</option>
                                    <option value="6:00 AM">6:00 AM</option>
                                    <option value="6:30 AM">6:30 AM</option>
                                    <option value="7:00 AM">7:00 AM</option>
                                    <option value="7:30 AM">7:30 AM</option>
                                    <option value="8:00 AM">8:00 AM</option>
                                    <option value="8:30 AM">8:30 AM</option>
                                    <option value="9:00 AM">9:00 AM</option>
                                    <option value="9:30 AM">9:30 AM</option>
                                    <option value="10:00 AM">10:00 AM</option>
                                    <option value="10:30 AM">10:30 AM</option>
                                    <option value="11:00 AM">11:00 AM</option>
                                    <option value="11:30 AM">11:30 AM</option>
                                    <option value="12:00 PM">12:00 PM</option>
                                    <option value="12:30 PM">12:30 PM</option>
                                    <option value="1:00 PM">1:00 PM</option>
                                    <option value="1:30 PM">1:30 PM</option>
                                    <option value="2:00 PM">2:00 PM</option>
                                    <option value="2:30 PM">2:30 PM</option>
                                    <option value="3:00 PM">3:00 PM</option>
                                    <option value="3:30 PM">3:30 PM</option>
                                    <option value="4:00 PM">4:00 PM</option>
                                    <option value="4:30 PM">4:30 PM</option>
                                    <option value="5:00 PM">5:00 PM</option>
                                    <option value="5:30 PM">5:30 PM</option>
                                    <option value="6:00 PM">6:00 PM</option>
                                    <option value="6:30 PM">6:30 PM</option>
                                    <option value="7:00 PM">7:00 PM</option>
                                    <option value="7:30 PM">7:30 PM</option>
                                    <option value="8:00 PM">8:00 PM</option>
                                    <option value="8:30 PM">8:30 PM</option>
                                    <option value="9:00 PM">9:00 PM</option>
                                    <option value="9:30 PM">9:30 PM</option>
                                    <option value="10:00 PM">10:00 PM</option>
                                    <option value="10:30 PM">10:30 PM</option>
                                    <option value="11:00 PM">11:00 PM</option>
                                    <option value="11:30 PM">11:30 PM</option>
                                </select>
                            </div>
                        </li>
                        <li>
                            <label>Any Special Requests? :</label>
                            <textarea placeholder="Write your comments..." id="comments2" name="comments" class="contact-textarea register_input"></textarea>
                        </li>
                        <li>
                            <label>&nbsp;</label>
                            <input type="button" style="margin:5px 0px 0px 0px;" class="common-btn" value="SUBMIT" id="submit_reservation" name="submit"> &nbsp;&nbsp;
                        </li>
                    </ul>
                    <input type="hidden" value="" id="custid" name="custid">
                    <input type="hidden" value="14" id="restid" name="restid">
                </form>
            </div>
        </div>
        <!-------------- Checkout page -------------------->
        <div class="col-md-3">
            <div style="position: relative; min-height: 0px; padding-top: 15px;" id="scolling-content-cart" class="content-cartspan">
                <div class="mycart theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; top: 0px;">
                    <div class="cartheading">
                        <div class="cartheading_text">YOUR ORDER</div>
                        <!--<h2><a href="javascript:void(0);" onclick="cancelcart();">Empty</a></h2>-->
                    </div>
                    <div class="cartdelpick">
                        <ul>
                            <li>
                                <span class="delpick">
                                    <input type="radio" onclick="" id="delivery_type" checked="" value="2" name="deliverytype">Delivery<a class="edit-icon" title="Change Area" onclick="" href="#"></a>
                                    <input type="radio" onclick="changemenucard(1, & quot; 15 & quot; , & quot; & quot; )" id="collection_type" value="1" name="deliverytype">Pick Up
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

<!--------------------Available time popup modal------------------------>
<div class="modal fade" id="timemodal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header2">
                <button type="button" class="close2" data-dismiss="modal">&times;</button>
                <h4 class="modal-title2">AVAILABLE TIME</h4>
            </div>
            <div class="modal-body">
                <!---------------------- Table --------------------------------->
                <div class="popupspan_100">
                    <div id="timetable">
                        <div style="overflow:auto">
                            <table width="100%" cellspacing="1" cellpadding="4" border="0" id="timetable">
                                <tbody>
                                    <tr>
                                        <td valign="top">
                                            <table width="100%" cellspacing="1" cellpadding="4" border="1" bgcolor="#358f4b">
                                                <tbody>
                                                    <tr>
                                                        <td width="40%" bgcolor="#f8f8f6" scope="col"><strong>Hour/<br>Minute (AM)</strong></td>
                                                        <td width="30%" bgcolor="#f8f8f6" scope="col"><strong>00 </strong></td>
                                                        <td width="30%" bgcolor="#f8f8f6" scope="col"><strong>30  </strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">0</td>
                                                        <td bgcolor="#FFFFFF" id="01">

                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="02">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">1</td>
                                                        <td bgcolor="#FFFFFF" id="11">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="12">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">2</td>
                                                        <td bgcolor="#FFFFFF" id="21">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="22">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">3</td>
                                                        <td bgcolor="#FFFFFF" id="31">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="32">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">4</td>
                                                        <td bgcolor="#FFFFFF" id="41">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="42">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">5</td>
                                                        <td bgcolor="#FFFFFF" id="51">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="52">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">6</td>
                                                        <td bgcolor="#FFFFFF" id="61">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="62">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">7</td>
                                                        <td bgcolor="#FFFFFF" id="71">

                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="72">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">8</td>
                                                        <td bgcolor="#FFFFFF" id="81">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="82">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">9</td>
                                                        <td bgcolor="#FFFFFF" id="91">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="92">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">10</td>
                                                        <td bgcolor="#FFFFFF" id="101">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="102">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">11</td>
                                                        <td bgcolor="#FFFFFF" id="111">

                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="112">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>

                                        <td valign="top">
                                            <table width="100%" cellspacing="1" cellpadding="4" border="1" bgcolor="#358f4b">
                                                <tbody>
                                                    <tr>
                                                        <td width="40%" bgcolor="#f8f8f6" scope="col"><strong>Hour/<br>Minute</strong></td>
                                                        <td width="30%" bgcolor="#f8f8f6" scope="col"><strong>00 </strong></td>
                                                        <td width="30%" bgcolor="#f8f8f6" scope="col"><strong>30  </strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">12</td>
                                                        <td bgcolor="#FFFFFF" id="121">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="122">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">1</td>
                                                        <td bgcolor="#FFFFFF" id="11">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="12">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">2</td>
                                                        <td bgcolor="#FFFFFF" id="21">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="22">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">3</td>
                                                        <td bgcolor="#FFFFFF" id="31">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="32">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">4</td>
                                                        <td bgcolor="#FFFFFF" id="41">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="42">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">5</td>
                                                        <td bgcolor="#FFFFFF" id="51">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="52">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">6</td>
                                                        <td bgcolor="#FFFFFF" id="61">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="62">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">7</td>
                                                        <td bgcolor="#FFFFFF" id="71">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="72">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">8</td>
                                                        <td bgcolor="#FFFFFF" id="81">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="82">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">9</td>
                                                        <td bgcolor="#FFFFFF" id="91">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="92">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">10</td>
                                                        <td bgcolor="#FFFFFF" id="101">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="102">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">11</td>
                                                        <td bgcolor="#FFFFFF" id="111">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                        <td bgcolor="#FFFFFF" id="112">
                                                            <img width="50" height="28" title="available" alt="available" src="http://gksoft.co.uk/ieat_new_2/assets/<?php echo ASSETS_SITE_IMAGE_PATH ?>icon_available_takeaways.jpg">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
</div>