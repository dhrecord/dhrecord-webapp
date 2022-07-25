<?php

  $userName=$_SESSION['username'];
  $estimatedWait=$_POST['estimatedWait'];
  $serviceQuality=$_POST['serviceQuality'];
  $recommended=$_POST['recommended'];
  $medconds=$_POST['medconds'];

  $servername = "localhost";
  	$database = "u922342007_Test";
  	$username = "u922342007_admin";
  	$password = "Aylm@012";

  $conn = mysqli_connect($servername, $username, $password, $database);

  $stmt = mysqli_prepare($conn, "insert into `surveyForm`(`username`,`timeTaken`, `rating`, `recommendation`,`remarks`) values (?,?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "ssis", $username, $estimatedWait, $serviceQuality, $recommended, $medconds);
	mysqli_stmt_execute($stmt);

  mysqli_close($conn);
?>
