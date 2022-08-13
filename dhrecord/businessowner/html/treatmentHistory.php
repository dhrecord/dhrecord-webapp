<?php
	session_start();
	if(!isset($_SESSION['loggedin']))
	{
		header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
		exit;
	}

	// Database Connection
	$servername = "localhost";
	$database = "u922342007_Test";
	$username = "u922342007_admin";
	$password = "Aylm@012";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

	if (!$conn) 
	{
	die("Connection failed: " . mysqli_connect_error());
	}

	$result = '';
	$search = '';

	// SEARCH PATIENT
	if(isset($_POST['save'])){
		if(!empty($_POST['search'])){
			$search = $_POST['search'];
			$search = "%$search%";
            $stmt = $conn->prepare("SELECT * FROM registeredPatient WHERE fullName LIKE ?");
            $stmt->bind_param("s", $search);
            $stmt->execute();
            $result = $stmt->get_result();
		}
		else{
			$result = $conn->query("SELECT * FROM registeredPatient");
		}
	} else {
		$result = $conn->query("SELECT * FROM registeredPatient");
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
        <h4 class="mb-5">Treatment History</h4>

		<div class="d-flex align-items-center">
			<div><p class="m-0"><b>Search Patient:</b></p></div>

			<form action="#" method="post" class="d-flex">
				<div class="input-group mx-4" style="width:fit-content">
				<input type="text" id="searchInput" class="form-control" name="search" placeholder="Enter Value ..."
				aria-label="search" aria-describedby="basic-addon2" style="max-width: 350px;" required/>
				<button id="basic-addon2" type="submit" name="save" class="input-group-text">
					<i class="fa-solid fa-magnifying-glass"></i>
				</button>
				</div>
			</form>
		</div>

		<div class="content-div my-4">
            <table class="table" id="patientTable" data-filter-control="true" data-show-search-clear-button="true">
                <tr class="bg-dark text-light">
					<th class="px-4">Patient ID</th>
                    <th class="px-4">Patient's Name</th>
                    <th class="px-4">NRIC</th>
					<th class="px-4">Contact No.</th>
					<th class="px-4">Email</th>
					<th class="px-4 text-center">Treatment History</th>
                </tr>

                <!-- SHOWING CLINICS -->
				<?php 
					if ($result->num_rows > 0) { 
						while ($row = $result->fetch_assoc()){
				?>
				
				<tr>
					<td class="px-4"><?=$row['ID']?></td>
                    <td class="px-4"><?=$row['fullName']?></td>
                    <td class="px-4"><?=$row['nricNumber']?></td>
					<td class="px-4"><?=$row['contactNumber']?></td>
					<td class="px-4"><?=$row['email']?></td>
					<td class="px-4 text-center">
						<form method="POST" action="../../businessowner/html/patientTreatmentHistory.php">
							<button type="submit" name="pat_id" value="<?=$row['ID']?>" class="btn btn-dark">View</button>
						</form>
					</td>
                </tr>

				<?php }} 
		    			$id = $_POST['id'];
		    			echo $id;
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
