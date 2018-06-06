<?php
//未登录返回登陆页面
use Ats\Service\UserService;
session_start();
if(!isset($_SESSION['admin_name']))
    header('location:index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改用户</title>
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <script src="../Static/js/bootstrap.min.js"></script>
    <script src="../Static/js/jquery-3.2.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#select_rank").change(function () {
                var army_array=new Array("brigade","battalion","continuous","platoon","monitor");
                var i=$('#select_rank').val();
                for(i;i<5;i++)
                    $("#"+army_array[i]).val(0);
            });
            $("#buttonEditUser").click(function() {
                var army_array=new Array(document.editUser.user_name.value, document.editUser.user_id.value, document.editUser.brigade.value, document.editUser.battalion.value, document.editUser.continuous.value, document.editUser.platoon.value, document.editUser.monitor.value, document.editUser.officer.value);
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
                        if(i<=parseInt(army_array[7])+1&&parseInt(army_array[i])==0){
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

include ('../Service/UserService.php');
$user_id=$_GET['user_id'];
if($user_id==null)
    echo "<script>history.go(-2);</script>";
$result=UserService::selectUser($user_id);
if(mysql_num_rows($result)<1)
    echo "<script>history.go(-2);</script>";
$row=mysql_fetch_array($result);
?>
<div style="position: relative;margin-top: 8%;width:100%;">
    <form class="form-horizontal" style="width: 40%;margin-left: 30%;text-align: center;" name="editUser" action="../Web/AdminController.php" method="post">
        <label>修改用户</label>
        <input type="hidden" name="form_name" value="editUser">
        <div class="form-group">
            <label class="col-sm-2 control-label">姓名</label>
            <div class="col-sm-10">
                <input class="form-control" style="width;100%;" value="<?php echo $row['User_Name'];?>" type="text" name="user_name"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">编号</label>
            <div class="col-sm-10">
                <input class="form-control" value="<?php echo $user_id;?>" style="width;100%;" type="text" name="user_id"/>
            </div>
        </div>
        <div class="form-inline" style="width: 100%;margin-left: 3%;">
            <?php
            $army_array=array(array('brigade','battalion','continuous','platoon','monitor'),array('一','二','三'),array('旅','营','连','排','班'));
            $echo_str="";
            for($i=0;$i<5;$i++) {
                $echo_str =$echo_str. "<select id='".$army_array[0][$i]."' class='form-control' name='".$army_array[0][$i]."'>";
                if($row[$i+3]==0)
                    $echo_str=$echo_str."<option value='0' selected='selected'>".$army_array[2][$i]."级</option>";
                else
                    $echo_str=$echo_str."<option value='0' >".$army_array[2][$i]."级</option>";
                for($j=1;$j<4;$j++) {
                    if($row[$i+3]==$j)
                        $echo_str = $echo_str . "<option value='$j' selected='selected'>" . $army_array[1][$j-1] . $army_array[2][$i] . "</option>";
                    else
                        $echo_str = $echo_str . "<option value='$j' >" . $army_array[1][$j-1] . $army_array[2][$i] . "</option>";
                }
                $echo_str = $echo_str ."</select>";
            }
            echo $echo_str;
            $rank_array=array('战士','旅长','营长','连长','排长','班长');
            $echo_str_rank="<select id='select_rank' class='form-control' name='officer'><option value=''>军阶</option>";
            for($i=1;$i<6;$i++){
                if($row['Officer']==$i)
                    $echo_str_rank=$echo_str_rank."<option value='$i' selected='selected'>$rank_array[$i]</option>";
                else
                    $echo_str_rank=$echo_str_rank."<option value='$i' >$rank_array[$i]</option>";
            }
            if($row['Officer']==0)
                $echo_str_rank=$echo_str_rank."<option value='0' selected='selected'>$rank_array[0]</option>";
            else
                $echo_str_rank=$echo_str_rank."<option value='0' >$rank_array[0]</option>";
            $echo_str_rank=$echo_str_rank."</select>";
            echo $echo_str_rank;
            ?>
        </div>
        <p id="error_show" style="color: red"></p>
        <button id="buttonEditUser" class="btn btn-primary" style="margin-top: 8%" type="submit">修改</button>
    </form>
</div>
</body>
</html>