<?php
// 连接数据库
include 'conn.php';

// 处理筛选状态
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedState = $_POST["selectedState"];

    // 如果选择了状态，则构建查询语句
    $sql = "SELECT * FROM `vacation`";
    if (!empty($selectedState)) {
        $sql .= " WHERE `state` = '$selectedState'";
    }

    // 执行查询操作、处理结果集
    $result = mysqli_query($link, $sql);
    if (!$result) {
        exit('查询请假信息失败。错误信息：' . mysqli_error($link));
    }
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    // 没有进行状态筛选时，默认查询所有请假信息
    $sql = 'SELECT * FROM `vacation`';
    $result = mysqli_query($link, $sql);
    if (!$result) {
        exit('查询请假信息失败。错误信息：' . mysqli_error($link));
    }
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// 查询请假信息数量
$sql = 'SELECT COUNT(*) AS count FROM `vacation`';
$n = mysqli_query($link, $sql);
if (!$n) {
    exit('查询请假信息数量失败。错误信息：' . mysqli_error($link));
}
$num = mysqli_fetch_assoc($n);
// 获取请假信息数量
$num = $num['count'];
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>请假信息管理</title>
    <style type="text/css">
        body {
            background-image: url(student.jpg);
            background-size: 100%;
        }

        .wrapper {
            width: 1000px;
            margin: 20px auto;
        }

        h1 {
            text-align: center;
        }

        .add {
            margin-bottom: 20px;
            text-align: center;
        }

        .add a {
            text-decoration: none;
            color: #fff;
            background-color: #bdb76b;
            padding: 6px;
            border-radius: 5px;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #7ab8cc;
            color: #fff;
        }

        /* 新添加的样式，用于右侧返回按钮的定位 */
        .return-button {
            float: right;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h1>请假信息管理</h1>
        <div class="add">
            当前记录
            <?php echo $num; ?>条请假信息&nbsp;&nbsp;&nbsp;

            <!-- 返回按钮 -->
            <a href="loginsucc.php" class="return-button">返回主页</a>
        </div>

        <!-- 筛选状态的表单 -->
        <form method="post" action="">
            <label for="selectedState">选择状态：</label>
            <select name="selectedState" id="selectedState">
                <option value="">全部</option>
                <option value="未审批">未审批</option>
                <option value="已审批">已审批</option>
            </select>
            <input type="submit" value="筛选">
        </form>

        <table id="studentTable">
            <tr>
                <th>学号</th>
                <th>姓名</th>
                <th>原因</th>
                <th>状态</th>
                <th>批准老师</th>
                <th>操作</th>
            </tr>
            <?php
            foreach ($data as $key => $value) {
                echo "<tr>";
                echo "<td>{$value['stid']}</td>";

                $stid = $value['stid'];
                $sql = "SELECT name FROM `student` WHERE id = '$stid'";
                $result = mysqli_query($link, $sql);
                if (!$result) {
                    exit('查询学生姓名失败。错误信息：' . mysqli_error($link));
                }
                $stname = mysqli_fetch_assoc($result)['name'];
                echo "<td>{$stname}</td>";

                echo "<td>{$value['reason']}</td>";
                echo "<td>{$value['state']}</td>";

                $teid = $value['teid'];
                $sql = "SELECT name FROM `usertext` WHERE username = '$teid'";
                $result = mysqli_query($link, $sql);
                if (!$result) {
                    exit('查询老师姓名失败。错误信息：' . mysqli_error($link));
                }
                $tename = mysqli_fetch_assoc($result)['name'];
                echo "<td>{$tename}</td>";
                echo "<td>
							<a href='javascript:del({$value['stid']})'>删除</a>
							<a href='editVacation.php?stid={$value['stid']}'>审批</a>
					  </td>";
                echo "</tr>";
            }
            ?>
        </table>
        <script type="text/javascript">
            function del(id) {
                if (confirm("确定删除这条信息？")) {
                    window.location = "action_delva.php?stid=" + id;
                }
            }
        </script>

    </div>
</body>

</html>
