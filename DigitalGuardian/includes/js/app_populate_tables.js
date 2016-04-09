/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function ($) {
    $('#populate_tables').click(function (event) {
        event.preventDefault();
        var success = '';
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
            data: {'success': success, 'action': action},
            beforeSend: function () {
                $('.bad_login').text('Loading....');
            }

        }).done(function (data) {
            //console.log(jQuery.parseJSON(data));
            data = jQuery.parseJSON(data);
            // grab all the objects returned
            jQuery.each(data, function (key, value) {
                // get the keys for each object returned
//                jQuery.each(value, function (key, value) {
//                    console.log(key);
//                });
                console.log(value);
            });
            console.log(data[0]);
            columns_set_up = {};
            jQuery.each(data[0], function(key, value){
//                console.log('title : ' + key);
//                console.log('field : ' + value);
                columns_set_up.title = key;
                columns_set_up.field = value;
//                columns_set_up.push(title: 'key', field: 'value');
            });
            console.log(columns_set_up);
//            set_columns = jQuery.parseJSON(columns_set_up);

            if (data) {
                console.log('success');
                $(function () {
                    $('#table').bootstrapTable({
                        columns: columns_set_up,
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