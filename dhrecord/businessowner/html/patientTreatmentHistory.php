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

<body>
    <?php
    include 'navBar.php';
?>


    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-4">Treatment History</h4>
        <div class="mb-4 d-flex align-items-center">
            <div class="d-flex align-items-center">
			<form class="form-inline" method="POST" action="">
				<label>Date:</label>
				<input type="date" class="form-control" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>"/>
				<label>To</label>
				<input type="date" class="form-control" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
				<button class="btn btn-primary mt-3" name="search"><span class="glyphicon glyphicon-search">Search</span></button>
			</form>
		<br/><br/><br/>
            </div>
        </div>
		<div style="overflow-x:auto;">
        <table class="table table-striped">
			<tr>
				<th>Patient's Name</th>
				<th>Date</th>
				<th>Attending Doctor</th>
				<th>Tooth Condition</th>
				<th>Diagnosis</th>
				<th>Medication Prescribed</th>
				<th>Quantity</th>
				<th>Comments</th>
			</tr>    		
			
			 <?php                           
			//Database Connection
			$servername = "localhost";
			$database = "u922342007_Test";
			$username = "u922342007_admin";
			$password = "Aylm@012";
        
			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $database);

			       
			if(ISSET($_POST['search']))
			{
				$date1 = date("Y-m-d", strtotime($_POST['date1']));
				$date2 = date("Y-m-d", strtotime($_POST['date2']));
				
                		$query = mysqli_query($conn, "SELECT registeredPatient.fullName AS ptName, treatmentHistory.date, doctor.fullName AS docName, 
				treatmentHistory.toothCondition, treatmentHistory.diagnosis, treatmentHistory.medicationPrescribed, treatmentHistory.quantity,
				treatmentHistory.comments FROM treatmentHistory, registeredPatient, doctor WHERE treatmentHistory.attendingDoctor = doctor.doctorID 
				AND treatmentHistory.pt_ID = registeredPatient.ID AND registeredPatient.ID =  '{$_GET['pat_id']}' 
				AND date(treatmentHistory.date) BETWEEN '$date1' AND '$date2'") or die(mysqli_error());
				
				$row=mysqli_num_rows($query);
				if($row>0)
				{
					while($fetch=mysqli_fetch_array($query))
					{
				?>
					<tr>
						<td><?php echo $fetch['ptName']?></td>
						<td><?php echo $fetch['date']?></td>
						<td><?php echo $fetch['docName']?></td>
						<td><?php echo $fetch['toothCondition']?></td>
						<td><?php echo $fetch['diagnosis']?></td>
						<td><?php echo $fetch['medicationPrescribed']?></td>
						<td><?php echo $fetch['quantity']?></td>
						<td><?php echo $fetch['comments']?></td>
                        
					</tr>
				<?php
					}
				}else
				{
					echo
					'<tr>
						<td colspan = "8"><center>Record Not Found</center></td>
					</tr>';
				}
			} else
			{
                		$query=mysqli_query($conn, "SELECT registeredPatient.fullName AS ptName, treatmentHistory.date, doctor.fullName AS docName, 
				treatmentHistory.toothCondition, treatmentHistory.diagnosis, treatmentHistory.medicationPrescribed, treatmentHistory.quantity,
				treatmentHistory.comments FROM treatmentHistory, registeredPatient, doctor WHERE treatmentHistory.attendingDoctor = doctor.doctorID 
				AND treatmentHistory.pt_ID = registeredPatient.ID AND registeredPatient.ID =  '{$_GET['pat_id']}' ") or die(mysqli_error());

				while($fetch=mysqli_fetch_array($query))
				{
			?>
			<tr>
                		<td><?php echo $fetch['ptName']?></td>
				<td><?php echo $fetch['date']?></td>
				<td><?php echo $fetch['docName']?></td>
				<td><?php echo $fetch['toothCondition']?></td>
				<td><?php echo $fetch['diagnosis']?></td>
				<td><?php echo $fetch['medicationPrescribed']?></td>
				<td><?php echo $fetch['quantity']?></td>
				<td><?php echo $fetch['comments']?></td>
			</tr>
			<?php
				}
			}
			?>
						    
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
