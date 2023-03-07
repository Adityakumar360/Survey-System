<?php
include '../configuration/connection.php';
include ROOT_PATH.'controller/survey_controller.php';

$survey = new survey;
$survey_id=$_REQUEST['Survey_id'];

$result=$survey->expire_survey($survey_id);
if($result){
    header("Location:../survey/surveylist.php");
}

?>