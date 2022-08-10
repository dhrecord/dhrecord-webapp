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
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jquery -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body onload="findData();">
    <?php include 'navBar.php'; ?>

    <!--test--> 
    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-5">Manage Records</h4>
        <div class="mb-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <p class="m-0"><b>Search:</b>&nbsp;&nbsp;&nbsp;</p>
                <div class="input-group">
                    <input type="text" id="searchNameInput" class="form-control" placeholder="Name" aria-label="Name"
                        aria-describedby="basic-addon2" style="max-width: 300px;" />
                    <button class="input-group-text" id="basic-addon2" onclick="searchName();">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
            <div class="referral-box px-3 py-1">
                <!--<p class="m-0"><b>Referral Letter: ASX7aJWs</b></p>-->
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">NRIC</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Email</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    <!--<th scope="col">Check Referral</th>-->
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
                    <td><button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal<?php echo $row["ID"]; ?>">Edit</button></td>
                    <td><button type="button" class="btn btn-sm btn-success" onclick="document.location.href='deletePatient.php?UserID=<?php echo $row["users_ID"]; ?>'">Delete</button></td>
                    <td><button type="button" class="btn btn-sm btn-success" onclick="document.location.href='familyTagging.php?UserID=<?php echo $row["users_ID"]; ?>'">Family Tagging</button></td>
               </tr>


        <!-- modal -->
        <div class="modal fade" id="popupModal<?php echo $row["ID"]; ?>" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="popupModalLabel">View/Edit Full Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./editUserPatient.php" method="post">
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
                                <input type="text" class="form-control" id="contactNumber" name="contactNumber" <?php echo 'value="'.$row["contactNumber"].'"'; ?>>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" <?php echo 'value="'.$row["email"].'"'; ?>>
                            </div>
                            <div class="mb-3">
                                <label for="medConditions" class="form-label">Medical Conditions</label>
                                <input type="text" class="form-control" id="medConditions" name="medConditions" <?php echo 'value="'.$row["medConditions"].'"'; ?>>
                            </div>
                            <div class="mb-3">
                                <label for="drugAllergies" class="form-label">Drug Allergies</label>
                                <input type="text" class="form-control" id="drugAllergies" name="drugAllergies" <?php echo 'value="'.$row["drugAllergies"].'"'; ?>>
                            </div>
                            <div class="mb-3 row">
                                <div class="text-center"><button type="submit" class="btn btn-dark mt-4 px-5">Submit</button></div>
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

    <script src="../js/index.js"></script>
</body>

</html>
