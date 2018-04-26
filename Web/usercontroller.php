<?php
/**
 * Created by PhpStorm.
 * User: SWX
 * Date: 2018/4/26
 * Time: 17:03
 */
namespace Ats\Web;

session_start();
if(!isset($_SESSION['admin_id']))
    header('location:../Admin/admin.php');
include("../Service/userService.php");

use Ats\Service\UserService;


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

$result = UserService::addUser($user_id, $user_name, $user_password, $brigade, $battalion, $continuous, $platoon, $monitor, $warrior, $officer);





if($result){
    $_SESSION['success']='add user successed';
    header('location:../Admin/manage.php');//添加成功
}
else{
    $_SESSION['error']='add user failed';
    header('location:../Admin/manage.php');//添加失败
}
