jQuery(document).ready(function() {
    if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {

        jQuery(".text-box").focus(function() {
            if (this.value === this.defaultValue) {
                this.value = '';
            }
        }).blur(function() {
            if (this.value === '') {
                this.value = this.defaultValue;
            }
        });

        jQuery('#login-toggle').bind('touchend', function() {
            jQuery('#login-wrapper').slideToggle();
            jQuery('#login-toggle').toggleClass('open-nav');
        });

        jQuery('.overlay-popup-header .login span').bind('touchstart', function() {
            jQuery('.overlay').fadeOut();
            jQuery('#login-wrapper').delay(500).fadeIn();
            jQuery('#login-toggle').addClass('open-nav');
        });

    } else {

        jQuery(".text-box").focus(function() {
            if (this.value === this.defaultValue) {
                this.value = '';
            }
        }).blur(function() {
            if (this.value === '') {
                this.value = this.defaultValue;
            }
        });

        jQuery('#login-toggle').click(function() {
            jQuery('#login-wrapper').slideToggle();
            jQuery('#login-toggle').toggleClass('open-nav');

            if (jQuery('#login-toggle').hasClass('open-nav')) {
                jQuery('#login_arrow').attr('src', base_url + 'assets/images/arrup.png');
            } else {
                jQuery('#login_arrow').attr('src', base_url + 'assets/images/arr.png');
            }
        });

        jQuery('#user-sub-menu').click(function() {

            if (jQuery(".user-sub-menu").is(":hidden")) {
                jQuery('#login_arrow').attr('src', base_url + 'assets/images/arrup.png');
            } else {
                jQuery('#login_arrow').attr('src', base_url + 'assets/images/arr.png');
            }
            jQuery('.user-sub-menu').slideToggle();

        });

        jQuery('.overlay-popup-header .login span').click(function() {
            jQuery('.overlay').fadeOut();
            jQuery('#login-wrapper').delay(500).fadeIn();
            jQuery('#login-toggle').addClass('open-nav');

        });

        jQuery('#password').keydown(function(e) {
            if (e.keyCode == 13) {
                //doLogin();
                pop_up_login();
            }
        });

        jQuery('#username').keydown(function(e) {
            if (e.keyCode == 13) {
                //doLogin();
                pop_up_login();
            }
        });

    }

});
function login() {
    var CustEmail = jQuery('#loginCustEmail').val();
    var CustPassword = jQuery('#loginCustPassword').val();
    var isPopup = jQuery('#isPopup').val();
    if (CustEmail == "" || CustEmail == "Email address") {
        alert('Please enter your email address.');
        jQuery('#CustEmail').focus();
        return;
    }
    if (CustPassword == "" || CustPassword == "Password") {
        alert('Please enter your password.');
        jQuery('#CustPassword').focus();
        return;
    }
    jQuery.post(base_url + "user/login", {
        CustEmail: CustEmail,
        CustPassword: CustPassword,
        isPopup: isPopup,
    }, function(response) {
        if (response != "1") {
            alert(response);
        } else {
            window.location.reload();
        }
    });
}

function mainmenu() {
    "use strict";
    jQuery("#main-menu ul:first li").hover(function() {
        jQuery(this).find('ul:first').stop().fadeIn('slow');
    }, function() {
        jQuery(this).find('ul:first').stop().fadeOut('fast');
    });
}

function applyIso() {
    "use strict";
    jQuery("div.portfolio-container").css({overflow: 'hidden'}).isotope({itemSelector: '.isotope-item'});
}

function animateSkillBars() {
    "use strict";
    var applyViewPort = (jQuery("html").hasClass('csstransforms')) ? ":in-viewport" : "";
    jQuery('.progress' + applyViewPort).each(function() {
        var progressBar = jQuery(this),
                progressValue = progressBar.find('.bar').attr('data-value');

        if (!progressBar.hasClass('animated')) {
            progressBar.addClass('animated');
            progressBar.find('.bar').animate({width: progressValue + "%"}, 600, function() {
                progressBar.find('.bar-text').fadeIn(400);
            });
        }

    });
}

