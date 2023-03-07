<?php
session_start();
include '../configuration/connection.php';
include ROOT_PATH . 'controller/user_controller.php';

$user = new user();

if (isset($_REQUEST['submit'])) {
    extract($_REQUEST);

    $mailresult = $user->get_mail_login($email);
    if ($mailresult) {
        $result = $user->login_successfull($email, sha1(trim($password)));

       if(!empty( $_SESSION["logged_in"])){
          // print_r("hi");die;
          // print_r($_SESSION);die;

          header("location:../dashboard.php");
          exit();
        }

        
    }
}
?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Survey Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="#">
</head>

<body>
  <nav class="navbar navbar-light" style="background-color: #54c4a2;">
    <span class="navbar-brand mb-0 h1" style="font-weight:bold; font-size:30px;padding:8px 12px; margin-left:10px;">Survey System</span>
  </nav>
  <div class="container h-75 d-flex align-items-center justify-content-center" style="width:fit-content;">

    <form class="rounded bg-white shadow p-5" onsubmit="return vallogin();" method="POST">
      <h3 class="text-dark fw-bold fs-5">Sign In to Survey System</h3>

      <div class="form-floating mb-3">

        <input type="text" class="form-control " id="usermail" name="email" placeholder="name@example.com">
        <label for="floatinginput">Email address</label>
        <span id="username" class="text-danger "></span>
      </div>

      <div class="form-floating">
        <input type="password" class="form-control" name="password" id="pass" placeholder="Password">
        <label for="password">Password</label>
        <span id="passwords" class="text-danger "></span>
        <br>
        <input type="checkbox" onclick="myFunction()"> &nbsp;Show Password
      </div>

      <button type="submit" name="submit" class="btn submit_btn w-100 my-4 text-white" style="background-color:#198072 ;"> Continue</button>
    </form>
  </div>

  <script src="../js/val.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script>
    function myFunction() {
      var x = document.getElementById("pass");
      x.type = (x.type === "password") ? "text" : "password";

    }

    setTimeout(function() {
      $('.mydiv').fadeOut('slow');
    }, 1000);
  </script>
</body>

</html>