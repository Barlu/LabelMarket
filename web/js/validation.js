/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var EMPTY = 'EMPTY';
var FORMAT = 'INCORRECT_FORMAT';
var EXISTS = 'ALREADY_EXISTS';
var SUCCESS = 'OK';

function checkUsername() {

}

var Validator = (function() {
    return $('#form').validate({
        rules: {
            username: {
                required: true,
                checkUnique: true
            },
            email: {
                required: true,
                email: false,
                emailCustom: true,
                checkUnique: true,
                
            },
            password: {
                required: true,
                checkPassword: true
            },
            passwordRepeat: {
                required: true,
                equalTo: '#password'
            }
        },
        messages: {
            username: {
                required: "Please specify your username",
                checkUnique: "This username has already been taken"
            },
            email: {
                required: "Please specify your email address",
                emailCustom: "Your email address must be in the format of name@domain.com",
                checkUnique: "This email address is already registered with us"
            },
            password: {
                required: "Please enter a password",
                checkPassword: "Please ensure your password has atleast 1 letter, 1 number and is 8 - 16 characters long"
            },
            passwordRepeat: {
                required: "Please confirm your password",
                equalTo: "Please make sure your passwords match"
            }
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            if ($(element).data('bs.tooltip')) {
                $(element).data('bs.tooltip').options.title = error.text();
                $(element).tooltip('show');
            } else {
                $(element).tooltip({
                    placement: 'top',
                    title: error.text(),
                    container: 'body',
                    trigger: 'manual hover'
                }).tooltip('show');
            }
        },
        success: function(label, element) {
            $(element).tooltip('destroy');
        },
        highlight: function(element) {
            $('#' + element.id + ' + .glyphicon').removeClass('glyphicon-ok').addClass('glyphicon-remove');
            $('#' + element.id).parent().removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element) {
            $('#' + element.id + ' + .glyphicon').removeClass('glyphicon-remove').addClass('glyphicon-ok');
            $('#' + element.id).parent().removeClass('has-error').addClass('has-success');
        },
        onkeyup: false
    });
})();

$.validator.addMethod('checkUnique', function(value, element) {
    if (element.id === 'email') {
        var email = value;

        return $.ajax({
            url: '../page/registration-ajax.php',
            type: "GET",
            data: {
                'email': email,
                'exists': EXISTS,
                'success': SUCCESS
            },
            dataType: 'json'
        })
                .done(function(data) {
                    if (data.response === SUCCESS) {
                        return true;
                    } else {
                        return false;
                    }
                });

    } else if (element.id === 'username') {
        var username = value;
        return $.ajax({
            url: '../page/registration-ajax.php',
            type: "GET",
            data: {
                'username': username,
                'exists': EXISTS,
                'success': SUCCESS
            },
            dataType: 'json'
        })
                .done(function(data) {
                    if (data.response === SUCCESS) {
                        return true;
                    } else {
                        return false;
                    }
                });
    }
});

$.validator.addMethod('emailCustom', function(email) {
    var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex.test(email);
});

$.validator.addMethod('checkPassword', function(password) {
    var regex = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,15})$/;
    console.log(regex);
    return regex.test(password);
});
