<?php
	session_start();
	if(!isset($_SESSION['loggedin']))
	{
		header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
	    	exit;
	}
	require_once("connection.php");	

if(isset($_GET['Delete']))
{

	$ID = $_GET['Delete'];    

	$query = "DELETE from `inventoryManagement` WHERE ID= '".$ID."'";
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
