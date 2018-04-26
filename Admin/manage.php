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
    <form name="addProject" action="../Web/projectcontroller.php" method="post">
        项目名称<input type="text" name="project_name"/>
        项目单位<input type="text" name="project_unit"/>
        优秀标准<input type="text" name="project_great"/>
        良好标准<input type="text" name="project_good"/>
        及格标准<input type="text" name="project_qualified"/>

</div>
</body>
</html>