<?php
include '../configuration/connection.php';
include ROOT_PATH . 'controller/question_controller.php';
include ROOT_PATH . 'Templets/navbar.php';


$ques = new questions;
$survey_id = $_REQUEST['sid'];
$ques_id = $_REQUEST['ques_id'];

$result = $ques->question_info($ques_id);
$ques_type = $result['Question_type'];
$question = $result['Question_description'];

$options_id = $ques->optionid_wrt_question($ques_id);

if (isset($_REQUEST['update'])) {
    extract($_REQUEST);
    $today = date("y-m-d");

    $result = $ques->update_question($ques_type, $type1, $options_id, $question, $ques_id, $_SESSION['id'], $today, $survey_id);
}
?>

<style>
.btne2 {
    display: none;
}
</style>

<?php
if (isset($_SESSION['update_quesmsg'])) {
?>
<div class="mydiv alert alert-success" role="alert">
    <b><?= $_SESSION['update_quesmsg']; ?></b>

</div>
<?php
    unset($_SESSION['update_quesmsg']);
    
}
if (isset($_SESSION['updatefailed_quesmsg'])) {
?>
<div class="mydiv alert alert-danger" role="alert">
    <b><?= $_SESSION['updatefailed_quesmsg']; ?></b>
</div>
<?php
    unset($_SESSION['updatefailed_quesmsg']);
}

if (isset($_SESSION['optmsg'])) {
?>
<div class="mydiv alert alert-danger" role="alert">
    <b><?= $_SESSION['optmsg']; ?></b>
</div>
<?php
    unset($_SESSION['optmsg']);
}

if (isset($_SESSION['delteopt_msg'])) {
?>
<div class="mydiv alert alert-danger" role="alert">
    <b><?= $_SESSION['delteopt_msg']; ?></b>
</div>
<?php
    unset($_SESSION['delteopt_msg']);
}
?>
<a href="question.php?Survey_id=<?= $survey_id; ?>"><button type="button" class="btn text-right" style="font-size: larger;color:black;"><b><i class="fa-solid fa-arrow-left-long"></i> Back</b></button></a>

