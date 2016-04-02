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

    public function connect($postVars) {
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
                    session_start();
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

}


