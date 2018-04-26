<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/26
 * Time: 21:02
 */

namespace Ats\Service;

include ("../Dao/projectDao.php");
use Ats\Dao\projectDao;
class ProjectService
{
    static function addProject($project_name,$project_unit,$project_great,$project_good,$project_qualified){
        return ProjectDao::addProject($project_name,$project_unit,$project_great,$project_good,$project_qualified);
    }
}