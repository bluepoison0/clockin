<?php
// 连接数据库
include 'conn.php';

// 获取id
$stid = $_GET['stid'];
// 编写查询sql语句
$sql = "SELECT * FROM `vacation` WHERE `stid`=$stid";
// 执行查询操作、处理结果集
$result = mysqli_query($link, $sql);
if (!$result) {
    exit('查询sql语句执行失败。错误信息：' . mysqli_error($link));  // 获取错误信息
}
$data = mysqli_fetch_assoc($result);

// 关闭数据库连接
mysqli_close($link);
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>请假信息管理</title>
    <style type="text/css">
        body {
            background-image: url(student.jpg);
            background-size: 100%;
        }

        .box {
            display: table;
            margin: 20px auto; /* 添加垂直间距 */
        }

        h2 {
            text-align: center;
        }

        .add {
            margin-bottom: 20px;
        }

        table {
            width: 80%; /* 表格变大 */
            border-collapse: collapse;
            margin: 20px auto; /* 表格居中 */
        }

        th,
        td {
            padding: 12px; /* 增加单元格内边距 */
            text-align: center;
            border: 2px solid #00008B; /* 边界颜色改为深蓝色 */
            white-space: nowrap; /* 表格第一列不换行 */
        }

        input[type="text"],
        input[type="button"],
        input[type="submit"] {
            padding: 8px; /* 统一按钮内边距 */
            border-radius: 8px; /* 按钮四角稍微弯曲 */
        }
    </style>
</head>

<body>
    <!-- 输出定制表单 -->
    <div class="box">
        <h2>修改请假信息</h2>
        <div class="add">
            <form action="action_editVacation.php" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <th>学号：</th>
                        <td><input type="text" name="stid" size="25" value="<?php echo $data["stid"] ?>" readonly="readonly"></td>
                    </tr>
                    <tr>
                        <th>姓名：</th>
                        <?php
                        // 重新连接数据库
                        include 'conn.php';
                        $stid = $data['stid'];
                        $sql = "SELECT name FROM `student` WHERE id = '$stid'";
                        $result = mysqli_query($link, $sql);
                        if (!$result) {
                            exit('查询学生姓名失败。错误信息：' . mysqli_error($link));
                        }
                        $stname = mysqli_fetch_assoc($result)['name'];
                        // 关闭数据库连接
                        mysqli_close($link);
                        ?>
                        <td><input type="text" name="name" size="25" value="<?php echo $stname ?>" readonly="readonly"></td>
                    </tr>
                    <tr>
                        <th>原因：</th>
                        <td><input type="text" name="reason" size="25" value="<?php echo $data["reason"] ?>" readonly="readonly"></td>
                    </tr>
                    <tr>
                        <th>状态：</th>
                        <td>
                            <label><input <?php if ($data["state"] == "未审批") {
                                            echo "checked";
                                        } ?> type="radio" name="state" value="未审批">未审批</label>
                            <label><input <?php if ($data["state"] == "已审批") {
                                            echo "checked";
                                        } ?> type="radio" name="state" value="已审批">已审批</label>
                        </td>
                    </tr>

                    <tr>
                        <th>操作：</th>
                        <td>
                            <input type="button" onClick="javascript :history.back(-1);" value="返回">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="submit" value="提交">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>
