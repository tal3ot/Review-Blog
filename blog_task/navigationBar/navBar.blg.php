
<nav class="navbar navbar-expand-lg bg-body-tertiary" >
        <div class="container-fluid" >
            <a class="navbar-brand" href="blog.blg.php" >
                <b>
                    MY 
                    <span style="color: #0088ff;">BLOG</span>
                </b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
            <span class="navbar-toggler-icon" ></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" >
                <li class="nav-item" >
                <a class="nav-link active" aria-current="page" href="index.blg.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="blog.blg.php">Blog</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="genres.blg.php">Genres</a>
                </li>
                <?php if($logged) { ?>
                <li class="nav-item dropdown">
                    <!-- to show the name of the logged user -->
                <a  class="nav-link dropdown-toggle" 
                    href="profile.blg.php" 
                    role="button" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false">
                    <i class="fa fa-user" aria-hidden="true"> <!-- to show the user mark -->
                    </i>
                    @<?=$_SESSION['username']?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="out.blg.php">Logout</a></li>
                </ul>
                </li>
                <?php } else {?>  
                    <li class="nav-item">
                        <a class="nav-link" href="inc/login.blg.inc.php">Login | SignUp</a>
                    </li>
                <?php } ?>
            </ul>
            <form class="d-flex" role="search" method="GET" action="blog.blg.php">
                <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>