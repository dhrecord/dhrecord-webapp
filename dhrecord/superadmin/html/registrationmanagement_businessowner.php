<?php

    session_start();

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

<body onload="findData3();">
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
            <a class="nav-link active" aria-current="page" href="./home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./clinicspecialization.php">Clinic Specialization</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./auditlog.php">Audit Log</a>
          </li>
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

    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-5">Registration Management - Business Owner</h4>


        <div class="mb-4 d-flex align-items-center">
            <div class="d-flex align-items-center">
                <p class="m-0"><b>Search:</b>&nbsp;&nbsp;&nbsp;</p>
                <div class="input-group">
                    <input type="text" id="searchNameInput" class="form-control" placeholder="Enter Value ..."
                        aria-label="Name" aria-describedby="basic-addon2" style="max-width: 300px;" />
                    <button class="input-group-text" id="basic-addon2" onclick="searchName3();">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
            <select class="form-select" id="regManBO_ddlFilterBy" aria-label="Filter By..."
                style="margin-left: 70px; max-width: 250px;">
                <option selected disabled hidden>Filter By...</option>
                <option value="1">No</option>
                <option value="2">Clinic Name</option>
                <option value="3">Address</option>
                <option value="4">Contact No.</option>
                <option value="5">Email</option>
                <option value="6">Registration No.</option>
                <option value="7">License No.</option>
                <option value="8">Registration Date</option>
                <option value="9">Specialization</option>
            </select>
        </div>

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
                    <th scope="col">Registration No.</th>
                    <th scope="col">License No.</th>
                    <th scope="col">Account Status</th>
                    <th scope="col">Full Info</th>
                    <th scope="col">Approve</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <!-- modal -->
        <div class="modal fade" id="popupModal3" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
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
                                <input type="text" class="form-control" id="inputName" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputAddress" class="form-label">Address</label>
                                <input type="text" class="form-control" id="inputAddress" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputContactNo" class="form-label">Contact No.</label>
                                <input type="text" class="form-control" id="inputContactNo" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputSpecialization" class="form-label">Specialization</label>
                                <textarea rows=3 type="text" class="form-control" id="inputSpecialization"
                                    readonly></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="inputRegistrationNo" class="form-label">Registration No.</label>
                                <input type="text" class="form-control" id="inputRegistrationNo" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputLicenseNo" class="form-label">License No.</label>
                                <input type="text" class="form-control" id="inputLicenseNo" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputRegistrationDate" class="form-label">Registration Date</label>
                                <input type="text" class="form-control" id="inputRegistrationDate" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputContractPeriod" class="form-label">Contract Period</label>
                                <input type="text" class="form-control" id="inputContractPeriod" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputAccountStatus" class="form-label">Account Status</label>
                                <input type="text" class="form-control" id="inputAccountStatus" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputScannedLicense" class="form-label">Scanned License</label>
                                <div class="bg-dark text-white p-5 text-center">Sample Scanned License</div>
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

    <!-- javascript -->
    <script src="../js/index.js"></script>
</body>

</html>