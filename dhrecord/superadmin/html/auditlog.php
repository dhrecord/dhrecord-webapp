<?php

    session_start();
    if(!isset($_SESSION['loggedin']))
      {
        header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
        exit;
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

<body onload="findData6();">
    <!-- navbar -->
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
            <a class="nav-link" aria-current="page" href="./home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./clinicspecialization.php">Clinic Specialization</a>
          </li>
          <!--<li class="nav-item">
            <a class="nav-link active" href="./auditlog.php">Audit Log</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./usermanagement.php">User Management</a>
          </li>-->
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

    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-5">Audit Log</h4>
        <div class="mb-4 d-flex align-items-center">
            <div class="d-flex align-items-center">
                <p class="m-0"><b>Search:</b>&nbsp;&nbsp;&nbsp;</p>
                <div class="input-group">
                    <input type="text" id="searchAuditLog" class="form-control" placeholder="Enter Value ..."
                        aria-label="Name" aria-describedby="basic-addon2" style="max-width: 400px;" />
                    <button class="input-group-text" id="basic-addon2" onclick="searchAuditLog();">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
            <select class="form-select" id="auditLog_ddlFilterBy" aria-label="Filter By..."
                style="margin-left: 70px; max-width: 250px;">
                <option selected disabled hidden>Filter By...</option>
                <option value="1">No</option>
                <option value="2">Date/Time</option>
                <option value="3">Actor ID</option>
                <option value="4">Actor</option>
                <option value="5">Activity</option>
                <option value="6">Target</option>
            </select>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Date/Time</th>
                    <th scope="col">Actor ID</th>
                    <th scope="col">Actor</th>
                    <th scope="col">Activity</th>
                    <th scope="col">Target</th>
                </tr>
            </thead>
            <tbody id="data6">
            </tbody>
        </table>
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="../js/index.js"></script>
</body>

</html>
