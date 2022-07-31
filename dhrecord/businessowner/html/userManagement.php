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
  
  $sessionID = $_SESSION['id'];
  
  $query = "SELECT * FROM businessOwner WHERE users_ID=$sessionID";
  $clinicInfo = mysqli_query($conn,$query);
  $row = $clinicInfo->fetch_assoc();
  
  $clinicID = $row['ID'];
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
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jquery -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body onload="findData();">
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
                        <a class="nav-link active" href="./userManagement.php">User Management</a>
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
                        <a class="nav-link" href="./reportingAndStatistics.html">Reporting & Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./billingInvoicing.html">Payment</a>
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
        <h4 class="mb-5">User Management</h4>
        <div class="mb-4 d-flex align-items-center">
            <div class="d-flex align-items-center">
                <p class="m-0"><b>Search:</b>&nbsp;&nbsp;&nbsp;</p>
                <div class="input-group">
                    <input type="text" id="searchNameInput" class="form-control" placeholder="Enter Value ..."
                        aria-label="Name" aria-describedby="basic-addon2" style="max-width: 300px;" />
                    <button class="input-group-text" id="basic-addon2" onclick="searchName();">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
            <select class="form-select" id="userManagement_ddlFilterBy" aria-label="Filter By..."
                style="margin-left: 70px; max-width: 250px;">
                <option selected disabled hidden>Filter By...</option>
                <option value="2">Name</option>
                <option value="3">Address</option>
                <option value="4">NRIC</option>
                <option value="5">Contact No</option>
                <option value="6">Email</option>
            </select>

            <div class="referral-box px-3"> 
                <button type="button" class="btn btn-dark" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; margin-left: 500px;" onclick="window.location.href='./addUser.php';">Add New User</button>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Email</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php

                $query = "SELECT * FROM clinicAdmin WHERE clinicID = $clinicID";

                if ($result = $conn->query($query)) 
                {
                    while ($row = $result->fetch_assoc()) 
                    {
                        $clinicadminID = $row["clinicadminID"];
                        $query1 = "SELECT * FROM users WHERE ID = $clinicadminID";
                        $result1 = $conn->query($query1);
                        $row1 = $result1->fetch_assoc();
                ?>
                    <tr>
                        <td><?php echo $row["fullName"]; ?></td>
                        <td><?php echo $row1["ID"]; ?></td> 
                        <td><?php echo $row["contactNumber"]; ?></td> 
                        <td><?php echo $row["email"]; ?></td>
                        <td><button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal<?php echo $row["clinicadminID"]; ?>">Edit</button></td>
                        <td><button type="button" class="btn btn-sm btn-success" onclick="document.location.href='deleteUser.php?clinicadminID=<?php echo $row["clinicadminID"]; ?>'">Delete</button></td>
                    </tr>


                <?php
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- modal -->
        <div class="modal fade" id="popupModal<?php echo $row["clinicadminID"]; ?>" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="popupModalLabel">View/Edit Full Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" action="./editUserClinicAdmin.php" method="post">
                        <form>
                            <p style="display: none;" id="invisibleID"></p>
                            <div class="mb-3">
                                <label for="clinicadminID" class="form-label">Clinic Admin ID</label>
                                <input type="text" class="form-control" id="clinicadminID" <?php echo 'value="'.$row["clinicadminID"].'"'; ?>>
                            </div>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" <?php echo 'value="'.$row["fullName"].'"'; ?>>
                            </div>
                            <div class="mb-3">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contactNumber" <?php echo 'value="'.$row["contactNumber"].'"'; ?>>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" <?php echo 'value="'.$row["email"].'"'; ?>>
                            </div>
                            <div class="mb-3">
                                <label for="clinicID" class="form-label">Clinic ID</label>
                                <input type="text" class="form-control" id="inputContactNo" <?php echo 'value="'.$row["clinicID"].'"'; ?> disabled>
                            </div>
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" <?php echo 'placeholder="'.$email.'"'; ?> readonly>
                            </div>
                            <div class="mb-3 row">
                                <div class="text-center"><button type="submit" class="btn btn-dark mt-4 px-5">Submit</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="../js/index.js"></script>
</body>

</html>
