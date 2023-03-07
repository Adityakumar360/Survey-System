<?php

class questions
{
    // Database connection
    public function __construct()
    {
        $db = new db;
        $this->conn = $db->conn;
    }

    // Survey Information with respect to survey_id
    public function survey_info_id($survey_id)
    {
        $result = $this->conn->query("SELECT * FROM `survey` where Survey_id='$survey_id'");
        return $arr = mysqli_fetch_assoc($result);
    }

    // Adding Question
    public function ques_add($type, $question, $survey_id)
    {
        $flag = false;

        $options = $_POST['add'];
        $options = array_values(array_filter($options));

        if (@$question != "" && @$type != "") {
            if ($type == "MCQ" || $type == "MCQComment" || $type == "Multiple_Choice" || $type == "Multiple_ChoiceComment") {
                if (!empty($options)) {

                    $result = $this->conn->query("INSERT INTO `question`(`Question_description`, `Question_type`, `Survey_id`) VALUES ('$question','$type','$survey_id')");
                    // latest ID
                    $insert_id = mysqli_insert_id($this->conn);

                    $flag = true;

                    $query1 = $this->conn->query("SELECT Question_id FROM question WHERE Question_id='$insert_id'");
                    $arr1 = mysqli_fetch_array($query1);
                    $ques_id = $arr1['Question_id'];

                    // OPTIONS
                    foreach ($options as $inp) {

                        $resultoption = $this->conn->query("INSERT INTO `options` (`Option_description`, `question_id`) VALUES ('$inp', '$ques_id')");
                        ;
                        $flag = false;
                        ;
                    }

                    $_SESSION['addmsg'] = "Question Added successfully!!:)";
                } else {
                    $_SESSION['optmsg'] = "Please Enter Option";
                }
            } else {
                $result = $this->conn->query("INSERT INTO `question`( `Question_description`, `Question_type`, `Survey_id`) VALUES ('$question','$type','$survey_id')");
                $flag = true;
            }
        } else {
            $_SESSION['emptymsg'] = "Please Enter Question OR Choose Question Type!!!";
        }
        if ($flag) {
            $_SESSION['addmsg'] = "Question Added successfully!!:)";
        }
        return $flag;
    }

