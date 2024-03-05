<?php
include 'conn.php';
$id = $_GET['id'];
$pass = 1;

$sql = "UPDATE `student` SET `pass` = ? WHERE `id` = ?";
// 预处理SQL模板
$stmt = mysqli_prepare($link, $sql);

// 检查mysqli_prepare是否成功
if (!$stmt) {
    die('mysqli_prepare 失败: ' . htmlspecialchars(mysqli_error($link)));
}

// 参数绑定，并为已经绑定的变量赋值
mysqli_stmt_bind_param($stmt, 'si', $pass, $id);

// 执行预处理
$result = mysqli_stmt_execute($stmt);

// 关闭连接
mysqli_close($link);

if ($result) {
    // 修改学生成功
    // 跳转到首页
    header("Location: stloginsucc.php?id={$id}");
} else {
    exit('打卡失败。错误信息：' . htmlspecialchars(mysqli_error($link)));
}
?>
