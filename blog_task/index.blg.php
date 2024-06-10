<?php 
// start session
require_once "inc/config_session.blg.inc.php";
ConfigSession::startSession();
    $logged = false;
    // to get the user_id and username when you're logged in
    if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
        $logged = true;
        $user_id = $_SESSION['user_id']; }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css?v=1.0">
</head>
<body>
    <?php 
        require_once "navigationBar/navBar.blg.php";
    ?>
    <div class="main-banner wel"> <!-- welcome word -->
        <h1>WELCOME</h1>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>