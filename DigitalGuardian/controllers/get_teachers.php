<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../model/dg_app.php';

class dg_get_teachers extends dg_app {

    public function __construct() {
        parent::__construct();
    }

    public function get_teachers() {

        $db = self::connect();

        //check connection
        if (!$db) {
            die('Connection Failed: ' . mysqli_connect_error());
        }

//        set up variable to grab teachers
        $teachers_available = '';

        // create query to run on database
        $qry = $db->prepare("SELECT * FROM teacher");

//     bind the parameters to the query
//     no query string with parameters to bind

        $qry->execute();
        $result = $qry->fetchAll(PDO::FETCH_ASSOC);

        //begin drop down
        $teachers_available .= '<select id="teachers_dropdown">';

        if (count($result) > 0) {
            foreach ($result as $row) {
                $teachers_available .= " <option value=\"" . $row["first_name"] . "\">" . $row["first_name"] . "</option>";
            }
        }

        // end drop down
        $teachers_available .= '</select>';

        // close the connection
        $db = null;

        echo $teachers_available;
    }

}

$dg_get_teachers_obj = new dg_get_teachers();
