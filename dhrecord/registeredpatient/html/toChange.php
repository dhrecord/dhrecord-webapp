<?php

session_start();
if(!isset($_SESSION['loggedin']))
{
	header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
	exit;
}

$userID = $_POST['userID'];
$userName = $_POST['userName'];
$newPassWord = $_POST['newPassWord'];
$confirmNewPassWord = $_POST['confirmNewPassWord'];

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

if($newPassWord = $confirmNewPassWord)
{
	$query = "UPDATE users SET username='$userName', password='$newPassWord' WHERE ID='$userID'";
	if (mysqli_query($conn,$query)) 
	{
		header('Location: changeUsernameOrPassword.php');
	}

	else
	{
		echo "something went wrong!";
	}
}
else 
{
	echo "passwords do not match!";
	header('Location: changeUsernameOrPassword.php');
}


?>