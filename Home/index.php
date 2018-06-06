<?php
session_start();
if(isset($_SESSION['user_id']))
    header('location:user.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户登录</title>
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <script src="../Static/js/bootstrap.min.js"></script>
    <script src="../Static/js/jquery-3.2.1.js"></script>
</head>
<body style="background:url('../Static/images/bg1.jpg');background-size: cover;">
<?php
//显示提示信息
echo "<div style='position: relative;'>";
if(isset($_SESSION['success']))
    echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['success']."</div>";
if(isset($_SESSION['error']))
    echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['error']."</div>";
echo "</div>";
unset($_SESSION['success']);
unset($_SESSION['error']);
?>
<div style="width:100%;text-align:center;margin-top:3%;color:white;font-family:楷体;position:absolute;font-size: 32px;">军校训练系统</div>
<div style="position: fixed; margin-top: 10%;margin-left: 60%; width:300px;height:250px;background-color:rgba(70,184,218,0.5); border-radius: 10px;">
    <label class="h4"style="background-color:rgba(46,109,164,0.5);width: 100%;height:15%;margin-top: 0px;border-radius:10px 10px 0px 0px;padding-top: 10px;padding-left: 15px;">用户登录
    <a href="../Admin/index.php" style="float: right;margin-right: 10%;"><img src="../Static/images/administrator.png" style="width: 20px;height: 20px;"></a>
    </label>
    <form class="form-horizontal" style="width: 80%;height: 100%;margin-left: 10%;"  name="userLogin" action="../Web/LoginController.php" method="post">
        <input class="form-control" type="hidden" name="form_name" value="userLogin">
        <div class="form-group">
            <label>用户ID</label>
            <input class="form-control" style="width: 97%;" placeholder="用户ID" type="text" name="user_id"/>
        </div>
        <div class="form-group">
            <label>密&emsp;码</label>
            <input class="form-control" style="width: 97%;" placeholder="登录密码" type="password" name="user_password"/>
        </div>
        <p id="error_show"></p>
        <button class="btn btn-primary" style="margin-left: 30%;width: 30%;" type="submit">登录</button>
    </form>
</div>
</body>
</html>