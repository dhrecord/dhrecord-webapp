<?php
	session_start();
  	if(!isset($_SESSION['loggedin']))
  	{
    		header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    		exit;
  	}

	//$ID = 'default';
	$prescriptionName = $_POST['prescriptionName'];
	$prescriptionDesc = $_POST['prescriptionDesc'];
	$prescriptionQty = $_POST['Quantity'];
	$prescriptionPrice = $_POST['prescriptionPrice'];
	$Remarks = $_POST['Remarks'];

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
	$Error = "";
	//inserting data
    if (empty($_POST["prescriptionName"])) {
    $Error = $Error."*Prescription name is required<br>";
    $status = "false";
    } 
    
    if (empty($_POST["prescriptionDesc"])) {
    $Error = $Error."*Prescription description is required<br>";
    $status = "false";
    } 
    
    if (empty($_POST["Quantity"])) {
    $Error = $Error."*Quantity is required<br>";
    $status = "false";
    } 
    
    if (empty($_POST["prescriptionPrice"])) {
    $Error = $Error."*Prescription price is required<br>";
    $status = "false";
    } 
    
    if (empty($_POST["Remarks"])) {
    $Error = $Error."*Remarks is required<br>";
    $status = "false";
    } 
    
    
    if($status=="false"){ 
        echo "<font face='Verdana' size='2' color=red>$Error</font><br><input type='button' value='Go back' onClick='history.go(-1)'>";}
    //if ($status =="true"){
    else{
    	if ($stmt = mysqli_prepare($conn, "insert into `inventoryManagement`(`prescriptionName`,`prescriptionDesc`,`prescriptionQty`,`prescriptionPrice`,`Remarks`) values (?, ?, ?, ?, ?)")) 
    	//if ($stmt = mysqli_prepare($conn, "insert into inventoryManagement(prescriptionName, prescriptionDesc, prescriptionQty, Remarks) values (?, ?, ?, ?)"))
    	{
    		
    		mysqli_stmt_bind_param($stmt, "ssids",$prescriptionName, $prescriptionDesc, $prescriptionQty, $prescriptionPrice, $Remarks);
    		mysqli_stmt_execute($stmt);
    
    		header("Location: http://dhrecord.com/dhrecord/businessowner/html/inventoryManagement.php");
    		mysqli_close($conn);
        }
    }

   //if ($stmt) { echo "success"; mysqli_close($conn); } else { echo "error"; mysqli_close($conn); }
  
	   //if(!empty($_POST['prescriptionName']) && !empty($_POST['prescriptionDesc']) && !empty($_POST['Quantity']) && !empty($_POST['Remarks'])) {

	    	

		   
 

?>
