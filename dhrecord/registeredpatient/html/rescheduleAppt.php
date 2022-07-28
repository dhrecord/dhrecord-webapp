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
        <tr>
          <td>1</td>
          <td>Ashford Dental Centre</td>
          <td>215 Upper Thomson Rd, Singapore 574349</td>
          <td>Dr. Smith Rowe</td>
          <td>Monthly Checkup</td>
          <td>27-07-2002</td>
          <td>02.00 pm</td>
          <td class="text-center"><button class="btn btn-sm btn-dark" onclick="document.location.href='../../registeredpatient/html/rescheduleApptForm.php'">Reschedule</button></td>
          <td class="text-center"><button class="btn btn-sm btn-danger">Cancel</button></td>
        </tr>
        <tr>
          <td>2</td>
          <td>ZW Dental</td>
          <td>Address</td>
          <td>Dr. Rose</td>
          <td>Dental Brace</td>
          <td>31-07-2002</td>
          <td>03.00 pm</td>
          <td class="text-center"><button class="btn btn-sm btn-dark" onclick="document.location.href='../../registeredpatient/html/rescheduleApptForm.php'">Reschedule</button></td>
          <td class="text-center"><button class="btn btn-sm btn-danger">Cancel</button></td>
        </tr>
      </table>
    </div>
  </div>

</body>
</html>
