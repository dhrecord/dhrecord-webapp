<?php

	require_once("connection.php");	

if(isset($_POST['update']))
{

	$TESTID = $_GET['$ID'];
    $prescriptionName = $_POST['prescriptionName'];
	$prescriptionDesc = $_POST['prescriptionDesc'];
	$prescriptionQty = $_POST['Quantity'];
	$Remarks = $_POST['Remarks'];

	$queryy = "UPDATE `inventoryManagement` SET prescriptionName = '".$prescriptionName."', prescriptionDesc = '".$prescriptionDesc."', prescriptionQty = '".$prescriptionQty."', Remarks = '".$Remarks."' WHERE ID= '".$TESTID."'";
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



?>