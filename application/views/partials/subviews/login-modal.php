<div class="modal fade" id="login" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header2">
                <button type="button" class="close2" data-dismiss="modal">&times;</button>
                <h4 class="modal-title2">Login</h4>
            </div>
            <div class="loginmodal-container">
                <h1>Login to Your Account</h1><br>
                <form>
                    <input type="text" placeholder="Username" name="login" id="loginCustEmail">
                    <input type="password" placeholder="Password" name="loginCustPassword" id="loginCustPassword">
                    <input type="hidden" name="isPopup" id="isPopup" value="yes"/>
                    <div class="btn btn-success"  onclick="login();">Login</div>
                </form>
                <div class="login-help">
                    <a href="#" data-toggle="modal" data-target="#registration"><?php echo $this->lang->line('menu_register') ?></a> - <a href="#">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>
</div>