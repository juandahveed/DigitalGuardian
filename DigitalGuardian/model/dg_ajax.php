<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'dg_app.php';

class dg_ajax extends dg_app{
    
    public function __construct(){
        parent::__construct();
    }
}

$dg_ajax_obj = new dg_ajax();
$dg_ajax_obj->connect($_POST);