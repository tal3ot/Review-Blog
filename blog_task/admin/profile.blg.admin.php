<?php 
require_once "../inc/config_session.blg.inc.php";
ConfigSession::startSession();
    
if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) { ?>
<!-- Admin porfile -->
<!DOCTYPE html>
                <html>
                    <head>
                        <title>Dashboard - Users</title>
                        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                        <link rel="stylesheet" href= "../css/side-bar.css">
                        <link rel="stylesheet" href= "../css/style.css">
                    </head>
                    <body>
                        <?php 
                            $key = "tal3ot";
                            require_once "../inc/dbh.blg.inc.php";
                            require "inc/side-nav.blg.inc.admin.php"; 
                            require_once "data/admin.blg.data.admin.php";

                            $getAdmins = new getAdmins();
                            $admins = $getAdmins->getAdminById($_SESSION['admin_id']);
                            
                        ?>
                       <!-- users table -->
                            <section class="section-1">
                                <div class="main-table">
                                    <!--mb-3 horizontal margin -->
                                    <h3 class="mb-3">Admin Profile</h3> 
                                    
                                    <?php if (isset($_GET["error"])) { ?>
                                        <div class="alert alert-warning">
                                            <?=htmlspecialchars($_GET['error'])?>
                                        </div>
                                    <?php } ?>  
                                    
                                    <?php if (isset($_GET["success"])) { ?>
                                        <div class="alert alert-success">
                                            <?=htmlspecialchars($_GET['success'])?>
                                        </div>
                                    <?php } ?> 
                                    <form class="shadow p-3 mt-5" action="req/admin_edit.blg.req.admin.php" method="POST">
                                        <h3>Change Profile Info</h3>
                                            <!-- Change Username -->
                                           <div class="mb-3">
                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control" name="username" value="<?=$admins['username']?>">
                                            </div>   
                                            <!-- Change email -->     
                                            <div class="mb-3">
                                                <label class="form-label">E-mail</label>
                                                <input type="text" class="form-control" name="email" value="<?=$admins['email']?>">
                                            </div>                                
                                            <button type="submit" class="btn btn-primary">Change Info</button>
                                        </form>
                                            <!-- Change password --> 
                                        <form class="shadow p-3 mt-5" action="req/admin_edit_pass.blg.req.admin.php" method="POST">
                                            <h3 id="cpassword">Change Password</h3>
                                                <?php if (isset($_GET["p_error"])) { ?>
                                                    <div class="alert alert-warning">
                                                        <?=htmlspecialchars($_GET['p_error'])?>
                                                    </div>
                                                <?php } ?>  
                                                
                                                <?php if (isset($_GET["p_success"])) { ?>
                                                    <div class="alert alert-success">
                                                        <?=htmlspecialchars($_GET['p_success'])?>
                                                    </div>
                                                <?php } ?>
                                            <!-- Your Current Password -->
                                           <div class="mb-3">
                                                <label class="form-label">Current Password</label>
                                                <input type="password" class="form-control" name="c_pwd">
                                            </div>    
                                            <!-- Your New Password -->    
                                            <div class="mb-3">
                                                <label class="form-label">New Password</label>
                                                <input type="password" class="form-control" name="n_pwd">
                                            </div> 
                                            <!-- Confirm Your New Password -->
                                            <div class="mb-3">
                                                <label class="form-label">Confirm Password</label>
                                                <input type="password" class="form-control" name="c_n_pwd">
                                            </div>                                    
                                            <button type="submit" class="btn btn-primary">Change password</button>
                                    </form>
                                    
                                </div>
                            </section>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
                    </body>
                </html>

<?php } else {
	header("Location: admin_log.blg.adm.php");
	die();
} ?>                    