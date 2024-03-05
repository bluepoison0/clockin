<?php
// 连接数据库
include 'conn.php';

$id = isset($_GET["id"]) ? $_GET["id"] : "";
// 编写查询sql语句
$sql = "SELECT * FROM `student` WHERE `id`='$id'";
// 执行查询操作、处理结果集
$result = mysqli_query($link, $sql);
if (!$result) {
    exit('查询sql语句执行失败。错误信息：' . mysqli_error($link));  // 获取错误信息
}
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

// 检查学生是否有请假记录
$sqlVacationCheck = "SELECT * FROM `vacation` WHERE `stid`='$id'";
$resultVacationCheck = mysqli_query($link, $sqlVacationCheck);

// 获取学生信息
$sqlStudent = "SELECT * FROM `student` WHERE `id`='$id'";
$resultStudent = mysqli_query($link, $sqlStudent);
if (!$resultStudent) {
    exit('查询学生信息失败。错误信息：' . mysqli_error($link));
}
$dataStudent = mysqli_fetch_assoc($resultStudent);

// 检查是否有请假记录
$hasVacationRecords = mysqli_num_rows($resultVacationCheck) > 0;
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生个人信息</title>
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
        h2 {
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

        .status {
            margin-top: 10px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h1>学生个人信息</h1>

        <table id="studentTable">
            <tr>
                <th>学号</th>
                <th>姓名</th>
                <th>性别</th>
                <th>未打卡次数</th>
                <th>打卡状态</th>
                <th>备注</th>
                <th>操作</th>
                
            </tr>
            <?php
            foreach ($data as $key => $value) {
                echo "<tr>";
                echo "<td>{$value['id']}</td>";
                echo "<td>{$value['name']}</td>";
                echo "<td>{$value['sex']}</td>";
                echo "<td>{$value['age']}</td>";
                echo "<td>" . ($value['pass'] == 1 ? '已打卡' : '未打卡') . "</td>";
                echo "<td>{$value['city']}</td>";
                echo "<td><a href='javascript:stpass({$value['id']}, {$value['pass']})'>打卡</a>";
                echo "  ";
                if(!$hasVacationRecords) echo "<a href='staskfl.php?id={$value['id']}'>请假</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <?php
        // 如果有请假记录，显示请假记录表格
        if ($hasVacationRecords) {
            echo "<h2>请假记录</h2>";
            echo "<table>";
            echo "<tr><th>学号</th><th>姓名</th><th>请假原因</th><th>状态</th></tr>";

            // 查询学生的请假记录
            $sqlVacation = "SELECT st.id AS stid, st.name AS stname, va.reason, va.state FROM `vacation` va JOIN `student` st ON va.stid = st.id WHERE va.stid = '$id'";
            $resultVacation = mysqli_query($link, $sqlVacation);
            if (!$resultVacation) {
                exit('查询请假记录失败。错误信息：' . mysqli_error($link));
            }

            while ($row = mysqli_fetch_assoc($resultVacation)) {
                echo "<tr>";
                echo "<td>{$row['stid']}</td>";
                echo "<td>{$row['stname']}</td>";
                echo "<td>{$row['reason']}</td>";
                echo "<td>{$row['state']}</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>
        


            <!-- ... 其他 HTML 代码 ... -->

            <div class="status" id="status"></div>

            <a href="stlogin.php" style="float: right; margin-top: 20px;">退出账号</a>
            </div>

<!-- ... 其他 HTML 代码 ... -->


    </div>

    <script type="text/javascript">
        function stpass(id, pass) {
            var statusDiv = document.getElementById('status');
            if (pass == 1) {
                statusDiv.innerHTML = "您已经打卡了！";
            } else {
                if (confirm("是否要打卡？")) {
                    window.location = "stpass.php?id=" + id;
                } else {
                    statusDiv.innerHTML = "您选择了取消打卡。";
                }
            }
        }
    </script>
</body>

</html>
