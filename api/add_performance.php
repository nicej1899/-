<?php
require_once('../config/database.php');

$userId = $_POST['user_id'];
$mathematics = $_POST['mathematics'];
$computer = $_POST['computer'];
$physics = $_POST['physics'];

$sql = "select * from user where id = '$userId'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sno = $row['sno'];
$name = $row['name'];

$sql = "INSERT INTO performance (user_id, sno, name, mathematics, computer, physics)
VALUES ($userId, '$sno', '$name', '$mathematics', '$computer', '$physics')";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
