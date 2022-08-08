<?php
  session_start();
  if(!isset($_SESSION['loggedin']))
  {
    header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    exit;
  }
  
  $apptID = $_POST['apptID'];

  $servername = "localhost";
  $database = "u922342007_Test";
  $username = "u922342007_admin";
  $password = "Aylm@012";

  $conn = mysqli_connect($servername, $username, $password, $database);
 
  $stmt = mysqli_prepare($conn, "delete from `appointment` where `apptID` = ?");
  mysqli_stmt_bind_param($stmt, "s", $apptID);

  // header("Location: http://dhrecord.com/dhrecord/registeredpatient/html/apptScheduling.php");
  mysqli_close($conn);
?>
