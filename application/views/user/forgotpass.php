<!-------------------------------------- Contact Page --------------------------------------->
<style  type="text/css">

    .errorMessage
    {
        color:#FF0000; font-size:12px; font-weight:normal; text-align:center; font-family:'trebuchet ms';
    }
    .successMessage
    {
        color:#33AC00; font-size:12px; font-weight:normal; text-align:center; font-family:'trebuchet ms';
    }



</style>
<div class="container contactbg">
    <div class="row">
        <h1>Forgotten your password ?</h1>
        <p>Don't worry! Enter the email address you registered with and we will email you a link that will allow you to reset your password.</p>
        <?php
        $forgotmsg = $this->session->userdata("forgotMessage");
        if ($forgotmsg && $error == '0') {
            echo $forgotmsg;
        }
        else {
            if ($error == '1')
                echo $forgotmsg;
        }
        ?>
        <div class="global_gap"> </div>
        <div class="contact-form">
            <form action="" method="post" name="forgetform" id="forgetform" onSubmit="return ValidateQuoteForm();">
                <ul>
                    <li>
                        <label>Recovery Email :</label>
                        <input type="text" class="contact-input register_input" id="uname" name="u_name"  placeholder="Email" />
                    </li>
                    <li>
                        <label>&nbsp;</label>
                        <input type="submit" class="common-btn" value="Send Email"/>

                    </li>
                </ul>
            </form>

        </div>
    </div>
</div>
<script>
    function ValidateQuoteForm()

    {
        var reg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
        if (reg.test(document.forgetform.uname.value) == false)
        {
            alert("<?php echo $this->lang->line('empty_email'); ?>");
            document.forgetform.uname.focus();
            return false;
        }
        return true;
    }

</script>
<!-------------------------------------- End Contact Page ----------------------------------->
