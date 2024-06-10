<!-- Signup file -->
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
// attaching the required files
require_once "inc/config_session.blg.inc.php";
require_once "inc/signup_view.blg.inc.php";
require_once "inc/login_view.blg.inc.php";
//start session
ConfigSession::startSession();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign UP</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

    <div class="main-out-image"></div> <!-- image for the signup and login -->

    <div class="d-flex justify-content-center align-items-center vh-100">
    	
    <form class="shadow w-450 p-4" action="inc/signup.blg.inc.php" method="post">

    		<h4 class="display-4  fs-2"><b>Create New Account</b></h4>
            <h4 class="display-4 fs-4" style="color: blue;">To infinity and beyond!</h4>
     <!-- It's in the view file and in recap it let the right data written and remove what is wrong when the users enter their data -->
    		<?php
                    signup_inputs();
            ?>
                <?php if (isset($_SESSION["errors_signup"])) { ?>
                    <div class="alert alert-danger" role="alert">
			            <?php echo checking_signup_errors(); ?>
			        </div>
                <?php } else if (isset($_GET['signup']) && $_GET['signup'] === "success") { ?>
                    <div class="alert alert-success" role="alert">
			            <?php 
                    echo '<p class="form-success">Signup Success! <br> Now click on the login button to enter the blog.</p>'; ?>
			        </div>
                <?php } ?>
		  
		  <button type="submit" class="btn btn-primary">Sign Up</button>
		  <a href="log.blg.php" class="link-secondary">Login</a>
          <a href="blog.blg.php" class="link-secondary fs-4">Home</a>
		</form>
    </div>
</body>
</html>



