<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/5/5
 * Time: 23:30
 */
//未登录返回登陆页面
session_start();
if(!isset($_SESSION['admin_name']))
    header('location:index.php');
use Ats\Service\AdminService;
include("../Service/AdminService.php");
$admin_name=$_GET['admin_name'];
$result=AdminService::deleteAdmin($admin_name);
if($result){
    $_SESSION['success']='删除成功！';
    echo "<script>history.go(-1);</script>";
}
else{
    $_SESSION['error']='删除失败！';
    echo "<script>history.go(-1);</script>";
}