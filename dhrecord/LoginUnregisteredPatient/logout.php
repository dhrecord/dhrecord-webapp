<?php
session_start();
session_destroy();
// Redirect to the login page:
header('Location: http://dhrecord.com/dhrecord/LoginUnregisteredPatient/LoginPage/index.html');
?>
