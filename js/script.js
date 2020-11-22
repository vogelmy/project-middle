'use strict';

//sign up form

$('#register').on('submit', function () {

    var that = $(this);
    that.find('.error-msg').text('');

    var fname = that.find('#fname').val();
    var email = that.find('#email').val();
    var pass = that.find('#pw').val();

    var validFname = strValidation(fname);
    var validEmail = emailValidation(email);
    
    var validPass = passValidation(pass);
    var flag = true;

    if (!validFname) {
        $('#fname-error').text('The first name is not valid');
        flag = true;
    }

    if (!validEmail) {
        $('#email-error').text('The email is not valid');
        flag = false;
    }

    if (!validPass) {
        $('#pass-error').text('The password is not valid, please enter at least 8 characters (including at least 1 letter, 1 capital letter, and 1 number');
        flag = false;
    }

    return flag;

});


function strValidation(test2) {
    var test1 = test2.trim();
    var pattern = /^[a-zA-Z]+-?[a-zA-Z]+$/;
    return pattern.test(test1);
}

function emailValidation(test2) {
    var test1 = test2.trim();
    //var pattern = /^[a-zA-z0-9.-]+\@[a-zA-z0-9.-]+.[a-zA-Z]+$+\@[a-zA-z0-9.-]+\@[a-zA-z0-9.-]+\@[a-zA-z0-9.-]/;
    var pattern = /^[a-zA-Z0-9.-]+\@[a-zA-z0-9.-]+.[a-zA-Z]+$/;
    return pattern.test(test1);
}

function passValidation(test2) {
    var test1 = test2.trim();
    var pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\S{8,}$/;
    return pattern.test(test1);
}

//}



$(window).on('scroll', function () {

    if ($(document).scrollTop()) {
        $('header').addClass('scrolled');
    } else {
        $('header').removeClass('scrolled');
    }
});

$('.hamburger').on('click', function () {
    $(this).toggleClass('is-active');

});
    