<?php

		//Database Connection
	    $servername = "localhost";
	    $database = "u922342007_Test";
	    $username = "u922342007_admin"; 
	    $password = "Aylm@012";
	    // Create connection
	    $conn = mysqli_connect($servername, $username, $password, $database);

        if(!$conn)
		{
			die("DB Connection Error");
		}

?>