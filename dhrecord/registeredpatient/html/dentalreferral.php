<?php
session_start();
if(!isset($_SESSION['loggedin']))
  {
    header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    exit;
  }


$servername = "localhost";
$database = "u922342007_Test";
$username = "u922342007_admin";
$password = "Aylm@012";
$conn = mysqli_connect($servername, $username, $password, $database);

$referralID = $_GET['ID'];

$res = ("SELECT referralTracking.ID, referralTracking.referredTo, referralTracking.referralDate, referralTracking.toothCondition, referralTracking.comments,
registeredPatient.fullName AS ptName,  registeredPatient.nricNumber, registeredPatient.contactNumber, registeredPatient.address, registeredPatient.medConditions, 
registeredPatient.drugAllergies, doctor.fullName AS docName FROM referralTracking, registeredPatient, doctor, users 
WHERE users.ID = '{$_SESSION['id']}' AND users.ID = registeredPatient.users_ID AND registeredPatient.ID = referralTracking.patient_ID 
AND referralTracking.referringDoctor = doctor.doctorID AND referralTracking.ID = '{$referralID}'");

$result = mysqli_query($conn, $res);

 while($sql = mysqli_fetch_assoc($result))
    {
     $name = $sql["ptName"];
     $nric = $sql["nricNumber"];
     $hp = $sql["contactNumber"];
     $addr = $sql["address"];
     $mc = $sql["medConditions"];
     $da = $sql["drugAllergies"];
     $referredTo = $sql["referredTo"];
     $referralDate = $sql["referralDate"];
     $referringDoc = $sql["docName"];
     $toothCondi = $sql["toothCondition"];
     $comments = $sql["comments"];
   }


require_once(__DIR__.'/../dompdf/autoload.inc.php');

use Dompdf\Dompdf;


// instantiate and use the dompdf class]
$dompdf = new Dompdf();


date_default_timezone_set('Asia/Singapore');
$date =  date("d/m/y g:i a");
echo $date;


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
            <h4>Referral:</h4>
                <tr>
                    <td>Patient's Name: " . $name . "<br>
                        Patient's Address:<br>
                        <p>" .$addr. "<br>
                        </p>
                    </td>
                    <td>
                        NRIC: " . $nric . "
                    </td>
                </tr>
                <tr>
                    <td>Contact Number: " . $hp . "</td>
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
                <h4>To:</h4>
                <tr>
                    <th>Person</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Department \ Sub-Specialty</th>
                    <td>
                        " . $referredTo . "<br>
                    </td>
                </tr>
                <tr>
                    <th>Referring Doctor</th>
                    <td>
                        " . $referringDoc . "
                    </td>
                </tr>
                <tr>
                    <th>Referral Date</th>
                    <td>
                        " . $referralDate . "
                    </td>
                </tr>
                <tr>
                    <th>Tooth Condition</th>
                    <td>
                        " . $toothCondi . "
                    </td>
                </tr>
            </table>
        </section>
        <section class='comments'>
            <h4>Comments:</h4>
            <div class='comment-group'>
                <p>" . $comments . "</p>
            </div>
        </section>
        
    </main>
    
    <footer>
        <p id='printDate'>  Printed on
        " . $date . "</p>
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
