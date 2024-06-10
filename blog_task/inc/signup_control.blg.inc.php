<?php

declare(strict_types= 1); //it prevent more errors from happening inside our code like typoo or submitting wrong type of data. 

error_reporting(E_ALL);
ini_set('display_errors', 1);

class signupControl {

    //Properties
    public $username;
    public $pwd;
    public $email;
    public $phoneNum;
    private $signupModel;

    //Assigning  the the data we grabbed from the user to the properties
    public function __construct($username, $pwd, $email, $phoneNum) { //the variables here is just a placeholders (just names), you can name it anything you like
        // $this->property = $variables
        $this->username = $username;
        $this->pwd = $pwd;
        $this->email = $email;
        $this->phoneNum = $phoneNum;
        $this->signupModel = new signupModel(); // Instantiate Signup_model
    }
    //Error handlers methods
    
    //Checking if any data is missing
    public function is_input_empty(string $username, string $pwd, string $email, string $phoneNum) { //string to prevent the boolen expression
        if (empty($username) || empty($pwd) || empty($email) || empty($phoneNum)) {
            return true;
        } else {
            return false;
        }       
    }
    //Checking if the username invalid
    public function is_username_invalid(string $username) {
        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            return true;
        } else {
            return false;
        }       
    }
    //Checking if the username used before
    public function is_username_taken(string $username) {
        if ($this->signupModel->get_username($username)) {
            return true;
        } else {
            return false;
        }       
    }
    //checking the validation of the e-mails
    public function is_email_invalid(string $email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
            return true;
        } else {
            return false;
        }       
    }
    //Checking if the e-mails used before
    public function is_email_registered(string $email) {
        if ($this->signupModel->get_email($email)) {
            return true;
        } else {
            return false;
        }       
    }
    //Checking the validation of the phone number
    public function is_phone_wrong(string $phoneNum) {

        // Remove any non-digit characters
        $digitsOnly = preg_replace('/\D/', '', $phoneNum);
        // Check the length of the phone number and the valid
        if (strlen($digitsOnly) < 11 || strlen($digitsOnly) > 14 ) {
            return true;
        } else {
            return false;
        }       
    }
    //Checking if the phone number used before
    public function is_phone_registered(string $phoneNum) {
        if ($this->signupModel->get_phone($phoneNum)) {
            return true;
        } else {
            return false;
        }       
    }
}