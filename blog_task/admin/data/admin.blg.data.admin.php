<?php 

declare(strict_types= 1);

error_reporting(E_ALL);
ini_set('display_errors', 1);
    //get all users
class getAdmins extends Dbh {
    public function getAdminById ($id) {

            $query = "SELECT id, username, email FROM admins WHERE id=? ;";

            $stmnt = parent::connectBD()->prepare($query);
            $stmnt->execute([$id]);         

            if($stmnt->rowCount() >= 1) {
                $result = $stmnt->fetch(PDO::FETCH_ASSOC);
                    return $result;
            } else {
                return 0;
            }    
    } 
}

