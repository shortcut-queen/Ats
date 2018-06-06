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
use Ats\Service\ProjectService;
include("../Service/ProjectService.php");
$project_id=$_GET['project_id'];
$result=ProjectService::deleteProject($project_id);
if($result){
    $_SESSION['success']='删除成功！';
    ProjectService::deleteProjectTable($project_id);
    echo "<script>history.go(-1);</script>";
}
else{
    $_SESSION['error']='删除失败！';
    echo "<script>history.go(-1);</script>";
}