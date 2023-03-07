<?php
include 'Templets/navbar.php';
// include 'Templets/side_top.php';
include 'configuration/connection.php';
include 'controller/dashboard_controller.php';

$dash = new dashboard;

$res = $dash->surveyinfo($_SESSION['id']);
?>

<?php

if (!empty($_SESSION['logged_in'])) {
   
    if(!empty($_SESSION['msg'])) {
        echo "<div class='mydiv alert alert-success' role='alert'><b>".$_SESSION['msg']."</b></div>"; 
        unset($_SESSION['msg']);
    }
}
?>

<div class="row">
    <div class="card totalsurvey bg-light m-4" style="max-width: 15rem;font-weight:bold;">
        <div class="card-header"><b>Total SURVEY </b>
            <a href="../report/totalsurvey.php"><i class="fa-solid fa-chart-pie mx-3" title="Total Survey"></i></a>
        </div>
        <div class="card-body d-flex align-items-center justify-content-center">
            <p style="margin:10px;"> Number of Survey Conducted :</p>
            <p style="font-size: x-large;margin-bottom: inherit;"><b>
                    <?= $res['total']; ?></label>
                </b></p>
        </div>
    </div>
    <?php if ($_SESSION['user_type'] == 'Admin') {
        ?>
        <div class="card totaluser bg-light m-4" style="max-width: 15rem;font-weight: bold;">
            <div class="card-header"><b>Total Users </b>
                <a href="../report/totaluser.php"><i class="fa-solid fa-chart-pie mx-3" title="Total Users"></i></a>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <p style="margin:10px;"> Total Number of Users Created :</p>
                <p style="font-size: x-large;margin-bottom: inherit;"><b>
                        <?= $res['totaluser']; ?></label>
                    </b></p>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<div class="row">
    <div class="card activesurvey mb-3 m-3 text-white " style="max-width: 15rem;">
        <div class="card-header"><b>Number of Active Survey :</b></div>
        <div class="card-body d-flex align-items-center justify-content-center">
            <p style="text-align:center ; font-size: larger;"><b>
                    <?= $res['Activestatus']; ?></label>
                </b></p>
        </div>
    </div>
    <div class="card inactivesurvey mb-3 m-3 text-white" style="max-width: 15rem;">
        <div class="card-header"><b>Number of Inactive Survey :</b></div>
        <div class="card-body d-flex align-items-center justify-content-center">
            <p style="text-align:center ; font-size: larger;"><b>
                    <?= $res['inactivestatus']; ?></label>
                </b></p>
        </div>
    </div>

    <div class="card expiredsurvey mb-3 m-3 text-white" style="max-width: 15rem;">
        <div class="card-header"><b>Number of Expired Survey :</b></div>
        <div class="card-body d-flex align-items-center justify-content-center">
            <p style="text-align:center ; font-size: larger;"><b><?= $res['expiredstatus']; ?></label></b></p>
        </div>
    </div>

    <div class="card deletedsurvey mb-3 m-3 text-white" style="max-width: 15rem;">
        <div class="card-header"><b>Number of Deleted Survey :</b></div>
        <div class="card-body d-flex align-items-center justify-content-center">
            <p style="text-align:center ; font-size: larger;"><b>
                    <?= $res['deletedstatus']; ?></label>
                </b></p>
        </div>
    </div>
</div>

<br>
<p style="font-weight:bolder;font-size:x-large;margin-left:5%;"><u>Active Survey's:</u></p>
<div class="row" style="margin:10px;">
    <?php
    $result = $dash->active_survey($_SESSION['id']);
    if (mysqli_num_rows($result) > 0) {
        while ($arr = mysqli_fetch_assoc($result)):

            $inviteresult = $dash->invite_count($arr['Survey_id']);
            while ($res = mysqli_fetch_assoc($inviteresult)):
                ?>
                <div class="card bg-light  m-3" style="max-width: 20rem;;">
                    <div class="card-header">
                        <div style="border:ridge;margin:5px;padding:3px; background-color: lavender;">
                            <b> Invitation: </b>
                            <?=@$res['num']; ?>
                        </div>
                    </div>
                    <div class="card-body d-flex  justify-content-center">
                        <div>
                            <p style="font-size:1.5em ;"><b><?=@$arr['Survey_title']; ?></b></p>
                            <p>
                                <?=@$arr['Survey_description']; ?>
                            </p>
                            <br>
                        </div>
                    </div>
                    <div style="margin-bottom: inherit;">
                        <a href="../report/graph.php?sid=<?= $arr['Survey_id'] ?>"><button title="View Tabular Report"
                                class="viewbtn mb-2">Graphical Report</button></a>
                        <a href="../report/view_report.php?sid=<?= $arr['Survey_id'] ?>"><button title="View Tabular Report"
                                class="tabbtn">Tabular Report</button></a>
                    </div>
                </div>
                <?php
            endwhile;
        endwhile;
    } else {
        echo "<div class='alert alert-warning' role='alert'>
    <b>No Active Survey!!</b>
  </div>";
    }
    ?>
</div>

<script src="../jquery-3.6.2.min.js"></script>

<script>
    setTimeout(function () {
        $('.mydiv').fadeOut('fast');
    }, 1000);
</script>
<?php
// include 'Templets/side_footer.php';
?>