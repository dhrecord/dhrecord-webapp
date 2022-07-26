<?php
session_start();

//unset($_SESSION["id"], $_SESSION["username"])
//session_unset();

$_SESSION = array();
session_destroy();


/*unset($_SESSION["id"]);
unset($_SESSION["username"]);
session_destroy();*/
// Redirect to the login page:
//clears browser history and redirects url
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 25 Jul 2022 08:00:00 GMT');
header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
die;

?>
