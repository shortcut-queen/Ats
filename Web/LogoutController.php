<?php
/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/4/27
 * Time: 18:16
 */
session_start();
session_destroy();
header("location:../Admin/admin.php");