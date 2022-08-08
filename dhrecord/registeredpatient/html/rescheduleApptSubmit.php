<?php
  session_start();
  if(!isset($_SESSION['loggedin']))
  {
    header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    exit;
  }
  
  $apptID = $_POST['apptID'];
  $date = $_POST['date'];
  $time = $_POST['time'];

  // convert date
  $formattedDate = substr($date, 6, 4)."-".substr($date, 0, 2)."-".substr($date, 3, 2);

  $servername = "localhost";
  $database = "u922342007_Test";
  $username = "u922342007_admin";
  $password = "Aylm@012";

  $conn = mysqli_connect($servername, $username, $password, $database);
 
  $timeArray=  explode(", ", $time ); 
  if(count($timeArray)<= 2){
    $time = substr($time, 0, 5).":00";
    $stmt = mysqli_prepare($conn, "update `appointment` set `appoinment.date`=date(?), `appoinment.time`=time(?) where `apptID`=?");
    mysqli_stmt_bind_param($stmt, "sss", $formattedDate, $time, $apptID);
    mysqli_stmt_execute($stmt);
  } else {
    for($i=0;$i<count($timeArray);$i++){
        $timeBlock = $timeArray[$i].":00";
        // $stmt = mysqli_prepare($conn, "UPDATE appointment SET appoinment.date=date(?), appoinment.time=time(?) WHERE apptID=?");
        $stmt = mysqli_prepare($conn, "update `appointment` set `appoinment.date`=date(?), `appoinment.time`=time(?) where `apptID`=?");
        mysqli_stmt_bind_param($stmt, "sss", $formattedDate, $time, $apptID);
        mysqli_stmt_execute($stmt);
    }
  }

  // header("Location: http://dhrecord.com/dhrecord/registeredpatient/html/apptScheduling.php");
  mysqli_close($conn);
?>
