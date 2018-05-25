<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/26
 * Time: 21:02
 */

namespace Ats\Service;
//引用类
include("../Dao/ProjectDao.php");
use Ats\Dao\ProjectDao;
//对训练项目的操作功能
class ProjectService
{
    //添加训练项目
    static function addProject($project_name,$project_unit,$project_great,$project_good,$project_qualified){
        return ProjectDao::addProject($project_name,$project_unit,$project_great,$project_good,$project_qualified);
    }
    //新建训练项目表
    static function createProjectTable($project_name){
        return ProjectDao::createProjectTable($project_name);
    }
    //修改训练项目
    static  function updateProject($project_id,$project_name,$project_unit,$project_great,$project_good,$project_qualified){
        return ProjectDao::updateProject($project_id,$project_name,$project_unit,$project_great,$project_good,$project_qualified);
    }
    //删除训练项目
    static function deleteProject($project_id){
        return ProjectDao::deleteProject($project_id);
    }
    //删除训练项目表
    static  function  deleteProjectTable($project_id){
        return ProjectDao::deleteProjectTable($project_id);
    }
    //查询所有项目表
    static function selectAllProject(){
        return ProjectDao::selectAllProject();
    }
    //查询指定项目表
    static  function selectProject($project_id){
        return ProjectDao::selectProject($project_id);
    }
}