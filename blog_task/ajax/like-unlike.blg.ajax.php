<?php 

require_once "../inc/config_session.blg.inc.php";
ConfigSession::startSession();
// like and unlike connection with db

if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_POST['review_id'])) {
    
    $user_id = $_SESSION['user_id'];
    $review_id = $_POST['review_id'];

    if (empty($review_id)) {
        echo '3!!!';
    } else {
        $query = "SELECT * FROM review_likes WHERE review_id=:review_id AND liked_by=:user_id ;";
        require_once "../inc/dbh.blg.inc.php";
        $Dbh = new Dbh();
        $connectBD = $Dbh->connectBD();

        $stmnt = $connectBD->prepare($query);
        $stmnt->bindParam(":review_id", $review_id);
        $stmnt->bindParam(":user_id", $user_id);
        $result = $stmnt->execute();

        if($stmnt->rowCount() > 0) {
            $query = "DELETE FROM review_likes WHERE review_id=:review_id AND liked_by=:user_id ;";
            $stmnt = $connectBD->prepare($query);
            $stmnt->bindParam(":review_id", $review_id);
            $stmnt->bindParam(":user_id", $user_id);
            $result = $stmnt->execute();

        } else {

            $query = "INSERT INTO review_likes (review_id, liked_by) VALUE (:review_id, :user_id) ;";
            $stmnt = $connectBD->prepare($query);
            $stmnt->bindParam(":review_id", $review_id);
            $stmnt->bindParam(":user_id", $user_id);
            $result = $stmnt->execute();
        } 

        $query = "SELECT * FROM review_likes WHERE review_id=:review_id ;";

        $stmnt = $connectBD->prepare($query);
        $stmnt->bindParam(":review_id", $review_id);
        $stmnt->execute();

        if($stmnt->rowCount() >= 0) echo $stmnt->rowCount();
        else echo "6!!!!!!";
    } 
}else {
    echo '9!!!!!!!!!';
    
} 