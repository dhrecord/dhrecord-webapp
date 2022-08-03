<?php
require_once '../dompdf\autoload.inc.php';

use Dompdf\Dompdf;


// instantiate and use the dompdf class]
$dompdf = new Dompdf();



date_default_timezone_set('Asia/Singapore');
$date =  date("d/m/y g:i a");
echo $date;
//Get variable values from sql
$name = "Bryan Ong";
$homeStreet = "ba ba blacksheep";
$homeUnit = "#03-03";
$homePostalCode = "Singapore 390012";
$dob = "09/07/1999";
$phoneNumber = "9876 5432";
$sex = "F";
$referringDoctor = "SIM, SETH TAN [P2695J]";
$referredClinic = "Allergy Clinic";
$institution = "National University Hospital";
$referralReason = "NUH Adult Allergy Clinic for drug allergy testing";
$referralType = "Subsidized referral if eligible";
$schedulingInstructions = "Routine";
$diagnosis = "The encounter diagnosis was Allergic drug reaction";
$activeProblem = "2021-12: Viral exanthem";
$allergies = "She is allergic to amoxicillin, clavulanic acid, and etoricoxib";

$img = "";

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
    display: none;
}

footer {

    position: absolute;
    bottom: 0;
    width: 100%;
    height: 60px;
    /* Height of the footer */
    border-top: 0.5px solid grey;
}

@media print {
    #printDate {
        display: inline;
    }
}
</style>
<body>
    <header>
        <img src='logo.jpg' alt='logo'>
        <h2>DH Record</h2>

    </header>
    <main>
    <section>
        <table class='patient-details'>
            <h4>Referral:</h4>
                <tr>
                    <td>Patient's Name: " . $name . "<br>
                        Patient's Address:<br>
                        <p>" . $homeStreet . "<br>
                        " . $homeUnit . "<br>
                        " . $homePostalCode . "</p>
                    </td>
                    <td>
                        MRN: <br>
                        DOB: " . $dob . "
                    </td>
                </tr>
                <tr>
                    <td>Contact Number: " . $phoneNumber . "</td>
                    <td>Sex: " . $sex . "</td>
                </tr>
                <tr>
                    <td>Referring Doctor: <br>
                    " . $referringDoctor . "
                    </td>
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
                        " . $referredClinic . "<br>
                        " . $referralReason . "
                    </td>
                </tr>
                <tr>
                    <th>Institution</th>
                    <td>
                       " . $institution . "
                    </td>
                </tr>
                <tr>
                    <th>Reason for Referral</th>
                    <td>
                        " . $referralReason . "
                    </td>
                </tr>
                <tr>
                    <th>Referral Type</th>
                    <td>
                        " . $referralType . "
                    </td>
                </tr>
                <tr>
                    <th>Scheduling instructions</th>
                    <td>
                        " . $schedulingInstructions . "
                    </td>
                </tr>

            </table>
        </section>
        <section class='comments'>
            <h4>Comments:</h4>
            <div class='comment-group'>
                Diagnoses:<br>
                <p>" . $diagnosis . "</p>
            </div>
            <div class='comment-group'>
                Active Problem List<br>
                " . $activeProblem . "
            </div>
            <div class='comment-group'>
                Allergies<br>
                <p>" . $allergies . "</p>
            </div>
        </section>
        
    </main>
    
    <footer>
    <address>
            <p> Company name, street name, Singapore postal code</p><br>
        </address>
        <p id='printDate'>printed on
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
