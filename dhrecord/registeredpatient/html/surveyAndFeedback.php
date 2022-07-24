<?php

    session_start();

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
                        <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
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
                        <a class="nav-link" href="./treatmentPlanning.php">Treatment Planning</a>
                    </li>
                </ul>
                <div class="d-flex flex-column align-items-end">
                    <p class="navbar-text text-white m-0">
                        Welcome, <?php echo $_SESSION['username']; ?>
                    </p>
                    <button type="button" class="btn btn-light ml-3 btn-sm mb-2" style="width: 90px;"
                        onclick="document.location.href='../../LoginUnregisteredPatient/LoginPage/index.html'">Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h4 class="mb-4">Survey And Feedback</h4>

        <div class="container border border-dark p-4" style="border-top-width: 10px!important;">
            <div class="mb-3 row">
                <label for="fullName" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="fullName">
                    
                </div>
            </div>
            <div class="mb-3 row">
                <label for="estimatedWait" class="col-sm-2 col-form-label">What was estimated waiting time after
                    scheduled appointment timing?</label>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="estimatedWait">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="serviceQuality" class="col-sm-2 col-form-label">On a scale of 1-5 how was the quality of the
                    service you recieved</label>
                <div class="col-sm-10">
                    <br>
                    1 <input type="radio" name="serviceQuality" value="1">
                    2 <input type="radio" name="serviceQuality" value="2">
                    3 <input type="radio" name="serviceQuality" value="3">
                    4 <input type="radio" name="serviceQuality" value="4">
                    5 <input type="radio" name="serviceQuality" value="5">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="recommended" class="col-sm-2 col-form-label">Would you recommend our clinic to your friends
                    or family</label>
                <div class="col-sm-10">
                    yes <input type="radio" name="recommended" value="yes">
                    no <input type="radio" name="recommended" value="no" </div>
                </div>
                <div class="mb-3 row">
                    <label for="med-conditions" class="col-sm-2 col-form-label">Remarks</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="med-conditions" rows="10" cols="50"></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="text-center"><button type="submit" class="btn btn-dark mt-4 px-5">Submit</button></div>
                </div>

            </div>
        </div>

        <!-- bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</body>

</html>
