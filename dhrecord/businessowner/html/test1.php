<?php
	require_once("connection.php");

    $ID = $_GET['GetID'];
    $query = "select * from `inventoryManagement` where ID='".$ID."'";
    $result = mysqli_query($conn,$query);

    while($res=mysqli_fetch_assoc($result))
    {
        $ID = $res['ID'];
        $prescriptionName = $res['prescriptionName'];
	    $prescriptionDesc = $res['prescriptionDesc'];
	    $prescriptionQty = $res['prescriptionQty'];
	    $Remarks = $res['Remarks'];
        
    }
?>

<body>


    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-4">Inventory Management (Edit Prescription)</h4>
        <form method="post" action="">
            <div class="container border border-dark p-4" style="border-top-width: 10px!important;">
                <div class="mb-3 row">
                    <label for="contactNumber" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="Quantity" name="Quantity" value= "<?php echo $prescriptionQty ?>">
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="text-center"><button type="submit" class="btn btn-dark mt-4 px-5" name="update">Update</button></div>
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
    $newQty = $prescriptionQty -1;
	$queryy = "UPDATE `inventoryManagement` SET prescriptionQty = '".$newQty."' WHERE ID= '".$ID."'";
	$result1 = mysqli_query($conn,$queryy) or die (mysqli_error());

	if($result1)
	{
		header("location:inventoryManagement.php");
	}
	else
	{
		echo "please check your query"; 
	}

}



?>