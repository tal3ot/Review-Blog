<?php

require_once "../../inc/config_session.blg.inc.php";
ConfigSession::startSession();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {

    if (isset($_POST['c_pwd']) && isset($_POST['n_pwd']) && isset($_POST['c_n_pwd'])) {

        $c_pwd = $_POST['c_pwd'];
        $n_pwd = $_POST['n_pwd'];
        $c_n_pwd = $_POST['c_n_pwd'];
        $id = $_SESSION['admin_id'];

        if(empty($c_pwd)) {
            $em = "Current Password is required!";
            header("Location: ../profile.blg.admin.php?p_error=$em#cpassword");
            die();
        } else if (empty($n_pwd)) {
            $em = "New Password is required!";
            header("Location: ../profile.blg.admin.php?p_error=$em#cpassword");
            die();
        } else if (empty($c_n_pwd)) {
            $em = "Confirm New Password is required!";
            header("Location: ../profile.blg.admin.php?p_error=$em#cpassword");
            die();
        }   else if ($c_n_pwd != $n_pwd) {
            $em = "Confirm New Password and New Password doesn't match!";
            header("Location: ../profile.blg.admin.php?p_error=$em#cpassword");
            die();
        }

        $query = "SELECT pwd FROM admins WHERE id=? ;";
        require_once "../../inc/dbh.blg.inc.php";
        $Dbh = new Dbh();
        $connectBD = $Dbh->connectBD();

        $stmnt = $connectBD->prepare($query);
        $stmnt->execute([$id]);         

        $result = $stmnt->fetch(PDO::FETCH_ASSOC);
        // if the new equal the confirmed but the current doesn't equal the orignal saved one
        if (!password_verify($c_pwd, $result['pwd'])) {
            $em = "Incorrect password!";
            header("Location: ../profile.blg.admin.php?p_error=$em#cpassword");
            die();
        } else { //if everything is right

            // hashing password
            $n_pwd = password_hash($n_pwd, PASSWORD_DEFAULT);
            $query = "UPDATE admins SET pwd=? ;";
            require_once "../../inc/dbh.blg.inc.php";
            $Dbh = new Dbh();
            $connectBD = $Dbh->connectBD();

            $stmnt = $connectBD->prepare($query);
            $res = $stmnt->execute([$n_pwd]);

            if ($res) {
                $sm = "Password Successfully Changed!";
                header("Location: ../profile.blg.admin.php?p_success=$sm#cpassword");
                die();
            } else {
                $em = "Error occurred!";
                header("Location: ../profile.blg.admin.php?p_error=$em#cpassword");
                die();
            }
        }
    } else {
        header("Location: ../profile.blg.admin.php");
        die();
    } 
} else {
    header("Location: ../../admin_log.blg.php");
    die(); 
}