<?php
session_start();
if(isset($_SESSION['admin_name']))
    header('location:manage.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理员登陆</title>
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <script src="../Static/js/bootstrap.min.js"></script>
    <script src="../Static/js/jquery-3.2.1.js"></script>
</head>
<body style="background: url('../Static/images/bg.jpg');">
<?php
//显示提示信息
echo "<div style='position: relative;'>";
if(isset($_SESSION['success']))
    echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['success']."</div>";
if(isset($_SESSION['error']))
    echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['error']."</div>";
echo "</div>";
unset($_SESSION['success']);
unset($_SESSION['error']);
?>
<div style="position: fixed; margin-top: 10%;margin-left: 60%; width:300px;height:250px;background-color:rgba(70,184,218,0.6); border-radius: 10px;">
    <label class="h4"style="background-color:rgba(46,109,164,0.6);width: 100%;height:15%;margin-top: 0px;border-radius:10px 10px 0px 0px;padding-top: 10px;padding-left: 15px;">管理员登录
        <a href="../Home/index.php" style="float: right;margin-right: 10%;"><img src="../Static/images/user.png" style="width: 20px;height: 20px;"></a>
    </label>
    <form class="form-horizontal" style="width: 80%;height: 100%;margin-left: 10%;"  name="adminLogin" action="../Web/LoginController.php" method="post">
    <input class="form-control" type="hidden" name="form_name" value="adminLogin">
    <div class="form-group">
        <label>管理员</label>
        <input class="form-control" style="width: 97%;" placeholder="管理员姓名" type="text" name="admin_name"/>
    </div>
    <div class="form-group">
        <label>密&emsp;码</label>
        <input class="form-control" style="width: 97%;" placeholder="登陆密码" type="password" name="admin_password"/>
    </div>
        <p></p>
    <button class="btn btn-primary" style="margin-left: 30%;width: 30%;" type="submit">登录</button>
</form>
</div>
</body>
</html>