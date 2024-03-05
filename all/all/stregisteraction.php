<?php
header("Content-Type: text/html;charset=utf-8");
// $Id:$ //声明变量
$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$re_password = isset($_POST['re_password']) ? $_POST['re_password'] : "";

if ($password == $re_password) { //建立连接
    $conn = mysqli_connect("mysql:3306", "root", "123456", "studb"); //准备SQL语句,查询用户名
    mysqli_set_charset($conn,"utf8");
    $sql_select = "SELECT username FROM stuser WHERE username = '$username'"; //执行SQL语句
    $ret = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_array($ret); //判断用户名是否已存在
    if ($username == $row['username']) { //用户名已存在，显示提示信息
        header("Location:stregister.php?err=1");
    } else { //用户名不存在，插入数据 //准备SQL语句
        $sql_insert = "INSERT INTO stuser(username,password) 
VALUES('$username','$password')"; //执行SQL语句
        mysqli_query($conn, $sql_insert);
        header("Location:stregister.php?err=3");
    } //关闭数据库
    mysqli_close($conn);
} else {
    header("Location:stregister.php?err=2");
} ?>

