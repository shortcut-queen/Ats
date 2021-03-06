<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/26
 * Time: 20:49
 */

namespace Ats\Dao;
//引用类
include("../Conn/conn.php");
use Ats\Conn\Conn;
//对项目的操作
class ProjectDao
{
    //添加训练项目
    static function addProject($project_name,$project_unit,$project_great,$project_good,$project_qualified){
        $SQL_ADD_PROJECT="insert into ats_project(Project_Name,Project_Unit,Project_Great,Project_Good,Project_Qualified)values('$project_name','$project_unit',$project_great,$project_good,$project_qualified)";
        Conn::init();
        $result=Conn::excute($SQL_ADD_PROJECT);
        Conn::close();
        return $result;
    }
    //删除训练项目
    static function deleteProject($project_id){
        $SQL_DELETE_PROJECT="delete from ats_project where Project_Name='$project_id'";
        Conn::init();
        $result=Conn::excute($SQL_DELETE_PROJECT);
        Conn::close();
        return $result;
    }

    //创建新训练项目表
    static function createProjectTable($project_name){
        Conn::init();
        $SQL_SELECT_PROJECT_ID_BY_PROJECT_NAME="select Project_Id from ats_project where Project_Name='$project_name'";
        $result_project_id=Conn::query($SQL_SELECT_PROJECT_ID_BY_PROJECT_NAME);
        $project_id=mysql_fetch_array($result_project_id)[0];
        $table_name="ats_project_$project_id";
        $SQL_CREATE_PROJECT_TABLE="create table $table_name(User_Id int(8),Train_Date date,Train_Score float(8,2),primary key(User_Id,Train_Date),foreign key(User_Id) references ats_User(User_Id))";
        $result=Conn::excute($SQL_CREATE_PROJECT_TABLE);
        Conn::close();
        return $result;
    }
    //删除训练项目表
    static function deleteProjectTable($project_id){
        $table_name="ats_project_$project_id";
        $SQL_DELETE_PROJECT_TABLE="drop table $table_name";
        Conn::init();
        $result=Conn::excute($SQL_DELETE_PROJECT_TABLE);
        Conn::close();
        return $result;
    }
    //查询所有项目表
    static function selectAllProject(){
        $SQL_SELECT_ALL_PROJECT="select * from ats_project";
        Conn::init();
        $result=Conn::excute($SQL_SELECT_ALL_PROJECT);
        Conn::close();
        return $result;
    }
    //查询指定项目
    static function selectProject($project_id){
        $SQL_SELECT_ALL_PROJECT="select * from ats_project where Project_Id=$project_id";
        Conn::init();
        $result=Conn::excute($SQL_SELECT_ALL_PROJECT);
        Conn::close();
        return $result;
    }
    //修改项目
    static  function updateProject($project_id,$project_name,$project_unit,$project_great,$project_good,$project_qualified){
        $SQL_UPDATE_PROJECT="update ats_project set Project_Name='$project_name',Project_Unit='$project_unit',Project_Great=$project_great,Project_Good=$project_good,Project_Qualified=$project_qualified where Project_Id=$project_id";
        Conn::init();
        $result=Conn::excute($SQL_UPDATE_PROJECT);
        Conn::close();
        return $result;
    }
    //查询指定项目是否存在
    static function exitProject($project_name){
        $SQL_SELECT_EXIT_PROJECT="select Project_Id from ats_project where Project_Name = '$project_name'";
        Conn::init();
        $result = Conn::query($SQL_SELECT_EXIT_PROJECT);
        Conn::close();
        $row = mysql_fetch_array($result);
        return $row[0];
    }
    //添加上传的成绩
    static function addScore($project_id,$array){
        date_default_timezone_set("Asia/Shanghai");
        require_once '../PHPExcel/Classes/PHPExcel/Shared/Date.php';
        $changedate = gmdate('Y-m-d',\PHPExcel_Shared_Date::ExcelToPHP($array[2]));//时间转换成Y-M-D格式
        $SQL_UPDATE_ADD_SCORE = "insert into ats_project_$project_id VALUES( '$array[0]','$changedate','$array[4]')";
        Conn::init();
        $result = Conn::excute($SQL_UPDATE_ADD_SCORE);
        Conn::close();
        return $result;
    }
}