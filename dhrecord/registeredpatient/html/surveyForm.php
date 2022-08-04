<?php

  session_start();
  if(!isset($_SESSION['loggedin']))
  {
    header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    exit;
  }

  $uName=$_SESSION['username'];
  $estimatedWait=$_POST['estimatedWait'];
  $clinicRef=$_POST['çlinicRef'];
  $docRef=$_POST['docRef'];	
  $serviceQuality=$_POST['serviceQuality'];
  $recommended=$_POST['recommended'];
  $medconds=$_POST['medconds'];

  $servername = "localhost";
  $database = "u922342007_Test";
  $username = "u922342007_admin";
  $password = "Aylm@012";

  $conn = mysqli_connect($servername, $username, $password, $database);

  $stmt = mysqli_prepare($conn, "insert into `surveyForm`(`username`,`timeTaken`, `nameClinic` , `nameDoc` , `rating` , `recommendation`,`remarks`) values (?, ?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "sssssss", $uName, $estimatedWait, $clinicRef, $docRef, $serviceQuality, $recommended, $medconds);
 //$stmt = mysqli_prepare($conn, "insert into `surveyForm`(`timeTaken`, `rating`, `recommendation`,`remarks`) values (?, ?, ?, ?)");
	//mysqli_stmt_bind_param($stmt, "ssis", $estimatedWait, $serviceQuality, $recommended, $medconds);
	mysqli_stmt_execute($stmt);

  header("Location: http://dhrecord.com/dhrecord/registeredpatient/html/surveyAndFeedback.php");
  mysqli_close($conn);
?>
