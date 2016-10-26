<!-------------------------------------- Contact Page --------------------------------------->
<div class="container contactbg">
    <div class="row">
        <div class="col-md-4">
            <h1><?php echo $this->lang->line('contact_address') ?></h1>
            <p> <?php echo $this->config->item('address') ?>
                <br/>
                <?php echo $this->lang->line('common_phone_number') ?> : <?php echo $this->config->item('phone') ?><br/>
                <?php echo $this->lang->line('common_email') ?> : <?php echo $this->config->item('email') ?>
            </p>
            <div class="sitemap">
                <iframe width="100%" height="525px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=<?php echo str_replace(",", "", str_replace(" ", "+", $this->config->item('address'))); ?>&aq=0&ie=UTF8&hq=&hnear=<?php echo str_replace(",", "", str_replace(" ", "+", $this->config->item('address'))); ?>&t=m&ll=,&z=12&iwloc=&output=embed"></iframe>
            </div>
        </div>
        <!--------------------------- Form Part ----------------------------------->
        <div class="col-md-8">
            <div class="contact-address">
                <h1><?php echo $this->lang->line('contact_fill_form') ?></h1>
                <p><?php echo $this->lang->line('contact_fill_form_overview') ?></p>
                <div class="global_gap"></div>
                <?php echo $template['partials']['flash_messages'] ?>
                <div class="contact-form">
                    <?php echo form_open('contact/sentmail'); ?>
                    <?php
                    $contact = $this->session->userdata('contact_data');
                    ?>
                    <ul>
                        <li>
                            <label> <?php echo $this->lang->line('common_name') ?> :</label>
                            <input type="text" onfocus="" class="contact-input register_input" id="name" name="name" value="<?php isset($contact['name']) ? print $contact['name'] : print''; ?>">
                        </li>
                        <li>
                            <label><?php echo $this->lang->line('common_phone_number') ?>:</label>
                            <input type="text" onfocus="" id="phone" name="phone" class="contact-input register_input" value="<?php isset($contact['phone']) ? print $contact['phone'] : print''; ?>">
                        </li>
                        <li>
                            <label><?php echo $this->lang->line('common_email') ?></label>
                            <input type="text" onfocus="" id="email" name="email" class="contact-input register_input" value="<?php isset($contact['email']) ? print $contact['email'] : print''; ?>">
                        </li>
                        <li>
                            <label><?php echo $this->lang->line('common_comments') ?> :</label>
                            <textarea placeholder="<?php echo $this->lang->line('contact_textarea_holder') ?>" id="message" name="message" class="contact-textarea register_input"><?php isset($contact['message']) ? print $contact['message'] : print''; ?></textarea>
                        </li>
                        <li>
                            <label>&nbsp;</label>
                            <input type="submit" value="<?php echo $this->lang->line('common_send') ?>" class="common-btn" name="submit">
                        </li>
                    </ul>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <!-------------------------- End Form Part --------------------------------->
    </div>
</div>
<!-------------------------------------- End Contact Page ----------------------------------->
