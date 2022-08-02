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
  <!-- <link rel="stylesheet" href="../../apptScheduling/css/style.css"> -->
  <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    
  <!-- jquery -->
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <title>DHRecord</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid container">
      <a class="navbar-brand" href="./index.php"><b>DHRecord</b></a>
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
    <div class="mb-4 d-flex justify-content-between">
      <h4>Book An Appointment</h4>
    </div>

    <div class="p-5" style="background: #F2F2F2;">
      <div class="d-flex">
        <div>
            <p class="m-0"><b>Doctor: </b>
              <?php
                // echo $_POST['doc_id'];
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

                // GET THE DOCTOR'S FULLNAME
                $stmtDocName = $conn->prepare("SELECT DISTINCT doctor.fullName
                                              FROM doctor
                                              WHERE doctor.doctorID=?");
                $stmtDocName->bind_param("s", $_POST['doc_id']);
                $stmtDocName->execute();
                $resultDocName = $stmtDocName->get_result();

                while ($rowDocName = $resultDocName->fetch_assoc()){
                  echo $rowDocName['fullName'];
                }
              ?>
            </p>
            <p class="m-0"><b>Specialization: </b>
                <?php
                //  // GET THE DOCTOR'S SPECIALIZATION
                //  $stmtSpec = $conn->prepare("SELECT clinicSpecialization.specName 
                //                               FROM doctorSpecialization
                //                               JOIN clinicSpecialization 
                //                               ON clinicSpecialization.ID = doctorSpecialization.specializationID 
                //                               WHERE doctorSpecialization.doctorID=?");
                //   $stmtSpec->bind_param("s", $_POST['doc_id']);
                //   $stmtSpec->execute();
                //   $resultSpec = $stmtSpec->get_result();

                //   $specializations = array();
                //   while ($rowSpec = $resultSpec->fetch_assoc()){
                //     array_push($specializations, $rowSpec["specName"]);
                //   }

                //   $join_specializations = implode(', ', $specializations);
                //   echo $join_specializations;
                // ?>
            </p>

            <br/>

            <p class="m-0"><b>Clinic:</b> Ashford Dental Centre</p>
            <p class="m-0"><b>Address: </b>215 Upper Thomson Rd, Singapore 574349<br/></p>

            <br>

            <p class="m-0"> 
                <b>Operating Hours:</b><br/>
                Monday-Friday: 9am–6pm<br/>
                Saturday: 1pm-4pm<br/>
                Sunday: Closed<br/><br/>
            </p>
        </div>

        <div class="mx-5">
            <div>
                <p><b>Date:</b></p>
                <input type="text" id="datepicker"/>
                <p class="mt-3"><i>#test: choose 26/7 orr 28/7 for sample slot</i></p>
            </div>
        </div>

        <div class="mx-5">
            <div class="d-flex">
                <input type="text" id="result" style="display:none;"/>
                <div>
                    <p><b>Time:</b>&nbsp;&nbsp;<i>(can choose more than 1 slot)</i></p>
                    <div id="timepicker"></div>
                </div>
            </div>
        </div>
      </div>
      <div class="text-end">
        <button class="btn btn-success">Submit</button>
      </div>
    </div>
  </div>

  <script>
    var result = $("#result");
    var timepicker = $("#timepicker");

    var timeslot = {
        "26-07-2022" : ["08.00 am", "09.00 am", "10.00 am"],
        "28-07-2022": ["08.00 am", "09.00 am", "11.00 am", "12.00 pm", "01.00 pm"]
    };

    $( function() {
        $("#datepicker").datepicker({
            dateFormat: 'dd-mm-yy',
            onSelect: function(dateText, pickerObj){
                result.attr("data-course-id", timeslot[dateText]); 

                if (timeslot[dateText]){
                    let htmlContent= "";
                    for (let i=0; i<timeslot[dateText].length; i++){
                        htmlContent += "<button class='btn btn-sm btn-dark mx-2 mb-2 slot-btn'>" + timeslot[dateText][i] + "</button>";
                    }
                
                    timepicker.html(htmlContent); 
                }
                else{
                    timepicker.html("No Available Slot"); 
                }
            },
            altField: "#result"
        });

        $(document).click(function(e) {
            $(event.target).toggleClass("transparent");
        });
    });

    // var $datePicker = $("div#datepicker");
    // var $datePicker = $("div");

    // $datePicker.datepicker({
    //     changeMonth: true,
    //     changeYear: true,
    //     inline: true,
    //     altField: "#datep",
    // }).change(function(e){
    //     setTimeout(function(){   
    //     $datePicker
    //         .find('.ui-datepicker-current-day').parent().after('<tr><td colspan="8"><div><button>8:00 am &mdash; 9:00 am</button></div><button>9:00 am &mdash; 10:00 am</button></div><button>10:00 am &mdash; 11:00 am</button></div></td></tr>')
            
    //     });
    // });
  </script>
</body>

</html>
