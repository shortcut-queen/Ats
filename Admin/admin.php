<?php
session_start();
if(isset($_SESSION['admin_name']))
    header('location:manage.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="../static/css/bootstrap.min.css">
</head>
<body>
<div style="position: fixed; margin-top: 10%;margin-left: 60%; width:300px;height:250px;background-color: #46b8da; border-radius: 10px;">
    <label class="h4"style="background-color:#2e6da4;width: 100%;height:15%;margin-top: 0px;border-radius:10px 10px 0px 0px;padding-top: 10px;padding-left: 10px;">管理员登录</label cl>
    <form class="form-horizontal" style="width: 80%;height: 100%;margin-left: 10%;"  name="adminLogin" action="../Web/LoginController.php" method="post">
    <input class="form-control" type="hidden" name="form_name" value="adminLogin">
    <div class="form-group">
        <label>管理员</label>
        <input class="form-control" style="width: 90%;" placeholder="管理员姓名" type="text" name="admin_name"/>
    </div>
    <div class="form-group">
        <label>密&emsp;码</label>
        <input class="form-control" style="width: 90%;" placeholder="登陆密码" type="password" name="admin_password"/>
    </div>
        <p></p>
    <button class="btn btn-primary" style="margin-left: 30%;width: 30%;" type="submit">登录</button>
</form>
</div>
</body>
</html>