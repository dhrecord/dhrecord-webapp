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
  <link rel="stylesheet" href="../css/calendar.css">

  <title>DHRecord</title>
</head>

<body>
    <?php
    include 'navBar.php';
?>


  <!-- content -->
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

  <div class="container my-5">
    <?php
      echo '<div class="mb-5 d-flex title-div-appt">
      <h4>Doctor Appoinment Calendar - ';

      // GET THE DOCTOR FULLNAME
      $stmtDocFN = $conn->prepare("SELECT fullName 
                                      FROM doctor 
                                      WHERE doctorID = ?");
      $stmtDocFN->bind_param("s", $_POST['doc_id']);
      $stmtDocFN->execute();
      $resultDocFN = $stmtDocFN->get_result();

      if ($resultDocFN->num_rows === 0) {
          echo '*';
      } else {
          while ($rowDocFN = $resultDocFN->fetch_assoc()){
              echo $rowDocFN['fullName'];
          }
      }

      echo '</h4><div class="d-flex">';

      echo '<form method="POST" action="../../businessowner/html/bookAppt.php">
      <button type="submit" name="doc_id" value="';
      echo $_POST['doc_id'];                    
      echo '" class="btn btn-dark mx-2">Book Appointment</button></form>';

      echo '<form method="POST" action="../../businessowner/html/rescheduleAppt.php">
      <button type="submit" name="doc_id" value="';
      echo $_POST['doc_id'];                    
      echo '" class="btn btn-dark">Update Appointment</button></form>';

      echo '</div></div>';

      echo '<div class="calendar-box">
              <div id="calendar-container">
                  <div id="calendar"></div>
              </div>
          </div>';
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
        // GET THE APPOINTMENT DETAILS
        $stmtAppt = $conn->prepare("SELECT DISTINCT appointment.date, appointment.time, appointment.agenda, doctor.fullName AS 'd_fullName', registeredPatient.fullName AS 'p_fullName'
                                        FROM appointment
                                        JOIN doctor ON appointment.doctorID = doctor.doctorID
                                        JOIN registeredPatient ON registeredPatient.ID = appointment.patientID
                                        WHERE appointment.doctorID=?");
        $stmtAppt->bind_param("s", $_POST['doc_id']);
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

   <!-- bootstrap js -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

  <script src="../../apptScheduling/js/main.js"></script>
</body>

</html>
