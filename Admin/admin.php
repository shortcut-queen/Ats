<?php
session_start();
if(isset($_SESSION['admin_id']))
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
<form name="adminLogin" action="../Web/logincontroller.php" method="post">
    编号<input type="text" name="admin_id"/>
    密码<input type="password" name="admin_password"/>
    <button type="submit">登录</button>
</form>
</div>
</body>
</html>