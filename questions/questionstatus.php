<?php
include '../configuration/connection.php';
include ROOT_PATH.'controller/question_controller.php';

$ques = new questions;
$status =$_REQUEST['name'];
$k =$_REQUEST['id'];

$result=$ques->update_ques_status($status,$k);