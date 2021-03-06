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
            $("#buttonQuery").click(function(){
                if(document.queryUser.query_info.value==""){
                    $("#error_show").text("请输入关键字");
                }else {
                    $("#error_show").text("");
                    $.post(document.queryUser.action,
                        {
                            form_name: document.queryUser.form_name.value,
                            query_info: document.queryUser.query_info.value
                        },
                        function (data) {
                            document.getElementById("userDiv").innerHTML = data;
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
<div style="position: relative;margin-top: 8%;text-align: center">
    <form class="form-inline" name="queryUser" style="text-align:center;width:60%;margin-left: 20%;" action="../Web/AdminController.php" method="post">
        <input type="hidden" name="form_name" value="queryUser"/>
        <div class="form-group">
                <input id="query_info" class="form-control" placeholder="输入：用户名/编号" style="width: 100%" type="text" name="query_info"/>
        </div>
        <button id="buttonQuery" class="btn btn-primary" type="button">查询</button>
    </form>
</div>
<p id="error_show" style="color: red;width: 100%;text-align: center"></p>
<div id="userDiv" ></div>
</body>
</html>