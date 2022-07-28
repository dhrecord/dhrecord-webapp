<?php
  session_start();
  if(!isset($_SESSION['loggedin']))
  {
    header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    exit;
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
            
                  <div class="input-group mx-4" style="width:fit-content">
                      <input type="text" id="searchInput" class="form-control" placeholder="Enter Value ..."
                          aria-label="Name" aria-describedby="basic-addon2" style="max-width: 350px;" />
                      <button class="input-group-text" id="basic-addon2" onclick="tableSearch();">
                          <i class="fa-solid fa-magnifying-glass"></i>
                      </button>
                  </div>

                  <div class="mx-2"> 
                    <select class="form-select" id="auditLog_ddlFilterBy" aria-label="Filter By..."
                  style="">
                      <option selected disabled hidden>Filter By...</option>
                      <option value="1">Clinic Name</option>
                      <option value="2">Services</option>
                      <option value="3">Address</option>
                      <option value="4">Operating Hours (Day)</option>
                      <option value="5">Operating Hours (Time)</option>
                    </select>
                  </div>
              </div>

              <div class="d-flex align-items-center">
                  <div class="mx-4" style="width:fit-content">
                      <b>Quick Filter:</b>
                  </div>
                  <div class="mx-2"> 
                    <select class="form-select" id="auditLog_ddlFilterBy" aria-label="Filter By..."
                  style="">
                      <option selected disabled hidden>Filter By...</option>
                      <option value="1">Show Nearest Clinics</option>
                      <option value="2">Show Highest Rating Clinics</option>
                    </select>
                  </div>
              </div>
          </div>

          <div class="content-div my-4">
              <table class="table" id="clinicTable" data-filter-control="true" data-show-search-clear-button="true">
                  <tr class="bg-dark text-light">
                      <th class="px-4">Clinic Name</th>
                      <th class="px-4">Clinic Description</th>
                  </tr>

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

                      $sessionID = $_SESSION['id'];

                      // $stmt = $conn->prepare("SELECT * FROM businessOwner");
                      
                      // $stmt_result = $stmt->get_result();
                      // $data = $stmt_result->fetch_assoc();
                      // echo "hello"; 
                      $result = $conn->query("SELECT * FROM businessOwner");

                      while ($row = $result->fetch_assoc())
                      {
                        echo "hello";
                      //   '<tr style="background-color: #F2F2F2">
                      //     <td class="px-4">';

                      //   $field1 = $show['nameOfClinic'];
                      //   echo "$field1";

                      //   echo
                      //     '</td>
                      //     <td class="px-4">
                      //         <b>Address: </b>';
                              
                      //   $field2 = $show['locationOfClinic'];
                      //   echo "$field2"; 
                        
                      //   echo      
                      //         '<br/>
                      //         <br/>
                      //         <b>Operating Hours:</b><br/>
                      //         Monday-Friday: 9am–6pm<br/>
                      //         Saturday: 1pm-4pm<br/>
                      //         Sunday: Closed<br/><br/>
    
                      //         <b>Phone: </b>';
                              
                      //   $field3 = $show['contactNumber'];
                      //   echo "$field3"; 
                              
                      //   echo      
                      //         '<br/>
                      //         <b>Website: </b>ashforddentalcentre.com.sg<br/><br/>
    
                      //         <b>Doctors:</b><br>
                      //         <table class="table docs">
                      //           <tr>
                      //             <th class="px-4">Name</th>
                      //             <th class="px-4">Services</th>
                      //             <th class="px-4"></th>
                      //           </tr>
                      //           <tr>
                      //             <td class="px-4">Dr. Smith Rowe</td>
                      //             <td class="px-4">Oral Surgery, Dental Surgery</td>
                      //             <td class="px-4">
                      //               <button class="btn btn-dark" onclick="document.location.href=\'../../registeredpatient/html/bookAppt.php\'">Book</button>
                      //             </td>
                      //           </tr>
                      //           <tr>
                      //             <td class="px-4">Dr. Elizabeth</td>
                      //             <td class="px-4">Orthodontic</td>
                      //             <td class="px-4">
                      //               <button class="btn btn-dark" onclick="document.location.href=\'../../registeredpatient/html/bookAppt.php\'">Book</button>
                      //             </td>
                      //           </tr>
                      //         </table>              
                      //     </td>
                      //   </tr>
                      //   ';

                      //   // $field1 = $show['effectiveness'];
                      //   // $field2 = $show['Score'];
                      
                      //   // echo "$field1: ";
                      //   // echo "$field2%<br/><br/>";
                    }

                    mysqli_close($conn);
                  ?>

                  <tr style="background-color: #F2F2F2">
                      <td class="px-4">Ashford Dental Centre</td>
                      <td class="px-4">
                          <b>Address: </b>215 Upper Thomson Rd, Singapore 574349<br/>
                          <br/>
                          <b>Operating Hours:</b><br/>
                          Monday-Friday: 9am–6pm<br/>
                          Saturday: 1pm-4pm<br/>
                          Sunday: Closed<br/><br/>

                          <b>Phone: </b>6265 9146<br/>
                          <b>Website: </b>ashforddentalcentre.com.sg<br/><br/>

                          <b>Doctors:</b><br>
                          <table class="table docs">
                            <tr>
                              <th class="px-4">Name</th>
                              <th class="px-4">Services</th>
                              <th class="px-4"></th>
                            </tr>
                            <tr>
                              <td class="px-4">Dr. Smith Rowe</td>
                              <td class="px-4">Oral Surgery, Dental Surgery</td>
                              <td class="px-4">
                                <button class="btn btn-dark" onclick="document.location.href='../../registeredpatient/html/bookAppt.php'">Book</button>
                              </td>
                            </tr>
                            <tr>
                              <td class="px-4">Dr. Elizabeth</td>
                              <td class="px-4">Orthodontic</td>
                              <td class="px-4">
                                <button class="btn btn-dark" onclick="document.location.href='../../registeredpatient/html/bookAppt.php'">Book</button>
                              </td>
                            </tr>
                          </table>              
                      </td>
                  </tr>

                  <tr style="background-color: #F2F2F2">
                      <td class="px-4">Royce Dental Surgery - Woodlands</td>
                      <td class="px-4">
                          <b>Address: </b>Woodlands Ave 1, #01-821 Block 371, Singapore 730371<br>
                          <br>
                          <b>Operating Hours:</b><br>
                          Monday-Friday: 9am–6pm<br>
                          Saturday-Sunday: Closed<br><br>
                          <b>Phone: </b>6368 7467<br>
                          <b>Website: </b>roycedentalsurgery.com<br><br>
                          <b>Doctors:</b><br>
                          <table class="table docs">
                            <tr>
                              <th class="px-4">Name</th>
                              <th class="px-4">Services</th>
                              <th class="px-4"></th>
                            </tr>
                            <tr>
                              <td class="px-4">Dr. James</td>
                              <td class="px-4">Oral Surgery, Dental Surgery</td>
                              <td class="px-4"
                              ><button class="btn btn-dark" onclick="document.location.href='../../registeredpatient/html/bookAppt.php'">Book</button>
                            </td>
                            </tr>
                            <tr>
                              <td class="px-4">Dr. Moon</td>
                              <td class="px-4">Orthodontic</td>
                              <td class="px-4">
                                <button class="btn btn-dark" onclick="document.location.href='../../registeredpatient/html/bookAppt.php'">Book</button>
                            </td>
                            </tr>
                          </table>
                      </td>
                  </tr>
                  <tr style="background-color: #F2F2F2">
                      <td class="px-4">National Dental Centre Singapore</td>
                      <td class="px-4">
                          <b>Located in: </b>Singapore General Hospital<br>
                          <b>Address: </b>5 Second Hospital Ave, Singapore 168938<br>
                          <br>
                          <b>Operating Hours:</b><br>
                          Monday-Friday: 8:30am–5:30pm<br>
                          Saturday-Sunday: Closed<br><br>
                          <b>Phone: </b>6324 8802<br>
                          <b>Website: </b>nationaldentalcentre.com<br><br>
                          <b>Doctors:</b><br>
                          <table class="table docs">
                            <tr>
                              <th class="px-4">Name</th>
                              <th class="px-4">Services</th>
                              <th class="px-4"></th>
                            </tr>
                            <tr>
                              <td class="px-4">Dr. Dan</td>
                              <td class="px-4">Oral Surgery, Dental Surgery</td>
                              <td class="px-4">
                                <button class="btn btn-dark" onclick="document.location.href='../../registeredpatient/html/bookAppt.php'">Book</button>
                            </td>
                            </tr>
                            <tr>
                              <td class="px-4">Dr. Leslie</td>
                              <td class="px-4">Orthodontic</td>
                              <td class="px-4">
                                <button class="btn btn-dark" onclick="document.location.href='../../registeredpatient/html/bookAppt.php'">Book</button>
                            </td>
                            </tr>
                          </table>
                      </td>
                  </tr>
                  <tr style="background-color: #F2F2F2">
                    <td class="px-4">Expat Dental</td>
                    <td class="px-4">
                        <b>Located in: </b>E Medical Novena<br>
                        <b>Address: </b>10 Sinaran Drive Unit 08-15/16 Novena Medical Centre, 307506<br>
                        <br>
                        <b>Operating Hours:</b><br>
                        Monday-Friday: 9am-5pm<br>
                        Saturday-Sunday: Closed<br><br>
                        <b>Phone: </b>6397 6718<br>
                        <b>Website: </b>expatdental.com<br><br>
                        <b>Doctors:</b><br>
                        <table class="table docs">
                          <tr>
                            <th class="px-4">Name</th>
                            <th class="px-4">Services</th>
                            <th class="px-4"></th>
                          </tr>
                          <tr>
                            <td class="px-4">Dr. Robert</td>
                            <td class="px-4">Oral Surgery, Dental Surgery</td>
                            <td class="px-4">
                              <button class="btn btn-dark" onclick="document.location.href='../../registeredpatient/html/bookAppt.php'">Book</button>
                            </td>
                          </tr>
                          <tr>
                            <td class="px-4">Dr. Ben</td>
                            <td class="px-4">Orthodontic</td>
                            <td class="px-4">
                              <button class="btn btn-dark" onclick="document.location.href='../../registeredpatient/html/bookAppt.php'">Book</button>
                            </td>
                          </tr>
                        </table>
                    </td>
                  </tr>
              </table>
          </div>
      </div>
  </div>

  <script type="application/javascript">
    function tableSearch() {
        let input, filter, table, tr, td, txtValue;
        let tr2, tr3;

        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("clinicTable");
        tr = table.getElementsByTagName("tr");

        for (let i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];

            if (td) {
                txtValue = td.textContent || td.innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } 

                else {
                    tr[i].style.display = "none";
                }
            }

            tr2 = document.getElementsByClassName('docs');
            for (let k = 0; k < tr2.length; k++) {
              tr3 = tr2[k].getElementsByTagName("tr");
              for (let j = 0; j < tr3.length; j++) {
                tr3[j].style.display = "";
              }
            }
        }
    };
    </script>
</body>

</html>
