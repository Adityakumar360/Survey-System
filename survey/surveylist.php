<?php
include '../configuration/connection.php';
include ROOT_PATH . 'controller/survey_controller.php';
include ROOT_PATH . 'Templets/navbar.php';

$survey = new survey;
$id = $_SESSION['id'];

if (isset($_POST['filter'])) {
  $filter_status = $_REQUEST['filter-status'];
  $result = $survey->custom_filter($filter_status, $_SESSION['id']);
} else {
  $result = $survey->active_inactive_survey($_SESSION['id']);
}

?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

<div class="mydiv alert alert-success" role="alert" id="msg" style="display:none;">
 <b> Status Changed Successfully !</b>
</div>

<?php
if (isset($_SESSION['deletemsg'])) {
  ?>
  <div class="mydiv alert alert-danger" role="alert">
    <b>
      <?= $_SESSION['deletemsg']; ?>
    </b>
  </div>
  <?php
  unset($_SESSION['deletemsg']);
}
?>
<div>
  <button onclick="history.back()" style="font-size:20px; background-color:white;border-width:0px;"><i
      class="fa-solid fa-arrow-left-long"></i> Back</button>
</div>
<a href="../survey/newsurvey.php"><button class="btn7"> +&emsp;New Survey</button></a>
<h2 style="text-align:center;font-style:italic;"><u>Survey List</u></h2>

<form method="post">
  <!-- Table -->

  <div class="tble">
    <div class="post-search-panel m-3">
      <select id="sortby" name="filter-status" style="border-radius: 8px;width:auto;">
        <option value="All" <?=((isset($_POST['filter-status'])) && ($_POST['filter-status'] == "All") ? 'selected' : '') ?>>All</option>
        <option value="Active" <?=((isset($_POST['filter-status'])) && ($_POST['filter-status'] == "Active") ? 'selected' : '') ?>>Active</option>
        <option value="InActive" <?=((isset($_POST['filter-status'])) && ($_POST['filter-status'] == "InActive") ? 'selected' : '') ?>>Inactive</option>
        <option value="Expired" <?=((isset($_POST['filter-status'])) && ($_POST['filter-status'] == "Expired") ? 'selected' : '') ?>>Expired</option>
      </select>
      <button class="btn btn-sm p-1 m-1" style="background-color:#0fad92;" type="submit" id="filter-button"
        name="filter">Sort By Status</button>
    </div>

    <table class="table table-hover cell-border  p-3" cellspacing="0" id="myTable">
      <thead style="background-color: #1f8585; color:white;">
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Survey_title</th>
          <th scope="col" style="width:30%">Survey_description</th>
          <th scope="col" style="width:8%;">Survey_category</th>
          <th scope="col" style="width:15%;">Date</th>
          <th scope="col" style="width:10%;">Status</th>
          <th scope="col" style="width: 12%;">Operations</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $curr_date = date("Y-m-d");
        $count = 0;
        while ($row = $result->fetch_assoc()) {
          $count++;
          echo "<tr>
    <td><b>$count.</b></td>
    <td>" . $row["Survey_title"] . "</td>
    <td>" . $row["Survey_description"] . "</td>
    <td>" . $row["Survey_Category"] . "</td>
    <td><b>Start Date: </b>" . date('d-m-Y', strtotime($row["survey_start_Date"])) . "<br><b>End Date: </b>" . date('d-m-Y', strtotime($row["survey_end_date"])) . "</td>"
            ?>
          <td>
            <?php
            if ($row['survey_status'] == 'Expired') {
              echo "EXPIRED";
            } else {
              ?>
              <input class="status1 form-check-input" type="radio" name="<?= $row['Survey_id'] ?>"
                id="<?= $row['Survey_id'] ?>" value="Active" <?=($row['survey_status'] == 'Active') ? "checked" : ""; ?>><b>Active</b>
              <br>
              <input class="status1 form-check-input" type="radio" name="<?= $row['Survey_id'] ?>"
                id="<?= $row['Survey_id'] ?>" value="InActive" <?=($row['survey_status'] == 'InActive') ? "checked" : ""; ?>><b>Inactive</b>
              <?php
            }
            ?>
            <input type="hidden" name="txt" value="<?= $row['Survey_id']; ?>" id="txtstatus">
          </td>
          <td>
            <?php
            if ($row['survey_status'] == 'Expired') { ?>
              <div class="col mx-3">
                <a href='../questions/question.php?Survey_id=<?= $row['Survey_id']; ?>'><i
                    class="fa-solid fa-eye inactivebtn m-1" title="View Survey" style="color: #0A6859;"></i></a>
                <a href='../survey/surveydelete.php?Survey_id=<?= $row['Survey_id']; ?>'><i
                    class="fa-solid fa-trash-can m-1" style="color: red;" title="Delete Survey"
                    onclick="return confirm('Are you Sure you want to delete this Survey !!!');"></a></i>
              </div>

              <?php
            } else if ($row['survey_status'] == 'Active') {
              ?>

                <div class="col">
                  <a href='../survey/updatesurvey.php?Survey_id=<?= $row['Survey_id']; ?>'><i
                      class="fa-solid fa-pen-to-square inactivebtn m-2" title="Edit Survey" style="color: black;"></i></a>

                  <a href='../questions/question.php?Survey_id=<?= $row['Survey_id']; ?>'><i
                      class="fa-solid fa-eye inactivebtn m-1" title="View Survey" style="color: #0A6859;"></i></a>

                  <a href='../survey/surveydelete.php?Survey_id=<?= $row['Survey_id']; ?>'><i
                      class="fa-solid fa-trash-can m-1" style="color: red;" title="Delete Survey"
                      onclick="return confirm('Are you Sure you want to delete this Survey !!!');"></a></i>
                </div>
                <a href="../survey/expiresurvey.php?Survey_id=<?= $row['Survey_id']; ?>"><button type="button" class="btn m-1"
                    style="border:1px groove black;color:black;background-color:silver;"
                    onclick="return confirm('Are you Sure you want to Expire this Survey !!!');">Expire Survey</button></a>
              <?php
            } else {
              ?>
                <div style="text-align:center;">
                  <a href='../survey/surveydelete.php?Survey_id=<?= $row['Survey_id']; ?>'><i class="fa-solid fa-trash-can"
                      style="color: red;" title="Delete Survey"
                      onclick="return confirm('Are you Sure you want to delete this Survey !!!');"></a></i>
                </div>

              <?php
            }
            echo "</td>";
            echo "</tr>";
        } ?>
      </tbody>
    </table>
  </div>
</form>
<script src="../jquery-3.6.2.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
  // Datatable pagination
  $(document).ready(function () {

    $('#myTable').DataTable({
      "responsive": true,
      "pageLength": 5,
      "lengthChange": false
    });

    // Status 
    $(".status1").click(function () {
      var btnid = this.id;
      var status = $("input[name='" + btnid + "']:checked").val();

      $.ajax({
        type: "POST",
        url: "../survey/status.php",
        data: {
          name: status,
          id: btnid
        },
        success: function (data) {
          $('#msg').fadeIn('slow');
          $('#msg').delay(1000).fadeOut('slow');

          setTimeout(function () {
            window.location.reload();
          }, 1000);
        }
      });
    });
  });

  setTimeout(function () {
    $('.mydiv').fadeOut('fast');
  }, 1500);

  $(document).ready(function () {
    $('#myTable').DataTable();
  });
</script>