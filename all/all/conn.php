<?php
// 连接数据库、设置字符集
$link = mysqli_connect('mysql:3306', 'root', '123456', 'studb');
mysqli_set_charset($link, 'utf8');

?>