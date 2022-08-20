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
    <link rel="stylesheet" href="../css/apptSched.css" />

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

<body onload="findData();">
    <?php
    include 'navBar.php';
?>


    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-5">Referral Tracking</h4>

        <div class="mb-4 search-div">
            <div class="search-input-div">
                <p class="m-0"><b>Search:</b>&nbsp;&nbsp;&nbsp;</p>
                <div class="input-group">
                    <input type="text" id="searchbar_filter" class="form-control" placeholder="Enter Value ..."
                        aria-label="Name" aria-describedby="basic-addon2" style="max-width: 300px;" pattern="[a-zA-Z0-9]"/>
                </div>
            </div>
            <select class="form-select" id="referralTracking_ddlfilter" aria-label="Filter By..."
                style="max-width: 250px;">
                <option selected disabled hidden>Filter By...</option>
                <option value="1">Patient Name</option>
                <option value="2">Referred To</option>
                <option value="3">Referral Date</option>
                <option value="4">Referring Doctor</option>
                <option value="5">Tooth Condition</option>
		        <option value="6">Comments</option>
            </select>
        </div>

        <div style="overflow-x:auto;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Patient Name</th>
                    <th scope="col">Referred To</th>
                    <th scope="col">Referral Date</th>
                    <th scope="col">Referring Doctor</th>
                    <th scope="col">Tooth Condition</th>
		    <th scope="col">Comments</th>
                </tr>
            </thead>

            <tbody id="data">
                <?php
                    $servername = "localhost";
                    $database = "u922342007_Test";
                    $username = "u922342007_admin";
                    $password = "Aylm@012";
        
                    // Create connection
                    $conn = mysqli_connect($servername, $username, $password, $database);
                
                    $res = ("SELECT referralTracking.ID, registeredPatient.fullName AS ptName, referralTracking.referredTo, referralTracking.referralDate, 
                    doctor.fullName AS docName, referralTracking.toothCondition, referralTracking.comments FROM referralTracking, registeredPatient, doctor
                    WHERE referralTracking.patient_ID = registeredPatient.ID AND referralTracking.referringDoctor = doctor.doctorID 
		    ORDER BY referralTracking.ID ASC");

                    $result = mysqli_query($conn, $res);

                    while($sql = mysqli_fetch_assoc($result)){
                              echo "<tr><td>".$sql["ID"]."</td><td>".$sql["ptName"]."</td><td>".$sql["referredTo"]."</td><td>".$sql["referralDate"]."</td><td>".
                                  $sql["docName"]."</td><td>".$sql["toothCondition"]."</td><td>".$sql["comments"]."</td></tr>";
                            }
               ?>
            </tbody>
        </table></div>
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="../js/index.js"></script>
	<script src="../js/filter.js"></script>
</body>

</html>
