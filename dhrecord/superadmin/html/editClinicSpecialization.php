<?php

$ID = $_POST['ID'];
$inputSpecializationName = $_POST['inputSpecializationName'];
$inputDescription = $_POST['inputDescription'];

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

$query = "UPDATE clinicSpecialization SET specName='$inputSpecializationName', description='$inputDescription' WHERE ID='$ID'";

if (mysqli_query($conn,$query)) 
{
	header('Location: clinicspecialization.php');
}
else
{
	echo "something went wrong!";
}

?>