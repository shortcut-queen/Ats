<?php
/**
 * Created by PhpStorm.
 * User: SWX
 * Date: 2018/4/26
 * Time: 13:30
 */

namespace Ats\Dao;
//引用类
include("../Conn/conn.php");
use Ats\Conn\Conn;
//对用户的操作
class UserDao
{
    //增加用户
    static function addUser($user_id, $user_name, $brigade, $battalion, $continuous, $platoon, $monitor, $warrior, $officer){
        $SQL_ADD_USER = "insert into ats_user(User_Id, User_Name,Brigade, Battalion, Continuous, Platoon, Monitor, Warrior, Officer)values($user_id,'$user_name',$brigade,$battalion,$continuous,$platoon,$monitor,$warrior,$officer)";
        Conn::init();
        $result = Conn::excute($SQL_ADD_USER);
        Conn::close();
        return $result;
    }
    //删除用户
    static function deleteUser($user_id,$user_name){
        $SQL_DELETE_USER = "delete from ats_user where User_Id= $user_id and User_Name ='$user_name'";
        Conn::init();
        $result = Conn::excute($SQL_DELETE_USER);
        Conn::close();
        return $result;//返回true or false
    }
    //修改用户（名字，所属单位,是否长官）依赖：user_id
    static function updateUser($user_id, $user_name,$brigade, $battalion, $continuous, $platoon, $monitor, $warrior, $officer){
        $SQL_UPDATE_USER = "update ats_brigade set User_Name='$user_name',Brigade=$brigade ,Battalion = $battalion, Continuous = $continuous, Platoon= $platoon, Monitor=$monitor, Warrior=$warrior, Officer=$officer where User_Id= $user_id";
        Conn::init();
        $result = Conn::excute($SQL_UPDATE_USER);
        Conn::close();
        return $result;//返回true or false
    }
    //修改用户密码
    static function updateUserPassword($user_id,$new_password){
        $SQL_UPDATE_USER_PASSWORD = "update ats_brigade set User_Password='$new_password' where User_Id= $user_id";
        Conn::init();
        $result = Conn::excute($SQL_UPDATE_USER_PASSWORD);
        Conn::close();
        return $result;//返回true or false
    }
    //查找用户所属等级及信息
    static function findUserinfo($user_id)
    {
        $SQL_FIND_USERRANK = "select Brigade, Battalion, Continuous, Platoon, Monitor, Officer from ats_user where User_Id ='$user_id'";
        Conn::init();
        $result = Conn::query($SQL_FIND_USERRANK);
        Conn::close();
        return $result;
    }

    //查找所有用户
    static function selectUser()
    {
        $SQL_SELECT_USER = "select User_Id,User_Name from  ats_user";
        Conn::init();
        $result = Conn::query($SQL_SELECT_USER);
        Conn::close();
        return $result;//返回记录集 or false
    }
    //查找指定用户存在否。依赖：user_id
    static function existUser($user_id)
    {
        $SQL_FIND_USER = "select COUNT(*) from ats_user where User_Id=$user_id";
        Conn::init();
        $result = Conn::query($SQL_FIND_USER);
        Conn::close();
        return mysql_fetch_array($result)[0];//返回0 or 1
    }
    //登录查询
    static function loginUser($user_id, $user_password)
    {
        $SQL_LOGIN_USER = "select User_Name, Officer from ats_user where User_Id=$user_id and User_Password='$user_password'";
        Conn::init();
        $result = Conn::query($SQL_LOGIN_USER);
        Conn::close();
        return mysql_fetch_array($result);
    }
    //查询个人单项成绩
    static function myOneProjectScore($number){
        $SQL_SELECT_MY_ONESCORE = "select User_Id,ats_project_$number[1].Train_Score,ats_project_$number[1].Train_Date from ats_project_$number[1] where ats_project_$number[1].User_Id=$number[2]  and ats_project_$number[1].Train_Date = '$number[0]'";
        #echo $SQL_SELECT_MY_ONESCORE;
        Conn::init();
        $result = array();
        $result[0] = Conn::query($SQL_SELECT_MY_ONESCORE);
        Conn::close();
        return $result;
    }

    //查询个人多项成绩
    static function myAllProjectScore($number){
        $SQL_FIND_PROJECT_NAME = "select Project_Id,Project_Name,Project_Unit from ats_project";
        Conn::init();
        $result_project = Conn::query($SQL_FIND_PROJECT_NAME);
        Conn::close();
        $result = array();
        $project_name_array=array();
        $project_unit_array=array();
        while ($row = mysql_fetch_array($result_project)) {
            $number[1]=$row[0];

            $result_score=self::myOneProjectScore($number);
            if(mysql_fetch_array($result_score[0])[0]!=null){
                array_push($project_unit_array,$row[2]);
                array_push($project_name_array,$row[1]);
                array_push($result, $result_score[0]);//将遍历所有项目的成绩存储
            }
            #echo mysql_fetch_array($result_score[0])[0];
        }
        array_unshift($result,$project_unit_array);
        array_unshift($result,$project_name_array);

        return $result;
    }

    //查询个人成绩
    static function myScoreSearch($number){
        if($number[1]!= "all_project" ){
            $result = self::myOneProjectScore($number);
        }
        else{
            $result = self::myAllProjectScore($number);
        }
        #echo mysql_fetch_array($result[0])[0];
        return $result;

    }

    //查询单一项目下属成绩
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

    //查询全部项目下属成绩
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
            array_push($project_name_array,$row[1]);
            array_push($project_unit_array,$row[2]);
            $result_score=self::oneProjectScore($clear_number);
            if(mysql_fetch_array($result_score[0])[0]!=NULL){
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

    //查询下属成绩
    static function selectLowDownScore($clear_number)
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
    //查询成绩饼状图
    static function selectPieChart($new_number)
    {

    }

}