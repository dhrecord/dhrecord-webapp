<?php

	require_once("connection.php");	

if(isset($_POST['update']))
{

	$ID = $_GET['$ID'];
    $prescriptionName = $_POST['prescriptionName'];
	$prescriptionDesc = $_POST['prescriptionDesc'];
	$prescriptionQty = $_POST['Quantity'];
	$Remarks = $_POST['Remarks'];

	$query = " update `inventoryManagement` set prescriptionName = '".$prescriptionName."', prescriptionDesc = '".$prescriptionDesc."', prescriptionQty = '".$prescriptionQty."', Remarks = '".$Remarks."' where ID= '".$ID."'";
	$result = mysqli_query($conn,$query);

	if($result)
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