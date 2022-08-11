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
                        <a class="nav-link active" href="./referralTracking.php">Referral Tracking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./surveyAndFeedback.php">Survey & Feedback</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./treatmentHistory.php">Treatment History</a>
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
        <h4 class="mb-5">Referral Tracking</h4>
	    <div class="mb-4 d-flex align-items-center">
		    <div class="d-flex align-items-center">
			<p class="m-0"><b>Search:</b>&nbsp;&nbsp;&nbsp;</p>
			<div class="input-group">
			    <input type="text" id="searchbar_filter" class="form-control" placeholder="Enter Value ..." pattern="[a-zA-Z0-9]"
				aria-label="Name" aria-describedby="basic-addon2" style="max-width: 300px;" />
			</div>
		    </div>
            <select class="form-select" id="referralTracking_ddlfilter" aria-label="Filter By..."
                style="margin-left: 70px; max-width: 250px;">
                <option selected disabled hidden>Filter By...</option>
                <option value="1">Referred To</option>
                <option value="2">Referral Date</option>
                <option value="3">Referring Doctor</option>
                <option value="4">Tooth Condition</option>
	    	<option value="5">Comments</option>
            </select>
        </div>
	<table class="table table-striped">
		<thead>
        		<tr>
				<th>No</th>
        			<th>Referred To</th>
        			<th>Referral Date</th>
				<th>Referring Doctor</th>
				<th>Tooth Condition</th>
				<th>Comments</th>
				<th>Referral Letter</th>
        		</tr>
		</thead>
		
		<tbody id="data">
                 <?php                          
                    //Database Connection
                    $servername = "localhost";
                    $database = "u922342007_Test";
                    $username = "u922342007_admin";
                    $password = "Aylm@012";
        
                    // Create connection
                    $conn = mysqli_connect($servername, $username, $password, $database);
				           
			$res = ("SELECT referralTracking.ID, referralTracking.referredTo, referralTracking.referralDate, doctor.fullName, 
			referralTracking.toothCondition, referralTracking.comments FROM referralTracking, registeredPatient, users, doctor 
			WHERE users.ID = '{$_SESSION['id']}' AND referralTracking.referringDoctor = doctor.doctorID
			AND users.ID = registeredPatient.users_ID AND registeredPatient.ID = referralTracking.patient_ID");

			$result = mysqli_query($conn, $res);
					

                    while($sql = mysqli_fetch_assoc($result)){
                              echo "<tr><td>".$sql["ID"]."</td><td>".$sql["referredTo"]."</td><td>".$sql["referralDate"]."</td><td>".$sql["fullName"]
				      ."</td><td>".$sql["toothCondition"]."</td><td>".$sql["comments"]."</td><td><a class='btn btn-dark btn-sm' href='./dentalreferral.php?ID=".$sql["ID"]."'>Generate referral</a></td></tr>";
                            }
			        ?>         
		</tbody>
	</table>		
    	</div>


    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    <script src="../js/index.js"></script>
	<script src="../js/filter.js"></script>


</body>

</html>
