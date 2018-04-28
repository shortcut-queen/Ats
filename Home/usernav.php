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
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">&emsp;成绩分析&emsp;<span class="caret"></a>
                    <ul class="dropdown-menu">
                        <li style="background-color: #46b8da; font-size: 18px;">
                            <a href="score.php">成绩查询</a>
                        </li>
                        <li style="background-color: #46b8da;font-size: 18px;">
                            <a href="">图表对比</a>
                        </li>
                        <li style="background-color: #46b8da;font-size: 18px;">
                            <a href="">折线分析</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="" >&nbsp;资源库&nbsp;</a>
                </li>
                <li class="dropdown" role="presentation" tyle="width: 200px">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">&emsp;个人资料&emsp;<span class="caret"></a>
                    <ul class="dropdown-menu" style="width:inherit;">
                        <li style="background-color: #46b8da;font-size: 18px;">
                            <a href="">修改密码</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li style="position:relative;margin-top:13px;margin-right: 10px;">
                    用户&emsp;<?php echo $_SESSION['user_name'];?>&emsp;已登录
                </li>
                <li >
                    <a href="../Web/LogoutController.php" style="margin-right: 20px;" >&emsp;登出</a>
                </li>
            </ul>
        </div>
    </div>
</nav>