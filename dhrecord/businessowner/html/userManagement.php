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

    <!--test-->

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
    <?php
    include 'navBar.php';
?>


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
            <!--<select class="form-select" id="userManagement_ddlFilterBy" aria-label="Filter By..."
                style="margin-left: 70px; max-width: 250px;">
                <option selected disabled hidden>Filter By...</option>
                <option value="2">Name</option>
                <option value="3">Address</option>
                <option value="4">NRIC</option>
                <option value="5">Contact No</option>
                <option value="6">Email</option>
            </select>-->

            <div class="referral-box px-3"> 
                <button type="button" class="btn btn-dark" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; margin-left: 800px;" onclick="window.location.href='./addUser.php';">Add New User</button>
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
                        $clinicadminUserID = $row["userID"];
                        $query1 = "SELECT * FROM users WHERE ID = $clinicadminUserID";
                        $result1 = $conn->query($query1);
                        $row1 = $result1->fetch_assoc();
                ?>
                    <tr>
                        <td><?php echo $row["fullName"]; ?></td>
                        <td><?php echo $row1["role"]; ?></td> 
                        <td><?php echo $row["contactNumber"]; ?></td> 
                        <td><?php echo $row["email"]; ?></td>
                        <td><button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal<?php echo $row["clinicadminID"]; ?>">Edit</button></td>
                        <td><button type="button" class="btn btn-sm btn-success" onclick="document.location.href='deleteUser.php?UserID=<?php echo $row["userID"]; ?>'">Delete</button></td>
                    </tr>



        <!-- modal -->
        <div class="modal fade" id="popupModal<?php echo $row["clinicadminID"]; ?>" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="popupModalLabel">View/Edit Full Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./editUserClinicAdmin.php" method="post">
                            <p style="display: none;" id="invisibleID"></p>
                            <div class="mb-3">
                                <label for="clinicadminID" class="form-label">Clinic Admin ID</label>
                                <input type="text" class="form-control" id="clinicadminID" name="clinicadminID" <?php echo 'value="'.$row["clinicadminID"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="fullName" <?php echo 'value="'.$row["fullName"].'"'; ?>>
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
                                <label for="clinicID" class="form-label">Clinic ID</label>
                                <input type="text" class="form-control" id="clinicID" name="clinicID"<?php echo 'value="'.$row["clinicID"].'"'; ?> readonly>
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

        <?php

            $query2 = "SELECT * FROM frontDesk WHERE clinicID = $clinicID";

            if ($result2 = $conn->query($query2)) 
            {
                while ($row2 = $result2->fetch_assoc()) 
                {
                    $frontdeskUserID = $row2["userID"];
                    $query3 = "SELECT * FROM users WHERE ID = $frontdeskUserID";
                    $result3 = $conn->query($query3);
                    $row3 = $result3->fetch_assoc();
            ?>
                <tr>
                    <td><?php echo $row2["fullName"]; ?></td>
                    <td><?php echo $row3["role"]; ?></td> 
                    <td><?php echo $row2["contactNumber"]; ?></td> 
                    <td><?php echo $row2["email"]; ?></td>
                    <td><button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModalFD<?php echo $row2["frontdeskID"]; ?>">Edit</button></td>
                    <td><button type="button" class="btn btn-sm btn-success" onclick="document.location.href='deleteUser.php?UserID=<?php echo $row2["userID"]; ?>'">Delete</button></td>
                </tr>



        <!-- modal -->
        <div class="modal fade" id="popupModalFD<?php echo $row2["frontdeskID"]; ?>" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="popupModalLabel">View/Edit Full Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./editUserFrontDesk.php" method="post">
                            <p style="display: none;" id="invisibleID"></p>
                            <div class="mb-3">
                                <label for="frontdeskID" class="form-label">Front Desk ID</label>
                                <input type="text" class="form-control" id="frontdeskID" name="frontdeskID" <?php echo 'value="'.$row2["frontdeskID"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="fullName" <?php echo 'value="'.$row2["fullName"].'"'; ?>>
                            </div>
                            <div class="mb-3">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contactNumber" name="contactNumber" <?php echo 'value="'.$row2["contactNumber"].'"'; ?>>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" <?php echo 'value="'.$row2["email"].'"'; ?>>
                            </div>
                            <div class="mb-3">
                                <label for="clinicID" class="form-label">Clinic ID</label>
                                <input type="text" class="form-control" id="clinicID" name="clinicID"<?php echo 'value="'.$row2["clinicID"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3 row">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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

        <?php

            $query4 = "SELECT * FROM doctor WHERE clinicID = $clinicID";

            if ($result4 = $conn->query($query4)) 
            {
                while ($row4 = $result4->fetch_assoc()) 
                {
                    $doctorUserID = $row4["userID"];
                    $query5 = "SELECT * FROM users WHERE ID = $doctorUserID";
                    $result5 = $conn->query($query5);
                    $row5 = $result5->fetch_assoc();
            ?>
                <tr>
                    <td><?php echo $row4["fullName"]; ?></td>
                    <td><?php echo $row5["role"]; ?></td> 
                    <td><?php echo $row4["contactNumber"]; ?></td> 
                    <td><?php echo $row4["email"]; ?></td>
                    <td><button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModalDR<?php echo $row4["doctorID"]; ?>">Edit</button></td>
                    <td><button type="button" class="btn btn-sm btn-success" onclick="document.location.href='deleteUser.php?UserID=<?php echo $row4["userID"]; ?>'">Delete</button></td>
                </tr>



        <!-- modal -->
        <div class="modal fade" id="popupModalDR<?php echo $row4["doctorID"]; ?>" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="popupModalLabel">View/Edit Full Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./editUserDoctor.php" method="post">
                            <p style="display: none;" id="invisibleID"></p>
                            <div class="mb-3">
                                <label for="doctorID" class="form-label">Doctor ID</label>
                                <input type="text" class="form-control" id="doctorID" name="doctorID" <?php echo 'value="'.$row4["doctorID"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="fullName" <?php echo 'value="'.$row4["fullName"].'"'; ?>>
                            </div>
                            <div class="mb-3">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contactNumber" name="contactNumber" <?php echo 'value="'.$row4["contactNumber"].'"'; ?>>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" <?php echo 'value="'.$row4["email"].'"'; ?>>
                            </div>
                            <div class="mb-3">
                                <label for="clinicID" class="form-label">Clinic ID</label>
                                <input type="text" class="form-control" id="clinicID" name="clinicID"<?php echo 'value="'.$row4["clinicID"].'"'; ?> readonly>
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
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="../js/index.js"></script>
</body>

</html>
