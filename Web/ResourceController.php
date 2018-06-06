<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/5/30
 * Time: 13:56
 */

namespace Ats\Web;
//未登录跳回登陆页面
session_start();
if(!isset($_SESSION['admin_name'])&&!isset($_SESSION['user_id']))
    header('location:../Admin/admin.php');
//引用类
use Ats\Service\ResourceService;
use Ats\Web\ResultShow;
//判断提交表单的名称
switch ($_POST['form_name']){
    case 'upLoadResource':
        ResourceController::uploadResource();break;
    case 'searchAllResource':
        ResourceController::searchAllResource();break;
    case 'allResource':
        ResourceController::allResource();break;
}

class ResourceController
{
    static function uploadResource(){
        include("../Service/ResourceService.php");
        $resource_name=$_POST['resource_name'];
        $resource_file=$_FILES['resource_file'];
        $resource_type=$_POST['resource_type'];
        $resource_about=$_POST['resource_about'];
        $resource_file_name=$resource_file['name'];
        $resource_file_size=$resource_file['size'];
        $resource_file_type=$resource_file['type'];
        if($resource_name==''||$resource_file==null||$resource_type==''){
            $_SESSION['error']="请填写完整的资料！";
            header("location:../Admin/uploadresource.php");
        }else if($resource_file_type!="image/gif" && $resource_file_type!="image/jpeg" && $resource_file_type!="image/png" && $resource_file_type!="application/pdf" && $resource_file_type!="text/plain" && $resource_file_type!="video/avi" && $resource_file_type!="video/mp4"){
            $_SESSION['error']="不支持的文件格式！";
            header("location:../Admin/uploadresource.php");
        }else if(($resource_file_type=="image/gif"||$resource_file_type=="image/jpeg"||$resource_file_type=="image/png") && $resource_file_size>3145728){
            $_SESSION['error']="上传图片应不超过3M！";
            header("location:../Admin/uploadresource.php");
        }else if(($resource_file_type=="application/pdf"||$resource_file_type=="text/plain") && $resource_file_size>5242880){
            $_SESSION['error']="上传文档应不超过5M！";
            header("location:../Admin/uploadresource.php");
        }else if(($resource_file_type=="video/avi"||$resource_file_type=="video/mp4") && $resource_file_size>20971520){
            $_SESSION['error']="上传视频应不超过20M！";
            header("location:../Admin/uploadresource.php");
        }else {
            $admin_name = $_SESSION['admin_name'];
            $result = ResourceService::uploadResource($resource_name, $resource_type, $resource_file_name, $resource_about, $admin_name);
            if ($result) {
                switch ($resource_type) {
                    //文档
                    case 1:
                        move_uploaded_file($resource_file['tmp_name'], "../Static/upload/text/" . $resource_file_name);
                        break;
                    //图片
                    case 2:
                        move_uploaded_file($resource_file['tmp_name'], "../Static/upload/img/" . $resource_file_name);
                        break;
                    //视频
                    case 3:
                        move_uploaded_file($resource_file['tmp_name'], "../Static/upload/video/" . $resource_file_name);
                        break;
                }
                $_SESSION['success'] = "上传资源成功！";
                header("location:../Admin/uploadresource.php");
            } else {
                $_SESSION['error'] = "上传资源失败！";
                header("location:../Admin/uploadresource.php");
            }
        }
    }
    static function searchAllResource(){
        include("../Service/ResourceService.php");
        include ("ResultShow.php");
        $search_type=$_POST['resource_type'];
        $request_type=$_POST['request_type'];
        $result=ResourceService::searchAllResource($search_type);
        if($request_type=="admin")
            $echo_str=ResultShow::showResource($result);
        else
            $echo_str=ResultShow::showUserResource($result);
        echo $echo_str;
    }
    static function allResource(){
        include("../Service/ResourceService.php");
        include ("ResultShow.php");
        $result=ResourceService::allResource();
        $request_type=$_POST['request_type'];
        if($request_type=="admin")
            $echo_str=ResultShow::showResource($result);
        else
            $echo_str=ResultShow::showUserResource($result);
        echo $echo_str;
    }
}