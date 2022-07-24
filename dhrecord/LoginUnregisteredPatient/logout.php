<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["username"]);
session_destroy();
// Redirect to the login page:
header('Location: http://dhrecord.com/dhrecord/LoginUnregisteredPatient/LoginPage/index.html');
?>
