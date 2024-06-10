<?php

declare(strict_types= 1); //it prevent more errors from happening inside our code like typoo or submitting wrong type of data. 

error_reporting(E_ALL);
ini_set('display_errors', 1);

 require_once "../inc/dbh.blg.inc.php";
 require_once "data/users.blg.data.admin.php";
 
 $getUsers = new getUsers();

    $user_id = $_GET['user_id'];
     //delete a user
     $users_del = $getUsers->deleteById($user_id);
 
     if ($users_del) {
         $sm = "Successfully Deleted!";
         header("Location: users.blg.admin.php?success=$sm");
         exit();
     } else {
         $em = "Error occurred!";
         header("Location: users.blg.admin.php?error=$em");
         exit();
     }

