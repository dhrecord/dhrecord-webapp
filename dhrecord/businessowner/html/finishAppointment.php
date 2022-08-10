<?php
  session_start();
  if(!isset($_SESSION['loggedin']))
  {
    header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    exit;
  }

  //db connection
  $servername = "localhost";
  $database = "u922342007_Test";
  $username = "u922342007_admin";
  $password = "Aylm@012";
  $conn = mysqli_connect($servername, $username, $password, $database);

  if (!$conn) 
  {
    die("Connection failed: " . mysqli_connect_error());
  }

  $toothCondition = "";
  $diagnosis = "";
  $medicationPrescribedID = "";
  $quantity = ""; 
  $referredTo = "";
  $comments = "";
  $err_msg = "";
  
  //get form data and insert into tables
  if (isset($_POST['submit'])) 
  {
    $apptID = $_POST["apptID"];
    $apptDate = $_POST["apptDate"];
    $apptAgenda = $_POST["apptAgenda"];
    $apptDoctorID = $_POST["apptDoctorID"];
    $apptPatientID = $_POST["apptPatientID"];
    $toothCondition = $_POST["toothCondition"];
    $diagnosis = $_POST["diagnosis"];
    $medicationPrescribedID = $_POST["medicationPrescribed"]; // the med's ID
    $quantity = $_POST["quantity"]; // qty requested
    $referredTo = $_POST["referTo"];
    $comments = $_POST["comments"];

    // find med's name from ID
    $query = "select * from `inventoryManagement` WHERE ID = '".$medicationPrescribedID."'";
    $result = mysqli_query($conn,$query);
    $prescriptionName = "";
    $prescriptionQty = ""; // available qty from db

    while($res=mysqli_fetch_assoc($result))
    {
        $prescriptionName = $res['prescriptionName'];
        $prescriptionQty = $res['prescriptionQty'];
    }

    // proceed only if med's quantity is enough to meet the demand
    if ($quantity <= $prescriptionQty){
      // update referral tracking
      if (isset($_POST["referTo"]) && $_POST["referTo"] != "")
      {
        $res = "INSERT INTO referralTracking (referredTo, referralDate, referringDoctor, toothCondition, comments, patient_ID)
        VALUES ('{$referredTo}', '{$apptDate}', '{$apptDoctorID}', '{$toothCondition}', '{$comments}', '{$apptPatientID}')";
      
        if (mysqli_query($conn, $res)) 
        {
          //echo "New record created successfully";
        } else {
          //echo "Error: " . $res . "<br>" . mysqli_error($conn);
        }
      
      }
      
      // update treatment history
      $res = "INSERT INTO treatmentHistory (date, attendingDoctor, pt_ID, toothCondition, diagnosis, medicationPrescribed, quantity, comments)
        VALUES ('{$apptDate}', '{$apptDoctorID}', '{$apptPatientID}', '{$toothCondition}', '{$diagnosis}', '{$medicationPrescribedID}', CAST('{$quantity}' AS int), '{$comments}')";
      
      
      // update inventory management
      $newQty = $prescriptionQty - $quantity;
      $queryy = "UPDATE `inventoryManagement` SET prescriptionQty = '".$newQty."' WHERE ID= '".$medicationPrescribedID."'";
      $result1 = mysqli_query($conn,$queryy) or die (mysqli_error());
        
      // if success, redirect to appt schedule page
      if($result1)
      {
        header("location:apptSchedulingAndReminders.php");
      }
      else
      {
        echo "Please check your query:</br>";
        echo "PrescriptionID:  ";
        echo $prescriptionID;
        echo "<br/>";
        echo "PrescriptionQty:  ";
        echo $prescriptionQty1;
        echo "<br/>";
        echo "Your Requested Quantity:  ";
        echo $quantity;
        echo "<br/>";
        echo "newQty:  ";
        echo $newQty;
      }


      if (mysqli_query($conn, $res)) 
        {
          //echo "New record created successfully";
        } else {
          //echo "Error: " . $res . "<br>" . mysqli_error($conn);
        }
      
      $res = ("UPDATE appointment SET status = 'finished' WHERE apptID = '{$apptID}'");
      
      if (mysqli_query($conn, $res)) 
        {
          //echo "New record created successfully";
        } else {
          //echo "Error: " . $res . "<br>" . mysqli_error($conn);
        }
      
      header('Location: ./apptSchedulingAndReminders.php');
    } else {
      // echo 'alert("Not enough supply!");';
      $err_msg = "Not enough supply!";
    }
  }

  $res = "SELECT * FROM appointment WHERE apptID = " .$_GET['apptID']. " ";

  $result = mysqli_query($conn, $res);
  
  while($sql = mysqli_fetch_assoc($result))
  {
    $apptID = $sql["apptID"];
    $apptDate = $sql["date"];
    $apptAgenda = $sql["agenda"];
    $apptDoctorID = $sql["doctorID"];
    $apptPatientID = $sql["patientID"];
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

  <title>DHRecord</title>
</head>

<body>
  <?php
    include 'navBar.php';
?>


  <!-- content -->
  <div class="container my-5">
    <div class="mb-5 d-flex justify-content-between">
      <h4>Finish Appointment Form</h4>
    </div>

    <div class="mb-5 alert alert-danger alert-dismissible fade show" role="alert">
      <!-- <p> -->
        <?php
          if ($err_msg != ""){
            echo $err_msg;
          }
        ?>
      <!-- </p> -->
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    
    <div>
        <!-- <form> -->
         <div class="container border border-dark p-4" style="border-top-width: 10px!important;">
         <form name="form" action="#" method="post">
           <!-- echo "<input name='test' value=".$row['test'].">"; -->
           <?php echo "<input type='hidden' id='apptID' name='apptID' value='".$apptID."'>"; ?>
           <?php echo "<input type='hidden' id='apptDate' name='apptDate' value='".$apptDate."'>"; ?>
           <?php echo "<input type='hidden' id='apptAgenda' name='apptAgenda' value='".$apptAgenda."'>"; ?>
           <?php echo "<input type='hidden' id='apptDoctorID' name='apptDoctorID' value='".$apptDoctorID."'>"; ?>
           <?php echo "<input type='hidden' id='apptPatientID' name='apptPatientID' value='".$apptPatientID."'>"; ?>
           
             <div class="mb-3 row">
                 <label for="toothCondition" class="col-sm-2 col-form-label">Tooth Condition: </label>
                 <div class="col-sm-10">
                     <input type="text" class="form-control" id="toothCondition" name="toothCondition" required 
                     value="<?=$toothCondition?>" />
                 </div>
             </div>
             <div class="mb-3 row">
                 <label for="diagnosis" class="col-sm-2 col-form-label">Diagnosis: </label>
                 <div class="col-sm-10">
                     <input type="text" class="form-control" id="diagnosis" name="diagnosis" required
                     value="<?=$diagnosis?>" />
                 </div>
             </div>
             <div class="mb-3 row">
                 <label for="medicationPrescribed" class="col-sm-2 col-form-label">Medication Prescribed</label>
                 <div class="col-sm-10">
                     <!-- <input type="text" class="form-control" id="medicationPrescribed" name="medicationPrescribed"> -->
                     <select name="medicationPrescribed" id="medicationPrescribed" class="form-select" required 
                      value="<?=$medicationPrescribedID?>">
                         <option selected value=""></option>
                         <?php
                            // GET THE LIST OF MEDICATIONS THAT A CLINIC HAS
                            $resultM = $conn->query("SELECT * FROM inventoryManagement");

                            while ($row = $resultM->fetch_assoc()) {
                                echo '<option value="';
                                // $fieldM = $row['prescriptionName'];
                                echo $row['ID'];
                                echo '">';
                                echo $row['prescriptionName'];
                                echo '</option>';
                            }
                          ?>
                     </select>
                 </div>
             </div>
             <div class="mb-3 row">
                 <label for="Quantity" class="col-sm-2 col-form-label">Quantity</label>
                 <div class="col-sm-10">
                     <input type="number" min="0" step="1" class="form-control" id="quantity" name="quantity" required 
                     value="<?=$quantity?>" />
                 </div>
             </div>
             <div class="mb-3 row">
                <label for="referTo" class="col-sm-2 col-form-label">Refer To (Other Clinic)</label>
                <div class="col-sm-10">
                     <select name="referTo" id="referTo" class="form-select" required value="<?=$referredTo?>">
                         <option selected value=""></option>
                         <?php
                            // GET THE LIST OF CLINICS
                            $resultBO = $conn->query("SELECT * FROM businessOwner");

                            while ($row = $resultBO->fetch_assoc()) {
                                echo '<option value="';

                                $fieldNOC = $row['nameOfClinic'];
                                echo $fieldNOC;

                                echo '">';

                                echo $fieldNOC;
                                echo '</option>';
                            }

                          ?>
                     </select>
                </div>
             </div>
             <div class="mb-3 row">
                 <label for="comments" class="col-sm-2 col-form-label">Comments</label>
                 <div class="col-sm-10">
                     <textarea rows="4" class="form-control" id="comments" name="comments" required value="<?=$comments?>"></textarea>
                 </div>
             </div>
             <div class="mb-3 row">
                 <div class="text-center"><button type="submit" class="btn btn-dark mt-4 px-5" value="submit" name="submit">Finish</button></div>
             </div>
         </form>
     </div>
        <!-- </form> -->
    </div>
  </div>

  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>
</html>
