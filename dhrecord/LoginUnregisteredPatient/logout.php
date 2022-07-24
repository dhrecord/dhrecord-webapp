<?php
session_start();
/*unset($_SESSION["id"]);
unset($_SESSION["username"]);*/
session_destroy();
// Redirect to the login page:
header('Location: http://www.dhrecord.com/dhrecord/LoginUnregisteredPatient/LoginPage/index.html');
?>
