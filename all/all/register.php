<!DOCTYPE html>
<html>
<head>
    <title>教师注册</title>
    <link rel="stylesheet" href="register.css">
    <meta name="content-type"; charset="UTF-8">
    <style>
        .right-div {
            color: white;
            font-size: 12px;
            margin-top: 10px; /* 添加上边距 */
        }
    </style>
</head>
<body>
    <div id="bigBox">
        <h1>教师注册页面</h1>

        <form action="registeraction.php" method="post">
            <div class="inputBox">
                <div class="inputText">
                    <input type="text" id="id_name" name="username" required="required" placeholder="Username">
                </div>
                <div class="inputText">
                    <input type="password" id="password" name="password" required="required" placeholder="Password">
                </div>
                <div class="inputText">
                    <input type="password" id="re_password" name="re_password" required="required" placeholder="PasswordAgain">
                </div>
                <div class="inputText">
                    <input type="text" id="name" name="name" required="required" placeholder="Name">
                </div>
                <div class="inputText">
                    <input type="text" id="grade" name="grade" required="required" placeholder="Grade">
                </div>
                <br>
                
                <div class="right-div">
                    <!-- 提示信息 -->
                    <?php
                    $err = isset($_GET["err"]) ? $_GET["err"] : "";
                    switch ($err) {
                        case 1:
                            echo "用户名已存在！";
                            break;

                        case 2:
                            echo "密码与重复密码不一致！";
                            break;

                        case 3:
                            echo "注册成功！";
                            break;
                    }
                    ?>
                </div>
            </div>

            <div>
                <input type="submit" id="register" name="register" value="注册" class="loginButton m-left">
                <input type="reset" id="reset" name="reset" value="重置" class="loginButton">
            </div>

            <div class="register">
                <a href="index.php" style="color: white">已有账号，去登录</a>
            </div>
        </form>
    </div>
</body>
</html>
