<?php
	//test bryan
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

	//$encryptedPassword = openssl_encrypt($passWord, $ciphering, $encryption_key, $options, $encryption_iv);

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

			$decryptedPassword = openssl_decrypt($data['password'], $ciphering, $decryption_key, $options, $decryption_iv)
			if($decryptedPassword === $passWord) 
			{
			//if($data['password'] === $passWord) 
			//{
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['username'] = $data['username'];
				$_SESSION['role'] = $data['role'];
				
				$_SESSION['id'] = $data['ID'];
				
				echo $_SESSION["username"].$_SESSION["id"];
				if ($data['role'] === "sa")
				{
					header('Location: ../../superadmin/html/home.php');
				} 
				
				else if ($data['role'] === "pt")
				{
					header('Location: ../../registeredpatient/html/index.php');
				}

				else
				{
					header('Location: ../../businessowner/html/index.php');
				}
				
				//else if ($data['role'] === "ca")
				//{
				//	header('Location: ../../businessowner/html/caindex.php');
				//}
				
				//else if ($data['role'] === "dr")
				//{
				//	header('Location: ../../businessowner/html/drindex.php');
				//}
				
				//else if ($data['role'] === "fd")
				//{
				//	header('Location: ../../businessowner/html/fdindex.php');
				//}
				
			}else{
				echo "invalid username or password";
			}
		}else{
			echo "invalid username or password";
		}
	}

?>
