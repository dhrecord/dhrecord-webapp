<?php

session_start();
if(!isset($_SESSION['loggedin']))
{
	header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
	exit;
}

$UserID = $_GET['UserID'];
	
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

$query = "SELECT * FROM users WHERE ID='$UserID'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if ($row['role'] == "fd"){
	$queryDelete1 = "DELETE FROM frontDesk WHERE userID='$UserID'"; 
	$queryDelete2 = "DELETE FROM users WHERE ID='$UserID'"; 
	
	if (mysqli_query($conn,$queryDelete1) && mysqli_query($conn,$queryDelete2))
	{
		mysqli_close();
		header('Location: userManagement.php');
	}

	else
	{
		echo "something went wrong!";
		mysqli_close();
	}

}
elseif ($row['role'] == "ca"){
	$queryDelete1 = "DELETE FROM clinicAdmin WHERE userID='$UserID'"; 
	$queryDelete2 = "DELETE FROM users WHERE ID='$UserID'"; 
	
	if (mysqli_query($conn,$queryDelete1) && mysqli_query($conn,$queryDelete2))
	{
		mysqli_close();
		header('Location: userManagement.php');
	}

	else
	{
		echo "something went wrong!";
		mysqli_close();
	}

}

?>