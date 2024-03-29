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
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="treatmentPlanningStyle.css">

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
                        <a class="nav-link" href="../html/apptScheduling.php">Appointment Scheduling</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./referralTracking.php">Referral Tracking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="./surveyAndFeedback.php">Survey & Feedback</a>
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
                        onclick="document.location.href='../../LoginUnregisteredPatient/LoginPage/logout.php'">Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h4 class="mb-4">Survey And Feedback</h4>
        <form method="post" action="./surveyForm.php">
        <div class="container border border-dark p-4" style="border-top-width: 10px!important;">
            <div class="mb-3 row">
                <label for="fullName" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-5">
                    <?php 
                    
			echo $_SESSION['username'];
                   ?>
                    
                </div>
            </div>
            <div class="mb-3 row">
                <label for="estimatedWait" class="col-sm-2 col-form-label">What was estimated waiting time after
                    scheduled appointment timing?</label>
                <div class="col-sm-1">
                    <input type="number" min="1" max="60" class="form-control" name="estimatedWait" id="estimatedWait" placeholder="mins" style="minn-width:60px;" required>
                </div>
            </div>
	 <div class="mb-3 row">
                <label for="pickDoc" class="col-sm-2 col-form-label">Name of clinic</label>
                <div class="col-sm-1">
                    <select style="width:200px" class="form-select" id="clinicRef" name="clinicRef" aria-label="Name of clinic" required>
			<option selected disabled hidden>Select</option>
			<?php
                          // Database Connection
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

                          $sessionID = $_SESSION['id'];

                          // GET THE LIST OF CLINICS
                          $resultBO = $conn->query("SELECT * FROM businessOwner");

                          while ($row = $resultBO->fetch_assoc())
                          {
                            echo '<option value="';

                            $fieldNOC = $row['nameOfClinic'];
                            echo $fieldNOC;

                            echo '">';

                            echo $fieldNOC;

                            echo '</option>';
                          }

                          mysqli_close($conn);
                        ?>
           	 </select>
                </div>
            </div>
	<div class="mb-3 row">
                <label for="pickDoc" class="col-sm-2 col-form-label">Name of Doctor</label>
                <div class="col-sm-1">
                    <select style="width:200px" class="form-select" id="docRef" name="docRef" aria-label="Name of doctor" required>
			<option selected disabled hidden>Select</option>
			<?php
                          // Database Connection
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

                          $sessionID = $_SESSION['id'];

                          // GET THE LIST OF DOCTORS
                          $resultBO = $conn->query("SELECT * FROM doctor");

                          while ($row = $resultBO->fetch_assoc())
                          {
                            echo '<option value="';

                            $fieldNOC = $row['fullName'];
                            echo $fieldNOC;

                            echo '">';

                            echo $fieldNOC;

                            echo '</option>';
                          }

                          mysqli_close($conn);
                        ?>
           	 </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="serviceQuality" class="col-sm-2 col-form-label">On a scale of 1-5 how was the quality of the
                    service you recieved</label>
                <div class="col-sm-10">
                    <br>
                    1 <input type="radio" name="serviceQuality" value="1" required>
                    2 <input type="radio" name="serviceQuality" value="2" required>
                    3 <input type="radio" name="serviceQuality" value="3" required>
                    4 <input type="radio" name="serviceQuality" value="4" required>
                    5 <input type="radio" name="serviceQuality" value="5" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="recommended" class="col-sm-2 col-form-label">Would you recommend our clinic to your friends
                    or family</label>
                <div class="col-sm-10">
                    yes <input type="radio" name="recommended" value="yes" required>
                    no <input type="radio" name="recommended" value="no" required> </div>
                </div>
                <div class="mb-3 row">
                    <label for="med-conditions" class="col-sm-2 col-form-label">Remarks</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" name="medconds" id="medconds" rows="10" cols="50" required></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="text-center"><button type="submit" class="btn btn-dark mt-4 px-5">Submit</button></div>
                </div>

            </div>
            </form>
        </div>

        <!-- bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</body>

</html>
