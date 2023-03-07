<?php
session_start();
include '../configuration/connection.php';
include ROOT_PATH.'controller/user_controller.php';

$user=new user;

if(isset($_REQUEST['changepass'])){
    extract($_REQUEST);
    $result=$user->get_pass($_SESSION['user_mail'],sha1($oldpass));
    if($result){
    $changepass=$user->change_pass($_SESSION['user_mail'],sha1($newpass));
    header('location:../user/profile.php');
    }
}