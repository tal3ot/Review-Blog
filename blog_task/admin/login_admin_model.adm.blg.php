<?php

declare(strict_types= 1);

error_reporting(E_ALL);
ini_set('display_errors', 1);

class loginAdmin extends Dbh {
    public function get_email(string $email) {// it will to communicate with the db to check if the email is already taken

        $query = "SELECT * FROM admins WHERE email = :email;";

        $stmnt = parent::connectBD()->prepare($query);
        $stmnt->bindParam(":email", $email);
        $stmnt->execute();

        $result = $stmnt->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }
}
