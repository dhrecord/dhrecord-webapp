<?php 

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

if(isset($_GET['vkey'])){

	$vkey = $_GET['vkey'];
	$fetchVerified = mysqli_prepare($conn, "SELECT verified,vkey FROM tempRegisteredBusinessOwner WHERE verified = 0 AND vkey = '$vkey' LIMIT 1");
	$fetchVerified->execute();
	$resultSet = $fetchVerified->get_result();
	

	if($resultSet->num_rows == 1)
	{
		 //change verified from 0 to 1
		 $update = mysqli_prepare($conn, "UPDATE tempRegisteredBusinessOwner SET verified = 1 WHERE vkey = '$vkey' LIMIT 1");
		 $update->execute();
		 
		 if ($update)
		 {
			$toInsert = mysqli_prepare($conn, "SELECT * FROM tempRegisteredBusinessOwner WHERE vkey = '$vkey'");
			$toInsert->execute();
			$toInsert_Result = $toInsert->get_result();
			$row = $toInsert_Result->fetch_assoc();

			//inserting data
			$stmt = mysqli_prepare($conn, "insert into users(role, username, password) values (?, ?, ?)");
			mysqli_stmt_bind_param($stmt, "sss", $row['role'], $row['username'], $row['password']);
			mysqli_stmt_execute($stmt);

			$stmt = $conn->prepare("SELECT ID FROM users where username = ?");
			$stmt->bind_param("s", $row['username']);
			$stmt->execute();
			$stmt_result = $stmt->get_result();
			$row1 = $stmt_result->fetch_assoc();

			$stmt = mysqli_prepare($conn, "insert into businessOwner(fullName, nricNumber, contactNumber, email, registrationNumber, licenseNumber, nameOfClinic, locationOfClinic, clinicSpecialization, users_ID) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			mysqli_stmt_bind_param($stmt, "ssssiisssi", $row['fullName'], $row['nricNumber'], $row['contactNumber'], $row['email'], $row['registrationNumber'], $row['licenseNumber'], $row['nameOfClinic'], $row['locationOfClinic'], $row['clinicSpecialization'], $row1['ID']);
			mysqli_stmt_execute($stmt);

			$deleteRow = mysqli_prepare($conn, "DELETE FROM tempRegisteredBusinessOwner WHERE vkey = '$vkey'");
			$deleteRow->execute();
			
			if($deleteRow)
			{
				echo "Your account has been verified! You may proceed with login!";
			}

			else
			{
				echo "something went wrong with deletion!";
			}
			
		 }

		 else
		 {
			echo "something went wrong!";
		 }

	}

	else
	{
		echo "This account is invalid or already verified";
	}
}

else{
	die("Something went wrong D:");
}

?>