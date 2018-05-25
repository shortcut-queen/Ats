<link rel="stylesheet" href="../Static/css/bootstrap.min.css">
<script src="../Static/js/bootstrap.min.js"></script>
<script src="../Static/js/jquery-3.2.1.js"></script>
<nav class="navbar navbar-default navbar-fixed-top " role="navigation" style=" font-size:18px;background-color: #46b8da;">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collape-1">
            <ul class="nav navbar-nav">
                <li class="active" style="width: 200px">
                    <a href="manage.php">军校训练管理系统</a>
                </li>
                <li class="dropdown" role="presentation" tyle="width: 200px">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">&emsp;用户管理&emsp;<span class="caret"></a>
                    <ul class="dropdown-menu">
                        <li style="background-color: #46b8da; font-size: 18px;">
                            <a href="queryuser.php">查询用户</a>
                        </li>
                        <li style="background-color: #46b8da;font-size: 18px;">
                            <a href="adduser.php">增加用户</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown" role="presentation" tyle="width: 200px">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">&emsp;成绩管理&emsp;<span class="caret"></a>
                    <ul class="dropdown-menu">
                        <li style="background-color: #46b8da;font-size: 18px;">
                            <a href="">查看成绩</a>
                        </li>
                        <li style="background-color: #46b8da;font-size: 18px;">
                            <a href="">导入成绩</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown" role="presentation" tyle="width: 200px">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">&emsp;项目管理&emsp;<span class="caret"></a>
                    <ul class="dropdown-menu">
                        <li style="background-color: #46b8da;font-size: 18px;">
                            <a href="allproject.php">所有项目</a>
                        </li>
                        <li style="background-color: #46b8da;font-size: 18px;">
                            <a href="addproject.php">增加项目</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown" role="presentation" tyle="width: 200px">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">&emsp;资源管理&emsp;<span class="caret"></a>
                    <ul class="dropdown-menu">
                        <li style="background-color: #46b8da;font-size: 18px;">
                            <a href="">所有资源</a>
                        </li>
                        <li style="background-color: #46b8da;font-size: 18px;">
                            <a href="uploadresource.php">上传资源</a>
                        </li>
                    </ul>
                </li>
                <?php
                if(intval($_SESSION['admin_type'])==0)
                    echo" <li class='dropdown' role='presentation' tyle='width: 200px'><a href='' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>&emsp;管理员&emsp;&emsp;<span class='caret'></a><ul class='dropdown-menu'><li style='background-color: #46b8da;font-size: 18px;'><a href='alladmin.php'>所有管理员</a></li><li style='background-color: #46b8da;font-size: 18px;'><a href='addadmin.php'>添加管理员</a></li></ul></li>";
                else
                    echo "<li><a href='password.php'>修改密码</a></li>";
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li style="position:relative;margin-top:13px;margin-right: 10px;">
                    <?php
                    if(intval($_SESSION['admin_type'])==0)
                        $admin_type="超级管理员：";
                    else $admin_type="普通管理员：";
                    echo $admin_type.$_SESSION['admin_name'];
                    ?>&emsp;已登录
                </li>
                <li >
                    <a href="../Web/LogoutController.php" style="margin-right: 20px;" >&emsp;登出</a>
                </li>
            </ul>
        </div>
    </div>
</nav>