    // Displaying Question on Question page
    public function display_question($survey_id)
    {
        try {
            $result = $this->conn->query("SELECT * FROM question AS q LEFT JOIN options AS o on q.Question_id=o.question_id Where q.Survey_id='$survey_id' AND q.status!='Deleted' AND (o.status='Active' OR q.Question_type IN('Text','Date','File','RatingScale')) ORDER BY q.Question_id, o.Option_id");

            while ($res = mysqli_fetch_assoc($result)) {
                $opt['type'] = $res['Question_type'];
                $opt['opt_id'] = $res['Option_id'];
                $opt['options'] = $res['Option_description'];
                $opt['que_id'] = $res['Question_id'];

                $data[$res['Question_description']][] = $opt;
            }
            if (!empty($data)) {
                return $data;
            } else {
                throw new Exception("<div class='alert alert-warning' role='alert'>
                <b>No Question To Display! Please Add Question!!</b>
              </div>");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Question Deletion And Option too
    public function delete_ques_option($question_id)
    {
        $result = $this->conn->query("UPDATE `question` SET `status`='Deleted' WHERE `Question_id`='$question_id'");
        $result = $this->conn->query("UPDATE `options` SET `status`='Deleted' WHERE `question_id`='$question_id'");
        return $result;
    }

    // Option Deletion
    public function option_delete($option_id)
    {
        return $result = $this->conn->query("UPDATE `options` SET `status`='Deleted' WHERE  Option_id = '$option_id'");
    }

    // Diplaying Question in Question Edit page
    public function display_question_edit($question_id)
    {

        $result = $this->conn->query("SELECT * FROM question AS q LEFT JOIN options AS o on q.Question_id=o.question_id Where q.Question_id='$question_id'AND (q.Question_type IN('Text','RatingScale','Date','File') OR o.status='Active') ORDER BY q.Question_id,o.Option_id;");
        while ($res = mysqli_fetch_assoc($result)) {
            $opt['opt_id'] = $res['Option_id'];
            $opt['options'] = $res['Option_description'];
            $opt['que_id'] = $res['Question_id'];

            $data[$res['Question_description']][] = $opt;
        }
        if (!empty($data)) {
            return @$data;
        }
    }

    // Question Information
    public function question_info($question_id)
    {
        $result = $this->conn->query("SELECT Question_type,Question_description,`status`,is_compulsory FROM question WHERE Question_id='$question_id'");
        return $arr = mysqli_fetch_array($result);
    }

    // Option id with respect to question
    public function optionid_wrt_question($question_id)
    {
        try {
            $result = $this->conn->query("SELECT o.Option_id,q.Question_type FROM question AS q LEFT JOIN options AS o on q.Question_id=o.question_id Where  q.Question_id='$question_id' AND o.status!='Deleted' ORDER BY q.Question_id");
            while ($res = mysqli_fetch_assoc($result)) {
                $options_id[] = $res['Option_id'];

            }
            if (!empty($options_id)) {
                return $options_id;
            } else {
                throw new Exception("");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Updating Question
    public function update_question($ques_type, $type1, $options_id, $question, $question_id, $user_id, $today, $survey_id)
    {
        $options = $_REQUEST['add'];
        $options = array_filter($options);
        $i = 0;

        if ($type1 == "MCQ" || $type1 == "MCQComment" || $type1 == "Multiple_Choice" || $type1 == "Multiple_ChoiceComment") {
            if (!empty($options)) {
                if (count((array) $options_id) <= count($options)) {

                    $result = $this->conn->query("UPDATE `question` SET `Question_description`='$question',`Question_type`='$type1',`question_modified_by`='$user_id' WHERE `Question_id`='$question_id'");
                    $flag = true;
                    foreach ($options as $inp) {
                        if ($i <= count((array) $options_id)) {
                            $opt_id = $options_id[$i] ?? NULL;

                            $i++;
                        }
                        $result = $this->conn->query("REPLACE INTO `options` (`Option_id`,`Option_description`, `question_id`) VALUES ('$opt_id','$inp', '$question_id')");
                        $flag = true;
                    }
                    if (@$flag) {
                        $_SESSION['update_quesmsg'] = "Question Successfully updated!!";
                        echo "<script>location = location.href;</script>";
                        exit;
                    } else {
                        $_SESSION['updatefailed_quesmsg'] = "Failed to updated Question ";
                    }
                }
            } else {
                $_SESSION['optmsg'] = "Enter Options!!!";
            }
        } else {
            $this->conn->query("UPDATE `question` SET `Question_description`='$question',`Question_type`='$type1',`question_modified_by`='$user_id' WHERE `Question_id`=$question_id");
            $flag = true;

            for ($i = 0; $i < count((array) $options_id); $i++) {
                $opt_id1 = $options_id[$i] ?? NULL;
                $result = $this->conn->query("DELETE FROM `options` WHERE  Option_id = '$opt_id1'");
                $flag = true;
            }
            if (@$flag) {
                $_SESSION['update_quesmsg'] = "Question Successfully updated!!";
                echo "<script>location = location.href;</script>";
                exit;
            } else {
                $_SESSION['updatefailed_quesmsg'] = "Failed to updated Question ";
            }
        }
    }

    // Updating Status
    public function update_ques_status($value, $question_id)
    {
        return $result = $this->conn->query("UPDATE `question` SET `status`='$value' WHERE Question_id='$question_id'");

    }

    // Compulsory question
    public function compulsory($status, $question_id)
    {
        return $result = $this->conn->query("UPDATE `question` SET `is_compulsory`='$status' WHERE Question_id='$question_id'");
    }
}