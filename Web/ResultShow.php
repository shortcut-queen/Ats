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
            echo "<table class='table table-striped'><tr><td>个人编号</td><td>时间</td><td>成绩</td></tr>";
            while($row=mysql_fetch_array($result[0])) {
                echo "<tr><td>$row[0]</td><td>$row[2]</td><td>$row[1]</td></tr>";
            }
            echo"</table>";
        }
        else {
            for ($i = 2; $i < count($result); $i++) {
                echo "<table class='table table-striped'><caption>$result[0][$i-2]&emsp;单位:$result[1][$i-2]</caption><tr><td>个人编号</td><td>时间</td><td>成绩</td></tr>";
                while ($row = mysql_fetch_array($result[$i])) {
                    echo "<tr><td>$row[0]</td><td>$row[2]</td><td>$row[1]</td></tr>";
                }
                echo "</table>";
            }
        }
    }

}