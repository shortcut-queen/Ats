<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/5/30
 * Time: 17:54
 */

namespace Ats\Service;
include ("../Dao/ResourceDao.php");
use Ats\Dao\ResourceDao;

class ResourceService
{
    static function uploadResource($resource_name,$resource_type,$resource_file_name,$resource_about,$admin_name){
        return ResourceDao::uploadResource($resource_name,$resource_type,$resource_file_name,$resource_about,$admin_name);
    }
}