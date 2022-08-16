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
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid container">
            <a class="navbar-brand" href="../ClinicSearch/index.php"><b>DHRecord</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../ClinicSearch/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../About/index.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../ContactUs/index.php">Contact Us</a>
                    </li>
                </ul>
                <div>
                    <button type="button" class="btn btn-light btn-sm" style="width: 90px;"
                        onclick="window.location.href='../LoginPage/index.html'">Login</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-4">Registration Management - Business Owner</h4>
        <div class="container border border-dark p-4" style="border-top-width: 10px!important;">
            <form method="post" action="./connect.php">
                <div class="mb-3 row">
                    <label for="fullName" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fullName" name="fullName" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nricNumber" class="col-sm-2 col-form-label">NRIC Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nricNumber" name="nricNumber" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="contactNumber" class="col-sm-2 col-form-label">Contact Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="contactNumber" name="contactNumber" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="userName" name="userName" required/>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="passWord" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="passWord" name="passWord" required/>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="RegistrationNumber" class="col-sm-2 col-form-label">Registration Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="RegistrationNumber" name="RegistrationNumber" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="LicenseNumber" class="col-sm-2 col-form-label">License Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="LicenseNumber" name="LicenseNumber" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nameOfClinic" class="col-sm-2 col-form-label">Name of Clinic</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nameOfClinic" name="nameOfClinic" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="locationOfClinic" class="col-sm-2 col-form-label">Location of Clinic</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="locationOfClinic" name="locationOfClinic" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="clinicSpecialization" class="col-sm-2 col-form-label">Clinic Specialization</label>
                    <div class="col-sm-10">
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

                        $sql = "SELECT * FROM `clinicSpecialization`";
                        $result = mysqli_query($conn,$sql);

                        echo "<select name='clinicSpecialization' class='form-select'>";
                        
                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<option value='" . $row['ID'] ."'>" . $row['specName'] ."</option>";
                        }

                        echo "</select>";
                        ?>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="text-center"><button type="submit" class="btn btn-dark mt-4 px-5">Submit</button></div>
                </div>
                
            </form>
        </div>
    </div>

    <div class="container pb-5">
        <footer class="pt-3 mt-4 text-muted border-top text-center">
            &copy; DHRecord 2021
        </footer>
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>