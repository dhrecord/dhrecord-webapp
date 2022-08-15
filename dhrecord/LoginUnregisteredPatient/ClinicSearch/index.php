<?php
    //Database Connection
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
        // search highest rating clinics
        case "8":
          $case = '8';
          $result = $conn->query("SELECT businessOwner.*, AVG(surveyForm.rating) FROM businessOwner LEFT OUTER JOIN surveyForm ON businessOwner.nameOfClinic = surveyForm.nameClinic GROUP BY nameOfClinic ORDER BY AVG(surveyForm.rating) DESC");
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DHRecord</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jquery -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid container">
            <a class="navbar-brand" href="../ClinicSearch/index.php"><b>DHRecord</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../ClinicSearch/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../About/index.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../ContactUs/index.php">Contact Us</a>
                    </li>
                </ul>
                <div>
                    <button type="button" class="btn btn-light btn-sm" style="width: 90px; margin-right: 10px;"
                            onclick="window.location.href='../RegistrationPagePatient/index.php'">
                        Register
                    </button>
                    <button type="button" class="btn btn-light btn-sm" style="width: 90px;"
                            onclick="window.location.href='../LoginPage/index.html'">
                        Login
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- content -->
  <div class="container mt-5 mb-2">
    <div class="mb-4 d-flex justify-content-between">
      <h4>Find a Clinic</h4>
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

                          $stmtR = $conn->prepare("SELECT AVG(rating) as average FROM surveyForm WHERE nameClinic = ?");
                          $stmtR->bind_param("s", $fieldNOC);
                          $stmtR->execute();
                          $resultR = $stmtR->get_result();
                          $rating_no = '';
                          $row_R = $resultR->fetch_assoc();
                          $rating_no = $row_R['average']; 
    
                          if ($rating_no !== '' and $rating_no){
                            if (fmod($rating_no, 1)!== 0.00){
                              $rating_no = floor($rating_no);
                              for ($x = 0; $x < $rating_no; $x++) {
                                echo '<i class="fa-solid fa-star"></i>';
                              }
                              // half star
                              echo '<i class="fa-solid fa-star-half"></i>';
                            } else {
                              $rating_no = number_format($rating_no);
                              for ($x = 0; $x < $rating_no; $x++) {
                                echo '<i class="fa-solid fa-star"></i>';
                              }
                            }
                          } else {
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
                              <form method="POST" action="../../LoginUnregisteredPatient/LoginPage/index.html">
                              <button type="submit" name="doc_id" class="btn btn-dark">Book</button></form></td></tr>';
                      }
                    }

                    echo
                          '</table>              
                        </td>
                      </tr>
                      ';
                  }

                  mysqli_close($conn);
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

    <hr/>
  </div>

    <div class="container pb-4">
        <footer class="pt-1 mt-0 text-muted text-center">
            &copy; DHRecord 2021
        </footer>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
            integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
            integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
            crossorigin="anonymous"></script>

    <script src="./passDataToModal.js"></script>
</body>

</html>