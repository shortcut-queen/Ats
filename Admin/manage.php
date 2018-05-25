<?php
//未登录返回登陆页面
session_start();
if(!isset($_SESSION['admin_name']))
    header('location:admin.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>龙虎榜</title>
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <script src="../Static/js/bootstrap.min.js"></script>
    <script src="../Static/js/jquery-3.2.1.js"></script>
    <script>
        $(document).ready(function () {
            $.post("../Web/AdminController.php",
                {
                    form_name:'topList'
                },
                function (data) {
                    document.getElementById('topList').innerHTML=data;
                }
            );
        });
    </script>
</head>
<body>
<?php include("adminnav.php") ?>
<div style="position: relative;width:100%;text-align:center;font-size:large;margin-top: 4%">龙虎榜</div>
<div id="topList" style="position: relative;margin-top: 8%;width:100%;">

</div>
</body>
</html>