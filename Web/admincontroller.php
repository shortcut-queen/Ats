<?php
namespace Ats\Web;
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/25
 * Time: 22:32
 */
session_start();
if(!isset($_SESSION['admin_id']))
    header('location:../Admin/admin.php');//未登录跳回登陆页面
include("../Service/adminService.php");
use Ats\Service\AdminService;
$admin_id=$_POST['admin_id'];
$admin_name=$_POST['admin_name'];
$admin_password=$_POST['admin_password'];
$admin_type=$_POST['admin_type'];
$result=AdminService::addAdmin($admin_id,$admin_name,$admin_password,$admin_type);

if ($result==1) {
    $_SESSION['success']='添加管理员成功';
    header('location:../Admin/manage.php');
}
else{
    $_SESSION['error']='添加管理员失败';
    header('location:../Admin/manage.php');
}