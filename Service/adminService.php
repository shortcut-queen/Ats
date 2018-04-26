<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/26
 * Time: 9:52
 */
namespace Ats\Service;
include ("../Dao/admindao.php");
use Ats\Dao\AdminDao;
class AdminService{
    static function adminLogin($admin_id,$admin_password){
        return AdminDao::loginAdmin($admin_id,$admin_password);
    }
}