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

    $result = '';
    $search = '';
    $select = '';

    // SEARCH BUSINESS OWNER
    if(isset($_POST['searchbtn'])){
        if(!empty($_POST['search'] and !empty($_POST['select']))){
            $search = $_POST['search'];      
            $select = $_POST['select'];
            $stmt = '';

            switch ($select) {
                // search by no/id
                case "1":
                    $stmt = $conn->prepare("SELECT * FROM businessOwnerForApproval WHERE id = ?");
                    $stmt->bind_param("i", $search);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    break;
                // search by clinic name
                case "2":
                    $search = "%$search%"; // prepare the $search variable
                    $stmt = $conn->prepare("SELECT * FROM businessOwnerForApproval WHERE nameOfClinic LIKE ?");
                    $stmt->bind_param("s", $search);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    break;
                // search by address
                case "3":
                    $search = "%$search%"; // prepare the $search variable
                    $stmt = $conn->prepare("SELECT * FROM businessOwnerForApproval WHERE locationOfClinic LIKE ?");
                    $stmt->bind_param("s", $search);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    break;
                // search by contact number
                case "4":
                    $search = "%$search%"; // prepare the $search variable
                    $stmt = $conn->prepare("SELECT * FROM businessOwnerForApproval WHERE contactNumber LIKE ?");
                    $stmt->bind_param("s", $search);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    break;
                // search by email
                case "5":
                    $search = "%$search%"; // prepare the $search variable
                    $stmt = $conn->prepare("SELECT * FROM businessOwnerForApproval WHERE email LIKE ?");
                    $stmt->bind_param("s", $search);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    break;
                // search by reg no
                case "6":
                    $search = "%$search%"; // prepare the $search variable
                    $stmt = $conn->prepare("SELECT * FROM businessOwnerForApproval WHERE registrationNumber LIKE ?");
                    $stmt->bind_param("s", $search);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    break;
                // search by license no
                case "7":
                    $search = "%$search%"; // prepare the $search variable
                    $stmt = $conn->prepare("SELECT * FROM businessOwnerForApproval WHERE licenseNumber LIKE ?");
                    $stmt->bind_param("s", $search);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    break;
                // search by specialization
                case "8":
                    $search = "%$search%"; // prepare the $search variable

                    $querySpec = "SELECT * FROM clinicSpecialization WHERE specName LIKE '$search'";
                    $resultSpec = $conn->query($querySpec);
                    $rowSpec = $resultSpec->fetch_assoc();
                    $specializationID = $rowSpec["ID"];

                    $stmt = $conn->prepare("SELECT * FROM businessOwnerForApproval WHERE clinicSpecialization = ?");
                    $stmt->bind_param("s", $specializationID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    break;
            }
        } else {
            $result = $conn->query("SELECT * FROM businessOwnerForApproval");
        }
    }  else {
        $result = $conn->query("SELECT * FROM businessOwnerForApproval");
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
            <a class="nav-link" href="./usermanagement.php">User Management</a>
          </li>-->
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

    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-5">Registration Management - Business Owner</h4>

        <form action="" method ="POST">
        <div class="mb-4 d-flex align-items-center">
            <div class="d-flex align-items-center">
                <p class="m-0"><b>Search:</b>&nbsp;&nbsp;&nbsp;</p>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter Value ..."
                        aria-label="Name" aria-describedby="basic-addon2" style="max-width: 300px;" id="search" name="search"/>
                    <button class="input-group-text" id="basic-addon2" type="submit" name="searchbtn">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
            <select class="form-select" id="regManBO_ddlFilterBy" aria-label="Filter By..."
                style="margin-left: 70px; max-width: 250px;" required name="select">
                <option selected disabled hidden>Filter By...</option>
                <option value="1">No</option>
                <option value="2">Clinic Name</option>
                <option value="3">Address</option>
                <option value="4">Contact No.</option>
                <option value="5">Email</option>
                <option value="6">Registration No.</option>
                <option value="7">License No.</option>
                <!-- <option value="8">Registration Date</option> -->
                <option value="8">Specialization</option>
            </select>
        </div>
        </form>

        <!-- alert -->
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert_approval"
            style="display: none;">
            <div class="d-flex align-items-center">
                <i class="fa fa-check" aria-hidden="true"></i>
                &nbsp;&nbsp;
                <div>
                    Application is approved successfully!
                </div>
            </div>

            <button type="button" class="btn-close" aria-label="Close" onclick="close_alert();"></button>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Clinic Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Contact No.</th>
                    <th scope="col">Email</th>
                    <th scope="col">Specialization</th>
                    <!--<th scope="col">Registration No.</th>
                    <th scope="col">License No.</th>
                    <th scope="col">Account Status</th>-->
                    <th scope="col">Full Info</th>
                    <th scope="col">Approve</th>
                </tr>
            </thead>
            <tbody>
                <?php
	            
                //$stmt = $conn->prepare("SELECT * FROM businessOwnerForApproval");
		        //$stmt->execute();
		        //$stmt_result = $stmt->get_result();
                //$row = $stmt_result->fetch_assoc();

                //while($stmt_result)
                //{
                //    
                //}

                // $query = "SELECT * FROM businessOwnerForApproval";

                // if ($result = $conn->query($query)) 
                if ($result !== '') 
                {
                    while ($row = $result->fetch_assoc()) 
                    {
                    
                        $No = $row["id"];
                        $clinicName = $row["nameOfClinic"];
                        $address = $row["locationOfClinic"];
                        $contactNo = $row["contactNumber"];
                        $email = $row["email"];
                        $specializationNo = $row["clinicSpecialization"];
                        
                        $query1 = "SELECT * FROM clinicSpecialization WHERE ID = '$specializationNo'";
                        $result1 = $conn->query($query1);
                        $row1 = $result1->fetch_assoc();
                        
                        $specialization = $row1["specName"];
                        $RegistrationNo = $row["registrationNumber"];
                        $LicenseNo = $row["licenseNumber"];
                        $ownerName = $row["fullName"];
                        $ownerNRIC = $row["nricNumber"];
                ?>

                        <!--display data-->
                        <tr> 
                          <td><?php echo $row["id"]; ?></td> 
                          <td><?php echo $row["nameOfClinic"]; ?></td> 
                          <td><?php echo $row["locationOfClinic"]; ?></td> 
                          <td><?php echo $row["contactNumber"]; ?></td> 
                          <td><?php echo $row["email"]; ?></td>
                          <td><?php echo $row1["specName"]; ?></td> 
                          <td><button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal<?php echo $row["id"]; ?>">View</button></td>
                          <td><button type="button" class="btn btn-sm btn-success" onclick="document.location.href='approve.php?id=<?php echo $row["id"]; ?>'">Approve</button></td>
                        </tr>

        <!-- modal -->
        <div class="modal fade" id="popupModal<?php echo $row["id"]; ?>" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
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
                                <label for="inputName" class="form-label">Clinic Name</label>
                                <input type="text" class="form-control" id="inputClinicName" <?php echo 'placeholder="'.$row["nameOfClinic"].'"'; ?> readonly></input>
                            </div>
                            <div class="mb-3">
                                <label for="inputName" class="form-label">Owner Name</label>
                                <input type="text" class="form-control" id="inputName" <?php echo 'placeholder="'.$ownerName.'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputName" class="form-label">Owner NRIC</label>
                                <input type="text" class="form-control" id="inputNRIC" <?php echo 'placeholder="'.$ownerNRIC.'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputAddress" class="form-label">Address</label>
                                <input type="text" class="form-control" id="inputAddress" <?php echo 'placeholder="'.$address.'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputContactNo" class="form-label">Contact No.</label>
                                <input type="text" class="form-control" id="inputContactNo" <?php echo 'placeholder="'.$contactNo.'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" <?php echo 'placeholder="'.$email.'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputSpecialization" class="form-label">Specialization</label>
                                <textarea type="text" class="form-control" id="inputSpecialization" <?php echo 'placeholder="'.$specialization.'"'; ?> readonly></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="inputRegistrationNo" class="form-label">Registration No.</label>
                                <input type="text" class="form-control" id="inputRegistrationNo" <?php echo 'placeholder="'.$RegistrationNo.'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputLicenseNo" class="form-label">License No.</label>
                                <input type="text" class="form-control" id="inputLicenseNo" <?php echo 'placeholder="'.$LicenseNo.'"'; ?> readonly>
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

    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- javascript -->
    <!-- <script src="../js/index.js"></script> -->
</body>

</html>
