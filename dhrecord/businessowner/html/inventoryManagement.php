<?php

	//$ID = 'default';
	$prescriptionName = $_POST['prescriptionName'];
	$prescriptionDesc = $_POST['prescriptionDesc'];
	$prescriptionQty = $_POST['Quantity'];
	$Remarks = $_POST['Remarks'];

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
	$q1 = mysqli_query($conn, "SELECT * FROM `inventoryManagement`");
		$res1 = [];

	while($row = mysqli_fetch_row($q1)) 
	{
	    array_push($res1, $row);
	}
	
	$title = "prescriptionName";
	$max = $res1[count($res1) - 1][1];
	$res2 = [];
	// Index for "title" ("A", "B", "C", ...)
	
	$i = 0;
	

	foreach ($res1 as $row) {
		$res2[$row[$i]][$row[1]] = $row[2];
	}

	

   if ($q1) { echo "success"; mysqli_close($conn); } else { echo "error"; mysqli_close($conn); }
  
	   //if(!empty($_POST['prescriptionName']) && !empty($_POST['prescriptionDesc']) && !empty($_POST['Quantity']) && !empty($_POST['Remarks'])) {

	    	

		   
 

?>