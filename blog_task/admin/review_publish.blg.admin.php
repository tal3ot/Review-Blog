<?php

declare(strict_types= 1); //it prevent more errors from happening inside our code like typoo or submitting wrong type of data. 

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../inc/config_session.blg.inc.php";
ConfigSession::startSession();
    
//Make reviews publishing public or private
if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) && isset($_GET['review_id']) && isset($_GET['publish'])) {
    
    require_once "../inc/dbh.blg.inc.php";
    require_once "data/review.blg.data.admin.php";

    $review_id = $_GET['review_id'];
    $publish = $_GET['publish'];

     //delete a review
    if ($publish) {
        $query = "UPDATE reviews SET publish=1 WHERE id=? ;";

        $Dbh = new Dbh();
        $connectBD = $Dbh->connectBD();
    
        $stmnt = $connectBD->prepare($query);
        $stmnt->execute([$review_id]); 

        $sm = "Successfully Published!";
        header("Location: review.blg.admin.php?success=$sm");
        die();
    } else {
        $query = "UPDATE reviews SET publish=0 WHERE id=? ;";

        $Dbh = new Dbh();
        $connectBD = $Dbh->connectBD();

        $stmnt = $connectBD->prepare($query);
        $stmnt->execute([$review_id]);
        
        $sm = "Successfully Private!";
        header("Location: review.blg.admin.php?success=$sm");
        die();
    }
        
  
 } else {
    //header("Location: admin_log.blg.adm.php");
    //die();
    echo "hi";
}   
