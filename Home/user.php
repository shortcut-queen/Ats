<link rel="stylesheet" href="../Static/css/bootstrap.min.css">
<script src="../Static/js/bootstrap.min.js"></script>
<script src="../Static/js/jquery-3.2.1.js"></script>
<nav class="navbar navbar-default navbar-fixed-top " role="navigation" style=" font-size:18px;background-color: #46b8da;">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collape-1">
            <ul class="nav navbar-nav">
                <li class="active" style="width: 200px">
                    <a href="">军校训练管理系统</a>
                </li>
                <li class="dropdown" role="presentation" tyle="width: 200px">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">用户管理<span class="caret"></a>
                    <ul class="dropdown-menu">
                        <li style="background-color: #46b8da; font-size: 18px;">
                            <a href="">查询用户</a>
                        </li>
                        <li style="background-color: #46b8da;">
                            <a href="">增加用户</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown" role="presentation" tyle="width: 200px">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">成绩管理<span class="caret"></a>
                    <ul class="dropdown-menu">
                        <li style="background-color: #46b8da;">
                            <a href="">查看成绩</a>
                        </li>
                        <li style="background-color: #46b8da;">
                            <a href="">导入成绩</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown" role="presentation" tyle="width: 200px">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">项目管理<span class="caret"></a>
                    <ul class="dropdown-menu">
                        <li style="background-color: #46b8da;">
                            <a href="">所有项目</a>
                        </li>
                        <li style="background-color: #46b8da;">
                            <a href="">增加项目</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown" role="presentation" tyle="width: 200px">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">资源管理<span class="caret"></a>
                    <ul class="dropdown-menu">
                        <li style="background-color: #46b8da;">
                            <a href="">所有资源</a>
                        </li>
                        <li style="background-color: #46b8da;">
                            <a href="">上传查询</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li style="position:relative;margin-top:13px;">
                    管理员<?php echo $_SESSION['admin_name'];?>&emsp;已登录
                </li>
                <li >
                    <a href="../Web/LogoutController.php" >登出</a>
                </li>
            </ul>
        </div>
    </div>
</nav>