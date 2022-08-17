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
    <?php
    include 'navBar.php';
?>


    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-5">Inventory Management</h4>
        <form action="" method ="POST">
        <div class="mb-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <p class="m-0"><b>Search:</b>&nbsp;&nbsp;&nbsp;</p>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search..." style="max-width: 300px;" id="search" name="search" value="" />
                    <button class="input-group-text" id="basic-addon2" type="submit" name="search1">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                
                    <!-- </form> -->
                </div>
            </div>
            <div class="referral-box px-3 py-1">
                <button type="button" class="btn btn-dark"
                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                        onclick="window.location.href='./AddNewPrescription.php';">
                    Add Item
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
                    <th scope="col">Price($SGD)</th>
                    <th scope="col">Remarks</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    
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
                    $res = mysqli_query($conn, "SELECT * FROM `inventoryManagement`");
                
                    while($obj = mysqli_fetch_assoc($res))
                        {

                            $ID = $obj['ID'];
                            $prescriptionName = $obj['prescriptionName'];
	                        $prescriptionDesc = $obj['prescriptionDesc'];
	                        $prescriptionQty = $obj['prescriptionQty'];
                            $prescriptionPrice = $obj['prescriptionPrice']; 
	                        $Remarks = $obj['Remarks'];
                            
                        ?>
                            <tr>
                                <td><?php echo $ID ?></td>
                                <td><?php echo $prescriptionName ?></td>
                                <td><?php echo $prescriptionDesc ?></td>
                                <td><?php echo $prescriptionQty ?></td>
                                <td><?php echo $prescriptionPrice ?></td>
                                <td><?php echo $Remarks ?></td>
                                <td><a class="btn btn-sm btn-secondary" href="editInv.php?GetID=<?php echo $ID ?>">Edit</a></td>                    
                                <td><a class="btn btn-sm btn-danger" href="deleteInv.php?Delete=<?php echo $ID ?>">Delete</a></td>
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
