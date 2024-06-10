<?php

declare(strict_types= 1); //it prevent more errors from happening inside our code like typoo or submitting wrong type of data. 

error_reporting(E_ALL);
ini_set('display_errors', 1);

class signupModel extends Dbh {
    //Create new users
    public function create_user(string $username, string $pwd, string $email, string $phoneNum) {

        $query = "INSERT INTO users_info (username, pwd, email, phoneNum) VALUES (:username, :pwd, :email, :phoneNum);";

        $stmnt = parent::connectBD()->prepare($query);

        // the time it take between every wrong pass the user write 12 is ok not slow or annoying
        $options = ["cost"=> 12];
        // To hash the password and make it ununderstandable if any hacker try to steal it
        $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

        $stmnt->bindParam(":username", $username);
        $stmnt->bindParam(":pwd", $hashedpwd);
        $stmnt->bindParam(":email", $email);
        $stmnt->bindParam(":phoneNum", $phoneNum);
        $stmnt->execute();

        $stmnt = null;
        header("Location: ../ind.blg.php?signup=success");
        die();
    }
    public function get_username(string $username) { // it will to communicate with the db to check if the username is already taken
    
        $query = "SELECT username FROM users_info WHERE username = :username;";
    
        $stmnt = parent::connectBD()->prepare($query);
        $stmnt->bindParam(":username", $username);
        $stmnt -> execute();
    
        $result = $stmnt->fetch(PDO::FETCH_ASSOC); 
        return $result;
    }
    public function get_email(string $email) { // it will to communicate with the db to check if the email is already taken
        
        $query = "SELECT email FROM users_info WHERE email = :email;";
    
        $stmnt = parent::connectBD()->prepare($query);
        $stmnt->bindParam(":email", $email);
        $stmnt -> execute();
    
        $result = $stmnt->fetch(PDO::FETCH_ASSOC); 
        return $result;
    }
    public function get_phone(string $phoneNum) { // it will to communicate with the db to check if the phone is already taken
        
        $query = "SELECT phoneNum FROM users_info WHERE phoneNum = :phoneNum;";
    
        $stmnt = parent::connectBD()->prepare($query);
        $stmnt->bindParam(":phoneNum", $phoneNum);
        $stmnt -> execute();
    
        $result = $stmnt->fetch(PDO::FETCH_ASSOC); 
        return $result;
    }
}