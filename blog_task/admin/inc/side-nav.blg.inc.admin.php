<?php 

    if(isset($key) && $key == "tal3ot") {
        require_once "../inc/dbh.blg.inc.php";

    ?>
<input type="checkbox" id="checkbox">
    <header class="header">
        <h2 class="u-name">MY<b>BLOG</b>
            <label for="checkbox">
                <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
            </label>
        </h2>
        <i class="fa fa-user" aria-hidden="true"></i>
    </header>
    <div class="body">
        <nav class="side-bar">
            <div class="user-p">
                <a href="profile.blg.admin.php" class="main-profile-link">
                <img src="../img/batman.jpg">
                <h4>@<?php echo $_SESSION['username'];?></h4>
                </a>

            </div>
            <ul id="navList"> <!-- navigation list properties-->
                <li>
                    <a href="users.blg.admin.php">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="review.blg.admin.php">
                        <i class="fa fa-wpforms" aria-hidden="true"></i>
                        <span>Reviews</span>
                    </a>
                </li>
                <li>
                    <a href="category.blg.admin.php">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <span>Category</span>
                    </a>
                </li>
                <li>
                    <a href="comment.blg.admin.php">
                        <i class="fa fa-comment-o" aria-hidden="true"></i>
                        <span>Comment</span>
                    </a>
                </li>
                <li>
                    <a href="../log.blg.php">
                        <i class="fa fa-power-off" aria-hidden="true"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>

<?php } 
    ?>