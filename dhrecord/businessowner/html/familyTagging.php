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
        <h4 class="mb-4">Add New User</h4>
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
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
