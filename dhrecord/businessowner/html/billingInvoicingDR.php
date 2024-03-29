<?php
  session_start();
  if(!isset($_SESSION['loggedin']))
  {
    header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    exit;
  }
  
  //$userID = $_SESSION['ID'];
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
                    
                
                    <!-- </form> -->
                </div>
            </div>
            

        </div>

        
        <div style="overflow-x:auto;">
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
                $ID1 = array();
                $ids = "0";
                $i = 0;
                $ID2 = array();
                $ids1 = "0";
                $i1 = 0;
                //$cID;
                $userID = $_SESSION['id'];
                    //echo $userID;
                    //$doctorRes = "SELECT * FROM doctor WHERE username = $userID";   
                    $doctorRes = "SELECT * FROM doctor WHERE userID = $userID";
                    //$doctorRes = mysqli_query($conn,"SELECT * FROM doctor WHERE `userID` = $userID");
                    
                    //echo $doctorRes;
                    if ($dRes = $conn->query($doctorRes))
                        while($Result1 = $dRes->fetch_assoc())
                            {
                                $clinicID = $Result1["clinicID"];
                                
                            }
                            
                         //echo $clinicID;   
                
                if(isset($_POST['search']))
                    {
                        $searchkey= $_POST['search'];
                        //$res = mysqli_query($conn, "SELECT * FROM `inventoryManagement` WHERE prescriptionName LIKE '%$searchkey%'");
                            //test 3
                        $doctorID = mysqli_query($conn,"SELECT * from doctor WHERE clinicID = $clinicID");
                   while($result = mysqli_fetch_assoc($doctorID))
                        {
                            $ID2[$i] = strval($result['doctorID']);
                            $idss1= strval($result['doctorID']);
                            $ids1 =  $ids1 . ',' .  $idss1;
                            $i1 = $i1 + 1;
                            //echo $ID1;
                        }

                        $idarray1 = array_map('intval',explode(',',$ids1));
                        $idarray1 = implode("','",$idarray1);

                    //$res10 = "SELECT * FROM treatmentHistory WHERE attendingDoctor in ('".$idarray."')";    
                        
                            
                        $ptResult = mysqli_query($conn,"SELECT * FROM registeredPatient WHERE fullName LIKE '%$searchkey%'");
                        while($result = mysqli_fetch_assoc($ptResult))
                        {
                            $ID1[$i] = strval($result['ID']);
                            $idss= strval($result['ID']);
                            $ids =  $ids . ',' .  $idss;
                            $i = $i + 1;
                            //echo $ID1;
                        }
                        //echo $ids;
                        // print_r($ID1);
                        $idarray = array_map('intval',explode(',',$ids));
                        $idarray = implode("','",$idarray);
                        $res = "SELECT * FROM treatmentHistory WHERE pt_ID in ('".$idarray."') AND attendingDoctor in ('".$idarray1."')";    
                        //echo $res;
                        //$res = mysqli_query($conn, "SELECT * FROM treatmentHistory WHERE pt_ID = $ID1'");
                    }

                 
                    //$res = mysqli_query($conn, "select * from `treatmentHistory`");
                    //$res = mysqli_query($conn,"SELECT treatmentHistory.ID,treatmentHistory.date,doctor.fullName//,treatmentHistory.pt_ID,treatmentHistory.toothCondition,treatmentHistory.diagnosis//,treatmentHistory.medicationPrescribed,treatmentHistory.quantity,treatmentHistory.comments  //FROM treatmentHistory, doctor WHERE treatmentHistory.attendingDoctor =  doctor.doctorID");
                    
                    //$res = "SELECT *  FROM treatmentHistory INNER JOIN doctor ON treatmentHistory.attendingDoctor =  doctor.doctorID";
                     else {
                    
                    //$userRes = "SELECT * FROM doctor WHERE userID = $userID";                    
                    //if ($dRes = $conn->query($doctorRes))
                   //     while($R = $dRes->fetch_assoc())
                    //        {
                    //            $cID = $R['clinicID'];
                    //            echo $cID;
                    //        }
                    
                    
                           
                            
                    $doctorID = mysqli_query($conn,"SELECT * from doctor WHERE clinicID = $clinicID");
                   while($result = mysqli_fetch_assoc($doctorID))
                        {
                            $ID1[$i] = strval($result['doctorID']);
                            $idss= strval($result['doctorID']);
                            $ids =  $ids . ',' .  $idss;
                            $i = $i + 1;
                            //echo $ID1;
                        }

                        $idarray = array_map('intval',explode(',',$ids));
                        $idarray = implode("','",$idarray);

                    $res = "SELECT * FROM treatmentHistory WHERE attendingDoctor in ('".$idarray."')";
                }
                //else
                    //$res = "SELECT * FROM treatmentHistory";
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
                            
                            $ID = $obj['ID'];
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
                                <td><a class="btn btn-sm btn-secondary" href="generateBillPDF.php?GetID=<?php echo $ID ?>">Generate</a></td> 
                            </tr>
                        <?php
                        
                        
                        }                       
                        
                            
                ?>
            </tbody>
        </table>

        </div>
        
    </div>


    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    <script src="../js/index.js"></script>
</body>

</html>
