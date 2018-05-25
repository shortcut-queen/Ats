<?php
//未登录返回登陆页面
session_start();
if(!isset($_SESSION['user_id']))
    header('location:index.php');
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
    <script src="../Static/js/echarts.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#buttonSearch").click(function(){
                if(document.myScoreLine.startDate.value=="" || document.myScoreLine.endDate.value=="")
                    $("#error_show").text("请选择开始和终止择日期!");
                else if(document.myScoreLine.project.value=="all_project")
                    $("#error_show").text("请选择具体项目!");
                else if(document.myScoreLine.startDate.value>=document.myScoreLine.endDate.value)
                    $("#error_show").text("请规范选择开始和终止时间!");
                else {
                    $("#error_show").text("");
                    $("#table_name").text($("select[name='project'] option:selected").text());
                    $.post(document.myScoreLine.action,
                        {
                            form_name: document.myScoreLine.form_name.value,
                            startDate: document.myScoreLine.startDate.value,
                            endDate: document.myScoreLine.endDate.value,
                            project: document.myScoreLine.project.value
                        },
                        function (data) {
                            document.getElementById('myScoreDiv').innerHTML = data;
                            var dataList = {date: [], score: []};
                            for (var i = 0; ; i++) {
                                var date_input = document.getElementById('date' + i);
                                if (date_input == null)
                                    break;
                                else {
                                    dataList['date'][i] = date_input.name;
                                    dataList['score'][i] = parseInt(date_input.value);
                                }
                            }
                            var myChart = echarts.init(document.getElementById('showLine'));
                            option = {
                                xAxis: {
                                    type: 'category',
                                    boundaryGap: false,
                                    data: dataList['date']
                                },
                                yAxis: {
                                    type: 'value'
                                },
                                series: [{
                                    data: dataList['score'],
                                    type: 'line',
                                    areaStyle: {}
                                }]
                            };
                            myChart.setOption(option);
                        });
                }
            });
        });
    </script>
</head>
<body>
<?php include("usernav.php") ?>
<div style="position: relative;width:100%;text-align:center;font-size:large;margin-top: 4%">成长记录</div>
<div style="position: relative;margin-top: 4%;text-align: center">
    <?php
    include("../Service/ProjectService.php");
    //查询所有项目名称
    $result=ProjectService::selectAllProject();
    echo"<form class='form-inline' name='myScoreLine' action='../Web/UserController.php' method='post'>";
    echo "<input type='hidden' name='form_name' value='myScoreLine'/>";
    echo "<input class='form-control' type='date' name='startDate'/>";
    echo "<input class='form-control' type='date' name='endDate'/>";
    echo "<select class='form-control' name='project'><option value='all_project'>--项目--</option>";
    while ($row=mysql_fetch_array($result))
        echo "<option value='".$row['Project_Id']."'>".$row['Project_Name']."</option>";
    echo "</select>";
    echo "<button id='buttonSearch' class='btn btn-primary' type='button'>查询</button>";
    echo "</form>";
    ?>
</div>
<p id="error_show" style="color: red;width: 100%;text-align: center"></p>
<div id="myScoreDiv"></div>
<label id="table_name" style="position: relative;margin-top: 5%;width: 100%;text-align: center;font-size: large"></label>
<div id="showLine" style="width: 100%;height: 400px"></div>
</body>
</html>