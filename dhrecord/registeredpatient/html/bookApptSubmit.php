<?php
  session_start();
  if(!isset($_SESSION['loggedin']))
  {
    header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    exit;
  }
  
  $docID = $_POST['docID'];
  $patID = $_POST['patID'];
  $agenda = $_POST['agenda'];
  $date = $_POST['date'];
  $time = $_POST['time'];

  $servername = "localhost";
  $database = "u922342007_Test";
  $username = "u922342007_admin";
  $password = "Aylm@012";

  echo $agenda;
  echo $date;
  echo $time;

  $conn = mysqli_connect($servername, $username, $password, $database);

//   $stmt = mysqli_prepare($conn, "insert into `appointment`(`date`, `time`, `agenda` , `doctorID` , `patientID`) values (?, ?, ?, ?, ?");
//   mysqli_stmt_bind_param($stmt, "sssss", $docID, $patID, $agenda, $date, $time);
//   mysqli_stmt_execute($stmt);

//   header("Location: http://dhrecord.com/dhrecord/registeredpatient/html/apptScheduling.php");
  mysqli_close($conn);
?>
