<?php

require_once "../../inc/config_session.blg.inc.php";
ConfigSession::startSession();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['title']) && isset($_POST['category']) && isset($_FILES['cover']) && isset($_POST['review'])) {

        $title = $_POST['title']; 
        $review = $_POST['review'];
        $category = $_POST['category'];
        
        if(empty($title)) {
            $em = "Title is required!";
            header("Location: ../review_add.blg.admin.php?error=$em");
            exit();

        } else if (empty($review)) {
            $em = "Review is required!";
            header("Location: ../review_add.blg.admin.php?error=$em");
            exit();
        } else if (empty($category)) {
            $category = 0;
        }
        
        $img_name = $_FILES['cover']['name'];
        if ($img_name != "") {
            //File upload
            $img_size = $_FILES['cover']['size'];
            $img_temp = $_FILES['cover']['tmp_name'];
            $error = $_FILES['cover']['error'];
            if ($error === 0) {
                if ($img_size > 5000000) {
                    $em = "Your File is too Large!";
                    header("Location: ../review_add.blg.admin.php?error=$em");
                    exit();
                } else {
                    $img = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img = strtolower($img);

                    $allowed_img = array('jpg', 'jpeg', 'png');
                    if (in_array($img, $allowed_img)) {
                        $new_img_name = uniqid("COVER-", true).'.'.$img;
                        $img_path = '../../upload/blog/'.$new_img_name; 
                        move_uploaded_file($img_temp, $img_path);
                        $query = "INSERT INTO reviews (title, review, category, cover_url) VALUES (:title, :review, :category, :cover_url);";
                        require_once "../../inc/dbh.blg.inc.php";
                        $Dbh = new Dbh();
                        $connectBD = $Dbh->connectBD();

                        $stmnt = $connectBD->prepare($query);
                        $stmnt->bindParam(":title", $title);
                        $stmnt->bindParam(":review", $review);
                        $stmnt->bindParam("category", $category);
                        $stmnt->bindParam(":cover_url", $new_img_name);
                        $res = $stmnt->execute();

                    } else {
                        $em = "Only images of types: 'jpg', 'jpeg', 'png'!";
                        header("Location: ../review_add.blg.admin.php?error=$em");
                        exit();
                    }
                }
            }
        } else {
            $query = "INSERT INTO reviews (title, review, category) VALUES (:title, :review, :category);";
            require_once "../../inc/dbh.blg.inc.php";
            $Dbh = new Dbh();
            $connectBD = $Dbh->connectBD();

            $stmnt = $connectBD->prepare($query);
            $stmnt->bindParam(":title", $title);
            $stmnt->bindParam(":review", $review);
            $stmnt->bindParam("category", $category);
            $res = $stmnt->execute();

           }  if ($res) {
                $sm = "Successfully Created!";
                header("Location: ../review_add.blg.admin.php?success=$sm");
                exit();
            } else {
                $em = "Error occurred!";
                header("Location: ../review_add.blg.admin.php?error=$em");
                exit();
            }

    } else {
        header("Location: ../review_add.blg.admin.php");
        die();
    } 
} else {
    header("Location: admin_log.blg.php");
    die(); 
}