<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/26
 * Time: 10:05
 */

namespace Ats\Dao;

include("../Conn/conn.php");
use Ats\Conn\Conn;
class RoleDao
{
    //增加角色
    static function addRole($role_name,$role_rank){
        $SQL_ADD_ROLE="insert into ats_role (Role_Name,Role_Rank) values ('$role_name',$role_rank)";
        Conn::init();
        $result=Conn::excute($SQL_ADD_ROLE);
        Conn::close();
        return $result;//返回记录集 or false
    }
    //删除角色
    static function deleteRole($role_rank){
        $SQL_DELETE_ROLE="delete from ats_role where Role_Rank=$role_rank";
        Conn::init();
        $result=Conn::excute($SQL_DELETE_ROLE);
        Conn::close();
        return $result;//返回记录集 or false
    }
    //查询所有角色
   static function selectRole(){
       $SQL_SELECT_ROLE="select Role_Name from ats_role";
       Conn::init();
       $result=Conn::excute($SQL_SELECT_ROLE);
       Conn::close();
       return $result;//返回记录集 or false
   }
    //查询指定角色是否存在
    static function findRole($role_rank){
        $SQL_FIND_ROLE="select count from ats_role where Role_Rank=$role_rank";
        Conn::init();
        $result=Conn::excute($SQL_FIND_ROLE);
        Conn::close();
        return mysql_fetch_array($result)[0];//返回记录集 or false
    }
   static function addRoleColumn($role_name){
        $SQL_ADD_ROLE_COLUMN="alter table user add $role_name int(2)";
        Conn::init();
        $result=Conn::excute($SQL_ADD_ROLE_COLUMN);
        Conn::close();
        return $result;//返回记录集 or false
   }
}