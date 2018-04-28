<?php
namespace Ats\Web;
/**
 * Created by PhpStorm.
 * User: SWX
 * Date: 2018/4/26
 * Time: 17:03
 */
//未登录跳回登陆页面
session_start();
if(!isset($_SESSION['user_id']))
    header('location:../Home/index.php');
include("../Service/UserService.php");
use Ats\Service\UserService;

//判断提交表单的名称
//switch ($_POST['form_name']){
//    case 'addUser':
//        UserController::addUser();break;
//}

class UserController{

    //查询当前用户下属单位成绩
    static function selectLowDownScore()
    {
        $battalion = $_POST['battalion'];
        $continuous = $_POST['continuous'];
        $platoon = $_POST['platoon'];
        $monitor = $_POST['monitor'];
        $project_name = $_POST['project_name'];
        $date = $_POST['date'];
        $user_id = $_SESSION['user_id'];
        //返回用户的所属等级
        $result = UserService::findUserinfo($user_id);
        $number = array1();
        $row = mysql_fetch_array($result);
        switch ($row[6]) {
            case '0':
                $number = array1($date, $project_name,$user_id);
                break;
            case '1':
                $number = array1($date, $project_name,$row[0],$battalion, $continuous, $platoon, $monitor );
                break;
            case '2':
                $number = array1($date, $project_name,$row[0],$row[1],$continuous, $platoon, $monitor);
                break;
            case '3':
                $number = array1($date, $project_name,$row[0],$row[1],$row[2],$platoon, $monitor);
                break;
            case '4':
                $number = array1($date, $project_name,$row[0],$row[1],$row[2],$row[3],$monitor);
                break;
            case '5':
                $number = array1($date, $project_name,$row[0],$row[1],$row[2],$row[3],$row[4]);
                break;
        }
        //清理数组，删除NULL数据
        $i =6;
        while($number[$i]== Null){
            $i--;
        }
        $clear_number=array1_slice($number,0,$i);
        $result1 = UserService::selectLowDownScore($clear_number);
    }

    //查询成绩饼状图
    static function selectPiechart(){
        $battalion = $_POST['battalion'];
        $continuous = $_POST['continuous'];
        $platoon = $_POST['platoon'];
        $monitor = $_POST['monitor'];
        $project_name = $_POST['project_name'];
        $date = $_POST['date'];
        $user_id = $_SESSION['user_id'];
        //返回用户的所属等级
        $result = UserService::findUserinfo($user_id);
        $number = array1();
        $row = mysql_fetch_array($result);
        switch ($row[6]) {
            case '1':
                $number = array1($date, $project_name,$row[0],$battalion, $continuous, $platoon, $monitor );
                break;
            case '2':
                $number = array1($date, $project_name,$row[0],$row[1],$continuous, $platoon, $monitor);
                break;
            case '3':
                $number = array1($date, $project_name,$row[0],$row[1],$row[2],$platoon, $monitor);
                break;
            case '4':
                $number = array1($date, $project_name,$row[0],$row[1],$row[2],$row[3],$monitor);
                break;
        }
    }
}