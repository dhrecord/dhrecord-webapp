<?php

$patientID = intval($_POST['patientID']);
$fullName = $_POST['fullName'];
$nricNumber = $_POST['nricNumber'];
$contactNumber = $_POST['contactNumber'];
$email = $_POST['email'];
$address = $_POST['address'];

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

$query = "UPDATE registeredPatient SET fullName='$fullName', nricNumber='$nricNumber' ,contactNumber='$contactNumber', email='$email', address='$address' WHERE users_ID='$patientID'";

if (mysqli_query($conn,$query)) 
{
	header('Location: index.php');
}
else
{
	echo "something went wrong!";
}

?>