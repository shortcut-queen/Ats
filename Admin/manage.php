<?php
session_start();
if(isset($_SESSION['admin_name']))
    echo '管理员:'.$_SESSION['admin_name'].'登录成功';
//未登录返回登陆页面
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
    <script type="text/javascript">
        function check() {
            var value=document.adduser.brigade.value;
            if(value>3)
                document.getElementById('div_brigade').innerHTML='不能超过3'
        }
    </script>
</head>
<body>
<div>
    增加管理员
    <form name="addAdmin" action="../Web/AdminController.php" method="post">
        <input type="hidden" name="form_name" value="addAdmin">
        姓名<input type="text" name="admin_name"/>
        <button type="submit">添加</button>
    </form>
    添加用户
    <form name="addUser" action="../Web/UserController.php" method="post">
        <input type="hidden" name="form_name" value="addUser">
        姓名<input type="text" name="user_name"/>
        编号<input type="text" name="user_id"/>
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
    <form name="addProject" action="../Web/ProjectController.php" method="post">
        <input type="hidden" name="form_name" value="addProject">
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