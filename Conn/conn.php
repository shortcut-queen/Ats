<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/25
 * Time: 20:57
 */
namespace Ats\Conn;
class Conn{
    private static $con;
    static function init(){
        self::$con=mysql_connect("172.18.16.207","root","root");
        if(! self::$con)
            die('连接失败:'.mysql_error());
        else
            mysql_select_db('ats', self::$con);
    }
    static function query($sqlstr){
        $result=mysql_query($sqlstr);
        return  $result;
    }
    static function excute($sqlstr){
        $result=mysql_query($sqlstr);
        return $result;
    }
    static function close(){
        mysql_close( self::$con);
    }
}