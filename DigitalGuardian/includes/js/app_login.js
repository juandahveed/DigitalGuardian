/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function ($) {
    $('#login').click(function (event) {
        event.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();
        var success = '';
        var action = 'app_login';

//        does this even matter here? it seems as though php does all the validation ? and it should check for undefined....
        if ($('#username').val() === '' || $('#password').val() === '') {
            $('.bad_login').text('PLEASE ENTER BOTH USERNAME AND PASSWORD');
        }

        $.ajax({
            type: 'POST',
            url: '../../model/dg_ajax.php',
//           dataType: 'json',
//           data: 'username='+username+'&password='+password,
            data: {'username': username, 'password': password, 'success': success, 'action': action},

            beforeSend: function () {
                $('.bad_login').text('Loading....');
            }

        })
                .done(function (data) {
                    console.log(jQuery.parseJSON(data));
                    data = jQuery.parseJSON(data);

                    if (data.success === 'login') {
                        window.location = '/ChurchCheckIn/dashboard.php';
//                   $.cookie('session_name', data, {path: '/'});
                        console.log('if true.... ' + data);
                    }
                    else if (data.success === 'error') {
                        $('.bad_login').text('WRONG USERNAME OR PASSWORD TRY AGAIN PLEASE...');
                        console.log('bad html test for other stuff' + data);
                    }
                    else {

                    }
                });
        return false;
    });
});