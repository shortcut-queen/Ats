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
            $echo_str = "<table style='width: 80%;margin-left: 10%;text-align: center;' class='table table-striped'><thead ><tr><th style='text-align: center'>编号</th><th style='text-align: center'>姓名</th><th style='text-align: center'>所属部队</th><th style='text-align: center'>成绩</th></tr></thead>";
            while ($row = mysql_fetch_array($result[0])) {
                $army_str="";
                $army=array(array('一','二','三'),array('旅','营','连','排','班'));
                for($j=0;$j<5;$j++) {
                    if(intval($row[$j+2])==0)
                        break;
                    else
                        $army_str=$army_str.$army[0][intval($row[$j+2])-1].$army[1][$j];
                }
                $echo_str = $echo_str . "<tr><td>$row[0]</td><td>$row[1]</td><td>$army_str</td><td>$row[7]</td></tr>";
            }
            $echo_str = $echo_str . "</table></br>";
            return $echo_str;
        } else {
            $echo_str = "";
            for ($i = 2; $i < count($result); $i++) {
                $echo_str = $echo_str . "<table style='width: 80%;margin-left: 10%;text-align: center;' class='table table-striped'><caption style='text-align:center;font-size: 18px'><b>" . $result[0][$i - 2] . "&emsp;单位:" . $result[1][$i - 2] . "</b></caption><thead ><tr><th style='text-align: center'>编号</th><th style='text-align: center'>姓名</th><th style='text-align: center'>所属部队</th><th style='text-align: center'>成绩</th></tr></thead>";
                while ($row = mysql_fetch_array($result[$i])) {
                    $army_str="";
                    $army=array(array('一','二','三'),array('旅','营','连','排','班'));
                    for($j=0;$j<5;$j++) {
                        if(intval($row[$j+2])==0)
                            break;
                        else
                            $army_str=$army_str.$army[0][intval($row[$j+2])-1].$army[1][$j];
                    }
                    $echo_str = $echo_str . "<tr><td>$row[0]</td><td>$row[1]</td><td>$army_str</td><td>$row[7]</td></tr>";
                }
                $echo_str = $echo_str . "</table></br>";
            }
            return $echo_str;
        }
    }
    //管理员显示查询到的成绩
    static function adminScoreShow($result,$project_id,$date)
    {
        if (count($result) == 1) {
            $echo_str = "<table style='width: 80%;margin-left: 10%;text-align: center;' class='table table-striped'><thead ><tr><th style='text-align: center'>编号</th><th style='text-align: center'>姓名</th><th style='text-align: center'>所属部队</th><th style='text-align: center'>成绩</th><th style='text-align: center'>修改</th><th style='text-align: center'>删除</th></tr></thead>";
            while ($row = mysql_fetch_array($result[0])) {
                $army_str="";
                $army=array(array('一','二','三'),array('旅','营','连','排','班'));
                for($j=0;$j<5;$j++) {
                    if(intval($row[$j+2])==0)
                        break;
                    else
                        $army_str=$army_str.$army[0][intval($row[$j+2])-1].$army[1][$j];
                }
                $echo_str = $echo_str . "<tr><td>$row[0]</td><td>$row[1]</td><td>$army_str</td><td>$row[7]</td><td><a href='../Admin/EditScore.php?user_id=".$row[0]."&project_id=$project_id&date=$date'><button class='btn btn-primary'>修改</button></a></td><td><a href='../Admin/DeleteScore.php?user_id=".$row[0]."&project_id=$project_id&date=$date'><button class='btn btn-danger'>删除</button></a></td></tr>";
            }
            $echo_str = $echo_str . "</table></br>";
            return $echo_str;
        } else {
            $echo_str = "";
            for ($i = 3; $i < count($result); $i++) {
                $echo_str = $echo_str . "<table style='width: 80%;margin-left: 10%;text-align: center;' class='table table-striped'><caption style='text-align:center;font-size: 18px'><b>" . $result[1][$i - 3] . "&emsp;单位:" . $result[2][$i - 3] . "</b></caption><thead ><tr><th style='text-align: center'>编号</th><th style='text-align: center'>姓名</th><th style='text-align: center'>所属部队</th><th style='text-align: center'>成绩</th><th style='text-align: center'>修改</th><th style='text-align: center'>删除</th></tr></thead>";
                while ($row = mysql_fetch_array($result[$i])) {
                    $army_str="";
                    $army=array(array('一','二','三'),array('旅','营','连','排','班'));
                    for($j=0;$j<5;$j++) {
                        if(intval($row[$j+2])==0)
                            break;
                        else
                            $army_str=$army_str.$army[0][intval($row[$j+2])-1].$army[1][$j];
                    }
                    $echo_str = $echo_str . "<tr><td>$row[0]</td><td>$row[1]</td><td>$army_str</td><td>$row[7]</td><td><a href='../Admin/EditScore.php?user_id=".$row[0]."&project_id=".$result[0][$i-3]."&date=$date'><button class='btn btn-primary'>修改</button></a></td><td><a href='../Admin/DeleteScore.php?user_id=".$row[0]."&project_id=".$result[0][$i-3]."&date=$date'><button class='btn btn-danger'>删除</button></a></td></tr>";
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
        $echo_str="";
        for($i=0;$i<count($result[0]);$i++)
            $echo_str=$echo_str."<input type='hidden' id='date".$i."' name='".$result[0][$i]."' value='".$result[$i+1]."'>";
        return $echo_str;
    }
    //显示个人折线图
    static function showMyLine($result){
        $echo_str="";
        for($i=0;$i<count($result);$i++) {
            $row=mysql_fetch_array($result[$i]);
            $echo_str = $echo_str . "<input type='hidden' id='date" . $i . "' name='" . $row['Train_Date'] . "' value='" . $row['Train_Score'] . "'>";
        }
        return $echo_str;
    }
    //显示所有项目
    static function showAllProject($result){
        $echo_str="<table style='width: 80%;margin-left: 10%;text-align: center;' class='table table-striped'><thead ><tr><th style='text-align: center'>序号</th><th style='text-align: center'>项目名称</th><th style='text-align: center'>单位</th><th style='text-align: center'>优秀</th><th style='text-align: center'>良好</th><th style='text-align: center'>及格</th><th style='text-align: center'>编辑</th><th style='text-align: center'>删除</th></tr></thead>";
        while($row=mysql_fetch_array($result))
            $echo_str=$echo_str."<tr><td>".$row['Project_Id']."</td><td>".$row['Project_Name']."</td><td>".$row['Project_Unit']."</td><td>".$row['Project_Great']."</td><td>".$row['Project_Good']."</td><td>".$row['Project_Qualified']."</td><td><a href='../Admin/EditProject.php?project_id=".$row['Project_Id']."'><button class='btn btn-group-sm btn-primary' type='button'>编辑</button></a></td><td><a href='../Admin/DeleteProject.php?project_id=".$row['Project_Id']."'><button class='btn btn-group-sm btn-danger' type='button'>删除</button></a></td></tr>";
        $echo_str=$echo_str."</table>";
        return $echo_str;
    }
    //显示所有管理员
    static function showAllAdmin($result){
        $echo_str="<table style='width: 80%;margin-left: 10%;text-align: center;' class='table table-striped'><thead ><tr><th style='text-align: center'>序号</th><th style='text-align: center'>管理员姓名</th><th style='text-align: center'>删除</th></tr></thead>";
        $i=1;
        while($row=mysql_fetch_array($result)){
            $echo_str=$echo_str."<tr><td>$i</td><td>".$row['Admin_Name']."</td><td><a href='../Admin/DeleteAdmin.php?admin_name=".$row['Admin_Name']."'><button class='btn btn-group-sm btn-danger' type='button'>删除</button></a></td></tr>";
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
    //显示龙虎榜
    static function showTopList($result){
        $echo_str =  "<table style='width: 80%;margin-left: 10%;text-align: center;' class='table table-striped'><thead><tr><th style='text-align: center'>项目</th><th style='text-align: center'>项目单位</th><th style='text-align: center'>编号</th><th style='text-align: center'>姓名</th><th style='text-align: center'>日期</th><th style='text-align: center'>所属部队</th><th style='text-align: center'>成绩</th></tr></thead>";
        for ($i = 0; $i < count($result[0]); $i++) {
             while ($row = mysql_fetch_array($result[$i+2])) {
                $army_str="";
                $army=array(array('一','二','三'),array('旅','营','连','排','班'));
                for($j=0;$j<5;$j++) {
                    if(intval($row[$j+4])==0)
                        break;
                    else
                        $army_str=$army_str.$army[0][intval($row[$j+4])-1].$army[1][$j];
                }
                $echo_str = $echo_str . "<tr><td>".$result[0][$i]."</td><td>".$result[1][$i]."</td><td>".$row['User_Id']."</td><td>".$row['User_Name']."</td><td>".$row['Train_Date']."</td><td>$army_str</td><td>".$row['Train_Score']."</td></tr>";
            }
        }
        $echo_str = $echo_str . "</table>";
        return $echo_str;
    }
    //显示查询到的用户信息
    static function showFoundUser($result){
        $echo_str="<table style='width: 80%;margin-left: 10%;text-align: center;' class='table table-striped'><thead ><tr><th style='text-align: center'>编号</th><th style='text-align: center'>姓名</th><th style='text-align: center'>所属部队</th><th style='text-align: center'>等级</th><th style='text-align: center'>编辑</th><th style='text-align: center'>删除</th></tr></thead>";
        while($row=mysql_fetch_array($result)) {
            $army_str="";
            $army=array(array('一','二','三'),array('旅','营','连','排','班'),array('战士','旅长','营长','连长','排长','班长'));
            for($j=0;$j<5;$j++) {
                if(intval($row[$j+3])==0)
                    break;
                else
                    $army_str=$army_str.$army[0][intval($row[$j+3])-1].$army[1][$j];
            }
            $echo_str = $echo_str . "<tr><td>" . $row['User_Id'] . "</td><td>" . $row['User_Name'] . "</td><td>" . $army_str . "</td><td>" . $army[2][intval($row['Officer'])] . "</td><td><a href='../Admin/EditUser.php?user_id=" . $row['User_Id'] . "'><button class='btn btn-group-sm btn-primary' type='button'>编辑</button></a></td><td><a href='../Admin/DeleteUser.php?user_id=" . $row['User_Id'] . "'><button class='btn btn-group-sm btn-danger' type='button'>删除</button></a></td></tr>";
        }
        $echo_str=$echo_str."</table>";
        return $echo_str;
    }
    //管理员界面显示资源
    static function showResource($result){
        $echo_str="<table style='width: 80%;margin-left: 10%;text-align: center;' class='table table-striped'><thead ><tr><th style='text-align: center'>序号</th><th style='text-align: center'>资源标题</th><th style='text-align: center'>资源类型</th><th style='text-align: center'>上传时间</th><th style='text-align: center'>下载量</th><th style='text-align: center'>上传者</th><th style='text-align: center'>查看</th><th style='text-align: center'>删除</th></tr></thead>";
        $i=1;
        while($row=mysql_fetch_array($result)){
            $type=array('文档','图片','视频');
            $echo_str=$echo_str."<tr><td>$i</td><td>".$row['Resource_Name']."</td><td>".$type[intval($row['Resource_Type'])-1]."</td><td>".$row['Upload_Date']."</td><td>".$row['Resource_Download']."</td><td>".$row['Admin_Name']."</td><td><a href='../Admin/ResourceDetail.php?resource_id=" . $row['Resource_Id'] . "'><button class='btn btn-group-sm btn-primary' type='button'>查看</button></a></td><td><a href='../Admin/DeleteResource.php?resource_id=" . $row['Resource_Id'] . "&resource_type=".$row['Resource_Type']."&resource_address=".$row['Resource_Address']."'><button class='btn btn-group-sm btn-danger' type='button'>删除</button></a></td></tr>";
            $i+=1;
        }
        $echo_str=$echo_str."</table>";
        return $echo_str;
    }
    //用户界面显示资源
    static function showUserResource($result){
        $echo_str="<table style='width: 80%;margin-left: 10%;' class='table'>";
        $i=0;
        $flag=0;
        $type_dir=array("text","img","video");
        $type_array=array("../Static/images/doc.png","../Static/images/picture.png","../Static/images/video.png");
        while($row=mysql_fetch_array($result)){
            if($i%4==0&&$flag==0) {
                $echo_str = $echo_str . "<tr>";
                $flag=1;
            }
            $echo_str=$echo_str."<td style='width: 25%;height: 200px;'><div style='width: 100%;height: 30px;background-color:rgba(70,184,218,0.5);'><span style='float: left;padding:2% 0 0 5%;height:100%;width:80%;font-size: 16px;overflow: hidden;'>".$row['Resource_Name']."</span><img style='width:20px;height:20px;float: right;margin:2% 5% 0 0;'src='".$type_array[intval($row['Resource_Type'])-1]."'/></div><div style='width: 100%;background-color:rgba(70,184,218,0.5);height: 140px;font-size:15px;line-height:1.5em;overflow: hidden;text-align: left;padding:3% 3% 3% 3%;'>".str_replace("\n",'<br>',$row['Resource_About'])."</div><div style='width: 100%;height:30px'><div style='background-color: #ff8500;width:49.5%;float: left;text-align: center;height: 100%;'><a style='color: black;text-decoration: none;width:100%;' href='../Home/resourcedetail.php?resource_id=".$row['Resource_Id']."'><button class='btn btn-primary' style='width: 100%; height: 100%;border-radius: 0px;'>查看</button></a></div><div style='float: left;height:100%;text-align: center;width:49.5%;margin-left: 1%;'><a href='../Static/upload/".$type_dir[intval($row['Resource_Type'])-1]."/".$row['Resource_Address']."' download='".$row['Resource_Address']."' style='width:100%;height: 100%;'><button class='btn btn-success' style='width: 100%; height: 100%;border-radius: 0px;' onclick='download(".$row['Resource_Id'].")'>下载</button></a></div></div></td>";
            $i+=1;
            if($i%4==0&&$flag==1) {
                $echo_str = $echo_str . "</tr>";
                $flag=0;
            }
        }
        $j=$i%4;
        while($j>0&&$j<4) {
            $echo_str = $echo_str . "<td style='width: 25%;height: 200px;'></td>";
            $j+=1;
        }
        $echo_str=$echo_str."</table>";
        return $echo_str;
    }
}