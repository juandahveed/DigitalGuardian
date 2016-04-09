<?php
require 'header.php';
require '../controllers/get_tables.php';

//if (!isset($_SESSION['username'])) {
//    header('Location: /');
//}
?>
<div class="container-fluid tables_header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1 class="text_white" id="child_register_helper">
                    SELECT A TABLE TO VIEW/EDIT
                </h1>
                <div id='teachers_available'>
                    <?php $dg_get_tables_obj->get_tables(); ?>
                </div>
                <a href="create_teacher.php" role="button" id="populate_tables" class="btn btn-default">Populate Tables</a>
            </div>
            <div class="col-xs-12">
                <table class="table table-hover" id="table">
<!--                    <thead>
                        <tr>
                            <th data-field="first_name">First Name</th>
                            <th data-field="last_name">Last Name</th>
                            <th data-field="birthday">Birth Day</th>
                            <th data-field="sex">Sex</th>
                            <th data-field="address">Address</th>
                            <th data-field="phone">Phone</th>
                        </tr>
                    </thead>-->
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require 'footer.php';
