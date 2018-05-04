<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/26
 * Time: 9:52
 */
namespace Ats\Service;
//引用类
include("../Dao/AdminDao.php");
use Ats\Dao\AdminDao;
//对管理员的操作功能
class AdminService{
    //管理员登录
    static function adminLogin($admin_name,$admin_password){
        return AdminDao::loginAdmin($admin_name,$admin_password);
    }
    //增加管理员
    static function addAdmin($admin_name){
        return AdminDao::addAdmin($admin_name);
    }
    //删除管理员
    static function deleteAdmin($admin_name){
        return AdminDao::deleteAdmin($admin_name);
    }
    //修改管理员密码
    static function updateAdminPassword($admin_name,$new_password){
        return AdminDao::updateAdminPassword($admin_name,$new_password);
    }
    //查找所有管理员
    static function selectAllAdmin(){
        return AdminDao::selectAllAdmin();
    }
}