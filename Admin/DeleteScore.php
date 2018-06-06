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
use Ats\Service\AdminService;
include("../Service/AdminService.php");
$user_id=$_GET['user_id'];
$date=$_GET['date'];
$project_id=$_GET['project_id'];
$result=AdminService::deleteScore($user_id,$project_id,$date);
if($result){
    $_SESSION['success']='删除成功！';
    echo "<script>history.go(-1);</script>";
}
else{
    $_SESSION['error']='删除失败！';
    echo "<script>history.go(-1);</script>";
}