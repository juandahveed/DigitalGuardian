<?php require 'header.php';

//if (!isset($_SESSION['username'])) {
//    header('Location: /');
//}
?>
<div class="container-fluid home_header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1 class="text_white" id="child_register_helper">
                    REGISTER YOUR CHILD!!!!!
                </h1>
            </div>
            <div class="col-xs-12 col-sm-4 col-sm-offset-4">
                <form class="text_white" method="post" action="">
                    <div class="form-group">
                        <label for="childfirst">Child First Name:</label>
                        <input name="child_first_name" type="text" class="form-control" id="childfirst" placeholder="Child First Name">
                    </div>
                    <div class="form-group">
                        <label for="childlast">Child Last Name:</label>
                        <input name="child_last_name" type="text" class="form-control" id="childlast" placeholder="Child Last Name">
                    </div>
                    <div class="form-group">
                        <label for="childbirthday">Birthday:</label>
                        <input name="child_birthday" type="text" class="form-control" id="childbirthday" placeholder="Birthday">
                    </div>
                    <div class="form-group">
                        <label for="childgender">Gender:</label>
                        <input name="child_gender" type="text" class="form-control" id="childgender" placeholder="Gender">
                    </div>
                    <div class="form-group">
                        <label for="childaddress">Address:</label>
                        <input name="child_address" type="text" class="form-control" id="childaddress" placeholder="Address">
                    </div>
                    <div class="form-group">
                        <label for="childphone">Phone:</label>
                        <input name="child_phone" type="text" class="form-control" id="childphone" placeholder="Phone">
                    </div>
                    <button type="submit" class="btn btn-default" id="submit_child" name="login">Register Child</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require 'footer.php';
