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
    <form name="addRole" action="../Web/rolecontroller.php" method="post">
        等级<input type="text" name="role_rank"/>
        名称<input type="text" name="role_name"/>
        <button type="submit">添加</button>
    </form>
    添加用户
    <form name="adduser" action="../Web/usercontroller.php" method="post">
        姓名<input type="text" name="user_name"/>
        编号<input type="text" name="user_id"/>
        密码<input type="password" name = "user_password"/>
        旅<input type="text" name="brigade"/>
        营<input type="text" name="battalion"/>
        连<input type="text" name="continuous"/>
        排<input type="text" name="platoon"/>
        班<input type="text" name="monitor"/>
        战士<input type="text" name="warrior"/>
        是何首长<input type="text" name="officer"/>
        <button type="submit">添加</button>
    </form>
    添加项目
    <form name="addProject" action="../Web/projectcontroller.php" method="post">
        项目名称<input type="text" name="project_name"/>
        项目单位<input type="text" name="project_unit"/>
        优秀标准<input type="text" name="project_great"/>
        良好标准<input type="text" name="project_good"/>
        及格标准<input type="text" name="project_qualified"/>
        <button type="submit">添加</button>
    </form>
</div>
</body>
</html>