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

<!--<body onload="findPrescriptionData();">-->
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid container">
            <a class="navbar-brand" href="./index.html"><b>DHRecord</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./userManagement.html">User Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./referralTracking.html">Referral Tracking</a>
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
                            <li><a class="dropdown-item" href="./treatmentPlanning.html">Treatment Planning</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./reportingAndStatistics.html">Reporting & Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./billingInvoicing.html">Payment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="./inventoryManagement.html">Inventory Management</a>
                    </li>
                </ul>
                <div class="d-flex flex-column align-items-end">
                    <p class="navbar-text text-white m-0">
                        Welcome, Username
                    </p>
                    <button type="button" class="btn btn-light ml-3 btn-sm mb-2"
                            onclick="document.location.href='./loginBusinessOwner.html'">
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-5">Inventory Management</h4>
        <div class="mb-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <p class="m-0"><b>Search:</b>&nbsp;&nbsp;&nbsp;</p>
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search..." aria-label="Name"
                           aria-describedby="basic-addon2" style="max-width: 300px;" />
                    <button class="input-group-text" id="basic-addon2" onclick="search();">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>

                    <!-- <p class="m-0"><b>Filter By:</b>&nbsp;&nbsp;&nbsp;</p> -->
                    <select class="form-select" id="ddlFilterBy" aria-label="Filter By..." style="margin-left: 80px;">
                        <option selected disabled hidden>Filter By...</option>
                        <option value="1">No (Row Number)</option>
                        <option value="2">Prescription Name</option>
                        <option value="3">Prescription Description</option>
                        <option value="4">Quantity</option>
                        <option value="5">Remarks</option>
                    </select>
                </div>
            </div>
            <div class="referral-box px-3 py-1">
                <button type="button" class="btn btn-dark"
                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                        onclick="window.location.href='./AddNewPrescription.php';">
                    Add New Prescription
                </button>
                
            </div>

        </div>

        
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Prescription Name</th>
                    <th scope="col">Prescription Description</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Remarks</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    
                </tr>
            </thead>
            <!--<tbody id="prescriptionData">-->
            <tbody>
                <?php
                    //Database Connection
	                //$servername = "localhost";
	                //$database = "u922342007_Test";
	                //$username = "u922342007_admin"; 
	                //$password = "Aylm@012";
	                // Create connection a
	                //$conn = mysqli_connect($servername, $username, $password, $database);

                    require_once("connection.php");

                    $res = mysqli_query($conn, "SELECT * FROM `inventoryManagement`");
                   
                    while($obj = mysqli_fetch_assoc($res))
                    {

                        $ID = $obj['ID'];
                        $prescriptionName = $obj['prescriptionName'];
	                    $prescriptionDesc = $obj['prescriptionDesc'];
	                    $prescriptionQty = $obj['prescriptionQty']; 
	                    $Remarks = $obj['Remarks'];

                     // echo "<tr><td>".$obj["ID"]."</td><td>".$obj["prescriptionName"]."</td><td>".$obj["prescriptionDesc"]."</td><td>".$obj["prescriptionQty"]."</td><td>".$obj['Remarks']."</td></tr>";
                     //if ($res) { echo "success"; mysqli_close($conn); } else { echo "error"; mysqli_close($conn); }
                    
                ?>
                        <tr>
                            <td><?php echo $ID ?></td>
                            <td><?php echo $prescriptionName ?></td>
                            <td><?php echo $prescriptionDesc ?></td>
                            <td><?php echo $prescriptionQty ?></td>
                            <td><?php echo $Remarks ?></td>
                            <td><a href="editInv.php?GetID=<?php echo $ID ?>">Edit</a></td>
                            <td><a href="deleteInv.php?Delete=<?php echo $ID ?>">Delete</a></td>
                        </tr>
                    <?php
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