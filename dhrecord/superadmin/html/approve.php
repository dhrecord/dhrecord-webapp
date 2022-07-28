<?php

	$id = $_GET['id'];
	
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


	$toInsert = mysqli_prepare($conn, "SELECT * FROM businessOwnerForApproval WHERE id = $id");
	$toInsert->execute();
	$toInsert_Result = $toInsert->get_result();
	$row = $toInsert_Result->fetch_assoc();

	//inserting data
	$stmt = mysqli_prepare($conn, "insert into users(role, username, password) values (?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "sss", $row['role'], $row['username'], $row['password']);
	mysqli_stmt_execute($stmt);

	$stmt = $conn->prepare("SELECT ID FROM users where username = ?");
	$stmt->bind_param("s", $row['username']);
	$stmt->execute();
	$stmt_result = $stmt->get_result();
	$row1 = $stmt_result->fetch_assoc();

	$stmt = mysqli_prepare($conn, "insert into businessOwner(nameOfClinic, locationOfClinic, fullName, nricNumber, contactNumber, email, registrationNumber, licenseNumber, users_ID) values(?, ?, ?, ?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "ssssssssi", $row['nameOfClinic'], $row['locationOfClinic'], $row['fullName'], $row['nricNumber'], $row['contactNumber'], $row['email'], $row['registrationNumber'], $row['licenseNumber'], $row1['ID']);
	mysqli_stmt_execute($stmt);

	$sql = "DELETE FROM businessOwnerForApproval WHERE id = $id"; 
	
	if(mysqli_query($conn,$sql)){
		mysqli_close($conn);
		header('Location: registrationmanagement_businessowner.php');
	}
	else{
		echo "Error Approving, please try again";
	}

?>