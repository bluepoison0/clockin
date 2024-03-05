<?php
	//连接数据库
	include 'conn.php';

	//获取id
	$id = $_GET['id'];


	//编写查询sql语句
	$sql = "SELECT * FROM `student` WHERE `id`=$id";
	//执行查询操作、处理结果集
	$result = mysqli_query($link, $sql);
	if (!$result) {
	    exit('查询sql语句执行失败。错误信息：'.mysqli_error($link));  // 获取错误信息
	}
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
	if (!$data) {
		//输出提示，跳转到首页
		echo "没有这个学生！<br><br>";
		header('Refresh: 3; url=loginsucc.php');  //3s后跳转
		exit();
	}
	//将二维数数组转化为一维数组
	foreach ($data as $key => $value) {
	  foreach ($value as $k => $v) {
	    $arr[$k]=$v;
	  }
	}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学生信息管理系统</title>
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

        th, td {
            padding: 12px; /* 增加单元格内边距 */
            text-align: center;
            border: 2px solid #00008B; /* 边界颜色改为深蓝色 */
            white-space: nowrap; /* 表格第一列不换行 */
        }

        input[type="text"], input[type="button"], input[type="submit"] {
            padding: 8px; /* 统一按钮内边距 */
            border-radius: 8px; /* 按钮四角稍微弯曲 */
        }

        input[type="button"]:hover, input[type="submit"]:hover {
            background-color: #191970; /* 按钮悬停时颜色 */
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- 输出定制表单 -->
    <div class="box">
        <h2>查看学生信息</h2>
        <div class="add">
            <form action="loginsucc.php" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <th>学号：</th>
                        <td><input type="text" name="id" size="25" value="<?php echo $arr["id"] ?>" readonly="readonly"></td>
                    </tr>
                    <tr>
                        <th>姓名：</th>
                        <td><input type="text" name="name" size="25" value="<?php echo $arr["name"] ?>" readonly="readonly"></td>
                    </tr>
                    <tr>
                        <th>性别：</th>
                        <td>
                            <label><input <?php if ($arr["sex"]=="男" ) { echo "checked" ; } ?> type="radio" name="sex" value="男" disabled="disabled">男</label>
                            <label><input <?php if ($arr["sex"]=="女" ) { echo "checked" ; } ?> type="radio" name="sex" value="女" disabled="disabled">女</label>
                        </td>
                    </tr>
                    <tr>
                        <th>未打卡次数：</th>
                        <td><input type="text" name="age" size="25" value="<?php echo $arr["age"] ?>" readonly="readonly"></td>
                    </tr>
                    <tr>
                        <th>打卡状况：</th>
                        <td>
                            <?php
                            $passValue = $arr["pass"];
                            echo ($passValue == 1) ? "已打卡" : "未打卡";
                            ?>
                            <input type="hidden" name="pass" value="<?php echo $passValue; ?>" readonly="readonly">
                        </td>
                    </tr>
                    <tr>
                        <th>备注：</th>
                        <td><input type="text" name="city" size="25" value="<?php echo $arr["city"] ?>" readonly="readonly"></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="button" onClick="javascript:history.back(-1);" value="返回">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="submit" value="确定">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>








