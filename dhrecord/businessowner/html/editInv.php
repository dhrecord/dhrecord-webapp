<?php
	session_start();
	if(!isset($_SESSION['loggedin']))
	{
	header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
	exit;
	}

    require_once("connection.php");

    $ID = $_GET['GetID'];
    $query = "select * from `inventoryManagement` where ID='".$ID."'";
    $result = mysqli_query($conn,$query);

    while($res=mysqli_fetch_assoc($result))
    {
        $ID = $res['ID'];
        $prescriptionName = $res['prescriptionName'];
	    $prescriptionDesc = $res['prescriptionDesc'];
	    $prescriptionQty = $res['prescriptionQty'];
	    $Remarks = $res['Remarks'];

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
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <!-- navbar -->
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
        <h4 class="mb-4">Inventory Management (Edit Prescription)</h4>
        <form method="post" action="updateInv.php?ID=<?php echo $ID ?>">
            <div class="container border border-dark p-4" style="border-top-width: 10px!important;">
                <div class="mb-3 row">
                    <label for="fullName" class="col-sm-2 col-form-label">Prescription Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="prescriptionName" name="prescriptionName" value= "<?php echo $prescriptionName ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nricNumber" class="col-sm-2 col-form-label">Prescription Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="prescriptionDesc" name="prescriptionDesc" value= "<?php echo $prescriptionDesc ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="contactNumber" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="Quantity" name="Quantity" value= "<?php echo $prescriptionQty ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Remarks</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="Remarks" name="Remarks" value= "<?php echo $Remarks ?>">
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="text-center"><button type="submit" class="btn btn-dark mt-4 px-5" name="update">Update</button></div>
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
