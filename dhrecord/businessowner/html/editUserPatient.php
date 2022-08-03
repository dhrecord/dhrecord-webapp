<?php

$patientID = intval($_POST['patientID']);
$fullName = $_POST['fullName'];
$contactNumber = $_POST['contactNumber'];
$email = $_POST['email'];
$medConditions = $_POST['medConditions'];
$drugAllergies = $_POST['drugAllergies'];

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

$query = "UPDATE registeredPatient SET fullName='$fullName', contactNumber='$contactNumber', email='$email', medConditions='$medConditions', drugAllergies='$drugAllergies' WHERE ID='$patientID'";

if (mysqli_query($conn,$query)) 
{
	header('Location: manageRecord.php');
}
else
{
	echo "something went wrong!";
}

?>