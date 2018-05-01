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
                $.post("../Web/UserController.php",
                    {
                        form_name:document.myScoreSearch.form_name.value,
                        date:document.myScoreSearch.date.value,
                        project:document.myScoreSearch.project.value,
                    },
                    function(data){
                        document.getElementById('table_name').innerHTML=document.myScoreSearch.project.value;
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
        //查询所有项目名称
        $result=ProjectService::selectAllProject();
        echo"<form class='form-inline' name='myScoreSearch' action='../Web/UserController.php' method='post'>";
        echo "<input type='hidden' name='form_name' value='myScoreSearch'/>";
        echo "<input class='form-control' type='date' name='date'/>";
        echo "<select class='form-control' name='project'><option value='all_project'>--项目--</option><option value='all_project'>全部</option>";
        while ($row=mysql_fetch_array($result))
            echo "<option value='$row[0]'>$row[1]</option>";
        echo "</select>";
        echo "<button id='buttonSearch' class='btn btn-primary' type='button'>查询</button>";
        echo "</form>";
        ?>
</div>
<label id="table_name" style="position: relative;margin-top: 5%;"></label>
<div id="myScoreDiv"></div>
</body>
</html>