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
        Conn::init();
        $SQL_ADD_ROLE='insert into ats_role(Role_Name,Role_Rank)values('.$role_name.','.$role_rank.')';
        Conn::init();
        $result=Conn::excute($SQL_ADD_ROLE);
        Conn::close();
        return $result;//返回记录集 or false
    }
    //查询所有角色
   static function selectRole(){
       Conn::init();
       $SQL_SELCT_ROLE='select Role_Name from ats_role';
       Conn::init();
       $result=Conn::excute($SQL_SELCT_ROLE);
       Conn::close();
       return $result;//返回记录集 or false
   }
}