jQuery(document).ready(function() {
    "use strict";
    mainmenu();

    animateSkillBars();

    jQuery(window).scroll(function() {
        animateSkillBars();
    });

    /* Main Menu */
    jQuery("#main-menu ul li:has(ul)").each(function() {
        jQuery(this).addClass("hasSubmenu");
    });

    /* Mibile Nav */
    jQuery('#main-menu > ul').mobileMenu({
        defaultText: 'Navigate to...',
        className: 'mobile-menu',
        subMenuDash: '&ndash;&nbsp;'
    });

});
jQuery(function() {

    jQuery("#create-account-submit").click(function() {
        var CustFirstName = jQuery('#CustFirstName').val();
        var CustLastName = jQuery('#CustLastName').val();
        var CustMobile = jQuery('#CustMobile').val();
        var CustTown = jQuery('#CustTown').val();
        var CustArea = jQuery('#CustArea').val();
        var CustAdd1 = jQuery('#CustAdd1').val();
        var CustPostcode = jQuery('#CustPostcode').val();
        var CustEmail = jQuery('#CustEmail').val();
        var CustPassword = jQuery('#CustPassword').val();
        var confirmPassword = jQuery('#confirmPassword').val();
        var RestId = jQuery('#RestId').val();

        if (CustFirstName == '' || CustFirstName == null) {
            alert('First Name can\'t be empty.');
            jQuery('#CustFirstName').focus();
            return false;
        }
        if (CustLastName == '' || CustLastName == null) {
            alert('Last Name can\'t be empty.');
            jQuery('#CustLastName').focus();
            return false;
        }
        if (CustMobile == '' || CustMobile == null) {
            jQuery('#CustMobile').focus();
            alert('Mobile number can\'t be empty.');
            return false;
        }
        if (CustAdd1 == '' || CustAdd1 == null) {
            jQuery('#CustAdd1').focus();
            alert('Address can\'t be empty.');
            return false;
        }
        if (CustTown == '' || CustTown == null) {
            jQuery('#CustTown').focus();
            alert('City can\'t be empty.');
            return false;
        }
        if (CustArea == '' || CustArea == null) {
            jQuery('#CustArea').focus();
            alert('Area can\'t be empty.');
            return false;
        }
        if (CustPostcode == '' || CustPostcode == null) {
            jQuery('#CustPostcode').focus();
            alert('Postcode can\'t be empty.');
            return false;
        }

        if (CustEmail == '' || CustEmail == null) {
            jQuery('#CustEmail').focus();
            alert('Email can\'t be empty.');
            return false;
        }
        if (CustPassword == '' || CustPassword == null) {
            jQuery('#CustPassword').focus();
            alert('Password can\'t be empty.');
            return false;
        }
        if (confirmPassword == '' || confirmPassword == null) {
            jQuery('#confirmPassword').focus();
            alert('Confirm Password can\'t be empty.');
        }
        if (confirmPassword != CustPassword) {
            jQuery('#confirmPassword').focus();
            alert('Re-enter same password.');
            return false;
        }
        if (!jQuery('#agree_chk').is(':checked')) {
            alert('You must accept the "Privacy Policy" and "Terms and Conditions"');
            jQuery('#agree_chk').focus();
            return false;
        }

        var dataString = 'CustFirstName=' + CustFirstName + '&CustLastName=' + CustLastName + '&CustMobile=' + CustMobile + '&CustTown=' + CustTown + '&CustArea=' + CustArea + '&CustAdd1=' + CustAdd1 + '&CustPostcode=' + CustPostcode + '&CustEmail=' + CustEmail + '&CustPassword=' + CustPassword + '&RestId=' + RestId;

        if (CustFirstName == '' || CustLastName == '' || CustLastName == '' || CustTown == '' || CustArea == '' || CustAdd1 == '' || CustEmail == '' || CustPassword == '' || confirmPassword == '')
        {
            $('.success').fadeOut(200).hide();
        } else
        {
            jQuery.ajax({
                type: "POST",
                url: base_url + "user/registration",
                data: dataString,
                success: function(response) {
                    if (response == 1) {
                        jQuery('.success').hide();
                        jQuery("#registrationFormErrors").hide();
                        jQuery('.success').show(4000, function() {
                            window.location = base_url + "user/success";
                        });
                    } else {
                        jQuery('.success').hide();
                        jQuery("#registrationFormErrors").hide();
                        jQuery("#registrationFormErrors").show(function() {
                            jQuery(this).html(response);
                        });

                    }
                }
            });
        }
        return false;
    });
});

function get_area_list(city_id)
{
    jQuery("#ajaxLoadingCircle").show();
    jQuery.ajax({
        type: "POST",
        url: base_url + "user/get_area_by_city",
        data: "cityid=" + city_id,
        success: function(response) {
            jQuery('#area_container').html(response);
            jQuery("#ajaxLoadingCircle").hide();

        }
    });
}
