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
                        <a class="nav-link" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./userManagement.php">User Management</a>
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
                        <a class="nav-link active" href="./inventoryManagement.php">Inventory Management</a>
                    </li>
                </ul>
                <div class="d-flex flex-column align-items-end">
                    <p class="navbar-text text-white m-0">
                        <!-- Welcome, <?php echo $_SESSION['username'];?> -->
                    </p>
                    <button type="button" class="btn btn-light ml-3 btn-sm mb-2"
                            onclick="document.location.href='../../LoginUnregisteredPatient/LoginPage/logout.php'">
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </nav>
 <div class="container my-5">
        <h4 class="mb-5">Inventory Management</h4>
        <form action="" method ="POST">
        <div class="mb-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <p class="m-0"><b>Search:</b>&nbsp;&nbsp;&nbsp;</p>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search..." style="max-width: 300px;       id="qty" name="qty" value="" />
                    <button type="button" class="btn btn-dark" type="submit" name="submit"/>
                    

                    
                </div>
            </div>
            
        
        </div>
        </form>
</div>
<?php

	require_once("connection.php");	

//if(isset($_POST['submit']))
//{

	//$ID = $_GET['ID'];
    //$prescriptionName = $_POST['prescriptionName'];
	//$prescriptionDesc = $_POST['prescriptionDesc'];
	//$ID = $_POST['prescription'];
	//$prescriptionQty = $_POST['qty'];
	
	$ID = 5;
	//$prescriptionQty = $_POST['$prescriptionQty'];
	//$test = $prescriptionQty - "1";
	
    //$queryy = "select * `inventoryManagement` ";
	//$queryy = "UPDATE `inventoryManagement` SET prescriptionQty = '".$test."'WHERE ID= 5";
	//$result1 = mysqli_query($conn,$queryy) or die (mysqli_error());

	//if($result1)
	//{
	    $result1 = mysqli_query($conn, "SELECT * FROM `inventoryManagement` WHERE ID ='".$ID."'");
                
                    while($obj = mysqli_fetch_assoc($result1))
                        {
                            
                            $ID = $obj['ID'];
                            $prescriptionName = $obj['prescriptionName'];
	                        $prescriptionDesc = $obj['prescriptionDesc'];
	                        $prescriptionQty = $obj['prescriptionQty']; 
	                        $Remarks = $obj['Remarks'];
                            
                        ?>
                            <tr>
                                <td><?php echo $ID ?></td>
                                <td><?php echo $prescriptionName ?></td>
                                <td><?php echo $prescriptionDesc ?></td>
                                <td><?php echo $prescriptionQty ?></td>
                                <td><?php echo $Remarks ?></td>
                                <td><a href="editInv.php?GetID=<?php echo $ID ?>">Edit</a></td>                    
                                <td><a href="deleteInv.php?Delete=<?php echo $ID ?>">Delete</a></td>
                                <td><a href="test1.php?GetID=<?php echo $ID ?>">Dispense Prescription</a></td>
                            </tr>
                        <?php
                        
                        $test = $prescriptionQty - 1;
                        }
	                    echo $test;
	//}
	//else
	//{
	//	echo "please check your query"; 
	//}

//}
//else {
//	header("location:inventoryManagement.php");
//}

if(isset($_POST['submit']))
{

	//$ID = $_GET['ID'];
    //$prescriptionName = $_POST['prescriptionName'];
	//$prescriptionDesc = $_POST['prescriptionDesc'];
	//$ID = $_POST['prescription'];
	//$prescriptionQty = $_POST['qty'];
	
	$ID = 5;
	//$prescriptionQty = $ID['$prescriptionQty'];
	$test = $prescriptionQty - 1;
	//echo $test;
    //$queryy = "select * `inventoryManagement` ";
	$queryy = "UPDATE `inventoryManagement` SET prescriptionQty = '".$test."' WHERE ID= '".$ID."'";
	$result2 = mysqli_query($conn,$queryy) or die (mysqli_error());

}
?>
    </body>
</html>