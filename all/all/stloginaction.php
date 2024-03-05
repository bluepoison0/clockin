<?php
header("Content-Type: text/html;charset=utf-8");
// $Id:$ //声明变量
$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$remember = isset($_POST['remember']) ? $_POST['remember'] : ""; //判断用户名和密码是否为空
if (!empty($username) && !empty($password)) { //建立连接
    $conn = mysqli_connect('mysql:3306', 'root', '123456', 'studb'); //准备SQL语句
    $sql_select = "SELECT username,password FROM stuser WHERE username = '$username' AND password = '$password'"; //执行SQL语句
    $ret = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_array($ret); //判断用户名或密码是否正确
    if ($username == $row['username'] && $password == $row['password'])
    { 
        
        session_start(); //创建session
        $_SESSION['user'] = $username; //写入日志
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = date('Y-m-d H:m:s');
        $info = sprintf("当前访问用户：%s,IP地址：%s,时间：%s /n", $username, $ip, $date);
        $sql_logs = "INSERT INTO logs(username,ip,date) VALUES('$username','$ip','$date')";
        
        header("Location: stloginsucc.php?id=" . $row['username']); //关闭数据库,跳转至loginsucc.php
        mysqli_close($conn);
    }
    else
    {
        //用户名或密码错误，赋值err为1
        header("Location:stlogin.php?err=1");
    }
} else { //用户名或密码为空，赋值err为2
    header("Location:stlogin.php?err=2");
}