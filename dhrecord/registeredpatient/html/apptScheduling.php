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

  $searchErr = '';
  $result = '';
  $search = '';
  $select = '';
  $case = '';

  // SEARCH CLINIC + FILTER
  if(isset($_POST['save'])){
    if(!empty($_POST['search'] and !empty($_POST['select']))){
      $search = $_POST['search'];      
      $select = $_POST['select'];
      $stmt = '';

      switch ($select) {
        // search by clinic name
        case "1":
            $case = '1';
            $search = "%$search%"; // prepare the $search variable
            $stmt = $conn->prepare("SELECT * FROM businessOwner WHERE nameOfClinic LIKE ?");
            $stmt->bind_param("s", $search);
            $stmt->execute();
            $result = $stmt->get_result();
            break;
        // search by specializations/sevices
        case "2":
            $case = '2';
            $search = "%$search%";
            $stmt = $conn->prepare("SELECT * FROM businessOwner WHERE ID IN 
                                          (SELECT DISTINCT businessOwner.ID FROM doctorSpecialization
                                            JOIN clinicSpecialization ON clinicSpecialization.ID = doctorSpecialization.specializationID
                                            JOIN doctor ON doctor.doctorID = doctorSpecialization.doctorID
                                            JOIN businessOwner ON businessOwner.ID = doctor.clinicID
                                            WHERE clinicSpecialization.specName LIKE ?)");
            $stmt->bind_param("s", $search);
            $stmt->execute();
            $result = $stmt->get_result();
            break;
        // search by clinic address
        case "3":
            $case = '3';
            $search = "%$search%";
            $stmt = $conn->prepare("SELECT * FROM businessOwner WHERE locationOfClinic LIKE ?");
            $stmt->bind_param("s", $search);
            $stmt->execute();
            $result = $stmt->get_result();
            break;
        // search by postal code
        case "4":
            $case = '4';
            $search = "%$search%"; 
            $stmt = $conn->prepare("SELECT * FROM businessOwner WHERE postalCode LIKE ?");
            $stmt->bind_param("s", $search);
            $stmt->execute();
            $result = $stmt->get_result();
            break;
        // search by operating hours -> day
        case "5":
            $case = '5';
            $search = "%$search%"; 
            $stmt = $conn->prepare("SELECT * FROM businessOwner WHERE ID IN 
                                      (SELECT DISTINCT businessOwner.ID FROM businessOwner 
                                        JOIN doctor ON businessOwner.ID = doctor.clinicID
                                        JOIN operatingHours ON operatingHours.doctorID = doctor.doctorID
                                        WHERE operatingHours.day LIKE ? and operatingHours.start_time != \"00:00:00\")");
            $stmt->bind_param("s", $search);
            $stmt->execute();
            $result = $stmt->get_result();
            break;
        // search by operating hours -> time
        case "6":
          $case = '6';
          $stmt = $conn->prepare("SELECT * FROM businessOwner WHERE ID IN 
                                      (SELECT DISTINCT businessOwner.ID FROM businessOwner 
                                        JOIN doctor ON businessOwner.ID = doctor.clinicID
                                        JOIN operatingHours ON operatingHours.doctorID = doctor.doctorID
                                        WHERE operatingHours.start_time <= time(?) and operatingHours.end_time > time(?))");
          $stmt->bind_param("ss", $search, $search);
          $stmt->execute();
          $result = $stmt->get_result();
          break;
        default:
            break;
      }
    }
    else{
      $result = $conn->query("SELECT * FROM businessOwner");
      $searchErr = "Please enter the information";
    }
  } 
  // QUICK FILTER
  else if(isset($_POST['save2'])){
    if(!empty($_POST['select2'])){    
      $select = $_POST['select2'];
      $stmt = '';

      switch ($select) {
        // search nearest clinics
        case "7":
          $case = '7';

          // $stmt = $conn->prepare("SELECT address FROM registeredPatient WHERE users_ID = ?");
          // $stmt->bind_param("s", $_SESSION['id']);
          // $stmt->execute();
          // $result_address = $stmt->get_result();
          // $user_address = '';

          // while ($row_address = $result_address->fetch_assoc()){
          //   $user_address = $row_address['address'];
          // }

          break;
        // search highest rating clinics
        case "8":
          $case = '8';
          $result = $conn->query("SELECT * FROM businessOwner ORDER BY rating DESC");
          break;
        default:
          break;
      }
    }
  }
  // FETCH ALL 
  else {
    $result = $conn->query("SELECT * FROM businessOwner");
  }
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">


  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

  <!-- Style -->
  <link rel="stylesheet" href="../../apptScheduling/css/style.css">

  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>DHRecord</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid container">
      <a class="navbar-brand" href="../html/index.php"><b>DHRecord</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../html/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../html/apptScheduling.php">Appointment Scheduling &
              Reminder</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../html/referralTracking.php">Referral Tracking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../html/surveyAndFeedback.php">Survey & Feedback</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../html/treatmentHistory.php">Treatment History</a>
          </li>
        </ul>
        <div class="d-flex flex-column align-items-end">
          <p class="navbar-text text-white m-0">
            Welcome, <?php echo $_SESSION['username']; ?>
          </p>
          <button type="button" class="btn btn-light ml-3 btn-sm mb-2" style="width: 90px;"
            onclick="document.location.href='../../LoginUnregisteredPatient/LoginPage/logout.php'">Logout</button>
        </div>
      </div>
    </div>
  </nav>

  <!-- content -->
  <div class="container my-5">
    <div class="mb-5 d-flex justify-content-between">
      <h4>Appointment Scheduling and Reminders</h4>
      <button class="btn btn-dark"  onclick="document.location.href='../../registeredpatient/html/mySchedule.php'">My Appointment</button>
    </div>

    <div class="container my-5 custom-container">
        <div class="mb-5 d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <div><p class="m-0"><b>Search Clinic:</b></p></div>

                <form action="#" method="post" class="d-flex">
                  <div class="input-group mx-4" style="width:fit-content">
                    <input type="text" id="searchInput" class="form-control" name="search" placeholder="Enter Value ..."
                    aria-label="search" aria-describedby="basic-addon2" style="max-width: 350px;" required/>
                    <button id="basic-addon2" type="submit" name="save" class="input-group-text">
                      <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                  </div>

                    <div class="mx-2"> 
                      <select required name="select" class="form-select" id="auditLog_ddlFilterBy" aria-label="Filter By..."
                    style="" data-bs-toggle="tooltip" data-bs-placement="top" title="Time Format E.g. 16:00 ">
                        <option value="" selected disabled hidden>Category ...</option>
                        <option value="1">Clinic Name</option>
                        <option value="2">Services</option>
                        <option value="3">Address</option>
                        <option value="4">Postal Code</option>
                        <option value="5">Operating Hours (Day)</option>
                        <option value="6">Operating Hours (Time)</option>
                      </select>
                  </div>
                </form>
            </div>

            <div class="d-flex align-items-center">
                <div class="mx-4" style="width:fit-content">
                    <b>Sort By:</b>
                </div>

                <form action="#" method="post" class="d-flex align-items-center">
                  <div class="mx-2"> 
                    <select required name="select2" class="form-select" id="auditLog_ddlFilterBy2" aria-label="Filter By..."
                  style="">
                      <option selected disabled hidden>Category ...</option>
                      <option value="7">Show Nearest Clinics</option>
                      <option value="8">Show Highest Rating Clinics</option>
                    </select>
                  </div>
                  <div class="">
                      <button id="basic-addon3" type="submit" name="save2" class="input-group-text h-100">
                        <i class="fa-solid fa-magnifying-glass py-1"></i>
                      </button>
                  </div>
                </form>
            </div>
        </div>

        <div class="content-div my-4">
            <table class="table" id="clinicTable" data-filter-control="true" data-show-search-clear-button="true">
                <tr class="bg-dark text-light">
                    <th class="px-4">Clinic Name</th>
                    <th class="px-4">Clinic Description</th>
                </tr>

                <!-- SHOWING CLINICS -->
                <?php
                  if ($result !== ''){
                    while ($row = $result->fetch_assoc()){
                      echo '<tr style="background-color: #F2F2F2">
                        <td class="px-4"><b>';
  
                      $fieldNOC = $row['nameOfClinic'];
                      echo $fieldNOC;
  
                      echo
                        '</b></td>
                        <td class="px-4">
                            <b>Address: </b>';
                            
                      $fieldLOC = $row['locationOfClinic'];
                      if($fieldLOC){
                        echo $fieldLOC;
                      } else {
                        echo '-';
                      }
  
                      echo '<br/><b>Postal Code: </b>';
  
                      $fieldPC = $row['postalCode'];
                      if($fieldPC){
                        echo $fieldPC;
                      } else {
                        echo '-';
                      }
  
                      echo
                          '<br/><b>Phone: </b>';
                            
                      $field3 = $row['contactNumber'];
                      if($field3){
                        echo $field3;
                      } else {
                        echo '-';
                      }
                            
                      echo      
                            '<br/>
                            <b>Website: </b>';
  
                      $field4 = $row['website'];
                      if ($field4){
                        echo $field4; 
                      } else{
                        echo '-';
                      }
  
                      echo      
                            '<br/>
                            <b>Rating: </b>';
  
                      $field5 = $row['rating'];
                      if ($field5){
                        $field5 = number_format($field5);
                        for ($x = 0; $x < $field5; $x++) {
                          echo '<i class="fa-solid fa-star"></i>';
                        }
                      } else{
                        echo '-';
                      }
                      
                      echo
                            '<br/><br/>
  
                            <b>Doctors:</b><br>
                            <table class="table docs">
                              <tr>
                                <th class="px-4">Name</th>
                                <th class="px-4">Services</th>
                                <th class="px-4 text-center">Operating Hours</th>
                                <th class="px-4"></th>
                              </tr>';
                      
                      // GET THE LIST OF DOCTORS IN THE CLINIC
                      $stmtDoc = "";
  
                      if($case == '2') {
                        $stmtDoc = $conn->prepare("SELECT DISTINCT doctorID, fullName 
                                                    FROM doctor
                                                    WHERE clinicID = ? AND doctorID IN
                                                      (SELECT doctor.doctorID FROM doctor
                                                        JOIN doctorSpecialization ON doctor.doctorID = doctorSpecialization.doctorID
                                                        JOIN clinicSpecialization ON clinicSpecialization.ID = doctorSpecialization.specializationID
                                                        WHERE clinicSpecialization.specName LIKE ?)");
                        $stmtDoc->bind_param("ss", $row['ID'], $search);
                      } else if($case == '5') {
                        $stmtDoc = $conn->prepare("SELECT DISTINCT doctorID, fullName 
                                                    FROM doctor
                                                    WHERE clinicID = ? AND doctorID IN
                                                      (SELECT DISTINCT doctor.doctorID FROM doctor 
                                                        JOIN operatingHours ON operatingHours.doctorID = doctor.doctorID
                                                        WHERE operatingHours.day LIKE ? and operatingHours.start_time != \"00:00:00\")");
                        $stmtDoc->bind_param("ss", $row['ID'], $search);  
                      } else if($case == '6') {
                        $stmtDoc = $conn->prepare("SELECT DISTINCT doctorID, fullName 
                                                    FROM doctor
                                                    WHERE clinicID = ? AND doctorID IN
                                                      (SELECT DISTINCT doctor.doctorID FROM doctor 
                                                        JOIN operatingHours ON operatingHours.doctorID = doctor.doctorID
                                                        WHERE operatingHours.start_time <= time(?) and operatingHours.end_time > time(?))");
                        $stmtDoc->bind_param("sss", $row['ID'], $search, $search);  
                      } else {
                        $stmtDoc = $conn->prepare("SELECT DISTINCT doctorID, fullName 
                                                    FROM doctor
                                                    WHERE clinicID = ?");
                        $stmtDoc->bind_param("s", $row['ID']);
                      }
             
                      $stmtDoc->execute();
                      $resultDoc = $stmtDoc->get_result();
  
                      if ($resultDoc->num_rows === 0) {
                        echo '<tr><td class="px-4">-</td><td class="px-4">-</td><td class="text-center">-</td><td></td></tr>';
                      } else {
                        while ($rowDoc = $resultDoc->fetch_assoc()){
                          echo
                              '<tr>
                                <td class="px-4">';
  
                          echo $rowDoc['fullName'];
                            
                          echo
                                '</td>
                                <td class="px-4">';
                          
                          // GET LIST OF SPECIALIZATIONS OF THE DOCTOR
                          $stmtSpec = $conn->prepare("SELECT clinicSpecialization.specName 
                                                    FROM doctorSpecialization
                                                    JOIN clinicSpecialization 
                                                    ON clinicSpecialization.ID = doctorSpecialization.specializationID 
                                                    WHERE doctorSpecialization.doctorID=?");
                          $stmtSpec->bind_param("s", $rowDoc['doctorID']);
                          $stmtSpec->execute();
                          $resultSpec = $stmtSpec->get_result();
  
                          $specializations = array();
  
                          if ($resultSpec->num_rows === 0) {
                            $join_specializations = '-';
                            echo '-';
                          } else { 
                            while ($rowSpec = $resultSpec->fetch_assoc()){
                              array_push($specializations, $rowSpec["specName"]);
                            }
  
                            $join_specializations = implode(', ', $specializations);
                            echo $join_specializations;
                          }
  
                          echo '</td><td class="px-4 text-center">';
                          echo '<button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#popupModal" onclick="passData(\'';
  
                          echo $rowDoc['fullName'];
                          echo '\',\'';
                          echo $join_specializations;
                          echo '\',\'';
  
                          // GET THE OPERATING HOURS OF EACH DOcTOR
                          $stmtOH = $conn->prepare("SELECT day, start_time, end_time 
                                                    FROM operatingHours 
                                                    WHERE operatingHours.doctorID = ?");
                          $stmtOH->bind_param("s", $rowDoc['doctorID']);
                          $stmtOH->execute();
                          $resultOH = $stmtOH->get_result();
  
                          if ($resultOH->num_rows === 0) {
                            echo '-';
                          } else { 
                            while ($rowOH = $resultOH->fetch_assoc()){
                              if ($rowOH['start_time'] === "00:00:00" and $rowOH['end_time'] === "00:00:00"){
                                echo '(';
                                echo $rowOH['day'];
                                echo ': Closed)';
                              } else {
                                echo '(';
                                echo $rowOH['day'];
                                echo ': ';
                                $start_time = $rowOH['start_time']; 
                                echo substr($start_time, 0, 5);
                                echo '-';
                                $end_time = $rowOH['end_time']; 
                                echo substr($end_time, 0, 5);
                                echo ')';
                              }
                              echo ', ';
                            }
                          }
  
                          echo '\');">View</button>';
                          
                          echo
                              '</td><td class="px-4">
                                <form method="POST" action="../../registeredpatient/html/bookAppt.php">
                                <button type="submit" name="doc_id" value="';
  
                          echo $rowDoc['doctorID'];
                                  
                          echo       
                              '" class="btn btn-dark">Book</button></form></td></tr>';
                        }
                      }
  
                      echo
                            '</table>              
                          </td>
                        </tr>
                        ';
                    }
                  }
                ?>
            </table>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="popupModalLabel">Information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p><b>Doctor Name:</b><br/><span id="d_name"></span>
                <br/><br/>
                <b>Services:</b><br/><span id="spec_list"></span>
                <br/><br/>
                <b>Operating Hours:</b><br/><span id="o_hours"></span>
                </p>
              </div>
          </div>
      </div>
    </div>

  </div>

  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

  <script src="../js/passDataToModal.js"></script>
</body>

</html>
