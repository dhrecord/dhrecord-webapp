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
                        <a class="nav-link" aria-current="page" href="../ContactUs/index.html">Contact Us</a>
                    </li>
                </ul>
                <div>
                    <!--<button type="button" class="btn btn-light btn-sm" style="width: 90px; margin-right: 10px;"
                        onclick="window.location.href='../RegistrationPagePatient/index.php'">Register</button>-->
                    <button type="button" class="btn btn-light btn-sm" style="width: 90px;"
                        onclick="window.location.href='../LoginPage/index.html'">Login</button>
                </div>
            </div>
        </div>
    </nav>

    <!--registration form-->
    <div class="container my-5">
        <h4 class="mb-4">Registration Management - Patient Account</h4>
        <form name="registrationFormPatient" method="post" action="./connect.php" onsubmit="return validate()">
            <div class="container border border-dark p-4" style="border-top-width: 10px!important;">
                <div class="mb-3 row">
                    <label for="fullName" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fullName" name="fullName" required />
                        <span class="error">* <?php $nameErr=""; echo $nameErr;?></span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nricNumber" class="col-sm-2 col-form-label">NRIC Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nricNumber" name="nricNumber" required/>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="contactNumber" class="col-sm-2 col-form-label">Contact Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="contactNumber" name="contactNumber" required/>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" required/>
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
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="address" rows="2" cols="50"
                            name="address" required></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="med-conditions" class="col-sm-2 col-form-label">Medical Conditions</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="med-conditions" rows="4" cols="50"
                            name="med-conditions" required></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="drug-allergies" class="col-sm-2 col-form-label">Drug Allergies</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="drug-allergies" rows="2" cols="50"
                            name="drug-allergies" required></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="text-center"><button type="submit" class="btn btn-dark mt-4 px-5">Submit</button></div>
                </div>
            </div>
        </form>
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