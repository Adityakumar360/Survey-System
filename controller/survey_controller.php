<?php
class survey
{
    // Database connection
    public function __construct()
    {
        $db = new db;
        $this->conn = $db->conn;
    }

    // survey info with respect to surveyid
    public function survey_info_id($survey_id = null)
    {
        if (!empty($survey_id)) {
            $arr[] = "Survey_id='$survey_id'";
        }
        $arr[] = "survey_status!='Deleted'";
        $where1 = implode('&&', $arr);
        $result = $this->conn->query("SELECT * FROM `survey` where $where1");
        return $result;
    }

    // Active and Inactive Survey Information
    public function active_inactive_survey($user_id = null)
    {
        if (!empty($user_id) && $_SESSION['user_type'] == 'User') {
            $arr[] = "Survey_Created_By='$user_id'";
        }
        $arr[] = "survey_status!='Deleted'";
        $where1 = implode('&&', $arr);

        $result = $this->conn->query("SELECT * FROM `survey` WHERE $where1");
        return $result;
    }

    // Update survey status
    public function update_status($value, $survey_id)
    {
        return $result = $this->conn->query("UPDATE `survey` SET `survey_status`='$value' WHERE Survey_id='$survey_id'");

    }

    // Survey Title
    public function get_title($title)
    {
        $result = $this->conn->query("SELECT `Survey_title` FROM `survey` WHERE `Survey_title`='$title'");
        $num = mysqli_fetch_array($result);
        $newtitle = $num['Survey_title'] ?? null;
        if ($title == $newtitle) {
            $_SESSION['surveytitlemsg'] = 'Survey Title Already Exist!!';
        } else {
            return $result;
        }
    }

    // Insert Survey Data
    public function set_survey_data($title, $description, $category, $createor, $date, $enddate)
    {
        @$today = date('y-m-d');

        $status = (strtotime($date) <= strtotime($today)) ? 'Active' : 'InActive';

        $result = $this->conn->query("INSERT INTO `survey` (`Survey_id`, `Survey_title`, `Survey_description`, `Survey_Category`, `Survey_Created_By`,`survey_start_Date`,`survey_end_date`,`survey_status`) VALUES (NULL, '$title', '$description', '$category', '$createor','$date','$enddate','$status')");
        if ($result) {

            $_SESSION['surveymsg'] = 'New Survey Created Succesfully!!';
            return $result;
            header('Location:../survey/surveylist.php');
        } else {
            $_SESSION['unable_createmsg'] = 'Unable To create Survey';
        }
    }

    // Delete Survey
    public function delete_survey($survey_id)
    {
       return  $result = $this->conn->query("UPDATE `survey` SET `survey_status`='Deleted' WHERE `Survey_id`='$survey_id'");
       
    }

    // Update Survey Information

    public function update_survey($title, $description, $category, $date, $enddate, $today, $modified_by, $modified_date, $survey_id)
    {
        $status = (strtotime($date) <= strtotime($today)) ? 'Active' : 'InActive';

        $result = $this->conn->query("UPDATE `survey` SET `Survey_title`='$title',`Survey_description`='$description',`Survey_Category`='$category',`survey_status`='$status',`survey_start_Date`='$date' , `survey_end_date`='$enddate',`modified_by`='$modified_by',`modified_date`='$modified_date' WHERE `Survey_id`='$survey_id'");
        if ($result) {

            $_SESSION['surveyupdatemsg'] = 'Survey Information Updated Succesfully!!';
            echo "<script>
            window.location.href='../questions/question.php?Survey_id=$survey_id';
            </script>";
            return $result;
        } else {
            echo "<script>alert('Failed to updated Data ')</script>";
        }
    }

    // Expire Survey
    public function expire_survey($survey_id)
    {
        return $sql = $this->conn->query("UPDATE `survey` SET `survey_status`='Expired' WHERE `Survey_id`='$survey_id'");

    }

    // title and description of survey
    public function survey_title_description($survey_id)
    {
        $result = $this->conn->query("SELECT Survey_title,Survey_description FROM `survey` where Survey_id='$survey_id'");
        return $arr = mysqli_fetch_array($result);
    }

    // Question and option info
    public function question_option($survey_id)
    {
        $query = $this->conn->query("SELECT q.Question_description, q.Question_id,q.Question_type,o.Option_description FROM question AS q LEFT JOIN options AS o on q.Question_id=o.question_id Where q.Survey_id='$survey_id' AND q.status!='Deleted' AND (q.Question_type IN('Text','RatingScale','Date','File') OR o.status='Active') ORDER BY q.Question_id,o.Option_id");
        while ($res = mysqli_fetch_assoc($query)) {

            $opt['type'] = $res['Question_type'];
            $opt['options'] = $res['Option_description'];
            $opt['que_id'] = $res['Question_id'];

            $data[$res['Question_description']][] = $opt;
        }
        return $data;
    }

    // Answer submission
    public function survey_response($survey_id, $uname, $uemail)
    {
        $input_arr_1 = array_map('array_filter', $_POST['ans']);
        $input_arr = array_filter($input_arr_1);

        @$filename = $_FILES['file']['name'];
        @$tempname = $_FILES['file']['tmp_name'];
        $folder = '../image/' . $filename;

        move_uploaded_file($tempname, $folder);

        foreach ($input_arr as $q_id => $answers) {
            $cmt = isset($answers['cmt']) ? $answers['cmt'] : NULL;
            foreach ($answers as $key => $type) {
                foreach ((array) $type as $k => $v) {
                    if ($key != 'cmt') {
                        if ($key == 'File') {
                            $sql = $this->conn->query("INSERT INTO `answers`(`Survey_id`,`ansquestion_id`,`question_type`, `Answer_description`,`comment`,`user_name`, `user_email`) VALUES ('$survey_id','$q_id','$key','$filename','$cmt','$uname','$uemail')");
                        } else {
                            $sql = $this->conn->query("INSERT INTO `answers`(`Survey_id`,`ansquestion_id`,`question_type`, `Answer_description`,`comment`,`user_name`, `user_email`) VALUES ('$survey_id','$q_id','$key','$v','$cmt','$uname','$uemail')");
                        }
                    }
                }
            }
        }
        $res = $this->conn->query("UPDATE `invitation` SET `status`='submitted',`submitted_time`=NOW() WHERE `invitation_email`='$uemail'");

        if ($sql) {
            echo "<script>
                window.location.href='../report/thankyou.php';
                </script>";
            return $sql;
        } else {
            echo "<script>alert('Unable to Submit Survey Response !! ')</script>";
        }
    }

    // SurveyList Custom Filter
    public function custom_filter($status, $user_id)
    {
        if ($status == 'Active' || $status == 'InActive' || $status == 'Expired') {

            if (!empty($user_id) && $_SESSION['user_type'] == 'User') {
                $arr[] = "`Survey_Created_By`='$user_id'";
            }
            $arr[] = "`survey_status`='$status'";
            $where1 = implode('&&', $arr);

            $result = $this->conn->query("SELECT * FROM `survey` where $where1");
            return $result;
        } else {

            if ($_SESSION['user_type'] == 'User')
                return $result = $this->conn->query("SELECT * FROM `survey` WHERE `Survey_Created_By`='$user_id'");
            else {
                return $result = $this->conn->query('SELECT * FROM `survey`');
            }
        }
    }

    // Status Change 
    public function status_change($status, $survey_id)
    {
        return $result = $this->conn->query("UPDATE `survey` SET `survey_status`='$status' WHERE Survey_id='$survey_id' AND `survey_status` ='Active'");
    }
}