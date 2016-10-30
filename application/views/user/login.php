<!-------------------------------------- Contact Page --------------------------------------->
<div class="container contactbg">
    <div class="row">
        <div class="modal-content">
            <div class="modal-header2">
                <h4 class="modal-title2">Login</h4>
            </div>
            <div class="loginmodal-container">
                <h1>Login to Your Account</h1>
                <?php if (isset($problem)): ?>
                    <p class="text-center" style="color: #FF0000"><?php echo $problem ?></p>
                <?php endif; ?>
                <form method="POST" action="<?php echo site_url('user/login') ?>">
                    <input type="text" placeholder="Username" name="CustEmail" id="loginCustEmail2">
                    <input type="password" placeholder="Password" name="CustPassword" id="loginCustPassword2">
                    <input type="hidden" name="isPopup" id="isPopup" value="no"/>
                    <input class="btn btn-success" type="submit" value="Login">
                </form>
                <div class="login-help">
                    <a href="#" data-toggle="modal" data-target="#registration"><?php echo $this->lang->line('menu_register') ?></a> - <a href="#">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------- End Contact Page ----------------------------------->
