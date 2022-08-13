<?php

$addSpecializationName = $_POST['addSpecializationName'];
$addDescription = $_POST['addDescription'];

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

$stmt = mysqli_prepare($conn, "insert into clinicSpecialization(specName, description) values (?,?)");
mysqli_stmt_bind_param($stmt, "ss", $addSpecializationName, $addDescription);

if (mysqli_stmt_execute($stmt)) 
{
	header('Location: clinicspecialization.php');
}
else
{
	echo "something went wrong!";
}

?>