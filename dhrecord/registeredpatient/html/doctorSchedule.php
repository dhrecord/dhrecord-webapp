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
  <link rel="stylesheet" href="../css/style.css">
    
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
            <a class="nav-link" href="../html/treatmentPlanning.php">Treatment Planning</a>
          </li>
        </ul>
        <div class="d-flex flex-column align-items-end">
          <p class="navbar-text text-white m-0">
            Welcome, Username
          </p>
          <button type="button" class="btn btn-light ml-3 btn-sm mb-2" style="width: 90px;"
            onclick="document.location.href='../../LoginUnregisteredPatient/LoginPage/index.html'">Logout</button>
        </div>
      </div>
    </div>
  </nav>

  <!-- content -->
  <div class="container my-5">
    <div class="mb-4 d-flex justify-content-between">
      <h4>Book An Appointment</h4>
    </div>

    <div class="d-flex p-5" style="background: #F2F2F2;">
        <div>
            <p class="m-0"><b>Doctor:</b> Dr.Smith Rowe</p>
            <p class="m-0"><b>Specialization:</b> Oral Surgery, Dental Surgery</p>

            <br>

            <p class="m-0"><b>Clinic:</b> Ashford Dental Centre</p>
            <p class="m-0"><b>Address: </b>215 Upper Thomson Rd, Singapore 574349<br/></p>

            <br>

            <p class="m-0"> 
                <b>Operating Hours:</b><br/>
                Monday-Friday: 9am–6pm<br/>
                Saturday: 1pm-4pm<br/>
                Sunday: Closed<br/><br/>
            </p>

            <!-- <div class=" p-5"></div> -->
        
            <!-- <div>
                <p class="m-0"> 
                    <b>Operating Hours:</b><br/>
                    Monday-Friday: 9am–6pm<br/>
                    Saturday: 1pm-4pm<br/>
                    Sunday: Closed<br/><br/>
                </p>
            </div> -->
        </div>

        <div class="mx-5">
            <div class="d-flex">
                <p><b>Date:</b>&nbsp;&nbsp;&nbsp;<input type="text" id="datepicker"></p>
                <div>
                    <p class="mx-5"><b>Time:</b>&nbsp;&nbsp;&nbsp;<span id="timepicker"></span></p>
                </div>
            </div>
        </div>
    </div>
  </div>

  <script>
    var result;
    var timepicker = $("#timepicker");

    var timeslot = {
        "26-07-2022" : "8am",
        "28-07-2022": "9am"
    };

    $( function() {
        $("#datepicker").datepicker({
            dateFormat: 'dd-mm-yy',
            onSelect: function(dateText, pickerObj){
                result = $("#datepicker");
                result.attr("data-course-id", timeslot[dateText]); 
                timepicker.text = timeslot[dateText]; 
            }
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