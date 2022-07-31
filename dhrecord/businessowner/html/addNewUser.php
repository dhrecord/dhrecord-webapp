<?php 

session_start();

$role = $_POST['role'];
$fullName = $_POST['fullName'];
$contactNumber = $_POST['contactNumber'];
$email = $_POST['email'];
$userName = $_POST['userName'];
$passWord = $_POST['passWord'];

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

$sessionID = $_SESSION['id'];
$query = "SELECT * FROM businessOwner WHERE users_ID=$sessionID";
$clinicInfo = mysqli_query($conn,$query);
$row = $clinicInfo->fetch_assoc();

$clinicID = $row['ID'];

//inserting data
$stmt = mysqli_prepare($conn, "insert into users(role, username, password) values (?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sss", $role, $userName, $passWord);
mysqli_stmt_execute($stmt);

$stmt = $conn->prepare("SELECT ID FROM users where username = ?");
$stmt->bind_param("s", $userName);
$stmt->execute();
$stmt_result = $stmt->get_result();
$row1 = $stmt_result->fetch_assoc();

//echo $row1['ID'];

//if($role === "dr")
//{
//
//}

if($role === "ca")
{
	$stmt = mysqli_prepare($conn, "insert into clinicAdmin(userID, fullName, contactNumber, email, clinicID) values(?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "isssi", $row1['ID'], $fullName, $contactNumber, $email, $clinicID);
	mysqli_stmt_execute($stmt);
	header('Location: addUser.php');
}

if($role === "fd")
{
	$stmt = mysqli_prepare($conn, "insert into frontDesk(userID, fullName, contactNumber, email, clinicID) values(?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "isssi", $row1['ID'], $fullName, $contactNumber, $email, $clinicID);
	mysqli_stmt_execute($stmt);
	header('Location: addUser.php');
}


?>