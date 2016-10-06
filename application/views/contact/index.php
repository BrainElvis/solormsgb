<!-------------------------------------- Contact Page --------------------------------------->
  <div class="container contactbg">
      <div class="row">
          <div class="col-md-4">
              <h1>Contact Address</h1>
              <p> <?php isset($address) && $address!==''? print $address:'xxx xxx xxxx';?>
                  <br/>
                  Phone : <?php isset($phone) && $phone!==''? print $phone:'xxx xxx xxxx';?>
                  Email : <?php isset($email) && $email!==''? print $email:'xxxxxxxxxx';?>
              </p>
              <div class="sitemap">
                  <iframe width="100%" height="575px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=<?php echo str_replace(",", "", str_replace(" ", "+", $address)); ?>&aq=0&ie=UTF8&hq=&hnear=<?php echo str_replace(",", "", str_replace(" ", "+", $address)); ?>&t=m&ll=,&z=12&iwloc=&output=embed"></iframe>
              </div>
          </div>
          <!--------------------------- Form Part ----------------------------------->
        <div class="col-md-8">
            <div class="contact-address">
                <h1>Contact</h1>
                <p>something</p>
                <div class="global_gap"></div>
                <div class="global_gap"></div>
                <div class="contact-form">
                  <form enctype="multipart/form-data" method="post" action="">
                    <ul>
                        <li>
                          <label>Name :</label>
                          <input type="text" onfocus="" class="contact-input register_input" id="name" name="name">
                        </li>
                        <li>
                          <label>Telephone No :</label>
                          <input type="text" onfocus="" id="phone" name="phone" class="contact-input register_input">
                        </li>
                        <li>
                          <label>Email Address :</label>
                          <input type="text" onfocus="" id="email" name="email" class="contact-input register_input">
                        </li>
                        <li>
                         <label>Comments :</label>
                         <textarea placeholder="Write your comments..." id="message" name="message" class="contact-textarea register_input"></textarea>
                        </li>
                        <li>
                            <label>&nbsp;</label>
                            <input type="submit" onclick=" return checkmail(this.form.email);" value="Send" class="common-btn" name="submit">
                        </li>
                    </ul>
                  </form>
                </div>
            </div>
        </div>
          <!-------------------------- End Form Part --------------------------------->
      </div>
  </div>
<!-------------------------------------- End Contact Page ----------------------------------->
