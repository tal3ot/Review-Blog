<?php

declare(strict_types= 1);

error_reporting(E_ALL);
ini_set('display_errors', 1);

class loginModel extends Dbh {
    //Create new users
    public function get_email(string $email) {// it will to communicate with the db to check if the email is already taken
        ConfigSession::startSession();

        $query = "SELECT * FROM users_info WHERE email = :email;";

        $stmnt = parent::connectBD()->prepare($query);
        $stmnt->bindParam(":email", $email);
        $stmnt->execute();

        $result = $stmnt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}