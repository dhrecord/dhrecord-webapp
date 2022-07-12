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

	if (!$conn) 
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	
	//inserting data
	if ($stmt = mysqli_prepare($conn, "INSERT INTO `inventoryManagement` (`prescriptionName`, `prescriptionDesc`, `prescriptionQty`, `Remarks`) VALUES (?, ?, ?, ?)")) 
	{
		mysqli_stmt_bind_param($stmt, "sssssss", $prescriptionName, $prescriptionDesc, $Quantity, $Remarks);
		mysqli_stmt_execute($stmt);
		header("Location: http://dhrecord.com/dhrecord/businessowner/html/inventoryManagement.html");
		mysqli_close($conn);
    }
   else 
   {
   		echo "Error";
   }

?>