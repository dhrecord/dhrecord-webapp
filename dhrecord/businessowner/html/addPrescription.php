<?php

	

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
	//if ($stmt = mysqli_prepare($conn, "INSERT INTO inventoryManagement(prescriptionName,prescriptionDesc,prescriptionQty, Remarks) VALUES (?, ?, ?, ?)")) 
	//if ($stmt = mysqli_prepare($conn, "INSERT INTO `inventoryManagement` (`prescriptionName`, `prescriptionDesc`, `prescriptionQty`, `Remarks`) VALUES ('', '', '', '')"))
	//{
	//	mysqli_stmt_bind_param($stmt, "ssssssss", $prescriptionName, $prescriptionDesc, $prescriptionQty, $Remarks);
	//	mysqli_stmt_execute($stmt);
	//	header("Location: http://dhrecord.com/dhrecord/businessowner/html/inventoryManagement.html");
	//	mysqli_close($conn);
    //}
   //else 
   //{
   //		echo "Error";
   //}
   if (isset ($_POST['submit']))
   {
	   if(!empty($_POST['prescriptionName']) && !empty($_POST['prescriptionDesc']) && !empty($_POST['Quantity']) && !empty($_POST['Remarks'])) {

	   $prescriptionName = $_POST['prescriptionName'];
		$prescriptionDesc = $_POST['prescriptionDesc'];
		$prescriptionQty = $_POST['Quantity'];
		$Remarks = $_POST['Remarks'];	

		$query = "INSERT INTO inventoryManagement(prescriptionName, prescriptionDesc, prescriptionQty, Remarks) VALUES ('$prescriptionName', '$prescriptionDesc', '$prescriptionQty', '$Remarks')"
	   
		$run = mysqli_query($conn,$query) or die(mysqli_error());

		if ($run){
			echo "Form submitted successfully"
		}

		else {
			echo "Form not submitted"
		}
	   }

	   else {
		   echo "all fields required"
	   }
   }
   //$sql= "INSERT INTO `inventoryManagement` (`prescriptionName`, `prescriptionDesc`, `prescriptionQty`, `Remarks`) VALUES ('$prescriptionName', '$prescriptionDesc', '$prescriptionQty', '$Remarks')";
	header("Location: http://dhrecord.com/dhrecord/businessowner/html/AddNewPrescription.html");

?>