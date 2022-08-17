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
	    $prescriptionPrice = $res['prescriptionPrice'];
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
    <?php
    include 'navBar.php';
?>


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
                    <label for="contactNumber" class="col-sm-2 col-form-label">Price($SGD)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="prescriptionPrice" name="prescriptionPrice" value= "<?php echo $prescriptionPrice ?>">
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
