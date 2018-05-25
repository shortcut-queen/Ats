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
                var army_array=new Array(document.scoreTermSearch.startDate.value,document.scoreTermSearch.endDate.value,document.scoreTermSearch.battalion.value,document.scoreTermSearch.continuous.value,document.scoreTermSearch.platoon.value,document.scoreTermSearch.monitor.value,document.scoreTermSearch.project.value);
                if(army_array[0]=="" || army_array[1]=="")
                    $("#error_show").text("请选择开始和结束日期");
                else if(army_array[0]>=army_array[1])
                    $("#error_show").text("请规范选择开始和结束日期");
                else if(army_array[6]=="all_project")
                    $("#error_show").text("请选择项目");
                else {
                    var i = 2;
                    var flag = 1;
                    for (i; i < 6; i++)
                        if (army_array[i] == "")
                            break;
                    for (i++; i < 6; i++) {
                        if (army_array[i] != "") {
                            flag = 0;
                            break;
                        }
                    }
                    if (flag == 0) {
                        $("#error_show").text("请规范选择部队");
                    } else {
                        $("#error_show").text("");
                        $("#table_name").text($("select[name='project'] option:selected").text());
                        $.post(document.scoreTermSearch.action,
                            {
                                form_name: document.scoreTermSearch.form_name.value,
                                startDate: document.scoreTermSearch.startDate.value,
                                endDate: document.scoreTermSearch.endDate.value,
                                battalion: document.scoreTermSearch.battalion.value,
                                continuous: document.scoreTermSearch.continuous.value,
                                platoon: document.scoreTermSearch.platoon.value,
                                monitor: document.scoreTermSearch.monitor.value,
                                project: document.scoreTermSearch.project.value
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
                }
            });
        });
    </script>
</head>
<body>
<?php include("usernav.php") ?>
<div style="position: relative;width:100%;text-align:center;font-size:large;margin-top: 4%">折线分析</div>
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
        include("../Service/ProjectService.php");
        $result=ProjectService::selectAllProject();
        echo"<form class='form-inline' name='scoreTermSearch' action='../Web/UserController.php' method='post'>";
        echo "<input type='hidden' name='form_name' value='scoreTermSearch'/>";
        echo "<input class='form-control' type='date' name='startDate'/>";
        echo "<input class='form-control' type='date' name='endDate'/>";
        for($j=0;$j<$rank-1;$j++)
            echo "<input type='hidden' name=".$option_names[$j][0]." value='0'/>";
        for ($i = $rank - 1; $i < 4; $i += 1)
            echo "<select class='form-control' name=".$option_names[$i][0]."><option value=''>--".$option_names[$i][1]."--</option><option value='1'>".$option_names[$i][2]."</option><option value='2'>".$option_names[$i][3]."</option><option value='3'>".$option_names[$i][4]."</option></select>";
        echo "<select class='form-control' name='project'><option value='all_project'>--项目--</option>";
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
<div id="myScoreDiv"></div>
<div id="showLine" style="width: 100%;height: 400px"></div>
</body>
</html>