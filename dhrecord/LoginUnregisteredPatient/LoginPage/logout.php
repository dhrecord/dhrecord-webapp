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
header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');

die;
?>
