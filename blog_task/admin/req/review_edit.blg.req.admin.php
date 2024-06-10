<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../../inc/config_session.blg.inc.php";
ConfigSession::startSession();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['title']) && isset($_FILES['cover']) && isset($_POST['review']) && isset($_POST['review_id']) && isset($_POST['cover_url']) && isset($_POST['category'])){

        require_once("../../inc/dbh.blg.inc.php");

        $title = $_POST['title'];
        $review = $_POST['review'];
        $review_id = $_POST['review_id'];
        $cu = $_POST['cover_url'];
        $category = $_POST['category'];

        if (empty($title)) {
            $em = "Title is required"; 
            header("Location: ../review_edit.blg.admin.php?error=$em&review_id=$review_id");
            die();
        } else if (empty($review)) { //try to make it title if error happened
            $em = "Review is required"; 
            header("Location: ../review_edit.blg.admin.php?error=$em&review_id=$review_id");
            die();
        } else if (empty($category)) {
            $category = 0;
        }
    
        $image_name = $_FILES['cover']['name'];
        // if there's img and not the defualt img
        if($cu != "default.jpg" && $image_name != ""){
            $clocation = "../../upload/blog/".$cu;
            // delete the img
            if (!unlink($clocation)) {
             }
        }
        //img upload
        if($image_name != "") {
            $image_size = $_FILES['cover']['size'];
            $image_temp = $_FILES['cover']['tmp_name'];
            $error = $_FILES['cover']['error']; 
            if ($error === 0) {
                if ($image_size > 5000000) {
                    $em = "Your Image is too Large!"; 
                        header("Location: ../review_edit.blg.admin.php?error=$em&review_id=$review_id");
                        die();
                } else {
                    $img = pathinfo($image_name, PATHINFO_EXTENSION);
                    $img = strtolower($img);

                    $allowed_img = array('jpg', 'jpeg', 'png');
                    if (in_array($img, $allowed_img)) {
                        $new_image_name = uniqid("COVER-", true).'.'.$img;
                        $image_path = '../../upload/blog/'.$new_image_name;
                        move_uploaded_file($image_temp, $image_path);

                        $query = "UPDATE reviews SET title=?, review=?, category=?, cover_url=? WHERE id=?";
                        require_once "../../inc/dbh.blg.inc.php";
                        $Dbh = new Dbh();
                        $connectBD = $Dbh->connectBD();

                        $stmnt = $connectBD->prepare($query);
                        $res = $stmnt->execute([$title, $review, $category, $new_image_name, $review_id]);

                    }else {
                        $em = "Only images of types: 'jpg', 'jpeg', 'png'!"; 
                        header("Location: ../review_edit.blg.admin.php?error=$em&review_id=$review_id");
                        die();
                    }
                }
            }
        } else {
            $query = "UPDATE reviews SET title=?, review=?, category=? WHERE id=?";

            require_once "../../inc/dbh.blg.inc.php";
            $Dbh = new Dbh();
            $connectBD = $Dbh->connectBD();

            $stmnt = $connectBD->prepare($query);
            $res = $stmnt->execute([$title, $review, $category, $review_id]);
        }
      
        if ($res) {
            $sm = "Successfully Edited!"; 
            header("Location: ../review_edit.blg.admin.php?success=$sm&review_id=$review_id");
            die();
        }else {
            $em = "Error Occurred"; 
            header("Location: ../review_edit.blg.admin.php?success=$sm&review_id=$review_id");
            die();
        }
    }else {
        header("Location: ../review_edit.blg.admin.php&review_id=$review_id");
        die();
    }
} else {
    header("Location: ../../admin_log.blg.php");
    die();
} 