<?php
include '../configuration/connection.php';
include ROOT_PATH . 'controller/invite_controller.php';
include ROOT_PATH . 'controller/survey_controller.php';
include ROOT_PATH . 'controller/question_controller.php';

$invi_user = new invite;
$survey = new survey;
$ques = new questions;

$survey_id = $_REQUEST['sid'];
@$invitekey = $_REQUEST['invite_key'];
$sql = $invi_user->invited_user_info($invitekey);

if (@$sql['status'] == 'submitted') {
    header("Location:../report/already.php");
}

$result = $survey->survey_title_description($survey_id);

@$invitename = $sql['Invitation_to'];
@$invitemail = $sql['invitation_email'];

$data = $survey->question_option($survey_id);

if (isset($_REQUEST['save'])) {
    extract($_REQUEST);

    $user_response = $survey->survey_response($survey_id, $uname, $uemail);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footprints Survey</title>

    <!-- Css -->
    <link rel="shortcut icon" href="#">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="row d-flex justify-content-center  ">
    <div class="col col-xl-8"> 
    <div class="card">
        <div class="card-body">
            <div style="text-align:center;border-style:outset; border-radius:10px; padding:10px; background-color:#50CDC0;">
                <p><b> Your opinion matters</b> <br>
                  Have some ideas how to improve our product?<b>Give us your feedback.</b></p>
            </div>

            <!-- Survey Information -->
            <div style="padding:10px;margin:2px; border-style:groove; border-radius:10px;">
                <h4 style="color:#3fb5a9;"><?= @$result['Survey_title']; ?></h2>
                <hr>
                <p style="color:#1e8a7e;"><?= @$result['Survey_description']; ?></p>
            </div>

            <form method="post" enctype="multipart/form-data">

                <!-- User Details -->
                <div style="padding:10px;border-style:groove; border-radius:10px;">
                    <b> Name:</b><span class='required' style='color: red;'><b>*</b></span>
                    <input class="w-50 mb-1" type="text" name="uname" autocomplete="off" value="<?= @$invitename; ?>" />

                    <br><br>
                    <b> Email:</b><span class='required' style='color: red;'><b>*</b></span>
                    <input class="w-50" type="email" name="uemail" readonly value="<?= @$invitemail; ?>" />
                    <p class="text-danger p-1 m-3 mb-0" style="font-weight:bolder;">* indicates questions are compulsory to fill !!</p>
                </div>

                <!-- Question -->
                <div>
                    <?php
                    $i = 1;
                    foreach ($data as $question => $opt) {
                        foreach ($opt as $a => $b) {
                            $q_id = $b['que_id'];

                            $result = $ques->question_info($q_id);
                            $comp = $result['is_compulsory'];
                        }
                    ?>

                        <div class="col-12 p-3 mt-4 survey" style="border-style:ridge;border-radius:10px;box-shadow:-8px 0 3px -2px silver;">
                            <div class="p-2">
                                <label><b>Question:<?= $i++; ?>:)&nbsp;</b><?= $question; ?></label>
                                <?= ($comp == "yes") ? "<span class='required' style='color: red;'><b>*</b></span>" : ''; ?>
                            </div>

                            <?php
                            $len = count($opt);
                            $l = 0;
                            foreach ($opt as $k => $v) {
                                if ($v['type'] == "MCQ") { ?>
                                    <div class="form-check">
                                        <input type="radio" id="mcq[<?= $b['que_id'] ?>]" name='ans[<?= $b['que_id'] ?>][<?= $v['type'] ?>][]' value="<?= $v['options']; ?>" <?= ($comp == "yes") ? "required" : ''; ?> />
                                        <input type="text" style="border-width:0px ;" readonly value="<?= $v['options']; ?>">
                                    </div><br>

                                <?php
                                } else if ($v['type'] == "Multiple_Choice") { ?>
                                    <div class="form-check ">
                                        
                                        <input type="checkbox" class="chkbox[<?= $b['que_id'] ?>]" name='ans[<?= $b['que_id'] ?>][<?= $v['type'] ?>][]' value="<?= $v['options']; ?>" <?= ($comp == "yes") ? "required" : ''; ?> />
                                        <input type="text" style="border-width:0px ;" readonly value="<?= $v['options']; ?>">

                                    </div><br>

                                    <?php
                                } else if ($v['type'] == "MCQComment") {

                                    if ($l <= $len) { ?>
                                        <div class="form-check ">
                                            <input type="radio" name='ans[<?= $b['que_id'] ?>][<?= $v['type'] ?>][]' value="<?= $v['options']; ?>" <?= ($comp == "yes") ? "required" : ''; ?> />
                                            <input type="text" style="border-width:0px ;" readonly value="<?= $v['options']; ?>">

                                        </div><br>
                                    <?php
                                    }
                                    $l++;
                                } else if ($v['type'] == "Multiple_ChoiceComment") {
                                    if ($l <= $len) { ?>
                                        <div class="form-check ">
                                            <input type="checkbox" id="chkbox" class="chkbox[<?= $b['que_id'] ?>]" name='ans[<?= $b['que_id'] ?>][<?= $v['type'] ?>][]' value="<?= $v['options']; ?>" <?= ($comp == "yes") ? "required" : ''; ?> />
                                            <input type="text" style="border-width:0px ;" readonly value="<?= $v['options']; ?>">
                                        </div><br>
                                <?php
                                    }
                                    $l++;
                                }
                            }
                            if (($v['type'] == "MCQComment") || ($v['type'] == "Multiple_ChoiceComment")) {
                                ?>
                                <div class="form-check ">
                                    <label for="reason">Reason:</label><br>
                                    <textarea type="text" id="descri" name='ans[<?= $b['que_id'] ?>][cmt]' placeholder="Enter Reason here...." class="form-control form-control-lg" <?= ($comp == "yes") ? "required" : ''; ?>></textarea>
                                </div><br>

                            <?php
                            }
                            if ($v['type'] == "Text") { ?>
                                <div>
                                    <textarea class="form-control" name='ans[<?= $b['que_id'] ?>][<?= $v['type'] ?>][]' id="question" placeholder="Enter Your Answer..." <?= ($comp == "yes") ? "required" : ''; ?>></textarea>
                                </div><br>

                            <?php
                            } else if ($v['type'] == "Date") { ?>
                                <div>
                                    <input type="date" <?= ($comp == "yes") ? "required" : ''; ?> name='ans[<?= $b['que_id'] ?>][<?= $v['type'] ?>][]' style="border-radius:8px; padding:8px;" />
                                </div><br>

                            <?php
                            } else if ($v['type'] == "File") { ?>
                                <div>
                                    <b><label for="exampleFormControlFile1">Upload File here..</label></b><br>
                                    <input type="hidden" name="ans[<?= $b['que_id'] ?>][<?= $v['type'] ?>][]">
                                    <input type="file" <?= ($comp == "yes") ? "required" : ''; ?> name='file' class="form-control" id="exampleFormControlFile1" accept=".jpg,.jpeg,.png,.pdf,.docx">&nbsp;
                                </div><br>
                                <span class="text-danger m-3">Accepted Format- '.jpg' , '.jpeg' , '.png' , '.pdf' , '.docx'</span>
                                <br>

                            <?php
                            } else if (($v['type'] == "RatingScale")) { ?>
                                <div class="rating">
                                    <input type="range" min="0" max="5" value="0" step="1" id="customRange1" name="ans[<?= $b['que_id'] ?>][<?= $v['type'] ?>][]" oninput="this.nextElementSibling.value = this.value" style="width:50%;">
                                    <output>0</output>
                                </div>
                                <br>
                        <?php
                            }
                            echo "</div>";
                            echo "<br>";
                        }
                        ?>

                        <!-- Submit Button -->
                        <div class="d-flex pt-2 m-3">
                            <button type="submit" class="btn btn-lg ms-0 " name="save" id="check" style=" background-color:#50CDC0;" title="Submit Form">Submit</button>
                            <button type="reset" class="btn btn-lg" name="create_form" style="border-radius:12px;margin-left:auto; border-width:0px; background-color:#7E8181;" title="Clear Form">Clear</button>
                        </div>

                        </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
</body>

<script src="../jquery-3.6.2.min.js"></script>

<script type="text/javascript">
    // Restrict Going back page
    window.history.forward();

    function noBack() {
        window.history.forward();
    }

    // Mandatory Questions
    $('#check').on("click", function() {
        let valid = true;
        $('[required]').each(function() {
            if ($(this).is(':invalid') || !$(this).val()) {
                valid = false;
            }
        });
        if (!valid) {
            alert(" * Questions Are Required!");
        }
    });

    // Multiple choice
    $('input[type=checkbox]').on('click', function() {
        var checkClass = $(this).attr('class');
        var checkbox_required = $('input[class="' + checkClass + '"]');

        checkbox_required.attr('required', true);
        if (checkbox_required.is(':checked')) {
            checkbox_required.attr('required', false);
        } else {
            checkbox_required.attr('required', true);
        }
    });
</script>

</html>