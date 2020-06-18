<?php
require_once('../config/database.php');

$id = $_POST['id'];
$name = $_POST['name'];
$sno = $_POST['sno'];
$birthday = $_POST['birthday'];
$speciality = $_POST['speciality'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];
$hobby = $_POST['hobby'];

$sql = "UPDATE user SET name = '$name', sno = '$sno', birthday = '$birthday', speciality = '$speciality', phone = '$phone', mail = '$mail', hobby = '$hobby' WHERE id = $id";
$result = $conn->query($sql);

if ($result) {
    echo "success";
} else {
    echo "修改信息失败";
}
