<?php
include '../configuration/connection.php';
include '../controller/survey_controller.php';

$survey = new survey;

$status = $_REQUEST['name'];
$survey_id = $_REQUEST['id'];

$result = $survey->update_status($status, $survey_id);
?>