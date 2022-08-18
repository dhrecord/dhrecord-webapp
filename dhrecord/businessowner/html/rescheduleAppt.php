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
    <?php
    include 'navBar.php';
?>


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
                if ($_SESSION['role'] === "dr"){
                  echo "<td class='text-center'><button class='btn btn-sm btn-success' onclick='".$link."'>Finish</button></td>";
                }
                
                // cancel btn
                echo '<td class="text-center">
                      <form method="POST" action="../../businessowner/html/cancelApptForm.php">
                      <button name="appt_id" class="btn btn-sm btn-danger" value="';
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
