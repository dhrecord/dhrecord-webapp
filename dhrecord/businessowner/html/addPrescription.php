<?php

	

	//Database Connection
	$servername = "localhost";
	$database = "u922342007_Test";
	$username = "u922342007_admin";
	$password = "Aylm@012";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

	$ID = default;
	$prescriptionName = $_POST['prescriptionName'];
	$prescriptionDesc = $_POST['prescriptionDesc'];
	$prescriptionQty = $_POST['Quantity'];
	$Remarks = $_POST['Remarks'];

	if (!$conn) 
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	
	//inserting data
	//if ($stmt = mysqli_prepare($conn, "insert into inventorymanagement(prescriptionname,prescriptiondesc,prescriptionqty, remarks) values (?, ?, ?, ?)")) 
	if ($stmt = mysqli_prepare($conn, "insert into inventorymanagement(ID,prescriptionname, prescriptiondesc, prescriptionqty, remarks) values (?,?, ?, ?, ?)"))
	{
		
		mysqli_stmt_bind_param($stmt, "ssssssss", $ID,$prescriptionname, $prescriptiondesc, $prescriptionqty, $remarks);
		mysqli_stmt_execute($stmt);

		header("location: http://dhrecord.com/dhrecord/businessowner/html/inventorymanagement.html");
		mysqli_close($conn);
    }

   if ($stmt) { echo "success"; mysqli_close($conn); } else { echo "error"; mysqli_close($conn); }
  
	   //if(!empty($_POST['prescriptionName']) && !empty($_POST['prescriptionDesc']) && !empty($_POST['Quantity']) && !empty($_POST['Remarks'])) {

	    	

		   
 

?>