<?php
//未登录返回登陆页面
session_start();
if(!isset($_SESSION['user_id']))
    header('location:index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>资源库</title>
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <script src="../Static/js/bootstrap.min.js"></script>
    <script src="../Static/js/jquery-3.2.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#all").click(function () {
                $("#text").removeClass("bgcolor-gray");
                $("#image").removeClass("bgcolor-gray");
                $("#video").removeClass("bgcolor-gray");
                $("#all").addClass("bgcolor-gray");
                $.post("../Web/ResourceController.php",
                    {
                        form_name:"allResource",
                        request_type:"user"
                    },
                    function(data){
                        document.getElementById('allResource').innerHTML=data;
                    });
            });
            $("#text").click(function () {
                $("#all").removeClass("bgcolor-gray");
                $("#image").removeClass("bgcolor-gray");
                $("#video").removeClass("bgcolor-gray");
                $("#text").addClass("bgcolor-gray");
                $.post("../Web/ResourceController.php",
                    {
                        form_name:"searchAllResource",
                        resource_type:1,
                        request_type:"user"
                    },
                    function(data){
                        document.getElementById('allResource').innerHTML=data;
                    });
            });
            $("#image").click(function () {
                $("#all").removeClass("bgcolor-gray");
                $("#video").removeClass("bgcolor-gray");
                $("#text").removeClass("bgcolor-gray");
                $("#image").addClass("bgcolor-gray");
                $.post("../Web/ResourceController.php",
                    {
                        form_name:"searchAllResource",
                        resource_type:2,
                        request_type:"user"
                    },
                    function(data){
                        document.getElementById('allResource').innerHTML=data;
                    });
            });
            $("#video").click(function () {
                $("#all").removeClass("bgcolor-gray");
                $("#text").removeClass("bgcolor-gray");
                $("#image").removeClass("bgcolor-gray");
                $("#video").addClass("bgcolor-gray");
                $.post("../Web/ResourceController.php",
                    {
                        form_name:"searchAllResource",
                        resource_type:3,
                        request_type:"user"
                    },
                    function(data){
                        document.getElementById('allResource').innerHTML=data;
                    });
            });
            $.post("../Web/ResourceController.php",
                {
                    form_name:"allResource",
                    request_type:"user"
                },
                function(data){
                    document.getElementById('allResource').innerHTML=data;
                });
        });
    </script>
    <style type="text/css">
        .bgcolor-gray{background-color:#e7e7e7}
        .bgcolor-blue{background-color:#46b8da}
    </style>
</head>
<body>
<?php include("usernav.php") ?>

<?php
//显示提示信息
echo "<div style='position: relative;margin-top: 3.5%'>";
if(isset($_SESSION['success']))
    echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['success']."</div>";
if(isset($_SESSION['error']))
    echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['error']."</div>";
echo "</div>";
unset($_SESSION['success']);
unset($_SESSION['error']);
?>
<div id="type_choose" style="line-height: 50px;margin-left:10%;margin-top:10%;width:80%;height:50px;background-color: #46b8da;padding-left: 2%;">
    <ul class="nav navbar-nav">
        <li>
            <a  id="all" style="font-size: 18px;text-decoration: none;color: #777777;" class="bgcolor-gray" role="button">全部</a>
        </li>
        <li>
            <a  id="text" style="font-size: 18px;margin-left: 2%;text-decoration: none;color: #777777;" role="button">文档</a>
        </li>
        <li>
            <a  id="image" style="font-size: 18px;margin-left: 2%;text-decoration: none;color: #777777;" role="button">图片</a>
        </li>
        <li>
            <a id="video" style="font-size: 18px;margin-left: 2%;text-decoration: none;color: #777777;" role="button">视频</a>
        </li>
    </ul>
</div>
<div id="allResource">

</div>
</body>
</html>