<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
 <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  
<div class="wrapper">

        <!-- Sidebar  -->
        <nav id="sidebar">
            <a href="../survey/newsurvey.php"><button class="btn m-2" style="background-color:#138579;color:black;">+ New Survey</button></a>
        </nav>

        <!-- Page Content  -->
        <div id="content">
        <div >
    <button onclick="history.back()" style="font-size:20px; background-color:white;border-width:0px;"><i class="fa-solid fa-arrow-left-long"></i> Back</button>
</div>
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn" style="background-color: #b2c3bf;">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                </div>
            </nav>