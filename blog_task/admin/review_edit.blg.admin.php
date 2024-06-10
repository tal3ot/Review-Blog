<?php 
require_once "../inc/config_session.blg.inc.php";
ConfigSession::startSession();

if (isset($_GET['review_id'])) {

?>

<!DOCTYPE html>
    <html>
        <head>
            <title>Dashboard - Edit Reviews</title>
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
            require_once("../inc/dbh.blg.inc.php");
            require_once "inc/side-nav.blg.inc.admin.php"; 
            require_once("data/review.blg.data.admin.php");
            require_once ("data/category.blg.data.admin.php");


            $review_id = $_GET['review_id'];

            $getReviews = new getReviews();
            $rev = $getReviews->getById($review_id);

            $getCategories = new getCategories();
            $category = $getCategories->getAll()
            ?>
               <!-- reviews table -->
            <section class="section-1">
                <div class="main-table">
                    <!--mb-3 horizontal margin -->
                    <h3 class="mb-3">Edit Review<a href="review.blg.admin.php" class="btn btn-secondary">Reviews</a></h3>

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
                    <form class="shadow p-3" action="req/review_edit.blg.req.admin.php" method="POST" enctype="multipart/form-data">
                        <!-- the headline -->
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="<?=$rev['title']?>">
                                <input type="text" class="form-control" name="review_id" value="<?=$rev['id']?>" hidden>
                                <input type="text" class="form-control" name="cover_url" value="<?=$rev['cover_url']?>" hidden>
                        </div>
                        <!-- Movie Cover -->
                        <div class="mb-3">
                            <label class="form-label">Movie's Best Frame</label>
                            <input type="file" class="form-control" name="cover">
                            <img src="../upload/blog/<?=$rev['cover_url']?>" width="300">
                        </div>
                        <!-- Review Text Box -->
                        <div class="mb-3">
                            <label class="form-label">Review</label>
                            <textarea class="form-control text" name="review"><?=$rev['review']?></textarea>
                        </div>
                        <!-- the category -->
                        <div class="mb-3">
                            <label class="form-label" >Category</label>
                            <select name="category" class="form-control">
                                <?php foreach ($category as $cat) { ?>
                                        <option value="<?=$cat['id']?>" 
                                                <?php echo ($cat['id'] == $rev['category']) ? "selected": "" ?> >
                                            <?=$cat['category']?> 
                                        </option> 
                                <?php }?>
                            </select>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
	        </section>
            <script>
                var navList = document.getElementById('navList').children;
                navList.item(1).classList.add("active");

                $(document).ready(function() {
                    $('.text').richText();
                });
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        </body>
    </html>

<?php 
} else {
	    header("Location: ../admin_log.blg.php");
	    die();
    } ?> 