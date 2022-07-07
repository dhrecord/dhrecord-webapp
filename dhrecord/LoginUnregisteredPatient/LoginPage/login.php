<?php

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
	
	else
	{
		$stmt = $conn->prepare("select * from registeredPatient where email = ?");
		$stmt->bind_param("s", $userName);
		$stmt->execute();
		$stmt_result = $stmt->get_result();
		if($stmt_result->num_rows > 0){
			$data = $stmt_result->fetch_assoc();
			if($data['password'] === $passWord) {
				echo "Login Successful";
			}else{
				echo "invalid username or password";
			}
		}else{
			echo "invalid username or password";
		}
	}

?>