<?php
namespace Ats\Web;
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/25
 * Time: 22:32
 * 所有的登录操作
 */
//未登录跳回登陆页面
session_start();
if(isset($_SESSION['admin_name']))
    header('location:../Admin/manage.php');
//引用类
include("../Service/AdminService.php");
use Ats\Service\AdminService;
//判断提交表单的名称
switch ($_POST['form_name']){
    case 'adminLogin':
        LoginController::adminLogin();break;
}

class LoginController
{
    //管理员登录
    static function adminLogin()
    {
        $admin_name = $_POST['admin_name'];
        $admin_password = $_POST['admin_password'];
        $result = AdminService::adminLogin($admin_name, $admin_password);
        echo $result;
        if ($result == 1) {
            $_SESSION['admin_name'] = $admin_name;
            header('location:../Admin/manage.php');//登录成功
        } else {
            $_SESSION['error'] = '登录失败';
            header('location:../Admin/admin.php');//登录失败
        }
    }
}