<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../../apptScheduling/fonts/icomoon/style.css">
  <link rel="stylesheet" href="../../apptScheduling/fullcalendar/packages/core/main.css">
  <link rel="stylesheet" href="../../apptScheduling/fullcalendar/packages/daygrid/main.css">

  <!-- 
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link href='fullcalendar/packages/core/main.css' rel='stylesheet' />
  <link href='fullcalendar/packages/daygrid/main.css' rel='stylesheet' /> 
  -->

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->

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
      <a class="navbar-brand" href="./index.html"><b>DHRecord</b></a>
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
  <div class="mb-5 d-flex justify-content-between">
      <h4>Appointment Scheduling and Reminders</h4>
      <button class="btn btn-dark"  onclick="document.location.href='../../registeredpatient/html/mySchedule.php'">My Appointment</button>
    </div>

    <div class="container my-5 custom-container">
        <!-- <div class="search-container">
            <input class="mt-4" type="text" placeholder="Search.." name="search">
            <button class="search-button" type="submit">test</button>
        </div> -->

        <div class="mb-4">
            <div class="d-flex align-items-center">
                <p class="m-0"><b>Search Clinic:</b>&nbsp;&nbsp;&nbsp;</p>
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" placeholder="Enter Value ..."
                        aria-label="Name" aria-describedby="basic-addon2" style="max-width: 350px;" />
                    <button class="input-group-text" id="basic-addon2" onclick="tableSearch();">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
            <!-- to be applied later -->
            <!-- <select class="form-select" id="auditLog_ddlFilterBy" aria-label="Filter By..."
                style="margin-left: 70px; max-width: 250px;">
                <option selected disabled hidden>Filter By...</option>
                <option value="1">Clinic Name</option>
                <option value="2">Address</option>
                <option value="3">Operating Hours</option>
            </select> -->
        </div>
        <div class="content-div my-4">
            <table class="table" id="clinicTable" data-filter-control="true" data-show-search-clear-button="true">
                <tr>
                    <th class="px-4">Clinic Name</th>
                    <th class="px-4">Clinic Description</th>
                    <th></th>
                </tr>
                <tr>
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
                            <td class="px-4 ">Dr. Smith Rowe</td>
                            <td class="px-4">Oral Surgery, Dental Surgery</td>
                            <td class="px-4"><button class="btn btn-dark">Book</button></td>
                          </tr>
                          <tr>
                            <td class="px-4 ">Dr. Elizabeth</td>
                            <td class="px-4">Orthodontic</td>
                            <td class="px-4"><button class="btn btn-dark">Book</button></td>
                          </tr>
                        </table>              
                    </td>
                </tr>
                <tr>
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
                            <td class="px-4 ">Dr. James</td>
                            <td class="px-4">Oral Surgery, Dental Surgery</td>
                            <td class="px-4"><button class="btn btn-dark">Book</button></td>
                          </tr>
                          <tr>
                            <td class="px-4 ">Dr. Moon</td>
                            <td class="px-4">Orthodontic</td>
                            <td class="px-4"><button class="btn btn-dark">Book</button></td>
                          </tr>
                        </table>
                    </td>
                </tr>
                <tr>
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
                            <td class="px-4 ">Dr. Dan</td>
                            <td class="px-4">Oral Surgery, Dental Surgery</td>
                            <td class="px-4"><button class="btn btn-dark">Book</button></td>
                          </tr>
                          <tr>
                            <td class="px-4 ">Dr. Leslie</td>
                            <td class="px-4">Orthodontic</td>
                            <td class="px-4"><button class="btn btn-dark">Book</button></td>
                          </tr>
                        </table>
                    </td>
                </tr>
                <tr>
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
                            <td class="px-4 ">Dr. Robert</td>
                            <td class="px-4">Oral Surgery, Dental Surgery</td>
                            <td class="px-4"><button class="btn btn-dark">Book</button></td>
                          </tr>
                          <tr>
                            <td class="px-4 ">Dr. Ben</td>
                            <td class="px-4">Orthodontic</td>
                            <td class="px-4"><button class="btn btn-dark">Book</button></td>
                          </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- <div class="mb-5 d-flex justify-content-end">
      <button class="btn btn-dark">Book Appointment</button>
      <div class="p-2"></div>
      <button class="btn btn-dark">Reschedule</button>
    </div> -->

    <!-- <div class="calendar-box">
      <div id='calendar-container'>
        <div id='calendar'></div>
      </div>
    </div> -->

  </div>

  <script src="../../apptScheduling/js/jquery-3.3.1.min.js"></script>
  <script src="../../apptScheduling/js/popper.min.js"></script>
  <script src="../../apptScheduling/js/bootstrap.min.js"></script>

  <script src='../../apptScheduling/fullcalendar/packages/core/main.js'></script>
  <script src='../../apptScheduling/fullcalendar/packages/interaction/main.js'></script>
  <script src='../../apptScheduling/fullcalendar/packages/daygrid/main.js'></script>
  <script src='../../apptScheduling/fullcalendar/packages/timegrid/main.js'></script>
  <script src='../../apptScheduling/fullcalendar/packages/list/main.js'></script>

  <!-- <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <script src='fullcalendar/packages/core/main.js'></script>
  <script src='fullcalendar/packages/interaction/main.js'></script>
  <script src='fullcalendar/packages/daygrid/main.js'></script>
  <script src='fullcalendar/packages/timegrid/main.js'></script>
  <script src='fullcalendar/packages/list/main.js'></script> -->

  <script>
    // document.addEventListener('DOMContentLoaded', function () {
    //   var calendarEl = document.getElementById('calendar');

    //   var calendar = new FullCalendar.Calendar(calendarEl, {
    //     plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
    //     height: 'parent',
    //     header: {
    //       left: 'prev,next today',
    //       center: 'title',
    //       right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
    //     },
    //     defaultView: 'dayGridMonth',
    //     defaultDate: new Date(),
    //     navLinks: true, // can click day/week names to navigate views
    //     editable: true,
    //     eventLimit: true, // allow "more" link when too many events
    //     events: [
    //       {
    //         title: 'Monthly Checkup',
    //         start: '2022-07-27T14:00:00',
    //         clinic: 'DX Dental',
    //         doctor: 'Dr. Smith Rowe'
    //       },
    //       {
    //         title: 'Dental Brace',
    //         start: '2022-07-31T15:00:00',
    //         clinic: 'ZW Dental',
    //         doctor: 'Dr. Rose'
    //       },
    //     ]
    //   });

    //   calendar.render();
    // });

  </script>

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

  <script src="../../apptScheduling/js/main.js"></script>
</body>

</html>