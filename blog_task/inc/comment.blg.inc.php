<?php
require_once "config_session.blg.inc.php";
ConfigSession::startSession();

//Comment Handler
//chech if the user logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
// if there is a comment
    if (isset($_POST['comment']) && isset($_POST['review_id'])) {
// assign the data base of the comments 
        $comment = $_POST['comment'];
        $review_id = $_POST['review_id'];
        $user_id = $_SESSION['user_id'];
// if he tried to comment without writing any thing
        if (empty($comment)) {
            $em = "You should say something if you wanna comment!";
            header("Location: ../blog_view.blg.php?error=$em&review_id=$review_id#comments");
            die();
        }
        // if he tring to comment an image
        $comment_img = "";
        if (!empty($_FILES['comment_img']['name'])) {
            // File upload
            $img_size = $_FILES['comment_img']['size'];
            $img_temp = $_FILES['comment_img']['tmp_name'];
            $error = $_FILES['comment_img']['error'];
            // if thereis no error
            if ($error === 0) {
                if ($img_size > 1000000) { // Limit image size to 1MB
                    $em = "Your File is too Large!";
                    header("Location: ../blog_view.blg.php?error=$em&review_id=$review_id#comments");
                    exit();
                } else { // if everything is ok now check the image types
                    $img_ext = strtolower(pathinfo($_FILES['comment_img']['name'], PATHINFO_EXTENSION));
                    $allowed_ext = array('jpg', 'jpeg', 'png');
                    // uploading images to the directory of it
                    if (in_array($img_ext, $allowed_ext)) {
                        $new_img_name = uniqid("Com_Img-", true).'.'.$img_ext;
                        $img_path = '../upload/com_img/'.$new_img_name; 
                        if (move_uploaded_file($img_temp, $img_path)) {
                            $comment_img = $new_img_name;
                        } else { 
                            $em = "Failed to upload image.";
                            header("Location: ../blog_view.blg.php?error=$em&review_id=$review_id#comments");
                            exit();
                        }
                    } else {//if it's not the supported type
                        $em = "Only images of types: 'jpg', 'jpeg', 'png'!";
                        header("Location: ../blog_view.blg.php?error=$em&review_id=$review_id#comments");
                        exit();
                    }
                }
            } else {
                $em = "An error occurred during the image upload.";
                header("Location: ../blog_view.blg.php?error=$em&review_id=$review_id#comments");
                exit();
            }
        }
        // Prepare and execute the query
        require_once "dbh.blg.inc.php";
        $Dbh = new Dbh();
        $connectBD = $Dbh->connectBD();
        if (!empty($comment_img)) { //if the user insert an image use these
            $query = "INSERT INTO comment (comment, comment_img, user_id, review_id) VALUES (:comment, :comment_img, :user_id, :review_id)";
            $stmnt = $connectBD->prepare($query);
            $stmnt->bindParam(":comment", $comment);
            $stmnt->bindParam(":comment_img", $comment_img);
            $stmnt->bindParam(":user_id", $user_id);
            $stmnt->bindParam(":review_id", $review_id);
        } else { // if he comment without images
            $query = "INSERT INTO comment (comment, user_id, review_id) VALUES (:comment, :user_id, :review_id)";
            $stmnt = $connectBD->prepare($query);
            $stmnt->bindParam(":comment", $comment);
            $stmnt->bindParam(":user_id", $user_id);
            $stmnt->bindParam(":review_id", $review_id);
        }
        if ($stmnt->execute()) {
            $success = "We appreciate your comment ♥";
            header("Location: ../blog_view.blg.php?success=$success&review_id=$review_id#comments");
        } else {
            $em = "Failed to add comment.";
            header("Location: ../blog_view.blg.php?error=$em&review_id=$review_id#comments");
        }
    } else {
        header('Location: ../blog.blg.php');
        die();
    }
} else {
    echo "You MUST be a member if you already are please login if not HURRY UP! and join us.";
    die();
}
