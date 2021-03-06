<?php
//未登录返回登陆页面
use Ats\Service\AdminService;
session_start();
if(!isset($_SESSION['admin_name']))
    header('location:index.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改项目</title>
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

include ("../Service/AdminService.php");
$project_id=$_GET['project_id'];
$user_id=$_GET['user_id'];
$date=$_GET['date'];
$row=AdminService::selectScore($project_id,$user_id,$date);
?>
<div style="position: relative;margin-top: 8%;width:100%;">
    <form class="form-horizontal" style="width: 40%;margin-left: 30%;text-align: center;"  name="editScore" action="../Web/AdminController.php" method="post">
        <label>修改成绩</label>
        <input type="hidden" name="form_name" value="editScore">
        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
        <div class="form-group">
            <label class="col-sm-2 control-label">用户ID</label>
            <div class="col-sm-10">
                <input class="form-control" readonly="readonly" value="<?php echo $row['User_Id']; ?>" type="text" style="width;100%;" name="user_id"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">
                <input class="form-control" readonly="readonly" value="<?php echo $row['User_Name']; ?>" type="text" style="width;100%;" name="user_name"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">项目名称</label>
            <div class="col-sm-10">
                <input class="form-control" readonly="readonly" value="<?php echo $row['Project_Name']; ?>" type="text" style="width;100%;" name="project_name"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">项目单位</label>
            <div class="col-sm-10">
                <input class="form-control" readonly="readonly" value="<?php echo $row['Project_Unit']; ?>" type="text" style="width;100%;" name="project_unit"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">训练时间</label>
            <div class="col-sm-10">
                <input class="form-control" readonly="readonly" value="<?php echo $date; ?>" type="text" style="width;100%;" name="date"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">成绩</label>
            <div class="col-sm-10">
                <input class="form-control" value="<?php echo $row['Train_Score']; ?>" type="text" style="width;100%;" name="train_score"/>
            </div>
        </div>
        <button class="btn btn-success" type="button" onclick="javascript:history.go(-1)">返回</button>
        <button class="btn btn-primary"style="margin-left: 25%;" type="submit">修改</button>
    </form>
</div>
</body>
</html>