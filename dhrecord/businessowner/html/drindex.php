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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Patient Records
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <!-- <li><a class="dropdown-item" href="./userManagement.php">User Management</a></li> -->
                            <li><a class="dropdown-item" href="./manageRecord.php">View Patient</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Appointment & Treatment
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./apptSchedulingAndReminders.php">Appointment Scheduling
                                    & Reminders</a></li>
                            <li><a class="dropdown-item" href="./treatmentHistory.php">Treatment History</a></li>
                        </ul>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" href="./reportingAndStatistics.php">Reporting & Statistics</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="./billingInvoicing.php">Payment</a>
                    </li>
                    -->
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


  <main class="container my-5">
    <div class="bg-light p-5 rounded mt-3">
      <h1>Homepage</h1>
      <hr>
      <h4 class="lead">Hi, <?php echo $_SESSION['username']; ?>!</h4>
      <h4 class="lead">Role:
          <?php 
              if ($role === "ca")
              {
                  echo "clinic admin";
              } else if ($role === "dr")
              {
                  echo "doctor";
              } else
              {
                  echo "front desk";
              }
         ?>
      </h4>
      <hr>
      <p class="mx-2" style="font-size: 1.1rem; margin-top: 0; margin-bottom: 0.5rem;line-height: 1.2;"><button class="btn btn-secondary" onclick="window.location.href='./changeUsernameOrPasswordBusinessOwner.php';">Change Password</button></p>
      <!-- <a class="btn btn-lg btn-primary" href="/docs/5.0/components/navbar/" role="button">View navbar docs &raquo;</a> -->
    </div>
  </main>


  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>
