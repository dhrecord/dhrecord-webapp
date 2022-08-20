<?php 

session_start();
if(!isset($_SESSION['loggedin']))
{
	header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
	exit;
}

$role = $_POST['role'];
$fullName = $_POST['fullName'];
$contactNumber = $_POST['contactNumber'];
$email = $_POST['email'];
$userName = $_POST['userName'];
//$passWord = $_POST['passWord'];
$plainPassWord = $_POST['passWord'];

// Store the cipher method
$ciphering = "AES-128-CTR";

// Use OpenSSl Encryption method
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;

// Non-NULL Initialization Vector for encryption
$encryption_iv = '1234567891011121';

// Store the encryption key
$encryption_key = "JovenChanDunCry";

// Non-NULL Initialization Vector for decryption
$decryption_iv = '1234567891011121';

// Store the decryption key
$decryption_key = "JovenChanDunCry";

$passWord = openssl_encrypt($plainPassWord, $ciphering, $encryption_key, $options, $encryption_iv);

// added - code added for doctor specializations
$CS = $_POST['clinicSpecializations'];

// added - code added for operating hours
$MondayFrom = $_POST['MondayFrom'];
$MondayTo = $_POST['MondayTo'];
$TuesdayFrom = $_POST['TuesdayFrom'];
$TuesdayTo = $_POST['TuesdayTo'];
$WednesdayFrom = $_POST['WednesdayFrom'];
$WednesdayTo = $_POST['WednesdayTo'];
$ThursdayFrom = $_POST['ThursdayFrom'];
$ThursdayTo = $_POST['ThursdayTo'];
$FridayFrom = $_POST['FridayFrom'];
$FridayTo = $_POST['FridayTo'];
$SaturdayFrom = $_POST['SaturdayFrom'];
$SaturdayTo = $_POST['SaturdayTo'];
$SundayFrom = $_POST['SundayFrom'];
$SundayTo = $_POST['SundayTo'];

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

if($role === "dr")
{
	$stmt = mysqli_prepare($conn, "insert into doctor(userID, fullName, contactNumber, email, clinicID) values(?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "isssi", $row1['ID'], $fullName, $contactNumber, $email, $clinicID);
	mysqli_stmt_execute($stmt);

	// added - get the doctor ID
	$stmtDID = $conn->prepare("SELECT doctorID FROM doctor where userID = ?");
	$stmtDID->bind_param("s", $row1['ID']);
	$stmtDID->execute();
	$stmt_resultDID = $stmtDID->get_result();
	$row2 = $stmt_resultDID->fetch_assoc();

	// added - inserting operating hours of a doctor
	$days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
	$TimeFrom = array($MondayFrom, $TuesdayFrom, $WednesdayFrom, $ThursdayFrom, $FridayFrom, $SaturdayFrom, $SundayFrom);
	$TimeTo = array($MondayTo, $TuesdayTo, $WednesdayTo, $ThursdayTo, $FridayTo, $SaturdayTo, $SundayTo);

	for ($x = 0; $x < 7; $x++) {
		$day = $days[$x];
		$st = $TimeFrom[$x];
		$et = $TimeTo[$x];

		$stmt2 = mysqli_prepare($conn, "insert into operatingHours(doctorID, day, start_time, end_time) values(?, ?, ?, ?)");
		mysqli_stmt_bind_param($stmt2, "isss",$row2['doctorID'], $day, $st, $et);
		mysqli_stmt_execute($stmt2);
	}

	// added - inserting doctor specializations + inserting it to business owner specializations
	// clean input
	$CS = substr($CS, 1, -1);
	$CSArr = explode('; ;', $CS);

	for($x=0; $x<count($CSArr); $x++){
		// insert data into doctor specialization table
		$stmt3 = mysqli_prepare($conn, "insert into doctorSpecialization(doctorID, specializationID) values(?, ?)");
		mysqli_stmt_bind_param($stmt3, "ii", $row2['doctorID'], $CSArr[$x]);
		mysqli_stmt_execute($stmt3);

		// insert data into business specialization table
		$stmt4 = mysqli_prepare($conn, "insert into businessOwnerSpecialization(businessOwnerID, specializationID) values(?, ?)");
		mysqli_stmt_bind_param($stmt4, "ii", $clinicID, $CSArr[$x]);
		mysqli_stmt_execute($stmt4);
	}

	header('Location: addUser.php');
}

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