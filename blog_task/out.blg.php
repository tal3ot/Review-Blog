<!-- LogOut File -->
<?php  
require_once "inc/config_session.blg.inc.php";
ConfigSession::startSession();

session_unset();
session_destroy();

header("Location: log.blg.php");
exit;