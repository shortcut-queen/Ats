<?php

//未登录返回登陆页面
session_start();
if(!isset($_SESSION['user_id']))
    header('location:index.php');
//应用类
include("../Service/ProjectService.php");
use Ats\Service\ProjectService;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户:<?php echo $_SESSION['user_name']; ?></title>
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <script src="../Static/js/bootstrap.min.js"></script>
    <script src="../Static/js/jquery-3.2.1.js"></script>
    <script>
        $(document).ready(function(){
            $("#buttonSearch").click(function(){
                $.post(document.scoreTermSearch.action,
                    {
                        form_name:document.scoreTermSearch.form_name.value,
                        startDate:document.scoreTermSearch.startDate.value,
                        endDate:document.scoreTermSearch.endDate.value,
                        battalion:document.scoreTermSearch.battalion.value,
                        continuous:document.scoreTermSearch.continuous.value,
                        platoon:document.scoreTermSearch.platoon.value,
                        monitor:document.scoreTermSearch.monitor.value,
                        project:document.scoreTermSearch.project.value
                    },
                    function(data){
                        document.getElementById('myScoreDiv').innerHTML=data;
                    });
            });
        });
    </script>
</head>
<body>
<?php include("usernav.php") ?>
//查询成绩
<div style="position: relative;margin-top: 4%;text-align: center">
<?php
$rank=intval($_SESSION['officer']);
if($rank==0)
    echo "个人成绩";
 $option_names=array(
     array('battalion','营级','一营','二营','三营')
    ,array('continuous','连级','一连','二连','三连')
    ,array('platoon','排级','一排','二排','三排')
    ,array('monitor','班级','一班','二班','三班'));
    if($rank>0) {
        //查询所有项目名称
        $result=ProjectService::selectAllProject();
        echo"<form class='form-inline' name='scoreTermSearch' action='../Web/UserController.php' method='post'>";
        echo "<input type='hidden' name='form_name' value='scoreTermSearch'/>";
        echo "<input class='form-control' type='date' name='startDate'/>";
        echo "<input class='form-control' type='date' name='endDate'/>";
        for($j=0;$j<$rank-1;$j++)
            echo "<input type='hidden' name=".$option_names[$j][0]." value=''/>";
        for ($i = $rank - 1; $i < 4; $i += 1)
            echo "<select class='form-control' name=".$option_names[$i][0]."><option value=''>--".$option_names[$i][1]."--</option><option value=''>全部</option><option value='1'>".$option_names[$i][2]."</option><option value='2'>".$option_names[$i][3]."</option><option value='3'>".$option_names[$i][4]."</option></select>";
        echo "<select class='form-control' name='project'><option value='all_project'>--项目--</option><option value='all_project'>全部</option>";
        while ($row=mysql_fetch_array($result))
            echo "<option value='$row[0]'>$row[1]</option>";
        echo "</select>";
        echo "<button id='buttonSearch' class='btn btn-primary' type='button'>查询</button>";
        echo "</form>";
    }
 ?>
</div>
<div id="myScoreDiv"></div>
</body>
</html>