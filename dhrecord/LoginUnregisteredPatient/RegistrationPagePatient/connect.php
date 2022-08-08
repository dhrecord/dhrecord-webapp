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

	//timestamp
	$vkey = md5(time().$userName);
	$verifiedNegative = 0;

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

	$name = test_input($_POST['fullName']);

	if(!preg_match("/^[a-zA-Z-' ]*$/",$name))
	{
	
		$nameErr = "Only letters and white space allowed";
	
	}
	else
	{
		$subject = "Email Verification";
		$message = "Hi! Please click the link below to verify your email!<br> <a href='http://dhrecord.com/dhrecord/LoginUnregisteredPatient/RegistrationPagePatient/verify.php?vkey=$vkey'>Register Account</a>";
		$headers = "From: dentalrecord00@gmail.com \r\n";
		$headers .= "MIME-version: 1.0" . "\r\n";
		$headers .= "content-type:text/html;charset=UTF-8" . "\r\n";

		mail($email,$subject,$message,$headers);
	
		$stmt = mysqli_prepare($conn, "insert into tempRegisteredPatient(fullName, nricNumber, contactNumber, email, address, medConditions, drugAllergies, role, username, password, vkey, verified) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		mysqli_stmt_bind_param($stmt, "sssssssssssi", $fullName, $nricNumber, $contactNumber, $email, $address, $medConditions, $drugAllergies, $role, $userName, $passWord, $vkey, $verifiedNegative);
		mysqli_stmt_execute($stmt);

		mysqli_close($conn);
		header("Location: http://dhrecord.com/dhrecord/LoginUnregisteredPatient/LoginPage/");
	}

?>