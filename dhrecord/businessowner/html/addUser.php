<?php
  session_start();
  if(!isset($_SESSION['loggedin']))
  {
    header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    exit;
  }

  $sessionID = $_SESSION['id'];
  
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
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <?php
    include 'navBar.php';
?>

    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-4">Add New User</h4>
        <form method="post" action="./addNewUser.php" method="POST">
            <div class="container border border-dark p-4" style="border-top-width: 10px!important;">
                <div class="mb-3 row">
                    <label for="clinicID" class="col-sm-2 col-form-label">Clinic ID</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="clinicID" name="clinicID" <?php echo 'value = "'.$clinicID. '"'; ?> disabled> 
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="role" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select name="role" id="role" class="form-select" style="max-width:150px">
                            <option value="dr">Doctor</option>
                            <option value="ca">Clinic Admin</option>
                            <option value="fd">Front Desk</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="fullName" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fullName" name="fullName" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="contactNumber" class="col-sm-2 col-form-label">Contact Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="contactNumber" name="contactNumber" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="userName" name="userName" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="passWord" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="passWord" name="passWord" required />
                    </div>
                </div>

                <!-- only show this if user choose doctor -->
                <div class="mb-3 row">
                    <p><b>Operating Hours:</b></p>

                    <div class="mb-3 row">
                        <label for="Monday" class="col-sm-2 col-form-label">Monday</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <input type="time" class="form-control" id="Monday" name="Monday" value="00:00" required style="max-width:200px"/>
                            &nbsp;&nbsp;-&nbsp;&nbsp;
                            <input type="time" class="form-control" id="Monday" name="Monday" value="00:00" required style="max-width:200px"/>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="Monday" class="col-sm-2 col-form-label"></label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Closed</label>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="Tuesday" class="col-sm-2 col-form-label">Tuesday</label>
                        <div class="col-sm-5 d-flex align-items-center">
                            <input type="time" class="form-control" id="Tuesday" name="Tuesday" value="00:00" required style="max-width:200px"/>
                            &nbsp;&nbsp;-&nbsp;&nbsp;
                            <input type="time" class="form-control" id="Monday" name="Monday" value="00:00" required style="max-width:200px"/>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Closed</label>
                        </div>
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
