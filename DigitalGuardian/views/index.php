<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php require 'header.php'; ?>

<div class="container-fluid home_header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1 class="text_white bad_login">
                    Log In Please
                </h1>
            </div>
            <div class="col-xs-12 col-sm-4 col-sm-offset-4">
                <form class="text_white" method="post" action=" <?php $this->load->model('login'); ?> ">
                    <div class="form-group">
                        <label for="username">User Name:</label>
                        <input name="username" type="text" class="form-control" id="username" placeholder="User Name">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-default" id="login" name="login">Log In</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'footer.php';