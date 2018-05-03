<?php
namespace Ats\Web;
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/29
 * Time: 15:51
 */
class ResultShow
{
    //显示个人成成绩
    static function myScoreShow($result)
    {
        if (count($result) == 1) {
            $echo_str = "<table style='width: 80%;margin-left: 10%;text-align: center;' class='table table-striped'><thead><tr><th style='text-align: center'>个人编号</th><th style='text-align: center'>时间</th><th style='text-align: center'>成绩</th></tr></thead>";
            while ($row = mysql_fetch_array($result[0])) {
                $echo_str = $echo_str . "<tr><td>$row[0]</td><td>$row[2]</td><td>$row[1]</td></tr>";
            }
            $echo_str = $echo_str . "</table></br>";
            return $echo_str;
        } else {
            $echo_str = "";
            for ($i = 2; $i < count($result); $i++) {
                $echo_str = $echo_str . "<table style='width: 80%;margin-left: 10%;text-align: center;' class='table table-striped'><caption style='text-align:center;font-size: large'><b>" . $result[0][$i - 2] . "&emsp;单位:" . $result[1][$i - 2] . "</b></caption><thead><tr><th style='text-align: center'>个人编号</th><th style='text-align: center'>时间</th><th style='text-align: center'>成绩</th></tr></thead>";
                while ($row = mysql_fetch_array($result[$i])) {
                    $echo_str = $echo_str . "<tr><td>$row[0]</td><td>$row[2]</td><td>$row[1]</td></tr>";
                }
                $echo_str = $echo_str . "</table></br>";
            }
            return $echo_str;
        }
    }

    //显示查询到的下属成绩
    static function scoreShow($result)
    {

        if (count($result) == 1) {
            $echo_str = "<table style='width: 80%;margin-left: 10%;text-align: center;' class='table table-striped'><thead ><tr><th style='text-align: center'>编号</th><th style='text-align: center'>姓名</th><th style='text-align: center'>旅级</th><th style='text-align: center'>营级</th><th style='text-align: center'>连级</th><th style='text-align: center'>排级</th><th style='text-align: center'>班级</th><th style='text-align: center'>成绩</th></tr></thead>";
            while ($row = mysql_fetch_array($result[0])) {
                $echo_str = $echo_str . "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>$row[7]</td></tr>";
            }
            $echo_str = $echo_str . "</table></br>";
            return $echo_str;
        } else {
            $echo_str = "";
            for ($i = 2; $i < count($result); $i++) {
                $echo_str = $echo_str . "<table style='width: 80%;margin-left: 10%;text-align: center;' class='table table-striped'><caption style='text-align:center;font-size: 18px'><b>" . $result[0][$i - 2] . "&emsp;单位:" . $result[1][$i - 2] . "</b></caption><thead ><tr><th style='text-align: center'>编号</th><th style='text-align: center'>姓名</th><th style='text-align: center'>旅级</th><th style='text-align: center'>营级</th><th style='text-align: center'>连级</th><th style='text-align: center'>排级</th><th style='text-align: center'>班级</th><th style='text-align: center'>成绩</th></tr></thead>";
                while ($row = mysql_fetch_array($result[$i])) {
                    $echo_str = $echo_str . "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>$row[7]</td></tr>";
                }
                $echo_str = $echo_str . "</table></br>";
            }
            return $echo_str;
        }
    }
    //显示饼状图
    static function showPie($result){
        $echo_str="";
        for($i=0;$i<count($result[0]);$i++){
            if((intval($result[$i+1][0])+intval($result[$i+1][1])+intval($result[$i+1][2])+intval($result[$i+1][3]))==0)
                continue;
            $echo_str=$echo_str."<div id='canvas_".$result[0][$i]."'><input id='great".$result[0][$i]."' value='".$result[$i+1][0]."' type='hidden'><input id='good".$result[0][$i]."' value='".$result[$i+1][1]."' type='hidden'><input id='qualified".$result[0][$i]."' value='".$result[$i+1][2]."' type='hidden'><input id='out".$result[0][$i]."' value='".$result[$i+1][3]."' type='hidden'></div><div id='canvas_show_".$result[0][$i]."' style='width: 400px; height: 300px;float: left'></div>";
        }
        return $echo_str;
    }
    //显示折线图
    static function showLine($result){

    }
    //显示所有项目
    static function showAllProject($result){
        $echo_str="<table style='width: 80%;margin-left: 10%;text-align: center;' class='table table-striped'><thead ><tr><th style='text-align: center'>序号</th><th style='text-align: center'>项目名称</th><th style='text-align: center'>单位</th><th style='text-align: center'>优秀</th><th style='text-align: center'>良好</th><th style='text-align: center'>及格</th><th style='text-align: center'>编辑</th><th style='text-align: center'>删除</th></tr></thead>";
        while($row=mysql_fetch_array($result))
            $echo_str=$echo_str."<tr><td>".$row['Project_Id']."</td><td>".$row['Project_Name']."</td><td>".$row['Project_Unit']."</td><td>".$row['Project_Great']."</td><td>".$row['Project_Good']."</td><td>".$row['Project_Qualified']."</td><td><a href='../Web/EditProject.php?project_id=".$row['Project_Id']."'><button class='btn btn-group-sm btn-primary' type='button'>编辑</button></a></td><td><a href='../Web/DeleteProject.php?project_id=".$row['Project_Id']."'><button class='btn btn-group-sm btn-danger' type='button'>删除</button></a></td></tr>";
        $echo_str=$echo_str."</table>";
        return $echo_str;
    }
    //显示所有管理员
    static function showAllAdmin($result){
        $echo_str="<table style='width: 80%;margin-left: 10%;text-align: center;' class='table table-striped'><thead ><tr><th style='text-align: center'>序号</th><th style='text-align: center'>管理员姓名</th><th style='text-align: center'>删除</th></tr></thead>";
        $i=1;
        while($row=mysql_fetch_array($result)){
            $echo_str=$echo_str."<tr><td>$i</td><td>".$row['Admin_Name']."</td><td><a href='../Web/DeleteAdmin.php?admin_name=".$row['Admin_Name']."'><button class='btn btn-group-sm btn-danger' type='button'>删除</button></a></td></tr>";
            $i++;
        }
        $echo_str=$echo_str."</table>";
        return $echo_str;
    }
    //显示个人信息
    static function showMyInfo($result){
        $row=mysql_fetch_array($result);
        $army_str="";
        $army=array(array('一','二','三'),array('旅','营','连','排','班'),array('战士','旅长','营长','连长','排长','班长'));
        for($i=0;$i<5;$i++) {
            if(intval($row[$i])==0)
                break;
            else
                $army_str=$army_str.$army[0][intval($row[$i])-1].$army[1][$i];
        }
        $echo_str="<table style='width: 80%;margin-left: 10%;text-align: center;' class='table table-striped'><thead ><tr><th style='text-align: center'>个人编号</th><th style='text-align: center'>所属部队</th><th style='text-align: center'>等级</th></tr></thead>";
        $echo_str=$echo_str."<tr><td>".$_SESSION['user_id']."</td><td>".$army_str."</td><td>".$army[2][intval($row[5])]."</td></tr>";
        $echo_str=$echo_str."</table>";
        return $echo_str;
    }

}