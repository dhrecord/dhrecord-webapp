<?php
  session_start();
  if(!isset($_SESSION['loggedin']))
  {
    header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
    exit;
  }

  $sessionID = $_SESSION['id'];
  
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

  $query = "SELECT * FROM users WHERE ID=$sessionID";
  $userInfo = mysqli_query($conn,$query);
  $row = $userInfo->fetch_assoc();
  
  $userID = $row['ID'];
  $userName = $row['username'];
  $passWord = $row['password'];

  // Store the cipher method
  $ciphering = "AES-128-CTR";
  
  // Use OpenSSl Encryption method
  $iv_length = openssl_cipher_iv_length($ciphering);
  $options = 0;

  // Non-NULL Initialization Vector for encryption
  $encryption_iv = '1234567891011121';

  // Store the encryption key
  $encryption_key = "JovenChanDunCry";

  // Non-NULL Initialization Vector for decryption
  $decryption_iv = '1234567891011121';
  
  // Store the decryption key
  $decryption_key = "JovenChanDunCry";

  $decryptedPassword = openssl_decrypt($passWord, $ciphering, $decryption_key, $options, $decryption_iv);
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
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <!-- navbar -->
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
            <a class="nav-link" aria-current="page" href="../html/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../html/apptScheduling.php">Appointment Scheduling</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../html/referralTracking.php">Referral Tracking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../html/surveyAndFeedback.php">Survey & Feedback</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../html/treatmentHistory.php">Treatment History</a>
          </li>
        </ul>
        <div class="d-flex flex-column align-items-end">
          <p class="navbar-text text-white m-0">
            Welcome, <?php echo $_SESSION['username']; ?>
          </p>
          <button type="button" class="btn btn-light ml-3 btn-sm mb-2" style="width: 90px;"
            onclick="document.location.href='../../LoginUnregisteredPatient/LoginPage/logout.php'">Logout</button>
        </div>
      </div>
    </div>
  </nav>
    

    <!-- content -->
    <div class="container my-5">
        <h4 class="mb-4">Change Password</h4>
        <form action="./toChange.php" method="POST">
            <div class="container border border-dark p-4" style="border-top-width: 10px!important;">
                <div class="mb-3 row">
                    <label for="userID" class="col-sm-2 col-form-label">User ID</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="userID" name="userID" <?php echo 'value = "'.$userID. '"'; ?> readonly> 
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="userName" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="userName" name="userName" <?php echo 'value = "'.$userName. '"'; ?> readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="passWord" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <!--<input type="password" class="form-control" id="passWord" name="passWord"  <?php echo 'value = "'.$passWord. '"'; ?> readonly>-->
                        <input type="password" class="form-control" id="passWord" name="passWord"  <?php echo 'value = "'.$decryptedPassword. '"'; ?> readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="newPassWord" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="newPassWord" name="newPassWord">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="confirmNewPassWord" class="col-sm-2 col-form-label">Confirm New Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="confirmNewPassWord" name="confirmNewPassWord">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="text-center"><button type="submit" class="btn btn-dark mt-4 px-5">Submit</button></div>
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