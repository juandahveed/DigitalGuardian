/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function ($) {
    $('#submit_teacher').click(function (event) {
        event.preventDefault();
        var teacher_first_name = $('#teacherfirst').val();
        var teacher_last_name = $('#teacherlast').val();
        var teacher_birthday = $('#teacherbirthday').val();
        var teacher_gender = $('#teachergender').val();
        var teacher_address = $('#teacheraddress').val();
        var teacher_phone = $('#teacherphone').val();
        var success = '';


        if ($('#teacherfirst').val() === '' || $('#teacherlast').val() === '' || $('#teacherbirthday').val() === '' ||
                $('#teachergender').val() === '' || $('#teacheraddress').val() === '' || $('#teacherphone').val() === '') {
            $('#teacher_helper').text('PLEASE FILL OUT ALL FIELDS');
        }

        $.ajax({
            type: 'POST',
            url: '/ChurchCheckIn/create_teacher_mysql.php',
//            dataType: 'json',
           data: { 'first_name' : teacher_first_name, 'last_name' : teacher_last_name, 'birthday' : teacher_birthday,
           'sex' : teacher_gender, 'address' : teacher_address, 'phone' : teacher_phone, 'success': success},
//            data: {'success': success, 'message_text': message_text, 'child_first_name': child_first_name},
            success: function (data) {
                data = jQuery.parseJSON(data);

                if (data.success === 'true') {
                    window.location = '/ChurchCheckIn/dashboard.php';
                    $('#dash_header').text(data.message_text);
                }
                else {
                    $('#teacher_helper').text('PLEASE FILL OUT ALL FIELDS...');
                    console.log('bad sql', data);
                }
            },
            fail: function (data) {
                console.log(jQuery.parseJSON(data));
            },
            beforeSend: function () {
                $('#teacher_helper').text('Loading....');
            }
        });
        return false;

    });
});

