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
        $data = $_POST['data'];
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
        while ($row = mysql_fetch_array($result)) {
            switch ($row[5]) {
                case '0':
                    $number = array1($date, $project_name);
                    break;
                case '1':
                    $number = array1($date, $project_name,$battalion, $continuous, $platoon, $monitor );
                    break;
                case '2':
                    $number = array1($date, $project_name,$continuous, $platoon, $monitor);
                    break;
                case '3':
                    $number = array1($date, $project_name,$platoon, $monitor);
                    break;
                case '4':
                    $number = array1($date, $project_name,$monitor);
                    break;
                case '5':
                    $number = array1($date, $project_name);
                    break;
            }
        }
        $result1 = UserService::selectLowDownScore($number);

    }
        //if($officer>0){
        //    switch ($officer){
        //        case 1: number_array[$brigade];
        //        case 2: number_array[$brigade,$battalion];
        //        case 3: number_array[$brigade,$battalion,$continuous];
        //        case 4: number_array[$brigade,$battalion,$continuous,$platoon,$monitor,$warrior];
        //        case 5: number_array[$brigade,$battalion,$continuous,$platoon,$monitor,$warrior];


}