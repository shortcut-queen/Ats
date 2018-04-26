<?php
session_start();
if(isset($_SESSION['admin_id']))
    echo '管理员:'.$_SESSION['admin_id'].'登录成功';
else
    header('location:admin.php');
if(isset($_SESSION['success']))
    echo $_SESSION['success'];
elseif (isset($_SESSION['error']))
    echo $_SESSION['error'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<div>
    增加角色
    <form name="adminLogin" action="../Web/rolecontroller.php" method="post">
        等级<input type="text" name="role_rank"/>
        名称<input type="password" name="role_name"/>
        <button type="submit">添加</button>
    </form>
</div>
</body>
</html>