<?php
/**
 * Created by PhpStorm.
 * User: SWX
 * Date: 2018/4/26
 * Time: 13:30
 */

namespace Ats\Dao;
ini_set('date.timezone','Asia/Shanghai');
//引用类
include("../Conn/conn.php");
use Ats\Conn\Conn;
//对用户的操作
class UserDao
{
    //增加用户
    static function addUser($user_id, $user_name, $brigade, $battalion, $continuous, $platoon, $monitor, $warrior, $officer){
        $SQL_ADD_USER = "insert into ats_user(User_Id, User_Name,Brigade, Battalion, Continuous, Platoon, Monitor, Warrior, Officer)values($user_id,'$user_name',$brigade,$battalion,$continuous,$platoon,$monitor,$warrior,$officer)";
        Conn::init();
        $result = Conn::excute($SQL_ADD_USER);
        Conn::close();
        return $result;
    }
    //删除用户
    static function deleteUser($user_id,$user_name){
        $SQL_DELETE_USER = "delete from ats_user where User_Id= $user_id and User_Name ='$user_name'";
        Conn::init();
        $result = Conn::excute($SQL_DELETE_USER);
        Conn::close();
        return $result;//返回true or false
    }
    //修改用户（名字，所属单位,是否长官）依赖：user_id
    static function updateUser($user_id, $user_name,$brigade, $battalion, $continuous, $platoon, $monitor, $warrior, $officer){
        $SQL_UPDATE_USER = "update ats_brigade set User_Name='$user_name',Brigade=$brigade ,Battalion = $battalion, Continuous = $continuous, Platoon= $platoon, Monitor=$monitor, Warrior=$warrior, Officer=$officer where User_Id= $user_id";
        Conn::init();
        $result = Conn::excute($SQL_UPDATE_USER);
        Conn::close();
        return $result;//返回true or false
    }
    //修改用户密码
    static function updateUserPassword($user_id,$new_password){
        $SQL_UPDATE_USER_PASSWORD = "update ats_user set User_Password='$new_password' where User_Id= $user_id";
        Conn::init();
        $result = Conn::excute($SQL_UPDATE_USER_PASSWORD);
        Conn::close();
        return $result;//返回true or false
    }
    //查找用户所属等级及信息
    static function findUserinfo($user_id)
    {
        $SQL_FIND_USERRANK = "select Brigade, Battalion, Continuous, Platoon, Monitor, Officer from ats_user where User_Id ='$user_id'";
        Conn::init();
        $result = Conn::query($SQL_FIND_USERRANK);
        Conn::close();
        return $result;
    }

    //查找所有用户
    static function selectUser()
    {
        $SQL_SELECT_USER = "select User_Id,User_Name from  ats_user";
        Conn::init();
        $result = Conn::query($SQL_SELECT_USER);
        Conn::close();
        return $result;//返回记录集 or false
    }
    //查找指定用户存在否。依赖：user_id
    static function existUser($user_id)
    {
        $SQL_FIND_USER = "select COUNT(*) from ats_user where User_Id=$user_id";
        Conn::init();
        $result = Conn::query($SQL_FIND_USER);
        Conn::close();
        return mysql_fetch_array($result)[0];//返回0 or 1
    }
    //登录查询
    static function loginUser($user_id, $user_password)
    {
        $SQL_LOGIN_USER = "select User_Name, Officer from ats_user where User_Id=$user_id and User_Password='$user_password'";
        Conn::init();
        $result = Conn::query($SQL_LOGIN_USER);
        Conn::close();
        return mysql_fetch_array($result);
    }
    //查询个人单项成绩
    static function myOneProjectScore($number){
        $SQL_SELECT_MY_ONESCORE = "select User_Id,ats_project_$number[1].Train_Score,ats_project_$number[1].Train_Date from ats_project_$number[1] where ats_project_$number[1].User_Id=$number[2]  and ats_project_$number[1].Train_Date = '$number[0]'";
        #echo $SQL_SELECT_MY_ONESCORE;
        Conn::init();
        $result = array();
        $result[0] = Conn::query($SQL_SELECT_MY_ONESCORE);
        Conn::close();
        return $result;
    }

