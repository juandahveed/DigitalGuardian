/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function ($) {
    $('#add_teacher_to_room').click(function (event) {
        event.preventDefault();
        var current_room = $('#rooms_dropdown').val();
        var current_teacher = $('#teachers_dropdown').val();
        var action = 'app_assign_teacher_to_room';
        var success = '';
        var message_text = '';
        
//        console.log(current_room + current_teacher);

//        i don't believe i can validate a drop down list ???
//
        $.ajax({
            type: 'POST',
            url: '../../model/dg_ajax.php',
//            dataType: 'json',
           data: { 'current_room' : current_room, 'current_teacher' : current_teacher,  'success': success, 
               'action' : action, 'message_text': message_text},

            beforeSend: function () {
                $('#assign_teacher_header').text('Loading....');
            }
        }).done(function (data) {
//                    console.log(jQuery.parseJSON(data));
                    data = jQuery.parseJSON(data);

                    if (data.success === 'true') {
                        window.location = '/views/dashboard.php';
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

