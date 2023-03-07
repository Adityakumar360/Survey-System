<?php
include '../configuration/connection.php';
include ROOT_PATH . 'controller/user_controller.php';
include ROOT_PATH . 'Templets/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php

  if (isset($_SESSION['userupdatemsg'])) {
    ?>
    <div class="mydiv alert alert-success" role="alert">
      <b>
        <?= $_SESSION['userupdatemsg']; ?>
      </b>
    </div>
    <?php
    unset($_SESSION['userupdatemsg']);
  }

  if (isset($_SESSION['userdeletemsg'])) {
    ?>
    <div class="mydiv alert alert-danger" role="alert">
      <b>
        <?= $_SESSION['userdeletemsg']; ?>
      </b>
    </div>
    <?php
    unset($_SESSION['userdeletemsg']);
  }

  ?>
<div>
<button onclick="history.back()" style="font-size:20px; background-color:white;border-width:0px;"><i class="fa-solid fa-arrow-left-long"></i> Back</button>
</div>
  <a href="user.php"> <button class="btn7"><b>+</b> Add new User</button></a>
  <h3 style="text-align:center;font-style:italic;">User List</h3>

  <!-- Data Table -->
  <div class="tble p-3" style="width:100%;">
    <table class="table table-hover cell-border p-3" id="myTable">
      <thead style="background-color: #1f8585; color:white;">
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Role</th>
          <th scope="col">Name</th>
          <th scope="col">Gender</th>
          <th scope="col">Email_ID</th>
          <th scope="col">Phone NO.</th>
          <th scope="col">Operation</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $user = new user;
        $result = $user->activeuserinfo(); 
        $count = 0;
        while ($row = $result->fetch_assoc()) {
          $count++;
          echo "<tr>
    <td><b>$count.</b></td>
    <td>" . $row["Type"] . "</td>
    <td>" . $row["user_name"] . "</td>
    <td>" . $row["Gender"] . "</td>
    <td>" . $row["user_email"] . "</td>
    <td>" . $row["Phone_No"] . "</td>" ?>
          <td>
            <?php
            if ($row['user_email'] == @$_SESSION['user_mail']) {
              ?>
              &emsp;<a href='../user/update_user.php?user_id=<?= $row['user_id']; ?>'><i class="fa-solid fa-pen-to-square"
                  style="color:grey" title="Update Information"></i></a>
            <?php 
            } else {
              if (@$_SESSION['user_type'] == "Admin") {
                ?>
                &emsp;<a href='../user/update_user.php?user_id=<?= $row['user_id']; ?>'><i class="fa-solid fa-pen-to-square"
                    style="color:grey" title="Update Information"></i></a>
                &emsp;<a href='../user/delete.php?user_id=<?= $row['user_id']; ?>'><i class="fa-solid fa-trash-can remove_btn"
                    style="color:red;" title="Delete User" onclick="return confirm('Are you Sure you want to delete this User !!!');"></a></i>
              <?php 
              } else {
                echo "Not Available";
              }
            }
            ?>
          </td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
  setTimeout(function () {
    $('.mydiv').fadeOut('fast');
  }, 1000);


  $(document).ready(function () {
    $('#myTable').DataTable({
      responsive: true

    });
  });

  
</script>

</html>