<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "03student";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    echo "连接失败: " . $conn->connect_error;
}

mysqli_set_charset($conn,'utf8');
