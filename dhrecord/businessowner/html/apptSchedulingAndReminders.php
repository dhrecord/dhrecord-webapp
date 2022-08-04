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


    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../apptScheduling/fonts/icomoon/style.css">
    <link rel="stylesheet" href="../../apptScheduling/fullcalendar/packages/core/main.css">
    <link rel="stylesheet" href="../../apptScheduling/fullcalendar/packages/daygrid/main.css">


    <!-- <link rel="stylesheet" href="../css/style.css" /> -->
    <!-- <link rel="stylesheet" href="../css/apptSchedulingAndReminders.css" /> -->

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- Style -->
    <link rel="stylesheet" href="../../apptScheduling/css/style.css">
</head>

<body>
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
                        <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="./userManagement.php">User Management</a>
                    </li>-->
                    <!--<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="nav-link" href="./userManagement.php">User Management</a></li>
                        <li><a class="dropdown-item" href="./manageRecord.php">View Patient</a></li>
                    </ul>-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            User & Records
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./userManagement.php">User Management</a></li>
                            <li><a class="dropdown-item" href="./manageRecord.php">View Patient</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./referralTracking.php">Referral Tracking</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Appointment & Treatment
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./apptSchedulingAndReminders.php">Appointment Scheduling
                                    & Reminders</a></li>
                            <li><a class="dropdown-item" href="./treatmentHistory.php">Treatment Planning</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./reportingAndStatistics.php">Reporting & Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./billingInvoicing.php">Payment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./inventoryManagement.php">Inventory Management</a>
                    </li>
                </ul>
                <div class="d-flex flex-column align-items-end">
                    <p class="navbar-text text-white m-0">
                        Welcome, <?php echo $_SESSION['username']; ?>
                    </p>
                    <button type="button" class="btn btn-light ml-3 btn-sm mb-2"
                        onclick="document.location.href='../../LoginUnregisteredPatient/LoginPage/logout.php'">Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- content -->
    <div class="container my-5">
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
        ?>
        <!-- <h4 class="mb-5">Appointment Scheduling and Reminders</h4> -->

        <!-- show this if login as a clinic admin -->
        <?php
            if ($_SESSION['role'] === "ca"){
                echo '<div>
                        <h4 class="mb-5">Appointment Scheduling and Reminders</h4>
                        <p># show this if login as a clinic-admin => Should clinic admin be able to access appt scheduling info?</p>
                        <p>-</p>
                    </div>';
            }
        ?>

        <!-- show this if login as a front-desk -->
        <?php
            if ($_SESSION['role'] === "fd"){
                echo '<div>
                        <h4 class="mb-5">Appointment Scheduling and Reminders - ';

                // CLINIC NAME
                $stmtCN = $conn->prepare("SELECT nameOfClinic 
                                            FROM frontDesk
                                            JOIN businessOwner ON frontDesk.clinicID = businessOwner.ID
                                            WHERE frontDesk.userID = ?");
                $stmtCN->bind_param("s", $_SESSION['id']);
                $stmtCN->execute();
                $resultN = $stmtCN->get_result();

                if ($resultN->num_rows === 0) {
                    echo '*';
                } else {
                    while ($rowN = $resultN->fetch_assoc()){
                        echo $rowN['nameOfClinic'];
                    }
                }

                echo '</h4><table class="table table-striped">
                            <tr class="bg-dark text-white">
                                <th>No</th>
                                <th>Doctor</th>
                                <th>Services</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <th></th>
                            </tr>';
                
                // GET THE CLINIC ID WHERE THE FRONTDESK WORKS
                $stmtCID = $conn->prepare("SELECT clinicID 
                                            FROM frontDesk
                                            WHERE userID = ?");
                $stmtCID->bind_param("s", $_SESSION['id']);
                $stmtCID->execute();
                $resultCID = $stmtCID->get_result();

                if ($resultCID->num_rows === 0) {
                    $clinicID = '';
                } else {
                    while ($rowCID = $resultCID->fetch_assoc()){
                        $clinicID = $rowCID['clinicID'];
                    }
                }
                                
                // GET THE LIST OF DOCTOR DETAILS THAT WORKS IN THE CLINIC
                $stmtDocs = $conn->prepare("SELECT * 
                                            FROM doctor
                                            WHERE clinicID = ?");
                $stmtDocs->bind_param("s", $clinicID);
                $stmtDocs->execute();
                $resultDocs = $stmtDocs->get_result();

                if ($resultDocs->num_rows === 0) {
                    echo '-';
                } else {
                    $index = 1;
                    while ($rowDocs = $resultDocs->fetch_assoc()){
                        echo '<tr><td>';
                        echo $index;
                        echo'</td><td>';
                        echo $rowDocs['fullName'];
                        echo'</td><td>';
                        
                        // GET THE DOCTOR'S SPECIALIZATION
                        $stmtSpec = $conn->prepare("SELECT clinicSpecialization.specName 
                                            FROM doctorSpecialization
                                            JOIN clinicSpecialization 
                                            ON clinicSpecialization.ID = doctorSpecialization.specializationID 
                                            WHERE doctorSpecialization.doctorID=?");
                        $stmtSpec->bind_param("s", $rowDocs['doctorID']);
                        $stmtSpec->execute();
                        $resultSpec = $stmtSpec->get_result();

                        $specializations = array();
                        while ($rowSpec = $resultSpec->fetch_assoc()){
                            array_push($specializations, $rowSpec["specName"]);
                        }

                        if (count($specializations)){
                            $join_specializations = implode(', ', $specializations);
                            echo $join_specializations; 
                        } else{
                            echo '-';
                        }

                        echo '</td><td>';
                        if ($rowDocs['contactNumber']){
                            echo $rowDocs['contactNumber']; 
                        } else{
                            echo '-';
                        }

                        echo'</td><td>';
                        if ($rowDocs['email']){
                            echo $rowDocs['email']; 
                        } else{
                            echo '-';
                        }
                        echo'</td>';

                        echo '<td class="text-center">
                                <form method="POST" action="../../businessowner/html/doctorSchedule.php">
                                <button type="submit" name="doc_id" value="';
                        echo $rowDocs['doctorID'];                    
                        echo '" class="btn btn-dark btn-sm">View Schedule</button></form></td></tr>';

                        $index += 1;
                    }
                }

                echo '</table></div>';
            }
        ?>

        <!-- show this if login as a clinic admin -->
        <?php
            if ($_SESSION['role'] === "ca"){
                echo '<div>
                        <h4 class="mb-5">Appointment Scheduling and Reminders - ';

                // CLINIC NAME
                $stmtCN = $conn->prepare("SELECT nameOfClinic 
                                            FROM clinicAdmin
                                            JOIN businessOwner ON clinicAdmin.clinicID = businessOwner.ID
                                            WHERE clinicAdmin.userID = ?");
                $stmtCN->bind_param("s", $_SESSION['id']);
                $stmtCN->execute();
                $resultN = $stmtCN->get_result();

                if ($resultN->num_rows === 0) {
                    echo '*';
                } else {
                    while ($rowN = $resultN->fetch_assoc()){
                        echo $rowN['nameOfClinic'];
                    }
                }

                echo '</h4><table class="table table-striped">
                            <tr class="bg-dark text-white">
                                <th>No</th>
                                <th>Doctor</th>
                                <th>Services</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <th></th>
                            </tr>';
                
                // GET THE CLINIC ID WHERE THE FRONTDESK WORKS
                $stmtCID = $conn->prepare("SELECT clinicID 
                                            FROM clinicAdmin
                                            WHERE userID = ?");
                $stmtCID->bind_param("s", $_SESSION['id']);
                $stmtCID->execute();
                $resultCID = $stmtCID->get_result();

                if ($resultCID->num_rows === 0) {
                    $clinicID = '';
                } else {
                    while ($rowCID = $resultCID->fetch_assoc()){
                        $clinicID = $rowCID['clinicID'];
                    }
                }
                                
                // GET THE LIST OF DOCTOR DETAILS THAT WORKS IN THE CLINIC
                $stmtDocs = $conn->prepare("SELECT * 
                                            FROM doctor
                                            WHERE clinicID = ?");
                $stmtDocs->bind_param("s", $clinicID);
                $stmtDocs->execute();
                $resultDocs = $stmtDocs->get_result();

                if ($resultDocs->num_rows === 0) {
                    echo '-';
                } else {
                    $index = 1;
                    while ($rowDocs = $resultDocs->fetch_assoc()){
                        echo '<tr><td>';
                        echo $index;
                        echo'</td><td>';
                        echo $rowDocs['fullName'];
                        echo'</td><td>';
                        
                        // GET THE DOCTOR'S SPECIALIZATION
                        $stmtSpec = $conn->prepare("SELECT clinicSpecialization.specName 
                                            FROM doctorSpecialization
                                            JOIN clinicSpecialization 
                                            ON clinicSpecialization.ID = doctorSpecialization.specializationID 
                                            WHERE doctorSpecialization.doctorID=?");
                        $stmtSpec->bind_param("s", $rowDocs['doctorID']);
                        $stmtSpec->execute();
                        $resultSpec = $stmtSpec->get_result();

                        $specializations = array();
                        while ($rowSpec = $resultSpec->fetch_assoc()){
                            array_push($specializations, $rowSpec["specName"]);
                        }

                        if (count($specializations)){
                            $join_specializations = implode(', ', $specializations);
                            echo $join_specializations; 
                        } else{
                            echo '-';
                        }

                        echo '</td><td>';
                        if ($rowDocs['contactNumber']){
                            echo $rowDocs['contactNumber']; 
                        } else{
                            echo '-';
                        }

                        echo'</td><td>';
                        if ($rowDocs['email']){
                            echo $rowDocs['email']; 
                        } else{
                            echo '-';
                        }
                        echo'</td>';

                        echo '<td class="text-center">
                                <form method="POST" action="../../businessowner/html/doctorSchedule.php">
                                <button type="submit" name="doc_id" value="';
                        echo $rowDocs['doctorID'];                    
                        echo '" class="btn btn-dark btn-sm">View Schedule</button></form></td></tr>';

                        $index += 1;
                    }
                }

                echo '</table></div>';
            }
        ?>

        <!-- show this if login as a doctor -->
        <?php
            if ($_SESSION['role'] === "dr"){
                echo '<div><div class="my-4 d-flex justify-content-between">
                <h4>Doctor Appoinment Calendar - ';

                // GET THE DOCTOR FULLNAME
                $stmtDocFN = $conn->prepare("SELECT fullName 
                                                FROM doctor 
                                                WHERE userID = ?");
                $stmtDocFN->bind_param("s", $_SESSION['id']);
                $stmtDocFN->execute();
                $resultDocFN = $stmtDocFN->get_result();

                if ($resultDocFN->num_rows === 0) {
                    echo $_SESSION['username'];
                } else {
                    while ($rowDocFN = $resultDocFN->fetch_assoc()){
                        echo $rowDocFN['fullName'];
                    }
                }

                echo '</h4>';

                echo '<div>
                        <button class="btn btn-dark"
                            onclick="document.location.href=\'../../businessowner/html/bookAppt.php\'">Book
                            Appointment</button>
                        <button class="btn btn-dark"
                            onclick="document.location.href=\'../../businessowner/html/rescheduleAppt.php\'">Reschedule</button>
                    </div>
                </div>';

                echo '<div class="calendar-box">
                        <div id="calendar-container">
                            <div id="calendar"></div>
                        </div>
                    </div></div>';
            }
        ?>
    </div>

    <script src="../../apptScheduling/js/jquery-3.3.1.min.js"></script>
    <script src="../../apptScheduling/js/popper.min.js"></script>
    <script src="../../apptScheduling/js/bootstrap.min.js"></script>

    <script src='../../apptScheduling/fullcalendar/packages/core/main.js'></script>
    <script src='../../apptScheduling/fullcalendar/packages/interaction/main.js'></script>
    <script src='../../apptScheduling/fullcalendar/packages/daygrid/main.js'></script>
    <script src='../../apptScheduling/fullcalendar/packages/timegrid/main.js'></script>
    <script src='../../apptScheduling/fullcalendar/packages/list/main.js'></script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var appts = [];

            <?php
                // GET THE DoctorID from UserID
                $stmtDoc = $conn->prepare("SELECT DISTINCT doctorID
                                                FROM doctor
                                                WHERE userID=?");
                $stmtDoc->bind_param("s", $_SESSION['id']);
                $stmtDoc->execute();
                $resultDoc = $stmtDoc->get_result();

                while ($rowDoc = $resultDoc->fetch_assoc()){
                    // GET THE APPOINTMENT DETAILS
                    $stmtAppt = $conn->prepare("SELECT DISTINCT appointment.date, appointment.time, appointment.agenda, doctor.fullName AS 'd_fullName', registeredPatient.fullName AS 'p_fullName'
                                                    FROM appointment
                                                    JOIN doctor ON appointment.doctorID = doctor.doctorID
                                                    JOIN registeredPatient ON registeredPatient.ID = appointment.patientID
                                                    WHERE appointment.doctorID=?");
                    $stmtAppt->bind_param("s", $rowDoc['doctorID']);
                    $stmtAppt->execute();
                    $resultAAppt = $stmtAppt->get_result();

                    while ($rowAppt = $resultAAppt->fetch_assoc()){
                        echo 'appts.push({start:"';
                        echo $rowAppt['date'];
                        echo 'T';
                        echo $rowAppt['time'];

                        echo '", title:"';
                        echo $rowAppt['agenda'];
                        
                        echo '", patient:"';
                        echo $rowAppt['p_fullName'];

                        echo '", doctor:"';
                        echo $rowAppt['d_fullName'];

                        echo '"});';
                    }
                }
            ?>

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
                height: 'parent',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                defaultView: 'dayGridMonth',
                defaultDate: new Date(),
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: appts
            });

            calendar.render();
        });

    </script>

    <script src="../../apptScheduling/js/main.js"></script>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="../js/index.js"></script>
</body>

</html>