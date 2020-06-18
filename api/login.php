<?php
require_once('../config/database.php');

$username = $_POST['username'];
$password = md5($_POST['password']);
$type = $_POST['type'];

$sql = "select * from user where username = '$username' and type = $type";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['password'] == $password) {
            $_SESSION['user'] = $row;
            echo "success";
        } else {
            echo "密码错误！";
        }
    }
} else {
    echo "用户名不存在！";
}
