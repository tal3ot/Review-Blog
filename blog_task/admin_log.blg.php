<!-- Admin Blog file -->
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "inc/config_session.blg.inc.php";
require_once "inc/signup_view.blg.inc.php";
require_once "inc/login_view.blg.inc.php";

ConfigSession::startSession();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	
	<div class="main-out-image"></div> <!-- image for the signup and login -->

    <div class="d-flex justify-content-center align-items-center vh-100">
    	
    <form class="shadow w-450 p-3" action="admin/admin_log.blg.adm.php" method="POST">

    		<h4 class="display-4  fs-1">Admin LOGIN</h4><br>
            <p>Only For Adminstrate</p>
                <?php if (isset($_SESSION["errors_login"])) { ?>
                    <div class="alert alert-danger" role="alert">
			            <?php echo checking_login_errors(); ?>
			        </div>
                <?php } ?>

		  <div class="mb-3">
		    <label class="form-label">E-Mail</label>
		    <input type="text" class="form-control" name="email" placeholder="Enter your email"
		           value="<?php echo (isset($_GET['email']))?htmlspecialchars($_GET['email']):"" ?>">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Password</label>
		    <input type="password" class="form-control" name="pwd" placeholder="Enter your password">
		  </div>
		  
		  <button type="submit" class="btn btn-primary">Login</button>
		  <a href="log.blg.php" class="link-secondary">User Login</a>
          <a href="blog.blg.php" class="link-secondary fs-4">Home</a>
		</form>
    </div>

</body>
</html>