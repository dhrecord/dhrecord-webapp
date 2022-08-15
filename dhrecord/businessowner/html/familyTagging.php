<?php

session_start();
if(!isset($_SESSION['loggedin']))
{
	header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
	exit;
}

$UserID = $_GET['ChangeID'];
	
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

$query = "SELECT * FROM registeredPatient WHERE users_ID='$UserID'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

$patientID = $row["ID"];
$fullName = $row["fullName"];
$currentFamilyTag = $row["familyTag"];
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
   <?php
    include 'navBar.php';
?>


    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-4">Family Tagging</h4>
        <form method="post" action="./tagNewFamily.php" method="POST">
            <div class="container border border-dark p-4" style="border-top-width: 10px!important;">
                <div class="mb-3 row">
                    <label for="patientID" class="col-sm-2 col-form-label">Patient ID</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="patientID" name="patientID" <?php echo 'value = "'.$patientID. '"'; ?> readonly> 
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="fullName" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fullName" name="fullName" <?php echo 'value = "'.$fullName. '"'; ?> readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="familyTag" class="col-sm-2 col-form-label">Family Tag</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="currentFamilyTag" name="currentFamilyTag" <?php echo 'value = "'.$currentFamilyTag. '"'; ?> readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="familyMember" class="col-sm-2 col-form-label">Family Member</label>
                    <div class="col-sm-10">
                        <?php
                        $sql1 = "SELECT * FROM `registeredPatient`";
                        $result1 = mysqli_query($conn,$sql1);

                        echo "<select name='familyMember'>";
                        
                        while($row1 = mysqli_fetch_array($result1))
                        {
                            echo "<option value='" . $row1['ID'] ."'>" . $row1['fullName'] ."</option>";
                        }

                        echo "</select>";
                        ?>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="text-center"><button type="submit" class="btn btn-dark mt-4 px-5">Submit</button></div>
                </div>
            </div>
        </form>

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
               if($currentFamilyTag == 0)
               {
               ?>
               <td></td>
               <td></td>
               <td>No family Members currently</td>
               <td></td>
               <td></td>
               <td></td>
               <?php
               }

               else{
                    $query2 = "SELECT * FROM registeredPatient WHERE familyTag = $currentFamilyTag";

                    if ($result2 = $conn->query($query2)) 
                    {
                        while ($row2 = $result2->fetch_assoc()) 
                        {
               ?>
               <tr>     
                    <td><?php echo $row2["fullName"]; ?></td>
                    <td><?php echo $row2["address"]; ?></td> 
                    <td><?php echo $row2["nricNumber"]; ?></td> 
                    <td><?php echo $row2["contactNumber"]; ?></td>
                    <td><?php echo $row2["email"]; ?></td>
                    <td><button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal<?php echo $row2["ID"]; ?>">View</button></td>
               </tr>


        <!-- modal -->
        <div class="modal fade" id="popupModal<?php echo $row2["ID"]; ?>" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="popupModalLabel">View/Edit Full Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <p style="display: none;" id="invisibleID"></p>
                            <div class="mb-3">
                                <label for="clinicadminID" class="form-label">Patient ID</label>
                                <input type="text" class="form-control" id="patientID" name="patientID" <?php echo 'value="'.$row2["ID"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="fullName" <?php echo 'value="'.$row2["fullName"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="nricNumber" class="form-label">NRIC Number</label>
                                <input type="text" class="form-control" id="nricNumber" name="nricNumber" <?php echo 'value="'.$row2["nricNumber"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contactNumber" name="contactNumber" <?php echo 'value="'.$row2["contactNumber"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" <?php echo 'value="'.$row2["email"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="medConditions" class="form-label">Medical Conditions</label>
                                <input type="text" class="form-control" id="medConditions" name="medConditions" <?php echo 'value="'.$row2["medConditions"].'"'; ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label for="drugAllergies" class="form-label">Drug Allergies</label>
                                <input type="text" class="form-control" id="drugAllergies" name="drugAllergies" <?php echo 'value="'.$row2["drugAllergies"].'"'; ?> readonly>
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

        }
        ?>

                    </tbody>
        </table>

    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
