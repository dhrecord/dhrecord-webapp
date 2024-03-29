<?php

    session_start();    

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DHRecord</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jquery -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body style="background-color: #E5E5E5;">
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
                        <a class="nav-link active" aria-current="page" href="../ContactUs/index.php">Contact Us</a>
                    </li>
                </ul>
                <div>
                    <button type="button" class="btn btn-light btn-sm" style="width: 90px; margin-right: 10px;"
                        onclick="window.location.href='../RegistrationPagePatient/index.php'">
                        Register
                    </button>
                    <button type="button" class="btn btn-light btn-sm" style="width: 90px;"
                        onclick="window.location.href='../LoginPage/index.html'">
                        Login
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="container mt-5 mb-4 text-center">
            <h4>Contact Us</h4>
        </div>

        <div class="container">
            <form style="width: fit-content; border-top-width: 10px!important;"
                class="py-3 px-4 mx-auto border border-dark mb-5">
                <div class="mb-3">
                    <label for="inputName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="inputName" style="width: 500px;">
                </div>
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp"
                        style="max-width: 500px;">
                    <div id="emailHelp" class="form-text">
                        We'll never share your email with anyone else.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputContactNo" class="form-label">Contact No.</label>
                    <input type="text" class="form-control" id="inputContactNo" style="max-width: 500px;">
                </div>
                <div class="mb-3">
                    <label for="inputSubject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="inputSubject" style="max-width: 500px;">
                </div>
                <div class="mb-3">
                    <label for="inputMsg" class="form-label">Message</label>
                    <textarea type="text" class="form-control" id="inputMsg" rows="4"
                        style="max-width: 500px;"></textarea>
                </div>
                <div class="mb-3 text-center">
                    <input type="submit" name="" id="" class="btn btn-dark mt-3 px-5">
                </div>
            </form>

            <hr>
        </div>

        <div class="container pb-4">
            <footer class="pt-1 mt-0 text-muted text-center">
                &copy; DHRecord 2021
            </footer>
        </div>
    </main>


    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script> -->

          <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>