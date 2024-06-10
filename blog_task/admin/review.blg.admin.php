<?php 
require_once "../inc/config_session.blg.inc.php";
ConfigSession::startSession();
    ?>

<!DOCTYPE html>
    <html>
        <head>
            <title>Dashboard - Reviews</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href= "../css/side-bar.css">
            <link rel="stylesheet" href= "../css/style.css">
        </head>
        <body>
            <?php 
                $key = "tal3ot";
                require_once "../inc/dbh.blg.inc.php";
                require_once "inc/side-nav.blg.inc.admin.php"; 
                require_once ("data/review.blg.data.admin.php");
                require_once ("data/category.blg.data.admin.php");
                require_once ("data/comment.blg.data.admin.php");
                
                $getReviews = new getReviews();
                $reviews = $getReviews->getAllEvenPrivate(); 

                $getCategories = new getCategories();
                $getComments = new getComments();
                
            ?>
                <!-- reviews table -->
                <section class="section-1">
	                <div class="main-table">
                        <!--mb-3 horizontal margin -->
	 	                <h3 class="mb-3">All Reviews <a href="review_add.blg.admin.php" class="btn btn-success">Add New</a></h3>
	 	                        <?php if (isset($_GET['error'])) { ?>	
                                    <div class="alert alert-warning">
                                        <?=htmlspecialchars($_GET['error'])?>
                                    </div>
	                            <?php } ?>

                                <?php if (isset($_GET['success'])) { ?>	
                                    <div class="alert alert-success">
                                        <?=htmlspecialchars($_GET['success'])?>
                                    </div>
                                <?php } ?>

	 	                        <?php if ($reviews != 0) { ?> <!-- If there's reviews make table and rows for them. -->
	 	                            <table class="table t1 table-bordered">
                                        <thead>
                                            <tr>
                                            <th scope="col">n</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Comments</th>
                                            <th>Likes</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
		                                <tbody>
		  	                                <?php foreach ($reviews as $rev) { // For loop to make raws equal to the users numbers
                                               $category = $getCategories->getById($rev['category'])?>
		                                        <tr> <!-- id -->
		                                            <th scope="row"><?=$rev['id'] ?></th>
                                                    <!-- title -->
		                                            <td><a href="single_review.blg.admin.php?review_id=<?=$rev['id'] ?>"><?=$rev['title'] ?></a></td>
                                                    <!-- category -->
                                                    <td><?=$category['category']?></td>
                                                    <!-- counting comments -->
                                                    <td><i class="fa fa-comment-o" aria-hidden="true"></i> 
                                                        <?php 
                                                            echo $getComments->countCommentsByReviewId($rev['id']);
                                                        ?>
                                                    </td>
                                                    <td><i class="fa  fa-thumbs-up" aria-hidden="true"></i> 
                                                        <?php 
                                                            echo $getComments->countLikesByReviewId($rev['id']);
                                                        ?>
                                                    </td>
		      	                                    <td>
                                                        <!-- Review Delete -->
                                                        <a href="review_delete.blg.admin.php?review_id=<?=$rev['id'] ?>" class="btn btn-danger">Delete</a>
                                                        <!-- Review edit -->
		      	                                        <a href="review_edit.blg.admin.php?review_id=<?=$rev['id'] ?>" class="btn btn-warning">Edit</a>
                                                        <!-- Make the review public or private -->
                                                        <?php if ($rev['publish'] == 1) { ?>
                                                                <!-- Make it public -->
                                                                <a href="review_publish.blg.admin.php?review_id=<?=$rev['id'] ?>&publish=1" class="btn btn-success disabled">Public</a>
                                                                <!-- Make it private -->
                                                                <a href="review_publish.blg.admin.php?review_id=<?=$rev['id'] ?>&publish=0" class="btn btn-dark">Private</a>
                                                        <?php } else { ?>
                                                                <!-- Make it public -->
                                                                <a href="review_publish.blg.admin.php?review_id=<?=$rev['id'] ?>&publish=1" class="btn btn-success">Public</a>
                                                                <!-- Make it private -->
                                                                <a href="review_publish.blg.admin.php?review_id=<?=$rev['id'] ?>&publish=0" class="btn btn-dark disabled">Private</a>
                                                        <?php } ?>
                                    		        </td>
		                                        </tr>
		                                    <?php } ?>
		    
		                                </tbody>
		                            </table>
	                            <?php } else { ?> <!-- if there's no users show an alert -->
		                                <div class="alert alert-warning">Empty Reviews!	</div>
	                                <?php } ?>
	                    </div>  
	                </section>
                    <script>
                        var navList = document.getElementById('navList').children;
                        navList.item(1).classList.add("active");
                    </script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        </body>
    </html>
