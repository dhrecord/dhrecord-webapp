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
      <form method="post" action="./bookApptSubmit.php">
        <div class="d-flex">
          <div>
              <p class="m-0"><b>Doctor: </b>
                <?php
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
                    // GET THE DOCTOR'S SPECIALIZATION
                    $stmtSpec = $conn->prepare("SELECT clinicSpecialization.specName 
                                                FROM doctorSpecialization
                                                JOIN clinicSpecialization 
                                                ON clinicSpecialization.ID = doctorSpecialization.specializationID 
                                                WHERE doctorSpecialization.doctorID=?");
                    $stmtSpec->bind_param("s", $_POST['doc_id']);
                    $stmtSpec->execute();
                    $resultSpec = $stmtSpec->get_result();

                    $specializations = array();
                    while ($rowSpec = $resultSpec->fetch_assoc()){
                      array_push($specializations, $rowSpec["specName"]);
                    }

                    $join_specializations = implode(', ', $specializations);
                    echo $join_specializations;
                  ?>
              </p>

              <br/>

              <?php
                  // GET THE DOCTOR'S SPECIALIZATION
                  $stmtClinic = $conn->prepare("SELECT DISTINCT businessOwner.nameOfClinic, businessOwner.locationOfClinic
                                              FROM businessOwner
                                              JOIN doctor
                                              ON doctor.clinicID = businessOwner.ID
                                              WHERE doctor.doctorID=?");
                  $stmtClinic->bind_param("s", $_POST['doc_id']);
                  $stmtClinic->execute();
                  $resultClinic = $stmtClinic->get_result();

                  while ($rowClinic = $resultClinic->fetch_assoc()){
                    echo '<p class="m-0"><b>Clinic: </b>';
                    echo $rowClinic['nameOfClinic'];
                    echo '</p><p class="m-0"><b>Address: </b>';
                    echo $rowClinic['locationOfClinic'];
                    echo '<br/></p>';
                  }
              ?>

              <br>

              <p class="m-0"> 
                  <b>Operating Hours:</b><br/>
                  
                  <?php
                    // GET THE OPERATING HOURS OF THE CLINIC
                    $stmtOH = $conn->prepare("SELECT day, start_time, end_time 
                                                FROM operatingHours 
                                                WHERE operatingHours.doctorID = ?");
                    $stmtOH->bind_param("s", $_POST['doc_id']);
                    $stmtOH->execute();
                    $resultOH = $stmtOH->get_result();

                    echo '<p>';
                    if ($resultOH->num_rows === 0) {
                      echo '-';
                    } else { 
                      while ($rowOH = $resultOH->fetch_assoc()){
                        if ($rowOH['start_time'] === "00:00:00" and $rowOH['end_time'] === "00:00:00"){
                          echo $rowOH['day'];
                          echo ': Closed<br/>';
                        } else {
                          echo $rowOH['day'];
                          echo ': ';
                          $start_time = $rowOH['start_time']; 
                          echo substr($start_time, 0, 5);
                          echo '-';
                          $end_time = $rowOH['end_time']; 
                          echo substr($end_time, 0, 5);
                          echo '<br/>';
                        }
                      }
                    }
                    echo '</p>';
                  ?>
              </p>
          </div>

          <div>
            <div class=" mb-4">
              <div class="mx-5">
                    <div>
                        <p><b>Agenda:</b></p>
                        <input type="text" name="agenda" style="width:250px;"/>
                    </div>
              </div>
            </div>

            <div class="d-flex">
              <div class="mx-5">
                  <div>
                      <p><b>Date (mm-dd-yyyy):</b></p>
                      <input type="text" id="datepicker" name="date"/>
                      <input type="text" id="result" style="display:none;"/>
                  </div>
              </div>

              <div class="mx-5">
                  <div class="d-flex">
                      <input type="text" id="result2" style="display:none;" name="time" value=""/>
                      <div>
                          <p><b>Time:</b>&nbsp;&nbsp;<i>(can choose more than 1 slot)</i></p>
                          <div id="timepicker"></div>
                      </div>
                  </div>
              </div>
            </div>
          </div>

          <!-- hidden value -->
          <input type="text" style="display:none;" name="docID" value=<?=$_POST['doc_id']?>/>
          <?php
            // GET THE Patient ID
            $stmtPatId = $conn->prepare("SELECT DISTINCT ID
                                            FROM registeredPatient
                                            WHERE registeredPatient.users_ID=?");
            $stmtPatId->bind_param("s", $_SESSION['id']);
            $stmtPatId->execute();
            $resultPatId = $stmtPatId->get_result();

            while ($rowPatId = $resultPatId->fetch_assoc()){
              echo '<input type="text" style="display:none;" name="patID" value="';
              echo $rowPatId['ID'];
              echo '"/>';
            }
          ?>
        </div>
        
        <div class="text-end">
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    var result = $("#result");
    var timepicker = $("#timepicker");

    var timeslot = {
        "Monday" : [],
        "Tuesday" : [],
        "Wednesday" : [],
        "Thursday" : [],
        "Friday" : [],
        "Saturday": [],
        "Sunday": [],
    };

    var booked_timeslot = {};

    <?php
      // GET THE BOOKED TIME SLOTS
      $stmtBSlot = $conn->prepare("SELECT appointment.date, appointment.time 
                                  FROM appointment 
                                  WHERE appointment.doctorID = ?");
      $stmtBSlot->bind_param("s", $_POST['doc_id']);
      $stmtBSlot->execute();
      $resultBSlot = $stmtBSlot->get_result();

      if ($resultBSlot->num_rows > 0) {
        while ($rowBSlot = $resultBSlot->fetch_assoc()){
          // if date exists alr as key in dict
          echo 'if (booked_timeslot["';
          echo $rowBSlot['date'];
          echo '"]){';

          echo 'booked_timeslot["';
          echo $rowBSlot['date'];
          echo '"].push("';
          echo substr($rowBSlot['time'], 0, 5);
          echo '");';

          // if date does not exist as key in dict
          echo '} else {';
          echo 'booked_timeslot["';
          echo $rowBSlot['date'];
          echo '"] = [];';

          echo 'booked_timeslot["';
          echo $rowBSlot['date'];
          echo '"].push("';
          echo substr($rowBSlot['time'], 0, 5);
          echo '");';

          echo '}';
        }
      }

      // GET THE TIME SLOT FROM CLINIC OPENING HOURS
      $stmtOHSlot = $conn->prepare("SELECT day, start_time, end_time 
                                  FROM operatingHours 
                                  WHERE operatingHours.doctorID = ?");
      $stmtOHSlot->bind_param("s", $_POST['doc_id']);
      $stmtOHSlot->execute();
      $resultOHSlot = $stmtOHSlot->get_result();
      $closedDays = array();

      if ($resultOHSlot->num_rows > 0) {
        while ($rowOHSlot = $resultOHSlot->fetch_assoc()){

          if (substr($rowOHSlot['start_time'], 0, 5) == "00:00" and substr($rowOHSlot['end_time'], 0, 5) == "00:00"){
            array_push($closedDays,$rowOHSlot['day']);

            echo 'timeslot["';
            echo $rowOHSlot['day'];
            echo '"].push("';
            echo "Closed";
            echo '");';
          } else {
            $floor = (int) substr($rowOHSlot['start_time'], 0, 2);
            $ceil = (int) substr($rowOHSlot['end_time'], 0, 2);

            for ($floor; $floor < $ceil; $floor++) {
              $time = "";
              if (strlen(strval($floor)) == 1){
                $time = "0".strval($floor).":00";
              } else {
                $time = strval($floor).":00";
              }

              echo 'timeslot["';
              echo $rowOHSlot['day'];
              echo '"].push("';
              echo $time;
              echo '");';
            }
          }
        }
      }
    ?>

    $( function() {
        const daysArr =["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var blocked_date_array = [];

        <?php
          // GET THE PUBLIC HOLIDAY DATE
          $resultPHD = $conn->query("SELECT * FROM blockedDate");

          if ($resultPHD->num_rows > 0) {
            while ($rowPHD = $resultPHD->fetch_assoc()){
              $formatted_date_PHD = $rowPHD["date"];

              echo 'blocked_date_array.push([';
              echo substr($formatted_date_PHD, 5, 2); // month
              echo ', ';
              echo substr($formatted_date_PHD, 8, 2); // date
              echo ', ';
              echo substr($formatted_date_PHD, 0, 4); // year
              echo ']);';
            }
          }
        ?>

        var blocked_days = [];
        <?php
          for ($i = 0; $i < count($closedDays); $i++)  {
            echo 'blocked_days.push([';
            echo $closedDays[$i];
            echo ']);';
          }
        ?>

        $("#datepicker").datepicker({
            dateFormat: 'mm-dd-yy',
            beforeShowDay: function(date){
                // var string = jQuery.datepicker.formatDate('mm-dd-yy', date);
                // return [ blocked_date_array.indexOf(string) == -1 ]

                var day = date.getDay(), Sunday = 0, Monday = 1, Tuesday = 2, Wednesday = 3, Thursday = 4, Friday = 5, Saturday = 6;
                // var closedDates = [[8, 29, 2022], [8, 25, 2022]];
                var closedDates = blocked_date_array;
                // var closedDays = [[Sunday], [Saturday]];
                var closedDays = blocked_days;
                for (var i = 0; i < closedDays.length; i++) {
                  if (day == closedDays[i][0]) {
                      return [false];
                  }
                }

                for (i = 0; i < closedDates.length; i++) {
                  if (date.getMonth() == closedDates[i][0] - 1 &&
                  date.getDate() == closedDates[i][1] &&
                  date.getFullYear() == closedDates[i][2]) {
                    return [false];
                  }
                }

                return [true];
            },
            onSelect: function(dateText, pickerObj){
                let chosenDate = new Date(dateText);
                let chosenDay = daysArr[chosenDate.getDay()];

                let dateInOtherFormat = dateText.substr(6,4) + "-" + dateText.substr(0,2) + "-" + dateText.substr(3,2);

                result.attr("data-course-id", timeslot[chosenDay]); 

                if (timeslot[chosenDay]){
                    let htmlContent= "";
                    if (timeslot[chosenDay].length == 1){
                      htmlContent += "<p>" + timeslot[chosenDay][0] + "</p>";
                    } else {
                      for (let i=0; i<timeslot[chosenDay].length; i++){
                        if (booked_timeslot[dateInOtherFormat]) {
                          if (booked_timeslot[dateInOtherFormat].includes(timeslot[chosenDay][i])){
                            htmlContent += "<button type='button' class='btn btn-sm btn-dark mx-2 mb-2 slot-btn' disabled>" + timeslot[chosenDay][i] + "</button>";
                          } else {
                            htmlContent += "<button type='button' class='btn btn-sm btn-dark mx-2 mb-2 slot-btn'>" + timeslot[chosenDay][i] + "</button>";
                          }
                        } else {
                          htmlContent += "<button type='button' class='btn btn-sm btn-dark mx-2 mb-2 slot-btn'>" + timeslot[chosenDay][i] + "</button>";
                        }
                      }
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

          if ($(event.target).text() !== "Submit"){
            if($(event.target).hasClass("transparent")){
              $value = $("#result2").val();
              if($(event.target).text() !== ""){
                $("#result2").val($value + $(event.target).text() + ", ");
              }
            } else {
              $value = $("#result2").val();
              if ($value.includes($(event.target).text())){
                // find index
                $idx = $value.search($(event.target).text());

                // remove from $value
                $new_val = $value.substr(0, $idx) + $value.substr($idx+7, $value.length);

                // reassign value to input
                $("#result2").val($new_val);
              }
            }
          }
        });
    });
  </script>

  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
