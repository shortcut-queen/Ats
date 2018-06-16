<?php
namespace Ats\Web;
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/25
 * Time: 22:32
 */
//未登录跳回登陆页面
session_start();
if(!isset($_SESSION['admin_name']))
    header('location:../Admin/admin.php');
//引用类
use Ats\Service\AdminService;
use Ats\Service\UserService;
use Ats\Service\ProjectService;
use Ats\Web\ResultShow;
//判断提交表单的名称
switch ($_POST['form_name']){
    case 'addAdmin':
        AdminController::addAdmin();break;
    case 'addUser':
        AdminController::addUser();break;
    case 'updateAdminPassword':
        AdminController::updateAdminPassword();break;
    case 'searchAllAdmin':
        AdminController::selectAllAdmin();break;
    case 'topList':
        AdminController::longhubang();break;
    case 'queryUser':
        AdminController::findUser();break;
    case 'editUser':
       AdminController::editUser();break;
    case 'importScore':
        AdminController::importScore();break;
    case 'scoreSearch':
        AdminController::scoreSearch();break;
    case 'editScore':
        AdminController::editScore();break;
}

class AdminController
{
    //添加管理员
     static function addAdmin()
    {
        include("../Service/AdminService.php");
        $admin_name = $_POST['admin_name'];
        $admin_type = $_POST['admin_type'];
        $result = AdminService::addAdmin($admin_name, $admin_type);

        if ($result == 1) {
            $_SESSION['success'] = '添加管理员成功';
            header('location:../Admin/alladmin.php');
        } else {
            $_SESSION['error'] = '添加管理员失败';
            header('location:../Admin/addadmin.php');
        }
    }
    //添加用户
    static function addUser()
    {
        include("../Service/UserService.php");
        $user_id = $_POST['user_id'];
        $user_name = $_POST['user_name'];
        $brigade = $_POST['brigade'];
        $battalion = $_POST['battalion'];
        $continuous = $_POST['continuous'];
        $platoon = $_POST['platoon'];
        $monitor = $_POST['monitor'];
        $officer = $_POST['officer'];
        $exist_result = UserService::existUser($user_id, $brigade, $battalion, $continuous, $platoon, $monitor, $officer);
        if ($exist_result) {
            $_SESSION['error'] = '用户编号已存在或该部队军官已存在！';
            header('location:../Admin/adduser.php');
        } else {
        if ($officer == 0) {
            $count_result = UserService::countWarrior($user_id, $brigade, $battalion, $continuous, $platoon, $monitor, $officer);
            if (mysql_fetch_array($count_result)[0] == 8) {
                $_SESSION['error'] = '该班人数已达上限!';
                header('location:../Admin/adduser.php');
            } else {
                $result = UserService::addUser($user_id, $user_name, $brigade, $battalion, $continuous, $platoon, $monitor, $officer);
                if ($result)
                    $_SESSION['success'] = '添加成功';
                else
                    $_SESSION['error'] = '添加失败';
                header('location:../Admin/adduser.php');
            }
        } else {
            $result = UserService::addUser($user_id, $user_name, $brigade, $battalion, $continuous, $platoon, $monitor, $officer);
            if ($result)
                $_SESSION['success'] = '添加成功';
            else
                $_SESSION['error'] = '添加失败';
            header('location:../Admin/adduser.php');
        }
        }
    }
    //修改管理员密码
    static function updateAdminPassword(){
        include("../Service/AdminService.php");
        $admin_name=$_SESSION['admin_name'];
        $old_password=$_POST['old_password'];
        $new_password=$_POST['new_password'];
        $result=AdminService::adminLogin($admin_name,$old_password);
        echo $result;
        if($result) {
            $resultUpdate = AdminService::updateAdminPassword($admin_name, $new_password);
            if ($resultUpdate)
                $_SESSION['success'] = "修改密码成功";
            else
                $_SESSION['error'] = "修改密码失败";
        }
        else
            $_SESSION['error'] = "原密码错误";
    }
    //查询所有管理员
    static function selectAllAdmin(){
         include ('../Service/AdminService.php');
         include ('ResultShow.php');
         $result=AdminService::selectAllAdmin();
         $echo_str=ResultShow::showAllAdmin($result);
         echo $echo_str;
    }
    //龙虎榜
    static function longhubang(){
        include('../Service/UserService.php');
        include ("ResultShow.php");
        $result = UserService::longhubang();
        $echo_str=ResultShow::showTopList($result);
        echo $echo_str;
    }
    //模糊查找用户
    static function findUser(){
         include ('../Service/UserService.php');
         include('ResultShow.php');
         $parameter = $_POST['query_info'];
         $result = UserService::findUser($parameter);
         $echo_str=ResultShow::showFoundUser($result);
         echo $echo_str;
    }
    //修改用户资料
    static function editUser(){
        include ('../Service/UserService.php');
        $user_id = $_POST['user_id'];
        $user_name = $_POST['user_name'];
        $brigade = $_POST['brigade'];
        $battalion = $_POST['battalion'];
        $continuous = $_POST['continuous'];
        $platoon = $_POST['platoon'];
        $monitor = $_POST['monitor'];
        $officer = $_POST['officer'];
        $exist_result=UserService::existUser($user_id,$brigade,$battalion,$continuous,$platoon,$monitor,$officer);
        if($exist_result){
            $_SESSION['error']='用户编号已存在或该部队军官已存在！';
            header('location:../Admin/EditUser.php?user_id='.$user_id);
        }else {
            if ($officer == 0) {
                $count_result = UserService::countWarrior($user_id, $brigade, $battalion, $continuous, $platoon, $monitor, $officer);
                if (mysql_fetch_array($count_result)[0] == 8) {
                    $_SESSION['error'] = '该班人数已达上限!';
                    header('location:../Admin/EditUser.php?user_id='.$user_id);
                } else {
                    $result = UserService::updateUser($user_id, $user_name, $brigade, $battalion, $continuous, $platoon, $monitor, $officer);
                    if ($result)
                        $_SESSION['success'] = '修改成功';
                    else
                        $_SESSION['error'] = '修改失败';
                    header('location:../Admin/EditUser.php?user_id='.$user_id);
                }
            } else {
                $result = UserService::updateUser($user_id, $user_name, $brigade, $battalion, $continuous, $platoon, $monitor, $officer);
                if ($result)
                    $_SESSION['success'] = '修改成功';
                else
                    $_SESSION['error'] = '修改失败';
                header('location:../Admin/EditUser.php?user_id='.$user_id);
            }
        }
     }
     //管理员查看成绩
    static function scoreSearch(){
        include("../Service/AdminService.php");
        include("ResultShow.php");
        $date = $_POST['date'];
        $project = $_POST['project'];
        $brigade=$_POST['brigade'];
        $battalion = $_POST['battalion'];
        $continuous = $_POST['continuous'];
        $platoon = $_POST['platoon'];
        $monitor = $_POST['monitor'];
        $number=array($date,$project,$brigade,$battalion,$continuous,$platoon,$monitor);
        //清理数组，删除NULL数据
        $i = 6;
        while($number[$i]== ""){
            $i--;
        }
        $clear_number = array_slice($number, 0, $i + 1);
        $result = AdminService::scoreSearch($clear_number);
        $echo_str=ResultShow::adminScoreShow($result,$project,$date);
        echo $echo_str;
    }
    //成绩导入
    static function importScore(){
        include('../Service/ProjectService.php');
        require '../PHPExcel/Classes/PHPExcel/IOFactory.php';
        require_once '../PHPExcel/Classes/PHPExcel/Shared/Date.php';
        $uploadedfile=$_FILES['score_file'];
        if($uploadedfile['type']!="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"&&$uploadedfile['type']!="application/vnd.ms-excel"){
            $_SESSION['error'] = '文件格式错误！';
            header('location:../Admin/importscore.php');
        }else {
        move_uploaded_file($uploadedfile['tmp_name'],"../Static/temp/".$uploadedfile['name']);
        $file="../Static/temp/".$uploadedfile['name'];
        $type = strtolower( pathinfo($file, PATHINFO_EXTENSION) );
        if( $type=='xlsx'||$type=='xls' ) {
            $objPHPExcel = \PHPExcel_IOFactory::load($file);
        }
        elseif($type=='csv') {
            $objReader = \PHPExcel_IOFactory::createReader('CSV')
                ->setDelimiter(',')
                ->setInputEncoding('GBK')
                ->setInputEncoding('GBK')
                ->setEnclosure('"')
                ->setLineEnding("\r\n")
                ->setSheetIndex(0);
            $objPHPExcel = $objReader->load($file);
        }
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet -> getHighestColumn();
        $testColumn ='D';//确定项目名称对应
        $testRow = 2;
        $data = $sheet->getCell($testColumn.$testRow)->getValue();
        $resultexit = ProjectService::exitProject($data);
        if($resultexit){
            for($row=2;$row <=$highestRow;$row++){
                $dataset = array();
                for($column = 'A';$column <= $highestColumn;$column++){
                    $data1 = $sheet->getCell($column.$row)->getValue();
                    array_push($dataset,$data1);
                }
                ProjectService::addScore($resultexit,$dataset);
            }
            unlink("../Static/temp/".$uploadedfile['name']);//删除临时文件
            $_SESSION['success'] = '导入成功！';
            header('location:../Admin/importscore.php');
        }
        else{
            unlink("../Static/temp/".$uploadedfile['name']);//删除临时文件
            $_SESSION['error'] = '导入失败！';
            header('location:../Admin/importscore.php');
        }
        }
    }
    //修改用户成绩
    static function editScore(){
         include("../Service/AdminService.php");
         $project_id=$_POST['project_id'];
         $user_id=$_POST['user_id'];
         $date=$_POST['date'];
         $train_score=$_POST['train_score'];
         $result=AdminService::editScore($project_id,$user_id,$date,$train_score);
         if($result){
             $_SESSION['success'] = '修改成功！';
             echo "<script>history.go(-1);</script>";
         }else{
             $_SESSION['error'] = '修改失败！';
             echo "<script>history.go(-1);</script>";
         }
    }
}