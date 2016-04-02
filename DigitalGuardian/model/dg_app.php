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

    public function only_connect() {
//        @todo seperate the login and connection
        $connect_username = 'root';
        $connect_password = 'root';
        $dsn = 'mysql:dbname=church;host=localhost;port=3306';

        try {

            $db = new PDO($dsn, $connect_username, $connect_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {

            die('Could not connect to the database:<br />' . $e);
        }
        return $db;
    }

    public function connect($postVars) {
//        @todo seperate the login and connection
        $connect_username = 'root';
        $connect_password = 'root';
        $dsn = 'mysql:dbname=church;host=localhost;port=3306';

        try {

            $db = new PDO($dsn, $connect_username, $connect_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        } catch (PDOException $e) {

            die('Could not connect to the database:<br />' . $e);
        }
    }

    public function register_child($postVars) {
//        @todo add connect only function and let this use the PDO METHOD
//        @todo add message text for success return to change on page header
//        $db = self::only_connect();
//        $connect_username = 'root';
//        $connect_password = 'root';
//        $dsn = 'mysql:dbname=church;host=localhost;port=3306';
//
//        try {
//
//            $db = new PDO($dsn, $connect_username, $connect_password);
//            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        } catch (PDOException $e) {
//
//            die('Could not connect to the database:<br />' . $e);
//        }
//
//        if ($_SERVER["REQUEST_METHOD"] == "POST") {
//
//            $response = new stdClass();
//
//            if (isset($postVars['first_name'])) {
//                $response->first_name = mysqli_real_escape_string($db, $postVars['first_name']);
//            } else {
//                $response->first_name = null;
//            }
//
//            if (isset($postVars['last_name'])) {
//                $response->last_name = mysqli_real_escape_string($db, $postVars['last_name']);
//            } else {
//                $response->last_name = null;
//            }
//
//            if (isset($postVars['birthday'])) {
//                $response->birthday = date('Y-m-d', strtotime($postVars['birthday']));
//                $response->birthday = mysqli_real_escape_string($db, $response->birthday);
//            } else {
//                $response->birthday = null;
//            }
//
//            if (isset($postVars['sex'])) {
//                $response->sex = mysqli_real_escape_string($db, $postVars['sex']);
//            } else {
//                $response->sex = null;
//            }
//
//            if (isset($postVars['address'])) {
//                $response->address = mysqli_real_escape_string($db, $postVars['address']);
//            } else {
//                $response->address = null;
//            }
//
//            if (isset($postVars['phone'])) {
//                $response->phone = mysqli_real_escape_string($db, $postVars['phone']);
//            } else {
//                $response->phone = null;
//            }
//
//            if (isset($postVars['success'])) {
//                $response->success = mysqli_real_escape_string($db, $postVars['success']);
//            } else {
//                $response->success = null;
//            }
//
//            // create query to run on database
//            $qry = $db->prepare("INSERT INTO children (first_name, last_name, birthday, sex, address, phone) "
//                    . "VALUES('" . $response->first_name . "', '" . $response->last_name . "', '" . $response->birthday . "', '"
//                    . $response->sex . "', '" . $response->address . "', '" . $response->phone . "')");
//
//            //bind the parameters to the query
//            $qry->bindParam(':first_name', $response->first_name, PDO::PARAM_STR, 5);
//            $qry->bindParam(':last_name', $response->last_name, PDO::PARAM_STR, 5);
//            $qry->bindParam(':birthday', $response->birthday, PDO::PARAM_STR, 5);
//            $qry->bindParam(':sex', $response->sex, PDO::PARAM_STR, 5);
//            $qry->bindParam(':address', $response->address, PDO::PARAM_STR, 5);
//            $qry->bindParam(':phone', $response->phone, PDO::PARAM_STR, 5);
//
//            $qry->execute();
//
//            switch ($response->success) {
//                case 'true':
//                    echo json_encode($response);
//                    break;
//                default:
//                    break;
//            }
//        }
//
//        // close the connection
//        $db = null;
//    }
        $connect_servername = 'localhost';
        $connect_username = 'root';
        $connect_password = 'root';
        $connect_dbname = 'church';

        //create connection
        $conn = mysqli_connect($connect_servername, $connect_username, $connect_password, $connect_dbname);


        //check connection
        if (!$conn) {
            die('Connection Failed: ' . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            $response = new stdClass();

            if (isset($_POST['first_name'])) {
                $response->first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
            } else {
                $response->first_name = null;
            }

            if (isset($_POST['last_name'])) {
                $response->last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
            } else {
                $response->last_name = null;
            }

            if (isset($_POST['birthday'])) {
                $response->birthday = date('Y-m-d', strtotime($_POST['birthday']));
                $response->birthday = mysqli_real_escape_string($conn, $response->birthday);
            } else {
                $response->birthday = null;
            }

            if (isset($_POST['sex'])) {
                $response->sex = mysqli_real_escape_string($conn, $_POST['sex']);
            } else {
                $response->sex = null;
            }

            if (isset($_POST['address'])) {
                $response->address = mysqli_real_escape_string($conn, $_POST['address']);
            } else {
                $response->address = null;
            }

            if (isset($_POST['phone'])) {
                $response->phone = mysqli_real_escape_string($conn, $_POST['phone']);
            } else {
                $response->phone = null;
            }

            if (isset($_POST['success'])) {
                $response->success = mysqli_real_escape_string($conn, $_POST['success']);
            } else {
                $response->success = null;
            }

            // create query to run on database
            $qry = "INSERT INTO children (first_name, last_name, birthday, sex, address, phone) "
                    . "VALUES('" . $response->first_name . "', '" . $response->last_name . "', '" . $response->birthday . "', '"
                    . $response->sex . "', '" . $response->address . "', '" . $response->phone . "')";

            if (mysqli_query($conn, $qry)) {

                $response->success = 'true';

                echo json_encode($response);
            } else {
                
            }
        }


//close the connection
        $conn->close();
    }

}
