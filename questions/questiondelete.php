<?php
session_start();
include '../configuration/connection.php';
include ROOT_PATH.'controller/question_controller.php';

$ques = new questions;
$q_id = $_REQUEST['ques_id'];

$result=$ques->delete_ques_option($q_id);

$referer = $_SERVER['HTTP_REFERER'];
$_SESSION['deletequesmsg'] = 'Question Deleted Successfully !';
header("Location: $referer");

?>

