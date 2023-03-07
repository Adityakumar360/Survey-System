<?php
include '../configuration/connection.php';
include ROOT_PATH . 'controller/report_controller.php';

$surveyreport = new report;
$survey_id = $_REQUEST['sid'];
$email = $_REQUEST['email'];
// download csv
if (isset($_REQUEST["export"]))

    header('Content-Type:text/csv;charset=utf-8');
header('Content-Disposition: attachment;filename=SurveyReport.csv');
$output = fopen("php://output", "w");
fputcsv($output, array('User Name', 'User Email', 'Question', 'Answer', 'Comment'));

$result = $surveyreport->response($survey_id, $email);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}
fclose($output);