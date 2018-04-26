<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/26
 * Time: 9:22
 */
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
include("../Service/roleService.php");
use Ats\Service\RoleService;
$role_name=$_POST['role_name'];
$role_rank=$_POST['role_rank'];

$result=RoleService::addRole($role_name,$role_rank);
if ($result) {
    $result_create_table=RoleService::addRoleColumn($role_name);
    if($result_create_table){
        $_SESSION['success']='add role successed';
        header('location:../Admin/manage.php');//添加成功
    }
    else{
        RoleService::deleteRole($role_rank);
        $_SESSION['error']='add role failed';
        header('location:../Admin/manage.php');//添加失败
    }
}
else{
    $_SESSION['error']='add role failed';
    header('location:../Admin/manage.php');//添加失败.
}