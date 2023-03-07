<?php
session_start();

include '../configuration/connection.php';
include ROOT_PATH.'controller/user_controller.php';

$user = new user;
$user_id = $_REQUEST['user_id'];

$result=$user->delete_user($user_id);

if($result==1){

    $_SESSION['userdeletemsg'] = 'User Deleted Successfully !';
    header('Location:../user/userlist.php');
   
}
?>