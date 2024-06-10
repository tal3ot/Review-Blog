<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*require_once "dbh_oop.inc.php";
require_once "config_session_oop.inc.php";
require_once "signup_model_oop.inc.php";
require_once "signup_control_oop.inc.php";

ConfigSession::startSession();

$db = new DB();
$model = new SignupModel($db->pdo);
$control = new SignupControl($model);

$username = $_POST['username'] ?? '';
$pwd = $_POST['pwd'] ?? '';
$email = $_POST['email'] ?? '';
$phoneNum = $_POST['phoneNum'] ?? '';

$_SESSION['signup_data'] = compact('username', 'email', 'phoneNum');
$_SESSION['errors_signup'] = [];

if ($control->isInputEmpty($username, $pwd, $email, $phoneNum)) {
    $_SESSION['errors_signup'][] = "All fields are required.";
}

if ($control->isUsernameTaken($username)) {
    $_SESSION['errors_signup'][] = "Username is already taken.";
}

if ($control->isEmailInvalid($email)) {
    $_SESSION['errors_signup'][] = "Invalid email format.";
}

if ($control->isEmailRegistered($email)) {
    $_SESSION['errors_signup'][] = "Email is already registered.";
}

if ($control->isPhoneWrong($phoneNum)) {
    $_SESSION['errors_signup'][] = "Phone number is invalid.";
}

if ($control->isPhoneRegistered($phoneNum)) {
    $_SESSION['errors_signup'][] = "Phone number is already registered.";
}

if (empty($_SESSION['errors_signup'])) {
    $model->createUser($username, $pwd, $email, $phoneNum);
} else {
    header("Location: ../index_oop.php");
    exit();
}*/

   /* //trying to fix the error
    $_SESSION['id']   = $id;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['phoneNum'] = $phoneNum;*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    require_once "dbh.blg.inc.php";
    require_once 'config_session.blg.inc.php';
    require_once "signup_model.blg.inc.php";
    require_once "signup_control.blg.inc.php";
    //Start a session
    ConfigSession::startSession();

    //Grabbing The Data
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];
    $phoneNum = $_POST["phoneNum"];



    //Instantiate SignUp Control Class

    try {

        //new object from the Signup_control class from signup_control_oop.inc.php file
        $Signup = new signupControl($username, $pwd, $email, $phoneNum);
        $SignupModel = new signupModel();
        //Running Error Handlers And User SignUp
        $errors = [];

        if ($Signup->is_input_empty($username, $pwd, $email, $phoneNum)) { // If any missing data
            $errors["input_empty"] = "Missing data!";
        }
        if ($Signup->is_username_invalid($username)) { // If any missing data
            $errors["input_empty"] = "Wrong letters";
        }
        if ($Signup->is_username_taken($username)) { // If the username is signuped before
            $errors["username_taken"] = "Your username is taken before!";
        }
        if ($Signup->is_email_invalid($email)) { //if the email is incorrect
            $errors["email_invalid"] = "Your email is incorrect!";
        }
        if ($Signup->is_email_registered($email)) { //If the email is signuped before
            $errors["email_registered"] = "Your email already registered!";
        }
        if ($Signup->is_phone_wrong($phoneNum)) { //If the phone is wrong 
            $errors["phone_wrong"] = "Your phone number is wrong";
        }
        if ($Signup->is_phone_registered($phoneNum)) { //If the phone is signuped before
            $errors["phone_registered"] = "Your phone number already registered!";
        }

        ConfigSession::startSession();
        // To retype what he submitted when it's wrong
        if ($errors) {
            $_SESSION['errors_signup'] = $errors;

            $signupData = [
                'username'=> $username,
                'email' => $email,
                'phoneNum' => $phoneNum
            ];
            $_SESSION['signup_data'] = $signupData; 

            header("Location: ../ind.blg.php");
            die();  
            }

            // as long as no errors occurred, we'll start creating the new users
            $SignupModel->create_user($username, $pwd, $email, $phoneNum);



            //Going Back To The Home Page
            header("Location: ../ind.blg.php?signup=success");

            $stmnt = null;
            die();

        } catch (PDOException $e) {
            die("Query Failed" . $e->getMessage());
            } 
        } else {
            header("Location: ../ind.blg.php");
        }