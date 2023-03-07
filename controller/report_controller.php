<?php

class report
{
    // Database connection
    public function __construct()
    {
        $db = new db;
        $this->conn = $db->conn;
    }

    // User Data
    public function user_data($survey_id)
    {
        $result = $this->conn->query("SELECT DISTINCT `user_name`,`user_email`,i.`status`  FROM answers AS a LEFT JOIN invitation as i ON a.user_email=i.invitation_email Where a.Survey_id='$survey_id'");
        return $result;
    }

    //Survey Data With repect to username and user email 
    public function survey_data($survey_id, $email)
    {
        try {
            $result = $this->conn->query("SELECT `user_name`,`user_email`,`Question_description`,`Answer_description`,q.`question_type`,`comment` FROM question as q LEFT JOIN answers as a on q.Question_id=a.ansquestion_id Where q.Survey_id='$survey_id' AND a.Survey_id='$survey_id' AND a.user_email='$email' AND q.status='Active'");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $name = $row["user_name"];
                    $email = $row["user_email"];
                    $ques['ques'] = $row["Question_description"];
                    $ques['ans'] = $row["Answer_description"];
                    $ques['type'] = $row["question_type"];
                    $ques['cmt'] = $row["comment"];
                    $report[$name][$email][] = @$ques;
                }
            }
            if (!empty($report)) {
                return $report;
            } else {
                throw new Exception("<div class='alert alert-warning m-4' role='alert'>
                <b>No Response Recorded!!</b>
              </div>");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Answers
    public function response($survey_id, $email)
    {
        $result = $this->conn->query("SELECT `user_name`,`user_email`,`Question_description`,`Answer_description`,`comment` FROM question as q LEFT JOIN answers as a on q.Question_id=a.ansquestion_id Where q.Survey_id='$survey_id' AND a.Survey_id='$survey_id' AND a.user_email='$email' AND q.status='Active'");
        return $result;
    }

    // Question And Answers For graph
    public function graph_data($survey_id)
    {
        try {

            $result = $this->conn->query("SELECT a.`Survey_id`,a.Answer_description,COUNT(a.`Answer_description`) AS total ,q.`Question_description`,q.`Question_type`,q.`Question_id` FROM `answers` AS a LEFT JOIN question AS q ON a.ansquestion_id=q.Question_id WHERE a.Survey_id='$survey_id' AND a.question_type IN('MCQ','Multiple_Choice','MCQComment','Multiple_ChoiceComment')  GROUP BY a.Answer_description ORDER BY q.`Question_id`;");
            while ($row = mysqli_fetch_assoc($result)) {
                $chart['type'] = $row['Question_type'];
                $chart['ans'] = $row['Answer_description'];
                $chart['count'] = $row['total'];

                $data[$row['Question_description']][] = $chart;
            }
            if (!empty($data)) {
                return $data;
            } else {
                throw new Exception("<div class='alert alert-warning m-4' role='alert'>
            <b>No Response Recorded! To Show Graphical Report!</b>
          </div>");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Total Users
    public function graph_user_data()
    {
        try {

            $result = $this->conn->query("SELECT status, COUNT(status) AS 'Total'  FROM `users` GROUP BY `status`");

            if (!empty($result)) {
                return $result;
            } else {
                throw new Exception("<div class='alert alert-warning m-4' role='alert'>
            <b>No Response Recorded! To Show Graphical Report!</b>
          </div>");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Total Survey
    public function graph_survey_data($user_id)
    {
        try {
            if ($_SESSION['user_type'] == 'Admin') {
                $result = $this->conn->query("SELECT survey_status, COUNT(survey_status) AS 'Total'  FROM `survey` GROUP BY survey_status");
            } else {
                $result = $this->conn->query("SELECT survey_status, COUNT(survey_status) AS 'Total'  FROM `survey` WHERE `Survey_Created_By`='$user_id' GROUP BY survey_status");
            }

            if (!empty($result)) {
                return $result;
            } else {
                throw new Exception("<div class='alert alert-warning m-4' role='alert'>
            <b>No Response Recorded! To Show Graphical Report!</b>
          </div>");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}