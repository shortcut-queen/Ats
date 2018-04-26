<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/26
 * Time: 20:49
 */

namespace Ats\Dao;

include("../Conn/conn.php");
use Ats\Conn\Conn;
class ProjectDao
{
    //添加项目
    static function addProject($project_name,$project_unit,$project_great,$project_good,$project_qualified){
        $SQL_ADD_PROJECT="insert into ats_project(Project_Name,Project_Unit,Project_Great,Project_Good,Project_Qualified)values('$project_name','$project_unit',$project_great,$project_good,$project_qualified)";
        Conn::init();
        $result=Conn::excute($SQL_ADD_PROJECT);
        Conn::close();
        return $result;
    }
}