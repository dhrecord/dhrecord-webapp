<?php

    session_start();
    if(!isset($_SESSION['loggedin']))
    {
        header('Location: ../../LoginUnregisteredPatient/LoginPage/index.html');
        exit;
    }

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
<?php
    include 'navBar.php';
?>


  <main class="container my-5">
    <div class="bg-light p-5 rounded mt-3">
      <hr>
      <h4 class="lead">Hi, <?php echo $_SESSION['username']; ?>!</h4>
      <h4 class="lead">Role:
          <?php 
              if ($role === "ca")
              {
                  echo "Clinic Admin";
              } else if ($role === "dr")
              {
                  echo "Doctor";
              } else
              {
                  echo "Front-desk";
              }
         ?>
      </h4>
      <hr>
      <p class="mx-2 mt-3" style="font-size: 1.1rem; margin-bottom: 0.5rem; line-height: 1.2;"><button class="btn btn-secondary" onclick="window.location.href='./changeUsernameOrPasswordBusinessOwner.php';">Change Password</button></p>
      <!-- <a class="btn btn-lg btn-primary" href="/docs/5.0/components/navbar/" role="button">View navbar docs &raquo;</a> -->
    </div>
  </main>


  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>
