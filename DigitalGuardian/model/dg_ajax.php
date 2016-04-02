<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'dg_app.php';

class dg_ajax extends dg_app {

    public function __construct() {
        parent::__construct();
    }

}

if (isset($_POST)) {
    switch ($_POST['action']) {
        case 'app_login':
            $dg_ajax_obj = new dg_ajax();
            $dg_ajax_obj->login($_POST);
            break;
        case 'app_register_child':
            $dg_ajax_obj = new dg_ajax();
            $dg_ajax_obj->register_child($_POST);
            break;
        case 'app_create_teacher':
            $dg_ajax_obj = new dg_ajax;
            $dg_ajax_obj->create_teacher($_POST);
            break;
        default:
            break;
    }
}