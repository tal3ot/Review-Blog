<?php

require_once "../../inc/config_session.blg.inc.php";
ConfigSession::startSession();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['category']) && isset($_POST['id'])) {

        $category = $_POST['category']; 
        $id = $_POST['id'];

        if(empty($category)) {
            $em = "category is required!";
            header("Location: ../category_edit.blg.admin.php?error=$em&id=$id");
            exit();
        }
        
            $query = "UPDATE category SET category=? WHERE id=? ;";
            require_once "../../inc/dbh.blg.inc.php";
            $Dbh = new Dbh();
            $connectBD = $Dbh->connectBD();

            $stmnt = $connectBD->prepare($query);
            $res = $stmnt->execute([$category, $id]);

            if ($res) {
                $sm = "Successfully Edited!";
                header("Location: ../category_edit.blg.admin.php?success=$sm&category=$category&id=$id");
                exit();
            } else {
                $em = "Error occurred!";
                header("Location: ../category_edit.blg.admin.php?error=$em&id=$id");
                exit();
            }
    } else {
        header("Location: ../category_edit.blg.admin.php");
        die();
    } 
} else {
    header("Location: ../../admin_log.blg.php");
    die(); 
}