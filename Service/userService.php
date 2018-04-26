<?php
/**
 * Created by PhpStorm.
 * User: SWX
 * Date: 2018/4/26
 * Time: 17:09
 */

namespace Ats\Service;
include("../Dao/userDao.php");
use Ats\Dao\UserDao;

class UserService
{
    static function addUser($user_id, $user_name, $user_password, $brigade, $battalion, $continuous, $platoon, $monitor, $warrior, $officer){
        return UserDao::addUser($user_id, $user_name, $user_password, $brigade, $battalion, $continuous, $platoon, $monitor, $warrior, $officer);
    }

}