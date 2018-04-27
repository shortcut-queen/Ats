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
    static function selectAdmin(){
        $SQL_SELECT_ADMIN="select Admin_Name,Admin_type from ats_admin";
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
        return mysql_fetch_array($result)[0];//返回0 or 1
    }
}