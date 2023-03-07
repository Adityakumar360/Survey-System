<?php
session_start();
include '../configuration/connection.php';
include ROOT_PATH.'controller/question_controller.php';

$ques = new questions;
$id=$_REQUEST['optid'];

$data=$ques->option_delete($id);

if($data){
    $_SESSION['delteopt_msg'] = "Option Deleted Successfully!!";
    $referer = $_SERVER['HTTP_REFERER'];
    header("Location: $referer");
    
}


?>