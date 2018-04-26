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
use Ats\Service\ProjectService;
$project_name=$_POST['project_name'];
$project_unit=$_POST['project_unit'];
$project_great=$_POST['project_great'];
$project_good=$_POST['project_good'];
$project_qualified=$_POST['project_qualified'];
$result=ProjectService::addProject($project_name,$project_unit,$project_great,$project_good,$project_qualified);

if ($result==1) {
    $_SESSION['success']='添加管理员成功';
    header('location:../Admin/manage.php');
}
else{
    $_SESSION['error']='添加管理员失败';
    header('location:../Admin/manage.php');
}