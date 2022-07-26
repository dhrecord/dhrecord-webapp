<?php 
    session_start();  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!--script language="javascript" type="text/javascript">
    window.history.forward();
  </script>-->
<meta Http-Equiv="Cache-Control" Content="no-cache"/>
<meta Http-Equiv="Pragma" Content="no-cache"/>
<meta Http-Equiv="Expires" Content="0"/>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DHRecord</title>
    <link rel="stylesheet" href="../css/style.css" />

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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


    <main class="container my-5">
        <div class="bg-light p-5 rounded mt-3">
            <h1>Homepage</h1>
            <hr>
            <h4 class="lead">Welcome, <?php echo $_SESSION['username']; ?></h4>
            <h4 class="lead">Your next appointment is in 21 days.</h4>
            <hr>
            <p>
                <!--# temporary => later can add notifications and other functionalites <br> # e.g. list of accounts that
                need to
                be
                reviewed and approved.-->

                <?php 
                
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

                        $sessionID = $_SESSION['id'];

                        $stmt = $conn->prepare("SELECT * FROM registeredPatient where users_ID = ?");
                        $stmt->bind_param("s", $sessionID);
                        $stmt->execute();
		                $stmt_result = $stmt->get_result();
                        $data = $stmt_result->fetch_assoc();
                ?>

                <br><h5>Name: <?php echo $data['fullName']; ?></h5><br>
                <br><h5>NRIC: <?php echo $data['nricNumber']; ?></h5><br>
                <br><h5>Contact Number: <?php echo $data['contactNumber']; ?></h5><br>
                <br><h5>Email: <?php echo $data['email']; ?></h5><br>
                <br><h5>Address: <?php echo $data['address']; ?></h5><br>
                <br><h5>Medical Conditions: <?php echo $data['medConditions']; ?></h5><br>
                <br><h5>Drug Allergies: <?php echo $data['drugAllergies']; ?></h5><br>
            </p>
            <!-- <a class="btn btn-lg btn-primary" href="/docs/5.0/components/navbar/" role="button">View navbar docs &raquo;</a> -->
        </div>
    </main>


    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
