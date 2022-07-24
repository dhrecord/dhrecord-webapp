<?php
session_start();

//unset($_SESSION["id"], $_SESSION["username"])
session_unset();
session_destroy();

/*unset($_SESSION["id"]);
unset($_SESSION["username"]);
session_destroy();*/
// Redirect to the login page:
header('Location: http://www.dhrecord.com/dhrecord/LoginUnregisteredPatient/LoginPage/index.html');
?>
