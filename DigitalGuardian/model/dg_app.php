<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class dg_app {

    private $error = false;
    private $is_new_session = false;

    public function __construct() {
        return $this;
    }

    public function get_error() {
        return $this->error;
    }

    public function set_error($error) {
        $this->error = $error;
        return $this;
    }

    public static function connect() {
        $connect_username = 'root';
        $connect_password = 'root';
        $dsn = 'mysql:dbname=church;host=localhost;port=3306';
        static $db = '';

        try {

            $db = new PDO($dsn, $connect_username, $connect_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {

            die('Could not connect to the database:<br />' . $e);
        }
        return $db;
    }

    public function login($postVars) {

        $db = self::connect();

        //check connection
        if (!$db) {
            die('Connection Failed: ' . mysqli_connect_error());
        }


        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // grab form fields and save as php variables
            $username = '';
            $password = '';

            if (isset($postVars['password'])) {
                $password = $postVars['password'];
            } else {
                $password = null;
            }

            if (isset($postVars['username'])) {
                $username = $postVars['username'];
            } else {
                $username = null;
            }

            // create query to run on database
            $qry = $db->prepare("SELECT username, password FROM user WHERE username=:username AND password=:password");

            //bind the parameters to the query
            $qry->bindParam(':username', $username, PDO::PARAM_STR, 5);
            $qry->bindParam(':password', $password, PDO::PARAM_STR, 5);

            $qry->execute();

            $result = $qry->fetchAll();

            // check to see if it is only 1 match and then save that information to the session for later use and redirect to dashboard.php
            if (count($result) === 1) {
//                    session_start();
                $_SESSION['username'] = $username;

                $response = array('username' => $username, 'password' => $password, 'success' => 'login');
                echo json_encode($response);
            } else {
                $response = array('success' => 'error');
                echo json_encode($response);
            }
            // close the connection
            $db = null;
        }
    }

    public function register_child($postVars) {
//        @todo add message text for success return to change on page header

        $db = self::connect();

        //check connection
        if (!$db) {
            die('Connection Failed: ' . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            $response = new stdClass();

            if (isset($_POST['first_name'])) {
                $response->first_name = $_POST['first_name'];
            } else {
                $response->first_name = null;
            }

            if (isset($_POST['last_name'])) {
                $response->last_name = $_POST['last_name'];
            } else {
                $response->last_name = null;
            }

            if (isset($_POST['birthday'])) {
                $response->birthday = date('Y-m-d', strtotime($_POST['birthday']));
            } else {
                $response->birthday = null;
            }

            if (isset($_POST['sex'])) {
                $response->sex = $_POST['sex'];
            } else {
                $response->sex = null;
            }

            if (isset($_POST['address'])) {
                $response->address = $_POST['address'];
            } else {
                $response->address = null;
            }

            if (isset($_POST['phone'])) {
                $response->phone = $_POST['phone'];
            } else {
                $response->phone = null;
            }

            if (isset($_POST['success'])) {
                $response->success = $_POST['success'];
            } else {
                $response->success = null;
            }
        }

        // create query to run on database
        $qry = $db->prepare("INSERT INTO children (first_name, last_name, birthday, sex, address, phone) "
                . "VALUES('" . $response->first_name . "', '" . $response->last_name . "', '" . $response->birthday . "', '"
                . $response->sex . "', '" . $response->address . "', '" . $response->phone . "')");

        //bind the parameters to the query
        $qry->bindParam(':first_name', $response->first_name, PDO::PARAM_STR, 25);
        $qry->bindParam(':last_name', $response->last_name, PDO::PARAM_STR, 25);
        $qry->bindParam(':birthday', $response->birthday, PDO::PARAM_STR, 25);
        $qry->bindParam(':sex', $response->sex, PDO::PARAM_STR, 6);
        $qry->bindParam(':address', $response->address, PDO::PARAM_STR, 50);
        $qry->bindParam(':phone', $response->phone, PDO::PARAM_STR, 15);

//        $qry->execute();

        if ($qry->execute()) {
            $response->success = 'true';
            $response->message_text = 'Thanks For Registering!';
            echo json_encode($response);
        } else {
            echo 'Query Unsuccessful';
        }

        // close the connection
        $db = null;
    }

    public function create_teacher() {
        $db = self::connect();

        //check connection
        if (!$db) {
            die('Connection Failed: ' . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $response = new stdClass();


            if (isset($_POST['first_name'])) {
                $response->teacher_first_name = $_POST['first_name'];
            } else {
                $response->teacher_first_name = null;
            }

            if (isset($_POST['last_name'])) {
                $response->teacher_last_name = $_POST['last_name'];
            } else {
                $response->teacher_last_name = null;
            }

            if (isset($_POST['birthday'])) {
                $response->teacher_birthday = date('Y-m-d', strtotime($_POST['birthday']));
            } else {
                $response->teacher_birthday = null;
            }

            if (isset($_POST['sex'])) {
                $response->teacher_gender = $_POST['sex'];
            } else {
                $response->teacher_gender = null;
            }

            if (isset($_POST['address'])) {
                $response->teacher_address = $_POST['address'];
            } else {
                $response->teacher_address = null;
            }

            if (isset($_POST['phone'])) {
                $response->teacher_phone = $_POST['phone'];
            } else {
                $response->teacher_phone = null;
            }

            if (isset($_POST['success'])) {
                $response->success = $_POST['success'];
            } else {
                $response->success = null;
            }

            // create query to run on database
            $qry = $db->prepare("INSERT INTO teacher (first_name, last_name, birthday, sex, address, phone) "
                    . "VALUES('" . $response->teacher_first_name . "', '" . $response->teacher_last_name . "', '" . $response->teacher_birthday . "', "
                    . "'" . $response->teacher_gender . "', '" . $response->teacher_address . "', '" . $response->teacher_phone . "')");

            //bind the parameters to the query
            $qry->bindParam(':first_name', $response->first_name, PDO::PARAM_STR, 25);
            $qry->bindParam(':last_name', $response->last_name, PDO::PARAM_STR, 25);
            $qry->bindParam(':birthday', $response->birthday, PDO::PARAM_STR, 25);
            $qry->bindParam(':sex', $response->sex, PDO::PARAM_STR, 6);
            $qry->bindParam(':address', $response->address, PDO::PARAM_STR, 50);
            $qry->bindParam(':phone', $response->phone, PDO::PARAM_STR, 15);

//        $qry->execute();

            if ($qry->execute()) {
                $response->success = 'true';
                $response->message_text = 'Thanks For Creating A Teacher!';
                echo json_encode($response);
            } else {
                echo 'Query Unsuccessful';
            }

            // close the connection
            $db = null;
        }
    }

    public function assign_teacher_to_room() {
        $db = self::connect();

        //check connection
        if (!$db) {
            die('Connection Failed: ' . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $response = new stdClass();
//            $responseUpdate = new stdClass();

            if (isset($_POST['current_teacher'])) {
                $response->current_teacher = $_POST['current_teacher'];
            } else {
                $response->current_teacher = null;
            }

            if (isset($_POST['current_room'])) {
                $response->current_room = $_POST['current_room'];
            } else {
                $response->current_room = null;
            }

            $timezone = -5; //(GMT -5:00) EST (U.S. & Canada)

            if (isset($_POST) && !empty($_POST)) {
                $timestamp = gmdate("Y/m/j H:i:s", time() + 3600 * ($timezone + date("I")));
            } else {
                $timestamp = null;
            }

            // create query to run on database
            $qry = $db->prepare("INSERT INTO $response->current_room (person, timestamp) VALUES('" . $response->current_teacher . "', "
                    . "'" . $timestamp . "')");
//            @todo only adventure club room query works, need to finish other rooms in the database
//                    and start adding families with kids as one, then separation and flags for active will take place
//                    
            //bind the parameters to the query
            $qry->bindParam(':current_room', $response->current_room, PDO::PARAM_STR, 50);
            $qry->bindParam(':current_teacher', $response->current_teacher, PDO::PARAM_STR, 50);
            $qry->bindParam(':timestamp', $timestamp, PDO::PARAM_STR, 50);


            if ($qry->execute()) {
                $response->success = 'true';
                $response->message_text = 'Thanks For Assigning A Teacher!';
                echo json_encode($response);
            } else {
                echo 'Query Unsuccessful';
            }

//            $qryUpdate = $db->prepare("UPDATE teacher SET status='active' WHERE first_name='" . $response->current_teacher . "'");
////                bind second query parameters
//            $qryUpdate->bindParam(':current_teacher', $response->current_teacher, PDO::PARAM_STR, 50);
//            
//            if ($qryUpdate->execute()) {
//                $responseUpdate->success = 'true';
//                $responseUpdate->message_text = 'Thanks For Updating Teacher!';
//                echo json_encode($responseUpdate);
//            } else {
//                echo 'Query Unsuccessful, Couldn\'t Update Teacher Status';
//            }

//            @todo I NEED A SECOND QUERY TO UPDATE TEACHER STATUS TO ACTIVE
//            
//        $message_text = 'You have added ' . $teacher_first_name . ' successfully';
//        $response = array('teacher_first_name' => $teacher_first_name, 'teacher_last_name' => $teacher_last_name, 
//            'teacher_birthday' => $teacher_birthday, 'teacher_gender' => $teacher_gender, 'teacher_address' => $teacher_address, 
//            'teacher_phone' => $teacher_phone, 'success' => 'true', 'message_text' => 'You have added ' . $teacher_first_name . ' successfully');
//                $response = array('success' => 'true', 'message_text' => $message_text);
////        var_dump($result);
            // close the connection
            $db = null;
        }
    }
    
    public function populate_tables() {
        $db = self::connect();

        //check connection
        if (!$db) {
            die('Connection Failed: ' . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $response = new stdClass();
            
            if (isset($_POST['current_table'])) {
                $response->current_table = $_POST['current_table'];
            } else {
                $response->current_table = null;
            }

            // create query to run on database
            $qry = $db->prepare("SELECT * FROM $response->current_table");

            //bind the parameters to the query
            $qry->bindParam(':current_table', $response->current_table, PDO::PARAM_STR, 40);
//            $qry->bindParam(':last_name', $response->last_name, PDO::PARAM_STR, 25);
//            $qry->bindParam(':birthday', $response->birthday, PDO::PARAM_STR, 25);
//            $qry->bindParam(':sex', $response->sex, PDO::PARAM_STR, 6);
//            $qry->bindParam(':address', $response->address, PDO::PARAM_STR, 50);
//            $qry->bindParam(':phone', $response->phone, PDO::PARAM_STR, 15);

        $qry->execute();
        $response = $qry->fetchAll(PDO::FETCH_OBJ);
//        $response->success="true";
//        echo json_encode($response);
        echo json_encode($response);

//            if ($qry->execute()) {
//                $response->success = 'true';
//                $response->message_text = 'Thanks For Creating A Teacher!';
//                echo json_encode($response);
//            } else {
//                echo 'Query Unsuccessful';
//            }

            // close the connection
            $db = null;
        }
    }

}
