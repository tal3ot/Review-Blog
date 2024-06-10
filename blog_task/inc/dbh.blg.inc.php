<?php

error_reporting(E_ALL);
ini_set("display_errors",1);
//DATA BASE HANDLER

class Dbh {
    public function connectBD() {
        try {
            $dsn = "mysql:host=localhost;dbname=blog_task";
            $username = "root";
            $password = "";
            
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo; // Return the PDO object
            
        } catch (PDOException $e) {
                echo "Connection Failed" . $e->getMessage() . "<br/>";
                die();
            }
    }
}