<?php 
require_once "../inc/config_session.blg.inc.php";
ConfigSession::startSession();

if (isset($_GET['review_id'])) {

    $review_id = $_GET['review_id'];
    require_once "../inc/dbh.blg.inc.php";
    require "inc/side-nav.blg.inc.admin.php"; 
    require_once "data/review.blg.data.admin.php";
    require_once ("data/category.blg.data.admin.php");

    $getReviews = new getReviews();
    $review = $getReviews->getByIdEvenPrivate($review_id);

    $getCategories = new getCategories();
    $category = $getCategories->getById($review['category']);
    ?>
<!-- It dealing with the review details like time published and category ...etc -->
<!DOCTYPE html>
                <html>
                    <head>
                        <title>Dashboard - <?=$review['title'] ?></title>
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
                                    <div class="card main-blog-card mb-5">
                                        <img src="../upload/blog/<?=$review['cover_url'] ?>" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?=$review['title'] ?></h5>
                                                    <?=$review['review'] ?></p>
                                                    <hr>
                                                <p class="card-text d-flex justify-content-between"><b>Category: <?=$category['category']?></b>
                                                    <small class="text-body-secondary">Date: <?=$review['created_at'] ?></small>
                                                </p>
                                            </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <script>
                            var navList = document.getElementById('navList').children;
                            navList.item(1).classList.add("active");
                        </script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
                    </body>
                </html>
<?php } else {
	header("Location: admin_log.blg.php");
	exit;
} ?>                