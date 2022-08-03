<?php


	require_once("connection.php");

    //$ID = $_GET['GetID'];
    $query = "select * from `inventoryManagement` WHERE ID = '".$prescriptionID."'";
    $result = mysqli_query($conn,$query);
    

    while($res=mysqli_fetch_assoc($result))
    {
        $ID = $res['ID'];
        $prescriptionName = $res['prescriptionName'];
	    $prescriptionDesc = $res['prescriptionDesc'];
	    $prescriptionQty = $res['prescriptionQty'];
	    $Remarks = $res['Remarks'];
        
        
    }
    $queryusers = "SELECT * FROM `inventoryManagement`";
                            $query1 = mysqli_query($conn, $queryusers) or die (mysqli_error());
                            
                            
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DHRecord</title>
    <link rel="stylesheet" href="../css/style.css" />

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jquery -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>


    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-4">Dispense Prescription </h4>
        <form method="post" action="">
            <div class="container border border-dark p-4" style="border-top-width: 10px!important;">
                <div class="mb-3 row">
                    <label for="contactNumber" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="Quantity" name="Quantity" value= ""/>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="text-center"><button type="submit" class="btn btn-dark mt-4 px-5" name="update">Update</button></div>
                    
                <div class="label">Select Prescription:</div>
                <select username="prescription" name="prescription">
                <option value = "">---Select---</option>
                <?php
                while($d = mysqli_fetch_assoc($query1)) 
                {
                echo "<option value='{".$d['ID']."}'>".$d['prescriptionName']."</option>";
                }   
                echo "</select>";
                ?>
                </div>
            </div>
        </form>
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
<?php

	//require_once("connection.php");	

if(isset($_POST['update']))
{
    
    $prescription = $_POST['prescription'];
    $string1 = str_replace("{","",$prescription);
    $prescriptionID = str_replace("}","",$string1);
    $Quantity = $_POST['Quantity'];
    $newQty = $prescriptionQty - $Quantity;
    
    //$query = "select * from `inventoryManagement`";
    //$result = mysqli_query($conn,$query);
    
    //$query3 = "select * from `inventoryManagement` WHERE ID = '".$prescriptionID."'";
    //$result3 = mysqli_query($conn,$query);
    
	//$queryy = "UPDATE `inventoryManagement` SET prescriptionQty = '".$newQty."' WHERE ID= '".$prescriptionID."'";
	//$result1 = mysqli_query($conn,$queryy) or die (mysqli_error());
    
	if($result3)
	{
	    
		echo "PrescriptionQty:  ";
		echo $prescriptionQty;
		echo "<br/>";
		echo "PrescriptionID:  ";
		echo $prescriptionID;
		echo "<br/>";
		echo "Quantity:  ";
		echo $Quantity;
		echo "<br/>";
		echo "newQty:  ";
	    echo $newQty;
	    //$Quantity = $_POST['Quantity'];
        //$newQty = $prescriptionQty - $Quantity;
        //echo $newQty;
		//header("location:inventoryManagement.php");
	}
	else
	{
		echo "please check your query</br>";
		echo "PrescriptionQty:  ";
		echo $prescriptionQty1;
		echo "<br/>";
		echo "PrescriptionID:  ";
		echo $prescriptionID;
		echo "<br/>";
		echo "Quantity:  ";
		echo $Quantity;
		echo "<br/>";
		echo "newQty:  ";
	    echo $newQty;
	}

}



?>