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
                <div class="mb-3 row">
                    <label for="symptoms" class="col-sm-2 col-form-label">Symptoms: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="symptoms" name="symptoms">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="diagnosis" class="col-sm-2 col-form-label">Diagnosis: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="diagnosis" name="diagnosis">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="prescriptionName" class="col-sm-2 col-form-label">Prescription Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="prescriptionName" name="prescriptionName">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="Quantity" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="Quantity" name="Quantity">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="prescriptionDesc" class="col-sm-2 col-form-label">Comments</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="prescriptionDesc" name="prescriptionDesc">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="text-center"><button class="btn btn-dark mt-4 px-5" name="finish" onclick="document.location.href='../../businessowner/html/apptSchedulingAndReminders.php'">Finish</button></div>
                </div>
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
