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
		$stmt = $conn->prepare("SELECT ID, password FROM users where username = ?");
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
				session_regenerate_id();
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['id'] = $id;

				$stmt = $link->prepare('SELECT role FROM users WHERE id = ?');
				$stmt->bind_param('i', $id);
				$stmt->execute();
				$stmt->bind_result($type);
				$stmt->fetch();
				$stmt->close();	

				if ($role == "sa")
				{
					header('Location: http://dhrecord.com/dhrecord/superadmin/html/home.html');
				} else if ($role == "pt")
				{
					header('Location: http://dhrecord.com/dhrecord/registeredpatient/html/');
				}
			}else{
				echo "invalid username or password";
			}
		}else{
			echo "invalid username or password";
		}
	}

?>