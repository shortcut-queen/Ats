<?php
namespace Ats\Web;
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/25
 * Time: 22:32
 */
//未登录跳回登陆页面
session_start();
if(!isset($_SESSION['admin_name']))
    header('location:../Admin/admin.php');
//引用类
include("../Service/AdminService.php");
use Ats\Service\AdminService;
//判断提交表单的名称
switch ($_POST['form_name']){
    case 'addAdmin':
        AdminController::addAdmin();break;
}

class AdminController
{
     static function addAdmin()
    {
        $admin_name = $_POST['admin_name'];
        $admin_type = $_POST['admin_type'];
        $result = AdminService::addAdmin($admin_name, $admin_type);

        if ($result == 1) {
            $_SESSION['success'] = '添加管理员成功';
            header('location:../Admin/manage.php');
        } else {
            $_SESSION['error'] = '添加管理员失败';
            header('location:../Admin/manage.php');
        }
    }
}