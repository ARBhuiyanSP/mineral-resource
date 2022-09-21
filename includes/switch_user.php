<?php 
session_start();
include '../connection/connect.php';
// redirect user with session
$warehouse_id = $_GET['id'];
$usersql    = "SELECT * FROM users WHERE warehouse_id='$warehouse_id'";
// Pre session unset
 unset($_SESSION['error']);
 unset($_SESSION['success']);
 unset($_SESSION['logged']);
 // Pre session unset
 
        $result = $conn->query($usersql);
        if ($result->num_rows > 0) {
            $passsql    = "SELECT * FROM users WHERE warehouse_id='$warehouse_id'";
            $presult = $conn->query($passsql);
            if ($presult->num_rows > 0) {
                $row        	=   $presult->fetch_object();
                $fname      	=   $row->first_name;
                $lname      	=   $row->last_name;
                $user_id    	=   $row->id;
                $user_type		=   $row->user_type;
                $project_id		=   $row->project_id;
                $warehouse_id	=   $row->warehouse_id;
                unset($_SESSION['error']);
                $_SESSION['success']                =   $fname.' '.$lname." have successfully loggedin!";
                $_SESSION['logged']['user_name']    =   $fname.' '.$lname;
                $_SESSION['logged']['user_id']      =   $user_id;
                $_SESSION['logged']['user_type']	=   $user_type;
                $_SESSION['logged']['project_id']	=   $project_id;
                $_SESSION['logged']['warehouse_id']	=   $warehouse_id;

                $_SESSION['logged']['status']		=   true;
                header("location: ../dashboard.php");
                exit();
            }/* else{
                $error_status                       =   true;
                $_SESSION['error_message']['password_empty']     =   'Password did not matched.';
                $_SESSION['error']                               =   "Login credential was not correct.";
                header("location: index.php");
                exit();
            } */
        }/* else{
            $error_status   =   true;
            $_SESSION['error_message']['email_valid']    =   'Invalid email';
            $_SESSION['error']                           =   "Login credential was not correct.";
            header("location: index.php");
            exit();
        } */

// redirect user with session

/*  unset($_SESSION['error']);
 unset($_SESSION['success']);
 unset($_SESSION['logged']);
 header("location: ../index.php");
 exit(); */