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
  <!--script language="javascript" type="text/javascript">
    window.history.forward();
  </script>-->

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
                        <a class="nav-link" href="../html/apptScheduling.php">Appointment Scheduling</a>
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
        <div class="bg-light pt-4 pb-5 px-5 rounded mt-3">
            <!-- <h1>Homepage</h1> -->
            <hr>
            <h4 class="lead">Welcome, <?php echo $_SESSION['username']; ?></h4>
            <!--<h4 class="lead">Your next appointment is in 21 days.</h4>-->
            <hr>
            <div>
                <!--# temporary => later can add notifications and other functionalites <br> # e.g. list of accounts that
                need to
                be
                reviewed and approved.-->
                <h5 class="pt-3">Profile Details</h5>

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
                <div class="mt-3 p-4 rounded border border-dark" style="border-top-width: 10px!important;">
                    <p style="font-size: 1.1rem; margin-top: 0; margin-bottom: 0.5rem;line-height: 1.2;"><span style="font-weight: 500;">Name: </span><?php echo $data['fullName']; ?></p>
                    <p style="font-size: 1.1rem; margin-top: 0; margin-bottom: 0.5rem;line-height: 1.2;"><span style="font-weight: 500;">NRIC: </span><?php echo $data['nricNumber']; ?></p>
                    <p style="font-size: 1.1rem; margin-top: 0; margin-bottom: 0.5rem;line-height: 1.2;"><span style="font-weight: 500;">Contact Number: </span><?php echo $data['contactNumber']; ?></p>
                    <p style="font-size: 1.1rem; margin-top: 0; margin-bottom: 0.5rem;line-height: 1.2;"><span style="font-weight: 500;">Email: </span><?php echo $data['email']; ?></p>
                    <p style="font-size: 1.1rem; margin-top: 0; margin-bottom: 0.5rem;line-height: 1.2;"><span style="font-weight: 500;">Address: </span><?php echo $data['address']; ?></p>
                    <p style="font-size: 1.1rem; margin-top: 0; margin-bottom: 0.5rem;line-height: 1.2;"><span style="font-weight: 500;">Postal Code: </span><?php echo $data['postalCode']; ?></p>
                    <p style="font-size: 1.1rem; margin-top: 0; margin-bottom: 0.5rem;line-height: 1.2;"><span style="font-weight: 500;">Medical Conditions: </span><?php echo $data['medConditions']; ?></p>
                    <p style="font-size: 1.1rem; margin-top: 0; margin-bottom: 0.5rem;line-height: 1.2;"><span style="font-weight: 500;">Drug Allergies: </span><?php echo $data['drugAllergies']; ?></p>
                    
                    <div class="d-flex mt-4">
                        <p style="font-size: 1.1rem; margin-top: 0; margin-bottom: 0.5rem;line-height: 1.2;"><button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal<?php echo $data["users_ID"]; ?>">Edit</button></p>
                        <p class="mx-2" style="font-size: 1.1rem; margin-top: 0; margin-bottom: 0.5rem;line-height: 1.2;"><button class="btn btn-secondary" onclick="window.location.href='./changeUsernameOrPassword.php';">Change Password</button></p>
                    </div>
                </div>

                        <!-- modal -->
                <div class="modal fade" id="popupModal<?php echo $data["users_ID"] ?>" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="popupModalLabel">View/Edit Full Information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="./editPatient.php" method="post">
                                    <p style="display: none;" id="invisibleID"></p>
                                    <div class="mb-3">
                                        <label for="patientID" class="form-label">patientID</label>
                                        <input type="text" class="form-control" id="patientID" name="patientID" <?php echo 'value="'.$data["users_ID"].'"'; ?> readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fullName" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="fullName" name="fullName" <?php echo 'value="'.$data["fullName"].'"'; ?>>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nricNumber" class="form-label">nricNumber</label>
                                        <input type="text" class="form-control" id="nricNumber" name="nricNumber" <?php echo 'value="'.$data["nricNumber"].'"'; ?> readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="contactNumber" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="contactNumber" name="contactNumber" <?php echo 'value="'.$data["contactNumber"].'"'; ?>>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" <?php echo 'value="'.$data["email"].'"'; ?>>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"<?php echo 'value="'.$data["address"].'"'; ?>>
                                    </div>
                                    <div class="mb-3">
                                        <label for="postalCode" class="form-label">Postal Code</label>
                                        <input type="text" class="form-control" id="postalCode" name="postalCode"<?php echo 'value="'.$data["postalCode"].'"'; ?>>
                                    </div>
                                    <div class="mb-3">
                                        <label for="medConditions" class="form-label">Medical Conditions:</label>
                                        <input type="textarea" class="form-control" id="medConditions" name="medConditions"<?php echo 'value="'.$data["medConditions"].'"'; ?> readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="drugAllergies" class="form-label">Drug Allergies:</label>
                                        <input type="textarea" class="form-control" id="drugAllergies" name="drugAllergies"<?php echo 'value="'.$data["drugAllergies"].'"'; ?> readonly>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="text-center"><button type="submit" class="btn btn-dark mt-4 px-5">Submit</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <a class="btn btn-lg btn-primary" href="/docs/5.0/components/navbar/" role="button">View navbar docs &raquo;</a> -->
        </div>
    </main>


    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
