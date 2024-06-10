<!-- genres handling file -->
<?php 
//start session
require_once "inc/config_session.blg.inc.php";
ConfigSession::startSession();

$logged = false;
// to check if the user logged in 
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $logged = true;
    $user_id = $_SESSION['user_id']; }
    // required files
    require_once "inc/dbh.blg.inc.php";
    require_once ("admin/data/review.blg.data.admin.php");
    require_once ("admin/data/comment.blg.data.admin.php");
    require_once ("admin/data/category.blg.data.admin.php");

    // To get the review by id and show it
    $getReviews = new getReviews();
    $reviews = $getReviews->getALL();
    // To get the comments and likes on a review by id and show it
    $getComments = new getComments();
    // To get the categories (Genres) and show it
    $getCategories = new getCategories();
    $genres = $getCategories->getAll();

    $categories = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php // For the name of category tab in the browser
        if (isset($_GET['category_id'])) {
            $categories = $getCategories->getById($_GET['category_id']);
            if ($categories == 0) {
                echo "Blog | Genre Page";
            } else {
                echo "Blog | ".$categories['category'];
            }            
            } else {
                echo "Blog | Genre Page";
                } 
                
        ?>  
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"><!--for the icons of like, comment, ...etc -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <!-- // Put it here to make the navigation bar stable (it was moving little when you search or interact with its buttons) -->
    <?php   require_once "navigationBar/navBar.blg.php"; ?>
    <div class="container mt-3">
        <h1 class="display-4 mb-2 fs-3 p-2">
            <?php //To write the name of the genre when you choose one for example (Reviews in Action Genre)
                if ($categories != 0) {
                    echo "Reviews in  ".$categories['category']." Genre";
                } else {
                    echo "Reviews";
                }              
            ?>
            
        </h1>
        <section class="d-flex">
        <?php if (!isset($_GET['category_id'])) { ?>
            <main class="main-blog p-2">
                <div class="list-group category-aside">
                    <?php foreach ($genres as $genre) { ?>
                        <a href="genres.blg.php?category_id=<?=$genre['id']?>" class="list-group-item list-group-item-action"><?php echo $genre['category']; ?> 
                        </a>
                    <?php } ?>
                </div>
            </main>
        <?php } else { 
            $reviews = $getReviews->getAllReviewsByCategory($_GET['category_id']); ?>
            <?php if ($reviews != 0) { ?>
                <main class="main-blog">
                        <?php foreach ($reviews as $review) { ?>
                            <!-- the review frame -->
                            <div class="card main-blog-card mt-3"> 
                                <!-- the review image -->
                                <img src="upload/blog/<?=$review['cover_url']?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <!-- the review title -->
                                        <h5 class="card-title"><?=$review['title']?></h5>
                                        <!-- the review content -->
                                            <?php $rev = strip_tags($review['review']); // to remove any tags or style of the font
                                                $rev = substr($rev, 0, 200);
                                            ?>
                                        <p class="card-text"><?=$rev?>...</p>
                                        <a href="blog_view.blg.php?review_id=<?=$review['id']?>" class="btn btn-primary">Read More</a>
                                        <hr>
                                            <div class="d-flex justify-content-between">
                                                <!-- Showing how manay comments and likes -->
                                                <div class="react-btns"> <!-- react-btns in style css to edit the comment and likes shape -->
                                                    <?php 
                                                        if ($logged) {
                                                            $liked = $getComments->isLikedByUserId($review['id'], $user_id);
                                                    
                                                        if ($liked) {
                                                    ?> <!-- to like the review from the out side -->
                                                            <i class="fa fa-thumbs-up liked like-btn" review-id="<?=$review['id']?>" liked="1" aria-hidden="true"></i>
                                                    <?php } else { ?>
                                                                <i class="fa fa-thumbs-up like like-btn" review-id="<?=$review['id']?>" liked="0" aria-hidden="true"></i> 
                                                    <?php } } else { ?> 
                                        <!-- to not make the blue like and show the like button if you arn't logged in from outside the review -->
                                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                            <?php } ?>
                                                            Likes ( 
                                                                <span> <?php 
                                                                            echo $getComments->countLikesByReviewId($review['id']);
                                                                        ?> 
                                                                </span> ) 
                                                    <a href="blog_view.blg.php?review_id=<?=$review['id']?>#comments">    
                                                        <i class="fa fa-comment-o" aria-hidden="true">
                                                        </i> Comments (
                                                            <?php
                                                                echo $getComments->countCommentsByReviewId($review['id']);
                                                            ?> )                            
                                                    </a>                                
                                                </div>
                                                <small class="text-body-secondary"><?=$review['created_at']?></small>
                                            </div>
                                    </div>
                            </div>
                        <?php } ?>    
                </main>
                <?php } else { ?>
                    <main class="main-blog p-2">
                        <div class="alert alert-warning">
                            No Reviews Yet!
                        </div>
                    </main>
            <?php } } ?>
                <aside class="aside-main">
                    <div class="list-group category-aside">
                        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">Genres</a>
                        <?php foreach ($genres as $genre) { ?>
                        <a href="genres.blg.php?category_id=<?=$genre['id']?>" class="list-group-item list-group-item-action"><?=$genre['category']?></a>
                        <?php } ?>
                    </div>
                </aside>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>