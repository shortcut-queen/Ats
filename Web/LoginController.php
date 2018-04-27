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
if(!isset($_SESSION['admin_name'] ) or !isset($_SESSION['user_id']))
    header('location:../Home/index.php');
//登录了跳到登录页面
if(isset($_SESSION['admin_name']))
    header('location:../Admin/manage.php');
if(isset($_SESSION['user_id']))
    header('location:../Home/index.php');
//引用类

use Ats\Service\AdminService;
use Ats\Service\UserService;

//判断提交表单的名称
switch ($_POST['form_name']){
    case 'adminLogin':
        LoginController::adminLogin();break;
    case 'userLogin':
        LoginController::userLogin();break;
}

class LoginController
{
    //管理员登录
    static function adminLogin()
    {
        //引用文件
        include("../Service/AdminService.php");
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
    static function userLogin()
    {
        //引用文件
        include("../Service/userService.php");
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $result = UserService::userLogin($user_name,$user_password);
        echo $result;
        if ($result == 1) {
            $_SESSION['user_name'] = $user_name;
            header('location:../Home/user.php');//登录成功
        } else {
            $_SESSION['error'] = '登录失败';
            header('location:../Home/index.php');//登录失败
        }
    }
}