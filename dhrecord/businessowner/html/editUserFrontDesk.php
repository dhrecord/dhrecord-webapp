<?php

$frontdeskID = intval($_POST['frontdeskID']);
$fullName = $_POST['fullName'];
$contactNumber = $_POST['contactNumber'];
$email = $_POST['email'];
$clinicID = $_POST['clinicID'];

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

$query = "UPDATE frontDesk SET fullName='$fullName', contactNumber='$contactNumber', email='$email' WHERE frontdeskID='$frontdeskID'";

if (mysqli_query($conn,$query)) 
{
	header('Location: userManagement.php');
}
else
{
	echo "something went wrong!";
}

?>