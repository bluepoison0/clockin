<?php
include 'conn.php';

$pass = 0;

$sql = "UPDATE `student` SET `pass` = ?";
// 预处理SQL模板
$stmt = mysqli_prepare($link, $sql);

// 检查mysqli_prepare是否成功
if (!$stmt) {
    die('mysqli_prepare 失败: ' . htmlspecialchars(mysqli_error($link)));
}

// 参数绑定，并为已经绑定的变量赋值
mysqli_stmt_bind_param($stmt, 'i', $pass);

// 执行预处理（第1次执行）
$result = mysqli_stmt_execute($stmt);

// 关闭连接
mysqli_close($link);

if ($result) {
    // 修改学生成功
    // 跳转到首页
    header("Location: loginsucc.php");
} else {
    exit('修改学生信息 SQL 语句执行失败。错误信息：' . htmlspecialchars(mysqli_error($link)));
}
?>
