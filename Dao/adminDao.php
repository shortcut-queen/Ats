<?php
namespace Ats\Dao;
include("../Conn/conn.php");
use Ats\Conn\Conn;
class AdminDao{
    //增加管理员
    static function addAdmin($admin_id,$admin_name,$admin_password,$admin_type){
        $SQL_ADD_ADMIN="insert into ats_admin(Admin_Id,Admin_Name,Admin_Password,Admin_Type)values($admin_id,'$admin_name','$admin_password',$admin_type)";
        Conn::init();
        $result=Conn::excute($SQL_ADD_ADMIN);
        Conn::close();
        return $result;//返回记录集 or false
    }
    //删除管理员
    static function deleteAdmin($admin_id){
        Conn::init();
        $SQL_DELETE_ADMIN="delete from ats_admin where Admin_Id=$admin_id";
        $result=Conn::excute($SQL_DELETE_ADMIN);
        Conn::close();
        return $result;//返回true or false
    }
    //修改管理员信息（名字，密码，类型）。依赖：admin_id
    static function updateAdmin($admin_id,$admin_name,$admin_password,$admin_type){
        $SQL_UPDATE_ADMIN="update ats_admin set Admin_Name='$admin_name',Admin_Password='$admin_password',Admin_type=$admin_type where Admin_Id=$admin_id";
        Conn::init();
        $result=Conn::excute($SQL_UPDATE_ADMIN);
        Conn::close();
        return $result;//返回true or false
    }

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


    //查找所有管理员
    static function selectAdmin(){
        $SQL_SELECT_ADMIN="select Admin_Id,Admin_Name,Admin_type from ats_admin";
        Conn::init();
        $result=Conn::query($SQL_SELECT_ADMIN);
        Conn::close();
        return $result;//返回记录集 or false
    }
    //查找指定管理员存在否。依赖：admin_id
    static function existAdmin($admin_id){
        $SQL_FIND_ADMIN="select COUNT(*) from ats_admin where Admin_Id=$admin_id";
        Conn::init();
        $result=Conn::query($SQL_FIND_ADMIN);
        Conn::close();
        return $result;//返回0 or 1
    }
    //登录查询
    static function loginAdmin($admin_id,$admin_password){
        $SQL_LOGIN_ADMIN="select COUNT(*) as counts from ats_admin where Admin_Id=$admin_id and Admin_Password=$admin_password";
        Conn::init();
        $result=Conn::query($SQL_LOGIN_ADMIN);
        Conn::close();
        return mysql_fetch_array($result)[0];//返回0 or 1
    }
}