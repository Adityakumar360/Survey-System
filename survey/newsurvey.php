<?php
include '../configuration/connection.php';
include ROOT_PATH . 'controller/survey_controller.php';
include ROOT_PATH . 'Templets/navbar.php';


$createor = $_SESSION['id'];
$survey = new survey;
if (isset($_REQUEST['create_form'])) {
  extract($_REQUEST);

  $result = $survey->get_title($title);
  if ($result) {
    $result = $survey->set_survey_data($title, $description, $category, $createor, $date, $enddate);
  }
}

//Session Alert 
if (isset($_SESSION['surveymsg'])) {
  ?>
  <div class="mydiv alert alert-success" role="alert">
    <b>
      <?= $_SESSION['surveymsg']; ?>
    </b>
  </div>
  <?php
  unset($_SESSION['surveymsg']);
}

if (isset($_SESSION['surveytitlemsg'])) {
  ?>
  <div class="mydiv alert alert-warning" role="alert">
    <b>
      <?= $_SESSION['surveytitlemsg']; ?>
    </b>
  </div>
  <?php
  unset($_SESSION['surveytitlemsg']);
}

if (isset($_SESSION['unable_createmsg'])) {
  ?>
  <div class="mydiv alert alert-danger" role="alert">
    <b>
      <?= $_SESSION['unable_createmsg']; ?>
    </b>
  </div>
  <?php
  unset($_SESSION['unable_createmsg']);
}
?>
       <div >
    <button onclick="history.back()" style="font-size:20px; background-color:white;border-width:0px;"><i class="fa-solid fa-arrow-left-long"></i> Back</button>
</div>
<section>
  <div class="row d-flex justify-content-center  ">
    <div class="col col-xl-6">
      <div class="card card-registration">
        <div class="card-body p-md-5 text-black">
          <div class="mb-3">
            <li style="color:#1f8585;"><span class="text-danger"><b> (*) Represents, fields are compulsory !</b></span>
            </li>
          </div>
          <h3 class="mb-5 text-uppercase" style="text-align:center;" style="font-weight:bold; font-style:italic;"> New
            Survey</h3>

          <form onsubmit="return emptystr();" method="post">
            <!-- Survey Title -->
            <div class="form-outline mb-4">
              <label class="form-label" for="title" style="font-weight:900;">Survey Title:<span class="required"
                  style="color: red;">*</span></label>
              <input type="text" id="title" name="title" placeholder="Enter Survey Title"
                class="form-control form-control-lg" />
              <span id="stitle" class="text-danger "></span>
            </div>

            <!-- Surey Category -->
            <div class="form-outline mb-4">
              <label class="form-label" for="category" style="font-weight:900;">Survey Category:<span class="required" style="color: red;">*</span></label>
              <select class="form-control" id="category_type" name="category">
                <option disabled="" selected="">Choose Here...</option>
                <option value="Education">Education</option>
                <option value="Sports">Sports</option>
                <option value="Health">Health</option>
                <option value="Academics">Academics</option>
                <option value="Finance">Finance</option>
              </select>
              <span id="cat" class="text-danger"></span>
            </div>

            <!-- Survey description -->
            <div class="form-outline mb-4">
              <label class="form-label" for="descri" style="font-weight:900;">Survey Description:<span class="required"
                  style="color: red;">*</span></label>
              <textarea type="text" id="descri" name="description" placeholder="Enter Survey Description"
                class="form-control form-control-lg"></textarea>
              <span id="sdescr" class="text-danger "></span>
            </div>

            <!-- Survey Created By -->
            <div class="form-outline mb-4">
              <label class="form-label" for="createdby" style="font-weight:900;">Survey Created BY</label>
              <input type="text" id="createdby" readonly value="<?=@$_SESSION['user_name']; ?>"
                class="form-control form-control-lg" />
            </div>

            <!-- Survey Start Date -->
            <div class="form-outline mb-4">
              <label class="form-label" for="dte" style="font-weight:900;">Date Of Creation:<span class="required"
                  style="color: red;">*</span></label>
              <input type="date" id="dte" name="date" min="<?= date("Y-m-d"); ?>"
                class="form-control form-control-lg" />
              <span id="dtecr" class="text-danger "></span>
            </div>

            <!-- Survey End Date -->
            <div class="form-outline mb-4">
              <label class="form-label" for="enddte" style="font-weight:900;">End Date</label>
              <input type="date" id="enddte" name="enddate" min="<?= date("Y-m-d"); ?>"
                class="form-control form-control-lg" />
              <span id="enddtre" class="text-danger "></span>
            </div>

            <!-- Buttons -->
            <div class="d-flex pt-2">
              <a href="question.php"> <button type="submit" class="btn btn-lg ms-0 " name="create_form"
                  style=" background-color:#50CDC0;">Create</button></a>
              <button type="reset" class="btn btn-lg" name="create_form"
                style="border-radius:12px;margin-left:auto; border-width:0px;  background-color:#7E8181;">Clear</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Session Alert -->
<script>
  setTimeout(function () {
    $('.mydiv').fadeOut('fast');
  }, 1500);
</script>

