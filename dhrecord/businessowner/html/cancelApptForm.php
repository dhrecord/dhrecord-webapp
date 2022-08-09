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

  <!-- Style -->
  <!-- <link rel="stylesheet" href="../../apptScheduling/css/style.css"> -->
  <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    
  <!-- jquery -->
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <!-- Style -->
  <link rel="stylesheet" href="../css/apptSchedulingAndReminders.css?v=<?php echo time(); ?>">

  <title>DHRecord</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid container">
            <?php 
              $role = $_SESSION['role'];
              if ($role === 'dr')
              {
                echo '<a class="navbar-brand" href="./drindex.php"><b>DHRecord</b></a>';
              } else if ($role === "fd")
              {
                echo '<a class="navbar-brand" href="./fdindex.php"><b>DHRecord</b></a>';
              } else
              {
                echo '<a class="navbar-brand" href="./caindex.php"><b>DHRecord</b></a>';
              }
            ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <?php 
                          $role = $_SESSION['role'];
                          if ($role === 'dr')
                          {
                            echo '<a class="nav-link active" aria-current="page" href="./drindex.php">Home</a>';
                          } else if ($role === "fd")
                          {
                            echo '<a class="nav-link active" aria-current="page" href="./fdindex.php">Home</a>';
                          } else
                          {
                            echo '<a class="nav-link active" aria-current="page" href="./caindex.php">Home</a>';
                          }
                        ?>
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
    <div class="mb-4 d-flex justify-content-between">
      <h4>Cancel Appointment Form</h4>
    </div>

    <div class="p-5" style="background: #F2F2F2;">
      <form method="post" action="./cancelApptSubmit.php">
          <div class="d-flex">
              <div>
                  <p class="m-0"><b>Doctor: </b> 
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

                          $docID = "";

                          // if login as doctor -> need to finnd doctor id
                          if ($_SESSION['role'] === "dr"){
                              // GET THE DOCTOR FULLNAME
                              $stmtDoc = $conn->prepare("SELECT fullName, doctorID
                                                          FROM doctor 
                                                          WHERE userID = ?");
                              $stmtDoc->bind_param("s", $_SESSION['id']);
                              $stmtDoc->execute();
                              $resultDoc = $stmtDoc->get_result();

                              if ($resultDoc->num_rows === 0) {
                                  echo $_SESSION['username'];
                              } else {
                                  while ($rowDoc = $resultDoc->fetch_assoc()){
                                      $docID = $rowDoc['doctorID'];
                                      echo $rowDoc['fullName'];
                                  }
                              }
                          }

                          // if login as frontdesk -> doctor id is passed by form parameter
                          if ($_SESSION['role'] === "fd" or $_SESSION['role'] === "ca"){
                              // GET THE DOCTOR FULLNAME
                              $stmtDoc = $conn->prepare("SELECT doctor.fullName, appointment.doctorID
                                                          FROM appointment
                                                          JOIN doctor ON appointment.doctorID = doctor.doctorID
                                                          WHERE appointment.apptID = ?");
                              $stmtDoc->bind_param("s", $_POST['appt_id']);
                              $stmtDoc->execute();
                              $resultDoc = $stmtDoc->get_result();

                              if ($resultDoc->num_rows === 0) {
                                  echo "-";
                              } else {
                                  while ($rowDoc = $resultDoc->fetch_assoc()){
                                      $docID = $rowDoc['doctorID'];
                                      echo $rowDoc['fullName'];
                                  }
                              }
                          }  
                      ?>
                  </p>

                  <p class="m-0"><b>Specialization: </b>
                      <?php
                          // GET THE DOCTOR'S SPECIALIZATION
                          $stmtSpec = $conn->prepare("SELECT clinicSpecialization.specName 
                                                      FROM doctorSpecialization
                                                      JOIN clinicSpecialization 
                                                      ON clinicSpecialization.ID = doctorSpecialization.specializationID 
                                                      WHERE doctorSpecialization.doctorID=?");
                          $stmtSpec->bind_param("s", $docID);
                          $stmtSpec->execute();
                          $resultSpec = $stmtSpec->get_result();

                          $specializations = array();
                          while ($rowSpec = $resultSpec->fetch_assoc()){
                              array_push($specializations, $rowSpec["specName"]);
                          }

                          $join_specializations = implode(', ', $specializations);
                          echo $join_specializations;
                      ?>
                  </p>

                  <br/>
                  
                  <?php
                      // GET THE DOCTOR'S SPECIALIZATION
                      $stmtClinic = $conn->prepare("SELECT DISTINCT businessOwner.nameOfClinic, businessOwner.locationOfClinic
                                                  FROM businessOwner
                                                  JOIN doctor
                                                  ON doctor.clinicID = businessOwner.ID
                                                  WHERE doctor.doctorID=?");
                      $stmtClinic->bind_param("s", $docID);
                      $stmtClinic->execute();
                      $resultClinic = $stmtClinic->get_result();

                      while ($rowClinic = $resultClinic->fetch_assoc()){
                          echo '<p class="m-0"><b>Clinic: </b>';
                          echo $rowClinic['nameOfClinic'];
                          echo '</p><p class="m-0"><b>Address: </b>';
                          echo $rowClinic['locationOfClinic'];
                          echo '<br/></p>';
                      }
                  ?>

                  <br/>

                  <p class="m-0"> 
                      <b>Operating Hours: </b><br/>
                      
                      <?php
                          // GET THE OPERATING HOURS OF THE CLINIC
                          $stmtOH = $conn->prepare("SELECT day, start_time, end_time 
                                                      FROM operatingHours 
                                                      WHERE operatingHours.doctorID = ?");
                          $stmtOH->bind_param("s", $docID);
                          $stmtOH->execute();
                          $resultOH = $stmtOH->get_result();

                          echo '<p>';
                          if ($resultOH->num_rows === 0) {
                              echo '-';
                          } else { 
                              while ($rowOH = $resultOH->fetch_assoc()){
                              if ($rowOH['start_time'] === "00:00:00" and $rowOH['end_time'] === "00:00:00"){
                                  echo $rowOH['day'];
                                  echo ': Closed<br/>';
                              } else {
                                  echo $rowOH['day'];
                                  echo ': ';
                                  $start_time = $rowOH['start_time']; 
                                  echo substr($start_time, 0, 5);
                                  echo '-';
                                  $end_time = $rowOH['end_time']; 
                                  echo substr($end_time, 0, 5);
                                  echo '<br/>';
                              }
                              }
                          }
                          echo '</p>';
                      ?>
                  </p>
              </div>
              
              <?php
                  // GET THE APPT DETAILS
                  $stmtAppt = $conn->prepare("SELECT DISTINCT appointment.date, appointment.time, appointment.agenda
                                                  FROM appointment
                                                  WHERE appointment.apptID=?");
                  $stmtAppt->bind_param("s", $_POST['appt_id']);
                  $stmtAppt->execute();
                  $resultAppt = $stmtAppt->get_result();
                  $apptAgenda = "";

                  while ($rowAppt = $resultAppt->fetch_assoc()){
                      $apptDate = $rowAppt['date'];
                      $apptTime = $rowAppt['time'];
                      $apptAgenda = $rowAppt['agenda'];
                  }
              ?>

              <div>
                <div class=" mb-4">
                  <div class="mx-5">
                        <div>
                            <p><b>Agenda:</b></p>
                            <p><?=$apptAgenda?></p>
                        </div>
                  </div>
                </div>

                <div class="d-flex">
                  <div class="mx-5">
                    <div>
                        <p><b>Date  (mm-dd-yyyy):</b></p>
                        <p><?=substr($apptDate, 5, 2)."-".substr($apptDate, 8, 2)."-".substr($apptDate, 0, 4)?></p>
                    </div>
                  </div>

                  <div class="mx-5">
                      <div>
                          <p><b>Time:</b></p>
                          <p><?=substr($apptTime, 0, 5)?></p>
                      </div>
                  </div>
                </div>
              </div>

              <!-- hidden value -->
              <input type="text" style="display:none;" name="apptID" value=<?=$_POST['appt_id']?> />
          </div>

          <div class="text-end">
              <button type="submit" class="btn btn-danger">Cancel</button>
          </div>
      </form>
    </div>
  </div>

  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>