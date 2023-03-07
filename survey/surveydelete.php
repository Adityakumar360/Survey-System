<?php
session_start();

include '../configuration/connection.php';
include ROOT_PATH.'controller/survey_controller.php';
$survey = new survey;
$survey_id = $_REQUEST['Survey_id'];

$result = $survey->delete_survey($survey_id);
if($result==1){

    $_SESSION['deletemsg'] = 'Survey Deleted Successfully !';
    header('Location:../survey/surveylist.php');
   
}