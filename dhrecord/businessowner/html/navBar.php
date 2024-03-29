<?php

$role = $_SESSION['role'];

$link = $_SERVER['PHP_SELF'];
$link_array = explode('/',$link);
$page = end($link_array);

if($role === "fd")
{

?>

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
                            <a class="nav-link <?php echo ($page == 'index.php') ? 'active': '' ?>" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'manageRecord.php' or strpos($page, 'familyTagging.php') !== FALSE) ? 'active': '' ?>" href="./manageRecord.php">Manage Records</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'referralTracking.php') ? 'active': '' ?>" href="./referralTracking.php">Referral Tracking</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo ($page == 'apptSchedulingAndReminders.php' 
                                    or $page == 'treatmentHistory.php' or $page == 'doctorSchedule.php' 
                                    or $page == 'rescheduleAppt.php' or $page == 'rescheduleApptForm.php' 
                                    or $page == 'bookAppt.php' or strpos($page, 'patientTreatmentHistory.php') !== FALSE) ? 'active': '' ?>" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Appointment & Treatment
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./apptSchedulingAndReminders.php">Appointment Scheduling</a></li>
                            <li><a class="dropdown-item" href="./treatmentHistory.php">Treatment History</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'billingInvoicingFD.php') ? 'active': '' ?>" href="./billingInvoicingFD.php">Payment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'inventoryManagement.php' or $page == 'AddNewPrescription.php' or strpos($page, 'editInv.php') !== FALSE) ? 'active': '' ?>" href="./inventoryManagement.php">Inventory Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'surveyAndFeedback.php') ? 'active': '' ?>" href="./surveyAndFeedback.php">Survey and Feedback</a>
                    </li>
                </ul>
                <div class="d-flex flex-column align-items-end">
                    <p class="navbar-text text-white m-0 text-end">
                        Welcome, <?php echo $_SESSION['username']; ?>
                    </p>
                    <button type="button" class="btn btn-light ml-3 btn-sm mb-2"
                        onclick="document.location.href='../../LoginUnregisteredPatient/LoginPage/logout.php'">Logout</button>
                </div>
            </div>
        </div>
    </nav>

<?php

}

else if($role === "dr")
{
?>

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
                    <a class="nav-link <?php echo ($page == 'index.php') ? 'active': '' ?>" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'manageRecord.php' or strpos($page, 'familyTagging.php') !== FALSE) ? 'active': '' ?>" href="./manageRecord.php">Manage Records</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo ($page == 'apptSchedulingAndReminders.php' 
                                    or $page == 'treatmentHistory.php' or $page == 'finishAppointment.php' 
                                    or $page == 'rescheduleAppt.php' or $page == 'rescheduleApptForm.php' 
                                    or $page == 'bookAppt.php' or strpos($page, 'patientTreatmentHistory.php') !== FALSE) ? 'active': '' ?>" 
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Appointment & Treatment
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./apptSchedulingAndReminders.php">Appointment Scheduling
                                    </a></li>
                            <li><a class="dropdown-item" href="./treatmentHistory.php">Treatment History</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'billingInvoicingDR.php') ? 'active': '' ?>" href="./billingInvoicingDR.php">Payment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'inventoryManagement.php' or $page == 'AddNewPrescription.php' or strpos($page, 'editInv.php') !== FALSE) ? 'active': '' ?>" href="./inventoryManagement.php">Inventory Management</a>
                    </li>
                </ul>
                <div class="d-flex flex-column align-items-end">
                    <p class="navbar-text text-white m-0 text-end">
                        Welcome, <?php echo $_SESSION['username']; ?>
                    </p>
                    <button type="button" class="btn btn-light ml-3 btn-sm mb-2"
                        onclick="document.location.href='../../LoginUnregisteredPatient/LoginPage/logout.php'">Logout</button>
                </div>
            </div>
        </div>
    </nav>


<?php

}

else
{
?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid container">
        <a class="navbar-brand" href="./index.php"><b>DHRecord</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link <?php echo ($page == 'index.php') ? 'active': '' ?>" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown d-flex align-items-center">
                        <a class="nav-link dropdown-toggle <?php echo ($page == 'userManagement.php' or $page == 'manageRecord.php' 
                        or $page == 'addUser.php' or strpos($page, 'familyTagging.php') !== FALSE) ? 'active': '' ?>" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            User Management &<br/> Manage Records
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./userManagement.php">User Management</a></li>
                            <li><a class="dropdown-item" href="./manageRecord.php">View Patient</a></li>
                        </ul>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link <?php echo ($page == 'referralTracking.php') ? 'active': '' ?>" href="./referralTracking.php">Referral Tracking</a>
                    </li>
                    <li class="nav-item dropdown d-flex align-items-center">
                        <a class="nav-link dropdown-toggle <?php echo ($page == 'apptSchedulingAndReminders.php' 
                                    or $page == 'treatmentHistory.php' or $page == 'doctorSchedule.php' 
                                    or $page == 'rescheduleAppt.php' or $page == 'rescheduleApptForm.php' 
                                    or $page == 'bookAppt.php' or strpos($page, 'patientTreatmentHistory.php') !== FALSE) ? 'active': '' ?>" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Appointment & Treatment
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./apptSchedulingAndReminders.php">Appointment Scheduling
                                    </a></li>
                            <li><a class="dropdown-item" href="./treatmentHistory.php">Treatment History</a></li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="./reportingAndStatistics.php">Reporting & Statistics</a>
                    </li> -->
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link <?php echo ($page == 'billingInvoicingCA.php') ? 'active': '' ?>" href="./billingInvoicingCA.php">Payment</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link <?php echo ($page == 'inventoryManagement.php' or $page == 'AddNewPrescription.php' or strpos($page, 'editInv.php') !== FALSE) ? 'active': '' ?>" href="./inventoryManagement.php">Inventory Management</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link <?php echo ($page == 'surveyAndFeedback.php') ? 'active': '' ?>" href="./surveyAndFeedback.php">Survey and Feedback</a>
                    </li>
                </ul>
                <div class="d-flex flex-column align-items-end">
                    <p class="navbar-text text-white m-0 text-end">
                        Welcome, <?php echo $_SESSION['username']; ?>
                    </p>
                    <button type="button" class="btn btn-light ml-3 btn-sm mb-2"
                        onclick="document.location.href='../../LoginUnregisteredPatient/LoginPage/logout.php'">Logout</button>
                </div>
            </div>
        </div>
    </nav>


<?php
}
?>
