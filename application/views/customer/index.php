<div class="container">
    <div class="row" id="content-wrap">
        <div class="col-md-3">
            <div class="content-innerspan1">
                <div class="clientid">
                    <ul>
                        <li>
                            <span class="clientid-img">
                                <img alt="<?php isset($CustFirstName) ? print $CustFirstName : print '' ?>" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>customer/achome-clientimg.png">
                            </span>
                        </li>

                        <li><span class="textgreen"><?php isset($CustLastName) ? print $CustLastName : print '' ?></span></li>
                        <li><span class="textblack">Full Name:</span></li>
                        <li><span class="textblack"><?php (isset($CustFirstName) && isset($CustLastName)) ? print $CustFirstName . '&nbsp;' . $CustLastName : print '' ?></span></li>
                        <li><span class="textblack">Email:</span></li>
                        <li><span class="textblack">» <?php isset($CustEmail) ? print $CustEmail : '' ?></span></li>
                        <li>
                            <span class="textblack">
                                Role : User
                            </span>
                        </li>
                        <li>
                            <span class="textblack">
                                Created At: 
                                <?php ($add_date != '0000-00-00 00:00:00') ? print date('F j, Y H:i:a', strtotime($add_date)) : print '--';?>
                            </span>
                        </li>
                        <li style="margin-top:20px;"><span class="textblack"><a class="green" href="<?php echo base_url() ?>customer/editprofile">Edit Details</a></span></li>
                        <li><span class="textblack"><a class="green" href="<?php echo base_url() ?>customer/changepass">Change Password</a></span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="content-innerspan2">
                <div class="innercommon-right">
                    <h1>Hi! <?php isset($CustLastName) ? print $CustLastName : print $CustFirstName ?></h1>
                    <p>
                        Welcome to <span class="color_green"><?php $this->config->item('website') !== '' ? print$this->config->item('website') : print $this->config->item('company') ?></span> Customer section. Here You can view or update your account information. You can also check your order details and account information. User can save and see his cart and customize template. Address book is also available for <span class="color_green"><?php $this->config->item('website') !== '' ? print $this->config->item('website') : print $this->config->item('company') ?></span> customers. You can sign up for affiliate, check your account balance. All the services are available for our customers.
                    </p>
                </div>
            </div>
            <div class="client-dashboard">
                <h1><?php isset($CustLastName) ? print $CustLastName : print $CustFirstName ?> Account Panel &nbsp;<span class="black">|&nbsp;&nbsp; Your account is &nbsp;<?php $verified == 1 ? print 'Verified' : print 'not verified' ?></span></h1>
                <ul>
                    <li>
                        <a href="<?php echo base_url() ?>customer/profile">
                            <img title="" alt="" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>customer/img-accounthome.png"><br>
                            ACCOUNT INFO
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>customer/orderlist">
                            <img title="" alt="" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>customer/img-orderoverview.png"><br>
                            ORDER OVERVIEW
                        </a>
                    </li>
                    <li style="display: none">
                        <a href="<?php echo base_url() ?>customer/tellurfriend">
                            <img title="" alt="" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>customer/img-tellyourfriend.png"><br>
                            TELL YOUR FRIEND
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url() ?>customer/addressbook">
                            <img title="" alt="" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>customer/img-addressbook.png"><br>
                            ADDRESS BOOK
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>customer/cart">
                            <img title="" alt="" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>customer/img-mycart.png"><br>
                            MY CART
                        </a>
                    </li>
                    <li style="display: none">
                        <a href="<?php echo base_url() ?>customer/custaffiliate">
                            <img title="" alt="" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>customer/img-signupforaffiliate.png"><br>
                            MY AFFILIATE
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>customer/pointshop">
                            <img title="" alt="" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>customer/point-shop.png" width="100" height="100"><br>
                            POINT SHOP
                        </a>
                    </li>
                    <li style="display: none">
                        <a href="<?php echo base_url() ?>customer/favourits">
                            <img title="" alt="" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>customer/img-favoritelist.png"><br>
                            MY FAVORITE LIST
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>customer/profile">
                            <img title="" alt="" src="<?php echo ASSETS_SITE_IMAGE_PATH ?>customer/img-logout.png"><br>
                            LOGOUT
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>