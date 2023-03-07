<?php
include '../configuration/connection.php';
include ROOT_PATH . 'controller/user_controller.php';
include ROOT_PATH . 'Templets/navbar.php';
// include ROOT_PATH . 'Templets/side_top.php';

$user_id = $_REQUEST['user_id'];

$user = new user;
$result = $user->fetch_data_id($user_id);
$arr = $result->fetch_assoc();
if (isset($_REQUEST['update_form'])) {

  $result = $user->update_info($user_id, $_REQUEST['category'], $_REQUEST['name'], $_REQUEST['email'], $_REQUEST['gender'], $_REQUEST['phone']);
}


?>
  <div class="container ">
    <div class="row d-flex justify-content-center align-items-center ">
      <div class="col col-xl-6">
        <div class="card card-registration my-4">
          <div class="row g-0">
            <div class="col-xl-12">
              <div class="card-body p-md-5 text-black">
                
              <h3 class="mb-5 text-uppercase" style="text-align:center;font-style:italic;">Update data</h3>

                <form method="Post" onsubmit="return emptyuser();">
                  <input type="hidden" value="">
                  <div class="form-outline mb-4">
                    <label class="form-label" for="category" style="font-weight:900;">Role:</label>
                    <select class="form-control" id="category_type" name="category">
                      <option value="User">USER</option>
                      <option value="Admin" <?php if (@$arr['Type'] == "Admin") {
                        echo "selected";
                      } ?>>ADMIN</option>
                    </select>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="fname" style="font-weight:900;">Name</label>
                    <input type="text" id="fname" value="<?=@$arr['user_name']; ?>" name="name"
                      class="form-control form-control-lg" />
                    <span id="firname" class="text-danger "></span>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="email_id" style="font-weight:900;">Email ID</label>
                    <input type="text" id="email_id" name="email" value="<?=@$arr['user_email']; ?>"
                      class="form-control form-control-lg" />
                    <span id="emailid" class="text-danger "></span>
                  </div>

                  <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">
                    <h6 class="mb-0 me-4" style="font-weight:900;">Gender: </h6>
                    <div class="form-check form-check-inline mb-0 me-4">
                      <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="Female" <?php if (@$arr['Gender'] == "Female")  echo "checked"; ?> />
                      <label class="form-check-label" for="femaleGender">Female</label>
                    </div>

                    <div class="form-check form-check-inline mb-0 me-4">
                      <input class="form-check-input" type="radio" <?php if (@$arr['Gender'] == "Male")  echo "checked"; ?> name="gender" id="maleGender" value="Male" />
                      <label class="form-check-label" for="maleGender">Male</label>
                    </div>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="phoneno" style="font-weight:900;">Phone No.</label>
                    <input type="text" id="phoneno" name="phone" value="<?=@$arr['Phone_No'] ?>"
                      class="form-control form-control-lg" />
                    <span id="sphone" class="text-danger "></span>
                  </div>

                  <div class="d-flex pt-2">
                    <a href="../user/userlist.php" class="me-auto"><button type="submit" class="btn btn-lg " name="update_form" style="border-width:0px;background-color:#50CDC0;color:black;">Update</button></a>
                    <a href="../user/userlist.php"><button type="button" class="btn btn-lg"  style="border-radius:12px;margin-left:auto;border-width:0px;color:black;  background-color:#7E8181;">cancel</button></a>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
// include ROOT_PATH . 'Templets/side_footer.php';
?>