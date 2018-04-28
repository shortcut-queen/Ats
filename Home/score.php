<?php
//未登录返回登陆页面
session_start();
if(!isset($_SESSION['user_id']))
    header('location:index.php');
if(isset($_SESSION['success']))
    echo $_SESSION['success'];
elseif (isset($_SESSION['error']))
    echo $_SESSION['error'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户:<?php echo $_SESSION['user_name']; ?></title>
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <script src="../Static/js/bootstrap.min.js"></script>
    <script src="../Static/js/jquery-3.2.1.js"></script>
</head>
<body>
<?php include("usernav.php") ?>
//查询成绩
<div style="position: relative;margin-top: 5%;text-align: center">
<form class="form-horizontal" name="scoreSearch" action="../Web/UserController.php" method="post">
    <input type="hidden" name="form_name" value="scoreSearch"/>
    <input type="text" name = "date"/>
    <select name="brigade">
        <option value="">--旅级--</option>
        <option value="">全部</option>
        <option value="1">一旅</option>
        <option value="2">二旅</option>
        <option value="3">三旅</option>
    </select>
    <select name="battalion">
        <option value="">--营级--</option>
        <option value="">全部</option>
        <option value="1">一营</option>
        <option value="2">二营</option>
        <option value="3">三营</option>
    </select>
    <select name="continuous">
        <option value="">--连级--</option>
        <option value="">全部</option>
        <option value="1">一连</option>
        <option value="2">二连</option>
        <option value="3">三连</option>
    </select>
    <select name="platoon">
        <option value="">--排级--</option>
        <option value="">全部</option>
        <option value="1">一排</option>
        <option value="2">二排</option>
        <option value="3">三排</option>
    </select>
    <select name="monitor">
        <option value="">--班级--</option>
        <option value="">全部</option>
        <option value="1">一班</option>
        <option value="2">二班</option>
        <option value="3">三班</option>
    </select>
    <select name="project">
        <option value="all_project">--项目--</option>
        <option value="all_project">全部</option>
        <option value="project_5000m">5000m</option>
        <option value="project_1000m">1000m</option>
        <option value="project_3000m">3000m</option>
    </select>
    <button type="submit">查询</button>
</form>
</div>
</body>
</html>