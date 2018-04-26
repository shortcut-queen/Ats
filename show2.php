<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
include "test.php";
$test1=new test;
$test1->setname("hello");
echo $test1->getname();
?>
</body>
</html>