<?php
    require_once "../inc/config_session.blg.inc.php";
    ConfigSession::startSession();
?>

<!DOCTYPE html>
                <html>
                    <head>
                        <title>Dashboard - Add Reviews</title>
                        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                        <link rel="stylesheet" href= "../css/side-bar.css">
                        <link rel="stylesheet" href= "../css/style.css">
                        <!-- for the text editor -->
                        <link rel="stylesheet" href="../css/richtext.min.css">
                        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                        <script type="text/javascript" src="../js/jquery.richtext.min.js"></script>

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
                                    <h3 class="mb-3">Add New Review <a href="review.blg.admin.php" class="btn btn-secondary">Reviews</a></h3> 
                                    
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

                                    <form class="shadow p-3" action="req/review_add.blg.req.admin.php" method="POST" 
                                            enctype="multipart/form-data">
                                            <!-- the headline -->
                                           <div class="mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" placeholder="Write a headline for your review here">
                                            </div>
                                            <!-- the category -->
                                            <div class="mb-3">
                                                <label class="form-label" >Category</label>
                                                <select name="category" class="form-control">
                                                    <?php foreach ($categories as $category) { ?>
                                                            <option value="<?=$category['id']?>">
                                                                <?=$category['category']?> 
                                                            </option> 
                                                    <?php }?>
                                                </select>
                                            </div>
                                            <!-- Movie Cover -->
                                            <div class="mb-3">
                                                <label class="form-label">Movie's Best Frame/Poster</label>
                                                <input type="file" class="form-control" name="cover" placeholder="Upload your best Frame/Poster here">
                                            </div>
                                            <!-- Review Text Box -->
                                            <div class="mb-3">
                                                <label class="form-label">Review</label>
                                                    <textarea 
                                                        class="form-control text" name="review" placeholder="Write your review here">
                                                    </textarea>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary">Add</button>&nbsp;&nbsp; <!-- &nbsp; for a space between the words -->
                                    </form>
                                       
                                </div>
                            </section>
                        </div>
                        <script>
                            var navList = document.getElementById('navList').children;
                            navList.item(1).classList.add("active");
                            // text editor
                            $(document).ready(function() {
                                $('.text').richText();
                            });
                        </script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
                    </body>
                </html>