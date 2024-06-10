<?php
declare(strict_types= 1); //it prevent more errors from happening inside our code like typoo or submitting wrong type of data. 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../inc/config_session.blg.inc.php";
ConfigSession::startSession();
    
if (isset($_GET["comment_id"])) {

 require_once "../inc/dbh.blg.inc.php";
 require_once "data/comment.blg.data.admin.php";

 $getComments = new getComments();

    $comment_id = $_GET['comment_id'];

     //delete a review
     $comment_del = $getComments->deleteCommentsById($comment_id);
 
     if ($comment_del) {
         $sm = "Successfully Deleted!";
         header("Location: comment.blg.admin.php?success=$sm");
         exit();
     } else {
         $em = "Error occurred!";
         header("Location: comment.blg.admin.php?error=$em");
         exit();
     }

} else {
        header("Location: ../admin_log.blg.php");
    }