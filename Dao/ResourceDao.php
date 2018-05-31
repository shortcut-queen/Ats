<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/5/30
 * Time: 22:14
 */

namespace Ats\Dao;
include("../Conn/conn.php");
use Ats\Conn\Conn;

class ResourceDao
{
    static function uploadResource($resource_name,$resource_type,$resource_file_name,$resource_about,$admin_name){
        $upload_date=date("Y-m-d");
        $SQL_ADD_RESOURCE="insert into ats_resource(Resource_Name,Resource_Type,Upload_Date,Admin_Name,Resource_Address,Resource_About)values('$resource_name',$resource_type,$upload_date,'$admin_name','$resource_file_name','$resource_about')";
        Conn::init();
        $result=Conn::excute($SQL_ADD_RESOURCE);
        Conn::close();
        return $result;
    }
}