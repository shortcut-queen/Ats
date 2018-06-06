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
    echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['error']."</div>";
echo "</div>";
unset($_SESSION['success']);
unset($_SESSION['error']);
?>
<div style="position: relative;margin-top: 8%;width:100%;">
    <form class="form-horizontal" enctype="multipart/form-data" style="width: 40%;margin-left: 30%;text-align: center;"  name="importScore" action="../Web/AdminController.php" method="post">
        <label>导入成绩</label>
        <input type="hidden" name="form_name" value="importScore">
        <div class="form-group">
            <label class="col-sm-2 control-label">选择文件</label>
            <div class="col-sm-10">
                <input type="file" class="file-loading" name="score_file"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">导入说明</label>
            <div class="col-sm-10">
                <textarea class="form-control" disabled="disabled" wrap="soft">支持文件类型：*.xls,*.xlsx
表格格式：列名顺序为(用户ID,用户名,训练日期,项目名称,训练成绩)</textarea>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">导入</button>
    </form>
</div>
</body>
</html>