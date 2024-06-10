<?php

require_once "../../inc/config_session.blg.inc.php";
ConfigSession::startSession();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
    if (isset($_POST['username']) && isset($_POST['email'])) {

        $id = $_SESSION['admin_id'];
        $username = $_POST['username']; 
        $email = $_POST['email'];

        if(empty($username)) {
            $em = "username is required!";
            header("Location: ../profile.blg.admin.php?error=$em");
            die();
        } else if(empty($email)) {
            $em = "email is required!";
            header("Location: ../profile.blg.admin.php?error=$em");
            die();
        }
        
            $query = "UPDATE admins SET username=?, email=? WHERE id=? ;";
            require_once "../../inc/dbh.blg.inc.php";
            $Dbh = new Dbh();
            $connectBD = $Dbh->connectBD();

            $stmnt = $connectBD->prepare($query);
            $res = $stmnt->execute([$username, $email, $id]);

            if ($res) {
                $_SESSION['username'] = $username;
                $sm = "Successfully Edited!";
                header("Location: ../profile.blg.admin.php?success=$sm");
                die();
            } else {
                $em = "Error occurred!";
                header("Location: ../profile.blg.admin.php?error=$em");
                die();
            }
    } else {
        header("Location: ../profile.blg.admin.php");
        die();
    } 
} else {
    header("Location: ../../admin_log.blg.php");
    die(); 
}