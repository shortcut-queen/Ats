<?php
namespace Ats\Web;
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/29
 * Time: 15:51
 */
class ResultShow{
    static function myScoreShow($result){
        if(count($result)==1){
            $echo_str="<table class='table table-striped'><tr><td>个人编号</td><td>时间</td><td>成绩</td></tr>";
            while($row=mysql_fetch_array($result[0])) {
                $echo_str=$echo_str."<tr><td>$row[0]</td><td>$row[2]</td><td>$row[1]</td></tr>";
            }
            $echo_str=$echo_str."</table>";
            return $echo_str;
        }
        else {
            $echo_str="";
            for ($i = 2; $i < count($result); $i++) {
                $echo_str=$echo_str."<table class='table table-striped'><caption>$result[0][$i-2]&emsp;单位:$result[1][$i-2]</caption><tr><td>个人编号</td><td>时间</td><td>成绩</td></tr>";
                while ($row = mysql_fetch_array($result[$i])) {
                    $echo_str=$echo_str. "<tr><td>$row[0]</td><td>$row[2]</td><td>$row[1]</td></tr>";
                }
                $echo_str=$echo_str. "</table>";
            }
        }
    }
    static function ScoreShow(){
        $result=$_SESSION['result'];
        if(count($result)==1){
            $echo_str="<table class='table table-striped'><tr><td>编号</td><td>姓名</td><td>旅级</td><td>营级</td><td>连级</td><td>排级</td><td>班级</td><td>成绩</td></tr>";
            while($row=mysql_fetch_array($result[0])) {
                $echo_str=$echo_str."<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>$row[7]</td></tr>";
            }
            $echo_str=$echo_str."</table>";
            return $echo_str;
        }
        else {
            $echo_str="";
            for ($i = 2; $i < count($result); $i++) {
                $echo_str=$echo_str."<table class='table table-striped'><caption>$result[0][$i-2]&emsp;单位:$result[1][$i-2]</caption><tr><td>编号</td><td>姓名</td><td>旅级</td><td>营级</td><td>连级</td><td>排级</td><td>班级</td><td>成绩</td></tr>";
                while ($row = mysql_fetch_array($result[$i])) {
                    $echo_str=$echo_str. "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>$row[7]</td></tr>";
                }
                $echo_str=$echo_str. "</table>";
            }
        }
    }
}