<?php
namespace Ats\Web;
/**
 * Created by PhpStorm.
 * User: SWX
 * Date: 2018/4/26
 * Time: 17:03
 */
//未登录跳回登陆页面
session_start();
if(!isset($_SESSION['admin_name']))
    header('location:../Admin/admin.php');
include("../Service/UserService.php");
use Ats\Service\UserService;

//判断提交表单的名称
switch ($_POST['form_name']){
    case 'addUser':
        UserController::addUser();break;
}

class UserController
{
    static function addUser()
    {
        $user_id = $_POST['user_id'];
        $user_name = $_POST['user_name'];
        $brigade = $_POST['brigade'];
        $battalion = $_POST['battalion'];
        $continuous = $_POST['continuous'];
        $platoon = $_POST['platoon'];
        $monitor = $_POST['monitor'];
        $warrior = $_POST['warrior'];
        $officer = $_POST['officer'];

        $result = UserService::addUser($user_id, $user_name, $brigade, $battalion, $continuous, $platoon, $monitor, $warrior, $officer);

        if ($result) {
            $_SESSION['success'] = 'add user successed';
            header('location:../Admin/manage.php');//添加成功
        } else {
            $_SESSION['error'] = 'add user failed';
            header('location:../Admin/manage.php');//添加失败
        }
    }
}