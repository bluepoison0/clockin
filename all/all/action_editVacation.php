<?php
// 连接数据库
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取表单数据
    $stid = $_POST["stid"];
    $stname = $_POST["name"];
    $reason = $_POST["reason"];
    $state = $_POST["state"];

    // 更新请假信息
    $updateSql = "UPDATE `vacation` SET `reason` = '$reason', `state` = '$state' WHERE `stid` = $stid";
    $updateResult = mysqli_query($link, $updateSql);

    if ($updateResult) {
        // 更新成功
        echo "<script>alert('请假信息修改成功');window.location.href='askforleave.php';</script>";
    } else {
        // 更新失败
        echo "请假信息修改失败。错误信息：" . mysqli_error($link);
    }
}

// 关闭数据库连接
mysqli_close($link);
?>
