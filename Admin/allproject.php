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
    <script type="text/javascript">
        $(document).ready(function(){
            $.post("../Web/ProjectController.php",
                {
                    form_name:"searchAllProject"
                },
                function(data){
                    document.getElementById('allProject').innerHTML=data;
                });
        });
    </script>
</head>
<body>
<?php include("adminnav.php") ?>

<?php
//显示提示信息
echo "<div style='position: relative;margin-top: 3.5%'>";
if(isset($_SESSION['success']))
    echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['success']."</div>";
if(isset($_SESSION['error']))
    echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['error']."</div>";
echo "</div>";
unset($_SESSION['success']);
unset($_SESSION['error']);
?>
<div id="allProject" style="margin-top: 10%">

</div>
</body>
</html>