<?php 

	include 'connect.php';	

	//variables to go into registeredPatient
	$fullName = $_POST['fullName'];
	$nricNumber = $_POST['nricNumber'];
	$contactNumber = $_POST['contactNumber'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$medConditions = $_POST['med-conditions'];
	$drugAllergies = $_POST['drug-allergies'];

	//variables to go into users
	$role = "pt";
	$userName = $_POST['userName'];
	$passWord = $_POST['passWord'];

	//Database Connection
	$servername = "localhost";
	$database = "u922342007_Test";
	$username = "u922342007_admin";
	$password = "Aylm@012";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

	if (!$conn) 
	{
		die("Connection failed: " . mysqli_connect_error());
	}

	$stmt = mysqli_prepare($conn, "insert into tempRegisteredPatient(fullName, nricNumber, contactNumber, email, address, medConditions, drugAllergies, role, username, password) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "ssssssssss", $fullName, $nricNumber, $contactNumber, $email, $address, $medConditions, $drugAllergies, $role, $userName, $passWord);
	mysqli_stmt_execute($stmt);

?>