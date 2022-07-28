<?php 
    // error_reporting(E_ALL);
    // session_start();
    // $_SESSION["id"].$_SESSION["username"];
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
                        <a class="nav-link" aria-current="page" href="./index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./userManagement.html">User Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./referralTracking.html">Referral Tracking</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle  active" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Appointment & Treatment
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./apptSchedulingAndReminders.php">Appointment Scheduling
                                    & Reminders</a></li>
                            <li><a class="dropdown-item" href="./treatmentPlanning.html">Treatment Planning</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./reportingAndStatistics.html">Reporting & Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./billingInvoicing.html">Payment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./inventoryManagement-frontend.php">Inventory Management</a>
                    </li>
                </ul>
                <div class="d-flex flex-column align-items-end">
                    <p class="navbar-text text-white m-0">
                        Welcome, Username
                    </p>
                    <button type="button" class="btn btn-light ml-3 btn-sm mb-2"
                        onclick="document.location.href='./loginBusinessOwner.html'">Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-5">Appointment Scheduling and Reminders</h4>

        <!-- <div class="mb-5 d-flex justify-content-end">
            <button class="btn btn-dark">Book Appointment</button>
            <div class="p-2"></div>
            <button class="btn btn-dark">Reschedule</button>
        </div> -->

        <!-- <div class="calendar-box">
            <div id='calendar-container'>
                <div id='calendar'></div>
            </div>
        </div> -->

        <!-- for clinic-admin -->
        <div>
            <p># show this if login as a clinic-admin => Should clinic admin be able to access appt scheduling info?</p>
            <p>-</p>
        </div>

        <!-- for front-desk -->
        <div>
            <p># show this if login as a front-desk => list of doctors in a clinic</p>
            <table class="table table-striped">
                <tr class="bg-dark text-white">
                    <th>No</th>
                    <th>Doctor</th>
                    <th>Services</th>
                    <th>Contact</th>
                    <th></th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Dr. Smith Rowe</td>
                    <td>Oral Surgery, Dental Surgery</td>
                    <td>+65 4574 7654</td>
                    <td class="text-center"><button class="btn btn-sm btn-dark"
                            onclick="document.location.href='../../businessowner/html/doctorSchedule.php'">View
                            Schedule</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Dr. Elizabeth</td>
                    <td>Orthodontic</td>
                    <td>+65 8867 7777</td>
                    <td class="text-center"><button class="btn btn-sm btn-dark"
                            onclick="document.location.href='../../businessowner/html/doctorSchedule.php'">View
                            Schedule</button>
                    </td>
                </tr>
            </table>
        </div>

        <!-- separator -->
        <br><br>

        <!-- for doctor -->
        <div>
            <p># show this if login as a doctor => display doctor's calendar</p>

            <?php        
                // //Database Connection
                // $servername = "localhost";
                // $database = "u922342007_Test";
                // $username = "u922342007_admin";
                // $password = "Aylm@012";
                // // Create connection
                // $conn = mysqli_connect($servername, $username, $password, $database);

                // if (!$conn) 
                // {
                //     die("Connection failed: " . mysqli_connect_error());
                // }

                // $sessionID = $_SESSION['id'];

                // $stmt = $conn->prepare("SELECT * FROM registeredPatient where users_ID = ?");
                // $stmt->bind_param("s", $sessionID);
                // $stmt->execute();
                // $stmt_result = $stmt->get_result();
                // $data = $stmt_result->fetch_assoc();
            ?>

            <div class="my-4 d-flex justify-content-between">
                <h4>Doctor Appoinment Calendar - {doctor name}</h4>
                <?php 
                    // echo $data['fullName']; will replace {doctor name with this code}
                ?>

                <div>
                    <button class="btn btn-dark"
                        onclick="document.location.href='../../businessowner/html/bookAppt.php'">Book
                        Appointment</button>
                    <button class="btn btn-dark"
                        onclick="document.location.href='../../businessowner/html/rescheduleAppt.php'">Reschedule</button>
                </div>
            </div>

            <div class="calendar-box">
                <div id='calendar-container'>
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
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
                events: [
                    {
                        title: 'Monthly Checkup',
                        start: '2022-07-27T14:00:00',
                        doctor: 'Dr. Smith Rowe',
                        patient: 'Mr.Dee'
                    },
                    {
                        title: 'Dental Brace',
                        start: '2022-07-31T15:00:00',
                        doctor: 'Dr. Rose',
                        patient: 'Mr.Fin'
                    },
                ]
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