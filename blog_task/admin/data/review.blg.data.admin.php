<?php 

declare(strict_types= 1);

error_reporting(E_ALL);
ini_set('display_errors', 1);

class getReviews extends Dbh {

    //get all reviews when it public 
    public function getAll () {

            $query = "SELECT * FROM reviews WHERE publish=1 ORDER BY created_at DESC;";

            $stmnt = parent::connectBD()->prepare($query);
            $stmnt->execute();         

            if($stmnt->rowCount() >= 1) {
                $result = $stmnt->fetchALL(PDO::FETCH_ASSOC);
                    return $result;
            } else {
                return 0;
            }    
        } 
        //get all reviews even private -> For Admins
    public function getAllEvenPrivate () {

        $query = "SELECT * FROM reviews ;";

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

        $query = "SELECT * FROM reviews WHERE id=? AND publish=1 ;";

        $stmnt = parent::connectBD()->prepare($query);
        $stmnt->execute([$id]);         

        if($stmnt->rowCount() >= 1) {
            $result = $stmnt->fetch(PDO::FETCH_ASSOC);
                return $result;
        } else {
            return 0;
        }    
    }    
    //get by id even private --> For Admins
    public function getByIdEvenPrivate ($id) {

        $query = "SELECT * FROM reviews WHERE id=? ;";

        $stmnt = parent::connectBD()->prepare($query);
        $stmnt->execute([$id]);         

        if($stmnt->rowCount() >= 1) {
            $result = $stmnt->fetch(PDO::FETCH_ASSOC);
                return $result;
        } else {
            return 0;
        }    
    } 
    //Simple Search
    public function search ($key_search) {

        $key_search = "%{$key_search}%";
        $query = "SELECT * FROM reviews WHERE (title LIKE ? OR review LIKE ?) AND publish=1 ;";

        $stmnt = parent::connectBD()->prepare($query);
        $stmnt->execute([$key_search, $key_search]);         

        if($stmnt->rowCount() >= 1) {
            $result = $stmnt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
        } else {
            return 0;
        }    
    }  
    
    // get all reviews by Category
    public function getAllReviewsByCategory($category_id) {

        $query = "SELECT * FROM reviews WHERE category=? AND publish=1 ;";

        $stmnt = parent::connectBD()->prepare($query);
        $stmnt->execute([$category_id]);         

        if($stmnt->rowCount() >= 1) {
            $result = $stmnt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
        } else {
            return 0;
        }    
    }     

    // delete by id
    public function deleteById($id) {

            $query = "DELETE FROM reviews WHERE id=? ";

            $stmnt = parent::connectBD()->prepare($query);
            $result = $stmnt->execute([$id]);

            if($result) {
                return 1;
            } else {
                return 0;
            }    
 
        } 
    }

