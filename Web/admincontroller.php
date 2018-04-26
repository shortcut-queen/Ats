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

$user_id=$_POST['user_id'];
$user_name=$_POST['user_name'];
$user_password=$_POST['user_password'];
$brigade = $_POST['brigade'];
$battalion = $_POST['battalion'];
$continuous = $_POST['continuous'];
$platoon = $_POST['platoon'];
$monitor = $_POST['monitor'];
$warrior = $_POST['warrior'];
$officer = $_POST['officer'];

$result = AdminService::addUser($user_id, $user_name, $user_password, $brigade, $battalion, $continuous, $platoon, $monitor, $warrior, $officer);

if ($result==1) {
    $_SESSION['success']='添加用户成功';
    header('location:../Admin/manage.php');
}
else{
    $_SESSION['error']='添加用户失败';
    header('location:../Admin/manage.php');
}
