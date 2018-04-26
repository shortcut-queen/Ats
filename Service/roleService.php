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
    static function addRole($role_name,$role_rank){
        return RoleDao::addRole($role_name,$role_rank);
    }
}