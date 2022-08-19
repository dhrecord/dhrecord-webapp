<?php
  session_start();
  if(!isset($_SESSION['loggedin']))
  {
    header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    exit;
  }
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../../apptScheduling/fonts/icomoon/style.css">
  <link rel="stylesheet" href="../../apptScheduling/fullcalendar/packages/core/main.css">
  <link rel="stylesheet" href="../../apptScheduling/fullcalendar/packages/daygrid/main.css">


  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

  <!-- Style -->
  <link rel="stylesheet" href="../../apptScheduling/css/style.css">

  <title>DHRecord</title>
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
            <a class="nav-link" aria-current="page" href="../html/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../html/apptScheduling.php">Appointment Scheduling &
              Reminder</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../html/referralTracking.php">Referral Tracking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../html/surveyAndFeedback.php">Survey & Feedback</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../html/treatmentHistory.php">Treatment History</a>
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

  <!-- content -->
  <div class="container my-5">
    <div class="mb-5 d-flex justify-content-between">
      <h4>My Appoinment Calendar</h4>
      <div>
        <button class="btn btn-dark" onclick="document.location.href='../../registeredpatient/html/apptScheduling.php'">Book Appointment</button>
        <button class="btn btn-dark" onclick="document.location.href='../../registeredpatient/html/rescheduleAppt.php'">Reschedule</button>
      </div>
    </div>

    <div class="calendar-box">
      <div id='calendar-container'>
        <div id='calendar'></div>
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
      var appts = [];

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

        // GET THE PatientID from UserID
        $stmtPatName = $conn->prepare("SELECT DISTINCT registeredPatient.ID
                                        FROM registeredPatient
                                        WHERE registeredPatient.users_ID=?");
        $stmtPatName->bind_param("s", $sessionID);
        $stmtPatName->execute();
        $resultPatName = $stmtPatName->get_result();

        while ($rowPatName = $resultPatName->fetch_assoc()){
          // GET THE APPOINTMENT DETAILS
          $stmtAppt = $conn->prepare("SELECT DISTINCT appointment.date, appointment.time, appointment.agenda, businessOwner.nameOfClinic, doctor.fullName
                                        FROM appointment
                                        JOIN doctor ON appointment.doctorID = doctor.doctorID
                                        JOIN businessOwner ON businessOwner.ID = doctor.clinicID
                                        WHERE appointment.patientID=?");
          $stmtAppt->bind_param("s", $rowPatName['ID']);
          $stmtAppt->execute();
          $resultAAppt = $stmtAppt->get_result();
          
          date_default_timezone_set("Singapore");
          $current_date = date("Y-m-d");
          $current_time = date("H:i");

          while ($rowAppt = $resultAAppt->fetch_assoc()){
            // checking if the appt is out of date
            if ($rowAppt['date'] > $current_date || ($rowAppt['date'] == $current_date && $rowAppt['time'] >= $current_time)) {
              echo 'appts.push({start:"';
              echo $rowAppt['date'];
              echo 'T';
              echo $rowAppt['time'];
  
              echo '", title:"';
              echo $rowAppt['agenda'];
              
              echo '", clinic:"';
              echo $rowAppt['nameOfClinic'];
  
              echo '", doctor:"';
              echo $rowAppt['fullName'];
  
              echo '"});';
            }
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

  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>

  <script src="../../apptScheduling/js/main.js"></script>
</body>

</html>
