<?php
//未登录返回登陆页面
use Ats\Service\ProjectService;
session_start();
if(!isset($_SESSION['admin_name']))
    header('location:admin.php');

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
    echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['error']."</div>";
echo "</div>";
unset($_SESSION['success']);
unset($_SESSION['error']);

include ("../Service/ProjectService.php");
$project_id=$_GET['project_id'];
$result=ProjectService::selectProject($project_id);
$row=mysql_fetch_array($result);
?>
<div style="position: relative;margin-top: 8%;width:100%;">
    <form class="form-horizontal" style="width: 40%;margin-left: 30%;text-align: center;"  name="editProject" action="../Web/ProjectController.php" method="post">
        <label>编辑项目</label>
        <input type="hidden" name="form_name" value="editProject">
        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
        <div class="form-group">
            <label class="col-sm-2 control-label">项目名称</label>
            <div class="col-sm-10">
                <input class="form-control" value="<?php echo $row['Project_Name']; ?>" type="text" style="width;100%;" name="project_name"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">项目单位</label>
            <div class="col-sm-10">
                <input class="form-control" value="<?php echo $row['Project_Unit']; ?>" type="text" style="width;100%;" name="project_unit"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">优秀标准</label>
            <div class="col-sm-10">
                <input class="form-control" value="<?php echo $row['Project_Great']; ?>" type="text" style="width;100%;" name="project_great"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">良好标准</label>
            <div class="col-sm-10">
                <input class="form-control" value="<?php echo $row['Project_Good']; ?>" type="text" style="width;100%;" name="project_good"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">及格标准</label>
            <div class="col-sm-10">
                <input class="form-control" value="<?php echo $row['Project_Qualified']; ?>" type="text" style="width;100%;" name="project_qualified"/>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">修改</button>
    </form>
</div>
</body>
</html>