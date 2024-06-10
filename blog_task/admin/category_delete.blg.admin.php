<?php

declare(strict_types= 1); //it prevent more errors from happening inside our code like typoo or submitting wrong type of data. 

error_reporting(E_ALL);
ini_set('display_errors', 1);

 require_once "../inc/dbh.blg.inc.php";
 require_once "data/category.blg.data.admin.php";

 
 $getCategories = new getCategories();

    $category_id = $_GET['id'];

     //delete a review
     $categories_del = $getCategories->deleteById($category_id);
 
     if ($categories_del) {
         $sm = "Successfully Deleted!";
         header("Location: category.blg.admin.php?success=$sm");
         exit();
     } else {
         $em = "Error occurred!";
         header("Location: category.blg.admin.php?error=$em");
         exit();
     }

