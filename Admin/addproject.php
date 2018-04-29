<?php
//未登录返回登陆页面
session_start();
if(!isset($_SESSION['admin_name']))
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
    <title>管理员:<?php echo $_SESSION['admin_name'];?></title>
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <script src="../Static/js/bootstrap.min.js"></script>
    <script src="../Static/js/jquery-3.2.1.js"></script>
</head>
<body>
<?php include("adminnav.php") ?>
<div>

    <form name="addProject" action="../Web/ProjectController.php" method="post">
        添加项目
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