<?php 
require_once "../inc/config_session.blg.inc.php";
ConfigSession::startSession();
    ?>
    <!DOCTYPE html>
                <html>
                    <head>
                        <title>Dashboard - Category</title>
                        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                        <link rel="stylesheet" href= "../css/side-bar.css">
                        <link rel="stylesheet" href= "../css/style.css">
                    </head>
                    <body>
                        <?php 
                            $key = "tal3ot";
                            require_once "../inc/dbh.blg.inc.php";
                            require "inc/side-nav.blg.inc.admin.php"; 
                            require_once "data/category.blg.data.admin.php";

                            $getCategories = new getCategories();
                            $categories = $getCategories->getALL();
                            
                        ?>
                       <!-- users table -->
                            <section class="section-1">
                                <div class="main-table">
                                    <!--mb-3 horizontal margin -->
                                    <h3 class="mb-3">All Categories <a href="category_add.blg.admin.php" class="btn btn-success">Add New</a></h3> 
                                    
                                    <?php if (isset($_GET["error"])) { ?>
                                        <div class="alert alert-warning">
                                            <?=htmlspecialchars($_GET['error'])?>
                                        </div>
                                    <?php } ?>  
                                    
                                    <?php if (isset($_GET["success"])) { ?>
                                        <div class="alert alert-success">
                                            <?=htmlspecialchars($_GET['success'])?>
                                        </div>
                                    <?php } ?> 

                                    <?php if($categories != 0) { ?> <!-- If there's users make table and rows for them. --> 
                                    <table class="table t1 table-bordered">
                                        <thead>
                                            <tr>
                                            <th scope="col">n</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach ($categories as $category) {  ?> <!-- For loop to make raws equal to the users numbers-->
                                                    <tr>
                                                    <th scope="row"><?=$category['id']  ?></th>
                                                    <td><?=$category['category'] ?></td>
                                                    <td>
                                                        <!-- Deleting the category -->
                                                        <a href="category_delete.blg.admin.php?id=<?=$category['id'] ?>" class="btn btn-danger">Delete</a>
                                                        <!-- Edit the category -->
                                                        <a href="category_edit.blg.admin.php?id=<?=$category['id'] ?>" class="btn btn-warning">Edit</a>
                                                    </td>
                                                    </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php } else { ?> <!-- if there's no users show an alert -->
                                        <div class="alert alert-warning">Empty Categories!</div>
                                    <?php } ?>    
                                </div>
                            </section>
                        </div>
                        <script>
                            var navList = document.getElementById('navList').children;
                            navList.item(2).classList.add("active");
                        </script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
                    </body>
                </html>