<link rel="stylesheet" href="../Static/css/bootstrap.min.css">
<script src="../Static/js/bootstrap.min.js"></script>
<script src="../Static/js/jquery-3.2.1.js"></script>
<style type="text/css">
    .dropdown-submenu {
        position: relative;
    }
    .dropdown-submenu > .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -1px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px;
        border-radius: 0 6px 6px 6px;
    }
    .dropdown-submenu:hover > .dropdown-menu {
        display: block;
    }
    .dropdown-submenu > a:after {
        display: block;
        content: " ";
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
    }
    .dropdown-submenu:hover > a:after {
        border-left-color: #fff;
    }
    .dropdown-submenu.pull-left {
        float: none;
    }
    .dropdown-submenu.pull-left > .dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
    }
</style>
<nav class="navbar navbar-default navbar-fixed-top " role="navigation" style=" font-size:18px;background-color: #46b8da;">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collape-1">
            <ul class="nav navbar-nav">
                <li class="active" style="width: 200px">
                    <a href="user.php">军校训练管理系统</a>
                </li>
                <?php
                if(intval($_SESSION['officer'])!=0)
                    echo "<li class='dropdown' role='presentation' tyle='width: 200px'><a href='' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>&emsp;成绩分析&emsp;<span class='caret'></a><ul class='dropdown-menu'><li class='dropdown-submenu' style='background-color: #46b8da; font-size: 18px;'><a tabindex='-1' href='javascript:;'>个人成绩</a><ul class='dropdown-menu'><li style='background-color: #46b8da;font-size: 18px;'><a href='myscore.php'>成绩查询</a></li><li style='background-color: #46b8da;font-size: 18px;'><a href='myscoreline.php'>成长分析</a></li></ul></li><li style='background-color: #46b8da; font-size: 18px;'><a href='score.php'>成绩查询</a></li><li style='background-color: #46b8da;font-size: 18px;'><a href='scorecompare.php'>图表对比</a></li><li style='background-color: #46b8da;font-size: 18px;'><a href='scoreterm.php'>折线分析</a></li></ul></li>";
                else
                    echo "<li class='dropdown' role='presentation' tyle='width: 200px'><a href='' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>&emsp;个人成绩&emsp;<span class='caret'></a><ul class='dropdown-menu' style='width:inherit;'><li style='background-color: #46b8da;font-size: 18px;'><a href='myscore.php'>成绩查询</a></li><li style='background-color: #46b8da;font-size: 18px;'><a href='myscoreline.php'>成长分析</a></li></ul></li>";
                ?>
                <li>
                    <a href="resource.php" >&emsp;资源库&emsp;</a>
                </li>
                <li class="dropdown" role="presentation" tyle="width: 200px">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">&emsp;个人资料&emsp;<span class="caret"></a>
                    <ul class="dropdown-menu" style="width:inherit;">
                        <li style="background-color: #46b8da;font-size: 18px;">
                            <a href="myinfo.php">基本信息</a>
                        </li>
                        <li style="background-color: #46b8da;font-size: 18px;">
                            <a href="password.php">修改密码</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li style="position:relative;margin-top:13px;margin-right: 10px;">
                    <?php
                    $rank_names=array('战士','旅长','营长','连长','排长','班长');
                    $rank=intval($_SESSION['officer']);
                    echo $rank_names[$rank]."&emsp;".$_SESSION['user_name']."&emsp;已登录";
                    ?>
                </li>
                <li >
                    <a href="../Web/LogoutController.php" style="margin-right: 20px;" >&emsp;登出</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--<div id="myCarousel" class="carousel slide">-->
<!--    <!-- 轮播（Carousel）指标 -->-->
<!--    <ol class="carousel-indicators">-->
<!--        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>-->
<!--        <li data-target="#myCarousel" data-slide-to="1"></li>-->
<!--        <li data-target="#myCarousel" data-slide-to="2"></li>-->
<!--    </ol>-->
<!--    <!-- 轮播（Carousel）项目 -->-->
<!--    <div class="carousel-inner">-->
<!--        <div class="item active">-->
<!--            <img src="../Static/images/slide0.jpg" alt="First slide">-->
<!--        </div>-->
<!--        <div class="item">-->
<!--            <img src="../Static/images/slide1.jpg" alt="Second slide">-->
<!--        </div>-->
<!--        <div class="item">-->
<!--            <img src="../Static/images/slide2.jpg" alt="Third slide">-->
<!--        </div>-->
<!--    </div>-->
<!--    <!-- 轮播（Carousel）导航 -->-->
<!--    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">-->
<!--        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>-->
<!--        <span class="sr-only">Previous</span>-->
<!--    </a>-->
<!--    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">-->
<!--        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>-->
<!--        <span class="sr-only">Next</span>-->
<!--    </a>-->
<!--</div>-->