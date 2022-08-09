<?php
session_start();
if(!isset($_SESSION['loggedin']))
  {
    header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    exit;
  }

require_once("connection.php");

$ID = $_GET['ID'];

 if ($res1 = $conn->query($res))
                    while($obj = $res1->fetch_assoc())
                        {
                            $doctorID = $obj["attendingDoctor"];
                            $query1 = "SELECT * FROM doctor WHERE doctorID = $doctorID";
                            $res2 = $conn->query($query1);
                            $obj1 = $res2->fetch_assoc();

                            $doctorName = $obj1['fullName'];                            
                            
                            $PT_ID = $obj["pt_ID"];
                            $query2 = "SELECT * FROM registeredPatient WHERE ID = $PT_ID";
                            $res3 = $conn->query($query2);
                            $obj2 = $res3->fetch_assoc();

                            $name = $obj2['fullName']; 
                            $nric = $obj2['nricNumber']; 
                            $hp = $obj2['contactNumber']; 
                            $email = $obj2['email']; 
                            $address = $obj2['address']; 
                            $pCode = $obj2['postalCode']; 
                            $mc = $obj2['medConditions']; 
                            $da = $obj2['drugAllergies']; 
                            

                            $ID = $obj['ID'];
                            $date = $obj['date'];
	                        //$attendingDoctor = $obj['attendingDoctor'];
	                        //$fullName = $obj1['fullName'];
	                        //$fullName1 = $obj2['fullName'];
	                        //$pt_ID = $obj['pt_ID'];
                            $toothCondition = $obj['toothCondition']; 
	                        $diagnosis = $obj['diagnosis'];
                            $medicationPrescribed = $obj['medicationPrescribed'];
                            $quantity = $obj['quantity'];
                            $comments = $obj['comments'];
                        }



//$res = ("SELECT referralTracking.ID, referralTracking.referredTo, referralTracking.referralDate, referralTracking.toothCondition, referralTracking.comments,
//registeredPatient.fullName AS ptName,  registeredPatient.nricNumber, registeredPatient.contactNumber, registeredPatient.address, registeredPatient.medConditions, 
//registeredPatient.drugAllergies, doctor.fullName AS docName FROM referralTracking, registeredPatient, doctor, users 
//WHERE users.ID = '{$_SESSION['id']}' AND users.ID = registeredPatient.users_ID AND registeredPatient.ID = referralTracking.patient_ID 
//AND referralTracking.referringDoctor = doctor.doctorID AND referralTracking.ID = '{$referralID}'");

//$result = mysqli_query($conn, $res);

// while($sql = mysqli_fetch_assoc($result))
//    {
//     $name = $sql["ptName"];
//     $nric = $sql["nricNumber"];
//     $hp = $sql["contactNumber"];
//     $addr = $sql["address"];
//     $mc = $sql["medConditions"];
//     $da = $sql["drugAllergies"];
//     $referredTo = $sql["referredTo"];
//     $referralDate = $sql["referralDate"];
//     $referringDoc = $sql["docName"];
//     $toothCondi = $sql["toothCondition"];
//     $comments = $sql["comments"];
//   }


require_once(__DIR__.'/../dompdf/autoload.inc.php');

use Dompdf\Dompdf;


// instantiate and use the dompdf class]
$dompdf = new Dompdf();


date_default_timezone_set('Asia/Singapore');
$Cdate =  date("d/m/y g:i a");
echo $Cdate;

//Get variable values from sql
/*
$name = "Bryan Ong";
$address = ;
//$dob = "09/07/1999";
$phoneNumber = "9876 5432";
//$sex = "F";
$referringDoctor = "SIM, SETH TAN [P2695J]";
$referredClinic = "Allergy Clinic";
$institution = "National University Hospital";
$referralReason = "NUH Adult Allergy Clinic for drug allergy testing";
$referralType = "Subsidized referral if eligible";
$schedulingInstructions = "Routine";
$diagnosis = "The encounter diagnosis was Allergic drug reaction";
$activeProblem = "2021-12: Viral exanthem";
$allergies = "She is allergic to amoxicillin, clavulanic acid, and etoricoxib";
*/

$html = "  
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    height: 100vh;
    width: 100vw;
    font-size: 12px;
}

img {
    width: 80px;
    height: 80px;
}

p {
    margin: 0;
    padding: 0;
}



header {
    margin: 5px 0px 80px 20px;
    display: inline;

}

header h2 {
    margin-left: 80px;
    margin-top: -60px;
    margin-bottom: 60px;
}

main {
    height: 75%;
    margin: 15px 15px 60px 15px;
}


.patient-details {
    border-spacing: 40px 20px;
    max-width: 800px;
    margin-bottom: 10px;
}

.patient-details tr td {
    vertical-align: top;
}

.patient-details td:nth-child(2) {
    padding-left: 150px;
}

.sendTo table {
    border-spacing: 40px 5px;
}

.sendTo table th {
    text-align: left;
}

.sendTo table td {
    padding-left: 20px;
}

.comments {
    margin-top: 30px;
    margin-left: 40px;
}

.comment-group {
    margin-bottom: 30px;
}

#printDate {
    display: inline;
    margin-left: 5px;
}

footer {

    position: absolute;
    bottom: 0;
    width: 100%;
    height: 60px;
    /* Height of the footer */
    border-top: 0.5px solid grey;
}


</style>
<body>
    <header>
        <h2>DHRecord</h2>

    </header>
    <main>
    <section>
        <table class='patient-details'>
            <h4>Billing Summary:</h4>
                <tr>
                    <td>Patient's Name: " . $name . "<br>
                        Patient's Address:
                        <p>" .$addr. "<br></p>
                        
                    </td>
                    <td>
                        NRIC: " . $nric . " <br>
                        Contact Number: " . $hp . "
                    </td>
                </tr>                
                <tr>
                    <td>Medical Conditions: " . $mc . "</td>
                </tr>
                <tr>
                    <td>Drug Allergies: " . $da . "</td>
                </tr>
            </table>
            
        </section>
        <section class='sendTo'>
            <table>
                
                
                <tr>
                    <th>Medication Prescribed</th>                   
                    <td> <th>Quantity</th></td>
                </tr>
                <tr>
                    
                    <td>
                        " . $medicationPrescribed . "<br>
                    </td>
                    <td>
                        " . $quantity . " <br>                        
                    </td>
                </tr>
                <tr>
                    <th>Referring Doctor</th>
                    <td>
                        " . $referringDoc . "
                    </td>
                </tr>  

                <tr>
                    <th>Total Cost:</th>                   
                    <td> <th> " . $totalCost  . "</th></td>
                </tr>
            </table>
        </section>        
        
    </main>
    
    <footer>
        <p id='printDate'>  Printed on
        " . $Cdate . "</p>
    </footer>
</body>
";

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'potrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
