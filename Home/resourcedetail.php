<?php
//未登录返回登陆页面
use Ats\Service\ResourceService;
session_start();
if(!isset($_SESSION['user_id']))
    header('location:index.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>资源详情</title>
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <script src="../Static/js/bootstrap.min.js"></script>
    <script src="../Static/js/jquery-3.2.1.js"></script>
    <script>
        function setIframeHeight(iframe) {
            if (iframe) {
                var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
                if (iframeWin.document.body) {
                    iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight;
                }
            }
        };
        window.onload = function () {
            setIframeHeight(document.getElementById('external-frame'));
        };
        function download(resource_id) {
            $.post("../Web/ResourceController.php",
                {
                    form_name:"updateDownload",
                    resource_id:resource_id
                },
                function(data){

                });
        }
    </script>
</head>
<body>
<?php include("usernav.php") ?>
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

include ("../Service/ResourceService.php");
$resource_id=$_GET['resource_id'];
$result=ResourceService::detailResource($resource_id);
$row=mysql_fetch_array($result);
?>
<div style="position: relative;margin-top: 8%;width:100%;">
    <table style="width: 80%;margin-left: 10%;text-align: center;" class="table">
        <tr>
            <td><span style="float: left;font-size: 18px;margin-left: 10%;"><?php echo $row['Resource_Name']?></span></td>
            <td><span style="float: right;margin-right: 10%;color: #777777"><?php echo "上传时间 ".$row['Upload_Date']?></span></td>
        </tr>
        <tr>
            <td colspan="2">
                <?php
                switch ($row['Resource_Type']){
                    case 1:
                        $echo_str="<iframe id='external-frame'  width='100%' height='800' onload='setIframeHeight(this)' scrolling='no'  frameborder='0' src='../Static/upload/text/".$row['Resource_Address']."'></iframe>";
                        break;
                    case 2:
                        $echo_str="<img src='../Static/upload/img/".$row['Resource_Address']."'>";
                        break;
                    case 3:
                        $echo_str="<video width='100%' height='auto' controls autoplay><source src='../Static/upload/video/".$row['Resource_Address']."' type='video/mp4'>您的浏览器不支持 video 属性。</video>";
                        break;
                }
                echo $echo_str;
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: left;"><p><?php echo str_replace("\n",'<br>',$row['Resource_About'])?></p></td>
        </tr>
        <tr>
            <td width="50%;"><button class="btn btn-primary" onclick="javascript:history.go(-1)">返回</button></td>
            <td><a href="../Static/upload/<?php $file_type=array("text","img","video"); echo $file_type[intval($row['Resource_Type'])-1].'/'.$row['Resource_Address'];?>" download="<?php echo $row['Resource_Address'];?>"><button class="btn btn-success" onclick="download(<?php echo $resource_id?>)">下载</button></a></td>
        </tr>
    </table>
</div>
</body>
</html>