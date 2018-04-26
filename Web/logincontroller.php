<?php
namespace Ats\Web;
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/25
 * Time: 22:32
 */
session_start();
include("../Service/adminService.php");
use Ats\Service\AdminService;
$admin_id=$_POST['admin_id'];
$admin_password=$_POST['admin_password'];
$result=AdminService::adminLogin($admin_id,$admin_password);

if ($result==1) {
    $_SESSION['admin_id']=$admin_id;
    header('location:../Admin/manage.php');//登录成功
}
else
    header('location:../Admin/admin.php');//登录失败