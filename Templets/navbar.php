<?php
session_start();
// print_r($_SESSION);die;

if (!isset($_SESSION['logged_in'])) {
  header('location:../signin/login.php');
  exit;
}

?>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Survey System</title>

  <link rel="shortcut icon" href="#">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
  <nav class="navbar navbar-expand-lg bg-opacity-25" style="background-color:#50CDC0;">
    <div class="container-fluid">
      <a class="navbar-brand link-light">Survey System &emsp;</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link active" href="../dashboard.php">Dashboard</a>
          </li>

          <?php
          if ($_SESSION['user_type'] == "Admin") {
          ?>
            <li class="nav-item dropdown">
              <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Users
              </a>

              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="../user/user.php">Add New </a></li>
                <li><a class="dropdown-item" href="../user/userlist.php">List</a></li>
              </ul>
            </li>
          <?php
          }
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Survey
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="../survey/newsurvey.php">New Survey </a></li>
              <li><a class="dropdown-item" href="../survey/surveylist.php">Survey List</a></li>
            </ul>
          </li>
        </ul>
        <div class="dropdown">
          <a href="#" class="text-black text-decoration-none dropdown-toggle" id="dropdownUser1" style="margin-right:85px;" data-bs-toggle="dropdown" aria-expanded="true">
            <label class="d-lg-inline " style="font-weight: bold;"><?php echo $_SESSION['user_name']; ?></label>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="../user/profile.php">My Profile</a></li>
            <hr class="dropdown-divider">
            <li><a class="dropdown-item" href="../signin/logout.php">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</body>
<script src="../jquery-3.6.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="../js/newsurvey.js"></script>
<script src="../js/newuser.js"></script>
<script src="../js/question.js"></script>
<script src="../js/invitation.js"></script>
<script src="../js/changepass.js"></script>


<script>
   $(document).ready(function () {
             $('#sidebarCollapse').on('click', function () {
                 $('#sidebar').toggleClass('active');
             });
         });


</script>
</html>