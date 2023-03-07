<?php
include '../configuration/connection.php';
include ROOT_PATH . 'controller/user_controller.php';
include ROOT_PATH . 'Templets/navbar.php';

$id = $_SESSION['id'];
$user = new user;

if (isset($_REQUEST['updateprofile'])) {
  extract($_REQUEST);
  $result = $user->update_profile($id, $username, $useremail,$contact_no);
}
?>
<?php
if (isset($_SESSION['profilemsg'])) {
?>
  <div class="mydiv alert alert-success" role="alert">
    <b><?= $_SESSION['profilemsg']; ?></b>
  </div>
<?php
  unset($_SESSION['profilemsg']);
}
?>
<?php
if (isset($_SESSION['passmsg'])) {
?>
  <div class="mydiv alert alert-success" role="alert">
    <b><?= $_SESSION['passmsg']; ?></b>
  </div>
<?php
  unset($_SESSION['passmsg']);
}
?>
<?php
if (isset($_SESSION['wrongpassmsg'])) {
?>
  <div class="mydiv alert alert-danger" role="alert">
    <b><?= $_SESSION['wrongpassmsg']; ?></b>
  </div>
<?php
  unset($_SESSION['wrongpassmsg']);
}
?>
       <div >
    <button onclick="history.back()" style="font-size:20px; background-color:white;border-width:0px;"><i class="fa-solid fa-arrow-left-long"></i> Back</button>
</div>
 <div class="col-lg-6 p-3" style="margin-left:10%;">
  <h2 style="text-align:center; font-weight:bold; padding:10px">Edit Profile</h2>
  <form method="post">
    <div class="card mb-3">
      <div class="card-body mx-3">
        <div class="row">
          <div class="col-sm-4">
            <strong>
              <p class="mb-0">Name:</p>
            </strong>
          </div>
          <div class="col-lg-6">
            <input type="text" name="username" value="<?= @$_SESSION['user_name']; ?>">
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4">
            <strong>
              <p class="mb-0">Email:</p>
            </strong>
          </div>
          <div class="col-sm-6">
            <input type="text" name="useremail" value="<?= @$_SESSION['user_mail']; ?>">
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4">
            <strong>
              <p class="mb-0">Gender:</p>
            </strong>
          </div>
          <div class="col-sm-6">
            <p class="text-muted mb-0"><?= @$_SESSION['user_gender']; ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4">
            <strong>
              <p class="mb-0">Contact No.:</p>
            </strong>
          </div>
          <div class="col-sm-6">
            <input class="text-muted mb-0" name="contact_no" value="<?= @$_SESSION['user_contactno']; ?>" />
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4">
            <strong>
              <p class="mb-0">Role:</p>
            </strong>
          </div>
          <div class="col-sm-6">
            <p class="text-muted mb-0"><?= @$_SESSION['user_type']; ?></p>
          </div>
        </div>
        <hr>
      </div>
      <button type="submit" class="btn btn-info w-25 p-1" name="updateprofile" style="margin-left:72% ;" title="save details">Save</button>
      <br>
    </div>
  </form>

  <button type="button" id="bt" class="btn btn-sm" style="background-color:#138579 ;">Change password</button>
  <div class="container m-3" id="show" style="display:none; border-style:groove; border-radius:8px;">
    <form method="POST" action="../user/changepass.php" onsubmit="return validation();">
      <br>
      <div class="mb-3">
        <label class="form-label" style="font-weight:600;">Old Password</label>
        <input type="password" id="oldpass" name="oldpass" class="form-control" />
        <span id="oldpass_warning" class="text-danger "></span>
      </div>
      <div class="mb-3">
        <label class="form-label" style="font-weight:600;">New Password</label>
        <input type="password" id="floatingPassword" name="newpass" class="pass form-control" />
        <span id="userpass" class="text-danger "></span>
      </div>
      <div class="mb-3">
        <label class="form-label" style="font-weight:600;">Confirm Password</label>
        <input type="password" id="floatingconfirmPassword" name="cnfpass" class="pass form-control" />
        <span id="userconfpass" class="text-danger "></span>
        <br>
        <button type="submit" name="changepass" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" id="hide">Cancel</button>
      </div>
  </div>
  </form>

  <script src="../jquery-3.6.2.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#bt").click(function() {
        $("#show").show();
      });

      $("#hide").click(function() {
        $("#show").hide();
      });
    });
  </script>
  <script>
    setTimeout(function() {
      $('.mydiv').fadeOut('fast');
    }, 1000);
  </script>
 