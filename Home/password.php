<?php
//未登录返回登陆页面
session_start();
if(!isset($_SESSION['user_id']))
    header('location:index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改密码</title>
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
                    $.post(document.updateUserPassword.action,
                        {
                            form_name: document.updateUserPassword.form_name.value,
                            old_password: document.updateUserPassword.old_password.value,
                            new_password: document.updateUserPassword.new_password.value
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
<?php include("usernav.php") ?>
<?php
//显示提示信息
echo "<div style='position: relative;margin-top: 4%;'>";
if(isset($_SESSION['success']))
    echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['success']."</div>";
if(isset($_SESSION['error']))
    echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['error']."</div>";
echo "</div>";
unset($_SESSION['success']);
unset($_SESSION['error']);
?>
<div style="position: relative;width:100%;text-align:center;font-size:large;margin-top: 4%">修改密码</div>
<div style="position: relative;width:100%;margin-top: 4%;">
<form class="form-horizontal" name="updateUserPassword" style="text-align:center;width:40%;margin-left: 30%;" action="../Web/UserController.php" method="post">
    <input type="hidden" name="form_name" value="updateUserPassword"/>
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