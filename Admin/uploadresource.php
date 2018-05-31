<?php
//未登录返回登陆页面
session_start();
if(!isset($_SESSION['admin_name']))
    header('location:admin.php');

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

<?php
//显示提示信息
echo "<div style='position: relative;margin-top: 3.5%;'>";
if(isset($_SESSION['success']))
    echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['success']."</div>";
if(isset($_SESSION['error']))
    echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['error']."</div>";
echo "</div>";
unset($_SESSION['success']);
unset($_SESSION['error']);
?>
<div style="position: relative;margin-top: 8%;width:100%;">
    <form class="form-horizontal" enctype="multipart/form-data" style="width: 40%;margin-left: 30%;text-align: center;"  name="upLoadResource" action="../Web/ResourceController.php" method="post">
        <label>上传资源</label>
        <input type="hidden" name="form_name" value="upLoadResource">
        <div class="form-group">
            <label class="col-sm-2 control-label">资源名称</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" style="width;100%;" name="resource_name"/>
            </div>
        </div>
        <div class="form-group">
            <label style="float:left;width:16.667%;padding:0 2.5% 0 2.5%;text-align:right;margin-top: 1%">选择文件</label>
            <div style="width: 83%;height: 100%;float: left">
                <input  type="file" style="width;30%;float: left;margin-left:3.5%;margin-top:1%;" name="resource_file"/>
                <select class="form-control" style="margin-left:16%;width: 30%;float: left" name="resource_type">
                    <option>--资源类型--</option>
                    <option>文档</option>
                    <option>图片</option>
                    <option>视频</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">资源说明</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" style="width;100%;" name="resource_about"/>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">上传</button>
    </form>
</div>
</body>
</html>