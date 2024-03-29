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
  <link rel="stylesheet" href="../css/apptSchedulingAndReminders.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="../css/apptForm.css">
    
  <!-- jquery -->
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  

  <title>DHRecord</title>
</head>

<body>
    <?php
    include 'navBar.php';
?>

  <!-- content -->
  <div class="container my-5">
    <div class="mb-4 d-flex justify-content-between">
      <h4>Book An Appointment</h4>
    </div>

    <div class="p-5" style="background: #F2F2F2;">
      <form method="post" action="./bookApptSubmit.php">
        <div class="d-flex resched-form">
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

                      $docID = "";

                      // if login as doctor -> need to finnd doctor id
                      if ($_SESSION['role'] === "dr"){
                          // GET THE DOCTOR FULLNAME
                          $stmtDoc = $conn->prepare("SELECT fullName, doctorID
                                                      FROM doctor 
                                                      WHERE userID = ?");
                          $stmtDoc->bind_param("s", $_SESSION['id']);
                          $stmtDoc->execute();
                          $resultDoc = $stmtDoc->get_result();

                          if ($resultDoc->num_rows === 0) {
                              echo $_SESSION['username'];
                          } else {
                              while ($rowDoc = $resultDoc->fetch_assoc()){
                                  $docID = $rowDoc['doctorID'];
                                  echo $rowDoc['fullName'];
                              }
                          }
                      }

                      // if login as frontdesk -> doctor id is passed by form parameter
                      if ($_SESSION['role'] === "fd" or $_SESSION['role'] === "ca"){
                          $docID = $_POST['doc_id'];

                          // GET THE DOCTOR FULLNAME
                          $stmtDoc = $conn->prepare("SELECT fullName
                                                      FROM doctor 
                                                      WHERE doctorID = ?");
                          $stmtDoc->bind_param("s", $_POST['doc_id']);
                          $stmtDoc->execute();
                          $resultDoc = $stmtDoc->get_result();

                          if ($resultDoc->num_rows === 0) {
                              echo "-";
                          } else {
                              while ($rowDoc = $resultDoc->fetch_assoc()){
                                  echo $rowDoc['fullName'];
                              }
                          }
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
                      $stmtSpec->bind_param("s", $docID);
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
                  $stmtClinic->bind_param("s", $docID);
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

              <br/>

              <p class="m-0"> 
                  <b>Operating Hours:</b><br/>
                  
                  <?php
                      // GET THE OPERATING HOURS OF THE CLINIC
                      $stmtOH = $conn->prepare("SELECT day, start_time, end_time 
                                                  FROM operatingHours 
                                                  WHERE operatingHours.doctorID = ?");
                      $stmtOH->bind_param("s", $docID);
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
              <div class="personalized_mx">
                    <div>
                        <p><b>Patient:</b></p>
                        <!-- <input type="text" name="patID" style="width:250px;"/> -->
                        <select name="patID" id="patID" class="form-select" required>
                          <option selected value="">ID - Name</option>
                          <?php
                            // GET THE LIST OF PATIENTS
                            $resultPatId = $conn->query("SELECT DISTINCT ID, fullName
                            FROM registeredPatient");

                            while ($rowPatId = $resultPatId->fetch_assoc()){
                              echo '<option value="';
                              echo $rowPatId['ID'];
                              echo '">';
                              echo $rowPatId['ID'];
                              echo ' - ';
                              echo $rowPatId['fullName'];
                              echo '</option>';
                            }
                          ?>
                        </select>
                    </div>
              </div>
            </div>

            <div class=" mb-4">
              <div class="personalized_mx">
                    <div>
                        <p><b>Agenda:</b></p>
                        <input type="text" name="agenda" style="width:250px;" id="agenda" required/>
                    </div>
              </div>
            </div>

            <div class="d-flex resched-form">
              <div class="personalized_mx">
                  <div>
                      <p><b>Date (mm-dd-yyyy):</b></p>
                      <input type="text" id="datepicker" name="date" required/>
                      <input type="text" id="result" style="display:none;" required/>
                  </div>
              </div>

              <div class="personalized_mx personalized_mt4">
                  <div class="d-flex">
                      <input type="text" id="result2" style="display:none;" name="time" value="" required/>
                      <div>
                          <p><b>Time:</b>&nbsp;&nbsp;<i>(can choose more than 1 slot)</i></p>
                          <div id="timepicker"></div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          
          <!-- hidden value -->
          <input type="text" style="display:none;" name="docID" value=<?=$docID?>/>
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
      $stmtBSlot->bind_param("s", $docID);
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
      $stmtOHSlot->bind_param("s", $docID);
      $stmtOHSlot->execute();
      $resultOHSlot = $stmtOHSlot->get_result();
      $closedDaysArr = array();

      if ($resultOHSlot->num_rows > 0) {
        while ($rowOHSlot = $resultOHSlot->fetch_assoc()){

          if (substr($rowOHSlot['start_time'], 0, 5) == "00:00" and substr($rowOHSlot['end_time'], 0, 5) == "00:00"){
            array_push($closedDaysArr,$rowOHSlot['day']);

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

        var blocked_days_array = [];

        <?php
          for ($i = 0; $i < count($closedDaysArr); $i++)  {
            echo 'blocked_days_array.push(["';
            echo $closedDaysArr[$i];
            echo '"]);';
          }
        ?>

        $("#datepicker").datepicker({
            dateFormat: 'mm-dd-yy',
            minDate: 0,
            beforeShowDay: function(date){
                var day = date.getDay();
                var closedDates = blocked_date_array;
                var closedDays = blocked_days_array;
                
                for (var i = 0; i < closedDays.length; i++) {
                  let formatted_date = '';
                  switch(closedDays[i][0]){
                    case "Sunday":
                      formatted_date = 0;
                      break;
                    case "Monday":
                      formatted_date = 1;
                      break;
                    case "Tuesday":
                      formatted_date = 2;
                      break;
                    case "Wednesday":
                      formatted_date = 3;
                      break;
                    case "Thursday":
                      formatted_date = 4;
                      break;
                    case "Friday":
                      formatted_date = 5;
                      break;
                    case "Saturday":
                      formatted_date = 6;
                      break;
                  }

                  if (day == formatted_date) {
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

          if ($(event.target).text() !== "Submit" && $(event.target).text().length === 5){
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
          } else if($(event.target).text() === "Submit") {
            let patientID = $("#patID").val();
            let agenda = $("#agenda").val();
            let date_val = $("#result").val();
            let time_val = $("#result2").val();
            if (patientID === ""){
              alert("please choose the patient!");
              return false;
            }
            if (agenda === ""){
              alert("please enter agenda!");
              return false;
            }
            if (date_val === ""){
              alert("please choose the date!");
              return false;
            }
            if (time_val === ""){
              alert("please choose the time slot!");
              return false;
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
