<?php
require_once('../config/database.php');

$userId = $_POST['user_id'];
$adminName = $_POST['admin_name'];
$content = $_POST['content'];
$time = date('Y-m-d H:i:s');

$sql = "INSERT INTO message (user_id, content, message_time, status)
VALUES ($userId, '$content', '$time', 1)";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
