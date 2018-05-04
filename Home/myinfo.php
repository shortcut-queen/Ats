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
    <title>个人信息</title>
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <script src="../Static/js/bootstrap.min.js"></script>
    <script src="../Static/js/jquery-3.2.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $.post("../Web/UserController.php",
                {
                    form_name:"selectMyInfo"
                },
                function(data){
                    document.getElementById('myInfo').innerHTML=data;
                });
        });
    </script>
</head>
<body>
<?php include("usernav.php") ?>
<div style="position: relative;width:100%;text-align:center;font-size:large;margin-top: 4%">个人信息</div>
<div id="myInfo" style="position: relative;margin-top: 10%;">
</div>
</body>
</html>