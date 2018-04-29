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
<?php include("adminnav.php");?>

<?php
//显示提示信息
echo "<div style='position: relative;top: 10%;'>";
if(isset($_SESSION['success']))
    echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['success']."</div>";
if(isset($_SESSION['errror']))
    echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['error']."</div>";
echo "</div>";
unset($_SESSION['success']);
unset($_SESSION['error']);
?>
<div style="position: relative;margin-top: 8%;width:100%;">
    <form class="form-horizontal" style="width: 40%;margin-left: 30%;text-align: center;" name="addUser" action="../Web/UserController.php" method="post">
        <label>增加用户</label>
        <input type="hidden" name="form_name" value="addUser">
        <div class="form-group">
            <label class="col-sm-2 control-label">姓名</label>
            <div class="col-sm-10">
                <input class="form-control" style="width;100%;" type="text" name="user_name"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">编号</label>
            <div class="col-sm-10">
                <input class="form-control" style="width;100%;" type="text" name="user_id"/>
            </div>
        </div>
        <div class="form-inline" style="width: 100%;margin-left: 3%;">
        <select class="form-control" name="brigade">
            <option>旅级</option>
            <option>一旅</option>
            <option>一旅</option>
            <option>一旅</option>
        </select>
        <select class="form-control" name="battalion">
            <option>营级</option>
            <option>一营</option>
            <option>一营</option>
            <option>一营</option>
        </select>
        <select class="form-control" name="continuous">
            <option>连级</option>
            <option>一连</option>
            <option>一连</option>
            <option>一连</option>
        </select>
        <select class="form-control" name="platoon">
            <option>排级</option>
            <option>一排</option>
            <option>一排</option>
            <option>一排</option>
        </select>
        <select class="form-control" name="monitor">
            <option>班级</option>
            <option>一班</option>
            <option>一班</option>
            <option>一班</option>
        </select>
        <select class="form-control" name="officer">
            <option value="">军阶</option>
            <option value="1">旅长</option>
            <option value="2">营长</option>
            <option value="3">连长</option>
            <option value="4">排长</option>
            <option value="5">班长</option>
            <option value="0">战士</option>
        </select>
        </div>
        <p id="error_show"></p>
        <button class="btn btn-primary" style="margin-top: 8%" type="submit">添加</button>
    </form>
</div>
</body>
</html>