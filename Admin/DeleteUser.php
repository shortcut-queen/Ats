<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/5/5
 * Time: 23:30
 */
session_start();
if(!isset($_SESSION['admin_name']))
    header('location:index.php');
use Ats\Service\UserService;
include("../Service/UserService.php");
$user_id=$_GET['user_id'];
$result=UserService::deleteUser($user_id);
if($result){
    $_SESSION['success']='删除成功！';
    echo "<script>history.go(-1);</script>";
}
else{
    $_SESSION['error']='删除失败！';
    echo "<script>history.go(-1);</script>";
}