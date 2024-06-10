<?php 
require_once "../inc/config_session.blg.inc.php";
ConfigSession::startSession();
    ?>

<!DOCTYPE html>
    <html>
        <head>
            <title>Dashboard - Comments</title>
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
                require_once ("data/comment.blg.data.admin.php");
                require_once ("data/review.blg.data.admin.php");
                require_once ("data/users.blg.data.admin.php");
                
                $getComments = new getComments();
                $comments = $getComments->getALL();

                $getReviews = new getReviews();
                $getUsers = new getUsers();
                
            ?>
                <!-- reviews table -->
                <section class="section-1">
	                <div class="main-table">
                        <!--mb-3 horizontal margin -->
	 	                <h3 class="mb-3">All Comments</h3>
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

	 	                        <?php if ($comments != 0) { ?> <!-- If there's reviews make table and rows for them. -->
	 	                            <table class="table t1 table-bordered">
                                        <thead>
                                            <tr>
                                            <th scope="col">n</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Comment</th>
                                            <th scope="col">Comment image</th>
                                            <th scope="col">Action</th>
                                            </tr>
                                        </thead>
		                                <tbody>
		  	                                <?php foreach ($comments as $comment) { // For loop to make raws equal to the users numbers
                                               ?>
		                                        <tr> <!-- getting comment id -->
		                                            <th scope="row"><?=$comment['comment_id'] ?></th>
                                                        <!-- getting username by his id -->
                                                    <td>    
                                                        <?php $user = $getUsers->getUserById($comment['user_id']);
                                                            if ($user != 0) { 
                                                                echo '@'.$user['username']; 
                                                            } else { ?>
                                                                <span style="color: red">[deleted]</span>
                                                            <?php } ?> 
                                                    </td>
                                                        <!-- getting review title by its id -->
                                                    <td> <a href="single_review.blg.admin.php?review_id=<?=$comment['review_id']?>">
                                                        <?php $rev= $getReviews->getByIdEvenPrivate($comment['review_id']);
                                                            if ($rev != 0) { 
                                                                echo $rev['title']; 
                                                        } else { ?>
                                                            <span style="color: red" class="deleted-user">[deleted]</span>
                                                        <?php } ?> 
                                                        </a>
                                                    </td>
                                                    <td> <?=$comment['comment'] ?></td>
                                                    <td> <?php if (!empty($comment['comment_img'])) { ?>
                                                                <img src="../upload/com_img/<?=htmlspecialchars($comment['comment_img'])?>" width="520" height="350" alt="Comment Image">
                                                                <?php } else { echo 'none';} ?></td>

		      	                                    <td>
                                                        <!-- Review Delete -->
                                                        <a href="comment_delete.blg.admin.php?comment_id=<?=$comment['comment_id'] ?>" class="btn btn-danger">Delete</a>
                                    		        </td>
		                                        </tr>
		                                    <?php } ?>
		    
		                                </tbody>
		                            </table>
	                            <?php } else { ?> <!-- if there's no users show an alert -->
		                                <div class="alert alert-warning">Empty Comments!	</div>
	                                <?php } ?>
	                    </div>  
	                </section>
                    <script>
                        var navList = document.getElementById('navList').children;
                        navList.item(3).classList.add("active");
                    </script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        </body>
    </html>
