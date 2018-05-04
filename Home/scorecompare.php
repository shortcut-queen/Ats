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
    <title>成绩对比</title>
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <script src="../Static/js/bootstrap.min.js"></script>
    <script src="../Static/js/jquery-3.2.1.js"></script>
    <script src="../Static/js/echarts.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#buttonSearch").click(function(){
                $.post(document.scoreCompare.action,
                    {
                        form_name:document.scoreCompare.form_name.value,
                        date:document.scoreCompare.date.value,
                        battalion:document.scoreCompare.battalion.value,
                        continuous:document.scoreCompare.continuous.value,
                        platoon:document.scoreCompare.platoon.value,
                        monitor:document.scoreCompare.monitor.value,
                        project:document.scoreCompare.project.value
                    },
                    function(data){
                        var project_value=document.scoreCompare.project.value;
                        if(project_value!="all_project")
                            document.getElementById('table_name').innerHTML=$("select[name='project'] option:selected").text();
                        document.getElementById('scoreDiv').innerHTML=data;
                        for(var i=1;i<4;i++) {
                            if(document.getElementById("canvas_"+i)==null)
                                continue;
                            var myChart = echarts.init(document.getElementById('canvas_show_'+i));
                            option = {
                                title: {
                                    text: '训练情况',
                                    x: 'center'
                                },
                                tooltip: {
                                    trigger: 'item',
                                    formatter: "{b} : {c} ({d}%)"
                                },
                                legend: {
                                    bottom:10,
                                    left: 'center',
                                    data: ['优秀', '良好', '及格','不及格']
                                },
                                series: [
                                    {
                                        type: 'pie',
                                        radius: '60%',
                                        center: ['50%', '50%'],
                                        selectedMode:'single',
                                        data: [
                                            {value: parseInt(document.getElementById('great'+i).value), name: '优秀'},
                                            {value: parseInt(document.getElementById('good'+i).value), name: '良好'},
                                            {value: parseInt(document.getElementById('qualified'+i).value), name: '及格'},
                                            {value: parseInt(document.getElementById('out'+i).value), name: '不及格'}
                                        ],
                                        itemStyle: {
                                            emphasis: {
                                                shadowBlur: 10,
                                                shadowOffsetX: 0,
                                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                                            }
                                        }
                                    }
                                ]
                            };
                            myChart.setOption(option);
                        }
                    });
            });
        });
    </script>
</head>
<body>
<?php include("usernav.php") ?>
<div style="position: relative;width:100%;text-align:center;font-size:large;margin-top: 4%">成绩对比</div>
<div style="position: relative;margin-top: 4%;text-align: center">
    <?php
    $rank=intval($_SESSION['officer']);
    if($rank==0)
        echo "个人成绩";
    if($rank==5)
        echo "班级成绩";
    $option_names=array(
        array('battalion','营级','一营','二营','三营')
    ,array('continuous','连级','一连','二连','三连')
    ,array('platoon','排级','一排','二排','三排')
    ,array('monitor','班级','一班','二班','三班'));
    if($rank>0 && $rank<5) {
        //查询所有项目名称
        $result=ProjectService::selectAllProject();
        echo"<form class='form-inline' name='scoreCompare' action='../Web/UserController.php' method='post'>";
        echo "<input type='hidden' name='form_name' value='scoreCompare'/>";
        echo "<input class='form-control' type='date' name='date'/>";
        for($j=0;$j<$rank-1;$j++)
            echo "<input type='hidden' name=".$option_names[$j][0]." value=''/>";
        for ($i = $rank - 1; $i < 4; $i += 1)
            echo "<select class='form-control' name=".$option_names[$i][0]."><option value=''>--".$option_names[$i][1]."--</option><option value=''>全部</option><option value='1'>".$option_names[$i][2]."</option><option value='2'>".$option_names[$i][3]."</option><option value='3'>".$option_names[$i][4]."</option></select>";
        echo "<select class='form-control' name='project'><option value='all_project'>--项目--</option>";
        while ($row=mysql_fetch_array($result))
            echo "<option value='".$row['Project_Id']."'>".$row['Project_Name']."</option>";
        echo "</select>";
        echo "<button id='buttonSearch' class='btn btn-primary' type='button'>查询</button>";
        echo "</form>";
    }
    ?>
</div>
<label id="table_name" style="position: relative;margin-top: 5%;width: 100%;text-align: center;font-size: large"></label>
<div id="scoreDiv" style="width: 95%;padding-left: 5%;margin-top: 3%;"></div>
</body>
</html>