<?php

    session_start();
if(!isset($_SESSION['loggedin']))
{
    header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DHRecord</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdeliver.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"/>

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jquery -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid container">
            <a class="navbar-brand" href="./index.php"><b>DHRecord</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../html/apptScheduling.php">Appointment Scheduling & Reminder</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./referralTracking.php">Referral Tracking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./surveyAndFeedback.php">Survey & Feedback</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="./treatmentHistory.php">Treatment History</a>
                    </li>
                </ul>
                <div class="d-flex flex-column align-items-end">
                    <p class="navbar-text text-white m-0">
                        Welcome, <?php echo $_SESSION['username']; ?>
                    </p>
                    <button type="button" class="btn btn-light ml-3 btn-sm mb-2" style="width: 90px;"
                        onclick="document.location.href='../../LoginUnregisteredPatient/LoginPage/logout.php'">
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-4">Treatment History</h4>
        <div class="mb-4 d-flex align-items-center">
            <div class="d-flex align-items-center">
                <form class="form-inline" method="POST" action="">
			<label>Date:</label>
			<input type="date" class="form-control" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>"/>
			<label>To</label>
			<input type="date" class="form-control mt-1" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
			<button class="btn btn-primary mt-3" name="filter"><span class="glyphicon glyphicon-search"></span>Search</button>
		</form>
		<br/><br/><br/>
            </div>
        </div>
        <table class="table table-striped">
			<tr>
				<th>Date</th>
				<th>Attending Doctor</th>
				<th>Tooth Condition</th>
				<th>Medication Prescribed</th>
			</tr>    		
			
			 <?php                           
			//Database Connection
			$servername = "localhost";
			$database = "u922342007_Test";
			$username = "u922342007_admin";
			$password = "Aylm@012";
        
			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $database);
			       
			if(ISSET($_POST['filter']))
			{
				$date1 = date("Y-m-d", strtotime($_POST['date1']));
				$date2 = date("Y-m-d", strtotime($_POST['date2']));
				$query = mysqli_query($conn, "SELECT treatmentHistory.date, doctor.fullName, treatmentHistory.toothCondition,
				treatmentHistory.medicationPrescribed FROM treatmentHistory, registeredPatient, users, doctor
				WHERE treatmentHistory.attendingDoctor = doctor.doctorID AND treatmentHistory.pt_ID = registeredPatient.ID 
				AND registeredPatient.users_ID = users.ID AND users.ID =  '{$_SESSION['id']}' 
				AND date(treatmentHistory.date) BETWEEN '$date1' AND '$date2'") 
					or die(mysqli_error());
				$row=mysqli_num_rows($query);
				if($row>0)
				{
					while($fetch=mysqli_fetch_array($query))
					{
				?>
					<tr>
						<td><?php echo $fetch['date']?></td>
						<td><?php echo $fetch['fullName']?></td>
						<td><?php echo $fetch['toothCondition']?></td>
						<td><?php echo $fetch['medicationPrescribed']?></td>
					</tr>
				<?php
					}
				}else
				{
					echo'
					<tr>
						<td colspan = "4"><center>Record Not Found</center></td>
					</tr>';
				}
			} else
			{
				$query=mysqli_query($conn, "SELECT treatmentHistory.date, doctor.fullName, treatmentHistory.toothCondition,
				treatmentHistory.medicationPrescribed FROM treatmentHistory, registeredPatient, users, doctor
				WHERE treatmentHistory.attendingDoctor = doctor.doctorID AND treatmentHistory.pt_ID = registeredPatient.ID 
				AND registeredPatient.users_ID = users.ID AND users.ID =  '{$_SESSION['id']}' ") 
					or die(mysqli_error());
				while($fetch=mysqli_fetch_array($query))
				{
			?>
			<tr>
				<td><?php echo $fetch['date']?></td>
				<td><?php echo $fetch['fullName']?></td>
				<td><?php echo $fetch['toothCondition']?></td>
				<td><?php echo $fetch['medicationPrescribed']?></td>
			</tr>
			<?php
				}
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

