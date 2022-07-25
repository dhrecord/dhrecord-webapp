<?php
	//variables to go into businessOwner
	$fullName = $_POST['fullName'];
	$nricNumber = $_POST['nricNumber'];
	$contactNumber = $_POST['contactNumber'];
	$email = $_POST['email'];
	$registrationNumber = $_POST['registrationNumber'];
	$licenseNumber = $_POST['licenseNumber'];
	$nameOfClinic = $_POST['nameOfClinic'];
	$locationOfClinic = $_POST['locationOfClinic'];
	$clinicSpecialization = $_POST['clinicSpecialization'];

	//variables to go into users
	$role = "ca";
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
	
	$subject = "Email Verification";
	$message = "Hi! Please click the link below to verify your email!<br> <a href='http://dhrecord.com/dhrecord/LoginUnregisteredPatient/RegistrationPageBusinessOwner/verify.php?vkey=$vkey'>Register Account</a>";
	$headers = "From: dentalrecord00@gmail.com \r\n";
	$headers .= "MIME-version: 1.0" . "\r\n";
	$headers .= "content-type:text/html;charset=UTF-8" . "\r\n";
	
	mail($email, $subject, $message, $headers);

	$stmt = mysqli_prepare($conn, "insert into tempRegisteredBusinessOwner(fullName, nricNumber, contactNumber, email, registrationNumber, licenseNumber, nameOfClinic, locationOfClinic, clinicSpecialization, role, username, password, vkey, verified) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "ssssiisssssssi", $fullName, $nricNumber, $contactNumber, $email, $registrationNumber, $licenseNumber, $nameOfClinic, $locationOfClinic, $clinicSpecialization, $role, $userName, $passWord, $vkey, $verifiedNegative);
	mysqli_stmt_execute($stmt);

	//inserting data
	//$stmt = mysqli_prepare($conn, "insert into users(role, username, password) values (?, ?, ?)");
	//mysqli_stmt_bind_param($stmt, "sss", $role, $userName, $passWord);
	//mysqli_stmt_execute($stmt);

	//$stmt = $conn->prepare("SELECT ID FROM users where username = ?");
	//$stmt->bind_param("s", $userName);
	//$stmt->execute();
	//$stmt_result = $stmt->get_result();
	//$row = $stmt_result->fetch_assoc();

	//$stmt = mysqli_prepare($conn, "insert into businessOwner(fullName, nricNumber, contactNumber, email, registrationNumber, licenseNumber, locationOfClinic, clinicSpecialization, users_ID) values(?, ?, ?, ?, ?, ?, ?, ?, ?)");
	//mysqli_stmt_bind_param($stmt, "sssssssss", $fullName, $nricNumber, $contactNumber, $email, $registrationNumber, $licenseNumber, $locationOfClinic, $clinicSpecialization, $row['ID']);
	//mysqli_stmt_execute($stmt);

	mysqli_close($conn);
	header("Location: http://dhrecord.com/dhrecord/LoginUnregisteredPatient/LoginPage/");

?>