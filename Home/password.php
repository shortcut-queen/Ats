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
<div style="position: relative;width:100%;margin-top: 4%;">
<form class="form-horizontal" name="updatePassword" style="text-align:center;width:40%;margin-left: 30%;" action="../Web/UserController.php" method="post">
    <input type="hidden" name="form_name" value="updatePassword"/>
    <div class="form-group">
        <label class="col-sm-2 control-label">旧密码</label>
        <div class="col-sm-10">
            <input class="form-control" style="width: 100%" type="password" name="old_password"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">新密码</label>
        <div class="col-sm-10">
            <input class="form-control" style="width: 100%" type="password" name="new_password"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">确认密码</label>
        <div class="col-sm-10">
            <input class="form-control" style="width: 100%" type="password" name="renew_password"/>
        </div>
    </div>
    <p id="error_show"></p>
    <button class="btn btn-primary" type="submit">修改</button>
</form>
</div>
</body>
</html>