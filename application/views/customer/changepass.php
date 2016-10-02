<div class="container">
    <div class="row accountbg">
        <?php $this->load->view('customer/subviews/nav') ?>
        <div class="col-md-9">
            <div class="content-innerspan2">
                <div class="innercommon-right">
                    <h1>Change Password</h1>
                    <div class="innercommon-right-content">
                        <span class="errorMessage"></span>
                        <form onsubmit="return validation();" id="edit" name="edit" enctype="multipart/form-data" method="post" action="">
                            <div style="border:none;" class="element1">
                                <div class="content-area">
                                    <div class="left">
                                        <div class="left-text">Current Password :</div>
                                    </div>
                                    <div class="right">
                                        <div>
                                            <input class="input1" id="currentpass" name="currentpass" type="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="content-area">
                                    <div class="left">
                                        <div class="left-text">New Password :</div>
                                    </div>
                                    <div class="right">
                                        <div>
                                            <input class="input1" id="newpass" name="newpass" type="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="content-area">
                                    <div class="left">
                                        <div class="left-text">Retype New Password :</div>
                                    </div>
                                    <div class="right">
                                        <div>
                                            <input class="input1" id="renewpass" name="renewpass" type="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="content-area">
                                    <div class="left">
                                        <div class="left-text">&nbsp;</div>
                                    </div>
                                    <div class="right">
                                        <div>
                                            <input onclick="return validation();" value="Update" class="common-btn cngbtn" name="submit" type="submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
