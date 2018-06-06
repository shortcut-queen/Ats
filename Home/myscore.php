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
    <title>个人成绩</title>
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <script src="../Static/js/bootstrap.min.js"></script>
    <script src="../Static/js/jquery-3.2.1.js"></script>
    <script>
        $(document).ready(function(){
            $("#buttonSearch").click(function(){
                if(document.myScoreSearch.date.value=="")
                    $("#error_show").text("请选择日期");
                else {
                    $("#error_show").text("");
                    $.post(document.myScoreSearch.action,
                        {
                            form_name: document.myScoreSearch.form_name.value,
                            date: document.myScoreSearch.date.value,
                            project: document.myScoreSearch.project.value
                        },
                        function (data) {
                            if ($("select[name='project'] option:selected").val() != "all_project") {
                                document.getElementById('table_name').style.display = 'block';
                                document.getElementById('table_name').innerHTML = $("select[name='project'] option:selected").text();
                            }
                            else
                                document.getElementById('table_name').style.display = 'none';
                            if(data=="")
                                data="<div style='width:100%;text-align: center;'>没有数据</div>";
                            document.getElementById('myScoreDiv').innerHTML = data;
                        });
                }
            });
        });
    </script>
</head>
<body>
<?php include("usernav.php") ?>
<div style="position: relative;width:100%;text-align:center;font-size:large;margin-top: 4%">我的成绩</div>
<div style="position: relative;margin-top: 4%;text-align: center">
    <?php
        //查询所有项目名称
        $result=ProjectService::selectAllProject();
        echo"<form class='form-inline' name='myScoreSearch' action='../Web/UserController.php' method='post'>";
        echo "<input type='hidden' name='form_name' value='myScoreSearch'/>";
        echo "<input class='form-control' type='date' name='date'/>";
        echo "<select class='form-control' name='project'><option value='all_project'>--项目--</option><option value='all_project'>全部</option>";
        while ($row=mysql_fetch_array($result))
            echo "<option value='".$row['Project_Id']."'>".$row['Project_Name']."</option>";
        echo "</select>";
        echo "<button id='buttonSearch' class='btn btn-primary' type='button'>查询</button>";
        echo "</form>";
        ?>
</div>
<p id="error_show" style="color: red;width: 100%;text-align: center"></p>
<label id="table_name" style="position: relative;margin-top: 5%;width: 100%;text-align: center;font-size: large"></label>
<div id="myScoreDiv" style="margin-top: 3%;"></div>
</body>
</html>