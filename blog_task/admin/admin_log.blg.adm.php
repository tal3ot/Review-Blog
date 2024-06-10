<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    //Start a session
require_once '../inc/config_session.blg.inc.php';
ConfigSession::startSession();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    require_once "../inc/dbh.blg.inc.php";
    require_once '../inc/config_session.blg.inc.php';
    require_once "login_admin_model.adm.blg.php";
    require_once "../inc/login_control.blg.inc.php";


    //Grabbing The Data
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    //Instantiate SignUp Control Class
    try {

        //new object from the Signup_control class from signup_control_oop.inc.php file
        $login = new loginControl($email, $pwd);
        $LoginAdmin = new loginAdmin();
        //Running Error Handlers And User SignUp
        $errors = [];

        if ($login->is_input_empty($email, $pwd)) { // If any missing data
            $errors["input_empty"] = "Please fill all fields!";
        }
        // as long as no empty data, we'll start grapping the email
        $user = $LoginAdmin->get_email($email);

        //after grapping the data we will find if any of them is wrong
        if ($login->is_email_wrong($user)) {
            $errors["wrong_email"] = "Can't find this email";
        }
        /* if the username is entered correct and the password is wrongly entered 
        (as he compare the stored password from signup $pwd and the recent password he entered now from $result["pwd]) */
        if (!$login->is_email_wrong($user) && $login->is_password_wrong($pwd, $user["pwd"])) {
            $errors["wrong_password"] = "Wrong password please try again";
        }

        $_SESSION['admin_id']   = $user['id'];
        $_SESSION['username']   = $user['username'];
        $_SESSION['email'] = $user['email'];
        // To retype what he submitted when it's wrong
        if ($errors) {
            ConfigSession::startSession();

            $_SESSION["errors_login"] = $errors;
        
            header("Location: ../admin_log.blg.php");
            die();
            }

            /*------------------------------------------------------ADMIN board------------------------------------------------------------*/
            
            header("Location: users.blg.admin.php");
            die();
        
        } catch (PDOException $e) {
            echo "Query Connection". $e->getMessage();
        }
        } else {
            header("Location: ../admin_log.blg.php");
            die();
        }




        