<div class="container" style=" border-radius:8px;padding:1%; margin-top: 20px;border:groove;width: fit-content;">

    <h2 style="text-align:center; font-weight:bold;">Edit Question</h2>
    <form method="post">
        <div>
            <label for="question"><b>Question:</b></label>
            <input class="form-control" id="question" name="question" value="<?= @$question ?>" />
        </div>
        <br>
        <div>
            <div style="padding:5px;">
                <label for="exampleFormControlSelect1" style="font-weight:bold;">Question Choice:-</label>
                <select class="form-control-md" style="border-radius:5px;padding:5px;" id="ques-type" name="type1">

                    <option value="MCQ" <?= ($ques_type == "MCQ") ? "selected" : ''; ?>>Single Choice</option>
                    <option value="MCQComment" <?= ($ques_type == "MCQComment") ? "selected" : ''; ?>>Single Choice &
                        Comments</option>
                    <option value="Multiple_Choice" <?= ($ques_type == "Multiple_Choice") ? "selected" : ''; ?>>Multiple
                        Answers</option>
                    <option value="Multiple_ChoiceComment"
                        <?= ($ques_type == "Multiple_ChoiceComment") ? "selected" : ''; ?>>Multiple Choice & Comments
                    </option>
                    <option value="Text" <?= ($ques_type == "Text") ? "selected" : ''; ?>>Text/Paragraph</option>
                    <option value="RatingScale" <?= ($ques_type == "RatingScale") ? "selected" : ''; ?>>Rating Scales
                    </option>
                    <option value="Date" <?= ($ques_type == "Date") ? "selected" : ''; ?>>Date / Datetime</option>
                    <option value="File" <?= ($ques_type == "File") ? "selected" : ''; ?>>File</option>
                </select>
            </div>
            <!--------------------- Single Choice ------------------->

            <div class="MCQ btne2 " style=" padding:2%;">
                <button type="button" name="add1" style="background-color:#138579;margin-left: 15px;"
                    class="btn btn-success  addopt">+Add option</button><br><br>
                <div id="dynamic_field1 " class="dynamicfield1">
                    <div class="form-check mb-3" style="margin-left: 20px;">
                        <input class="form-check-input" type="radio" disabled name="options" id="radioExample1" />
                        <label class="form-check-label" for="radioExample1">
                            <input type="text" class="comm_class" placeholder="Enter Option" name="add[]" />
                        </label>
                    </div>
                </div>
            </div>
            <!---------------------  Single Choice & Comments ----------------------->

            <div class="MCQComment btne2 " style=" padding:2%;">
                <button type="button" name="add" id="add3" style="margin-left: 15px;background-color:#138579;"
                    class="btn btn-success addoptcmt  ">+Add option</button><br><br>
                <div class=dynamic_field_new1>
                    <div class="form-check mb-3" style="margin-left: 20px;">
                        <input class="form-check-input" disabled type="radio" name="exampleForm" id="radioExample1" />
                        <label class="form-check-label" for="radioExample1">
                            <input type="text" class="comm_class" placeholder="Enter Option " name="add[]" />
                        </label>
                    </div>
                </div>
                <div>
                    <label for="reason">Reason:</label>
                    <input class="form-control" name="addcmt[]" id="reason" />
                </div>
            </div>

            <!---------------------------- Multiple Answers ----------------------------->

            <div class="Multiple_Choice btne2 " style=" padding:2%;">
                <button type="button" name="add" style="background-color:#138579;margin-left: 15px;" id="add2"
                    class="btn btn-success addoptmul ">+Add option</button><br><br>
                <div id="dynamic_field2" class="dynamicfield">
                    <div class="form-check mb-3">
                        <input type="checkbox" disabled id="chkbox" /><label for="chkbox">&emsp;<input type="text"
                                class="comm_class" placeholder="Enter Option" name="add[]"></label>&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
            </div>

            <!------------------Multiple Answers and Comment-------------------------->

            <div class="Multiple_ChoiceComment btne2 " style="  padding:2%;">
                <button type="button" name="add" id="add4" style="background-color:#138579;margin-left: 15px;"
                    class="btn btn-success mcqcmt ">+Add option</button><br><br>
                <div class=dynamic_field_new1 style="margin-left: 20px;">
                    <div class="form-check mb-3">
                        <input type="checkbox" disabled id="chkbox" /><label for="chkbox">&emsp;<input type="text"
                                class="comm_class" placeholder="Enter Option" name="add[]"></label>&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
                <div>
                    <label for="reason">Reason:</label>
                    <input class="form-control" name="addcmt[]" id="reason" />
                </div>
            </div>
            <!---------------------------------- Text/ParaGraph ------------------------------>

            <div class="Text btne2 " style="  padding:2%;">
                <input class="form-control" id="question" placeholder="Enter Your Answer..." disabled />
            </div>


            <!------------------------------ Rating Scale----------------------------------->

            <div class="RatingScale btne2 " style=" padding:2%;">
                <div class="rating">
                    <input type="range" class="form-range" id="myRange" min="0" max="5" step="1" value="0">
                </div>
            </div>

            <!----------------------------------- Date-------------------------------->

            <div class="Date btne2 " style="  border-radius:8px; padding:8px;">
                <input type="date" class="form-control" id="dte" disabled />
            </div>

            <!--------------------------------- File Upload-------------------------->

            <div class="File btne2 " style=" padding:2%;">
                <div id="dynamic_field5">
                    <div class="form-group">
                        <b><label for="exampleFormControlFile1">Upload File here..</label></b><br>
                        <input type="file" class="form-control-file" disabled id="exampleFormControlFile1">&nbsp; <br>
                    </div>
                </div>
            </div>
            <br>

            <div class="edit">
                <?php
                $i = 1;
                $data1 = $ques->display_question_edit($ques_id);

                foreach ((array)$data1 as $ques => $opt) {
                    foreach ($opt as $a => $b) {
                        $q_id = $b['que_id'];
                    }
                    $len = count($opt);
                    $l = 0;

                    if ($ques_type == "MCQ") {
                        echo '<button type="button"  class="btn btn-success addopt"  name="add" style="background-color:#138579;">+Add option</button> ';
                        echo "<br><br>";
                    } else if ($ques_type == "Multiple_Choice") {
                        echo '<button type="button" class="btn btn-success addoptmul" name="add"  style="background-color:#138579;" >+Add option</button> ';
                        echo "<br><br>";
                    } else if ($ques_type == "MCQComment") {
                        echo '<button type="button" class="btn btn-success addoptcmt"  name="add"  style="background-color:#138579;" >+Add option</button> ';
                        echo "<br><br>";
                    } else if ($ques_type == "Multiple_ChoiceComment") {
                        echo '<button type="button" class="btn btn-success mcqcmt"  name="add"  style="background-color:#138579;" >+Add option</button> ';
                        echo "<br><br>";
                    }

                    foreach ($opt as $k => $v) {

                        if ($ques_type == "MCQ" || $ques_type == "MCQComment" || $ques_type == "Multiple_Choice" || $ques_type == "Multiple_ChoiceComment") {
                            $i++;
                            //----------------------- Single Choice-------------------
                            if ($ques_type == "MCQ") {
                                $l++;
                ?>
                <div class="form-row mb-3">
                    <div class="form-check ">
                        <input type="radio" style="height:15px; width:15px;" disabled name="rd1" />
                        <input style="margin-left:5px;" class="comm_class" name=add[] value="<?= $v['options'] ?>" />
                        <a href="delete_ques.php?optid=<?= $v['opt_id']; ?>"><button style="margin-left:6px;"
                                type="button" title="Delete this Option"
                                onclick="return confirm('This option will be deleted permanently !!!');" class="btn"><i
                                    class="fa-solid fa-trash"></i></button></a>
                    </div>
                </div>
                <?php
                                if ($l == $len) {
                                    echo '<div class="dynamicfield1"></div>';
                                }
                            }

                            //------------------ Multiple Choice----------------------
                            else if ($ques_type == "Multiple_Choice") {
                                $l++;
                                ?>
                <div class="form-row mb-3">
                    <div class="form-check ">
                        <input type="checkbox" disabled id="chkbox" />
                        <input style="margin-left:10px;" class="comm_class" name="add[]"
                            value="<?= $v['options']; ?>" />
                        <a href="delete_ques.php?optid=<?= $v['opt_id']; ?>"><button style="margin-left:14px;"
                                type="button" onclick="return confirm('This option will be deleted permanently !!!');"
                                title="Delete this Option" class="btn "><i class="fa-solid fa-trash"></i></button></a>
                    </div>
                </div>
                <?php
                                if ($l == $len) {
                                    echo '<div class="dynamicfield"> </div>';
                                }
                            }

                            // ----------------------------Single Choice And Comment--------------------------
                            else if ($ques_type == "MCQComment") {
                                $l++;
                                if ($l <= $len) { ?>

                <div class="form-row mb-3">
                    <div class="form-check ">
                        <input type="radio" style="height:15px; width:15px;" disabled />
                        <input name="add[]" class="comm_class" value="<?= $v['options']; ?>" />

                        <a href="delete_ques.php?optid=<?= $v['opt_id']; ?>"> <button class="btn" type="button"
                                title="Delete this Option"
                                onclick="return confirm('This option will be deleted permanently !!!');"><i
                                    class="fa-solid fa-trash"></i></button></a>
                    </div>
                </div>
                <?php
                                }
                            }

                            // -------------------------------Multiple Choice And Comment-------------------------
                            else if ($ques_type == "Multiple_ChoiceComment") {
                                $l++;
                                if ($l <= $len) { ?>

                <div class="form-row mb-3">
                    <div class="form-check ">
                        <input type="checkbox" style="margin:2px;" disabled id="chkbox" />
                        <input name="add[]" class="comm_class" style="margin-left:10px;"
                            value="<?= $v['options']; ?>" />
                        <a href="delete_ques.php?optid=<?= $v['opt_id']; ?>"><button style="margin-left:10px;"
                                type="button" onclick="return confirm('This option will be deleted permanently !!!');"
                                title="Delete this Option" class="btn"><i class="fa-solid fa-trash"></i></button></a>
                    </div>
                </div>
                <?php
                                }
                            }
                        }
                    }
                    if (($ques_type  == "MCQComment") || ($ques_type  == "Multiple_ChoiceComment")) {
                        echo '<div class="dynamic_field_new1"> </div>
                        <div class="form-check "> 
                        <label for="reason">Reason:</label><br>
                        <textarea type="text" id="descri" disabled name="description"  placeholder="Enter reason"  class="form-control form-control-lg"></textarea> 
                        </div>' . "<br>";
                    }

                    // ----------Text OR Paragraph--------------
                    if ($ques_type == "Text") {
                        ?>
                <div>
                    <textarea class="form-control" id="question" placeholder="Enter Your Answer..."></textarea>
                </div>
                <?php
                    }

                    // --------------Date--------------
                    else if ($ques_type == "Date") { ?>
                <div>
                    <input disabled type="date" style="border-radius:8px; padding:8px;" />
                </div><br>
                <?php  }

                    // --------------------File---------------
                    else if ($ques_type == "File") { ?>
                <div>
                    <b><label for="exampleFormControlFile1">Upload File here..</label></b><br>
                    <input type="file" disabled class="form-control-file" id="exampleFormControlFile1">&nbsp;
                </div>
                <?php      }

                    // ----------------------Rating Scale-------------------
                    else if (($ques_type == "RatingScale")) { ?>

                <div class="rating">
                    <input type="range" class="form-range" min="0" max="5" step="1" id="customRange1">
                </div>
                <?php    }
                }
                ?>
            </div>
        </div>
        <br>

        <!------------------ button ------------------>
        <div class="d-flex justify-content-end p-2">
            <button type="submit" class="btn btn-success text-right me-3" name="update">Save</button>
            <a href="question.php?Survey_id=<?= $survey_id; ?>"><button type="button"
                    class="btn btn-danger text-right">cancel</button></a>
        </div>
    </form>
</div>

<script src="../jquery-3.6.2.min.js"></script>
<script src="../js/question_edit.js"></script>