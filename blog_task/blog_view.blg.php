<!-- IT DEALING WITH THE BLOG FROM/INSIDE AN OPENING REVIEW -->
<?php 
require_once "inc/config_session.blg.inc.php";
ConfigSession::startSession();

$logged = false;

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])){
    $logged = true;
    $user_id = $_SESSION['user_id'];
}
    if (isset($_GET["review_id"])) {
        require_once "inc/dbh.blg.inc.php";
        require_once ("admin/data/review.blg.data.admin.php");
        require_once ("admin/data/users.blg.data.admin.php");
        require_once ("admin/data/comment.blg.data.admin.php");
        require_once ("admin/data/category.blg.data.admin.php");

        
        $id = $_GET["review_id"];
        // To get the review by id and show it
        $getReviews = new getReviews();
        $review = $getReviews->getById($id);

        // To get the comment on a review by id and show it
        $getComments = new getComments();
        $comments = $getComments->getCommentsByReviewId($id);

        // To get user who wrote the comment by id and show it
        $getUsers = new getUsers();

        // To get the categories (Genres) and show it
        $getCategories = new getCategories();
        $genres = $getCategories->getAll();
        // if someone tried to write and id of a private review or other things
        if ($review == 0) {
            header("Location: blog.blg.php");
            die();
         }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blog - <?=$review['title']?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css?">

    </head>
    <body>
        <?php 
            require_once "navigationBar/navBar.blg.php";
        ?>
        <div class="container mt-3">
            <section class="d-flex">
                    <main class="main-blog">
                            <!-- the review frame -->
                            <div class="card main-blog-card mt-3"> 
                                <!-- the review image -->
                                <img src="upload/blog/<?=$review['cover_url']?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <!-- the review title -->
                                        <h5 class="card-title"><?=$review['title']?></h5>
                                        <!-- the review content -->
                                        <p class="card-text"><?=$review['review']?></p>
                                        <hr>
                                            <div class="d-flex justify-content-between">
                                                <div class="react-btns"> <!-- Showing how manay comments and likes -->

                                                <?php 
                                                    if ($logged) { 
                                                        $liked = $getComments->isLikedByUserId($review['id'], $user_id);
                                                        if ($liked) {
                                                ?> <!-- to like the review from the inside -->
                                                            <i class="fa fa-thumbs-up liked like-btn" review-id="<?=$review['id']?>" liked="1" aria-hidden="true"></i>
                                                <?php } else { ?>
                                                        <i class="fa fa-thumbs-up like like-btn" review-id="<?=$review['id']?>" liked="0" aria-hidden="true"></i> 
                                                <?php } 
                                                    } else { ?> <!-- to not make the blue like if you arn't logged in from inside the review -->
                                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i> 
                                                    <?php }  ?>
                                                Likes ( 
                                                    <span> <?php 
                                                                echo $getComments->countLikesByReviewId($review['id']);
                                                            ?> 
                                                    </span> )  
                                                <i class="fa fa-comment-o" aria-hidden="true">
                                                </i> Comments (
                                                    <?php
                                                        echo $getComments->countCommentsByReviewId($review['id']);
                                                    ?> )                            
                                                                            
                                            </div>
                                        <p class="card-text">
                                            <small class="text-body-secondary"><?=$review['created_at']?></small>
                                        </p>
                                    </div>
                                    <form action="inc/comment.blg.inc.php" method="POST" id="comments" enctype="multipart/form-data">
                                        <hr>
                                        <h5 class="mt-3 text-secondary">Add Comment</h5>
                                        <!-- To show error and sucess messages when you write comment or not-->
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
                                        <div class="mb-3">
                                            
                                            <textarea class="form-control text mb-2" name="comment" placeholder="If you wanna say something write it here..."></textarea>
                                            <input type="file" class="form-control" name="comment_img">

                                            <input type="text" class="form-control" name="review_id" value="<?=$id?>" hidden>
                                        </div>                                  
                                        <button type="submit" class="btn btn-primary">Comment</button> <hr>
                                    </form>
                                    <div>
                                        <div class="comments"> <!-- the profile photo and username of the user who make a comment -->
                                            <?php 
                                                if ($comments !=0) { // show it if there's a comment
                                                    foreach ($comments as $comment) {
                                                        //To get the username of the one write the comment
                                                        $users = $getUsers->getUserById($comment['user_id']); ?>
                                                        <div class="comment d-flex">
                                                            <div>
                                                            <img src="img/user-default.png" width="50" height="50">
                                                            </div>
                                                            <div class="p-2"> <!-- To write the name of the user who commented -->
                                                                <?php if ($users != 0) { ?>
                                                                    <span>@<?=$users['username'];?></span>
                                                                <?php } else { ?>
                                                                    <span style="color: red">[Account deleted]</span>
                                                                <?php } ?>

                                                                
                                                               <div>
                                                                <p><?=htmlspecialchars($comment['comment'])?></p>
                                                                <?php if (!empty($comment['comment_img'])) { ?>
                                                                <img src="upload/com_img/<?=htmlspecialchars($comment['comment_img'])?>" width="520" height="350" alt="Comment Image">
                                                                <?php } ?>
                                                                </div>


                                                                <small class="text-body-secondary"><?=$comment['created_at']?></small>
                                                            </div>
                                                        </div><hr>
                                            <?php } } ?>
                                            </div>
                                    </div>
                            </div>
                            </div>
                    </main>
                    <aside class="aside-main">
                        <div class="list-group category-aside">
                            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                Category
                            </a>
                            <?php foreach ($genres as $genre) { ?>
                                <!-- To allow you access the genres when you're opening a review -->
                                <a href="genres.blg.php?category_id=<?=$genre['id']?>" class="list-group-item list-group-item-action"><?=$genre['category']?></a>
                            <?php } ?>
                        </div>
                    </aside>
            </section>
        </div>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- JQuery (add like or remove the like) -->
        <script>
            $(document).ready(function(){
            $(".like-btn").click(function(){
                var review_id = $(this).attr('review-id');
                var liked = $(this).attr('liked');

                if (liked == 1) {
                    $(this).attr('liked', '0');
                    $(this).removeClass('liked');
                } else {
                    $(this).attr('liked', '1');
                    $(this).addClass('liked');
                } // to mark the like button (click like)
                $(this).next().load("ajax/like-unlike.blg.ajax.php", {review_id: review_id});
            });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </body>
</html>

<?php } else {
	header("Location: blog.blg.adm.php");
	die();
} ?>   