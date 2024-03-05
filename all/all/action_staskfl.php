<?php
// 连接数据库
include 'conn.php';

// 获取学生ID和请假原因
$stid = isset($_POST["stid"]) ? mysqli_real_escape_string($link, $_POST["stid"]) : "";
$teid = isset($_POST["teid"]) ? mysqli_real_escape_string($link, $_POST["teid"]) : "";
$reason = isset($_POST["reason"]) ? mysqli_real_escape_string($link, $_POST["reason"]) : "";

// 验证学生ID和请假原因是否为空
if (empty($teid) || empty($stid) || empty($reason)) {
    echo "<script>alert('请填写完整的请假信息。');window.location.href='staskfl.html?id=$stid';</script>";
    exit;
}

// 编写插入请假信息的SQL语句
$sql = "INSERT INTO `vacation` (`stid`, `teid`, `reason`, `state`) VALUES ('$stid', '$teid', '$reason', '未审批')";

// 执行SQL语句
$result = mysqli_query($link, $sql);

// 判断插入是否成功
if ($result) {
    echo "<script>alert('请假申请提交成功，请等待审批。');window.location.href='stloginsucc.php?id=$stid';</script>";
} else {
    echo "请假申请提交失败。错误信息：" . mysqli_error($link);
}

// 关闭数据库连接
mysqli_close($link);
?>
