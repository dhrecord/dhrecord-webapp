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
      <h4>Reschedule Appointment</h4>
    </div>
    
    <div>
      <table class="table table-striped">
        <tr class="bg-dark text-white">
          <th>No</th>
          <th>Doctor</th>
          <th>Patient</th>
          <th>Agenda</th>
          <th>Date</th>
          <th>Time</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        <tr>
          <?php
            $servername = "localhost";
            $database = "u922342007_Test";
            $username = "u922342007_admin";
            $password = "Aylm@012";

            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $database);
            $docID = "";

            // if login as doctor -> need to finnd doctor id
            if ($_SESSION['role'] === "dr"){
                // GET THE DOCTOR ID 
                $stmtDoc = $conn->prepare("SELECT doctorID
                            FROM doctor 
                            WHERE userID = ?");
                
                $stmtDoc->bind_param("s", $_SESSION['id']);
                $stmtDoc->execute();
                $resultDoc = $stmtDoc->get_result();

                while ($rowDoc = $resultDoc->fetch_assoc()){
                    $docID = $rowDoc['doctorID'];
                }
            }
           
            // if login as frontdesk -> doctor id is passed by form parameter
            if ($_SESSION['role'] === "fd" or $_SESSION['role'] === "ca"){
                $docID = $_POST['doc_id'];
            }
                                    
            // GET APPOINTMENT DETAILS THAT BELONG TO THE DOCTOR
            // $res = ("SELECT apptID, doctor.fullName as docName, registeredPatient.fullName as ptName, agenda, date, time 
            // FROM appointment,doctor,registeredPatient WHERE appointment.doctorID = doctor.doctorID AND appointment.patientID = registeredPatient.ID 
            // AND appointment.status != 'finished' AND appointment.doctorID = ?");
            // $result = mysqli_query($conn, $res);

            $res = $conn->prepare("SELECT apptID, doctor.fullName as docName, registeredPatient.fullName as ptName, agenda, date, time 
                                    FROM appointment,doctor,registeredPatient WHERE appointment.doctorID = doctor.doctorID AND appointment.patientID = registeredPatient.ID 
                                    AND appointment.status != 'finished' AND appointment.doctorID = ?");
            $res->bind_param("s", $docID);
            $res->execute();
            $result = $res->get_result();

            $index = 1;
            while($sql = mysqli_fetch_assoc($result))
            {
                $link = 'document.location.href="finishAppointment.php?apptID='.$sql['apptID'].'"';
                echo "<tr><td>".$index.
                    "</td><td>".$sql['docName'].
                    "</td><td>".$sql['ptName'].
                    "</td><td>".$sql['agenda'].
                    "</td><td>".$sql['date'].
                    "</td><td>".substr($sql['time'], 0, 5).
                    "</td>";

                // reschedule btn
                echo '<td class="text-center">
                <form method="POST" action="../../businessowner/html/rescheduleApptForm.php">
                <button type="submit" name="appt_id" value="';
                echo $sql['apptID'];                    
                echo '" class="btn btn-dark btn-sm">Reschedule</button></form></td>';

                // finish btn
                echo "<td class='text-center'><button class='btn btn-sm btn-success' onclick='".$link."'>Finish</button></td>";
                
                // cancel btn
                echo '<td class="text-center">
                      <form method="POST" action="../../businessowner/html/cancelApptForm.php">
                      <button class="btn btn-sm btn-danger" value="';
                echo $sql['apptID'];      
                echo '">Cancel</button></form></td>';
                    
                // echo "<td class='text-center'><button class='btn btn-sm btn-dark' onclick='document.location.href='../../businessowner/html/rescheduleApptForm.php'>Reschedule</button></td>
                //     <td class='text-center'><button class='btn btn-sm btn-success' onclick='".$link."'>Finish</button></td>
                //     <td class='text-center'><button class='btn btn-sm btn-danger'>Cancel</button></td></tr>";
                $index += 1;
            }
          ?>
      </table>
    </div>
  </div>

  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</body>
</html>
