<?php
include '../configuration/connection.php';
include ROOT_PATH . 'controller/question_controller.php';
include ROOT_PATH . 'Templets/navbar.php';

$ques = new questions;
$survey_id = $_REQUEST['Survey_id'];

$survey_info = $ques->survey_info_id($survey_id);

if (isset($_REQUEST['save_ques'])) {
    extract($_REQUEST);

    $options = $ques->ques_add(@$type, $question, $survey_id);
}

// Session Alert
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

if (isset($_SESSION['addmsg'])) {
    ?>
    <div class="mydiv alert alert-success" role="alert">
        <b>
            <?= $_SESSION['addmsg']; ?>
        </b>
    </div>
    <?php
    unset($_SESSION['addmsg']);
}

if (isset($_SESSION['optmsg'])) {
    ?>
    <div class="mydiv alert alert-danger" role="alert">
        <b>
            <?= $_SESSION['optmsg']; ?>
        </b>
    </div>
    <?php
    unset($_SESSION['optmsg']);
}

if (isset($_SESSION['emptymsg'])) {
    ?>
    <div class="mydiv alert alert-danger" role="alert">
        <b>
            <?= $_SESSION['emptymsg']; ?>
        </b>
    </div>
    <?php
    unset($_SESSION['emptymsg']);
}
if (isset($_SESSION['delmsg'])) {
    ?>
    <div class="mydiv alert alert-danger" role="alert">
        <b>
            <?= $_SESSION['delmsg']; ?>
        </b>
    </div>
    <?php
    unset($_SESSION['delmsg']);
}

if (isset($_SESSION['surveyupdatemsg'])) {
    ?>
    <div class="mydiv alert alert-success" role="alert">
        <b>
            <?= $_SESSION['surveyupdatemsg']; ?>
        </b>
    </div>
    <?php
    unset($_SESSION['surveyupdatemsg']);
}

if (isset($_SESSION['deletequesmsg'])) {
    ?>
    <div class="mydiv alert alert-danger" role="alert">
        <b>
            <?= $_SESSION['deletequesmsg']; ?>
        </b>
    </div>
    <?php
    unset($_SESSION['deletequesmsg']);
}
?>


