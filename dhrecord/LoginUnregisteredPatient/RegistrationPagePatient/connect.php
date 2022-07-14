<?php

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
	
	//inserting data
	$stmt = mysqli_prepare($conn, "insert into users(role, username, password) values (?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "sss", $role, $userName, $passWord);
	mysqli_stmt_execute($stmt);

	$stmt = $conn->prepare("SELECT ID FROM users where username = ?");
	$stmt->bind_param("s", $userName);
	$stmt->execute();
	$stmt_result = $stmt->get_result();
	$row = $stmt_result->fetch_assoc();

	$stmt = mysqli_prepare($conn, "insert into registeredPatient(fullName, nricNumber, contactNumber, email, address, medConditions, drugAllergies, users_ID) values(?, ?, ?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "ssssssss", $fullName, $nricNumber, $contactNumber, $email, $address, $medConditions, $drugAllergies, $row['ID']);
	mysqli_stmt_execute($stmt);

	mysqli_close($conn);
	header("Location: http://dhrecord.com/dhrecord/LoginUnregisteredPatient/LoginPage/");

?>