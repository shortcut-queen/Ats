<?php
//未登录返回登陆页面
session_start();
if(!isset($_SESSION['admin_name']))
    header('location:index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理员:<?php echo $_SESSION['admin_name']; ?></title>
    <script src="../Static/js/jquery-3.2.1.js"></script>
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <script src="../Static/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#buttonUpdate").click(function(){
                if($("#newPassword").val()!=$("#renewPassword").val())
                    $("#error_show").text("两次密码不一致");
                else {
                    $("#error_show").text("");
                    $.post(document.updateAdminPassword.action,
                        {
                            form_name: document.updateAdminPassword.form_name.value,
                            old_password: document.updateAdminPassword.old_password.value,
                            new_password: document.updateAdminPassword.new_password.value
                        },
                        function (data) {
                            window.location.reload(true);
                            //document.getElementById("error_show").innerHTML=data;
                        });
                }
            });
        });
    </script>
</head>
<body>
<?php include("adminnav.php") ?>
<?php
//显示提示信息
echo "<div style='position: relative;margin-top: 3.5%;'>";
if(isset($_SESSION['success']))
    echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['success']."</div>";
if(isset($_SESSION['error']))
    echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['error']."</div>";
echo "</div>";
unset($_SESSION['success']);
unset($_SESSION['error']);
?>
<div style="position: relative;width:100%;margin-top: 5%;">
    <form class="form-horizontal" name="updateAdminPassword" style="text-align:center;width:40%;margin-left: 30%;" action="../Web/AdminController.php" method="post">
        <input type="hidden" name="form_name" value="updateAdminPassword"/>
        <div class="form-group">
            <label class="col-sm-2 control-label">旧密码</label>
            <div class="col-sm-10">
                <input id="oldPassword" class="form-control" style="width: 100%" type="password" name="old_password"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">新密码</label>
            <div class="col-sm-10">
                <input id="newPassword" class="form-control" style="width: 100%" type="password" name="new_password"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">确认密码</label>
            <div class="col-sm-10">
                <input id="renewPassword" class="form-control" style="width: 100%" type="password" name="renew_password"/>
            </div>
        </div>
        <p style="color: red" id="error_show"></p>
        <button id="buttonUpdate" class="btn btn-primary" type="button">修改</button>
    </form>
</div>
</body>
</html>