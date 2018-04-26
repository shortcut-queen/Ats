<?php
/**
 * Created by PhpStorm.
 * User: SWX
 * Date: 2018/4/26
 * Time: 13:30
 */

namespace Ats\Dao;

include("../Conn/conn.php");

use Ats\Conn\Conn;
class UserDao
{
    //增加用户
    function addUser($user_id, $user_name, $user_password, $brigade, $battalion, $continuous, $platoon, $monitor, $warrior, $officer){
        $SQL_ADD_USER = "insert into ats_user(User_Id, User_Name,User_Password, Brigade, Battalion, Continuous, Platoon, Monitor, Warrior, Officer)values($user_id,'$user_name','$user_password',$brigade,$battalion,$continuous,$platoon,$monitor,$warrior,$officer)";
        Conn::init();
        $result = Conn::excute($SQL_ADD_USER);
        Conn::close();
        return $result;
    }

    //删除用户
    function deleteUser($user_id,$user_name){
        $SQL_DELETE_USER = "delete from ats_user where User_Id= $user_id and User_Name ='$user_name'";
        Conn::init();
        $result = Conn::excute($SQL_DELETE_USER);
        Conn::close();
        return $result;//返回true or false
    }
    //修改用户（名字，密码，所属单位,是否长官）依赖：user_id
    function updateUser($user_id, $user_name, $user_password, $brigade, $battalion, $continuous, $platoon, $monitor, $warrior, $officer){
        $SQL_UPDATE_USER = "update ats_brigade set User_Name='$user_name',User_Password='$user_password',Brigade=$brigade ,Battalion = $battalion, Continuous = $continuous, Platoon= $platoon, Monitor=$monitor, Warrior=$warrior, Officer=$officer where User_Id= $user_id";
        Conn::init();
        $result = Conn::excute($SQL_UPDATE_USER);
        Conn::close();
        return $result;//返回true or false
    }

    //查找所有用户
    function selectUser($user_id, $user_name){
        $SQL_SELECT_USER="select User_Id,User_Name from  ats_user";
        Conn::init();
        $result=Conn::query($SQL_SELECT_USER);
        Conn::close();
        return $result;//返回记录集 or false
    }
    //查找指定用户存在否。依赖：user_id
    function existUser($user_id){
        $SQL_FIND_USER="select COUNT(*) from ats_user where User_Id=$user_id";
        Conn::init();
        $result=Conn::query($SQL_FIND_USER);
        Conn::close();
        return mysql_fetch_array($result)[0];//返回0 or 1
    }
    //登录查询
    static function loginUser($user_id,$user_password){
        $SQL_LOGIN_USER="select COUNT(*) as counts from ats_user where User_Id=$user_id and User_Password=$user_password";
        Conn::init();
        $result=Conn::query($SQL_LOGIN_USER);
        Conn::close();
        return mysql_fetch_array($result)[0];//返回0 or 1
    }
}