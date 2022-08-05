<?php 
                $role = $_SESSION['role'];
                if ($role === 'dr')
                {
                    echo '<a class="navbar-brand" href="./drindex.php"><b>DHRecord</b></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                              <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./drindex.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./manageRecord.php">Patient Records</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Appointment & Treatment
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./apptSchedulingAndReminders.php">Appointment Scheduling
                                    & Reminders</a></li>
                            <li><a class="dropdown-item" href="./treatmentHistory.php">Treatment History</a></li>
                        </ul>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" href="./reportingAndStatistics.php">Reporting & Statistics</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="./billingInvoicing.php">Payment</a>
                    </li>
                    -->
                    <li class="nav-item">
                        <a class="nav-link" href="./inventoryManagement.php">Inventory Management</a>
                    </li>
                  </ul>
                  <div class="d-flex flex-column align-items-end">
                    <p class="navbar-text text-white m-0">
                        Welcome, '; echo $_SESSION['username'];
                    echo '</p>
                    <button type="button" class="btn btn-light ml-3 btn-sm mb-2"
                        '; echo "onclick='document.location.href="."../../LoginUnregisteredPatient/LoginPage/logout.php".">Logout</button>";
                    echo '</div>
                    </div>
                    </div>
                    </nav>
                    <main class="container my-5">
                    <div class="bg-light p-5 rounded mt-3">
                      <h1>Homepage</h1>
                      <hr>
                      <h4 class="lead">Hi, '; echo $_SESSION['username']; echo '!</h4>
                      <h4 class="lead">Role:';
                      if ($role === "ca")
                      {
                        echo "Clinic Admin";
                      } else if ($role === "dr")
                      {
                        echo "Doctor";
                      } else
                      {
                        echo "Front-desk";
                      }
                    echo '</h4>
                      <hr>
                    <p class="mx-2" style="font-size: 1.1rem; margin-top: 0; margin-bottom: 0.5rem;line-height: 1.2;"><button class="btn btn-secondary" ' echo " 'onclick="window.location.href='./changeUsernameOrPasswordBusinessOwner.php';" '>Change Password</button></p>";
                    echo '<!-- <a class="btn btn-lg btn-primary" href="/docs/5.0/components/navbar/" role="button">View navbar docs &raquo;</a> -->
                    </div>
                  </main>

                  <!-- bootstrap js -->
                  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                  crossorigin="anonymous"></script>';
                }
?>
