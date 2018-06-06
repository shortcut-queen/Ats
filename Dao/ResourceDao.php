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
ini_set('date.timezone','Asia/Shanghai');
class ResourceDao
{
    static function uploadResource($resource_name,$resource_type,$resource_file_name,$resource_about,$admin_name){
        $upload_date=date("Y-m-d",time());
        $SQL_ADD_RESOURCE="insert into ats_resource(Resource_Name,Resource_Type,Upload_Date,Admin_Name,Resource_Address,Resource_About)values('$resource_name',$resource_type,'$upload_date','$admin_name','$resource_file_name','$resource_about')";
        Conn::init();
        $result=Conn::excute($SQL_ADD_RESOURCE);
        Conn::close();
        return $result;
    }
    static function searchAllResource($search_type){
        $SQL_SELECT_RESOURCE="select * from ats_resource where Resource_Type=$search_type";
        Conn::init();
        $result=Conn::query($SQL_SELECT_RESOURCE);
        Conn::close();
        return $result;
    }
    static function allResource(){
        $SQL_SELECT_ALL_RESOURCE="select * from ats_resource";
        Conn::init();
        $result=Conn::query($SQL_SELECT_ALL_RESOURCE);
        Conn::close();
        return $result;
    }
    static function detailResource($resource_id){
        $SQL_DETAIL_RESOURCE="select * from ats_resource where Resource_Id=$resource_id";
        Conn::init();
        $result=Conn::query($SQL_DETAIL_RESOURCE);
        Conn::close();
        return $result;
    }
    static function deleteResource($resource_id){
        $SQL_DELETE_RESOURCE="delete from ats_resource where Resource_Id=$resource_id";
        Conn::init();
        $result=Conn::excute($SQL_DELETE_RESOURCE);
        Conn::close();
        return $result;
    }
    //修改下载量
    static function updateDownload($resource_id){
        $SQL_UPDATE_DOWNLOAD="update ats_resource set Resource_Download=Resource_Download+1 where Resource_Id=$resource_id";
        Conn::init();
        $result=Conn::excute($SQL_UPDATE_DOWNLOAD);
        Conn::close();
        return $result;
    }
}