<?php
namespace Ats\Admin;
include ("../Conn/conn.php");
use Ats\Conn\Conn;
class AdminDo{
    //增加管理员
    function addAdmin($admin_id,$admin_name,$admin_password,$admin_type){
        $sql=new Conn();
        $SQL_ADD_ADMIN='insert into ats_admin(Admin_Id,Admin_Name,Admin_Password,Admin_Type)values('.$admin_id.','.$admin_name.','.$admin_password.','.$admin_type.')';
        $sql->init();
        $result=$sql->excute($SQL_ADD_ADMIN);
        $sql->close();
        return $result;//返回记录集 or false
    }
    //删除管理员
    function deleteAdmin($admin_id){
        $sql=new Conn();
        $SQL_DELETE_ADMIN='delete from ats_admin where Admin_Id='.$admin_id;
        $sql->init();
        $result=$sql->excute($SQL_DELETE_ADMIN);
        $sql->close();
        return $result;//返回true or false
        }
        //修改管理员信息（名字，密码，类型）。依赖：admin_id
    function updateAdmin($admin_id,$admin_name,$admin_password,$admin_type){
        $sql=new Conn();
        $SQL_UPDATE_ADMIN='update ats_admin set Admin_Name='.$admin_name.',Admin_Password='.$admin_password.',Admin_type='.$admin_type.'where Admin_Id='.$admin_id;
        $sql->init();
        $result=$sql->excute($SQL_UPDATE_ADMIN);
        $sql->close();
        return $result;//返回true or false
    }
    //查找所有管理员
    function selectAdmin(){
        $sql=new Conn();
        $SQL_SELECT_ADMIN='select Admin_Id,Admin_Name,Admin_type from ats_admin';
        $sql->init();
        $result=$sql->query($SQL_SELECT_ADMIN);
        $sql->close();
        return $result;//返回记录集 or false
    }
    //查找指定管理员存在否。依赖：admin_id
    function existAdmin($admin_id){
        $sql=new Conn();
        $SQL_FIND_ADMIN='select COUNT(*) from ats_admin where Admin_Id='.$admin_id;
        $sql->init();
        $result=$sql->query($SQL_FIND_ADMIN);
        $sql->close();
        return $result;//返回0 or 1
    }
    //登录查询
    function loginAdmin($admin_id,$admin_password){
        $sql=new Conn();
        $SQL_LOGIN_ADMIN='select COUNT(*) as counts from ats_admin where Admin_Id='.$admin_id.' and Admin_Password='.$admin_password;
        $sql->init();
        $result=$sql->query($SQL_LOGIN_ADMIN);
        $sql->close();
        return mysql_fetch_array($result);//返回0 or 1
    }
}