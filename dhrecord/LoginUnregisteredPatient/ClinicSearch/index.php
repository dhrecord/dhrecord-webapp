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
            <a class="navbar-brand" href="../ClinicSearch/index.html"><b>DHRecord</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../ClinicSearch/index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../About/index.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../ContactUs/index.html">Contact Us</a>
                    </li>
                </ul>
                <div>
                    <button type="button" class="btn btn-light btn-sm" style="width: 90px; margin-right: 10px;"
                        onclick="window.location.href='../RegistrationPagePatient/index.html'">Register</button>
                    <button type="button" class="btn btn-light btn-sm" style="width: 90px;"
                        onclick="window.location.href='../LoginPage/index.html'">Login</button>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5 custom-container">
        <!-- <div class="search-container">
            <input class="mt-4" type="text" placeholder="Search.." name="search">
            <button class="search-button" type="submit">test</button>
        </div> -->
        <div class="mb-5">
            <h4>Find a Clinic!</h4>
        </div>
        <div class="mb-4 d-flex align-items-center">
            <div class="d-flex align-items-center">
                <p class="m-0"><b>Search:</b>&nbsp;&nbsp;&nbsp;</p>
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
                    <th class="px-4">Clinic Address</th>
                </tr>
               <?php

                    //$query = "SELECT * FROM businessOwner WHERE users_ID=$sessionID";
                    $query = "SELECT * FROM businessOwner";
  
                    //$clinicID = $row['ID'];

                    if ($result = $conn->query($query)) 
                    {
                        while ($row = $result->fetch_assoc()) 
                        {
               ?>
               <tr>     
                    <td><?php echo $row["nameOfClinic"]; ?></td>
                    <td><?php echo $row["address"]; ?></td> 
               </tr>

                <?php
                        }
                    }
                ?>
                <!--<tr>
                    <td class="px-4">Ashford Dental Centre</td>
                    <td class="px-4">
                        <b>Address: </b>215 Upper Thomson Rd, Singapore 574349<br>
                        <br>
                        <b>Operating Hours:</b><br>
                        Monday-Friday: 9am–6pm<br>
                        Saturday: 1pm-4pm<br>
                        Sunday: Closed<br><br>
                        <b>Phone: </b>6265 9146<br>
                        <b>Appointments: </b>ashforddentalcentre.com.sg<br>
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
                        <b>Appointments: </b>expatdental.com<br>

                    </td>
                </tr>
                <tr>
                    <td>Smilefocus Dental Clinic</td>
                    <td>
                        Located in: Camden Medical<br>
                        Address: 1 Orchard Blvd, #08-02 Camden Medical Centre, Singapore 248649<br>
                        Areas served: Orchard and nearby areas<br>
                        <br>
                        Hours:<br>
                        9am–6:30pm<br>
                        Appointments: smilefocus.com.sg<br>
                        Phone: 6733 9882<br>
                    </td>
                </tr>-->
            </table>
        </div>
    </div>

    <div class="container pb-5">
        <footer class="pt-3 mt-4 text-muted border-top text-center">
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

    <!-- <script src="./index.js"></script> -->
    <script type="application/javascript">
        function tableSearch() {
            let input, filter, table, tr, td, txtValue;

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
            }
        };
    </script>
</body>

</html>