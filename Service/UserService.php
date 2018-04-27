<?php
/**
 * Created by PhpStorm.
 * User: SWX
 * Date: 2018/4/26
 * Time: 17:09
 */

namespace Ats\Service;
//引用类
include("../Dao/UserDao.php");
use Ats\Dao\UserDao;
//对用户的操作功能
class UserService
{
    //增加用户，不需要密码，密码由数据库给定初始密码
    static function addUser($user_id, $user_name, $brigade, $battalion, $continuous, $platoon, $monitor, $warrior, $officer){
        return UserDao::addUser($user_id, $user_name, $brigade, $battalion, $continuous, $platoon, $monitor, $warrior, $officer);
    }
    //删除用户,依赖：user_id，user_name
    static function deleteUser($user_id,$user_name){
        return UserDao::deleteUser($user_id,$user_name);
    }
    //修改用户信息
    static function updateUser($user_id, $user_name,$brigade, $battalion, $continuous, $platoon, $monitor, $warrior, $officer){
        return UserDao::updateUser($user_id, $user_name,$brigade, $battalion, $continuous, $platoon, $monitor, $warrior, $officer);
    }
    //修改用户密码
    static function updateUserPassword($user_id,$new_password){
        return UserDao::updateUserPassword($user_id,$new_password);
    }
}