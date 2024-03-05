<?php
//连接数据库
include 'conn.php';

//编写查询sql语句
$sql = 'SELECT * FROM `student`';
//执行查询操作、处理结果集
$result = mysqli_query($link, $sql);
if (!$result) {
    exit('查询sql语句执行失败。错误信息：'.mysqli_error($link));  // 获取错误信息
}
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

//编写查询数量sql语句
$sql = 'SELECT COUNT(*) FROM `student`';
//执行查询操作、处理结果集
$n = mysqli_query($link, $sql);
if (!$n) {
    exit('查询数量sql语句执行失败。错误信息：'.mysqli_error($link));  // 获取错误信息
}
$num = mysqli_fetch_assoc($n);
//将一维数组的值转换为一个字符串
$num = implode($num);


?>

<html>
	<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生打卡信息管理</title>
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
			text-align:left;
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

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #7ab8cc;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>学生打卡信息管理</h1>
        <div class="add">
            当前记录
            <?php echo $num; ?>位学生&nbsp;&nbsp;&nbsp;
			
        </div>
        <table id="studentTable">
            <tr>
                <th onclick="sortTable(0)">学号⇕</th>
                <th>姓名</th>
                <th onclick="sortTable(2)">性别  ⇕</th>
                <th onclick="sortTable(3)">未打卡次数  ⇕</th>
                <th onclick="sortTable(4)">打卡⇕</th>
                <th>备注</th>
                <th>操作</th>
            </tr>
				<?php
				
	
				foreach ($data as $key => $value) {
  					foreach ($value as $k => $v) {
    					$arr[$k] = $v;
  					}
  				echo "<tr>";

              echo "<td>{$arr['id']}</td>";

              echo "<td>{$arr['name']}</td>";

              echo "<td>{$arr['sex']}</td>";

              echo "<td>{$arr['age']}</td>";

              if($arr['pass'] == 1){
                echo "<td>已打卡</td>";
              }
              else{
                echo "<td>未打卡</td>";
              }

              echo "<td>{$arr['city']}</td>";

              echo "<td>
							<a href='javascript:del({$arr['id']})'>删除</a>
							<a href='editStudent.php?id={$arr['id']}'>修改</a>
					  </td>";
				echo "</tr>";
  				// echo "<pre>";
 				// print_r($arr);
  				// echo "</pre>";
  				
  				
				}
				// 关闭连接
				mysqli_close($link);
			

				
				
			?>

			</table>
			<div class="add">
			<a href="addStudent.html">添加学生</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="searchStudent.html">查找学生</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
            <a href="javascript:delpass()">清空打卡信息</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="askforleave.php">请假信息管理</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
            <a href="index.php">退出账号</a>
			</div>
		</div>
		<script>
        var sortOrder = {};  // 对象用于存储每列的当前排序顺序

        function sortTable(column) {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("studentTable");
            switching = true;

            if (!sortOrder[column]) {
                sortOrder[column] = 'asc';  // 设置初始排序顺序为升序
            } else {
                sortOrder[column] = sortOrder[column] === 'asc' ? 'desc' : 'asc';  // 切换排序顺序
            }

            while (switching) {
                switching = false;
                rows = table.rows;

                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;

                    x = rows[i].getElementsByTagName("td")[column];
                    y = rows[i + 1].getElementsByTagName("td")[column];

                    if (sortOrder[column] === 'asc' ? x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase() : x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }
    </script>
		<script type="text/javascript">
			function del(id) {
				if (confirm("确定删除这个学生吗？")) {
					window.location = "action_del.php?id=" + id;
				}
			}
		</script>
        <script type="text/javascript">
			function delpass() {
				if (confirm("确定清空打卡信息吗？")) {
					window.location = "clear.php";
				}
			}
		</script>


	</body>
</html>




