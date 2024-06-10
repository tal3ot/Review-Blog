<!-- Login -->
<?php
// loading files
require_once "inc/config_session.blg.inc.php";
// start the session
ConfigSession::startSession();
require_once "inc/login_view.blg.inc.php";

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="main-out-image"></div> <!-- image for the signup and login -->

    <div class="d-flex justify-content-center align-items-center vh-100">
    	
    	<form class="shadow w-450 p-3" action="inc/login.blg.inc.php" method="POST">

    		<h4 class="display-4  fs-1">LOGIN</h4><br>
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
		  
		  <button type="submit" class="btn btn-primary">Login</button>&nbsp;&nbsp; <!-- &nbsp; for a space between the words -->
          <a href="admin_log.blg.php" class="link-secondary">Admin Login</a><br>
		  <a href="ind.blg.php" class="link-secondary">Sign Up</a>&nbsp;&nbsp;
          <a href="blog.blg.php" class="link-secondary fs-4">Home</a>
		</form>
    </div>
</body>
</html>