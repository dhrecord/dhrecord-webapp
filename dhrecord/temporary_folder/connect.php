<?php

	$fullName = $_POST['fullName'];
	$nricNumber = $_POST['nricNumber'];
	$contactNumber = $_POST['contactNumber'];
	$email = $_POST['email'];
	$registrationNumber = $_POST['registrationNumber'];
	$licenseNumber = $_POST['licenseNumber'];
	$locationOfClinic = $_POST['locationOfClinic'];
	$clinicSpecialization = $_POST['clinicSpecialization'];

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
	if ($stmt = mysqli_prepare($conn, "insert into businessOwner(fullName, nricNumber, contactNumber, email, registrationNumber, licenseNumber, locationOfClinic, clinicSpecialization) values(?, ?, ?, ?, ?, ?, ?, ?)")) 
	{
		mysqli_stmt_bind_param($stmt, "ssssiiss", $fullName, $nricNumber, $contactNumber, $email, $registrationNumber, $licenseNumber, $locationOfClinic, $clinicSpecialization);
		mysqli_stmt_execute($stmt);
		header("Location: http://dhrecord.com/dhrecord/businessowner/LoginPage/");
		mysqli_close($conn);
    }
   else 
   {
   		echo "Error";
   }

?>

<?php

	//variables to go into registeredPatient
	$fullName = $_POST['fullName'];
	$nricNumber = $_POST['nricNumber'];
	$contactNumber = $_POST['contactNumber'];
	$email = $_POST['email'];
	$registrationNumber = $_POST['registrationNumber'];
	$licenseNumber = $_POST['licenseNumber'];
	$locationOfClinic = $_POST['locationOfClinic'];
	$clinicSpecialization = $_POST['clinicSpecialization'];

	//variables to go into users
	$role = "sa";
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

	$stmt = mysqli_prepare($conn, "insert into businessOwner(fullName, nricNumber, contactNumber, email, registrationNumber, licenseNumber, locationOfClinic, clinicSpecialization, users_ID) values(?, ?, ?, ?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "sssssssss", $fullName, $nricNumber, $contactNumber, $email, $registrationNumber, $licenseNumber, $locationOfClinic, $clinicSpecialization, $row['ID']);
	mysqli_stmt_execute($stmt);

	mysqli_close($conn);
	header("Location: http://dhrecord.com/dhrecord/businessowner/LoginPage/");

?>