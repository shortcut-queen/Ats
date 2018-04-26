<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/26
 * Time: 11:12
 */

namespace Ats\Service;
include ("../Dao/roleDao.php");
use Ats\Dao\RoleDao;
class RoleService
{
    //添加角色
    static function addRole($role_name,$role_rank){
        return RoleDao::addRole($role_name,$role_rank);
    }
    //在user表中增加角色列
    static function addRoleColumn($role_name){
        return RoleDao::addRoleColumn($role_name);
    }
    //删除角色
    static function deleteRole($role_rank){
        return RoleDao::deleteRole($role_rank);
    }
    //查询所有角色
    static function selectAllRole(){
        return RoleDao::selectRole();
    }
    //查找制定角色
    static function findRole($role_rank){
        return RoleDao::findRole($role_rank);
    }
}