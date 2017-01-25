/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* #####################################################################
 #
 #   Project       : Modal Login with jQuery Effects
 #   Author        : Rodrigo Amarante (rodrigockamarante)
 #   Version       : 1.0
 #   Created       : 07/29/2015
 #   Last Change   : 08/04/2015
 #
 ##################################################################### */

$(function () {

    var $formLogin = $('#login-form');
    var $formLost = $('#lost-form');
    var $formRegister = $('#register-form');
    var $divForms = $('#div-forms');
    var $modalAnimateTime = 300;
    var $msgAnimateTime = 150;
    var $msgShowTime = 2000;

   
    $("form").submit(function () {
        switch (this.id) {
            case "login-form":
             //   var $lg_username = $('#login_username').val();
               // var $lg_password = $('#login_password').val();
                var data = $("#login-form").serialize();
                $.ajax({

                    type: 'POST',
                    url:  'http://www.idreamias.com/authentication/User_Authentication/customLogin',
                    data: data,
                    crossDomain:true,
                    beforeSend: function ()
                    {
                       // $("#error").fadeOut();
                        $("#button-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
                    },
                    success: function (response)
                    {
                        if (response == "ok") {

                            $("#button-login").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing In ...');
                            setTimeout(' window.location.href = "http://idreamias.com/"; ', 4000);
                        } else {

                            /*$("#error").fadeIn(1000, function () {
                                $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
                                $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                            });*/
                            
                              msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "error", "glyphicon-remove", response);
                              $("#button-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                        }
                    }
                });
               
                return false;
                break;
            case "lost-form":
                 var data = $("#lost-form").serialize();
                
                $.ajax({
                  type: 'POST',
                    url:  'http://www.idreamias.com/authentication/User_Authentication/forgotpasswordform',
                    data: data,
                    beforeSend: function ()
                    {
                           $("#lost_pass").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
                    },
                    success: function (response)
                    {
                    if (response == "ok") 
                        msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "success", "glyphicon-ok", "Check Your Email");
                    else{
                       msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "error", "glyphicon-remove", response); 
                       $("#lost_pass").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Reset Password');
                       }
                   
                   }
               });
                   return false;
                   break;  
                
               
            case "register-form":
               var data = $("#register-form").serialize();
                
                $.ajax({
                    type: 'POST',
                    url:  'http://www.idreamias.com/authentication/CustomUser/register',
                    data: data,
                    beforeSend: function ()
                    {
                           $("#register_submit").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
                    },
                    success: function (response)
                    {
                    if (response == "ok") {
                       msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "success", "glyphicon-ok", "Please check your email to Complete Registration");
                       $("#register_submit").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Check Your Mail');
                       }
                    else {
                        msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", response);
                        $("#register_submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Register');
                        }
                   }
               });
                   return false;
                   break;  
               
            default:
                return false;
        }
        return false;
    });

    $('#login_register_btn').click(function () {
        modalAnimate($formLogin, $formRegister)
    });
    $('#register_login_btn').click(function () {
        modalAnimate($formRegister, $formLogin);
    });
    $('#login_lost_btn').click(function () {
        modalAnimate($formLogin, $formLost);
    });
    $('#lost_login_btn').click(function () {
        modalAnimate($formLost, $formLogin);
    });
    $('#lost_register_btn').click(function () {
        modalAnimate($formLost, $formRegister);
    });
    $('#register_lost_btn').click(function () {
        modalAnimate($formRegister, $formLost);
    });

    function modalAnimate($oldForm, $newForm) {
        var $oldH = $oldForm.height();
        var $newH = $newForm.height();
        $divForms.css("height", $oldH);
        $oldForm.fadeToggle($modalAnimateTime, function () {
            $divForms.animate({height: $newH}, $modalAnimateTime, function () {
                $newForm.fadeToggle($modalAnimateTime);
            });
        });
    }

    function msgFade($msgId, $msgText) {
        $msgId.fadeOut($msgAnimateTime, function () {
            $(this).text($msgText).fadeIn($msgAnimateTime);
        });
    }

    function msgChange($divTag, $iconTag, $textTag, $divClass, $iconClass, $msgText) {
        var $msgOld = $divTag.text();
        msgFade($textTag, $msgText);
        $divTag.addClass($divClass);
        $iconTag.removeClass("glyphicon-chevron-right");
        $iconTag.addClass($iconClass + " " + $divClass);
        setTimeout(function () {
            msgFade($textTag, $msgOld);
            $divTag.removeClass($divClass);
            $iconTag.addClass("glyphicon-chevron-right");
            $iconTag.removeClass($iconClass + " " + $divClass);
        }, $msgShowTime);
    }
});

