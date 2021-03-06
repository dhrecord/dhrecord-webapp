<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DHRecord</title>
    <link rel="stylesheet" href="../css/style.css" />

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jquery -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body onload="findData();">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid container">
            <a class="navbar-brand" href="./index.html"><b>DHRecord</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./apptSchedulingAndReminders.html">
                            Appointment Scheduling &
                            Reminder
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="./referralTracking.php">Referral Tracking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./surveyAndFeedback.html">Survey & Feedback</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./treatmentPlanning.html">Treatment Planning</a>
                    </li>
                </ul>
                <div class="d-flex flex-column align-items-end">
                    <p class="navbar-text text-white m-0">
                        Welcome, Username
                    </p>
                    <button type="button" class="btn btn-light ml-3 btn-sm mb-2" style="width: 90px;"
                            onclick="document.location.href='../../LoginUnregisteredPatient/LoginPage/index.html'">
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-5">Referral Tracking</h4>

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
			
		}
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
    </div>


    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    <script src="../js/index.js"></script>


</body>

</html>

