<?php
header("Content-Type: text/html;charset=utf-8");
// $Id:$ //声明变量
$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$re_password = isset($_POST['re_password']) ? $_POST['re_password'] : "";
$name = isset($_POST['name']) ? $_POST['name'] : "";
$grade = isset($_POST['grade']) ? $_POST['grade'] : "";
if ($password == $re_password) { //建立连接
    $conn = mysqli_connect("mysql:3306", "root", "123456", "studb"); //准备SQL语句,查询用户名
    mysqli_set_charset($conn,"utf8");
    $sql_select = "SELECT username FROM usertext WHERE username = '$username'"; //执行SQL语句
    $ret = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_array($ret); //判断用户名是否已存在
    if ($username == $row['username']) { //用户名已存在，显示提示信息
        header("Location:register.php?err=1");
    } else { //用户名不存在，插入数据 //准备SQL语句
        $sql_insert = "INSERT INTO usertext(username,password,name,grade) 
VALUES('$username','$password','$name','$grade')"; //执行SQL语句
        mysqli_query($conn, $sql_insert);
        header("Location:register.php?err=3");
    } //关闭数据库
    mysqli_close($conn);
} else {
    header("Location:register.php?err=2");
} ?>

