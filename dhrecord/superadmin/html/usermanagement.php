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
         <!-- <li class="nav-item">
            <a class="nav-link active" href="./usermanagement.php">User Management</a>
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
                <option value="1">No</option>
                <option value="2">Name</option>
                <option value="3">Address</option>
                <option value="4">NRIC</option>
                <option value="5">Contact No</option>
                <option value="6">Email</option>
                <option value="7">Check Referral</option>
            </select>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">NRIC</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Email</th>
                    <th scope="col">Check Referral</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody id="data">
                <!-- <tr>
                    <th scope="row">1</th>
                    <td>John Doe</td>
                    <td>5 Magazine Road #02-01, 059571, Singapore</td>
                    <td>S5219994H</td>
                    <td>+65 8950 4262</td>
                    <td>JohnDoe@gmail.com</td>
                    <td class="text-center"><button class="border-0 edit-btn" data-bs-toggle="modal"
                            data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button>
                    </td>
                    <td class="text-center"><button class="border-0"><i class="fa-solid fa-trash-can"></i></button></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jane Doe</td>
                    <td>926 Yishun Central 1 01-177, 760926, Singapore</td>
                    <td>S6891261Z</td>
                    <td>+65 8952 7201</td>
                    <td>JaneDoe@gmail.com</td>
                    <td class="text-center"><button class="border-0 edit-btn" data-bs-toggle="modal"
                            data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button>
                    </td>
                    <td class="text-center"><button class="border-0"><i class="fa-solid fa-trash-can"></i></button></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Nate</td>
                    <td>1 Coleman Street 02-30/31 The Adelphi, 179803, Singapore</td>
                    <td>S9168686D</td>
                    <td>+65 9786 5789</td>
                    <td>Nate22@gmail.com</td>
                    <td class="text-center"><button class="border-0 edit-btn" data-bs-toggle="modal"
                            data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button>
                    </td>
                    <td class="text-center"><button class="border-0"><i class="fa-solid fa-trash-can"></i></button></td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Jack</td>
                    <td>112 East Coast Road #B1-14 112 Katong, 428802, Singapore</td>
                    <td>S5397679D</td>
                    <td>+65 8951 7299</td>
                    <td>Jack11@gmail.com</td>
                    <td class="text-center"><button class="border-0 edit-btn" data-bs-toggle="modal"
                            data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button>
                    </td>
                    <td class="text-center"><button class="border-0"><i class="fa-solid fa-trash-can"></i></button></td>
                </tr> -->
            </tbody>
        </table>

        <!-- modal -->
        <div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="popupModalLabel">Edit Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <p style="display: none;" id="invisibleID"></p>
                            <div class="mb-3">
                                <label for="inputName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="inputName">
                            </div>
                            <div class="mb-3">
                                <label for="inputAddress" class="form-label">Address</label>
                                <input type="text" class="form-control" id="inputAddress">
                            </div>
                            <div class="mb-3">
                                <label for="inputNRIC" class="form-label">NRIC</label>
                                <input type="text" class="form-control" id="inputNRIC">
                            </div>
                            <div class="mb-3">
                                <label for="inputContactNo" class="form-label">Contact No.</label>
                                <input type="text" class="form-control" id="inputContactNo">
                            </div>
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="inputCheckReferral" class="form-label">Check Referral</label>
                                <input type="text" class="form-control" id="inputCheckReferral">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" onclick="saveDetails();" class="btn btn-primary">Save changes</button>
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
