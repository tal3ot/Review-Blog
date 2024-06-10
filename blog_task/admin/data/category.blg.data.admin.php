<?php 

declare(strict_types= 1);

error_reporting(E_ALL);
ini_set('display_errors', 1);
    //get all reviews
class getCategories extends Dbh {
    public function getAll () {

        $query = "SELECT * FROM category ORDER BY category ASC ;";

        $stmnt = parent::connectBD()->prepare($query);
        $stmnt->execute();         

        if($stmnt->rowCount() >= 1) {
            $result = $stmnt->fetchALL(PDO::FETCH_ASSOC);
                return $result;
        } else {
            return 0;
        }    
    } 
        //get by id
    public function getById ($id) {

        $query = "SELECT * FROM category WHERE id=? ;";

        $stmnt = parent::connectBD()->prepare($query);
        $stmnt->execute([$id]);         

        if($stmnt->rowCount() >= 1) {
            $result = $stmnt->fetch(PDO::FETCH_ASSOC);
                return $result;
        } else {
            return 0;
        }    
    }     
    // delete by id
    public function deleteById($id) {

            $query = "DELETE FROM category WHERE id=? ";

            $stmnt = parent::connectBD()->prepare($query);
            $result = $stmnt->execute([$id]);

            if($result) {
                return 1;
            } else {
                return 0;
            }    
        } 
    }

