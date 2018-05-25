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
    <title>下属成绩</title>
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <script src="../Static/js/bootstrap.min.js"></script>
    <script src="../Static/js/jquery-3.2.1.js"></script>
    <script>
        $(document).ready(function(){
            $("#buttonSearch").click(function(){
                var army_array=new Array(document.scoreSearch.date.value,document.scoreSearch.battalion.value,document.scoreSearch.continuous.value,document.scoreSearch.platoon.value,document.scoreSearch.monitor.value);
                if(army_array[0]=="")
                    $("#error_show").text("请选择日期");
                else {
                    var i = 1;
                    var flag = 1;
                    for (i; i < 5; i++)
                        if (army_array[i] == "")
                            break;
                    for (i++; i < 5; i++) {
                        if (army_array[i] != "") {
                            flag = 0;
                            break;
                        }
                    }
                    if (flag == 0) {
                        $("#error_show").text("请规范选择部队");
                    } else {
                        $("#error_show").text("");
                        $.post(document.scoreSearch.action,
                            {
                                form_name: document.scoreSearch.form_name.value,
                                date: document.scoreSearch.date.value,
                                battalion: document.scoreSearch.battalion.value,
                                continuous: document.scoreSearch.continuous.value,
                                platoon: document.scoreSearch.platoon.value,
                                monitor: document.scoreSearch.monitor.value,
                                project: document.scoreSearch.project.value
                            },
                            function (data) {
                                if ($("select[name='project'] option:selected").val() != "all_project") {
                                    document.getElementById('table_name').style.display = 'block';
                                    document.getElementById('table_name').innerHTML = $("select[name='project'] option:selected").text();
                                }
                                document.getElementById('scoreDiv').innerHTML = data;
                            });
                    }
                }
            });
        });
    </script>
</head>
<body>
<?php include("usernav.php") ?>
<div style="position: relative;width:100%;text-align:center;font-size:large;margin-top: 4%">下属成绩查询</div>
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
        echo"<form class='form-inline' name='scoreSearch' action='../Web/UserController.php' method='post'>";
        echo "<input type='hidden' name='form_name' value='scoreSearch'/>";
        echo "<input class='form-control' type='date' name='date'/>";
        for($j=0;$j<$rank-1;$j++)
            echo "<input type='hidden' name=".$option_names[$j][0]." value='0'/>";
        for ($i = $rank - 1; $i < 4; $i += 1)
            echo "<select class='form-control' name=".$option_names[$i][0]."><option value=''>--".$option_names[$i][1]."--</option><option value='1'>".$option_names[$i][2]."</option><option value='2'>".$option_names[$i][3]."</option><option value='3'>".$option_names[$i][4]."</option></select>";
        echo "<select class='form-control' name='project'><option value='all_project'>--项目--</option><option value='all_project'>全部</option>";
        while ($row=mysql_fetch_array($result))
            echo "<option value='".$row['Project_Id']."'>".$row['Project_Name']."</option>";
        echo "</select>";
        echo "<button id='buttonSearch' class='btn btn-primary' type='button'>查询</button>";
        echo "</form>";
    }
 ?>
</div>
<p id="error_show" style="color: red;width: 100%;text-align: center"></p>
<label id="table_name" style="position: relative;margin-top: 5%;width: 100%;text-align: center;font-size: large"></label>
<div id="scoreDiv"></div>
</body>
</html>