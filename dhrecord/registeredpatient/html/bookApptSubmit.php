<?php
  session_start();
  if(!isset($_SESSION['loggedin']))
  {
    header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    exit;
  }
  
  $docID = $_POST['docID'];
  $patID = $_POST['patID'];
  $agenda = '"'.$_POST['agenda'].'"';
  $date = $_POST['date'];
  $time = $_POST['time'];

  // convert date
  $formattedDate = '"'.substr($date, 6, 4)."-".substr($date, 0, 2)."-".substr($date, 3, 2).'"';

  $servername = "localhost";
  $database = "u922342007_Test";
  $username = "u922342007_admin";
  $password = "Aylm@012";

  $conn = mysqli_connect($servername, $username, $password, $database);
 
  $timeArray=  explode(", ", $time ); 
  if(count($timeArray)<= 2){
    $time = '"'.substr($time, 0, 5).':00'.'"';
    $stmt = mysqli_prepare($conn, "insert into `appointment`(`date`, `time`, `agenda` , `doctorID` , `patientID`) values (?, ?, ?, ?, ?");
    mysqli_stmt_bind_param($stmt, "sssss", $formattedDatedate, $time, $agenda, $docID, $patID);
    mysqli_stmt_execute($stmt);
  } else {
    for($i=0;$i<count($timeArray);$i++){
        $timeBlock = '"'.$timeArray[$i].":00".'"';
        $stmt = mysqli_prepare($conn, "insert into `appointment`(`date`, `time`, `agenda` , `doctorID` , `patientID`) values (?, ?, ?, ?, ?");
        mysqli_stmt_bind_param($stmt, "sssss", $formattedDate, $timeBlock, $agenda, $docID, $patID);
        mysqli_stmt_execute($stmt);
    }
  }

//   header("Location: http://dhrecord.com/dhrecord/registeredpatient/html/apptScheduling.php");
  mysqli_close($conn);
?>
