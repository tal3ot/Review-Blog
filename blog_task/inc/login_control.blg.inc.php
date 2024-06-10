<?php

declare(strict_types= 1);

class loginControl {
    //Properties
    public $email;
    private $pwd;
    private $loginModel;

    //Assigning  the the data we grabbed from the user to the properties
    public function __construct($email, $pwd) { //the variables here is just a placeholders (just names), you can name it anything you like
        // $this->property = $variables
        $this->email = $email;
        $this->pwd = $pwd;
       // $this->loginModel = new loginModel(); // Instantiate Signup_model

    }

    //Error handlers methods

    //Checking if any data is missing
    public function is_input_empty(string $email, string $pwd) {

        if (empty($email) || empty($pwd)) {
            return true;
        } else {
            return false;
        }
    }
    
    // $result is array if the username is write and it have it's email and pwd and is bool (false) if it's wrong
    public function is_email_wrong(bool|array $result) {
    
        if (!$result) {
            return true;
        } else {
            return false;
        }
    }
    
    public function is_password_wrong(string $pwd, string $hashedpwd) {
    
        if (!password_verify($pwd, $hashedpwd)) {
            return true;
        } else {
            return false;
        }
    }
}