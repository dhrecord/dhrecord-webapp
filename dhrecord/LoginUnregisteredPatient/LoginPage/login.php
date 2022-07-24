<?php
	
	session_start();

	if (!isset($_POST['userName'], $_POST['passWord']) ) 
	{
		exit('Please fill both the username and password fields!');
	}
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
		$stmt = $conn->prepare("SELECT * FROM users where username = ?");
		$stmt->bind_param("s", $userName);
		$stmt->execute();
		$stmt_result = $stmt->get_result();

		if($stmt_result->num_rows > 0)
		{
			$stmt->bind_result($id, $password);
			$stmt->fetch();
			$data = $stmt_result->fetch_assoc();

			if($data['password'] === $passWord) 
			{
				//$_SESSION['loggedin'] = TRUE;
				$_SESSION['username'] = $data['username'];
				
				$_SESSION['id'] = $data['ID'];
				
				echo $_SESSION["username"].$_SESSION["id"];
				if ($data['role'] === "sa")
				{
					header('Location: http://dhrecord.com/dhrecord/superadmin/html/home.php');
					die;
				} 
				
				else if ($data['role'] === "pt")
				{
					//echo $_SESSION['username'];
					//echo $_SESSION['id'];
					header('Location: http://dhrecord.com/dhrecord/registeredpatient/html/');
					die;
				}
				
				else if ($data['role'] === "ca")
				{
					header('Location: http://dhrecord.com/dhrecord/businessowner/html/index.php');
					die;
				}
				
				
			}else{
				echo "invalid username or password";
			}
		}else{
			echo "invalid username or password";
		}
	}

?>
