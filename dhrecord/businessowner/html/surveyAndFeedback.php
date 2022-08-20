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

<body onload="findData();">
    <?php
    include 'navBar.php';
?>

<div class="container my-5">
        <h4 class="mb-5">Survey and Feedback</h4>
	    <div class="mb-4 d-flex align-items-center">
		    <div class="d-flex align-items-center">
			<p class="m-0"><b>Search:</b>&nbsp;&nbsp;&nbsp;</p>
			<div class="input-group">
			    <input type="text" id="searchbar_filter" class="form-control" placeholder="Enter Value ..." pattern="[a-zA-Z0-9]"
				aria-label="Name" aria-describedby="basic-addon2" style="max-width: 300px;" />
			</div>
		    </div>
            <select class="form-select" id="survey_ddlfilter" aria-label="Filter By..."
                style="margin-left: 70px; max-width: 250px;">
                <option selected disabled hidden>Filter By...</option>
                <option value="0">Patient Name</option>
                <option value="1">Time Taken</option>
                <option value="2">Ratings</option>
                <option value="3">Recommendation</option>
                <option value="4">Remarks</option>
	    	        <option value="5">Name of Doctor</option>
            </select>
        </div>
        <div style="overflow-x:auto;">
	<table class="table table-striped">
		<thead>
        		<tr>
				<th>Patient Name</th>
        			<th>Time Taken</th>
			        <th>Ratings</th>
			        <th>Recomendations</th>
			        <th>Remarks</th>
				<th>Name of Clinic</th>
			        <th>Name of Doctor</th>
        		</tr>
		</thead>
		
		<tbody id="data">
                 <?php                          
                    //Database Connection
                    $servername = "localhost";
                    $database = "u922342007_Test";
                    $username = "u922342007_admin";
                    $password = "Aylm@012";
        
                    // Create connection
                    $conn = mysqli_connect($servername, $username, $password, $database);
		    $role = $_SESSION['role'];
		    
		    if ($role=="ca")
		    {
			    $res = ("SELECT registeredPatient.fullName, surveyForm.timeTaken, surveyForm.rating, surveyForm.recommendation, surveyForm.remarks, 
		    	    surveyForm.nameClinic, surveyForm.nameDoc FROM clinicAdmin, businessOwner, surveyForm, users, registeredPatient
		            WHERE clinicAdmin.clinicID = businessOwner.ID AND businessOwner.nameOfClinic = surveyForm.nameClinic
			    AND surveyForm.username =  users.username AND users.ID = registeredPatient.users_ID AND clinicAdmin.userID = '{$_SESSION['id']}'");
		    }
		    else
		    {
			    $res = ("SELECT registeredPatient.fullName, surveyForm.timeTaken, surveyForm.rating, surveyForm.recommendation, surveyForm.remarks,
			    surveyForm.nameClinic, surveyForm.nameDoc FROM frontDesk, businessOwner, surveyForm, users, registeredPatient
			    WHERE frontDesk.clinicID = businessOwner.ID AND businessOwner.nameOfClinic = surveyForm.nameClinic
			    AND surveyForm.username =  users.username AND users.ID = registeredPatient.users_ID AND frontDesk.userID = '{$_SESSION['id']}'");
		    }

	            $result = mysqli_query($conn, $res);

                    while($sql = mysqli_fetch_assoc($result)){
                              echo "<tr><td>".$sql["fullName"]."</td><td>".$sql["timeTaken"]."</td><td>".$sql["rating"]."</td><td>".$sql["recommendation"].
                                "</td><td>".$sql["remarks"]."</td><td>".$sql["nameClinic"]."</td><td>".$sql["nameDoc"]."</td></tr>";
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
	<script src="../js/surveyfilter.js"></script>


</body>

</html>
