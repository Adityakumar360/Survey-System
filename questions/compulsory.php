<?php
include '../configuration/connection.php';
include ROOT_PATH.'controller/question_controller.php';

$ques = new questions;
$status =$_REQUEST['name'];
$qid =$_REQUEST['id'];

$result=$ques->compulsory($status,$qid);

?>