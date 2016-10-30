<div class="modal fade" id="registration" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header2">
                <button type="button" class="close2" data-dismiss="modal">&times;</button>
                <h4 class="modal-title2"><?php echo $this->lang->line('registration_header_title') ?></h4>
            </div>
            <ul id="form-section1">
                <p><span class="register-numbering-text"><?php echo $this->lang->line('registration_basic_info') ?></span></p>
                <li>
                    <span style="display:none; color:#0C0" class="success"><?php echo $this->lang->line('registration_success') ?></span>
                </li>
                <li>
                    <span style="display:none; color:#ff0000" id="registrationFormErrors"></span>
                </li>
                <li>
                    <label class="left-column">
                        <span><?php echo $this->lang->line('common_first_name') ?><font class="required">*</font></span>
                        <input type="text" title="It must contain only letters and a length of minimum 2 characters!" autofocus="" required="" placeholder="Enter your first name" pattern="[a-zA-Z ]{2,}" tabindex="1" id="CustFirstName" name="CustFirstName">
                    </label>
                    <label class="right-column">
                        <span><?php echo $this->lang->line('common_last_name') ?><font class="required">*</font></span>
                        <input type="text" required="" title="It must contain only letters and a length of minimum 2 characters!" placeholder="Enter your last name" pattern="[a-zA-Z ]{2,}" tabindex="2" id="CustLastName" name="CustLastName">
                    </label>
                </li>
                <div style="clear: both;"></div>
                <li>
                    <label class="single-line">
                        <span><?php echo $this->lang->line('common_mobile_number') ?><font class="required">*</font></span>
                        <input type="tel" required="" title="It must contain a valid phone number formed only by numerical values and a length between 7 and 13 characters !" placeholder="Enter your phone number" tabindex="4" pattern="(\+?\d[- .]*){7,13}" id="CustMobile" name="CustMobile">
                    </label>
                </li>
                <p><span class="register-numbering-text"><?php echo $this->lang->line('registration_location_details') ?></span></p>
                <li>
                    <label class="single-line">
                        <span><?php echo $this->lang->line('common_address') ?><font class="required">*</font></span>
                        <input type="text" required="" title="It must contain letters and/or separators and a length of minimum 10 characters !" placeholder="Enter your street address" pattern="[a-zA-Z0-9. - , ]{10,}" tabindex="5" id="CustAdd1" name="CustAdd1">
                    </label>
                </li>
                <li>
                    <?php
                    $cities = array();
                    if ($this->session->userdata('cities')) {
                        $cities = $this->session->userdata('cities');
                    }
                    ?>
                    <label class="left-column">
                        <span><?php echo $this->lang->line('common_city') ?><font class="required">*</font></span>
                        <select onchange="get_area_list(this.value);" tabindex="6" id="CustTown" name="CustTown">
                            <?php if (!empty($cities)): ?>
                                <?php foreach ($cities AS $obj): ?>
                                    <option value="<?= $obj->CityId ?>"> <?= $obj->CityName ?> </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </label>
                </li>
                <script>
                    jQuery(document).ready(function () {
                        get_area_list(jQuery('#CustTown').val());
                    });
                </script>
                <?php
                $areas = array();
                if ($this->session->userdata('areas')) {
                    $areas = $this->session->userdata('areas');
                }
                ?>
                <li>
                    <label class="right-column">
                        <span><?php echo $this->lang->line('common_area') ?><font class="required">*</font><span id="ajaxLoadingCircle" style="display: none;"><img src="<?php echo ASSETS_SITE_IMAGE_PATH.'ajax-loader-circle.gif'?>"></span></span>
                        <div id="area_container">
                            <select id="CustArea" name="CustArea"  tabindex="7">
                                <?php if (!empty($areas) && count($areas) > 0) : ?>
                                    <?php foreach ($areas as $obj): ?>
                                        <option value="<?= $obj->AreaId; ?>"><?= $obj->AreaName; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </label>
                </li>
                <li>
                    <label class="single-line">
                        <span><?php echo $this->lang->line('common_postcode') ?><font class="required">*</font></span>
                        <input type="text" required="" title="It must contain only numbers and a length of minimum 3 characters !" placeholder="Enter your Eircode" onkeyup="jQuery(this).val(jQuery(this).val().toUpperCase());" maxlength="7" tabindex="8" id="CustPostcode" name="CustPostcode">
                    </label>
                </li>
                <div style="clear: both;"></div>
                <p><span class="register-numbering-text"><?php echo $this->lang->line('registration_account_credential') ?></span></p>
                <li>
                    <label class="single-line">
                        <span><?php echo $this->lang->line('common_email') ?><font class="required">*</font></span>
                        <input type="email" required="" title="It must contain a valid email address e.g. 'someone@provider.com' !" placeholder="Enter a valid email address" tabindex="6" id="CustEmail" name="CustEmail">
                    </label>
                </li>
                <li>
                    <label class="left-column">
                        <span><?php echo $this->lang->line('common_password') ?><font class="required">*</font></span>
                        <input type="password" required="" title="It can contain all types of characters and a length of minimum 6 characters!" placeholder="Enter password" pattern=".{6,}" tabindex="7" id="CustPassword" name="CustPassword">
                    </label>
                    <label class="right-column">
                        <span><?php echo $this->lang->line('common_confirm_password') ?><font class="required">*</font></span>
                        <input type="password" required="" title="It can contain all types of characters and a length of minimum 6 characters!" placeholder="Confirm password" pattern=".{6,}" tabindex="8" id="confirmPassword" name="confirmPassword">
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
                    <input type="hidden" name="RestId" id="RestId" value="<?php echo $this->config->item('api_id')?>">
                    <button id="create-account-submit" class="btn btn-success" type="submit" tabindex="11" name="submit_form">Create Account</button>
                </li>
            </ul>
        </div>
    </div>
</div>