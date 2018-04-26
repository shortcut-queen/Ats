<?php
/**
 * Created by PhpStorm.
 * User: SWX
 * Date: 2018/4/26
 * Time: 23:19
 */
$user_id=$_POST['user_id'];
$user_password= $_POST['user_password'];

use \Ats\Service\UserService;
$result=UserService::userLogin();
if($result==1)
    $_SESSION['user_id']=$user_id;
    $_SESSION['user_name']=&user_name;