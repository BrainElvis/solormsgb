<div class="modal fade" id="registration" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header2">
                <button type="button" class="close2" data-dismiss="modal">&times;</button>
                <h4 class="modal-title2">Registraiton</h4>
            </div>
            <ul id="form-section1">
                <p><span class="register-numbering-text">Basic Information</span></p>
                <li>
                    <span style="display:none; color:#0C0" class="success">Your registration has been completed. Please check your email for further details.</span>
                </li>
                <li>
                    <label class="left-column">
                        <span>First Name<font class="fontcolor-red">*</font></span>
                        <input type="text" title="It must contain only letters and a length of minimum 2 characters!" autofocus="" required="" placeholder="Enter your first name" pattern="[a-zA-Z ]{2,}" tabindex="1" id="fname" name="fname">
                    </label>
                    <label class="right-column">
                        <span>Last Name<font class="fontcolor-red">*</font></span>
                        <input type="text" required="" title="It must contain only letters and a length of minimum 2 characters!" placeholder="Enter your last name" pattern="[a-zA-Z ]{2,}" tabindex="2" id="lname" name="lname">
                    </label>
                </li>
                <div style="clear: both;"></div>
                <li>
                    <label>
                        <span>Mobile<font class="fontcolor-red">*</font></span>
                        <input type="tel" required="" title="It must contain a valid phone number formed only by numerical values and a length between 7 and 13 characters !" placeholder="Enter your phone number" tabindex="4" pattern="(\+?\d[- .]*){7,13}" id="telephone" name="telephone">
                    </label>
                </li>
                <p><span class="register-numbering-text">Location Details</span></p>
                <li>
                    <label>
                        <span>Address<font class="fontcolor-red">*</font></span>
                        <input type="text" required="" title="It must contain letters and/or separators and a length of minimum 10 characters !" placeholder="Enter your street address" pattern="[a-zA-Z0-9. - , ]{10,}" tabindex="5" id="address" name="address">
                    </label>
                </li>
                <li>
                    <label class="left-column">
                        <span>City<font class="fontcolor-red">*</font></span>
                        <select onchange="get_area_list(this.value);" tabindex="6" id="city" name="city">
                            <option value="1">Birmingham</option>
                            <option value="2">Leeds</option>
                            <option value="3">Liverpool</option>
                            <option value="4">Cardiff</option>
                            <option value="5">London</option>
                            <option value="6">Manchester</option>
                        </select>
                    </label>
                </li>
                <li>
                    <label class="right-column">
                        <span>Area<font class="fontcolor-red">*</font></span>
                        <div id="area_container">
                            <select id="area" name="area">
                                <option selected="selected" value="">Select Zone</option>
                                <option value="10">Aston</option>
                                <option value="1">Bromford</option>
                                <option value="11">Great-Bar</option>
                                <option value="2">Lozzels</option>
                                <option value="12">zone1</option>
                            </select>
                        </div>
                    </label>
                </li>
                <li>
                    <label class="left-column">
                        <span>Eircode<font class="fontcolor-red">*</font></span>
                        <input type="text" required="" title="It must contain only numbers and a length of minimum 3 characters !" placeholder="Enter your Eircode" onkeyup="jQuery(this).val(jQuery(this).val().toUpperCase());" maxlength="7" tabindex="8" id="zipcode" name="zipcode">
                    </label>
                </li>
                <div style="clear: both;"></div>
                <p><span class="register-numbering-text">Account Credentials</span></p>
                <li>
                    <label>
                        <span>Email<font class="fontcolor-red">*</font></span>
                        <input type="email" required="" title="It must contain a valid email address e.g. 'someone@provider.com' !" placeholder="Enter a valid email address" tabindex="6" id="email" name="email">
                    </label>
                </li>
                <li>
                    <label class="left-column">
                        <span>Password<font class="fontcolor-red">*</font></span>
                        <input type="password" required="" title="It can contain all types of characters and a length of minimum 6 characters!" placeholder="Enter password" pattern=".{6,}" tabindex="7" id="password_reg" name="password">
                    </label>
                    <label class="right-column">
                        <span>Confirm Password<font class="fontcolor-red">*</font></span>
                        <input type="password" required="" title="It can contain all types of characters and a length of minimum 6 characters!" placeholder="Confirm password" pattern=".{6,}" tabindex="8" id="confirm_password" name="confirm_password">
                    </label>
                </li>
                <div style="clear: both;"></div>
                <li>
                    <label>
                        <span>
                            <input type="checkbox" style="margin-right: 1%;" id="agree_chk" name="agree_chk">I Agree to
                            <a target="_blank" href="http://gksoft.co.uk/ieat_new_2/user/page/Privacy Policy">Privacy Policy</a>
                            and
                            <a target="_blank" href="http://gksoft.co.uk/ieat_new_2/user/page/Terms">Terms and Conditions</a>
                        </span>
                    </label>
                </li>
                <div style="clear: both;"></div>
                <li>
                    <button id="create-account-submit" type="submit" tabindex="11" name="submit">Create Account</button>
                </li>
            </ul>
        </div>
    </div>
</div>