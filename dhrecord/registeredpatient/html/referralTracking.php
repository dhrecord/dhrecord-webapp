<!DOCTYPE html>
<html lang="en">

		<?php
		session_start();
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
			if(!isset($_SESSION["loggedin"]))
			{
				header("location:http://www.dhrecord.com/dhrecord/LoginUnregisteredPatient/LoginPage/index.html");
			}

			$getid = $_SESSION['id'];

			$sql = ("SELECT referralTracking.referredBy, referralTracking.referralDate, referralTracking.patient_ID, registeredPatient.ID, 
					registeredPatient.fullName, registeredPatient.users_ID, users.ID FROM referralTracking, registeredPatient, users 
					WHERE referralTracking.patient_ID = registeredPatient.ID AND registeredPatient.users_ID = users.ID AND users.ID = '{$getid}'");
		
			$result = mysqli_query($conn, $sql);
			$conn->close();
		}
			?>
		
		

			<body>
				<table>
					<tr>
						<th>referredBy</th>
						<th>referralDate</th>
					</tr>
					<!-- PHP CODE TO FETCH DATA FROM ROWS -->
					<?php
						// LOOP TILL END OF DATA
						while($rows=$result->fetch_assoc())
						{
					?>
					<tr>
						<!-- FETCHING DATA FROM EACH
							ROW OF EVERY COLUMN -->
						<td><?php echo $rows['referredBy'];?></td>
						<td><?php echo $rows['referralDate'];?></td>
					</tr>
					<?php
						}
					?>
				</table>
			</body>
		
</html>