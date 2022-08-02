<?php
  session_start();
  if(!isset($_SESSION['loggedin']))
  {
    header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    exit;
  }

  //db connection
  $servername = "localhost";
  $database = "u922342007_Test";
  $username = "u922342007_admin";
  $password = "Aylm@012";
  $conn = mysqli_connect($servername, $username, $password, $database);

  if (!$conn) 
  {
    die("Connection failed: " . mysqli_connect_error());
  }
  

  echo $_POST['submit'];
  //get form data and insert into tables
  if (isset($_POST['submit'])) 
  {
    if (!isset($_POST["referTo"]) || $_POST["referTo"] == "")
    {
      //submit into treatmentHistory
    } else
    { 
      $apptID = $_POST["apptID"];
      $apptDate = $_POST["apptDate"];
      $apptAgenda = $_POST["apptAgenda"];
      $apptDoctorID = $_POST["apptDoctorID"];
      $apptPatientID = $_POST["apptPatientID"];
      $toothCondition = $_POST["toothCondition"];
      $referredTo = $_POST["referTo"];
     
      $res = "INSERT INTO referralTracking (referredTo, referralDate, referringDoctor, toothCondition, patient_ID)
      VALUES ('{$referredTo}', '{$apptDate}', '{$apptDoctorId}', '{$toothCondition}', '{$apptPatientID}')";
    }
    //header('Location: ./apptSchedulingAndReminders.php');
  }

  $res = "SELECT * FROM appointment WHERE apptID = " .$_GET['appt_ID']. " ";

  $result = mysqli_query($conn, $res);
  
    while($sql = mysqli_fetch_assoc($result))
    {
              $apptID = $sql["apptID"];
              $apptDate = $sql["date"];
              $apptAgenda = $sql["agenda"];
              $apptDoctorID = $sql["doctorID"];
              $apptPatientID = $sql["patientID"];
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
              <a class="nav-link" aria-current="page" href="./index.php">Home</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="./userManagement.php">User Management</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="./referralTracking.php">Referral Tracking</a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle  active" href="#" id="navbarDropdown" role="button"
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
            Welcome, <?php echo $_SESSION['username']; ?>
          </p>
          <button type="button" class="btn btn-light ml-3 btn-sm mb-2" style="width: 90px;"
            onclick="document.location.href='../../LoginUnregisteredPatient/LoginPage/index.html'">Logout</button>
        </div>
      </div>
    </div>
  </nav>

  <!-- content -->
  <div class="container my-5">
    <div class="mb-5 d-flex justify-content-between">
      <h4>Finish Appointment Form</h4>
    </div>
    
    <div>
        <!-- <form> -->
         <div class="container border border-dark p-4" style="border-top-width: 10px!important;">
         <form name="form" action="#" method="post">
           <input type="hidden" id="apptID" name="apptID" value="<?php echo $apptID ?>">
           <input type="hidden" id="apptDate" name="apptDate" value="<?php echo $apptDate ?>">
           <input type="hidden" id="apptAgenda" name="apptAgenda" value="<?php echo $apptAgenda ?>">
           <input type="hidden" id="apptDoctorID" name="apptDoctorID" value="<?php echo $apptDoctorID ?>">
           <input type="hidden" id="apptPatientID" name="apptPatientID" value="<?php echo $apptPatientID ?>">
             <div class="mb-3 row">
                 <label for="toothCondition" class="col-sm-2 col-form-label">Tooth Condition: </label>
                 <div class="col-sm-10">
                     <input type="text" class="form-control" id="toothCondition" name="toothCondition">
                 </div>
             </div>
             <div class="mb-3 row">
                 <label for="diagnosis" class="col-sm-2 col-form-label">Diagnosis: </label>
                 <div class="col-sm-10">
                     <input type="text" class="form-control" id="diagnosis" name="diagnosis">
                 </div>
             </div>
             <div class="mb-3 row">
                 <label for="medicationPrescribed" class="col-sm-2 col-form-label">Medication Prescribed</label>
                 <div class="col-sm-10">
                     <input type="text" class="form-control" id="medicationPrescribed" name="medicationPrescribed">
                 </div>
             </div>
             <div class="mb-3 row">
                 <label for="Quantity" class="col-sm-2 col-form-label">Quantity</label>
                 <div class="col-sm-10">
                     <input type="text" class="form-control" id="Quantity" name="Quantity">
                 </div>
             </div>
             <div class="mb-3 row">
                 <label for="referTo" class="col-sm-2 col-form-label">Refer To (Other Clinic)</label>
                 <div class="col-sm-10">
                     <select name="referTo" id="referTo">
                         <option selected value=""></option>
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

                            // GET THE LIST OF CLINICS
                            $resultBO = $conn->query("SELECT * FROM businessOwner");
                            //echo '<option value="">""</option>';

                            while ($row = $resultBO->fetch_assoc()) {
                                echo '<option value="';

                                $fieldNOC = $row['nameOfClinic'];
                                echo $fieldNOC;

                                echo '">';

                                echo $fieldNOC;
                                echo '</option>';
                            }

                            mysqli_close($conn);
                            ?>
                     </select>
                 </div>
             </div>
             <div class="mb-3 row">
                 <label for="prescriptionDesc" class="col-sm-2 col-form-label">Comments</label>
                 <div class="col-sm-10">
                     <input type="text" class="form-control" id="prescriptionDesc" name="prescriptionDesc">
                 </div>
             </div>
             <div class="mb-3 row">
                 <div class="text-center"><button type="submit" class="btn btn-dark mt-4 px-5" value="submit" name="submit">Finish</button></div>
             </div>
         </form>
     </div>
        <!-- </form> -->
    </div>
  </div>

  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>
</html>
