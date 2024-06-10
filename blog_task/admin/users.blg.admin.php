<?php 
require_once "../inc/config_session.blg.inc.php";
ConfigSession::startSession();
    
if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) { ?>
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
                            require_once "data/users.blg.data.admin.php";

                            $getUsers = new getUsers();
                            $users = $getUsers->getALL();
                        ?>
                       <!-- users table -->
                            <section class="section-1">
                                <div class="main-table">
                                    <!--mb-3 horizontal margin -->
                                    <h3 class="mb-3">All Users <a href="../inc/signup.blg.inc.php" class="btn btn-success">Add New</a></h3> 
                                    
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

                                    <?php if($users != 0) { ?> <!-- If there's users make table and rows for them. --> 
                                    <table class="table t1 table-bordered">
                                        <thead>
                                            <tr>
                                            <th scope="col">n</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">E-Mail</th>
                                            <th scope="col">Phone number</th>
                                            <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach ($users as $user) {  ?> <!-- For loop to make raws equal to the users numbers-->
                                                    <tr>
                                                    <th scope="row"><?=$user['id']  ?></th>
                                                    <td> <?=$user['username'] ?></td>
                                                    <td><?=$user['email'] ?></td>
                                                    <td><?=$user['phoneNum'] ?></td>
                                                    <td>
                                                        <a href="users_delete.blg.admin.php?user_id=<?=$user['id'] ?>" class="btn btn-danger">Delete</a>
                                                    </td>
                                                    </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php } else { ?> <!-- if there's no users show an alert -->
                                        <div class="alert alert-warning">Empty Users!</div>
                                    <?php } ?>    
                                </div>
                            </section>
                        </div>
                        <script>
                            var navList = document.getElementById('navList').children;
                            navList.item(0).classList.add("active");
                        </script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
                    </body>
                </html>
<?php } else {
	header("Location: admin_log.blg.adm.php");
	die();
} ?>                