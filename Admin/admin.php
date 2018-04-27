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
</head>
<body>
<div>
    管理员登录
<form name="adminLogin" action="../Web/LoginController.php" method="post">
    <input type="hidden" name="form_name" value="adminLogin">
    名字<input type="text" name="admin_name"/>
    密码<input type="password" name="admin_password"/>
    <button type="submit">登录</button>
</form>
</div>
</body>
</html>