<?php 

declare(strict_types= 1);

error_reporting(E_ALL);
ini_set('display_errors', 1);
    //get all users
class getUsers extends Dbh {
    public function getAll () {

            $query = "SELECT id, username, email, phoneNum FROM users_info ;";

            $stmnt = parent::connectBD()->prepare($query);
            $stmnt->execute();         

            if($stmnt->rowCount() >= 1) {
                $result = $stmnt->fetchALL(PDO::FETCH_ASSOC);
                    return $result;
            } else {
                return 0;
            }    
        } 
        public function getUserById ($id) {

            $query = "SELECT * FROM users_info WHERE id=? ;";

            $stmnt = parent::connectBD()->prepare($query);
            $stmnt->execute([$id]);         

            if($stmnt->rowCount() >= 1) {
                $result = $stmnt->fetch(PDO::FETCH_ASSOC);
                    return $result;
            } else {
                return 0;
            }    
        } 
    public function deleteById($id) {

            $query = "DELETE FROM users_info WHERE id=? ";

            $stmnt = parent::connectBD()->prepare($query);
            $result = $stmnt->execute([$id]);

            if($result) {
                return 1;
            } else {
                return 0;
            }    
        } 
    }

