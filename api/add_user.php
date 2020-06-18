<?php
require_once('../config/database.php');

$username = $_POST['username'];
$password = md5($_POST['password']);
$name = $_POST['name'];
$sno = $_POST['sno'];
$birthday = $_POST['birthday'];
$speciality = $_POST['speciality'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];
$hobby = $_POST['hobby'];

$sql = "INSERT INTO user (username, password, type, status, name, sno, birthday, speciality, phone, mail, hobby)
VALUES ('$username', '$password', 2, 1, '$name', '$sno', '$birthday', '$speciality', '$phone', '$mail', '$hobby')";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
