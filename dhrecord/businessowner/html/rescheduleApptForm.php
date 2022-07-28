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

  <!-- Style -->
  <link rel="stylesheet" href="../css/apptSchedulingAndReminders.css?v=<?php echo time(); ?>">

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
              <a class="nav-link" aria-current="page" href="./index.html">Home</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="./userManagement.html">User Management</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="./referralTracking.html">Referral Tracking</a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle  active" href="#" id="navbarDropdown" role="button"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  Appointment & Treatment
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="./apptSchedulingAndReminders.php">Appointment Scheduling
                          & Reminders</a></li>
                  <li><a class="dropdown-item" href="./treatmentPlanning.html">Treatment Planning</a></li>
              </ul>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="./reportingAndStatistics.html">Reporting & Statistics</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="./billingInvoicing.html">Payment</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="./inventoryManagement-frontend.php">Inventory Management</a>
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
      <h4>Reschedule Appointment Form</h4>
    </div>

    <div class="p-5" style="background: #F2F2F2;">
        <div class="d-flex">
            <div>
                <p class="m-0"><b>Doctor:</b> Dr.Smith Rowe</p>
                <p class="m-0"><b>Specialization:</b> Oral Surgery, Dental Surgery</p>

                <br>

                <p class="m-0"><b>Clinic:</b>Ashford Dental Centre</p>
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
                    <p><b>Current Date:</b></p>
                    <p>27-07-2022</p>
                </div>
                <div>
                    <p><b>New Date:</b></p>
                    <input type="text" id="datepicker"/>
                </div>
                <p class="mt-3"><i>#test: choose 26/7 orr 28/7 for sample slot</i></p>
            </div>

            <div class="mx-5">
                <div>
                    <p><b>Current Time:</b></p>
                    <p>02.00 pm</p>
                </div>
                <div class="d-flex">
                    <input type="text" id="result" style="display:none;"/>
                    <div>
                        <p><b>New Time:</b>&nbsp;&nbsp;<i>(can choose more than 1 slot)</i</p>
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
        "26-07-2022" : ["09.00 am", "10.00 am", "11.00 am"],
        "28-07-2022": ["08.00 am", "09.00 am", "11.00 am", "12.00 pm", "01.00 pm", "02.00 pm", "03.00 pm"]
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
  </script>

  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>