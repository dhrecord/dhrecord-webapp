<?php

  session_start();
  if(!isset($_SESSION['loggedin']))
    {
      header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
      exit;
    }

  //Database Connection
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

  // calculate total number of clinic/business owner registration that need approval
  $query = "SELECT COUNT(*) FROM businessOwnerForApproval";
  $result = $conn->query($query);
  $total_ca_need_appr = 0;

  if ($result -> num_rows > 0) {
    $row = $result->fetch_row();
    $total_ca_need_appr = $row[0];
  }

  // calculate total number of registered patients
  $query2 = "SELECT COUNT(*) FROM registeredPatient";
  $result2 = $conn->query($query2);
  $total_reg_pt = 0;

  if ($result2 -> num_rows > 0) {
    $row2 = $result2->fetch_row();
    $total_reg_pt = $row2[0];
  }

  // calculate total number of approved clinics
  $query3 = "SELECT COUNT(*) FROM businessOwner";
  $result3 = $conn->query($query3);
  $total_approved_clinics = 0;

  if ($result3 -> num_rows > 0) {
    $row3 = $result3->fetch_row();
    $total_approved_clinics = $row3[0];
  }

  // total number of registered clinic specializations
  $query4 = "SELECT COUNT(*) FROM clinicSpecialization";
  $result4 = $conn->query($query4);
  $total_clinic_spec = 0;

  if ($result4 -> num_rows > 0) {
    $row4 = $result4->fetch_row();
    $total_clinic_spec = $row4[0];
  }

  // total number of registered doctors
  $query5 = "SELECT COUNT(*) FROM doctor";
  $result5 = $conn->query($query5);
  $total_doctors = 0;

  if ($result5 -> num_rows > 0) {
    $row5 = $result5->fetch_row();
    $total_doctors = $row5[0];
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DHRecord</title>
  <link rel="stylesheet" href="../css/style.css" />

  <!-- bootstrap css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- jquery -->
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid container">
      <a class="navbar-brand" href="./home.php"><b>DHRecord</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./clinicspecialization.php">Clinic Specialization</a>
          </li>
            <!--
          <li class="nav-item">
            <a class="nav-link" href="./auditlog.php">Audit Log</a>
          </li>
            -->
          <li class="nav-item">
            <a class="nav-link" href="./usermanagement.php">User Management</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Registration Management
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="./registrationmanagement_businessowner.php">Business Owner</a></li>
              <li><a class="dropdown-item" href="./registrationmanagement_patientaccount.php">Patient Account</a></li>
            </ul>
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


  <main class="container my-5">
    <div class="container py-4">
      <div class="py-0 px-5 mb-4 bg-light rounded-3 container-top">
        <div class="container-fluid py-5 d-flex">
          <div class="" style="font-size: 80px;"><i class="fa-solid fa-user-gear"></i></div>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <div class="d-flex flex-column justify-content-center">
            <h1 class="display-5 fw-bold">Hello, <?php echo $_SESSION['username']; ?></h1>
            <h4 class="col-md-8 fs-4">Role: Superadmin</h4>
          </div>
        </div>
      </div>

      <div class="row align-items-md-stretch">
    

        <div class="col-md-4">
          <div class="h-100 p-5 text-white bg-dark rounded-3 d-flex flex-column justify-content-between">
            <div>
              <h2>Clinic Account Registration</h2>
              <div>
                <h3 style="color: #FFB847;">! <?=$total_ca_need_appr?> Registrants</h3>
                <p>need to be reviewed and need approval</p>
              </div>
            </div>
            <div><a href="./registrationmanagement_businessowner.php" class=" btn btn-outline-light" type="button">Check
                Now</a></div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="h-100 p-5 bg-light border rounded-3 d-flex flex-column justify-content-between">
            <div>
              <h2>Registered Clinic Specialization</h2>
              <div>
                <h3 style="color: #00A3A8;"><?=$total_clinic_spec?> items</h3>
                <p>with the description of each item</p>
              </div>
            </div>
            <div><a href="./clinicspecialization.php" class="btn btn-outline-dark" type="button">Check
                Now</a></div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="h-100 p-5 bg-dark text-light border rounded-3">
            <h2>Summary</h2>
            <hr>
            <div style="font-size: 16px;">
              <p>Total Registered Patients: <?=$total_reg_pt?></p>
              <hr>
              <p>Total Approved Clinics: <?=$total_approved_clinics?></p>
              <hr>
              <p>Total Registered Doctors: <?=$total_doctors?></p>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="pt-3 mt-4 text-muted border-top text-center">
      &copy; DHRecord 2021
    </footer>
  </main>


  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <script src="../js/index.js"></script>
</body>

</html>
