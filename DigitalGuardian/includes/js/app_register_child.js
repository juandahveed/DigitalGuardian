/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function ($) {
    $('#submit_child').click(function (event) {
        event.preventDefault();
        var child_first_name = $('#childfirst').val();
        var child_last_name = $('#childlast').val();
        var child_birthday = $('#childbirthday').val();
        var child_gender = $('#childgender').val();
        var child_address = $('#childaddress').val();
        var child_phone = $('#childphone').val();
        var action = 'app_register_child';
        var success = '';
//        var message_text = '';

        if ($('#childfirst').val() === '' || $('#childlast').val() === '' || $('#childbirthday').val() === '' ||
                $('#childgender').val() === '' || $('#childaddress').val() === '' || $('#childphone').val() === '') {
            $('#child_register_helper').text('PLEASE FILL OUT ALL FIELDS');
        }

        $.ajax({
            type: 'POST',
            url: '../../model/dg_ajax.php',
//            dataType: 'json',
           data: { 'first_name' : child_first_name, 'last_name' : child_last_name, 'birthday' : child_birthday,
           'sex' : child_gender, 'address' : child_address, 'phone' : child_phone, 'action' : action, 'success' : success},

            success: function (data) {
                data = jQuery.parseJSON(data);
//@todo add message_text for success to show on page
                if (data.success === 'true') {
                    window.location = '/views/dashboard.php';
                    $('#dash_header').text(data.message_text);
                }
                else {
                    $('#child_register_helper').text('PLEASE FILL OUT ALL FIELDS...');
                    console.log('bad sql', data);
                }
            },
            fail: function (data) {
                console.log(jQuery.parseJSON(data));
            },
            beforeSend: function () {
                $('#child_register_helper').text('Loading....');
            }
        });
        return false;

    });
});

