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
	$fetchVerified = mysqli_prepare($conn, "SELECT verified,vkey FROM tempRegisteredPatient WHERE verified = 0 AND vkey = '$vkey' LIMIT 1");
	$fetchVerified->execute();
	$resultSet = $fetchVerified->get_result();

	if($resultSet->num_rows == 1){
		 //change verified from 0 to 1
		 $update = mysqli_prepare($conn, "UPDATE tempRegisteredPatient SET verified = 1 WHERE vkey = '$vkey' LIMIT 1");
		 $update->execute();
		 
		 if ($update)
		 {
			 echo "Your account has been verified! You may proceed with login!";
		 }
		 else
		 {
			 echo "something went wrong!";
		 }

	}
	else{
		echo "This account is invalid or already verified";
	}
}else{
	die("Something went wrong D:");
}

?>