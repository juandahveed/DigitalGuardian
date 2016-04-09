<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../model/dg_app.php';
//@todo rooms table needs to be created with matching keys to teachers....
//@todo then populate room drop down on assign_teacher.php page
class dg_get_tables extends dg_app {

    public function __construct() {
        parent::__construct();
    }

    public function get_tables() {

        $db = self::connect();

        //check connection
        if (!$db) {
            die('Connection Failed: ' . mysqli_connect_error());
        }

//        set up variable to grab teachers
        $tables_available = '';

        // create query to run on database
        $qry = $db->prepare("select table_name from information_schema.tables where table_schema='church'");

//     bind the parameters to the query
//     no query string with parameters to bind

        $qry->execute();
        $result = $qry->fetchAll(PDO::FETCH_ASSOC);

        //begin drop down
        $tables_available .= '<select id="tables_dropdown">';

        if (count($result) > 0) {
            foreach ($result as $row) {
                $tables_available .= " <option value=\"" . $row["table_name"] . "\">" . $row["table_name"] . "</option>";
            }
        }

        // end drop down
        $tables_available .= '</select>';

        // close the connection
        $db = null;

        echo $tables_available;
    }

}

$dg_get_tables_obj = new dg_get_tables();
