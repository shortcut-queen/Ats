<?php
namespace Ats\Admin;
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/25
 * Time: 22:32
 */
include("admindo.php");
$admindo=new AdminDo();
$admin_id=$_POST['admin_id'];
$admin_password=$_POST['admin_password'];
$result=$admindo->loginAdmin($admin_id,$admin_password);

$flag= $result['counts'];
if ($flag==1)
    echo 'login succeed';
else
    echo 'login failed';