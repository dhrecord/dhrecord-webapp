<?php

	//variables to go into registeredPatient
	$fullName = $_POST['fullName'];
	$nricNumber = $_POST['nricNumber'];
	$contactNumber = $_POST['contactNumber'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$medConditions = $_POST['med-conditions'];
	$drugAllergies = $_POST['drug-allergies'];
	$attendingDoctor = $_POST['attendingDoctor'];

	//variables to go into users
	$role = "pt";
	$userName = $_POST['userName'];
	$passWord = $_POST['passWord'];

	// Store the cipher method
	$ciphering = "AES-128-CTR";
  
	// Use OpenSSl Encryption method
	$iv_length = openssl_cipher_iv_length($ciphering);
	$options = 0;

	// Non-NULL Initialization Vector for encryption
	$encryption_iv = '1234567891011121';

	// Store the encryption key
	$encryption_key = "JovenChanDunCry";

	$encryptedPassword = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);

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


	if(!preg_match("/^[a-zA-Z-' ]*$/",$fullName))
	{
		echo "Only letters and white space allowed";
		//header("Location: index.php");
	
	}
	else if(!preg_match("/[A-Z]{1}[\d]{7}[A-Z]{1}/",$nricNumber))
	{
	
		echo "please enter a valid NRIC";
	
	}
	else if(!preg_match("/[0-9]{8}/",$contactNumber))
	{
		echo "Only numbers allowed";
		//header("Location: index.php");
	
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
	
		echo "Please enter a valid email";
		//header("Location: index.php");		
	
	}
	else
	{
		$subject = "Email Verification";
		$message = "Hi! Please click the link below to verify your email!<br> <a href='http://dhrecord.com/dhrecord/LoginUnregisteredPatient/RegistrationPagePatient/verify.php?vkey=$vkey'>Register Account</a>";
		$headers = "From: dentalrecord00@gmail.com \r\n";
		$headers .= "MIME-version: 1.0" . "\r\n";
		$headers .= "content-type:text/html;charset=UTF-8" . "\r\n";

		mail($email,$subject,$message,$headers);
	
		$stmt = mysqli_prepare($conn, "insert into tempRegisteredPatient(fullName, nricNumber, contactNumber, email, address, medConditions, drugAllergies, role, username, password, attendingDoctor, vkey, verified) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		mysqli_stmt_bind_param($stmt, "ssssssssssssi", $fullName, $nricNumber, $contactNumber, $email, $address, $medConditions, $drugAllergies, $role, $userName, $encryptedPassword, $attendingDoctor, $vkey, $verifiedNegative);
		mysqli_stmt_execute($stmt);

		mysqli_close($conn);
		header("Location: http://dhrecord.com/dhrecord/LoginUnregisteredPatient/LoginPage/");
	}

?>