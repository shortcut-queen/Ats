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
use Ats\Service\AdminService;
use Ats\Service\UserService;
use Ats\Web\ResultShow;
//判断提交表单的名称
switch ($_POST['form_name']){
    case 'addAdmin':
        AdminController::addAdmin();break;
    case 'addUser':
        AdminController::addUser();break;
    case 'updateAdminPassword':
        AdminController::updateAdminPassword();break;
    case 'searchAllAdmin':
        AdminController::selectAllAdmin();break;
    case 'topList':
        AdminController::longhubang();break;
    case 'queryUser':
        AdminController::findUser();break;
    case 'editUser':
       AdminController::editUser();break;
}

class AdminController
{
    //添加管理员
     static function addAdmin()
    {
        include("../Service/AdminService.php");
        $admin_name = $_POST['admin_name'];
        $admin_type = $_POST['admin_type'];
        $result = AdminService::addAdmin($admin_name, $admin_type);

        if ($result == 1) {
            $_SESSION['success'] = '添加管理员成功';
            header('location:../Admin/alladmin.php');
        } else {
            $_SESSION['error'] = '添加管理员失败';
            header('location:../Admin/addadmin.php');
        }
    }
    //添加用户
    static function addUser()
    {
        include("../Service/UserService.php");
        $user_id = $_POST['user_id'];
        $user_name = $_POST['user_name'];
        $brigade = $_POST['brigade'];
        $battalion = $_POST['battalion'];
        $continuous = $_POST['continuous'];
        $platoon = $_POST['platoon'];
        $monitor = $_POST['monitor'];
        $officer = $_POST['officer'];
        $exist_result = UserService::existUser($user_id, $brigade, $battalion, $continuous, $platoon, $monitor, $officer);
        if ($exist_result) {
            $_SESSION['error'] = '用户编号已存在或该部队军官已存在！';
            header('location:../Admin/adduser.php');
        } else {
        if ($officer == 0) {
            $count_result = UserService::countWarrior($user_id, $brigade, $battalion, $continuous, $platoon, $monitor, $officer);
            if (mysql_fetch_array($count_result)[0] == 8) {
                $_SESSION['error'] = '该班人数已达上限!';
                header('location:../Admin/adduser.php');
            } else {
                $result = UserService::addUser($user_id, $user_name, $brigade, $battalion, $continuous, $platoon, $monitor, $officer);
                if ($result)
                    $_SESSION['success'] = '添加成功';
                else
                    $_SESSION['error'] = '添加失败';
                header('location:../Admin/adduser.php');
            }
        } else {
            $result = UserService::addUser($user_id, $user_name, $brigade, $battalion, $continuous, $platoon, $monitor, $officer);
            if ($result)
                $_SESSION['success'] = '添加成功';
            else
                $_SESSION['error'] = '添加失败';
            header('location:../Admin/adduser.php');
        }
        }
    }
    //修改管理员密码
    static function updateAdminPassword(){
        include("../Service/AdminService.php");
        $admin_name=$_SESSION['admin_name'];
        $old_password=$_POST['old_password'];
        $new_password=$_POST['new_password'];
        $result=AdminService::adminLogin($admin_name,$old_password);
        echo $result;
        if($result) {
            $resultUpdate = AdminService::updateAdminPassword($admin_name, $new_password);
            if ($resultUpdate)
                $_SESSION['success'] = "修改密码成功";
            else
                $_SESSION['error'] = "修改密码失败";
        }
        else
            $_SESSION['error'] = "原密码错误";
    }
    //查询所有管理员
    static function selectAllAdmin(){
         include ('../Service/AdminService.php');
         include ('ResultShow.php');
         $result=AdminService::selectAllAdmin();
         $echo_str=ResultShow::showAllAdmin($result);
         echo $echo_str;
    }
    //龙虎榜
    static function longhubang(){
        include('../Service/UserService.php');
        include ("ResultShow.php");
        $result = UserService::longhubang();
        $echo_str=ResultShow::showTopList($result);
        echo $echo_str;
    }
    //模糊查找用户
    static function findUser(){
         include ('../Service/UserService.php');
         include('ResultShow.php');
         $parameter = $_POST['query_info'];
         $result = UserService::findUser($parameter);
         $echo_str=ResultShow::showFoundUser($result);
         echo $echo_str;
    }
    //修改用户资料
    static function editUser(){
        include ('../Service/UserService.php');
        $user_id = $_POST['user_id'];
        $user_name = $_POST['user_name'];
        $brigade = $_POST['brigade'];
        $battalion = $_POST['battalion'];
        $continuous = $_POST['continuous'];
        $platoon = $_POST['platoon'];
        $monitor = $_POST['monitor'];
        $officer = $_POST['officer'];
        $exist_result=UserService::existUser($user_id,$brigade,$battalion,$continuous,$platoon,$monitor,$officer);
        if($exist_result){
            $_SESSION['error']='用户编号已存在或该部队军官已存在！';
            header('location:../Admin/EditUser.php?user_id='.$user_id);
        }else {
            if ($officer == 0) {
                $count_result = UserService::countWarrior($user_id, $brigade, $battalion, $continuous, $platoon, $monitor, $officer);
                if (mysql_fetch_array($count_result)[0] == 8) {
                    $_SESSION['error'] = '该班人数已达上限!';
                    header('location:../Admin/EditUser.php?user_id='.$user_id);
                } else {
                    $result = UserService::updateUser($user_id, $user_name, $brigade, $battalion, $continuous, $platoon, $monitor, $officer);
                    if ($result)
                        $_SESSION['success'] = '修改成功';
                    else
                        $_SESSION['error'] = '修改失败';
                    header('location:../Admin/EditUser.php?user_id='.$user_id);
                }
            } else {
                $result = UserService::updateUser($user_id, $user_name, $brigade, $battalion, $continuous, $platoon, $monitor, $officer);
                if ($result)
                    $_SESSION['success'] = '修改成功';
                else
                    $_SESSION['error'] = '修改失败';
                header('location:../Admin/EditUser.php?user_id='.$user_id);
            }
        }
     }
}