<?php

	require_once("connection.php");	

if(isset($_POST['update']))
{

	$ID = $_GET['ID'];    
	$prescriptionQty = $_POST['Quantity'];
	$prescriptionQty - 1;

	$queryy = "UPDATE `inventoryManagement` SET prescriptionQty = '".$prescriptionQty."'WHERE ID= '".$ID."'";
	$result1 = mysqli_query($conn,$queryy);

	if($result1)
	{
		header("location:inventoryManagement.php");
	}
	else
	{
		echo "please check your query"; 
	}

}
//else {
//	header("location:inventoryManagement.php");
//}


?>