<?php
include '../Templets/navbar.php';
// include '../Templets/side_top.php';
include '../configuration/connection.php';
include '../controller/invite_controller.php';

$invitation = new invite;
$sid = $_REQUEST['Survey_id'];


if (isset($_POST['invite'])) {
  extract($_REQUEST);

  $invitedby = $_SESSION['id'];
  $email = explode(",", $_POST['email'] . "," . $_POST['name']);
  $len = count($email);
  $len_email = $len / 2;
  $flag_mail = 0;
  for ($i = 0; $i < $len_email; $i++) {
    $mail_exist = $invitation->get_email($email[$i], $sid);
    if ($mail_exist) {
      $flag_mail = 1;
    }
  }
  if (!$flag_mail) {
    for ($i = 0; $i < $len_email; $i++) {
      $em = [$email[$i]];
      $em = implode($em);
      $name = $email[$len / 2 + $i];
      $query = $invitation->set_invitation_data($sid, $invitedby, $name, $message, $em);
    }
  }
}

?>
<?php
if (isset($_SESSION['invitemailmsg'])) {
  ?>
  <div class="mydiv alert alert-danger" role="alert">
    <b>
      <?= $_SESSION['invitemailmsg']; ?>
    </b>
  </div>
  <?php
  unset($_SESSION['invitemailmsg']);
}

if (isset($_SESSION['invite_msg'])) {
  ?>
  <div class="mydiv alert alert-success" role="alert">
    <b>
      <?= $_SESSION['invite_msg']; ?>
    </b>
  </div>
  <?php
  unset($_SESSION['invite_msg']);
}
?>

<div class="container ">
  <div class="row d-flex justify-content-center align-items-center ">
    <div class="col col-xl-6">
      <div class="card card-registration my-4">
        <div class="row g-0">
          <div class="col-xl-12">
            <div class="card-body p-md-5 text-black">

              <h3 class="mb-5 text-uppercase" style="text-align:center; font-weight:bold;"><i> Invite</i></h3>

              <form method="post" onsubmit="return invitelog();">
                <!-- Name  -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="fname" style="font-weight:650;">Name:-<span class="required"
                      style="color: red;">*</span></label>
                  <input type="text" id="fname" name="name" placeholder="Enter Invitation Reciever's Name"
                    class="form-control form-control-lg" />
                  <span id="firname" class="text-danger "></span>
                </div>

                <!-- Invited By -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="createdby" style="font-weight:650;">Invited BY:-</label>
                  <input type="text" id="createdby" readonly value="<?=@$_SESSION['user_name']; ?>"
                    class="form-control form-control-lg" />
                </div>

                <!-- Email Id -->
                <div class="Email invite form-outline mb-2">
                  <label class="form-label" for="email_id" style="font-weight:650;">Email ID:-<span class="required"
                      style="color: red;">*</span></label>
                  <input type="text" id="email_id" name="email" placeholder="Enter Reciever's Email"
                    class="form-control form-control-lg" />
                  <span id="emailid" class="text-danger "></span>
                </div>

                <!-- Message -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="message" style="font-weight:650;">Message:-<span class="required"
                      style="color: red;">*</span></label>
                  <textarea type="text" id="message" name="message" placeholder="Enter Message"
                    class="form-control form-control-lg"></textarea>
                  <span id="invitemessage" class="text-danger "></span>
                </div>

                <!-- Invite Button -->
                <div class="d-flex pt-2">
                  <button type="submit" class="btn btn-lg ms-0 w-100 " name="invite"
                    style="background-color:#50CDC0;">Invite</button>
                </div>
              </form>

            </div>

            <!-- Information regarding the invitation -->
            <div class="mx-4 mb-3">
              <li style="color:#1f8585;"><span class="text-danger"><b>* Represents, fields are compulsory </b></span>
              </li>
              <li style="color:#1f8585;"><span class="text-danger"><b>To send multiple invite use comma(",") seperated
                    values </b></span></li>
              <li style="color:#1f8585;"><span class="text-danger"><b>Count of Name should be equal to count of Email's
                    OR vice versa</b></span></li>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  setTimeout(function () {
    $('.mydiv').fadeOut('slow');
  }, 1000);
</script>
<?php
// include '../Templets/side_footer.php';
?>