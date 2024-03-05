<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>请假申请</title>
    <style type="text/css">
        body {
            background-image: url(student.jpg);
            background-size: 100%;
        }

        .wrapper {
            width: 500px;
            margin: 20px auto;
        }

        h2 {
            text-align: center;
        }

        form {
            margin-top: 20px;
            text-align: center;
        }

        label {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        label span {
            margin-right: 10px;
            font-size: 16px;
        }

        textarea,
        input {
            width: 80%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            background-color: #bdb76b;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>请填写请假原因</h2>
        <form action="action_staskfl.php" method="post">
            <label for="reason">
                <span>请假原因:</span>
                <!-- 使用 textarea 元素 -->
                <textarea id="reason" name="reason" required></textarea>
            </label>

            <label for="teacher_id">
                <span>老师工号:</span>
                <input type="int" id="teid" name="teid" required>
            </label>

            <input type="hidden" name="stid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
            
            <button type="submit">提交请假申请</button>
        </form>
    </div>
</body>
</html>