<!-- Survey -->
<div class="container w-75" style=" border-radius:8px;padding:3%;border:groove;">
    <div style="display:flex;justify-content: flex-end ">
        <?php
        if ($survey_info['survey_status'] == 'Active') {
            ?>
            <a href="../invitation/invitation.php?Survey_id=<?= $survey_id; ?>"><i class="fa-sharp fa-solid fa-share "
                    title="Invite" style="color:black;font-size:x-large;"></i></a>
            &emsp;<a href="../survey/viewsurvey.php?sid=<?= $survey_id; ?>"><i class="fa-regular fa-eye"
                    title="preview Form" style="color:black; font-size:large;"></i></a>
            <?php
        }
        ?>

    </div>
    <h2 style="text-align:center; font-weight:bold;">WELCOME TO SURVEY</h2>

    <!-- Survey Title And Description -->
    <div style=" padding:3%;">
        <div class="form-group" style="background-color:#CACFCE;padding:5px; border-radius:12px;">
            <label for="stitle" style="font-weight:bold; font-size:22px; ">Survey Title:</label>
            <label for="stitle" style="font-size:18px; ">
                <?=@$survey_info['Survey_title']; ?>
            </label>
        </div>
        <hr>
        <div style="background-color:#CACFCE;padding:10px; border-radius:12px;">
            <label for="stitle" style="font-weight:bold; font-size:22px; ">About Survey:</label>
            <p for="stitle" style="font-size:18px; ">
                <?=@$survey_info['Survey_description']; ?>
            </p>
        </div>
    </div>

    <!-- Question Display -->
    <?php
    $data1 = $ques->display_question($survey_id);

    $i = 1;
    foreach ((array) $data1 as $que => $opt) {
        foreach ($opt as $a => $b) {
            $q_id = $b['que_id'];
            $opt_id = $b['opt_id'];
        }

        $result = $ques->question_info($q_id);
        $ques_status = $result['status'];
        $required = $result['is_compulsory'];

        ?>
        <div class=" container" style="border:2px solid #BDBABA;border-radius:8px;padding:10px;">
            <div class="row">

                <!-- Question -->
                <div class="col-10">
                    <div class="p-2 ">
                        <label><b>Question:
                                <?= $i++; ?>&ensp;
                            </b>
                            <?= $que; ?>
                        </label>
                        <?=($required == "yes") ? "<span class='required' style='color: red;'><b>*</b></span> " : ''; ?>
                    </div>
                </div>

                <!-- Edit Question And Delete Question -->
                <div class="col-2" style="display: flex;justify-content: flex-end;">
                    <a class="nav-link active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false"> <i class="fa-solid fa-ellipsis-vertical"></i> </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a href="question_edit.php?sid=<?= $survey_id; ?>&ques_id=<?= $q_id; ?>"><button
                                    class="p-1 mx-3" style="border-width:0; background-color:white;"> Edit</button></a></li>
                        <li><a href="questiondelete.php?ques_id=<?= $q_id; ?>"><button class="p-1 mx-3"
                                    style="border-width:0; background-color:white;"
                                    onclick="return confirm('Are you sure you want to delte this question !!')">Delete</button></a>
                        </li>
                    </ul>
                </div>
            </div>

            <?php
            $len = count($opt);
            $l = 0;

            foreach ($opt as $k => $v) {
                if ($v['type'] == "MCQ") {
                    echo '<div class="form-check ">
                        <input type="radio" disabled name="rd1"/>       
                        ' . $v['options'] . '      
                       </div>' . "<br>";
                } else if ($v['type'] == "Multiple_Choice") {
                    echo '<div class="form-check ">
                        <input type="checkbox" disabled id="chkbox" />
                        ' . $v['options'] . '
                            </div>' . "<br>";
                } else if ($v['type'] == "MCQComment") {

                    if ($l <= $len) {
                        echo '<div class="form-check ">
                            <input type="radio" disabled name="rd1"/>       
                            ' . $v['options'] . '      
                            </div>' . "<br>";
                    }

                    $l++;
                } else if ($v['type'] == "Multiple_ChoiceComment") {

                    if ($l <= $len) {
                        echo '<div class="form-check ">
                        <input type="checkbox" disabled id="chkbox" />
                        ' . $v['options'] . ' 
                        </div>' . "<br>";
                    }
                    $l++;
                }
            }
            // comment box
            if (($v['type'] == "MCQComment") || ($v['type'] == "Multiple_ChoiceComment")) {
                echo '<div class="form-check "> 
                <label for="reason">Reason:</label><br>
                <textarea type="text" id="descri" disabled name="description"  placeholder="Enter reason"  class="form-control form-control-lg"></textarea> 
                </div>' . "<br>";
            }
            if ($v['type'] == "Text") {
                echo '<div >
                            <textarea class="form-control" disabled id="question" placeholder="Enter Your Answer..." ></textarea>
                            </div>' . "<br>";
            } else if ($v['type'] == "Date") {
                echo '<div>
                            <input disabled type="date" style="border-radius:8px; padding:8px;" />
                            </div>' . "<br>";
            } else if ($v['type'] == "File") {
                echo '<div>
                            <b><label for="exampleFormControlFile1">Upload File here..</label></b><br>
                            <input type="file" disabled class="form-control " id="exampleFormControlFile1">
                            </div>' . "<br>";
            } else if ($v['type'] == "RatingScale") {
                echo '<div class="m-3">
                        <input type="range" class="form-range" id="myRange" min="0" max="5" step="1" value="0">
                        </div>' . "<br>";
            }

            ?>

            <!-- Active Inactive AND Required Buttons -->
            <div class="container" style="display:flex;justify-content: flex-end">
                <div class="row ">
                    <div class="col-sm">
                        <input type="checkbox" id="<?= $q_id; ?>" class="mycheck" <?=($ques_status == "Active") ? "checked" : '' ?> />
                        <input type="text" id="txt<?= $q_id; ?>" class="txt" readonly style="border-width:0px;width:70px;"
                            value="<?=($ques_status == "Active") ? "Active" : "Inactive"; ?>">
                    </div>
                    <div class="col-sm form-check form-switch">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Required</label>
                        <input class="form-check-input switch-input" type="checkbox" role="switch" id="<?= $q_id; ?>"
                            <?=($required == "yes") ? "checked" : ''; ?>>
                        <span data-on="yes" data-off="no" class="switch-label"></span>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <?php
    }
    ?>
 
    <form method="post">
        <div id="hide1" style="margin-top:5%; display:none;">
            <label for="exampleFormControlSelect1" style="font-weight:900;">Question Choice:-</label>

            <!-- Question Type -->
            <select class="form-control" id="ques-type" name="type">
                <option disabled="" selected="">Choose Here...</option>
                <option value="MCQ">Single Choice</option>
                <option value="MCQComment">Single Choice & Comments</option>
                <option value="Multiple_Choice">Multiple Answers</option>
                <option value="Multiple_ChoiceComment">Multiple Choice & Comments</option>
                <option value="Text">Text/Paragraph</option>
                <option value="RatingScale">Rating Scales</option>
                <option value="Date">Date / Datetime</option>
                <option value="File">File</option>
            </select>

            <div id="details-container">

                <!-- Question -->
                <div>
                    <label for="question">Question:</label>
                    <textarea class="form-control mb-2" id="question" name="question"></textarea><br>
                </div>

                <!-- Single Choice -->
                <div class="MCQ btne2 " style="padding:2%;">

                    <div id="dynamic_field">
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" disabled name="options" id="radioExample1" />
                            <label class="form-check-label" for="radioExample1">
                                <input type="text" placeholder="Enter Option" name="add[]"
                                    style="margin-left:5px; border-width: 0px;" />
                            </label>
                            <button type="button" name="add" id="add" class="btn"
                                style="border-width:0px;font-size:larger;"><i
                                    class="fa-solid fa-circle-plus"></i></button>
                        </div>
                    </div>
                </div>

                <!--  Single Choice & Comments -->
                <div class="MCQComment btne2 " style="padding:2%;">
                    <div id=dynamic_field3>
                        <div class="form-check">
                            <input class="form-check-input" disabled type="radio" name="exampleForm" id="radioExample1" />
                            <label class="form-check-label" for="radioExample1">
                                <input type="text" placeholder="Enter Option " name="add[]" style="border-width: 0px;" />
                            </label>
                            <button type="button" name="add" id="add3" class="btn " style="border-width:0px;font-size:larger;"><i class="fa-solid fa-circle-plus"></i></button>
                        </div>
                    </div>
                    <div>
                        <label for="reason">Reason:</label>
                        <input class="form-control" name="addcmt[]" id="reason" />
                    </div>
                </div>

                <!-- Multiple Answers -->
                <div class="Multiple_Choice btne2 " style="padding:2%;">
                    <div id="dynamic_field2">
                        <div class="form-check">
                            <input type="checkbox" disabled id="chkbox" /><label for="chkbox">&emsp;<input type="text" placeholder="Enter Option" name="add[]" style="border-width: 0px;"></label>&nbsp;&nbsp;&nbsp;
                            <button type="button" name="add" id="add2" class="btn" style="border-width:0px;font-size:larger;"><i class="fa-solid fa-circle-plus"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Multiple Answers and Comment -->
                <div class="Multiple_ChoiceComment btne2 " style="padding:2%;">

                    <div id="dynamic_field4">
                        <div class="form-check ">
                            <input type="checkbox" disabled id="chkbox" /><label for="chkbox">&emsp;<input type="text" placeholder="Enter Option" name="add[]" style="border-width: 0px;"></label>&nbsp;&nbsp;&nbsp;
                            <button type="button" name="add" id="add4" class="btn" style="border-width:0px;font-size:larger;"><i class="fa-solid fa-circle-plus"></i></button>
                        </div>
                    </div>
                    <div>
                        <label for="reason">Reason:</label>
                        <input class="form-control" name="addcmt[]" id="reason" />
                    </div>
                </div>

                <!-- Text/ParaGraph -->
                <div class="Text btne2 " style="padding:2%;">
                    <input class="form-control" id="question" placeholder="Enter Your Answer..." disabled />
                </div>

                <!-- Rating Scale-->
                <div class="RatingScale btne2 " style="padding:2%;">
                    <input type="range" class="form-range" min="0" max="5" step="1" id="customRange1">
                </div>

                <!-- Date-->
                <div class="Date btne2 " style="border-radius:8px; padding:8px;">
                    <input type="date" class="form-control" id="dte" disabled />
                </div>

                <!-- File Upload-->
                <div class="File btne2 " style="padding:2%;">
                    <div id="dynamic_field5">
                        <div class="form-group">
                            <b><label for="exampleFormControlFile1">Upload File here..</label></b><br>
                            <input type="file" class="form-control" disabled id="exampleFormControlFile1">&nbsp;
                            <br>
                        </div>
                    </div>
                </div>

                <!-- button -->
                <div class="d-flex justify-content-end p-2">
                    <button type="submit" class="btn btn-success text-right me-3" name="save_ques">Save</button>
                    <button type="submit" onClick="window.location.reload();" id="delete" class="btn btn-danger text-right">Delete</button>
                </div>
            </div>
        </div>

        <!-- ADD Question Button -->
        <?php
        if ($survey_info['survey_status'] == 'Active') {
            ?>
            <div>
                <button type="button" class="btn1" style="background-color:#138579; font-size:15px;" id="bt">+ Add
                    Question</button>
            </div>
            <?php
        }
        ?>
    </form>
</div>

<script src="../jquery-3.6.2.min.js"></script>
