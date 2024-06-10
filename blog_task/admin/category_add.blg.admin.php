<?php
 require_once "../inc/config_session.blg.inc.php";
 ConfigSession::startSession();
 ?>
<!DOCTYPE html>
                <html>
                    <head>
                        <title>Dashboard - Category Add</title>
                        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                        <link rel="stylesheet" href= "../css/side-bar.css">
                        <link rel="stylesheet" href= "../css/style.css">
                    </head>
                    <body>
                        <?php 
                           
                            $key = "tal3ot";
                            require "inc/side-nav.blg.inc.admin.php"; 
                        ?>
                       <!-- users table -->
                            <section class="section-1">
                                <div class="main-table">
                                    <!--mb-3 horizontal margin -->
                                    <h3 class="mb-3">Create New Category <a href="category.blg.admin.php" class="btn btn-success">Categories</a></h3> 
                                    
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
                                    <form class="shadow p-3" action="req/category_add.blg.req.admin.php" method="POST">
                                            <!-- the headline -->
                                           <div class="mb-3">
                                                <label class="form-label">Category</label>
                                                <input type="text" class="form-control" name="category" placeholder="Write the category">
                                            </div>                                           
                                            <button type="submit" class="btn btn-primary">Add</button>&nbsp;&nbsp; <!-- &nbsp; for a space between the words -->
                                    </form>
                                       
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