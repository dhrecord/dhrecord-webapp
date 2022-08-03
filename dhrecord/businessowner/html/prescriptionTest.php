<?php

	require_once("connection.php");	

if(isset($_POST['submit']))
{

	//$ID = $_GET['ID'];
    //$prescriptionName = $_POST['prescriptionName'];
	//$prescriptionDesc = $_POST['prescriptionDesc'];
	$ID = $_POST['prescription'];
	$prescriptionQty = $_POST['qty'];
	

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