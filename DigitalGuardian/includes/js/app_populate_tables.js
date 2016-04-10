/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function ($) {
    $('#populate_tables').click(function (event) {
        event.preventDefault();
        var success = '';
        var current_table = $('#tables_dropdown').val();
        var action = 'app_populate_tables';

//        does this even matter here? it seems as though php does all the validation ? and it should check for undefined....
//        if ($('#username').val() === '' || $('#password').val() === '') {
//            $('.bad_login').text('PLEASE ENTER BOTH USERNAME AND PASSWORD');
//        }

        $.ajax({
            type: 'POST',
            url: '../../model/dg_ajax.php',
//           dataType: 'json',
//           data: 'username='+username+'&password='+password,
//            data: {'username': username, 'password': password, 'success': success, 'action': action},
            data: {'success': success, 'action': action, 'current_table': current_table},
            beforeSend: function () {
                $('.bad_login').text('Loading....');
            }

        }).done(function (data) {
            //console.log(jQuery.parseJSON(data));
            data = jQuery.parseJSON(data);
            $('#table').bootstrapTable('removeAll');
            // grab all the objects returned
            columns = {};
            columns_array = [];
            
            jQuery.each(data[0], function(key, value){
                title = key;
                columns = { title: title, field : title};
                columns_array.push(columns);
            });
            console.log(columns_array);

            if (data) {
                console.log('success');
                $(function () {
                    $('#table').bootstrapTable({
                        columns: columns_array,
                        data: data
                    });
                });
            }
            else if (data.success === 'error') {
                $('.bad_login').text('WRONG USERNAME OR PASSWORD TRY AGAIN PLEASE...');
                console.log('bad html test for other stuff' + data);
            }
            else {
                console.log('error');
            }
        });
        return false;
    });
});