    //查询个人多项成绩
    static function myAllProjectScore($number){
        $SQL_FIND_PROJECT_NAME = "select Project_Id,Project_Name,Project_Unit from ats_project";
        Conn::init();
        $result_project = Conn::query($SQL_FIND_PROJECT_NAME);
        Conn::close();
        $result = array();
        $project_name_array=array();
        $project_unit_array=array();
        while ($row = mysql_fetch_array($result_project)) {
            $number[1]=$row[0];

            $result_score=self::myOneProjectScore($number);
            if(mysql_num_rows($result_score[0])>=1){
                array_push($project_unit_array,$row[2]);
                array_push($project_name_array,$row[1]);
                array_push($result, $result_score[0]);//将遍历所有项目的成绩存储
            }
            #echo mysql_fetch_array($result_score[0])[0];
        }
        array_unshift($result,$project_unit_array);
        array_unshift($result,$project_name_array);

        return $result;
    }

    //查询个人成绩
    static function myScoreSearch($number){
        if($number[1]!= "all_project" ){
            $result = self::myOneProjectScore($number);
        }
        else{
            $result = self::myAllProjectScore($number);
        }
        #echo mysql_fetch_array($result[0])[0];
        return $result;

    }

    //查询单一项目下属成绩
    static function oneProjectScore($clear_number)
    {
        Conn::init();
        //标准的数组
        $whole_number = array("Date", "project_id", "Brigade", "Battalion", "Continuous", "Platoon", "Monitor");
        $len_clear_result = count($clear_number) - 1;
        $SQL_SELECT_ONESCORE = "select ats_user.User_Id,ats_user.User_name,ats_user.Brigade,ats_user.Battalion,ats_user.Continuous,ats_user.Platoon,ats_user.Monitor,ats_project_$clear_number[1].Train_Score from ats_user,ats_project_$clear_number[1] where  ats_user.User_Id=ats_project_$clear_number[1].User_Id and ats_project_$clear_number[1].Train_Date = '$clear_number[0] ' and ats_user.User_Id in(select  User_Id from ats_user where ";
        for ($i = 2; $i < $len_clear_result; $i++) {
            $SQL_ASSIGNMENT = "$whole_number[$i] = '$clear_number[$i]'";
            $SQL_SELECT_ONESCORE = "$SQL_SELECT_ONESCORE" . "$SQL_ASSIGNMENT" . " " . "and" . " ";
        }
        $SQL_SELECT_LOWDOWNSCORE = "$SQL_SELECT_ONESCORE" . "$whole_number[$len_clear_result] = '$clear_number[$len_clear_result]'" . ")";//拼合成SQL语句
        $result = array();
        $result[0] = Conn::query($SQL_SELECT_LOWDOWNSCORE);
        Conn::close();
        return $result;
    }

    //查询全部项目下属成绩
    static function allProjectScore($clear_number)
    {
        //查找已有的全部项目
        $SQL_FIND_PROJECT_NAME = "select Project_Id,Project_Name,Project_Unit from ats_project";
        Conn::init();
        $result_project = Conn::query($SQL_FIND_PROJECT_NAME);
        Conn::close();
        $result = array();
        $project_name_array=array();
        $project_unit_array =array();
        while ($row = mysql_fetch_array($result_project)) {
            $clear_number[1]=$row[0];//赋值项目名称，替换$clear_name[1]中的项目名进行循环遍历
//            array_push($project_name_array,$row[1]);
//            array_push($project_unit_array,$row[2]);
            $result_score=self::oneProjectScore($clear_number);
            if(mysql_num_rows($result_score[0])>=1){
                array_push($project_name_array,$row[1]);
                array_push($project_unit_array,$row[2]);
                array_push($result, $result_score[0]);//将遍历所有项目的成绩存储
            }
        }
        //Conn::close();
        array_unshift($result,$project_unit_array);
        array_unshift($result, $project_name_array);
        return $result;
    }

