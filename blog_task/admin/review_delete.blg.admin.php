<?php

declare(strict_types= 1); //it prevent more errors from happening inside our code like typoo or submitting wrong type of data. 

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../inc/config_session.blg.inc.php";
ConfigSession::startSession();
    
if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
 require_once "../inc/dbh.blg.inc.php";
 require_once "data/review.blg.data.admin.php";
 require_once "data/comment.blg.data.admin.php";

 $getReviews = new getReviews();
 $getComments = new getComments();

    $review_id = $_GET['review_id'];

     //delete a review
     $reviews_del = $getReviews->deleteById($review_id);
    // To delete the comments and likes if you deleted the review
     $rev_del_com = $getComments->deleteCommentsByPostId($review_id);
     $rev_del_like = $getComments->deleteLikesByPostId($review_id);
 
     if ($reviews_del and $rev_del_com and $rev_del_like) {
         $sm = "Successfully Deleted!";
         header("Location: review.blg.admin.php?success=$sm");
         exit();
     } else {
         $em = "Error occurred!";
         header("Location: review.blg.admin.php?error=$em");
         exit();
     }
} else {
    header("Location: admin_log.blg.php");
    exit;
}


