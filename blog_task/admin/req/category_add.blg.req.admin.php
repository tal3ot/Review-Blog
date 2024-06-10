<?php

require_once "../../inc/config_session.blg.inc.php";
ConfigSession::startSession();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['category'])) {

        $category = $_POST['category']; 

        if(empty($category)) {
            $em = "category is required!";
            header("Location: ../category_add.blg.admin.php?error=$em");
            exit();
        }
        
            $query = "INSERT INTO category (category) VALUES (:category);";
            require_once "../../inc/dbh.blg.inc.php";
            $Dbh = new Dbh();
            $connectBD = $Dbh->connectBD();

            $stmnt = $connectBD->prepare($query);
            $stmnt->bindParam(":category", $category);
            $res = $stmnt->execute();

            if ($res) {
                $sm = "Successfully Created!";
                header("Location: ../category_add.blg.admin.php?success=$sm");
                exit();
            } else {
                $em = "Error occurred!";
                header("Location: ../category_add.blg.admin.php?error=$em");
                exit();
            }
    } else {
        header("Location: ../category_add.blg.admin.php");
        die();
    } 
} else {
    header("Location: admin_log.blg.php");
    die(); 
}