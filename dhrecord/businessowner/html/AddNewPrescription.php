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
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
   <?php
    include 'navBar.php';
?>

    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-4">Inventory Management (Add New Prescription)</h4>
        <form method="post" action="./addPrescription.php">
            <div class="container border border-dark p-4" style="border-top-width: 10px!important;">
                <div class="mb-3 row">
                    <label for="fullName" class="col-sm-2 col-form-label">Prescription Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="prescriptionName" name="prescriptionName">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nricNumber" class="col-sm-2 col-form-label">Prescription Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="prescriptionDesc" name="prescriptionDesc">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="contactNumber" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="Quantity" name="Quantity">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="contactNumber" class="col-sm-2 col-form-label">Price($SGD)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="prescriptionPrice" name="prescriptionPrice" value= "">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Remarks</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="Remarks" name="Remarks">
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
