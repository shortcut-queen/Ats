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
        $(document).ready(function () {
            $("#select_rank").change(function () {
                var army_array=new Array("brigade","battalion","continuous","platoon","monitor");
                var i=$('#select_rank').val();
                if(i!=0)
                    for(i;i<5;i++)
                        $("#"+army_array[i]).val(0);
            });
            $("#buttonAddUser").click(function() {
                var army_array=new Array(document.addUser.user_name.value, document.addUser.user_id.value, document.addUser.brigade.value, document.addUser.battalion.value, document.addUser.continuous.value, document.addUser.platoon.value, document.addUser.monitor.value, document.addUser.officer.value);
                if(army_array[0]==""){
                    $("#error_show").text("姓名不可以为空！");
                    return false;
                }else if(army_array[1]==""){
                    $("#error_show").text("编号不可以为空！");
                    return false;
                }else if(army_array[7]==""){
                    $("#error_show").text("请选择军阶！");
                    return false;
                }else if(army_array[7]==0 && (army_array[2]==0 ||army_array[3]==0 || army_array[4]==0 || army_array[5]==0 || army_array[6]==0)){
                    $("#error_show").text("请选择战士所属部队！");
                    return false;
                }else if(army_array[7]==0 && army_array[2]!=0 && army_array[3]!=0 && army_array[4]!=0 && army_array[5]!=0 && army_array[6]!=0)
                    return true;
                else{
                    for(var i=2;i<7;i++){
                        if(i<=parseInt(army_array1[7])+1&&parseInt(army_array[i])==0){
                            $("#error_show").text("请选择长官所属部队！");
                            return false;
                        }
                        if(i>parseInt(army_array[7])+1&&parseInt(army_array[i])!=0){
                            $("#error_show").text("请不要选择长官以下的部队！");
                            return false;
                        }
                    }
                    return true;
                }
            });
        });
    </script>
</head>
<body>
<?php include("adminnav.php");?>

<?php
//显示提示信息
echo "<div style='position: relative;margin-top: 3.5%'>";
if(isset($_SESSION['success']))
    echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['success']."</div>";
if(isset($_SESSION['error']))
    echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$_SESSION['error']."</div>";
echo "</div>";
unset($_SESSION['success']);
unset($_SESSION['error']);
?>
<div style="position: relative;margin-top: 8%;width:100%;">
    <form class="form-horizontal" style="width: 40%;margin-left: 30%;text-align: center;" name="addUser" onsubmit="return check_form(this)" action="../Web/AdminController.php" method="post">
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
        <select id="brigade" class="form-control" name="brigade">
            <option value="0">旅级</option>
            <option value="1">一旅</option>
            <option value="2">二旅</option>
            <option value="3">三旅</option>
        </select>
        <select id="battalion" class="form-control" name="battalion">
            <option value="0">营级</option>
            <option value="1">一营</option>
            <option value="2">二营</option>
            <option value="3">三营</option>
        </select>
        <select id="continuous" class="form-control" name="continuous">
            <option value="0">连级</option>
            <option value="1">一连</option>
            <option value="2">二连</option>
            <option value="3">三连</option>
        </select>
        <select id="platoon" class="form-control" name="platoon">
            <option value="0">排级</option>
            <option value="1">一排</option>
            <option value="2">二排</option>
            <option value="3">三排</option>
        </select>
        <select id="monitor" class="form-control" name="monitor">
            <option value="0">班级</option>
            <option value="1">一班</option>
            <option value="2">二班</option>
            <option value="3">三班</option>
        </select>
        <select id="select_rank" class="form-control" name="officer">
            <option value="">军阶</option>
            <option value="1">旅长</option>
            <option value="2">营长</option>
            <option value="3">连长</option>
            <option value="4">排长</option>
            <option value="5">班长</option>
            <option value="0">战士</option>
        </select>
        </div>
        <p id="error_show" style="color: red"></p>
        <button id="buttonAddUser" class="btn btn-primary" style="margin-top: 8%" type="submit">添加</button>
    </form>
</div>
</body>
</html>