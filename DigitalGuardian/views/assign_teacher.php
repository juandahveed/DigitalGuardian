<?php
require 'header.php';
require '../controllers/get_teachers.php';
//require '../controllers/get_rooms.php';

//if (!isset($_SESSION['username'])) {
//    header('Location: /ChurchCheckIn');
//}
?>

<div class="container-fluid home_header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1 id='assign_teacher_header' class="text_white">
                    Assign A Teacher To A Room
                </h1>
            </div>
            <form method="post" action="">
                <div class="col-xs-12 text-center">
                    <h3 class="text_white">
                        Select A Teacher From The List
                    </h3>
                    <div id='teachers_available'>
                        <?php $dg_get_teachers_obj->get_teachers(); ?>
                    </div>
                </div>
                <div class="col-xs-12 text-center">
                    <h3 class="text_white">
                        Select A Room From The List
                    </h3>
                    <?php // @todo here is where i will use new database populated room info ?>
                    <div id='rooms_available'>
                        <select id="rooms_dropdown">
                            <option value="room_the_crib" name="room_the_crib">
                                The Crib
                            </option>
                            <option value="room_adventure_club" name="room_adventure_club">
                                The Adventure Club
                            </option>
                            <option value="room_the_clubhouse" name="room_the_clubhouse">
                                The Club House
                            </option>
                        </select>
                    </div>
                </div>
            </form>
            <div class="col-xs-12 text-center">
                <button id="add_teacher_to_room" class="btn btn-default">Assign Teacher To Room</button>
            </div>
        </div>
    </div>
</div>
<?php
require 'footer.php';
