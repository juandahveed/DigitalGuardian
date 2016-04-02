<?php require 'header.php'; ?>
<?php
// if (!isset($_COOKIE['user'])){
//session_start();
//print_r($_SESSION);
//if (!isset($_SESSION['username'])) {
//    header('Location: /ChurchCheckIn');
//}
?>
<div class="container-fluid home_header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1 class="text_white" id="teacher_helper">
                    CREATE A TEACHER!!!!!
                </h1>
            </div>
            <div class="col-xs-12 col-sm-4 col-sm-offset-4">
                <form class="text_white" method="post" action="">
                    <div class="form-group">
                        <label for="teacherfirst">Teacher First Name:</label>
                        <input name="teacher_first_name" type="text" class="form-control" id="teacherfirst" placeholder="Teacher First Name">
                    </div>
                    <div class="form-group">
                        <label for="teacherlast">Teacher Last Name:</label>
                        <input name="teacher_last_name" type="text" class="form-control" id="teacherlast" placeholder="Teacher Last Name">
                    </div>
                    <div class="form-group">
                        <label for="teacherbirthday">Birthday:</label>
                        <input name="teacher_birthday" type="text" class="form-control" id="teacherbirthday" placeholder="Birthday">
                    </div>
                    <div class="form-group">
                        <label for="teachergender">Gender:</label>
                        <input name="teacher_gender" type="text" class="form-control" id="teachergender" placeholder="Gender">
                    </div>
                    <div class="form-group">
                        <label for="teacheraddress">Address:</label>
                        <input name="teacher_address" type="text" class="form-control" id="teacheraddress" placeholder="Address">
                    </div>
                    <div class="form-group">
                        <label for="teacherphone">Phone:</label>
                        <input name="teacher_phone" type="text" class="form-control" id="teacherphone" placeholder="Phone">
                    </div>
                    <button type="submit" class="btn btn-default" id="submit_teacher" name="login">Create Teacher</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require 'footer.php';
