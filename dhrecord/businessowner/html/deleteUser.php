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

} elseif ($row['role'] == "dr"){
	// find doctor ID
	$queryDoc = "SELECT * FROM doctor WHERE userID='$UserID'";
	$resultDoc = $conn->query($queryDoc);
	$rowDoc = $resultDoc->fetch_assoc();
	$rowDocID = $rowDoc['doctorID'];

	// find clinic ID
	$sessionID = $_SESSION['id'];
	$queryClinic = "SELECT * FROM businessOwner WHERE users_ID=$sessionID";
	$clinicInfo = mysqli_query($conn,$queryClinic);
	$rowClinic = $clinicInfo->fetch_assoc();
	$clinicID = $rowClinic['ID'];

	// delete specializations from doctorSpec and businessOwnerSpec
	$queryDelete4 = "DELETE FROM doctorSpecialization WHERE doctorID='$rowDocID'";
	$queryDelete5 = "DELETE FROM businessOwnerSpecialization WHERE businessOwnerID='$clinicID'";

	// delete operating hours
	$queryDelete3 = "DELETE FROM operatingHours WHERE doctorID='$rowDocID'";
	// delete user
	$queryDelete1 = "DELETE FROM doctor WHERE userID='$UserID'";
	$queryDelete2 = "DELETE FROM users WHERE ID='$UserID'";

	if (mysqli_query($conn,$queryDelete5) && mysqli_query($conn,$queryDelete4) && mysqli_query($conn,$queryDelete3) && mysqli_query($conn,$queryDelete1) && mysqli_query($conn,$queryDelete2))
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