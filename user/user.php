<?php
include '../configuration/connection.php';
include ROOT_PATH . 'controller/user_controller.php';
include ROOT_PATH . 'Templets/navbar.php';


$user = new user;

if (isset($_REQUEST['submit_form'])) {
  extract($_REQUEST);

  $mailresult = $user->get_mail_user($email);
  if ($mailresult) {
    $userresult = $user->set_user($category, $name, $gender, $email, $phone);
  }
}

// Session Alert
if (isset($_SESSION['usermailmsg'])) {
  ?>
  <div class="mydiv alert alert-warning" role="alert">
    <b>
      <?= $_SESSION['usermailmsg']; ?>
    </b>
  </div>
  <?php
  unset($_SESSION['usermailmsg']);
}
?>

<?php
if (isset($_SESSION['usermsg'])) {
  ?>
  <div class="mydiv alert alert-success" role="alert">
    <b>
      <?= $_SESSION['usermsg']; ?>
    </b>
  </div>
  <?php
  unset($_SESSION['usermsg']);
}
?>

<?php
if (isset($_SESSION['usernotmsg'])) {
  ?>
  <div class="mydiv alert alert-danger" role="alert">
    <b>
      <?= $_SESSION['usernotmsg']; ?>
    </b>
  </div>
  <?php
  unset($_SESSION['usernotmsg']);
}
?>
       <div >
    <button onclick="history.back()" style="font-size:20px; background-color:white;border-width:0px;"><i class="fa-solid fa-arrow-left-long"></i> Back</button>
</div>
<div class="container ">
  <div class="row d-flex justify-content-center">
    <div class="col col-xl-6">
      <div class="card card-registration ">
        <div class="row g-0">

          <div class="card-body p-md-5 text-black">
            <div class="mb-3">
              <li style="color:#1f8585;"><span class="text-danger"><b>(*) Represents, fields are compulsory!</b></span>
              </li>

              <h3 class="mb-5 text-uppercase" style="text-align:center; font-weight:bold; font-style:italic;">ADD NEW
                USER</h3>

              <form method="POST" onsubmit="return emptyuser();">
                <!-- User Role -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="category" style="font-weight:900;">Role:</label>
                  <select class="form-control" id="role_type" name="category">
                    <option value="User" selected="">User</option>
                    <option value="Admin">Admin</option>
                  </select>
                </div>

                <!-- USer Name -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="fname" style="font-weight:900;">Name:<span class="required"
                      style="color: red;">*</span></label>
                  <input type="text" id="fname" name="name" placeholder="Enter Name"
                    class="form-control form-control-lg" />
                  <span id="firname" class="text-danger "></span>
                </div>

                <!-- User Email Id -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="email_id" style="font-weight:900;">Email ID:<span class="required"
                      style="color: red;">*</span></label>
                  <input type="text" id="email_id" name="email" placeholder="Enter Email-Id"
                    class="form-control form-control-lg" />
                  <span id="emailid" class="text-danger "></span>
                </div>

                <!--User Gender -->
                <div class="d-md-flex justify-content-start align-items-center mb-3 py-2">
                  <h6 class="mb-0 me-4" style="font-weight:900;">Gender:<span class="required"
                      style="color: red;">*</span> </h6>

                  <div class="form-check form-check-inline mb-0 me-4" id="Gender">
                    <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="Female" />
                    <label class="form-check-label" for="femaleGender">Female</label>
                  </div>

                  <div class="form-check form-check-inline mb-0 me-4">
                    <input class="form-check-input" type="radio" name="gender" id="maleGender" value="Male" />
                    <label class="form-check-label" for="maleGender">Male</label>
                  </div>
                  <span id="ugender" class="text-danger "></span>
                </div>

                <!-- User Contact No. -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="phoneno" style="font-weight:900;">Phone No.:<span class="required"
                      style="color: red;">*</span></label>
                  <input type="tel" id="phoneno" name="phone" autocomplete="off" placeholder="Enter Phone Number"
                    class="form-control form-control-lg" />
                  <span id="sphone" class="text-danger "></span>
                </div>

                <!-- Submit and Cancel Button -->
                <div class="d-flex pt-2">
                  <button type="submit" class="btn btn-lg ms-0 " name="submit_form"
                    style=" background-color:#50CDC0;">Submit</button>
                  <button type="reset" class="btn btn-lg" name="create_form"
                    style="border-radius:12px; border-width:0px;margin-left:auto; background-color:#7E8181;">Clear</button>
                </div>
              </form>
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
