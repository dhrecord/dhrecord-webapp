<?php
session_start();

//unset($_SESSION["id"], $_SESSION["username"])
//session_unset();

$_SESSION = array();
session_destroy();

die;
/*unset($_SESSION["id"]);
unset($_SESSION["username"]);
session_destroy();*/
// Redirect to the login page:
//clears browser history and redirects url
<SCRIPT LANGUAGE="javascript">
function ClearHistory()
{
     var backlen = history.length;
     history.go(-backlen);
     window.location.href = ../../LoginUnregisteredPatient/LoginPage/index.html
}
</SCRIPT>
//header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');


?>
