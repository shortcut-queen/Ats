<?php
namespace Ats\Web;
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/25
 * Time: 22:32
 */
//未登录跳回登陆页面
session_start();
if(!isset($_SESSION['admin_name'])&&!isset($_SESSION['user_id']))
    header('location:../Admin/admin.php');
//引用类
use Ats\Service\ProjectService;
//判断提交表单的名称
switch ($_POST['form_name']){
    case 'addProject':
        ProjectController::addProject();break;
}

class ProjectController
{
    //增加训练项目
    static function addProject()
    {
        //引用文件
        include("../Service/ProjectService.php");
        $project_name = $_POST['project_name'];
        $project_unit = $_POST['project_unit'];
        $project_great = $_POST['project_great'];
        $project_good = $_POST['project_good'];
        $project_qualified = $_POST['project_qualified'];
        $result = ProjectService::addProject($project_name, $project_unit, $project_great, $project_good, $project_qualified);
        if ($result) {
            $result_project = ProjectService::createProjectTable($project_name);
            if ($result_project) {
                $_SESSION['success'] = '添加项目成功';
                header('location:../Admin/manage.php');
            } else {
                ProjectService::deleteProject($project_name);
                $_SESSION['error'] = '添加项目失败';
                header('location:../Admin/manage.php');
            }
        } else {
            $_SESSION['error'] = '添加项目失败';
            header('location:../Admin/manage.php');
        }
    }
    //删除训练项目

    //查询所有项目名称
    static function selectAllProject(){
        return ProjectService::selectAllProject();
    }
}