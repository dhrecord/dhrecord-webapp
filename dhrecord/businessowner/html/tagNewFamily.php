<?php

session_start();
if(!isset($_SESSION['loggedin']))
{
	header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
	exit;
}

$UserID = $_POST['patientID'];
$familyID = $_POST['familyMember'];
	
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

$query = "SELECT * FROM registeredPatient WHERE ID='$familyID'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

$query1 = "SELECT * FROM registeredPatient WHERE ID='$UserID'";
$result1 = $conn->query($query1);
$row1 = $result1->fetch_assoc();

$query2 = "SELECT * FROM familyTagHolder";
$result2 = $conn->query($query2);
$row2 = $result2->fetch_assoc();

$tempFamilyTag = $row2["familyTagHolder"];

if($row1['familyTag'] == "0")
{
	$query3 = "UPDATE registeredPatient SET familyTag='$tempFamilyTag' WHERE ID='$UserID'";
	if(mysqli_query($conn,$query3))
	{
		$toTag = $row1['familyTag'];
		$query4 = "UPDATE registeredPatient SET familyTag='$toTag' WHERE ID='$familyID'";
		$toIncrease = $tempFamilyTag + 1;
		$query5 = "UPDATE familyTagHolder SET familyTagHolder='$toIncrease'";
		if(mysqli_query($conn,$query4) && mysqli_query($conn,$query5))
		{
		
			header('Location: familyTagging.php');
		
		}
		else
		{
		
			echo "something went wrong!";
		
		}
	}
}
else
{
	
	$toTag = $row1['familyTag'];
	$query6 = "UPDATE registeredPatient SET familyTag='$toTag' WHERE ID='$familyID'";
	if(mysqli_query($conn,$query6))
	{
		
		header('Location: familyTagging.php');
		
	}
	else
	{
		
		echo "something went wrong!";
		
	}
	

}

?>