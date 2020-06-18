<?php
require_once('../config/database.php');

$id = $_POST['id'];

$sql = "UPDATE user SET status = 2 WHERE id = $id";
$result = $conn->query($sql);

if ($result) {
    echo "success";
} else {
    echo "删除成员失败";
}
