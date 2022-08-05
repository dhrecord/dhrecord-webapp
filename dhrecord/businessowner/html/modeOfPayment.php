<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mode of Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="billInvoiceStylesheet.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid container">
            <?php 
                $role = $_SESSION['role'];
                if ($role === 'dr')
                {
                    echo '<a class="navbar-brand" href="./drindex.php"><b>DHRecord</b></a>';
                } else if ($role === "fd")
                {
                    echo '<a class="navbar-brand" href="./fdindex.php"><b>DHRecord</b></a>';
                } else
                {
                    echo '<a class="navbar-brand" href="./caindex.php"><b>DHRecord</b></a>';
                }
            ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <?php 
                            $role = $_SESSION['role'];
                            if ($role === 'dr')
                            {
                                echo '<a class="nav-link active" aria-current="page" href="./drindex.php">Home</a>';
                            } else if ($role === "fd")
                            {
                                echo '<a class="nav-link active" aria-current="page" href="./fdindex.php">Home</a>';
                            } else
                            {
                                echo '<a class="nav-link active" aria-current="page" href="./caindex.php">Home</a>';
                            }
                        ?>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="./userManagement.php">User Management</a>
                    </li>-->
                    <!--<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="nav-link" href="./userManagement.php">User Management</a></li>
                        <li><a class="dropdown-item" href="./manageRecord.php">View Patient</a></li>
                    </ul>-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            User & Records
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./userManagement.php">User Management</a></li>
                            <li><a class="dropdown-item" href="./manageRecord.php">View Patient</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./referralTracking.php">Referral Tracking</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Appointment & Treatment
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="./apptSchedulingAndReminders.php">
                                    Appointment Scheduling
                                    & Reminders
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="./treatmentHistory.php">Treatment History</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./reportingAndStatistics.php">Reporting & Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./billingInvoicing.php">Payment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./inventoryManagement.php">Inventory Management</a>
                    </li>
                </ul>
                <div class="d-flex flex-column align-items-end">
                    <p class="navbar-text text-white m-0">
                        Welcome, <?php echo $_SESSION['username']; ?>
                    </p>
                    <button type="button" class="btn btn-light ml-3 btn-sm mb-2"
                            onclick="document.location.href='../../LoginUnregisteredPatient/LoginPage/logout.php'">
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="container d-flex my-5">
        <div class="py-5">
            <img src="http://kokolevel.com/wp-content/uploads/2019/10/payment-methods.png" alt=""
                 style="max-width: 500px;" />
        </div>
        <div class="p-4"></div>
        <div class="px-5 d-flex align-items-center">
            <form class="paymentMode">
                <div class="modeOfPayment pb-2">Please select mode of payment:</div>
                <input type="radio" name="paymentMode" value="cardPayment"> Card Payment
                <br>
                <input type="radio" name="paymentMode" value="payPal"> Paypal
                <br><br>
                <button type="button" class="btn btn-lg btn-primary text-center">Next</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
            integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
            integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
            crossorigin="anonymous"></script>
</body>

</html>