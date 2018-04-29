<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/27
 * Time: 18:16
 */
session_start();
if(isset($_SESSION['admin_name'])){
    session_destroy();
    header("location:../Admin/admin.php");
}
elseif(isset($_SESSION['user_id'])){
    session_destroy();
    header("location:../Home/index.php");
}