    //查询下属成绩
    static function selectLowDownScore($clear_number)
    {
        if ($clear_number[1] != 'all_project') {
            //查询指定时间单个项目的个人信息、成绩
            $result = self::oneProjectScore($clear_number);
        } else {
            //查询指定时间所有项目的个人信息、成绩
            $result = self::allProjectScore($clear_number);
        }
        return $result;
    }
    //查询成绩饼状图
    static function selectPieChart($new_number){
        $whole_number = array("Date", "project", "Brigade", "Battalion", "Continuous", "Platoon", "Monitor");
        $len_new_number = count($new_number);
        $string = $whole_number[$len_new_number];
        $result_end = array();

        //判断成绩值越大越好or越小越好
        Conn::init();
        $SQL_SCORE_STANDARD = "select Project_Great, Project_Good, Project_Qualified from ats_project where Project_Id =$new_number[1]";
        $scoreStandard = Conn::query($SQL_SCORE_STANDARD);
        $row = mysql_fetch_array($scoreStandard);
        $unit =array();
        //循环遍历3个单位，返回各单位成绩优秀良好及格不及格率
        for($i = 1;$i<4;$i++){
            //初始化$result_middle数组
            $result_middle = array();
            //循环变换sql语句并查找
            for($k=0;$k<4;$k++){
                //在数据中选择对应的判别式对sql语句进行补充
                if ($row[0]<$row[1]) {
                    $sum = ["< $row[0]","between $row[0] and $row[1]","between $row[1] and $row[2]","> $row[2]"];
                    $SQL_PIE_CHARTPART = "select count(*) from ats_project_$new_number[1] where Train_Score $sum[$k] and Train_Date = '$new_number[0]' and User_Id in(select User_Id from ats_user where ";
                }else {
                    $sum1 = [" > $row[0]","between $row[1] and $row[0]","between $row[2] and $row[1]","< $row[2]"];
                    $SQL_PIE_CHARTPART = "select count(*) from ats_project_$new_number[1] where Train_Score $sum1[$k] and Train_Date = '$new_number[0]' and User_Id in(select User_Id from ats_user where ";
                }
                //循环插入条件语句
                for($j =2;$j<$len_new_number;$j++){
                    $SQL_ASSIGMENT = "$whole_number[$j]='$new_number[$j]'";
                    $SQL_PIE_CHARTPART = "$SQL_PIE_CHARTPART" . "$SQL_ASSIGMENT"." "."and" ." ";
                }
                $SQL_PIE_CHART = "$SQL_PIE_CHARTPART" . "$string = '$i'".")";
                $result=Conn::query($SQL_PIE_CHART);
                //判断是否查到数据，否则插入0
                if(mysql_num_rows($result)>=1){
                    array_push($result_middle,mysql_fetch_array($result)[0]);
                }else{
                    array_push($result_middle,int(0));
                }
            }
            array_push($result_end,$result_middle);
            array_push($unit,$i);
        }
        array_unshift($result_end,$unit);
        Conn::close();
        return $result_end;
    }
//获取制定日期段内每一天日期
    static function getDateFromRange($startdate,$enddate){
        $s_timestamp = strtotime($startdate);
        $e_timestamp = strtotime($enddate);
        //计算日期段内有多少天
        $days = ($e_timestamp-$s_timestamp)/86400+1;
        //保存每天日期
        $date= array();
        for($i=0;$i<$days;$i++){
            $date[]=date('Y-m-d',$s_timestamp+(86400*$i));
        }
        return $date;
    }
    //查找单项成绩折线图
    static function selectLineChart($line_number){
        $whole_number = array("Date_start","Date_end", "project", "Brigade", "Battalion", "Continuous", "Platoon", "Monitor");
        //返回两个日期间的所有日期
        $date = self::getDateFromRange($line_number[0],$line_number[1]);
        $len_line_number = count($line_number)-1;
        $result_score = array();
        $selectdate =array();
        //判断成绩值越大越好or越小越好
        Conn::init();
        $SQL_SCORE_STANDARD = "select Project_Great, Project_Good, Project_Qualified from ats_project where Project_Id =$line_number[2]";
        $scoreStandard = Conn::query($SQL_SCORE_STANDARD);
        $row = mysql_fetch_array($scoreStandard);
        for($i=0;$i<count($date);$i++) {
            $result_score_middle = array();
            for ($k = 0; $k < 4; $k++) {
                //在数据中选择对应的判别式对sql语句进行补充
                if ($row[0] < $row[1]) {
                    $sum = ["< $row[0]", "between $row[0] and $row[1]", "between $row[1] and $row[2]", "> $row[2]"];
                    $SQL_LINE_CHARTPART = "select count(*) from ats_project_$line_number[2] where Train_Score $sum[$k] and Train_Date = '$date[$i]' and User_Id in(select User_Id from ats_user where ";
                } else {
                    $sum1 = [" > $row[0]", "between $row[1] and $row[0]", "between $row[2] and $row[1]", "< $row[2]"];
                    $SQL_LINE_CHARTPART = "select count(*) from ats_project_$line_number[2] where Train_Score $sum1[$k] and Train_Date = '$date[$i]' and User_Id in(select User_Id from ats_user where ";
                }
                //循环插入条件语句
                for ($j = 3; $j < $len_line_number; $j++) {
                    $SQL_ASSIGMENT = "$whole_number[$j]='$line_number[$j]'";
                    $SQL_LINE_CHARTPART = "$SQL_LINE_CHARTPART" . "$SQL_ASSIGMENT" . " " . "and" . " ";
                }
                $SQL_LINE_CHART = "$SQL_LINE_CHARTPART" . "$whole_number[$len_line_number] = $line_number[$len_line_number]" . ")";
                #$echo_sql_str=$echo_sql_str.$SQL_LINE_CHART.'</br>';
                $result = Conn::query($SQL_LINE_CHART);
                if (mysql_num_rows($result)>= 1) {
                    array_push($result_score_middle, mysql_fetch_array($result)[0]);
                } else {
                    array_push($result_score_middle, int(0));
                }
            }
            #echo count($result_score_middle);
            $sumscore = 0;
            for ($m = 0; $m < 4; $m++) {
                $sumscore = $sumscore + $result_score_middle[$m];
            }
            //计算优秀良好及格率
            if ($sumscore > 0) {
                array_push($selectdate, $date[$i]);
                $greatpercent = $result_score_middle[0];
                $goodpercent = $result_score_middle[0] + $result_score_middle[1];
                $qualifypercent = $result_score_middle[0] + $result_score_middle[1] + $result_score_middle[2];
                $resultscore = ($greatpercent * 45 + $goodpercent * 35 + $qualifypercent * 20) / $sumscore;
                array_push($result_score, $resultscore);
            }
        }
        array_unshift($result_score,$selectdate);
        return $result_score;
    }

