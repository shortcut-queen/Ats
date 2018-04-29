<?php
session_start();
if(isset($_SESSION['user_id']))
    header('location:user.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <script src="../Static/js/bootstrap.min.js"></script>
    <script src="../Static/js/jquery-3.2.1.js"></script>
</head>
<body>
<div style="position: fixed; margin-top: 10%;margin-left: 60%; width:300px;height:250px;background-color: #46b8da; border-radius: 10px;">
    <label class="h4"style="background-color:#2e6da4;width: 100%;height:15%;margin-top: 0px;border-radius:10px 10px 0px 0px;padding-top: 10px;padding-left: 10px;">用户登录</label cl>
    <form class="form-horizontal" style="width: 80%;height: 100%;margin-left: 10%;"  name="userLogin" action="../Web/LoginController.php" method="post">
        <input class="form-control" type="hidden" name="form_name" value="userLogin">
        <div class="form-group">
            <label>用户ID</label>
            <input class="form-control" style="width: 90%;" placeholder="用户ID" type="text" name="user_id"/>
        </div>
        <div class="form-group">
            <label>密&emsp;码</label>
            <input class="form-control" style="width: 90%;" placeholder="登录密码" type="password" name="user_password"/>
        </div>
        <p id="error_show"></p>
        <button class="btn btn-primary" style="margin-left: 30%;width: 30%;" type="submit">登录</button>
    </form>
</div>
</body>
</html>