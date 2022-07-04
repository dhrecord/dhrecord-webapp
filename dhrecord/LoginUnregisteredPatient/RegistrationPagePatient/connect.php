<?php

	$fullName = $_POST['fullName'];
	$nricNumber = $_POST['nricNumber'];
	$contactNumber = $_POST['contactNumber'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$medConditions = $_POST['med-conditions'];
	$drugAllergies = $_POST['drug-allergies'];

	//Database Connection
	$servername = "localhost";
	$database = "u922342007_Test";
	$username = "u922342007_admin";
	$password = "Aylm@012";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully";
	mysqli_close($conn);


	//else
	//{
		//$stmt = $conn->prepare("insert into registration(fullName, nricNumber, contactNumber, email, address, med-conditions, drug-allergies) values(?, ?, ?, ?, ?, ?, ?)");
		//$stmt->bind_param("sssssss", $fullName, $nricNumber, $contactNumber, $email, $address, $medConditions, $drugAllergies);
		//$stmt->execute();
		//echo "registration successful, returning to homepage . . . "
		//$stmt->close();
		//$conn->close();
	//}

	//if ($stmt = mysqli_prepare($conn, "insert into registration(fullName, nricNumber, contactNumber, email, address, med-conditions, drug-allergies) values(?, ?, ?, ?, ?, ?, ?)")) 
	//{
	//	mysqli_stmt_bind_param($stmt, "sssssss", $fullName, $nricNumber, $contactNumber, $email, $address, $med-conditions, $drug-allergies);
	//	mysqli_stmt_execute($stmt);
	//	echo "Data inserted";
    //}

   //else 
   //{
   //	echo "Error";
   //}

?>