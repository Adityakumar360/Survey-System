<?php
include '../configuration/connection.php';
include ROOT_PATH . 'controller/survey_controller.php';
include ROOT_PATH . 'Templets/navbar.php';
// include ROOT_PATH . 'Templets/side_top.php';
$survey = new survey;

date_default_timezone_set('Asia/Kolkata');
$survey_id = $_REQUEST['Survey_id'];

$result1 = $survey->survey_info_id($survey_id);
$arr = mysqli_fetch_array($result1);

if (isset($_POST['create_form'])) {
  extract($_POST);
 
  $today = date("y-m-d");

  $result2 = $survey->get_title($title);
  $modified_date = date("y-m-d");
  $modified_by = $_SESSION['id'];
  $result3 = $survey->update_survey($title, $description, $category, $date, $enddate, $today, $modified_by, $modified_date, $survey_id);
}

?>

  <div class="container ">
    <div class="row d-flex justify-content-center align-items-center ">
      <div class="col col-xl-6">
        <div class="card card-registration my-4">
          <div class="row g-0">

            <div class="col-xl-12">
              <div class="card-body p-md-5 text-black">
                <h3 class="mb-5 text-uppercase" style="text-align:center;font-style:italic;">Update Survey</h3>
                <form method="post">

                  <!-- Survey Title -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="title" style="font-weight:bold;">Survey Title</label>
                    <input type="text" id="title" name="title" value="<?= @$arr['Survey_title']; ?>" class="form-control form-control-lg" />
                    <span id="stitle" class="text-danger "></span>
                  </div>
                  
                  <!-- Survey Category -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="category" style="font-weight:bold;">Survey Category</label>
                    <select class="form-control" id="ques-type" name="category">
                      <option value="Education" <?= (@$arr['Survey_Category'] == "Education") ? "selected" : ''; ?>>Education</option>
                      <option value="Sports" <?= (@$arr['Survey_Category'] == "Sports") ? "selected" : ''; ?>>Sports</option>
                      <option value="Health" <?= (@$arr['Survey_Category'] == "Health") ? "selected" : ''; ?>>Health</option>
                      <option value="Academics" <?= (@$arr['Survey_Category'] == "Academics") ? "selected" : ''; ?>>Academics</option>
                    </select>
                  </div>

                  <!-- Survey Description -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="descri" style="font-weight:bold;">Survey Description</label>
                    <textarea type="text" id="descri" name="description" class="form-control form-control-lg"><?= @$arr['Survey_description']; ?></textarea>
                    <span id="sdescr" class="text-danger "></span>
                  </div>

                  <!-- Survey Created By -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="createdby" style="font-weight:bold;">Survey Created BY</label>
                    <input type="text" id="createdby" disabled name="author" value="<?= $_SESSION['user_name']; ?>" class="form-control form-control-lg" />
                  </div>

                  <!-- Survey Start Date -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="dte" style="font-weight:bold;">Date Of Creation</label>
                    <input type="date" id="updte" name="date" min="<?= date("Y-m-d"); ?>" value="<?= @$arr['survey_start_Date']; ?>" class="form-control form-control-lg" />
                  </div>

                  <!-- Survey end Date -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="enddte" style="font-weight:bold;">End Date</label>
                    <input type="date" id="upenddte" name="enddate" min="<?= date("Y-m-d"); ?>" value="<?= @$arr['survey_end_date'];  ?>" class="form-control form-control-lg" />
                  </div>

                  <!-- Update Button -->
                  <div class="d-flex pt-2">
                    <button type="submit" class="btn btn-lg ms-0 " name="create_form" style=" background-color:#50CDC0;">Update</button>
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