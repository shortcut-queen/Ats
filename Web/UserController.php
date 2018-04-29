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
use Ats\Web\ResultShow;
//判断提交表单的名称
switch ($_POST['form_name']){
    case 'addUser':
        UserController::addUser();break;
    case 'scoreSearch':
        UserController::selectLowDownScore();break;
    case 'myScoreSearch':
        UserController:: myScoreSearch();break;
}

class UserController{
    //查询个人成绩
    static function myScoreSearch(){
        include("ResultShow.php");
        $date = $_POST['date'];
        $project = $_POST['project'];
        $user_id = $_SESSION['user_id'];
        $number = array($date,$project,$user_id);
        $result = UserService::myScoreSearch($number);
        $_SESSION['result']=$result;
        $echo_str=ResultShow::myScoreShow();
        echo $echo_str;

        #echo mysql_fetch_array($result[2])[0];
//        for($i=2;$i<count($result);$i++) {
//        echo "project_name:" . $result[0][$i - 2] . "  project_unit:" . $result[1][$i - 2] . "</br>";
//            while ($row = mysql_fetch_array($result[$i])) {
//                echo "User_ID:" . $row[0] . "\tUser_Name:" . $row[1] . "\tScore:" . $row[2];
//                echo "</br>";
//            }
//            echo "</br></br>";
//        }
    }


    //返回所要查询的字段数组
    static function selectNumber($resultinfo,$date,$project,$battalion,$continuous,$platoon,$monitor)
    {
        $number = array();
        $row = mysql_fetch_array($resultinfo);
        switch ($row[5]) {
            case '1':
                $number = array($date, $project,$row[0],$battalion, $continuous, $platoon, $monitor );
                break;
            case '2':
                $number = array($date, $project,$row[0],$row[1],$continuous, $platoon, $monitor);
                break;
            case '3':
                $number = array("$date", "$project","$row[0]","$row[1]","$row[2]","$platoon", "$monitor");
                break;
            case '4':
                $number = array($date, $project,$row[0],$row[1],$row[2],$row[3],$monitor);
                break;
            case '5':
                $number = array($date, $project,$row[0],$row[1],$row[2],$row[3],$row[4]);
                break;
        }
        return $number;
    }
    //查询当前用户下属单位成绩
    static function selectLowDownScore()
    {
        $date = $_POST['date'];
        $project = $_POST['project'];
        $battalion = $_POST['battalion'];
        $continuous = $_POST['continuous'];
        $platoon = $_POST['platoon'];
        $monitor = $_POST['monitor'];
        $user_id = $_SESSION['user_id'];
        //返回用户的所属信息
        $result_information = UserService::findUserinfo($user_id);
        //返回所要查询的字段数组
        $number = self::selectNumber($result_information,$date,$project,$battalion,$continuous,$platoon,$monitor);
        //清理数组，删除NULL数据
        $i = 6;
        while($number[$i]== ""){
            $i--;
        }
        $clear_number=array_slice($number,0,$i+1);
        $result1 = UserService::selectLowDownScore($clear_number);
        //演示输出
        for($i=2;$i<count($result1);$i++) {
            echo"project_name:".$result1[0][$i-2]."  project_unit:".$result1[1][$i-2]."</br>";
            while($row=mysql_fetch_array($result1[$i])) {
                echo "User_ID:" . $row[0] . "\tUser_Name:" . $row[1] . "\tBrigade:" . $row[2] . "\tBattalion:" . $row[3] . "\tContinuous:" . $row[4] . "\tPlatoon:" . $row[5] . "\tMonitor:" . $row[6] . "\tScore:" . $row[7];
                echo "</br>";
            }
            echo "</br></br>";
        }
    }

    //查询成绩饼状图
    static function selectPiechart(){
        $user_id = $_SESSION['user_id'];
        $date = $_POST['date'];
        $project = $_POST['project'];
        $battalion = $_POST['battalion'];
        $continuous = $_POST['continuous'];
        $platoon = $_POST['platoon'];
        $monitor = $_POST['monitor'];
        //返回用户的所属等级
        $result = UserService::findUserinfo($user_id);
        $number = array();
        $row = mysql_fetch_array($result);
        switch ($row[5]) {
            case '1':
                $number = array($date, $project,$row[0],$battalion, $continuous, $platoon );
                break;
            case '2':
                $number = array($date, $project,$row[0],$row[1],$continuous, $platoon);
                break;
            case '3':
                $number = array($date, $project,$row[0],$row[1],$row[2],$platoon);
                break;
            case '4':
                $number = array($date, $project,$row[0],$row[1],$row[2],$row[3]);
                break;
        }
        //查看用户选择何种等级进行对比，过滤数组
        $i =2;
        while($number[$i]!=' '){
            $i++;
            if($i>5)
                break;
        }
        $new_number = array_slice($number, 0,$i);
        $result = UserService::selectPieChart($new_number);

    }
}