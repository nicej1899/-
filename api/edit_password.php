<?php
require_once('../config/database.php');

$id = $_POST['id'];
$oldPassword = md5($_POST['old_password']);
$newPassword = md5($_POST['new_password']);

$sql = "select * from user where id = '$id' and status = 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row['password'] != $oldPassword) {
    echo "初始密码错误";
    die;
}

$sql = "UPDATE user SET password = '$newPassword' WHERE id = $id";
$result = $conn->query($sql);

if ($result) {
    unset($_SESSION['user']);
    echo "success";
} else {
    echo "修改密码失败";
}
