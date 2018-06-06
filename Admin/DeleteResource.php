<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/5/5
 * Time: 23:30
 */
session_start();
if(!isset($_SESSION['admin_name']))
    header('location:index.php');
use Ats\Service\ResourceService;
include("../Service/ResourceService.php");
$resource_id=$_GET['resource_id'];
$resource_type=$_GET['resource_type'];
$resource_address=$_GET['resource_address'];
$result=ResourceService::deleteResource($resource_id);
if($result){
    switch ($resource_type){
        case 1:unlink("../Static/upload/text/$resource_address");break;
        case 2:unlink("../Static/upload/img/$resource_address");break;
        case 3:unlink("../Static/upload/video/$resource_address");break;
    }
    $_SESSION['success']='删除成功！';
    header("location:allresource.php");
}
else{
    $_SESSION['error']='删除失败！';
    echo "<script>history.go(-1);</script>";
}