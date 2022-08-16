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

<!--pls push for the love of god-->
<body onload="findData4();">
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
            <a class="nav-link active" href="./clinicspecialization.php">Clinic Specialization</a>
          </li>
          <!--<li class="nav-item">
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


    <main class="container my-5">
        <h4 class="mb-5">Clinic Specialization</h4>
        <div class="mb-4 d-flex align-items-center justify-content-between">
            <form action="" method ="POST">
                <div class="d-flex align-items-center">
                    <p class="m-0"><b>Search:</b>&nbsp;&nbsp;&nbsp;</p>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Specialization Name"
                            aria-label="Name" aria-describedby="basic-addon2" style="max-width: 400px;" id="search" name="search"/>
                        <button class="input-group-text" id="basic-addon2" type="submit" name="search1">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="d-flex justify-content-end">
                <!--<a href="./reviewrequest.php" class="btn btn-dark">Review Request</a>-->
                &nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#popupModalAddRow">Add
                    Specialization</button>
            </div>
        </div>


        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Specialization Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Edit</th>
                    <!--<th scope="col">Delete</th>-->
                </tr>
            </thead>
            <tbody>
                <?php
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

                $query = '';
                if(isset($_POST['search']))
                {
                    $searchkey= $_POST['search'];
                    $query = "SELECT * FROM `clinicSpecialization` WHERE specName LIKE '%$searchkey%'";
                }

                else {
                    $query = "SELECT * FROM clinicSpecialization";
                }

                // $query = "SELECT * FROM clinicSpecialization";

                if ($result = $conn->query($query)) 
                {
                    while ($row = $result->fetch_assoc()) 
                    {
                    
                        $ID = $row["ID"];
                        $specName = $row["specName"];
                        $description = $row["description"];
                ?>

                <!--display data-->
                <tr> 
                    <td><?php echo $row["ID"]; ?></td> 
                    <td><?php echo $row["specName"]; ?></td> 
                    <td><?php echo $row["description"]; ?></td> 
                    <td><button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal<?php echo $row["ID"]; ?>">Edit</button></td>
                </tr>

        <!-- modal -->
        <!-- edit row -->
        <div class="modal fade" id="popupModal<?php echo $row["ID"]; ?>" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="popupModalLabel">Edit Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./editClinicSpecialization.php" method="post">
                            <p style="display: none;" id="invisibleID"></p>
                            <div class="mb-3">
                                <label for="ID" class="form-label">ID</label>
                                <input type="text" class="form-control" id="ID" name="ID" <?php echo 'value="'.$row["ID"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputSpecializationName" class="form-label">Specialization Name</label>
                                <input type="text" class="form-control" id="inputSpecializationName" name="inputSpecializationName" <?php echo 'value="'.$row["specName"].'"'; ?>>
                            </div>
                            <div class="mb-3">
                                <label for="inputDescription" class="form-label">Description</label>
                                <textarea type="text" class="form-control" id="inputDescription" name="inputDescription" <?php echo 'value=" '.$row["description"].'"'; ?>></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- add row -->
        <div class="modal fade" id="popupModalAddRow" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="popupModalLabel">Add Specialization</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./addClinicSpecialization.php" method="post">
                            <div class="mb-3">
                                <label for="addSpecializationName" class="form-label">Specialization Name</label>
                                <input type="text" class="form-control" id="addSpecializationName" name="addSpecializationName">
                            </div>
                            <div class="mb-3">
                                <label for="addDescription" class="form-label">Description</label>
                                <textarea rows=3 type="text" class="form-control" id="addDescription" name="addDescription"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add Specialization</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

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

        <script>

        </script>

    <!-- <script src="../js/index.js"></script> -->
</body>

</html>