    //龙虎榜
    static function longhubang(){
        $projectId = array();
        $projectName = array();
        $projectUnit = array();
        $resultall= array();
        $resultunit = array();
        $resultname = array();
        //查找已有的全部项目
        $SQL_FIND_PROJECT_NAME = "select Project_Id,Project_Name,Project_Unit from ats_project";
        Conn::init();
        $result_project = Conn::query($SQL_FIND_PROJECT_NAME);



        while($row = mysql_fetch_array($result_project)){
            array_push($projectId, $row[0]);
            array_push($projectName, $row[1]);
            array_push($projectUnit,$row[2]);
        }
        for($i=0;$i<count($projectId);$i++){
            $SQL_SCORE_STANDARD = "select Project_Great, Project_Good, Project_Qualified from ats_project where Project_Id =$projectId[$i]";
            $scoreStandard = Conn::query($SQL_SCORE_STANDARD);
            $row1 = mysql_fetch_array($scoreStandard);
            if(intval($row1[0])<intval($row1[1])){
                $SQL_SCORE_MIN =  "select ats_user.User_Id, ats_user.User_Name,ats_project_$projectId[$i].Train_Score, ats_project_$projectId[$i].Train_Date, ats_user.Brigade, ats_user.Battalion,ats_user.Continuous,ats_user.Platoon,ats_user.Monitor from ats_user,ats_project_$projectId[$i] where ats_user.User_Id = ats_project_$projectId[$i].User_Id and Train_Score = (select min(Train_Score) from ats_project_$projectId[$i])";
                $result_score = Conn::query($SQL_SCORE_MIN);
            }else{
                $SQL_SCORE_MAX =  "select ats_user.User_Id, ats_user.User_Name,ats_project_$projectId[$i].Train_Score, ats_project_$projectId[$i].Train_Date, ats_user.Brigade, ats_user.Battalion,ats_user.Continuous,ats_user.Platoon,ats_user.Monitor from ats_user,ats_project_$projectId[$i] where ats_user.User_Id = ats_project_$projectId[$i].User_Id and Train_Score = (select max(Train_Score) from ats_project_$projectId[$i])";
                $result_score = Conn::query($SQL_SCORE_MAX);
            }
            if(mysql_num_rows($result_score)==0)
                continue;
            array_push($resultall,$result_score);
            array_push($resultname,$projectName[$i]);
            array_push($resultunit,$projectUnit[$i]);
        }
        array_unshift($resultall,$resultunit);
        array_unshift($resultall,$resultname);
        Conn::close();
        return $resultall;
    }
}