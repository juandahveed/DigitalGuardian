<?php
require 'header.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: /');
}
?>
<div class="container-fluid home_header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1 id='dash_header' class="text_white">
                    WELCOME TO THE RES LIFE DASHBOARD!!!!!<br />
                    <?php print_r($_SESSION); ?>
                </h1>
            </div>
            <div class="col-xs-12 text-center">
                <h3 class="text_white">
                    First Time Parents Need To Register Their Children
                </h3>
                <!--<button id="register_child" class="btn btn-default">Register Children</button>-->
                <a href="/ChurchCheckIn/inside/register_child.php" role="button" id="register_child" class="btn btn-default">Register Children</a>
            </div>
            <div class="col-xs-12 text-center">
                <h3 class="text_white">
                    Create a Teacher
                </h3>
                <!--<button id="register_child" class="btn btn-default">Register Children</button>-->
                <a href="/ChurchCheckIn/create_teacher.php" role="button" id="create_teacher" class="btn btn-default">Create Teacher</a>
            </div>
            <div class="col-xs-12 text-center">
                <h3 class="text_white">
                    Assign Teacher to a Room
                </h3>
                <!--                <button class="btn btn-default">Check-In Teacher</button>-->
                <a href="/ChurchCheckIn/assign_teacher.php" role="button" id="assign_teacher" class="btn btn-default">Check-In Teacher</a>
            </div>
            <div class="col-xs-12 text-center">
                <h3 class="text_white">
                    Assign Child to a Room
                </h3>
                <button class="btn btn-default">Check-In Child</button>
            </div>
        </div>
    </div>
</div>
<?php
require 'footer.php';
