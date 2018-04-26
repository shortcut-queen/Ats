<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/25
 * Time: 20:57
 */
namespace Ats\Conn;
class Conn{
    private $con;
    function init(){
        $this->con=mysql_connect("172.18.16.207","root","root");
        if(!$this->con)
            die('连接失败:'.mysql_error());
        else
            mysql_select_db('ats',$this->con);
    }
    function query($sqlstr){
        $result=mysql_query($sqlstr);
        return  $result;
    }
    function excute($sqlstr){
        $result=mysql_query($sqlstr);
        return $result;
    }
    function close(){
        mysql_close($this->con);
    }
}