<?php
namespace Ats\Dao;
//引用类
include("../Conn/conn.php");
use Ats\Conn\Conn;
//对管理员的操作
class AdminDao{
    //增加管理员
    static function addAdmin($admin_name){
        $SQL_ADD_ADMIN="insert into ats_admin(Admin_Name,Admin_Type)values('$admin_name',1)";
        Conn::init();
        $result=Conn::excute($SQL_ADD_ADMIN);
        Conn::close();
        return $result;//返回记录集 or false
    }
    //删除管理员
    static function deleteAdmin($admin_name){
        Conn::init();
        $SQL_DELETE_ADMIN="delete from ats_admin where Admin_Name='$admin_name'";
        $result=Conn::excute($SQL_DELETE_ADMIN);
        Conn::close();
        return $result;//返回true or false
    }
    //修改管理员密码（密码）。依赖：admin_name
    static function updateAdminPassword($admin_name,$new_password){
        $SQL_UPDATE_ADMIN_PASSWORD="update ats_admin set Admin_Password='$new_password' where Admin_Name='$admin_name'";
        Conn::init();
        $result=Conn::excute($SQL_UPDATE_ADMIN_PASSWORD);
        Conn::close();
        return $result;//返回true or false
    }

    //查找所有管理员
    static function selectAllAdmin(){
        $SQL_SELECT_ADMIN="select Admin_Name from ats_admin where Admin_Type=1";
        Conn::init();
        $result=Conn::query($SQL_SELECT_ADMIN);
        Conn::close();
        return $result;//返回记录集 or false
    }
    //查找指定管理员存在否。依赖：admin_id
    static function existAdmin($admin_name){
        $SQL_FIND_ADMIN="select COUNT(*) from ats_admin where Admin_Id='$admin_name'";
        Conn::init();
        $result=Conn::query($SQL_FIND_ADMIN);
        Conn::close();
        return $result;//返回0 or 1
    }
    //管理员登录查询
    static function loginAdmin($admin_name,$admin_password){
        $SQL_LOGIN_ADMIN="select Admin_Type from ats_admin where Admin_Name='$admin_name' and Admin_Password='$admin_password'";
        Conn::init();
        $result=Conn::query($SQL_LOGIN_ADMIN);
        Conn::close();
        return mysql_fetch_array($result);//返回0 or 1
    }
    //查看单一项目成绩
    static function oneProjectScore($clear_number)
    {
        Conn::init();
        //标准的数组
        $whole_number = array("Date", "project_id", "Brigade", "Battalion", "Continuous", "Platoon", "Monitor");
        $len_clear_result = count($clear_number) - 1;
        $SQL_SELECT_ONESCORE = "select ats_user.User_Id,ats_user.User_name,ats_user.Brigade,ats_user.Battalion,ats_user.Continuous,ats_user.Platoon,ats_user.Monitor,ats_project_$clear_number[1].Train_Score from ats_user,ats_project_$clear_number[1] where  ats_user.User_Id=ats_project_$clear_number[1].User_Id and ats_project_$clear_number[1].Train_Date = '$clear_number[0] ' and ats_user.User_Id in(select  User_Id from ats_user where ";
        for ($i = 2; $i < $len_clear_result; $i++) {
            $SQL_ASSIGNMENT = "$whole_number[$i] = '$clear_number[$i]'";
            $SQL_SELECT_ONESCORE = "$SQL_SELECT_ONESCORE" . "$SQL_ASSIGNMENT" . " " . "and" . " ";
        }
        $SQL_SELECT_LOWDOWNSCORE = "$SQL_SELECT_ONESCORE" . "$whole_number[$len_clear_result] = '$clear_number[$len_clear_result]'" . ")";//拼合成SQL语句
        $result = array();
        $result[0] = Conn::query($SQL_SELECT_LOWDOWNSCORE);
        Conn::close();
        return $result;
    }
    //查看全部项目成绩
    static function allProjectScore($clear_number)
    {
        //查找已有的全部项目
        $SQL_FIND_PROJECT_NAME = "select Project_Id,Project_Name,Project_Unit from ats_project";
        Conn::init();
        $result_project = Conn::query($SQL_FIND_PROJECT_NAME);
        Conn::close();
        $result = array();
        $project_name_array=array();
        $project_unit_array =array();
        while ($row = mysql_fetch_array($result_project)) {
            $clear_number[1]=$row[0];//赋值项目名称，替换$clear_name[1]中的项目名进行循环遍历
//            array_push($project_name_array,$row[1]);
//            array_push($project_unit_array,$row[2]);
            $result_score=self::oneProjectScore($clear_number);
            if(mysql_num_rows($result_score[0])>=1){
                array_push($project_name_array,$row[1]);
                array_push($project_unit_array,$row[2]);
                array_push($result, $result_score[0]);//将遍历所有项目的成绩存储
            }
        }
        //Conn::close();
        array_unshift($result,$project_unit_array);
        array_unshift($result, $project_name_array);
        return $result;
    }
    //查看成绩
    static function scoreSearch($clear_number)
    {
        if ($clear_number[1] != 'all_project') {
            //查询指定时间单个项目的个人信息、成绩
            $result = self::oneProjectScore($clear_number);
        } else {
            //查询指定时间所有项目的个人信息、成绩
            $result = self::allProjectScore($clear_number);
        }
        return $result;
    }
}