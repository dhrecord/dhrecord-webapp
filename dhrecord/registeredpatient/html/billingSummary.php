<?php
  session_start();
  if(!isset($_SESSION['loggedin']))
  {
    header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    exit;
  }
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

<!--<body onload="findPrescriptionData();">-->
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
                            <li><a class="dropdown-item" href="./apptSchedulingAndReminders.php">Appointment Scheduling
                                    & Reminders</a></li>
                            <li><a class="dropdown-item" href="./treatmentHistory.php">Treatment Planning</a></li>
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
                        onclick="document.location.href='../../LoginUnregisteredPatient/LoginPage/logout.php'">Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-5">Billing Summary</h4>
        <form action="" method ="POST">
        <div class="mb-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <p class="m-0"><b>Search:</b>&nbsp;&nbsp;&nbsp;</p>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search..." style="max-width: 300px;" id="search" name="search" value="" />
                    <button class="input-group-text" id="basic-addon2" type="submit" name="search1">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <input type="text" class="form-control" placeholder="Search..." style="max-width: 300px;" id="qty" name="qty" value="" />
                    <button type="button" class="btn btn-dark" type="submit" name="submit"></button>
                
                    <!-- </form> -->
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
                    <th scope="col">ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Attending Doctor</th>
                    <th scope="col">Patient Name</th>
                    <th scope="col">Tooth Condition</th>
                    <th scope="col">Diagnosis</th>
                    <th scope="col">Medication Prescribed</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Generate Bill PDF</th> 
                    
                </tr>
            </thead>
            
            <tbody>
            <?php
                require_once("connection.php");
                
                if(isset($_POST['search']))
                    {
                        $searchkey= $_POST['search'];
                        $res = mysqli_query($conn, "SELECT * FROM `inventoryManagement` WHERE prescriptionName LIKE '%$searchkey%'");
                            //test 3
                    }

                else 
                    //$res = mysqli_query($conn, "select * from `treatmentHistory`");
                    //$res = mysqli_query($conn,"SELECT treatmentHistory.ID,treatmentHistory.date,doctor.fullName//,treatmentHistory.pt_ID,treatmentHistory.toothCondition,treatmentHistory.diagnosis//,treatmentHistory.medicationPrescribed,treatmentHistory.quantity,treatmentHistory.comments  //FROM treatmentHistory, doctor WHERE treatmentHistory.attendingDoctor =  doctor.doctorID");
                    
                    //$res = "SELECT *  FROM treatmentHistory INNER JOIN doctor ON treatmentHistory.attendingDoctor =  doctor.doctorID";
                    $res = "SELECT * FROM treatmentHistory";
                    //$res = "SELECT * FROM brand INNER JOIN product ON brand.brand_id = product.brand_id";

			//$result = mysqli_query($conn, $res);
                if ($res1 = $conn->query($res))
                    while($obj = $res1->fetch_assoc())
                        {
                            $doctorID = $obj["attendingDoctor"];
                            $query1 = "SELECT * FROM doctor WHERE doctorID = $doctorID";
                            $res2 = $conn->query($query1);
                            $obj1 = $res2->fetch_assoc();
                            
                            $PT_ID = $obj["pt_ID"];
                            $query2 = "SELECT * FROM registeredPatient WHERE ID = $PT_ID";
                            $res3 = $conn->query($query2);
                            $obj2 = $res3->fetch_assoc();
                            
                            //$ID = $obj['ID'];
                            //$date = $obj['date'];
	                        //$attendingDoctor = $obj['attendingDoctor'];
	                        //$fullName = $obj1['fullName'];
	                        //$fullName1 = $obj2['fullName'];
	                        //$pt_ID = $obj['pt_ID'];
                            //$toothCondition = $obj['toothCondition']; 
	                        //$diagnosis = $obj['diagnosis'];
                            //$medicationPrescribed = $obj['medicationPrescribed'];
                            //$quantity = $obj['quantity'];
                            //$comments = $obj['comments'];
                          
                            
                        ?>
                            <tr>
                                <td><?php echo $obj['ID'] ?></td>
                                <td><?php echo $obj['date'] ?></td>
                                <td><?php echo $obj1['fullName'] ?></td>
                                <td><?php echo $obj2['fullName'] ?></td>
                                <td><?php echo $obj['toothCondition'] ?></td>
                                <td><?php echo $obj['diagnosis'] ?></td>
                                <td><?php echo $obj['medicationPrescribed'] ?></td>
                                <td><?php echo $obj['quantity'] ?></td>
                                <td><?php echo $obj['comments'] ?></td>
                                <td><a href="generateBillPDF.php?GetID=<?php echo $ID ?>">Generate</a></td> 
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
