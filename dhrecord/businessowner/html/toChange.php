<?php

session_start();
if(!isset($_SESSION['loggedin']))
{
	header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
	exit;
}

$userID = $_POST['userID'];
$newPassWord = $_POST['newPassWord'];
$confirmNewPassWord = $_POST['confirmNewPassWord'];

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

if(empty($newPassWord))
{
    header('Location: index.php');
}
else
{
    if($newPassWord == $confirmNewPassWord)
    {
        $encryptedPassword = openssl_encrypt($newPassWord, $ciphering, $encryption_key, $options, $encryption_iv);
        $query = "UPDATE users SET password='$encryptedPassword' WHERE ID='$userID'";
    	//$query = "UPDATE users SET password='$newPassWord' WHERE ID='$userID'";
    	if (mysqli_query($conn,$query)) 
    	{
    		header('Location: changeUsernameOrPasswordBusinessOwner.php');
    	}
    
    	else
    	{
    		echo "something went wrong!";
    	}
    }
    else 
    {
    	header('Location: passwordsDontMatchBusinessOwner.php');
    }
}



?>