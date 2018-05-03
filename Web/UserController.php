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
    case 'scoreCompare':
        UserController::selectPiechart();break;
    case 'confirmOldPassword':
        UserController::confirmOldPassword();
    case 'updateUserPassword':
        UserController::updateUserPassword();
    case 'scoreTermSearch':
        UserController::selectLinechart();
}

class UserController
{
    //查询个人成绩
    static function myScoreSearch()
    {
        include("ResultShow.php");
        include("../Service/UserService.php");
        $date = $_POST['date'];
        $project = $_POST['project'];
        $user_id = $_SESSION['user_id'];
        $number = array($date, $project, $user_id);
        $result = UserService::myScoreSearch($number);
        $echo_str = ResultShow::myScoreShow($result);
        echo $echo_str;
    }


    //返回所要查询的字段数组
    static function selectNumber($resultinfo, $date, $project, $battalion, $continuous, $platoon, $monitor)
    {
        $number = array();
        $row = mysql_fetch_array($resultinfo);
        switch ($row[5]) {
            case '1':
                $number = array($date, $project, $row[0], $battalion, $continuous, $platoon, $monitor);
                break;
            case '2':
                $number = array($date, $project, $row[0], $row[1], $continuous, $platoon, $monitor);
                break;
            case '3':
                $number = array("$date", "$project", "$row[0]", "$row[1]", "$row[2]", "$platoon", "$monitor");
                break;
            case '4':
                $number = array($date, $project, $row[0], $row[1], $row[2], $row[3], $monitor);
                break;
            case '5':
                $number = array($date, $project, $row[0], $row[1], $row[2], $row[3], $row[4]);
                break;
        }
        return $number;
    }

    //查询当前用户下属单位成绩
    static function selectLowDownScore()
    {
        include("../Service/UserService.php");
        include("ResultShow.php");
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
        $number = self::selectNumber($result_information, $date, $project, $battalion, $continuous, $platoon, $monitor);
        //清理数组，删除NULL数据
        $i = 6;
        while ($number[$i] == "") {
            $i--;
        }
        $clear_number = array_slice($number, 0, $i + 1);
        $result1 = UserService::selectLowDownScore($clear_number);
        $echo_str = ResultShow::ScoreShow($result1);
        echo $echo_str;
    }

    //查询成绩饼状图
    static function selectPiechart()
    {
        include("../Service/UserService.php");
        $user_id = $_SESSION['user_id'];
        $date = $_POST['date'];
        $project = $_POST['project'];
        $battalion = $_POST['battalion'];
        $continuous = $_POST['continuous'];
        $platoon = $_POST['platoon'];
        //返回用户的所属等级
        $result = UserService::findUserinfo($user_id);
        $number = array();
        $row = mysql_fetch_array($result);
        switch ($row[5]) {
            case '1':
                $number = array($date, $project, $row[0], $battalion, $continuous, $platoon);
                break;
            case '2':
                $number = array($date, $project, $row[0], $row[1], $continuous, $platoon);
                break;
            case '3':
                $number = array($date, $project, $row[0], $row[1], $row[2], $platoon);
                break;
            case '4':
                $number = array($date, $project, $row[0], $row[1], $row[2], $row[3]);
                break;
        }
        //查看用户选择何种等级进行对比，过滤数组
        $i = 2;
        while ($number[$i] != '') {
            $i++;
            if ($i > 5)
                break;
        }
        $new_number = array_slice($number, 0, $i);
        $result = UserService::selectPieChart($new_number);
        //echo mysql_fetch_array($result[0])[0];
        #echo count($result);
        //演示输出
        for ($i = 0; $i < 3; $i++) {
            echo "oo:" . $result[0][$i];
            echo "</br>";
            for ($j = $i*4;$j<($i+1)*4;$j++){
                echo $result[$i+1][$j];
                echo "</br>";
        }
            echo "</br></br>";
        }
    }

    //确认用户旧密码
    static function confirmOldPassword()
    {
        //引用文件
        include("../Service/UserService.php");
        $user_id = $_SESSION['user_id'];
        $user_password = $_POST['old_password'];
        $result = UserService::userLogin($user_id, $user_password);
        if ($result) {
            echo "旧密码正确";
        } else {
            echo "旧密码错误";
        }
    }

    //修改用户密码
    static function updateUserPassword()
    {
        include("../Service/UserService.php");
        $user_id = $_SESSION['user_id'];
        $new_password = $_POST['new_password'];
        $result = UserService::updateUserPassword($user_id, $new_password);
        if ($result) {
            $_SESSION['success'] = "修改密码成功";
            header("location:../Home/password.php");
        } else {
            $_SESSION['error'] = "修改密码失败";
            header("location:../Home/password.php");
        }
    }


    //某段时间折线图
    static function selectLinechart()
    {
        include("../Service/UserService.php");
        $user_id = $_SESSION['user_id'];
        $date_start = $_POST['startDate'];
        $date_end = $_POST['endDate'];
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
                $number = array($date_start,$date_end,$project, $row[0], $battalion, $continuous, $platoon,$monitor);
                break;
            case '2':
                $number = array($date_start,$date_end,$project, $row[0], $row[1], $continuous, $platoon,$monitor);
                break;
            case '3':
                $number = array($date_start,$date_end,$project, $row[0], $row[1], $row[2], $platoon,$monitor);
                break;
            case '4':
                $number = array($date_start,$date_end,$project, $row[0], $row[1], $row[2], $row[3],$monitor);
                break;
            case '5':
                $number = array($date_start,$date_end,$project, $row[0], $row[1], $row[2], $row[3],$row[4]);
                break;
        }
        //清理数组，删除NULL数据
        $i = 7;
        while ($number[$i] == "") {
            $i--;
        }
        $new_number = array_slice($number, 0, $i+1);
        $result = UserService::selectLineChart($new_number);
        echo $result[0][0];
    }
}