<!-------------------------------------- Contact Page --------------------------------------->
  <div class="container contactbg">
      <div class="row">
          <div class="col-md-4">
              <h1>Contact Address</h1>
              <p>
                  389 Pethybridge Road,
                  Ely,
                  CF5 4DR,
                  Cardiff
                  Phone : 02920 600 47XX
                  Email : info@ieat.ie
              </p>
              <div class="sitemap">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d29203.94347007159!2d90.4149573!3d23.8010644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1467212566367" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
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
