<?php 

declare(strict_types= 1);

error_reporting(E_ALL);
ini_set('display_errors', 1);
    //get all reviews
class getComments extends Dbh {
    public function getAll () {

        $query = "SELECT * FROM comment ;";

        $stmnt = parent::connectBD()->prepare($query);
        $stmnt->execute();         

        if($stmnt->rowCount() >= 1) {
            $result = $stmnt->fetchALL(PDO::FETCH_ASSOC);
                return $result;
        } else {
            return 0;
        }    
    } 
        //get Comments by id
    public function getCommentsById ($id) {

        $query = "SELECT * FROM comment WHERE comment_id=? ;";

        $stmnt = parent::connectBD()->prepare($query);
        $stmnt->execute([$id]);         

        if($stmnt->rowCount() >= 1) {
            $result = $stmnt->fetch(PDO::FETCH_ASSOC);
                return $result;
        } else {
            return 0;
        }    
    }     
    //Counting Comments by review id
    public function countCommentsByReviewId ($id) {

        $query = "SELECT * FROM comment WHERE review_id=? ;";

        $stmnt = parent::connectBD()->prepare($query);
        $stmnt->execute([$id]);         

        $stmnt->rowCount();
        $result = $stmnt->rowCount();
            return $result;
    } 
    //Getting Comments by review id
    public function getCommentsByReviewId ($id) {

        $query = "SELECT * FROM comment WHERE review_id=?  ORDER BY created_at DESC ;";

        $stmnt = parent::connectBD()->prepare($query);
        $stmnt->execute([$id]);        
        
        if($stmnt->rowCount() >= 1) {
            $result = $stmnt->fetchALL(PDO::FETCH_ASSOC);
                return $result;
        } else {
            return 0;
        }
    }      
    //Counting Likes by review id
    public function countLikesByReviewId ($id) {

        $query = "SELECT * FROM review_likes WHERE review_id=? ;";

        $stmnt = parent::connectBD()->prepare($query);
        $stmnt->execute([$id]);         
        $stmnt->rowCount();

        $result = $stmnt->rowCount();
            return $result;
    }  
        //If the post is liked
        public function isLikedByUserId ($review_id, $user_id) {

            $query = "SELECT * FROM review_likes WHERE review_id=? AND liked_by=?;";
    
            $stmnt = parent::connectBD()->prepare($query);
            $stmnt->execute([$review_id, $user_id]);         
    
            if($stmnt->rowCount() > 0) {
                return 1;
            } else {
                return 0;
            }   
        }  
    // delete Comments by id
    public function deleteCommentsById($id) {

            $query = "DELETE FROM comment WHERE comment_id=? ";

            $stmnt = parent::connectBD()->prepare($query);
            $result = $stmnt->execute([$id]);

            if($result) {
                return 1;
            } else {
                return 0;
            }    
 
        } 
    // delete Comments by deleting post by id
    public function deleteCommentsByPostId($id) {

        $query = "DELETE FROM comment WHERE review_id=? ";

        $stmnt = parent::connectBD()->prepare($query);
        $result = $stmnt->execute([$id]);

        if($result) {
            return 1;
        } else {
            return 0;
        }    

    } 
    // delete Likes by deleting post by id
    public function deleteLikesByPostId($id) {

        $query = "DELETE FROM review_likes WHERE review_id=? ";

        $stmnt = parent::connectBD()->prepare($query);
        $result = $stmnt->execute([$id]);

        if($result) {
            return 1;
        } else {
            return 0;
        }    
    } 
}

