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
        $admin_name=$_SESSION['admin_name'];
        $result=ResourceService::uploadResource($resource_name,$resource_type,$resource_file_name,$resource_about,$admin_name);
        if($result){
            switch ($resource_type){
                //文档
                case 1:
                    move_uploaded_file($resource_file,"../Static/upload/text/".$resource_file_name);break;
            }
            $_SESSION['success']="上传资源成功！";
            header("location:../Admin/uploadresource.php");
        }else{
            $_SESSION['error']="上传资源失败！";
            header("location:../Admin/uploadresource.php");
        }
    }
}