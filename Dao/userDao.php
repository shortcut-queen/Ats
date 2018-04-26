<?php
/**
 * Created by PhpStorm.
 * User: SWX
 * Date: 2018/4/26
 * Time: 13:30
 */

namespace Ats\Dao;

include("../Conn/conn.php");

use Ats\Conn\Conn;
class UserDao
{
    //登录查询
    static function loginUser($user_id,$user_password){
        $SQL_LOGIN_USER="select COUNT(*) as counts from ats_user where User_Id=$user_id and User_Password=$user_password";
        Conn::init();
        $result=Conn::query($SQL_LOGIN_USER);
        Conn::close();
        return mysql_fetch_array($result)[0];//返回0 or 1
    }
}