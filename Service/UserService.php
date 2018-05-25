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
    static function addUser($user_id, $user_name, $brigade, $battalion, $continuous, $platoon, $monitor, $officer){
        return UserDao::addUser($user_id, $user_name, $brigade, $battalion, $continuous, $platoon, $monitor,$officer);
    }
    //删除用户,依赖：user_id
    static function deleteUser($user_id){
        return UserDao::deleteUser($user_id);
    }
    //修改用户信息
    static function updateUser($user_id, $user_name,$brigade, $battalion, $continuous, $platoon, $monitor,$officer){
        return UserDao::updateUser($user_id, $user_name,$brigade, $battalion, $continuous, $platoon, $monitor, $officer);
    }
    //修改用户密码
    static function updateUserPassword($user_id,$new_password){
        return UserDao::updateUserPassword($user_id,$new_password);
    }
    //查找用户所属等级及信息
    static function findUserinfo($user_id){
        return UserDao::findUserinfo($user_id);
    }
    //用户登录验证
    static function userLogin($user_id,$user_password){
        return UserDao::loginUser($user_id,$user_password);
    }
    //查询下属成绩
    static function selectLowDownScore($clear_number){
        return UserDao::selectLowDownScore($clear_number);
    }
    //查询个人成绩
    static function myScoreSearch($number){
        return UserDao::myScoreSearch($number);
    }
    //查询成绩饼状图
    static function selectPieChart($new_number){
        return UserDao::selectPieChart($new_number);
    }
    //查询成绩折线图
    static function selectLineChart($line_number){
        return UserDao::selectLineChart($line_number);
    }
    //龙虎榜
    static function longhubang(){
        return UserDao::longhubang();
    }
    //个人成绩折线图
    static function personalLineChart($number){
        return UserDao::personalLineChart($number);
    }
    //模糊查找用户
    static function findUser($parameter){
        return UserDao::findUser($parameter);
    }
    //查找指定用户
    static function selectUser($user_id){
        return UserDao::selectUser($user_id);
    }
    //添加用户检验，不可存在相同User_Id,一个部队不可存在多个长官
    static function existUser($user_id,$brigade,$battalion,$continuous,$platoon,$monitor,$officer){
        return UserDao::existUser($user_id,$brigade,$battalion,$continuous,$platoon,$monitor,$officer);
    }
    //添加、修改用户检验，一个班的战士不可以超过八个
    static function countWarrior($user_id,$brigade,$battalion,$continuous,$platoon,$monitor){
        return UserDao::countWarrior($user_id,$brigade,$battalion,$continuous,$platoon,$monitor);
    }
}