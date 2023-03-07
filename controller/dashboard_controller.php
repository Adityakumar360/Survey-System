<?php
class dashboard
{
    // Database connection
    public function __construct()
    {
        $db = new db;
        $this->conn = $db->conn;
    }

    // Survey Information
    public function surveyinfo($user_id)
    {
        if ($_SESSION['user_type'] == 'Admin') {

            $result = $this->conn->query("SELECT COUNT(DISTINCT u.user_id) AS 'totaluser', count(survey.`Survey_id`) AS 'total', SUM(survey.survey_status = 'Active') AS 'Activestatus',SUM(survey.survey_status = 'InActive') AS 'inactivestatus',SUM(survey.survey_status = 'Expired') AS 'expiredstatus',SUM(survey.survey_status = 'Deleted') AS 'deletedstatus' FROM users AS u LEFT JOIN survey  on u.user_id =survey.Survey_Created_By");
            return $res = mysqli_fetch_array($result);
        } else {
            $result = $this->conn->query("SELECT count(`Survey_id`) AS 'total', SUM(survey_status = 'Active') AS 'Activestatus',SUM(survey_status = 'InActive') AS 'inactivestatus',SUM(survey_status = 'Expired') AS 'expiredstatus',SUM(survey_status = 'Deleted') AS 'deletedstatus' FROM survey WHERE Survey_Created_By='$user_id'");
            return $res = mysqli_fetch_array($result);
        }
    }

    // Active survey Info
    public function active_survey($user_id = null)
    {

        if (!empty($user_id) && $_SESSION['user_type'] == 'User') {
            $arr[] = "Survey_Created_By='$user_id'";
        }
        $arr[] = "`survey_status`='Active'";
        $where1 = implode("&&", $arr);

        $result = $this->conn->query("SELECT * FROM `survey` WHERE $where1");
        return $result;


    }

    // Invite Count
    public function invite_count($survey_id)
    {
        return $result = $this->conn->query("SELECT COUNT(invitation_email) AS num FROM invitation WHERE Survey_id='$survey_id'");

    }
}