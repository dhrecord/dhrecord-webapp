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

<body onload="findData2();">
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
          <li class="nav-item">
            <a class="nav-link" href="./usermanagement.php">User Management</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
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

    <div class="container my-5">
        <h4 class="mb-5">Registration Management - Patient Account</h4>

        <div class="mb-4 d-flex align-items-center">
            <div class="d-flex align-items-center">
                <p class="m-0"><b>Search:</b>&nbsp;&nbsp;&nbsp;</p>
                <div class="input-group">
                    <input type="text" id="searchNameInput" class="form-control" placeholder="Enter Value ..."
                        aria-label="Name" aria-describedby="basic-addon2" style="max-width: 300px;" />
                    <button class="input-group-text" id="basic-addon2" onclick="searchName2();">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
            <select class="form-select" id="regManPA_ddlFilterBy" aria-label="Filter By..."
                style="margin-left: 70px; max-width: 250px;">
                <option selected disabled hidden>Filter By...</option>
                <option value="1">No</option>
                <option value="2">Name</option>
                <option value="3">Address</option>
                <option value="4">NRIC</option>
                <option value="5">Contact No.</option>
                <option value="6">Email</option>
                <option value="7">Check Referral</option>
                <option value="8">Registration Date</option>
            </select>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">NRIC</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Email</th>
                    <th scope="col">View</th>
                </tr>
            </thead>
            <tbody id="data">
               <?php

                    //$query = "SELECT * FROM businessOwner WHERE users_ID=$sessionID";
                    $query = "SELECT * FROM registeredPatient";
  
                    //$clinicID = $row['ID'];

                    if ($result = $conn->query($query)) 
                    {
                        while ($row = $result->fetch_assoc()) 
                        {
               ?>
               <tr>     
                    <td><?php echo $row["fullName"]; ?></td>
                    <td><?php echo $row["address"]; ?></td> 
                    <td><?php echo $row["nricNumber"]; ?></td> 
                    <td><?php echo $row["contactNumber"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal<?php echo $row["ID"]; ?>">View</button></td>
               </tr>


        <!-- modal -->
        <div class="modal fade" id="popupModal<?php echo $row["ID"]; ?>" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="popupModalLabel">View Full Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <p style="display: none;" id="invisibleID"></p>
                            <div class="mb-3">
                                <label for="clinicadminID" class="form-label">Patient ID</label>
                                <input type="text" class="form-control" id="patientID" name="patientID" <?php echo 'value="'.$row["ID"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="fullName" <?php echo 'value="'.$row["fullName"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="nricNumber" class="form-label">NRIC Number</label>
                                <input type="text" class="form-control" id="nricNumber" name="nricNumber" <?php echo 'value="'.$row["nricNumber"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contactNumber" name="contactNumber" <?php echo 'value="'.$row["contactNumber"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" <?php echo 'value="'.$row["email"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="medConditions" class="form-label">Medical Conditions</label>
                                <input type="text" class="form-control" id="medConditions" name="medConditions" <?php echo 'value="'.$row["medConditions"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="drugAllergies" class="form-label">Drug Allergies</label>
                                <input type="text" class="form-control" id="drugAllergies" name="drugAllergies" <?php echo 'value="'.$row["drugAllergies"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3 row">
                                <div class="text-center"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
            }
        }
        ?>

                    </tbody>
        </table>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- javascript -->
    <script src="../js/index.js"></script>
</body>

</html>
