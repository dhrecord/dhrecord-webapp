<?php

	require_once("connection.php");	

if(isset($_POST['Delete']))
{

	$ID = $_GET['Delete'];    

	$query = "DELETE `inventoryManagement` WHERE ID= '".$ID."'";
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



?>