<?php
include '../configuration/connection.php';
include ROOT_PATH . 'controller/survey_controller.php';

$survey = new survey();
$info = $survey->survey_info_id();
$today = date('Y-m-d');

while ($arr = mysqli_fetch_assoc($info)) {
    $id = $arr['Survey_id'];
    $date = $arr['survey_start_Date'];
    $enddate = $arr['survey_end_date'];

    if (
        strtotime($date) <= strtotime($enddate) &&
        strtotime($enddate) >= strtotime($today) &&
        strtotime($date) <= strtotime($today)
    ) {
        $status = 'Active';
    } else {
        if (strtotime($enddate) < strtotime($today)) {
            $status = 'Expired';
        }
        //  else {
        //     $status = 'InActive';
        // }
    }
    $result = $survey->status_change($status, $id);
}
