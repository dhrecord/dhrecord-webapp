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

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

  <title>DHRecord</title>
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
      <h4>Reschedule Appointment</h4>
      <!-- buttons -->
      <div>
        <button class="btn btn-dark" onclick="document.location.href='../../registeredpatient/html/apptScheduling.php'">Book Appointment</button>
        <button class="btn btn-dark" onclick="document.location.href='../../registeredpatient/html/mySchedule.php'">My Appointment</button>
      </div>  
    </div>
    
    <div>
      <table class="table table-striped">
        <tr class="bg-dark text-white">
          <th>No</th>
          <th>Clinic</th>
          <th>Address</th>
          <th>Doctor</th>
          <th>Agenda</th>
          <th>Date</th>
          <th>Time</th>
          <th></th>
          <th></th>
        </tr>

        <?php
          // Database Connection
          $servername = "localhost";
          $database = "u922342007_Test";
          $username = "u922342007_admin";
          $password = "Aylm@012";
          // Create connection
          $conn = mysqli_connect($servername, $username, $password, $database);

          if (!$conn) {
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
            $stmtAppt = $conn->prepare("SELECT DISTINCT appointment.apptID, appointment.date, appointment.time, appointment.agenda, businessOwner.nameOfClinic, businessOwner.locationOfClinic, doctor.fullName
                                          FROM appointment
                                          JOIN doctor ON appointment.doctorID = doctor.doctorID
                                          JOIN doctorClinic ON doctorClinic.doctorID = doctor.doctorID
                                          JOIN businessOwner ON businessOwner.ID = doctorClinic.clinicID
                                          WHERE appointment.patientID=?");
            $stmtAppt->bind_param("s", $rowPatName['ID']);
            $stmtAppt->execute();
            $resultAAppt = $stmtAppt->get_result();

            $stmtAppt = 1;

            while ($rowAppt = $resultAAppt->fetch_assoc()){
              echo '<tr><td>';
              echo $stmtAppt;

              echo '</td><td>';
              echo $rowAppt['nameOfClinic'];

              echo '</td><td>';
              echo $rowAppt['locationOfClinic'];

              echo '</td><td>';
              echo $rowAppt['fullName'];

              echo '</td><td>';
              echo $rowAppt['agenda'];

              echo '</td><td>';
              echo $rowAppt['date'];

              echo '</td><td>';
              echo substr($rowAppt['time'], 0, 5);
              echo '</td>';

              echo '<td class="text-center">
              <form method="POST" action="../../registeredpatient/html/rescheduleApptForm.php">
              <button type="submit" name="appt_id" value="';
              
              echo $rowAppt['apptID'];
                                
              echo       
                  '" class="btn btn-dark btn-sm">Reschedule</button></form>
                  </td><td class="text-center"><button class="btn btn-sm btn-danger" id="cancel-btn-';

              echo $rowAppt['apptID'];
                  
              echo '">Cancel</button></td>';

              $stmtAppt += 1;
            }
          }
        ?>
      </table>
    </div>
  </div>

  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
          crossorigin="anonymous"></script>

  <script>
    var buttons = document.getElementsByClassName("btn-danger");
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("click", function(e) {
            alert(this.id);
        });
    }
  </script>
</body>
</html>
