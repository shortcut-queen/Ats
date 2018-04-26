<?php
namespace Ats\Web;
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/25
 * Time: 22:32
 */
include("../Service/adminservice.php");
use Ats\Service\AdminService;
$admin_id=$_POST['admin_id'];
$admin_password=$_POST['admin_password'];
$result=AdminService::adminLogin($admin_id,$admin_password);

if ($result==1)
    echo 'login succeed';
else
    echo 'login failed';